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
      $data_blocks = array();
      $replace_html = '';
      $builder_blocks = '';
      $theme = 0;

      // NEWSLETTER

      $result_newsletter = $this->My_builder->get_newsletter($id_newsletter, $id_group);

      //var_dump($this->db->last_query());
      //var_dump($result_newsletter);
      foreach ($result_newsletter as $row_newsletter) {

        $id_block = intval($row_newsletter->id_block);
        $id_block_html = intval($row_newsletter->id_block_html);
        $id_block_content = intval($row_newsletter->id_block_content);
        $nom_campagne = $row_newsletter->nom_campagne;
        $html = $row_newsletter->newsletter_block_html;
        $ordre = $row_newsletter->newsletter_block_ordre;
        $img_link0 = $row_newsletter->newsletter_block_img0;
        $img_link1 = $row_newsletter->newsletter_block_img1;
        $img_link2 = $row_newsletter->newsletter_block_img2;
        $text0 = $row_newsletter->newsletter_block_text0;
        $text1 = $row_newsletter->newsletter_block_text1;
        $text2 = $row_newsletter->newsletter_block_text2;
        $text3 = $row_newsletter->newsletter_block_text3;
        $text4 = $row_newsletter->newsletter_block_text4;
        $text5 = $row_newsletter->newsletter_block_text5;
        $text6 = $row_newsletter->newsletter_block_text6;
        $text7 = $row_newsletter->newsletter_block_text7;
        $text8 = $row_newsletter->newsletter_block_text8;
        $text9 = $row_newsletter->newsletter_block_text9;
        $text10 = $row_newsletter->newsletter_block_text10;
        $text11 = $row_newsletter->newsletter_block_text11;
        $text12 = $row_newsletter->newsletter_block_text12;
        $text13 = $row_newsletter->newsletter_block_text13;
        $text14 = $row_newsletter->newsletter_block_text14;

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{ordre}}'            => $ordre,
          '{{img0}}'             => $img_link0,
          '{{img1}}'             => $img_link1,
          '{{img2}}'             => $img_link2,
          '{{text0}}'            => $text0,
          '{{text1}}'            => $text1,
          '{{text2}}'            => $text2,
          '{{text3}}'            => $text3,
          '{{text4}}'            => $text4,
          '{{text5}}'            => $text5,
          '{{text6}}'            => $text6,
          '{{text7}}'            => $text7,
          '{{text8}}'            => $text8,
          '{{text9}}'            => $text9,
          '{{text10}}'           => $text10,
          '{{text11}}'           => $text11,
          '{{text12}}'           => $text12,
          '{{text13}}'           => $text13,
          '{{text14}}'           => $text14,
        );

        $replace_html .= str_replace(
          array_keys($replace),
          array_values($replace),
          $html
        );

        $data = array(
          'id_newsletter' => $id_newsletter,
          'newsletter'    => $replace_html,
          'nom_campagne'  => $nom_campagne,
        );

      }

      // BUILDER BLOCKS

      $result_builder_block = $this->My_builder->get_builder_block($theme);

      foreach ($result_builder_block as $row_builder_block) {

        $builder_blocks .= $row_builder_block->builder_block_html;

        $data_blocks = array(
          'builder_block_html' => $builder_blocks,
        );

      }

      //print_r($data_blocks);
      $this->load->view('header', $data);
      $this->load->view('builder_creer', $data_blocks);
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

  public function campagne_listes()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');
      $this->load->model('My_listes');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];

      $result_newsletter = $this->My_builder->get_newsletter($id_newsletter, $id_group);
      $result_list = $this->My_listes->get_all_listes($id_group);

      $data = array(
        'result_newsletter' => $result_newsletter,
        'result_list'       => $result_list
      );

      $this->load->view('header', $data);
      $this->load->view('builder_listes');
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
  }

  public function add_newsletter()
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

      for ($i=1; $i < 8; $i++) {

        switch ($i) {
          case 1:
            $data_content = array (
              'id_block_html' => 1,
      			);
      			$id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 1,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 2:
            $data_content = array (
              'id_block_html' => 2,
            );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 2,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 3:
          $data_content = array (
            'id_block_html' => 3,
            'text0' => 'Seddre\'infos',
            'text1' => 1,
            'text2' => date('Y-m-d'),
          );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 3,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 4:
            $data_content = array (
              'id_block_html' => 4,
              'img0'  => 'img_1.png',
              'text0' => '#',
              'text1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
              'text2' => '1. Vie du syndicat',
              'text3' => 'Bibliothèque',
              'text4' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
              'text5' => 'Suivre les évolutions réglementaires et normatives en lien avec les autorités compétentes',
              'text6' => 'Sensibiliser les acteurs sur les enjeux de la profession afin qu’ils puissent être pris en compte sur les chantiers',
              'text7' => 'Défendre les intérêts économiques de nos professions aux regards des acteurs amont et aval',
              'text8' => 'S’assurer d’une juste concurrence entre les entreprises et lutter contre les pratiques illégales',
              'text9' => 'En savoir +',
              'text10' => '#',
            );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 4,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 5:
            $data_content = array (
              'id_block_html' => 23,
            );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 23,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 6:
            $data_content = array (
              'id_block_html' => 24,
            );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 24,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);

          break;

          case 7:
            $data_content = array (
              'id_block_html' => 25,
            );
            $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

            $data_block = array(
              'id_newsletter'    => $id_newsletter,
              'id_block_html'    => 25,
              'id_block_content' => $id_block_content,
              'ordre'            => $i,
            );

            $this->My_common->insert_data('newsletter_has_block', $data_block);
          break;

          default:
            // code...
          break;
        }

      }

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
      $this->load->view('login');
    }
  }

  public function add_block()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block_html = $this->input->post ('id_block_html');
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
        'id_block_html' => $id_block_html,
				'text0'         => $this->input->post ('text0'),
				'text1'         => $this->input->post ('text1'),
			);

			$id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

      // Ajout du block et contenu

			$config['upload_path'] = 'mediatheque/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('img0'))
			{
				$picture = $this->upload->data();
				$img0 = $picture['file_name'];
				$data_content = array (
					"img0" => $img0,
				);

				$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);
			}

      $data = array(
        'id_newsletter'    => $id_newsletter,
        'id_block_html'    => $id_block_html,
        'id_block_content' => $id_block_content,
        'ordre'            => $ordre,
      );

      $this->My_common->insert_data('newsletter_has_block', $data);

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
        $this->load->view('login');
    }
  }

  public function update_block()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block_content = $this->input->post ('id_block_content');

      $data_content = array (
				'text0'          => $this->input->post ('text0'),
				'text1'          => $this->input->post ('text1'),
			);

			$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

      // Ajout du block et contenu

			$config['upload_path'] = 'mediatheque/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('img0'))
			{
				$picture = $this->upload->data();
				$img0 = $picture['file_name'];
				$data_content = array (
					"img0" => $img0,
				);

				$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);
			}

      redirect(base_url().'builder/campagne_creer/'.$id_newsletter.'.html');

    } else {
        $this->load->view('login');
    }
  }

  public function get_block_content()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $id_block_html = $this->input->post ('id_block_html');
      $id_block_content = $this->input->post ('id_block_content');
      $data = array();
      $data_blocks = array();
      $replace_html = '';
      $builder_blocks = '';
      $theme = 0;

      // NEWSLETTER

      $result_block = $this->My_builder->get_block_by_id($id_newsletter, $id_block_content);

      //var_dump($this->db->last_query());
      //var_dump($result_block);

        $data = array(
          'img_link0' => $result_block[0]->newsletter_block_img0,
          'text0' => $result_block[0]->newsletter_block_text0,
          'text1' => $result_block[0]->newsletter_block_text1,
        );

        $block_content = json_encode($data);

        echo $block_content;

    } else {
        $this->load->view('login');
    }
  }

  public function block_move_up()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      // Inversion de l'ordre des blocks

      $result = $this->My_builder->get_newsletter_block_by_ordre($id_newsletter, $ordre-1);

      $data_ordre = array(
        'ordre' => $result[0]->ordre+1,
      );

  		$this->My_common->update_data('newsletter_has_block', 'id', $result[0]->id, $data_ordre);

      $data_ordre = array(
        'ordre' => $ordre-1,
      );

      $this->My_common->update_data('newsletter_has_block', 'id', $id_block, $data_ordre);

      echo 'ok';

    } else {
        $this->load->view('login');
    }
  }

  public function block_move_down()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_builder');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      // Inversion de l'ordre des blocks

      $result = $this->My_builder->get_newsletter_block_by_ordre($id_newsletter, $ordre+1);

      $data_ordre = array(
        'ordre' => $result[0]->ordre-1,
      );

  		$this->My_common->update_data('newsletter_has_block', 'id', $result[0]->id, $data_ordre);

      $data_ordre = array(
        'ordre' => $ordre+1,
      );

      $this->My_common->update_data('newsletter_has_block', 'id', $id_block, $data_ordre);

      echo 'ok';

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

      $this->My_common->delete_data('newsletter_block_content', $id_block_content);
      $this->My_common->delete_data('newsletter_has_block', $id_block);

      echo 'ok';

    } else {
        $this->load->view('login');
    }
  }

}
