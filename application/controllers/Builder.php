<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Builder extends CI_Controller {

  public function index()
  {
    if ($_SESSION["is_connect"] == TRUE){



      $this->load->view('header');
      $this->load->view('builder');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function campagne_creer()
  {
    if ($_SESSION["is_connect"] == TRUE){



      $this->load->view('header');
      $this->load->view('builder_creer');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function campagne_modifier()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $result_newsletter = $this->My_builder->get_newsletter($id_news, $id_group);

      $this->load->view('header');
      $this->load->view('builder_modifier');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function add()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $data = array (
				"text" => $this->input->post ("text"),
				"text1" => $this->input->post ("text1"),
			);

			$id_news = $this->My_common->insert_data('builder_block', $data);

			$config['upload_path'] = 'mediatheque/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('img'))
			{
				$picture = $this->upload->data();
				$img = $picture['file_name'];
				$data = array (
					"id" => $id_news,
					"img" => $img,
				);

				$this->My_common->update_data('builder_block', 'id', $id_news, $data);
			}

      redirect(base_url().'builder/campagne_modifier/'.$id_news.'.html');

    } else {
        $this->load->view('login');
    }
  }

  public function update()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $data = array (
				"text" => $this->input->post ("text"),
				"text1" => $this->input->post ("text1"),
			);

			$id_news = $this->My_common->insert_data('builder_block', $data);

			$config['upload_path'] = 'mediatheque/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('img'))
			{
				$picture = $this->upload->data();
				$img = $picture['file_name'];
				$data = array (
					"id" => $id_news,
					"img" => $img,
				);

				$this->My_common->update_data('builder_block', 'id', $id_news, $data);
			}

      $this->load->view('header');
      $this->load->view('builder_creer');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

}
