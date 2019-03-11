<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_campagnes');
			$id_group = $_SESSION['id_group'];

			$result_campagnes = $this->My_campagnes->get_unsent_campagnes($id_group);

			$data = array(
				'result_campagnes' => $result_campagnes,
			);

			$this->load->view('header', $data);
      $this->load->view('dashboard');
      $this->load->view('footer');

  	} else {

      	$this->load->view('login');

  	}
	}

}
