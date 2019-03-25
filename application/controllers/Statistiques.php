<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistiques extends CI_Controller {

  public function index()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_group = $_SESSION['id_group'];



      $this->load->view('header');
      $this->load->view('');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function newsletter_opening_count()
  {
    //if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_group = $_SESSION['id_group'];
      $id_newsletter = $this->uri->segment(3, 0);
      $contact = $this->uri->segment(4, 0);

      $data = array(
        'date_heure'    => date('Y-m-d H:i:s'),
        'id_newsletter' => $id_newsletter,
        'id_contact'    => $id_contact,
        'ouverture'     => 1,
      );

      $this->My_common->insert_data('newsletter_statistics', $data);

    /**} else {
        $this->load->view('login');
    }**/
  }

}
