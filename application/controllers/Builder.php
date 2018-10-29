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

      $this->load->model('My_builder');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $data = array();
      $replace_html = '';

      $result_newsletter = $this->My_builder->get_newsletter($id_newsletter, $id_group);
      //var_dump($this->db->last_query());
      //var_dump($result_newsletter);
      foreach ($result_newsletter as $row_newsletter) {

        $img_link = $row_newsletter->builder_block_img;
        $text = $row_newsletter->builder_block_text;
        $text1 = $row_newsletter->builder_block_text1;
        $html = $row_newsletter->builder_block_html;

        $replace = array(
          '{{base_url}}' => base_url(),
          '{{img}}' => $img_link,
          '{{text}}' => $text,
          '{{text1}}' => $text,
        );

        $replace_html .= str_replace(
          array_keys($replace),
          array_values($replace),
          $html
        );

        $data = array(
          'id_newsletter' => $id_newsletter,
          'newsletter'    => $replace_html,
        );

      }
      print_r($data);
      $this->load->view('header', $data);
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

      $result_newsletter = $this->My_builder->get_newsletter($id_newsletter, $id_group);

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

      $data = array();
      $data_block = array();

      $data = array(
        'theme'    => '',
        'id_group' => $_SESSION['id_group'],
      );

			$id_newsletter = $this->My_common->insert_data('newsletter', $data);

      for ($i=1; $i < 5; $i++) {
        $data_block = array(
          'id_newsletter' => $id_newsletter,
          'id_block' => $i,
          'ordre'    => $i,
        );

        $this->My_common->insert_data('newsletter_has_block', $data_block);
      }

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
        $this->load->view('login');
    }
  }

  /**public function add()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $data = array (
				"text" => $this->input->post ("text"),
				"text1" => $this->input->post ("text1"),
			);

			$id_news = $this->My_common->insert_data('newsletter', $data);

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
  }**/

  public function update()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      $data = array(
        'id_newsletter' => $id_newsletter,
        'id_block' => $id_block,
        'ordre'    => $ordre,
      );

      $this->My_common->insert_data('newsletter_has_block', $data);

      $data_content = array (
        'id_block' => $id_block,
				'text' => $this->input->post ('text'),
				'text1' => $this->input->post ('text1'),
			);

			$id_content = $this->My_common->insert_data('builder_block_content', $data_content);

			$config['upload_path'] = 'mediatheque/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('img'))
			{
				$picture = $this->upload->data();
				$img = $picture['file_name'];
				$data_content = array (
					"img" => $img,
				);

				$this->My_common->update_data('builder_block_content', 'id', $id_content, $data_content);
			}

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
        $this->load->view('login');
    }
  }

}
