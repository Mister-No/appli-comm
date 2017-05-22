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
					$mailin = new Mailin("https://api.sendinblue.com/v2.0",API_key);


			$data = array(
				"category"			=>API_category,
				"from_name"			=>API_from_name,
				"from_email"		=>API_from_email,
				"name"				=>$this->input->post('name'),
				"html_content"		=>"<html><head></head></html>",
				"html_url"			=>"",
				"listid"			=> "",
				"scheduled_date"	=>"",
				"subject"			=>$this->input->post('subject'),
				"reply_to"			=>API_reply_to,
				"to_field"			=>"[PRENOM] [NOM]",
				'exclude_list'		=> array(),
				"attachment_url"	=>"",
				"inline_image"		=>0,
				"mirror_active"		=>1,
				"send_now"			=>0
			);

				$mailin->create_campaign($data);

				redirect (base_url()."campagnes.html");


			} else {
					$this->load->view('login');
			}
	}


}
