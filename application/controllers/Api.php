<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{

		if ($_SESSION['is_connect'] == TRUE){



  	} else {

      	$this->load->view('login');

  	}
	}

	public function ajout_contact()
	{

		$this->load->model('My_listes');
		$this->load->model('My_categories');
		$this->load->model('My_users');
		$this->load->model('My_contacts');

		$id_group = 2;
		$check_contact = $this->My_contacts->check_exist($this->input->post('email'), $id_group);

		// Connexion avec l'API Send in blue de la liste chez send in blue

		$infos_group = $this->My_users->get_group_infos($id_group);
		require(APPPATH.'libraries/Mailin.php');
		$mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

		if (count($check_contact) == 0) {

		// Si le contact n'existe pas

			$data_contact = array(
				'id_group' 		=> $id_group,
				'email'				=> $this->input->post('email'),
				'blacklist'	 	=> $this->input->post('newslatter'),
			);

			$data_contact_sib = array(
				'email'				=> $this->input->post('email'),
				'blacklist'	 	=> $this->input->post('newslatter'),
			);

			$mailin->create_update_user($data_contact_sib);

			$id_contact = $this->My_common->insert_data("contacts", $data_contact);

			$data_contact_cat = array(
				'id_cat' 			 => $this->input->post('id'),
				'id_contact' 		 => $id_contact,
			);

			$this->My_common->insert_data("contacts_cat", $data_contact_cat);

			$cat_list = $this->My_listes->get_cat_liste($this->input->post('id'), $id_group);

			foreach ($cat_list as $row) {

				if ($row->id_sib != '') {

					$data = array(
						"id" 		=> $row->id_sib,
						"users" => array($this->input->post('email')),
					);

					$result = $mailin->add_users_list($data);

				}

			}

			echo 'add';

		} else {

			// Si le contact existe

			$data_contacts = array(
				'email'				 => $this->input->post('email'),
			);

			$this->My_common->update_data("contacts", 'id', $check_contact[0]->id, $data_contacts);

			// Ajout de la catégorie

			$data_contacts_cat = array(
				'id_cat' 			 	 => $this->input->post('id'),
				'id_contact' 		 => $check_contact[0]->id,
			);

			$this->My_common->insert_data("contacts_cat", $data_contacts_cat);

			// Mise à jour de toutes les listes qui sont composées de cette categorie.

			$cat_list = $this->My_listes->get_cat_liste($this->input->post('id'), $id_group);

			foreach ($cat_list as $row) {

				$data = array(
					"id" 		=> $row->id_sib,
					"users" => array($this->input->post('email')),
				);

				$result = $mailin->add_users_list($data);

			}

			echo 'update';

		}

	}

}

/* A laisser
// METZ
$this->input->post('id') = 15;
$this->input->post('id') = 13;


// DEAUVILLE
$this->input->post('id') = 17;
$this->input->post('id') = 27;

// NDR
$this->input->post('id') = 19;
$this->input->post('id') = 28;

//Levallois
$this->input->post('id') == 18;
$this->input->post('id') == 29;

//Chaville
$this->input->post('id') == 25;
$this->input->post('id') == 30;

//Montrouge
$this->input->post('id') == 21;
$this->input->post('id') == 31;

//Saint-Cyr-au-Mont-D'or
$this->input->post('id') == 14;
$this->input->post('id') == 32;

//Drancy
$this->input->post('id') == 23;
$this->input->post('id') == 33;

//La Rochelle
$this->input->post('id') == 22;
$this->input->post('id') == 34;

//Boulay
$this->input->post('id') == 26;
$this->input->post('id') == 35;

//Loisy
$this->input->post('id') == 20;
$this->input->post('id') == 36;

//Meudon
$this->input->post('id') == 16;
$this->input->post('id') == 44;

//Cormeilles
$this->input->post('id') == 24;
$this->input->post('id') == 45;
*/
