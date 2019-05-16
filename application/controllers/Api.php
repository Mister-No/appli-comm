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

		var_dump ($_POST);

	}

}
