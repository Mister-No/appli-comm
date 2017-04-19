<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller  {


    public function select_all_ent()
  	{
  		if ($_SESSION["is_connect"] == TRUE){

  		$this->load->model('My_entreprises');

        $result = $this->My_entreprises->get_all_ent();

          foreach ($result as $row) {

              $data[] = array('id' => $row->id, 'text' => $row->raison_sociale);

          }

          header('Content-Type: application/json');
          echo json_encode ($data);

      	} else {
          	$this->load->view('login');
      	}
  	}

    public function select_all_cat()
    {
      if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_categories');

        $result = $this->My_categories->get_all_cat();

        foreach ($result as $row) {

            $data[] = array('id' => $row->id, 'text' => $row->titre);

        }

        header('Content-Type: application/json');
        echo json_encode ($data);

        } else {
            $this->load->view('login');
        }
    }


}
