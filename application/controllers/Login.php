<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index()
	{
		$this->load->view('login');
	}

	public function verifier(){

    $this->load->model('My_common');

    $result = $this->My_common->login($this->input->post('username'),$this->input->post('password'));

		if($result){

			foreach($result as $row) {

				$_SESSION['is_connect'] = TRUE;
				$_SESSION['user_id'] = $row->id;
        $_SESSION['id_group'] = $row->id_group;
				$_SESSION['is_admin'] = $row->admin;
        $_SESSION['rang'] = $row->rang;
				$_SESSION['user_nom'] = $row->nom." ".$row->prenom;

				echo 'ok';
			}

		} else {

			echo 2;
		}

	}


	public function password()
	{

		$this->load->view('login_password');

	}

	public function verifier()
	{

    $this->load->model('My_users');

    $result = $this->My_users->check_exist($this->input->post('email'));

    if (count($result) > 0) {

      echo 6;

    } else {



      echo 7;

    }

	}


	public function logout(){

		session_destroy();

		redirect(base_url());

	}

}
