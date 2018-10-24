<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Builder extends CI_Controller {

  public function index()
  {
    if ($_SESSION["is_connect"] == TRUE){



      $this->load->view('header');
      $this->load->view('builder');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function campagne_creer()
  {
    if ($_SESSION["is_connect"] == TRUE){



      $this->load->view('header');
      $this->load->view('builder_creer');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

}
