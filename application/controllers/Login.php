<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index()
	{
		$this->load->view('login');
	}

	public function verifier(){

    // Mise en place des regles de verification du formulaire :
    $this->form_validation->set_rules('username', 'Login', 'trim|required|min_length[3]|max_length[40]');
    $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[4]|max_length[40]');

    if ($this->form_validation->run() == FALSE) {

			// Retourne l'erreur si les regles ne sont pas respectées :
      //echo validation_errors('<div class="error">', '</div>');

		} else {

      $this->load->model('My_common');

      $result = $this->My_common->login($this->input->post('username'), $this->input->post('password'));

  		if(count($result) == 1){

  			foreach($result as $row) {

  				$_SESSION['is_connect'] = TRUE;
  				$_SESSION['user_id'] = $row->id;
          $_SESSION['id_group'] = $row->id_group;
          $_SESSION['id_succursale'] = $row->id_succursale;
  				$_SESSION['is_admin'] = $row->admin;
          $_SESSION['rang'] = $row->rang;
  				$_SESSION['user_nom'] = $row->nom." ".$row->prenom;

          $this->load->model('My_users');

          $result_group = $this->My_users->get_user_group($row->id_group);

          foreach($result_group as $row_group) {

            $_SESSION['group'] = $row_group->nom_group;

          }

  				echo 'ok';
  			}

  		} else {

        echo 2;

  		}

    }

	}


	public function password()
	{

		$this->load->view('login_password');

	}

	public function recup_password()
	{

    $this->load->model('My_users');

    $result = $this->My_users->check_exist($this->input->post('email'));

    if (count($result) == 0) {

      echo 6;

    } else {

      foreach ($result as $row) {
        $id = $row->id;
        $email = $row->email;
        $nom = $row->nom;
        $prenom = $row->prenom;
        $login = $row->login;
      }

      $password = mt_rand();

      $crypt_password = sha1($password);

       $data = array(
          'password'  => $crypt_password,
       );

      $this->My_common->update_data('users','id', $id, $data);

      $this->load->library('email');

      $config['charset'] = 'utf-8';
      $config['wordwrap'] = TRUE;
      $config['mailtype'] = 'html';

      $this->email->initialize($config);

      $message =
      '<html>
      <head><title>Shuttle</title></head>
      <body>
        <div style="padding:5px; width:600px; background-color:#cccccc; border:#333333 2px solid;">
        <div>
          <img src="'.base_url().'assets/img/logo.png" alt="logo" />
        </div>
          <div>
            <h3 style="color:#ffffff;">Bonjour' . $prenom . ' ' . $nom . '</h3>
            <div>
              <p style="color:#ffffff;">Voici votre login :<strong>'.$login.'</strong></p>
              <p style="color:#ffffff;">Voici votre code de recuperation : <strong>' . $password . '</strong></p>
           </div>
          </div>
        </div>
      </body>
      </html>';

      $this->email->clear();

      $this->email->from('contact@shuttle.fr', 'Shuttle');
      $this->email->to($this->input->post('email'));

      $this->email->subject('Récupération de mot de passe');
      $this->email->message($message);

      $this->email->send();

      echo 7;

    }

	}


	public function logout(){

		session_destroy();

		redirect(base_url());

	}

}
