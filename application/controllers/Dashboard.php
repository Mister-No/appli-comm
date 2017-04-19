<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

		if ($_SESSION["is_connect"] == TRUE){
			$this->load->view('header');
      $this->load->view('dashboard');
      $this->load->view('footer');
  	} else {
      	$this->load->view('login');
  	}
	}

}
