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

		$this->load->model('My_contacts');

		$id_group = 2;

		$check_contact = $this->My_contacts->check_exist($this->input->post('email'), $id_group);

		if (count($check_contact) == 0) {

			$data_contacts = array(
				'id_group' 		 => $id_group,
				'email'				 => $this->input->post('email'),
				'blacklist'	 	 => $this->input->post('newslatter'),
			);

			$id_contact = $this->My_common->insert_data("contacts", $data_contacts);

			$data_contacts_cat = array(
				'id_cat' 			 => $this->input->post('id'),
				'id_contact' 		 => $id_contact,
			);

			$this->My_common->insert_data("contacts_cat", $data_contacts_cat);

			echo 'add';

		} else {

			$data_contacts = array(
				'email'				 => $this->input->post('email'),
				'blacklist'	 	 => $this->input->post('newslatter'),
			);

			$this->My_common->update_data("contacts", 'id', $check_contact[0]->id, $data_contacts);

			$check_cat_contact = $this->My_contacts->check_contact_cat($this->input->post('id'), $check_contact[0]->id);

			if (count($check_cat_contact) == 0) {

				$data_contacts_cat = array(
					'id_cat' 			 	 => $this->input->post('id'),
					'id_contact' 		 => $check_contact[0]->id,
				);

				$this->My_common->insert_data("contacts_cat", $data_contacts_cat);

			}

			echo 'update';

		}

	}

}
