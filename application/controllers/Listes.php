<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listes extends CI_Controller {

  public function index()
	{
		if ($_SESSION['is_connect'] == TRUE){

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
          'result' => $result,
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

    if ($_SESSION['is_connect'] == TRUE){

      $id_group = $_SESSION["id_group"];

      $this->load->model('My_listes');
      $this->load->model('My_categories');
      $this->load->model('My_users');

      $tab_cat = array();
      $tab_cat_child = array();
      $result = array();
      $data = array();

      $result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

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
          'result' => $result
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
      $tab_cat = array();
      $tab_cat_child = array();
      $result = array();
      $data = array();

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
            'id_sib' => $row_liste->id_sib,
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

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_listes');
      $this->load->model('My_categories');
      $this->load->model('My_users');

      $id_group = $_SESSION["id_group"];
      $data = array();
      $data_liste = array();
      $data_liste_sib1 = array();
      $data_liste_sib2 = array();
      $data_cat = array();
      $data_temp = array();
      $data_users = array();

      if ($this->input->post('titre') != '' && $this->input->post('id_cat') != '') {

        $result = $this->My_listes->check_exist($this->input->post('titre'), $id_group);
        
        if (count($result) > 0) {

             echo 1;

          } else {

          // Enregistrement de la liste chez send in blue

          $infos_group = $this->My_users->get_group_infos($id_group);
          
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists?limit=10&offset=0",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "accept: application/json",
              "api-key: ".$infos_group[0]->api_sib_key
            ),
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          $list_total = 150;

          $response = json_decode ($response);

          if (isset ($response->count)){
            $list_total = $response->count;
          }

          if ($list_total < 150) {

            $data_liste_sib1 = array(
             "name" => $_POST['titre'],
             "folderId" => $infos_group[0]->liste_parent_sib,
            );
            $data_liste_sib1 = json_encode ($data_liste_sib1, JSON_NUMERIC_CHECK);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data_liste_sib1,
              CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "api-key: ".$infos_group[0]->api_sib_key,
                "content-type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            $response = json_decode ($response);

          

            if (isset($response->id)) {

              // Enregistrement de la liste en base

              $data_liste = array(
                'id_sib'  => $response->id,
                'titre' => $_POST['titre'],
                'id_group' 	=> $id_group,
              );

              $id = $this->My_common->insert_data ('liste', $data_liste);

              foreach ($_POST['id_cat'] as $key => $value) {

                $data_cat = array(
                  'id_liste'  => $id,
                  'id_cat'    => $value,
                );

                $this->My_common->insert_data('liste_cat', $data_cat);

                $result_contacts = $this->My_categories->get_mail_contact_by_cat($value);

                foreach ($result_contacts as $row_user) {

                  $data_users[]=$row_user->email;

                }

              }

              // Enregistrement des contacts dans la liste send in blue
              $data_liste_sib2 = array(
               "emails"  => $data_users,
              );

              $data_liste_sib2 = json_encode ($data_liste_sib2);

              $curl = curl_init();

              curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$response->id."/contacts/add",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_liste_sib2,
                CURLOPT_HTTPHEADER => array(
                  "accept: application/json",
                  "api-key: ".$infos_group[0]->api_sib_key,
                  "content-type: application/json"
                ),
              ));
              
              $response = curl_exec($curl);
              $err = curl_error($curl);
              
              curl_close($curl);
              
              echo 'ok';

            } else {

              echo 11;

            }

          } else {

            echo 13;

          }

        }

      } else {

        echo 9;

      }

    } else {

      echo 3;

    }
  }

  public function delete()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_listes');
      $this->load->model('My_categories');
      $this->load->model('My_users');

      $id_group = $_SESSION["id_group"];
      $result_liste = $this->My_listes->get_liste_by_id($this->input->post('id'));

      // Suppression de la liste chez send in blue

      $infos_group = $this->My_users->get_group_infos($id_group);

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$result_liste[0]->id_sib,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json",
          "api-key: ".$infos_group[0]->api_sib_key
        ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      $response = json_decode ($response);

      if (!isset($response->code)) {

        $this->My_common->delete_data('liste', $this->input->post('id'));
        $this->db->delete('liste_cat', array('id_liste' => $this->input->post('id')));

        echo 'ok';

      } else {

        echo 11;

      }

    } else {
          $this->load->view('login');
    }

  }

  public function update()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_listes');
      $this->load->model('My_categories');
      $this->load->model('My_users');

      $id_group = $_SESSION["id_group"];
      $data = array();
      $data_liste = array();
      $data_liste_sib1 = array();
      $data_liste_sib2 = array();
      $data_cat = array();
      $data_temp = array();
      $data_users = array();

      if ($this->input->post('titre') != '' && $this->input->post('id_cat') != '') {

        $result = $this->My_listes->check_exist($this->input->post('titre'), $id_group, $this->input->post('id'));

        if (count($result) > 0) {

            echo 1;

          } else {

            // Update de la liste chez send in blue

            $infos_group = $this->My_users->get_group_infos($id_group);

            $data_liste_sib1 = array(
              "name" => $this->input->post('titre'),
            );

            $data_liste_sib1 = json_encode ($data_liste_sib1);
 
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$this->input->post('id_sib'),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS => $data_liste_sib1,
              CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "api-key: ".$infos_group[0]->api_sib_key,
                "content-type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            

            // Update de la liste en base
            $data_liste = array(
              'titre' => $this->input->post('titre'),
              'id_group' 	=> $id_group,
            );

            $this->My_common->update_data ('liste', 'id', $this->input->post('id'), $data_liste);

            // Suppression de tous les users de la liste send in blue

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$this->input->post('id_sib')."/contacts/remove",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\"all\":true}",
              CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "api-key: ".$infos_group[0]->api_sib_key,
                "content-type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            // Suppression des categories rattachées a la liste en base
            $this->db->delete('liste_cat', array('id_liste' => $this->input->post('id')));

            // Ajout des users dans la liste send in blue et en base
            foreach ($_POST['id_cat'] as $key => $value) {

              $data_cat = array(
                'id_liste'  => $this->input->post('id'),
                'id_cat'    => $value,
              );

              $this->My_common->insert_data('liste_cat', $data_cat);

              $result_contacts = $this->My_categories->get_mail_contact_by_cat($value);

              foreach ($result_contacts as $row_user) {

                $data_users[]=$row_user->email;

              }

            }

            $data_liste_sib3 = array(
              "emails"  => $data_users,
            );

            $data_liste_sib3 = json_encode ($data_liste_sib3);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$this->input->post('id_sib')."/contacts/add",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data_liste_sib3,
              CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "api-key: ".$infos_group[0]->api_sib_key,
                "content-type: application/json"
              ),
            ));
             
            $response = curl_exec($curl);
            $err = curl_error($curl);
             
            curl_close($curl);

            echo 'ok';

          }

        } else {

          echo 9;

        }

      } else {

        echo 3;

      }

  }

}
