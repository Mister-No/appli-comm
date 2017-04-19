<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index()
	{
		$this->load->view('login');
	}


	public function pass()
	{
		$this->load->view('login_pass');
	}

	// fonction pour se logger et être rediriger vers la partie client.
	public function verifier(){

    $this->load->model('My_common');

    $result = $this->My_common->login($this->input->post('username'),$this->input->post('passwrd'));

		if($result){

			foreach($result as $row) {

				$_SESSION["is_connect"] = TRUE;
				$_SESSION["user_id"] = $row->id;
        $_SESSION["id_group"] = $row->id_group;
				$_SESSION["is_admin"] = $row->admin;
				$_SESSION["user_nom"] = $row->nom." ".$row->prenom;

				echo 1;
			}

		} else {

			echo 0;
		}

	}

	public function retrouver_verifier()
	{

		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

    $this->load->model('My_common');

    $result_login = $this->My_common->login_recup($this->input->post('email'));


		if ($result_login == false){
			echo "Erreur";
		} else {

			foreach ($result_login as $row){
				$login = $row->email;
				$pass = $row->password;
			}

    		$message = "Bonjour,<br /><br />Vous recevez ce courriel parce qu'un adhérent souhaite connaître son mot de passe.<br /><br />Voici les identifiants associés à son compte :<br /><br />";
    		$message.= "<b>Identifiant</b> : ".$login."<br />";
    		$message.= "<b>Mot de passe</b> : ".$pass."<br />";
    		$message.= "<br /><br />Merci !";

    		$this->load->library('email');

    		$config['charset'] = 'utf-8';
    		$config['wordwrap'] = TRUE;
    		$config['mailtype'] = 'html';

    		$this->email->initialize($config);

    		$this->email->clear();

    		$this->email->from('syndicat@sned.ffbatiment.fr', 'SNED');
    		$this->email->to('syndicat@sned.ffbatiment.fr');
    		//$this->email->to('pierre.atman@gmail.com');

    		$this->email->subject('Ivestigo - Récupération de mot de passe');
    		$this->email->message($message);

    		$this->email->send();

			echo "ok";
		}

	}


	public function logout(){

		session_destroy();

		redirect(base_url());

	}

}
