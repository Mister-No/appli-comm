<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_builder');

			$result_campagnes = $this->My_builder->get_all_campagnes();

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
