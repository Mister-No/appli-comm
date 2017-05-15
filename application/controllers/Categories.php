<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function index()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

					$id_group = $_SESSION["id_group"];

					$result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

					$result = array();
					$tab_cat_child = array();

					foreach ($result_cat_parent as $row_cat_parent) {

						$result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id);

						foreach ($result_cat_child as $row_cat_child) {

							$tab_cat_child[] = [
								'id' 				=> $row_cat_child->id,
								'titre' 		=> $row_cat_child->titre,
								'id_parent' => $row_cat_child->id_parent,
							];

						}

						$result[] = [
							'id' 				=> $row_cat_parent->id,
							'titre' 		=> $row_cat_parent->titre,
							'cat_child' => $tab_cat_child
						];
						$tab_cat_child = array();

					}

					$data = array(
							'result' => $result,
					);

					/*echo '<pre>';
					print_r($result);
					echo '<pre>';*/

					$this->load->view('header', $data);
					$this->load->view('categories');
					$this->load->view('footer');

			} else {
					$this->load->view('login');
			}
	}

	public function exporter()
	{
		if ($_SESSION['is_connect'] == TRUE){

		$this->load->model('My_categories');

		$id_group = $_SESSION['id_group'];

		$result = array();

		$result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

		foreach ($result_cat_parent as $row_cat_parent) {

			$result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id);

			foreach ($result_cat_child as $row_cat_child) {

				$tab_cat_child[] = [
					'id' => $row_cat_child->id,
					'titre' => $row_cat_child->titre,
				];

			}

			$result[] = [
				'id' => $row_cat_parent->id,
				'titre' => $row_cat_parent->titre,
				'cat_child' => $tab_cat_child
			];
			$tab_cat_child = array();

			}

			$data = array(
					'result' => $result,
			);

			$this->load->view('header', $data);
			$this->load->view('categories_exporter');
			$this->load->view('footer');

			} else {
					$this->load->view('login');
			}
	}


	public function export_csv()
	{
		$this->load->model('My_listes');

		require(APPPATH.'libraries/PHPExcel.php');

		$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objPHPExcel->load(APPPATH.'/libraries/registre.xlsx'); // Empty Sheet
		$objPHPExcel->setActiveSheetIndex(0);


		/*function searchForId($nom, $email , $array) {
		   foreach ($array as $key => $val) {
		       if (($val['1'] === $nom) && ($val['7'] === $email)) {
		           return $key;
		       }
		   }
		   return "rien";
		}

		/*
		    INSERT DES DATAS
		*/

		$rowArray = array();


		        foreach ($_POST['id_cat'] as $key => $value) {

		            $result_contact = $this->My_listes->get_contact_by_cat($value);

		            foreach ($result_contact as $row) {

		                $temp = array (
		                    $row->civ,
		                    $row->nom,
		                    $row->prenom,
		                    $row->fonction,
		                    $row->tel,
		                    $row->mobile,
		                    $row->fax,
		                    $row->email,
		                    $row->num_voie,
		                    $row->nom_voie,
		                    $row->lieu_dit,
		                    $row->bp,
		                    $row->cp,
		                    $row->ville,
		                    $row->cedex,
		                );
		               /* if (searchForId ($row->nom, $row->email, $rowArray) === "rien"){
		                    array_push($rowArray, $temp);

		                    if ($row->nom == "BERGOUIGNON"){
		                      //echo "#####".searchForId ($row->nom, $row->email, $rowArray)."<br>";
		                    }
		                    //echo searchForId ($row->nom, $row->email, $rowArray)."coucouc<br>";
		                } else {
		                   // echo $row->nom." foudn<br>";
		                }*/
		            }
		        }

		//$rowArray = array('Value1', 'Value2', 'Value3', 'Value4');
		$objPHPExcel->getActiveSheet()->fromArray($rowArray, NULL, 'A3');

		$styleA = $objPHPExcel->getActiveSheet()->getStyle('B2');
		$objPHPExcel->getActiveSheet()->duplicateStyle($styleA, 'A3:AB'.$objPHPExcel->setActiveSheetIndex(0)->getHighestRow());

		$objPHPExcel->getActiveSheet()->removeRow(2);


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="registre.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		/**/

	}

	public function add()
	{

		if ($_SESSION['is_connect'] == TRUE){

		$this->load->model('My_categories');

		$id_group = $_SESSION['id_group'];

		$result = $this->My_categories->check_exist($this->input->post('titre'), $id_group);

		if (count($result) > 0){

				echo 1;

			} else {

				if ($this->input->post('id_parent') > 0) {
					$id_parent = $this->input->post('id_parent');
				} else {
					$id_parent = 0;
				}

				$data = array(
					'id' 		 		=> $this->input->post('id'),
					'id_group' 	=> $id_group,
					'titre'  		=> $this->input->post('titre'),
					'id_parent' => $id_parent,
				);

				$this->My_common->insert_data('categorie', $data);

				echo 'ok';

			}

    } else {

			echo 3;

    }

	}

	public function update()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

			$id_group = $_SESSION['id_group'];

			$result = $this->My_categories->check_exist($this->input->post('titre'), $id_group, $this->input->post('id'));

			if (count($result) > 0){

					echo 1;

				} else {

					$data = array (
					'id' 				 => $this->input->post('id'),
					'titre' 		 => $this->input->post('titre'),
					);

					$this->My_common->update_data('categorie', 'id', $this->input->post('id'), $data);

					echo 'ok';

				}

    	} else {

        echo 3;

    	}

	}

	public function move()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

			$id_group = $_SESSION['id_group'];

			$result = $this->My_categories->check_exist($this->input->post('titre'), $id_group, $this->input->post('id'));

			if (count($result) > 0){

					echo 1;

				} else {

					$data = array (
					'id' 				 => $this->input->post('id'),
					'titre' 		 => $this->input->post('titre'),
					'id_parent'  => $this->input->post('id_parent'),
					);

					$this->My_common->update_data('categorie', 'id', $this->input->post('id'), $data);

					echo 'ok';

				}

			} else {

				echo 3;

			}

	}

	public function delete()
	{

	if ($_SESSION['is_connect'] == TRUE){

		$this->load->model('My_categories');

		$this->My_categories->delete_cat('contacts_cat', $this->input->post('id'));

		$this->My_categories->delete_cat('entreprises_cat', $this->input->post('id'));

		$this->My_categories->delete_cat('liste_cat', $this->input->post('id'));

    $this->My_categories->delete_cat('categorie', $this->input->post('id'));

		redirect('categories');

  	} else {
      	$this->load->view('login');
  	}

	}

}
