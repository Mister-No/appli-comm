<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Builder extends CI_Controller {

  public function index()
  {
    if ($_SESSION["is_connect"] == TRUE){



      $this->load->view('header');
      $this->load->view('builder_infos');
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

        $id_block = intval($row_newsletter->id_block);
        $id_block_html = intval($row_newsletter->id_block_html);
        $id_block_content = intval($row_newsletter->id_block_content);
        $img_link = $row_newsletter->builder_block_img;
        $text = $row_newsletter->builder_block_text;
        $text1 = $row_newsletter->builder_block_text1;
        $html = $row_newsletter->builder_block_html;
        $ordre = $row_newsletter->builder_block_ordre;

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{img}}'              => $img_link,
          '{{text}}'             => $text,
          '{{text1}}'            => $text,
          '{{ordre}}'            => $ordre,
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
      //print_r($data);
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
        'nom_campagne'    => $this->input->post ('nom_campagne'),
        'objet'           => $this->input->post ('objet'),
        'expediteur'      => $this->input->post ('expediteur'),
        'theme'           => '',
        'id_group'        => $_SESSION['id_group'],
      );

			$id_newsletter = $this->My_common->insert_data('newsletter', $data);

      for ($i=1; $i < 5; $i++) {

        switch ($i) {
          case 1:
            $data_content = array (
              'id_block_html' => $i,
      				'img' => 'assets/img/logo.png',
      			);
      			$id_block_content = $this->My_common->insert_data('builder_block_content', $data_content);
          break;

          case 2:
            $data_content = array (
              'id_block_html' => $i,
              'text' => 'Votre texte.',
            );
            $id_block_content = $this->My_common->insert_data('builder_block_content', $data_content);
          break;

          case 3:
            $data_content = array (
              'id_block_html' => $i,
              'text' => 'PAGES<br>1 rue test<br>11111 TEST<br>Tel: 01 01 01 01 01',
              'img' => 'assets/img/logo.png',
            );
            $id_block_content = $this->My_common->insert_data('builder_block_content', $data_content);
          break;

          case 4:
            $data_content = array (
              'id_block_html' => $i,
              'text' => 'Se desinscrire de cette newsletter',
            );
            $id_block_content = $this->My_common->insert_data('builder_block_content', $data_content);
          break;

          default:
            // code...
          break;
        }

        $data_block = array(
          'id_newsletter'    => $id_newsletter,
          'id_block_html'    => $i,
          'id_block_content' => $id_block_content,
          'ordre'            => $i,
        );

        $this->My_common->insert_data('newsletter_has_block', $data_block);
      }

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
      $this->load->view('login');
    }
  }

  public function update()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      // Ordre des autres blocks

      $result = $this->My_builder->get_newsletter_id_block($id_newsletter);

      foreach ($result as $row) {

        if ($row->ordre >= $ordre) {
          $data_ordre = array(
            'ordre' => $row->ordre+1,
          );
  			  $this->My_common->update_data('newsletter_has_block', 'id', $row->id, $data_ordre);

        }

      }

      $data_content = array (
        'id_block_html' => $id_block,
				'text'          => $this->input->post ('text'),
				'text1'         => $this->input->post ('text1'),
			);

			$id_block_content = $this->My_common->insert_data('builder_block_content', $data_content);

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

      $data = array(
        'id_newsletter'    => $id_newsletter,
        'id_block_html'    => $id_block,
        'id_block_content' => $id_block_content,
        'ordre'            => $ordre,
      );

      $this->My_common->insert_data('newsletter_has_block', $data);

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
        $this->load->view('login');
    }
  }

  public function delete()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $id_block_content = $this->input->post ('id_block_content');
      $ordre = $this->input->post ('ordre');

      // Ordre des autres blocks

      $result = $this->My_builder->get_newsletter_id_block($id_newsletter);

      foreach ($result as $row) {

        if ($row->ordre >= $ordre) {
          $data_ordre = array(
            'ordre' => $row->ordre-1,
          );
  			  $this->My_common->update_data('newsletter_has_block', 'id', $row->id, $data_ordre);

        }

      }

      // Delete contenu du block

      $this->My_common->delete_data('builder_block_content', $id_block_content);
      $this->My_common->delete_data('newsletter_has_block', $id_block);

      echo 'ok';

    } else {
        $this->load->view('login');
    }
  }

}
