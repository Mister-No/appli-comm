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
