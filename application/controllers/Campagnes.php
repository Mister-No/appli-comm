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

      $id_group = $_SESSION["id_group"];

          $result_liste = $this->My_listes->get_all_listes($id_group);

        //  foreach ($result_liste as $row_liste) {

              $result_cat_parent = $this->My_categories->get_all_parent_cat($id_group);

              foreach ($result_cat_parent as $row_cat_parent) {

                $result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id);

                foreach ($result_cat_child as $row_cat_child) {

                    $tab_cat[] = [
                    'id' => $row_cat_child->id,
                    'titre' => $row_cat_child->titre,
                    ];

                }

                $result[] = [
                  'id' => $row_cat_parent->id,
                  'titre' => $row_cat_parent->titre,
                	'cat' => $tab_cat,
                ];
                $tab_cat = array();
              }

            /*  $result[] = [
                'id' => $row_liste->id,
                'titre' => $row_liste->titre,
                'cat' => $tab_cat,
              ];*/


        //  }

          $data = array(
              "result" => $result,
          );

					/*echo '<pre>';
					print_r($result);
					echo '</pre>';*/

        $this->load->view('header', $data);
          $this->load->view('campagnes_listes');
          $this->load->view('footer');

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
