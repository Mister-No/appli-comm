<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller  {

  public function index()
	{
  if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

			$this->load->model('My_users');

          $id_group = $_SESSION['id_group'];

	        $result_users = $this->My_users->get_all_users($id_group);

          $users = array();

          foreach ($result_users as $row) {

            $users[] = [
              'id'    => $row->id,
              'login' => $row->login,
              'password' => $row->password,
              'email' => $row->email,
              'nom' => $row->nom,
              'prenom' => $row->prenom,
            ];
          }

	       $data = array(
	            'users' => $users,
	        );

          $this->load->view('header', $data);
	        $this->load->view('users');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function erreur()
  {
    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

      $this->load->view('header');
      $this->load->view('contacts_erreur');
      $this->load->view('footer');

      } else {
          $this->load->view('login');
      }
  }

  public function ajouter()
	{

    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

          $this->load->view('header');
	        $this->load->view('users_ajouter');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}

	}

  public function modifier()
  {

    if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_users');

        $id = $this->uri->segment(3, 0);
        $id_group = $_SESSION["id_group"];

        $result = $this->My_users->get_user($id);

        //$result_users = $this->My_users->get_all_users($id_group);

        foreach ($result as $row) {

          if ($row->admin == 1) { $checked_admin = 'checked="checked"'; }
          if ($row->admin == 0) { $checked_admin = ''; }
          if ($row->actif == 1) { $checked_actif = 'checked="checked"'; }
          if ($row->actif == 0) { $checked_actif = ''; }

        }

        /*foreach ($result_users as $row_users) {
          $tab_users[] = $row_users->id;
        }*/

       $data = array(
          //'tab_ent'       => $tab_ent,
          'result'        => $result,
          'checked_admin' => $checked_admin,
          'checked_actif' => $checked_actif,
        );

        $this->load->view('header', $data);
        $this->load->view('users_modifier');
        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}

  }

  public function add()
	{

		if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

			$this->load->model('My_users');

      $id_group = $_SESSION["id_group"];
      $entreprise = $_SESSION["entreprise"];

			$result = $this->My_users->check_exist($this->input->post('email'), $this->input->post('login'), $id_group);

			if (count($result) > 0){

		       echo 1;

		    } else {

          if ($this->input->post('admin') == 'on') {
            $admin = 1;
          } else {
            $admin = 0;
          }

          if ($this->input->post('actif') == 'on') {
            $actif = 1;
          } else {
            $actif = 0;
          }

          $password = sha1($this->input->post('password'));

  				$data = array(
            'id_group' 	  => $id_group,
            'login' 		  => $this->input->post('login'),
  					'password' 	  => $password,
  					'email' 			=> $this->input->post('email'),
            'nom' 				=> $this->input->post('nom'),
  					'prenom' 			=> $this->input->post('prenom'),
            //'entreprise'  => $entreprise,
  					'rang' 			  => $this->input->post('rang'),
  					'admin' 			=> $admin,
            'actif' 			=> $actif,
  				);

	        $insert_data = $this->My_common->insert_data('users', $data);

	        echo "ok";
		    }

    	} else {

        echo 3;

    	}

	}

  public function update()
	{

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_users');

      $id_group = $_SESSION["id_group"];

			$result = $this->My_users->check_exist($this->input->post('email'), $this->input->post('login'), $id_group, $this->input->post('id'));

      if (count($result) > 0) {

        echo 1;

       } else {

         if ($this->input->post('admin') == 'on') {
           $admin = 1;
         } else {
           $admin = 0;
         }

         if ($this->input->post('actif') == 'on') {
           $actif = 1;
         } else {
           $actif = 0;
         }

         $data = array(
           'id' 		    => $this->input->post('id'),
           'id_group'   => $this->input->post('id_group'),
           'login' 		  => $this->input->post('login'),
           'email' 			=> $this->input->post('email'),
           'nom' 				=> $this->input->post('nom'),
           'prenom' 	  => $this->input->post('prenom'),
           'rang' 			=> $this->input->post('rang'),
           'admin' 			=> $admin,
           'actif' 			=> $actif,
         );

         $this->My_common->update_data('users','id', $this->input->post('id'), $data);

         if ($_SESSION['is_admin'] == 1 && $_SESSION['user_id'] == 1) {

           $_SESSION["id_group"] = $this->input->post('id_group');

           $result = $this->My_users->get_all_users($_SESSION["id_group"]);

           foreach ($result as $row) {

             $_SESSION['entreprise'] =  $row->entreprise;
             $data = array(
               'id' 		    => $this->input->post('id'),
               'entreprise' => $row->entreprise,
             );

             $this->My_common->update_data('users','id', $this->input->post('id'), $data);
           }

         }

         echo "ok";

      }

    } else {

      echo 3;

    }

	}

  public function update_password()
  {
    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

      if ($this->input->post('password') != $this->input->post('password_confirm')) {

        echo 4;

      } else {

      $password = sha1($this->input->post('password'));

      $data = array(
        'id' 		    => $this->input->post('id'),
        'password' 	=> $password,
      );

      $this->My_common->update_data('users','id', $this->input->post('id'), $data);

      echo 5;

      }

    } else {

      echo 3;

    }
  }

  public function delete()
  {

    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

          $this->My_common->delete_data('users', $this->input->post('id'));

      redirect('users');

      } else {
          $this->load->view('login');
      }

  }

}
