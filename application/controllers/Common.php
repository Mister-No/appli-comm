<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller  {


  public function select_all_ent()
	{
		if ($_SESSION['is_connect'] == TRUE){

		$this->load->model('My_entreprises');

      $id_group = $_SESSION['id_group'];

      /**if ($id_group == 0) {
        $id_group = 'rien';
      }**/

      $result = $this->My_entreprises->get_all_ent($id_group);

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
    if ($_SESSION['is_connect'] == TRUE){

    $this->load->model('My_categories');

      $id_group = $_SESSION['id_group'];

      $result = $this->My_categories->get_all_cat($id_group);

      foreach ($result as $row) {

          $data[] = array('id' => $row->id, 'text' => $row->titre);

      }

      header('Content-Type: application/json');
      echo json_encode ($data);

      } else {
          $this->load->view('login');
      }
  }

  public function select_all_parent_cat()
  {
    if ($_SESSION['is_connect'] == TRUE){

    $this->load->model('My_categories');

      $id_group = $_SESSION['id_group'];

      $result = $this->My_categories->get_all_parent_cat($id_group);

      foreach ($result as $row) {

          $data[] = array('id' => $row->id, 'text' => $row->titre);

      }

      header('Content-Type: application/json');
      echo json_encode ($data);

      } else {
          $this->load->view('login');
      }
  }

  public function select_all_group()
  {
    if ($_SESSION['is_connect'] == TRUE){

    $this->load->model('My_users');

    $result = $this->My_users->get_all_group();

      foreach ($result as $row) {

          $data[] = array(
            'id'         => $row->id_group,
            'text'       => $row->nom_group,
          );

      }

      header('Content-Type: application/json');
      echo json_encode ($data);

      } else {
          $this->load->view('login');
      }
  }

  public function select_all_succursale()
  {
    if ($_SESSION['is_connect'] == TRUE){

    $this->load->model('My_users');

      $id_group = $_SESSION['id_group'];

      $result = $this->My_users->get_all_succursales($id_group);

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
