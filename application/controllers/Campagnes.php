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

				$tab_cat = array();
				$tab_child_cat = array();

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

					$result[] = [
					'id' => $row_liste->id,
					'titre' => $row_liste->titre,
					'cat' => $tab_cat,
					];
					$tab_cat = array();

        }

			/* Affichage des catégories pour la creation de listes */

			$result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

			$result_cat = array();

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

				$result_cat[] = [
					'id' => $row->id,
					'titre' => $row->titre,
					'child' => $tab_cat
				];

				}

			/* Informations sur la campagne */

			require(APPPATH.'libraries/Mailin.php');
			$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

			$campagne = $mailin->get_campaigns_v2(array("id" => $id));

    $data = array(
				'result' => $result,
				'result_cat' => $result_cat,
				'campagne' => $campagne['data']
		);

  	$this->load->view('header', $data);
    $this->load->view('campagnes_listes');
    $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
	}

	public function listes_recap()
	{

		if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_listes');
			$this->load->model('My_categories');

			$id_group = $_SESSION["id_group"];

			/* Recherche pour affichage de contact */

			$result = $this->My_listes->get_all_listes($id_group);

			$email_array = array();
			$email_array_cat = array();
			$email_array_list = array();

			function unique_multidim_array($array, $key) {
					$temp_array = array();
					$i = 0;
					$key_array = array();

					foreach($array as $val) {

							if (!in_array($val[$key], $key_array)) {
									$key_array[$i] = $val[$key];
									$temp_array[$i] = $val;
							}
							$i++;
					}
					return $temp_array;
			}

		if (isset($_POST["id_liste"])) {

			foreach ($_POST["id_liste"] as $key => $value) {

				$result_cat = $this->My_listes->get_cat_by_liste($value);

				foreach ($result_cat as $row_cat) {

					$result_contact = $this->My_categories->get_contact_by_cat($row_cat->id_cat);

					foreach ($result_contact as $row_contact) {

						$contact_array_liste[] = array('email' => $row_contact->email,
						 															 'nom' => $row_contact->nom,
																					 'prenom' => $row_contact->prenom
																				 	);

						}

				}

			}

		$contact_array_liste = unique_multidim_array($contact_array_liste,'nom');

		}

		if (isset($_POST["id_cat"])) {

			foreach ($_POST["id_cat"] as $key => $value) {

				$result_cat = $this->My_categories->get_cat_by_id($value);

				foreach ($result_cat as $row_cat) {

					$result_contact = $this->My_categories->get_contact_by_cat($row_cat->id);

					foreach ($result_contact as $row_contact) {

						$contact_array_cat[] = array('email' => $row_contact->email,
						 														 'nom' => $row_contact->nom,
																				 'prenom' => $row_contact->prenom
																			 	);

					}

				}

			}

			$contact_array_cat = unique_multidim_array($contact_array_cat,'nom');

		}

		$contact_array = array_merge($contact_array_liste, $contact_array_cat);

		$email_array = unique_multidim_array($contact_array, 'nom');

		/* Informations sur la campagne */

		require(APPPATH.'libraries/Mailin.php');
		$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

		$campagne = $mailin->get_campaigns_v2( array( "id" => $_POST['id_campagne']) );

		$data = array(
				'campagne' => $campagne['data'],
				'email_array' => $email_array,
		);

		$this->load->view('header', $data);
		$this->load->view('campagnes_recap');
		$this->load->view('footer');

		} else {
				$this->load->view('login');
		}
	}

	public function list_add_recap()
	{
		if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_listes');
			$this->load->model('My_categories');

			//$id_campagne = $this->uri->segment(3, 0);

			$id_group = $_SESSION["id_group"];

			//Ajout d'une liste et redirection vers la recapitulation des contacts pour l'envoi

			$result = $this->My_listes->check_exist($this->input->post('titre'), $id_group);

			if (count($result) > 0) {

				echo 1;

			} else {

				$contact_array_cat = array();
				$liste_tab = array();
				$liste_cat_tab = array();

				$liste_tab = array(
					'titre' => $_POST['titre'],
					'id_group' 	=> $id_group,
				);

				$id = $this->My_common->insert_data ('liste', $liste_tab);

					foreach ($_POST['id_cat'] as $key => $value) {

						$liste_cat_tab = array(
							'id_liste'  => $id,
							'id_cat'    => $value,
						);

						$this->My_common->insert_data('liste_cat', $liste_cat_tab);

						//Recherche pour affichage de contact

						$result_contact = $this->My_categories->get_contact_by_cat($value);

						foreach ($result_contact as $row_contact) {

							$contact_array_cat[] = array(
								'email' => $row_contact->email,
							  'nom' => $row_contact->nom,
							  'prenom' => $row_contact->prenom
							);

						}

					}

			}

			function unique_multidim_array($array, $key) {
				$temp_array = array();
				$i = 0;
				$key_array = array();

				foreach($array as $val) {

						if (!in_array($val[$key], $key_array)) {
								$key_array[$i] = $val[$key];
								$temp_array[$i] = $val;
						}
						$i++;
				}
				return $temp_array;
			}

			$email_array = unique_multidim_array($contact_array_cat,'nom');

			//Informations sur la campagne
			require(APPPATH.'libraries/Mailin.php');
			$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

			$campagne = $mailin->get_campaigns_v2(array( "id" => $_POST['id_campagne']));

			$data = array(
					'campagne' => $campagne['data'],
					'email_array' => $email_array,
			);

			/*echo '<pre>';
			print_r($data);
			echo '</pre>';*/
			$this->load->view('header', $data);
			$this->load->view('campagnes_recap');
			$this->load->view('footer');

		} else {
				$this->load->view('login');
		}


	}

	public function envoyer()
	{
		if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_listes');

			$id_campagne = $_POST["id_campagne"];

			$email_array = array();
			$nom_array = array();


			$csv = "NAME;SURNAME;EMAIL\n";

			foreach ($_POST["email"] as $key => $value) {

                //$csv .= $_POST["nom"][$key].";".$_POST["prenom"][$key].";".$value."\n";
                //echo $key." -    - ". $_POST["nom"][$key].";".$_POST["prenom"][$key].";".$value."\n"."<br>";
				if (isset($_POST["nom"][$key])){
                	$csv .= $_POST["nom"][$key].";".$_POST["prenom"][$key].";".$value."\n";
				} else {
                	$csv .= ";;".$value."\n";
				}
			}

			//echo $csv;

			require(APPPATH.'libraries/Mailin.php');
	      	$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);


		    $data = array(
		        "body" => $csv,
		        "name" => "liste_".$id_campagne,
		    );

		    $result = $mailin->import_users($data);

				var_dump($data);

		    $id_liste = $result["data"]["list_id"][0];

		    $code = $result["code"];


		    if ($code == "success"){

				$data = array(
					"id"				=>$id_campagne,
					"listid"			=>array($id_liste),
					"send_now"			=>1,
					"html_url"			=>"http://coxdigital.fr/newsletter/assets/export_html.php?template_name=maquette&saveCode=".$id_campagne,
				);

								var_dump($data);

				/*$result = $mailin->update_campaign($data);

				$code = $result["code"];

				if ($code == "success"){
					redirect (base_url()."campagnes.html");
				} else {
					print_r($result);
					echo "Erreur";
				}*/

		    }





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

	public function duplicate()
	{

		if ($_SESSION["is_connect"] == TRUE){

			require(APPPATH.'libraries/Mailin.php');
					$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);

			$data = array( "id"=>$this->uri->segment(3, 0) );

			$info = $mailin->get_campaign_v2($data);

			$data = array(
				"category"			=>API_category,
				"from_name"			=>API_from_name,
				"from_email"		=>API_from_email,
				"name"				=>$info["data"][0]["campaign_name"]." - COPIE",
				"html_content"		=>"<html><head></head></html>",
				"html_url"			=>"",
				"listid"			=> "",
				"scheduled_date"	=>"",
				"subject"			=>$info["data"][0]["subject"],
				"reply_to"			=>API_reply_to,
				"to_field"			=>"[PRENOM] [NOM]",
				'exclude_list'		=> array(),
				"attachment_url"	=>"",
				"inline_image"		=>0,
				"mirror_active"		=>1,
				"send_now"			=>0
			);

				$result = $mailin->create_campaign($data);

				file_get_contents('http://coxdigital.fr/newsletter/assets/duplicate_folder.php?folder=maquette&id='.$this->uri->segment(3, 0).'&id_new='.$result["data"]["id"].'&token=unpg-23498674730722840757940');

				redirect (base_url()."campagnes.html");

			} else {
					$this->load->view('login');
			}
	}

	public function delete()
	{

		if ($_SESSION["is_connect"] == TRUE){

			require(APPPATH.'libraries/Mailin.php');

				$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);
      	$data = array( "id"=>$this->input->post('id') );
      	$mailin->delete_campaign($data);

      	file_get_contents('http://coxdigital.fr/newsletter/assets/delete_folder.php?folder=maquette&id='.$this->input->post('id').'&token=unpg-23498674730722840757940');

			redirect('campagnes');

    	} else {
        	$this->load->view('login');
    	}
	}

}
