<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campagnes extends CI_Controller {

	// Afficher la liste des campagnes
	public function index()
	{
		if ($_SESSION["is_connect"] == TRUE){

			require(APPPATH.'libraries/Mailin.php');
	      	$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

			$data = array(
				"type" => "",
				"status" => "",
			);

			$result = $mailin->get_campaigns_v2($data);

	        $data = array(
	            "result" => $result,
	        );
				/*echo '<pre>';
				print_r($data);
				echo '</pre>';*/
					$this->load->view('header', $data);
	        $this->load->view('campagnes');
	        $this->load->view('footer');


    	} else {
        	$this->load->view('login');
    	}
	}

	public function listes()
	{
		if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_categories');
      $this->load->model('My_listes');

			$id = $this->uri->segment(3, 0);

      $id_group = $_SESSION["id_group"];

        $result_liste = $this->My_listes->get_all_listes($id_group);

          foreach ($result_liste as $row_liste) {

						$result_parent_cat = $this->My_listes->get_cat_parent_by_liste($row_liste->id);

            foreach ($result_parent_cat as $row_parent_cat) {

						 $result_child_cat = $this->My_categories->get_child_cat($row_parent_cat->id);

						 foreach ($result_child_cat as $row_child_cat) {

							 $tab_child_cat[] = [
								 'id' => $row_child_cat->id,
								 'titre' => $row_child_cat->titre,
								];

						 }

					 $tab_cat[] = [
              'id' => $row_parent_cat->id,
              'titre_cat_parent' => $row_parent_cat->titre,
						'child_cat' => $tab_child_cat
             ];
					 $tab_child_cat = array();

        	 }

					$liste[] = [
					'id' => $row_liste->id,
					'titre' => $row_liste->titre,
					'cat' => $tab_cat,
					];
					$tab_cat = array();

        }

			echo '<pre>';
			print_r($liste);
			echo '</pre>';

			require(APPPATH.'libraries/Mailin.php');
			$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

			$campagne = $mailin->get_campaigns_v2( array( "id" => $id) );

    /*$data = array(
        "result" => $result,
				'campagne' => $campagne["data"]
		);*/

  	/*$this->load->view('header', $data);
    $this->load->view('campagnes_listes');
    $this->load->view('footer');*/

    } else {
        $this->load->view('login');
    }
	}

	public function listes_recap()
	{
		if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_listes');
			$this->load->model('My_categories');

			$id = $this->uri->segment(3, 0);

			$id_group = $_SESSION["id_group"];

			$result = $this->My_listes->get_all_listes($id_group);

			/*$email_array = array();
			$nom_array = array();
			$prenom_array = array();*/

			foreach ($_POST["id_liste"] as $key => $value) {

				$result_cat = $this->My_listes->get_cat_by_liste($value);

				foreach ($result_cat as $row_cat) {

					$result_contact = $this->My_categories->get_contact_by_cat($row_cat->id_cat);

					foreach ($result_contact as $row_contact) {
						var_dump($row_contact->email);
						/*$found = 0;
						foreach ($email_array as $key => $value) {
							if($value[0] == $row_contact->email) {
								$found = 1;
							}
						}

						if ($found == 0){
													array_push($email_array, array($row_contact->email, $row_contact->nom, $row_contact->prenom) );
											}*/

										}

								}

			}



					/*$data = array(
							"id_campagne" => $id_campagne,
							"email_array" => $email_array,
					);*/



					/*$this->load->view('header', $data);
					$this->load->view('campagnes_recap');
					$this->load->view('footer');*/





			} else {
					$this->load->view('login');
			}
	}

	public function add()
	{

		if ($_SESSION["is_connect"] == TRUE){

			require(APPPATH.'libraries/Mailin.php');
					$mailin = new Mailin("https://api.sendinblue.com/v2.0",'Q8ySqdN5p4BOG6CH');

					var_dump ($mailin);

			$data = array(
				"category"=>"",
        "from_name"=>"",
        "from_email"=>"pierre.atman@gmail.com",
        "name"=>"My Campaign 1",
        "bat"=>"pierre.atman@gmail.com",
        "html_content"=>"<html><head></head></html>",
        "html_url"=>"",
        "listid"=> array(),
        "scheduled_date"=>"",
        "subject"=>"My subject",
        "reply_to"=>"pierre.atman@gmail.com",
        "to_field"=>"[PRENOM] [NOM]",
        'exclude_list'=> array(),
        "attachment_url"=>"",
        "inline_image"=>0,
        "mirror_active"=>0,
        "send_now"=>0,
        "utm_campaign"=>"My UTM Value1"
			);


			var_dump ($data);

				$result = $mailin->create_campaign($data);

				var_dump ($result);

				//redirect (base_url()."campagnes.html");


			} else {
					$this->load->view('login');
			}
	}


}
