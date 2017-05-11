<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function index()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

					$id_group = $_SESSION["id_group"];

					$result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

					$result = array();

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


	public function export_csv ()
	{
		$this->load->model('My_listes');

		$this->load->view ('categories_xls');
	}

	/*public function ajouter()
	{

		if ($_SESSION['is_connect'] == TRUE){

					$this->load->view('header');
					$this->load->view('categories_ajouter');
					$this->load->view('footer');

			} else {
					$this->load->view('login');
			}

	}

	public function modifier_categorie()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

			$id = $this->uri->segment(3, 0);

				$result = $this->My_categories->get_cat_by_id($id);

				$data = array(
					'result' => $result,
				);

				$this->load->view('header', $data);
				$this->load->view('categories_modifier');
				$this->load->view('footer');

			} else {
					$this->load->view('login');
			}
	}

	public function modifier_sous_categorie()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

			$id = $this->uri->segment(3, 0);

				$result = $this->My_categories->get_cat_by_id($id);

				$data = array(
					'result' => $result,
				);

				$this->load->view('header', $data);
				$this->load->view('sous-categories_modifier');
				$this->load->view('footer');

			} else {
					$this->load->view('login');
			}
	}*/

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

		$this->My_common->delete_data('contacts_cat', $this->input->post('id'));

		$this->My_common->delete_data('entreprises_cat', $this->input->post('id'));

		$this->My_common->delete_data('liste_cat', $this->input->post('id'));

    $this->My_common->delete_data('categorie', $this->input->post('id'), $this->input->post('id_parent'));

		redirect('categories');

  	} else {
      	$this->load->view('login');
  	}

	}

}
