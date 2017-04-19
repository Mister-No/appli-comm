<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listes extends CI_Controller {

  public function index()
	{
		if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_listes');

      $id_group = $_SESSION["id_group"];

      $result_list = $this->My_listes->get_all_listes($id_group);

      $result = array();

      foreach ($result_list as $row) {

          $result_cat = $this->My_listes->get_cat_by_liste($row->id);

          $cat = '';
          $count_email = array();

          foreach ($result_cat as $row_cat) {
            $cat .=  $row_cat->titre.' / ';

            $result_cont = $this->My_listes->get_contact_by_cat($row_cat->id_cat);

            foreach ($result_cont as $row_cont) {
              array_push($count_email, $row_cont->email);
            }

          }

          $all_cat = substr($cat, 0, -3);
          $all_cat = (strlen($all_cat) > 84) ? substr($all_cat,0,84). ' ... ' : $all_cat;
          $nbre_email = count(array_unique($count_email));

          $temp = array (
              'id' => $row->id,
              'titre' => $row->titre,
              'categories' => $all_cat,
              'nbre_contact' => $nbre_email
            );

          array_push ($result, $temp);
        }

      $data = array(
          "result" => $result,
      );

			$this->load->view('header', $data);
      $this->load->view('listes');
      $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function ajouter()
  {

    if ($_SESSION["is_connect"] == TRUE){

      $id_group = $_SESSION["id_group"];

      $this->load->model('My_categories');

          $result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

          $result = array();

          foreach ($result_cat_parent as $row) {

            $result_cat_child = $this->My_categories->get_child_cat($row->id);

            $tab_cat = array();
            foreach ($result_cat_child as $row_cat) {
              $tab_cat[] = [
                'id' => $row_cat->id,
                'id_parent' => $row_cat->id,
                'titre' => $row_cat->titre
              ];
            }

            $result[] = [
              'id' => $row->id,
              'titre' => $row->titre,
              'child' => $tab_cat
            ];

            }

          $data = array(
              "result" => $result
          );

          $this->load->view('header', $data);
          $this->load->view('listes_ajouter');
          $this->load->view('footer');

    } else {
          $this->load->view('login');
    }
  }

  public function modifier()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_categories');
      $this->load->model('My_listes');

      $id = $this->uri->segment(3, 0);

      $id_group = $_SESSION["id_group"];

          $result_liste = $this->My_listes->get_liste_by_id($id);

          foreach ($result_liste as $row_liste) {

              $result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

              foreach ($result_cat_parent as $row_cat_parent) {

                $checked = '';
                $checked_cat_parent = '';
                $checked_cat_parent = $this->My_listes->get_cat_liste_by_id($row_liste->id, $row_cat_parent->id);
                if (count($checked_cat_parent)>0){ $checked = 'checked'; }

                $result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id);

                foreach ($result_cat_child as $row_cat_child) {

                  $checked_cat = '';
                  $checked_cat_child = '';
                  $checked_cat_child = $this->My_listes->get_cat_liste_by_id($row_liste->id, $row_cat_child->id);
                  if (count($checked_cat_child)>0){ $checked_cat = 'checked'; }

                    $tab_cat_child[] = [
                    'id' => $row_cat_child->id,
                    'titre' => $row_cat_child->titre,
                    'check_cat_child' => $checked_cat
                  ];

                }

                $tab_cat[] = [
                  'id' => $row_cat_parent->id,
                  'titre' => $row_cat_parent->titre,
                  'check_cat_parent' => $checked,
                  'tab_cat_child' => $tab_cat_child,
                ];
                $tab_cat_child = array();
              }

              $result[] = [
                'id' => $row_liste->id,
                'titre' => $row_liste->titre,
                'checked' => $checked,
                'cat' => $tab_cat,
              ];


          }

          $data = array(
              "result" => $result,
          );

          $this->load->view('header', $data);
          $this->load->view('listes_modifier');
          $this->load->view('footer');

      } else {
          $this->load->view('login');
      }
  }

  public function add()
  {

    if ($_SESSION["is_connect"] == TRUE){

      $data = array(
        "titre" => $_POST["titre"],
      );

          $id = $this->My_common->insert_data ("liste", $data);

          foreach ($_POST["id_cat"] as $key => $value) {

            $data = array(
              "id_liste" => $id,
              "id_cat" => $value,
            );

        $this->My_common->insert_data ("liste_cat", $data);
          }

      redirect('listes');

    } else {
          $this->load->view('login');
    }
  }

  public function delete()
  {

    if ($_SESSION["is_connect"] == TRUE){

      $this->My_common->delete_data("liste", $this->input->post('id'));
      $this->db->delete("liste_cat", array('id_liste' => $this->input->post('id')));

      redirect('listes');

    } else {
          $this->load->view('login');
    }

  }

  public function update()
  {

    if ($_SESSION["is_connect"] == TRUE){


      $this->My_common->delete_data("liste", $this->input->post('id'));
      $this->db->delete("liste_cat", array('id_liste' => $this->input->post('id')));

      $data = array(
        "titre" => $_POST["titre"],
      );

      $id = $this->My_common->insert_data ("liste", $data);

      foreach ($_POST["id_cat"] as $key => $value) {

        $data = array(
          "id_liste" => $id,
          "id_cat" => $value,
        );

        $this->My_common->insert_data ("liste_cat", $data);
      }

      redirect('listes');


      } else {
          $this->load->view('login');
      }

  }

}
