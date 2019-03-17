<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller  {

  public function index()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

          $id_group = $_SESSION['id_group'];

	        $result_cont = $this->My_contacts->get_all_cont($id_group);

          $result = array();

          foreach ($result_cont as $row) {

              $result_cat = $this->My_contacts->get_cat_total_by_id($row->id);

              $cat = "";
              foreach ($result_cat as $row_cat) {
                $cat .=  $row_cat->titre." / ";
              }

            $all_cat = substr($cat, 0, -3);
            $all_cat = (strlen($all_cat) > 84) ? substr($all_cat,0,84). ' ... ' : $all_cat;

            $temp = array (
                'id' => $row->id,
                'nom' => $row->nom,
                'prenom' => $row->prenom,
                'raison_sociale' => $row->raison_sociale,
                'email' => $row->email,
                'categorie' => $all_cat
              );

            array_push ($result, $temp);

          }

	       $data = array(
	            'result' => $result,
	        );

			    $this->load->view('header', $data);
	        $this->load->view('contacts');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function erreur()
  {
    if ($_SESSION['is_connect'] == TRUE){

      $this->load->view('header');
      $this->load->view('contacts_erreur');
      $this->load->view('footer');

      } else {
          $this->load->view('login');
      }
  }

  public function ajouter()
	{

		if ($_SESSION['is_connect'] == TRUE){

					$this->load->model('My_entreprises');
					$this->load->model('My_categories');

          $id_group = $_SESSION["id_group"];

	        $result_cat = $this->My_categories->get_all_cat($id_group);
	        $result_ent = $this->My_entreprises->get_all_ent($id_group);

	        $data = array(
	            'result_cat' => $result_cat,
	            'result_ent' => $result_ent,
	        );

					$this->load->view('header', $data);
	        $this->load->view('contacts_ajouter');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function modifier()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_contacts');

      $id = $this->uri->segment(3, 0);

      $result = $this->My_contacts->get_ent_by_id($id);
      $resultc = $this->My_contacts->get_cat_by_id($id);

      $civ_val1 = '';
      $civ_val2 = '';
      foreach ($result as $row) {
        if ($row->civ == 2) { $civ_val2 = 'selected';}
        if ($row->civ == 1) { $civ_val1 = 'selected';}
      }

      $result_cat = '';

      foreach ($resultc as $rowc) {
        $result_cat[] = $rowc->id_cat;
      }

      $data = array(
          'result'     => $result,
          'civ_val1'   => $civ_val1,
          'civ_val2'   => $civ_val2,
          'result_cat' => $result_cat,
        );

      $this->load->view('header', $data);
      $this->load->view('contacts_modifier');
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
  }

  public function add()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

      $id_group = $_SESSION["id_group"];

			$result = $this->My_contacts->check_exist($this->input->post('email'), $id_group);

			if (count($result) > 0) {

		        echo 1;

		    } else {

				$data = array(
					'id' 			    => $this->input->post('id'),
          'id_group' 		=> $id_group,
					'civ' 				=> $this->input->post('civ'),
					'nom' 				=> $this->input->post('nom'),
					'prenom' 			=> $this->input->post('prenom'),
					'fonction' 		=> $this->input->post('fonction'),
					'tel' 				=> $this->input->post('tel'),
					'fax' 				=> $this->input->post('fax'),
					'mobile' 			=> $this->input->post('mobile'),
					'email' 			=> $this->input->post('email'),
					'num_voie' 		=> $this->input->post('num_voie'),
					'nom_voie' 		=> $this->input->post('nom_voie'),
					'lieu_dit' 		=> $this->input->post('lieu_dit'),
					'bp' 				  => $this->input->post('bp'),
					'cp' 				  => $this->input->post('cp'),
					'ville' 			=> $this->input->post('ville'),
					'cedex' 			=> $this->input->post('cedex'),
				);

	        $id = $this->My_common->insert_data ('contacts', $data);

	        foreach ($_POST['id_cat'] as $key => $value) {
	        	$data =array (
	        		'id_contact' => $id,
	        		'id_cat' => $value,
	        	);
	        	$this->My_common->insert_data ('contacts_cat', $data);
	        }

		        echo 'ok';
		    }

    	} else {

        echo 3;

    	}

	}

  public function update()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

      $this->My_contacts->delete_ent_cat($this->input->post('id'));

      $id_group = $_SESSION["id_group"];

      $result = $this->My_contacts->check_exist($this->input->post('email'), $id_group, $this->input->post('id'));

			if (count($result) > 0) {

		     echo 1;

      } else {

        $data = array(
          'id' 		      => $this->input->post('id'),
          'id_ent' 			=> $this->input->post('id_ent'),
          'civ' 				=> $this->input->post('civ'),
          'nom' 				=> $this->input->post('nom'),
          'prenom' 			=> $this->input->post('prenom'),
          'fonction' 		=> $this->input->post('fonction'),
          'tel' 				=> $this->input->post('tel'),
          'fax' 				=> $this->input->post('fax'),
          'mobile' 			=> $this->input->post('mobile'),
          'email' 			=> $this->input->post('email'),
          'num_voie' 		=> $this->input->post('num_voie'),
          'nom_voie' 		=> $this->input->post('nom_voie'),
          'lieu_dit' 		=> $this->input->post('lieu_dit'),
          'bp' 				  => $this->input->post('bp'),
          'cp' 				  => $this->input->post('cp'),
          'ville' 			=> $this->input->post('ville'),
          'cedex' 			=> $this->input->post('cedex'),
        );

        $this->My_common->update_data('contacts', 'id', $this->input->post('id'), $data);

        foreach ($_POST['id_cat'] as $key => $value) {
          $data =array (
            'id_contact' => $this->input->post('id'),
            'id_cat' => $value,
          );
          $this->My_common->insert_data('contacts_cat', $data);
        }

        echo 'ok';

     }

  	} else {

      echo 3;

  	}

	}

  public function delete()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_contacts');

          $this->My_common->delete_data('contacts', $this->input->post('id'));
          $this->My_contacts->delete_ent_cat($this->input->post('id'));

      redirect('contacts');

      } else {
          $this->load->view('login');
      }

  }

	public function importer()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

      $id_group = $_SESSION["id_group"];

      $result_cat = $this->My_categories->get_all_cat($id_group);

      $data = array(
          'result_cat' => $result_cat,
      );

			$this->load->view('header', $data);
	    $this->load->view('contacts_importer');
	    $this->load->view('footer');

  	} else {
      	$this->load->view('login');
  	}
	}


	public function importer_save()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

			$this->load->library('upload');
			$this->load->helper('url');
			$this->load->helper('text');
			$this->load->helper('directory');

			$config['upload_path'] = 'temp/';
			$config['allowed_types'] = '*';
			$config['max_size'] = '110000';
			$config['overwrite'] = true;

			$file = 'temp.xlsx';

			if ($_FILES['fichier']['name'] != ''){
				$config['file_name'] = $file;
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('fichier')){
					echo 'erreur 1';
          echo $this->upload->display_errors();
				} else {

					require(APPPATH.'libraries/PHPExcel.php');

					$objReader = PHPExcel_IOFactory::createReader('Excel2007');
					$objReader->setReadDataOnly(true);
					$objPHPExcel = $objReader->load("temp/temp.xlsx");
					$objWorksheet = $objPHPExcel->setActiveSheetIndex(0)->toArray(null,true,true,true);

					foreach ($objWorksheet as $row) {

						if ($row['B'] != 'Nom' && $row['B'] != ''){

							$email 	= $row['H'];
							$nom 	= $row['B'];

							// On verifie si le contact est déjà dans la base :
							$result = $this->My_contacts->check_exist ($email, $_SESSION['id_group']);

							if (count($result) > 0){

								$id_contact = $result[0]->id;

								// si il est dans la base on verifie si il est dans la categorie
								if (isset($_POST['id_cat'])){

									foreach ($_POST['id_cat'] as $key => $value) {
										$result_contact_cat = $this->My_contacts->check_contact_cat($value, $id_contact);
										if (count ($result_contact_cat) == 0){

							        	$data =array (
							        		'id_contact' => $id_contact,
							        		'id_cat' => $value,
							        	);
							        	$this->My_common->insert_data ('contacts_cat', $data);

										}
									}
								}

							} else {

								// Si il est pas dans la base on l'ajoute avec le categorie
	  						$data = array (
                  'id_group' => $_SESSION['id_group'],
	  							'civ' 		=> $row['A'],
	  							'nom' 		=> $row['B'],
	  							'prenom' 	=> $row['C'],
	  							'fonction' 	=> $row['D'],
	  							'tel' 		=> $row['E'],
	  							'fax' 		=> $row['F'],
	  							'mobile' 	=> $row['G'],
	  							'email' 	=> $row['H'],
	  						);

	  						$id = $this->My_common->insert_data ('contacts', $data);

							if (isset($_POST['id_cat'])){
				        foreach ($_POST['id_cat'] as $key => $value) {
				        	$data =array (
				        		'id_contact' => $id,
				        		'id_cat' => $value,
				        	);
				        	$this->My_common->insert_data ('contacts_cat', $data);
				        }
				    	}
						}
					}
				}
			}
		} else {
			echo 'erreur';
		}

		redirect (base_url().'contacts');

  	} else {
      	$this->load->view('login');
  	}
	}

}
