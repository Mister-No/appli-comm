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

    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

			$this->load->model('My_users');

          $id = $this->uri->segment(3, 0);

	        $result = $this->My_users->get_user($id);

          foreach ($result as $row) {

            if ($row->admin == 1) { $checked_admin = 'checked="checked"'; }
            if ($row->admin == 0) { $checked_admin = ''; }
            if ($row->actif == 1) { $checked_actif = 'checked="checked"'; }
            if ($row->actif == 0) { $checked_actif = ''; }

          }

	       $data = array(
            'result' => $result,
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

			$result = $this->My_users->check_exist($this->input->post('email'), $this->input->post('nom'), $this->input->post('login'));

      $id_group = $_SESSION['id_group'];

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

          $password = crypt($this->input->post('password'), $this->input->post('login'));

				$data = array(
          'id_group' 	  => $id_group,
          'login' 		  => $this->input->post('login'),
					'password' 	  => $password,
					'email' 			=> $this->input->post('email'),
          'nom' 				=> $this->input->post('nom'),
					'prenom' 			=> $this->input->post('prenom'),
					'rang' 			  => $this->input->post('rang'),
					'admin' 			=> $admin,
          'actif' 			=> $actif,
				);

	        $insert_data = $this->My_common->insert_data('users', $data);

	        echo "Ok";
		    }

    	} else {
        	echo 2;
    	}

	}

  public function update()
	{

    if ($_SESSION['is_connect'] == TRUE && $_SESSION['is_admin'] == 1){

    $result = $this->My_users->check_exist($this->input->post('email'), $this->input->post('nom'));

    //if (count($result) > 0){



     //} else {

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

       $password = crypt($this->input->post('password'), $this->input->post('login'));

       $data = array(
         'id' 		    => $this->input->post('id'),
         'login' 		  => $this->input->post('login'),
         'password' 	=> $password,
         'email' 			=> $this->input->post('email'),
         'nom' 				=> $this->input->post('nom'),
         'prenom' 	  => $this->input->post('prenom'),
         'rang' 			=> $this->input->post('rang'),
         'admin' 			=> $admin,
         'actif' 			=> $actif,
       );

       $this->My_common->update_data('users','id', $this->input->post('id'), $data);

       redirect('users');

    //}

    } else {
        $this->load->view('login');
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
