<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campagnes extends CI_Controller {

  // Afficher la liste des campagnes
  public function index()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_group = $_SESSION['id_group'];

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $data_campagne = array(
        'type' => '',
        'status' => '',
      );
      $result = $mailin->get_campaigns_v2($data_campagne);

      $result_campagnes = $this->My_campagnes->get_all_campagnes();

      $data = array(
        'result' => $result,
        'result_campagnes' => $result_campagnes,
      );

      $this->load->view('header', $data);
      $this->load->view('campagnes');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  // BUILDER NEWSLETTER
  public function informations()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $etape = $this->uri->segment(3, 0);
      $id_newsletter = $this->uri->segment(4, 0);
      $id_group = $_SESSION['id_group'];
      $data = array();
      $data_themes = array();

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_theme_newsletter = $this->My_campagnes->get_newsletter_themes_by_group($id_group);

      $data_themes = array(
        'result_theme_newsletter' => $result_theme_newsletter,
      );

      if ($etape == 'creation') {
        $this->load->view('header', $data_themes);
        $this->load->view('campagnes_infos_ajouter');
        $this->load->view('footer');
      }
      if ($etape == 'modification') {

        $data_newsletter = array(
          'id_newsletter'       => $id_newsletter,
          'nom_campagne'        => $result_newsletter[0]->nom_campagne,
          'objet_campagne'      => $result_newsletter[0]->objet,
          'expediteur_campagne' => $result_newsletter[0]->expediteur,
          'theme_campagne'      => $result_newsletter[0]->theme,
        );

        $this->load->view('header', $data_themes);
        $this->load->view('campagnes_infos_modifier', $data_newsletter);
        $this->load->view('footer');
      }

    } else {
        $this->load->view('login');
    }
  }

  public function newsletter()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      //$etape = $this->uri->segment(3, 0);
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $data = array();
      $data_blocks = array();
      $replace_html = '';
      $builder_blocks = '';

      // NEWSLETTER

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      foreach ($result_newsletter as $row_newsletter) {

        $id_block = $row_newsletter->id_block;
        $id_block_html = $row_newsletter->id_block_html;
        $id_block_content = $row_newsletter->id_block_content;
        $nom_campagne = $row_newsletter->nom_campagne;
        $theme = $row_newsletter->theme;
        $html = $row_newsletter->newsletter_block_html;
        $nom_block = $row_newsletter->newsletter_block_nom;
        $type = $row_newsletter->newsletter_block_type;
        $ordre = $row_newsletter->newsletter_block_ordre;
        $img_link0 = $row_newsletter->newsletter_block_img0;
        $img_link1 = $row_newsletter->newsletter_block_img1;
        $img_link2 = $row_newsletter->newsletter_block_img2;
        //$text0 = addcslashes($row_newsletter->newsletter_block_text0, '"\\/');
        $text0 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text0);
        //$text0 = $row_newsletter->newsletter_block_text0;
        $text1 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text1);
        $text2 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text2);
        $text3 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text3);
        $text4 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text4);
        $text5 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text5);
        $text6 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text6);
        $text7 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text7);
        $text8 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text8);
        $text9 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text9);
        $text10 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text10);
        $text11 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text11);
        $text12 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text12);
        $text13 = str_replace('"','#&§#&§', $row_newsletter->newsletter_block_text13);
        $select0 = $row_newsletter->newsletter_block_select0;
        $select1 = $row_newsletter->newsletter_block_select1;
        $select2 = $row_newsletter->newsletter_block_select2;
        $select3 = $row_newsletter->newsletter_block_select3;

        // Choix Select

        switch ($select0) {

          case 0:
            $url0 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url0 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url0 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url0 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        $url1 = '';
        $url2 = '';
        $url3 = '';

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{nom}}'              => $nom_block,
          '{{ordre}}'            => $ordre,
          '{{type}}'             => $type,
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
          '{{select0}}'          => $select0,
          '{{select1}}'          => $select1,
          '{{select2}}'          => $select2,
          '{{select3}}'          => $select3,
          '{{display0}}'         => (!empty($text0))?'':'display0',
          '{{display1}}'         => (!empty($text1))?'':'display1',
          '{{display2}}'         => (!empty($text2))?'':'display2',
          '{{display3}}'         => (!empty($text3))?'':'display3',
          '{{display4}}'         => (!empty($text4))?'':'display4',
          '{{display5}}'         => (!empty($text5))?'':'display5',
          '{{display6}}'         => (!empty($text6))?'':'display6',
          '{{display7}}'         => (!empty($text7))?'':'display7',
          '{{display8}}'         => (!empty($text8))?'':'display8',
          '{{display9}}'         => (!empty($text9))?'':'display9',
          '{{display10}}'        => (!empty($text10))?'':'display10',
          '{{display11}}'        => (!empty($text11))?'':'display11',
          '{{display12}}'        => (!empty($text12))?'':'display12',
          '{{display13}}'        => (!empty($text13))?'':'display13',
          '{{url0}}'             => $url0,
          '{{url1}}'             => $url1,
          '{{url2}}'             => $url2,
          '{{url3}}'             => $url3,
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

      $result_builder_block = $this->My_campagnes->get_builder_block($theme);

      foreach ($result_builder_block as $row_builder_block) {

        $builder_blocks .= $row_builder_block->builder_block_html;

        $data_blocks = array(
          'builder_block_html' => $builder_blocks,
        );

      }

      $this->load->view('header', $data);
      $this->load->view('newsletter', $data_blocks);
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
  }

  public function add_newsletter()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $data = array();
      $data_block = array();
      $id_group = $_SESSION['id_group'];

      //CREATION DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $data = array(
        "category"=> "",
        "from_name"=> $_SESSION['user_nom'],
        "from_email"=> "aurelien@studio-brik.com",
        "name"=> $this->input->post ('nom_campagne'),
        "bat"=> "aurelien@studio-brik.com",
        "html_content"=> "<html><body></body></html>",
        "html_url"=> "",
        "listid"=> array(),
        "scheduled_date"=> "",
        "subject"=> $this->input->post ('objet'),
        "reply_to"=> $this->input->post ('expediteur'),
        "to_field"=>"[PRENOM] [NOM]",
        'exclude_list'=> array(),
        "attachment_url"=> "",
        "inline_image"=> 0,
        "mirror_active"=> 0,
        "send_now"=> 0,
        "utm_campaign"=> "",
      );

      $result = $mailin->create_campaign($data);

      //var_dump($result);

      //AJOUT EN BASE DES INFORMATIONS DE LA CAMPAGNE

      $data = array(
        'nom_campagne'    => $this->input->post ('nom_campagne'),
        'objet'           => $this->input->post ('objet'),
        'expediteur'      => $this->input->post ('expediteur'),
        'theme'           => $this->input->post ('theme'),
        'id_group'        => $_SESSION['id_group'],
        'id_sib'          => ''/**$result['data']**/,
      );

      $id_group = $_SESSION['id_group'];
      $theme = $this->input->post ('theme');

			$id_newsletter = $this->My_common->insert_data('newsletter', $data);

      //if ($result['code'] == 'success') {

        //CRÉATION DU TEMPLATE DE BASE

        //Block Top

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 1);

        $data_content = array (
          'id_block_html' => $result_html_block[0]->id,
  			);

  			$id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

        $data_block = array(
          'id_newsletter'    => $id_newsletter,
          'id_block_html'    => $result_html_block[0]->id,
          'id_block_content' => $id_block_content,
          'ordre'            => 1,
        );

        $this->My_common->insert_data('newsletter_has_block', $data_block);

        //Block Header

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 2);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
    			);

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 2,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Headline

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 3);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
            'text0' => 'Newsletter',
            'text1' => 1,
            'text2' => date('d/m/Y'),
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 3,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Image

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 4);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
            'img0'  => 'img_1.png',
            'text0' => '#',
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 4,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Titre

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 5);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
            'text0' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 5,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Paragraphe

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 6);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
            'text0' => '1. Lorem ipsum dolor sit amet',
            'text1' => 'Lorem ipsum',
            'text2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'text3' => 'En savoir +',
            'text4' => '#',
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 6,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Footer

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 7);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 7,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Footer bar

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 8);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 8,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        //Block Bottom

        //Récupération id du block du template par ordre
        $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 9);

        if (count($result_html_block) > 0) {

          $data_content = array (
            'id_block_html' => $result_html_block[0]->id,
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter,
            'id_block_html'    => $result_html_block[0]->id,
            'id_block_content' => $id_block_content,
            'ordre'            => 9,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);

        }

        redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');

      //} else {

      //}

    } else {
      $this->load->view('login');
    }
  }

  public function update_newsletter()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_newsletter = $this->uri->segment(3, 0);
      $data = array();
      $id_group = $_SESSION['id_group'];

      // INFOS NEWSLETTER

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      //UPDATE DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $data = array(
        "id"=> $result_newsletter[0]->id_sendinblue,
        "category"=> "",
        "from_name"=> $_SESSION['user_nom'],
        "from_email"=> "aurelien@studio-brik.com",
        "name"=> $this->input->post ('nom_campagne'),
        "bat"=> "aurelien@studio-brik.com",
        "html_content"=> "<html><body></body></html>",
        "html_url"=> "",
        "listid"=> array(),
        "scheduled_date"=> "",
        "subject"=> $this->input->post ('objet'),
        "reply_to"=> $this->input->post ('expediteur'),
        "to_field"=>"[PRENOM] [NOM]",
        'exclude_list'=> array(),
        "attachment_url"=> "",
        "inline_image"=> 0,
        "mirror_active"=> 0,
        "send_now"=> 0,
        "utm_campaign"=> "",
      );

      //var_dump($mailin->update_campaign($data));

      $data = array(
        'nom_campagne'    => $this->input->post ('nom_campagne'),
        'objet'           => $this->input->post ('objet'),
        'expediteur'      => $this->input->post ('expediteur'),
      );

			$this->My_common->update_data('newsletter', 'id', $id_newsletter, $data);

      redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');

    } else {
      $this->load->view('login');
    }
  }

  public function preview()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $data = array();
      $replace_html = '';
      $head = '';
      $blocks_html = '';
      $end = '';
      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_theme = $this->My_campagnes->get_newsletter_theme($result_newsletter[0]->theme);

      // BLOCK HEAD ET END

      $replace = array(
        '{{title}}' => $result_newsletter[0]->objet,
      );

      $head .= str_replace(
        array_keys($replace),
        array_values($replace),
        $result_theme[0]->head_html
      );
      $end = $result_theme[0]->end_html;

      // BLOCKS NEWSLETTER

      foreach ($result_newsletter as $row_newsletter) {

        $id_block = $row_newsletter->id_block;
        $id_block_html = $row_newsletter->id_block_html;
        $id_block_content = $row_newsletter->id_block_content;
        $nom_campagne = $row_newsletter->nom_campagne;
        $objet_campagne = $row_newsletter->objet;
        $html = $row_newsletter->newsletter_block_html;
        $nom_block = $row_newsletter->newsletter_block_nom;
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
        $select0 = $row_newsletter->newsletter_block_select0;
        $select1 = $row_newsletter->newsletter_block_select1;
        $select2 = $row_newsletter->newsletter_block_select2;
        $select3 = $row_newsletter->newsletter_block_select3;

        // Choix Select

        switch ($select0) {

          case 0:
            $url0 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url0 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url0 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url0 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        $url1 = '';
        $url2 = '';
        $url3 = '';

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{nom}}'              => $nom_block,
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
          '{{select0}}'          => $select0,
          '{{select1}}'          => $select1,
          '{{select2}}'          => $select2,
          '{{select3}}'          => $select3,
          '{{display0}}'         => (!empty($text0))?'':'display0',
          '{{display1}}'         => (!empty($text1))?'':'display1',
          '{{display2}}'         => (!empty($text2))?'':'display2',
          '{{display3}}'         => (!empty($text3))?'':'display3',
          '{{display4}}'         => (!empty($text4))?'':'display4',
          '{{display5}}'         => (!empty($text5))?'':'display5',
          '{{display6}}'         => (!empty($text6))?'':'display6',
          '{{display7}}'         => (!empty($text7))?'':'display7',
          '{{display8}}'         => (!empty($text8))?'':'display8',
          '{{display9}}'         => (!empty($text9))?'':'display9',
          '{{display10}}'        => (!empty($text10))?'':'display10',
          '{{display11}}'        => (!empty($text11))?'':'display11',
          '{{display12}}'        => (!empty($text12))?'':'display12',
          '{{display13}}'        => (!empty($text13))?'':'display13',
          '{{url0}}'             => $url0,
          '{{url1}}'             => $url1,
          '{{url2}}'             => $url2,
          '{{url3}}'             => $url3,
        );

        $blocks_html .= str_replace(
          array_keys($replace),
          array_values($replace),
          $html
        );

      }

      // NEWSLETTER

      $newsletter = $head.$blocks_html.$end;
      $search = "/(<input)(.*?)(>)/";
      $replace = '';
      $newsletter = preg_replace($search,$replace,$newsletter);
      $search = "/§§§§/";
      $replace = '"';
      //$newsletter = preg_replace($search,$replace,$newsletter);
      //$search = "/§§/";
      //$replace = '\'';
      $newsletter = preg_replace($search,$replace,$newsletter);

      echo $newsletter;

    } else {
      $this->load->view('login');
    }
  }

  public function add_block()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block_html = $this->input->post ('id_block_html');
      $ordre = $this->input->post ('ordre');
      $result_theme = $this->My_campagnes->get_newsletter_themes_by_id_newsletter($id_newsletter);

      if (!empty($id_newsletter)) {

        // Ordre des autres blocks

        $result = $this->My_campagnes->get_newsletter_id_block($id_newsletter);

        foreach ($result as $row) {

          if ($row->ordre >= $ordre) {
            $data_ordre = array(
              'ordre' => $row->ordre+1,
            );
    			  $this->My_common->update_data('newsletter_has_block', 'id', $row->id, $data_ordre);

          }

        }

        // Ajout du block et contenu

        /**$data_content = array (
          'id_block_html' => $id_block_html,
  				'text0'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text0'))),
  				'text1'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text1'))),
          'text2'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text2'))),
  				'text3'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text3'))),
          'text4'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text4'))),
  				'text5'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text5'))),
          'text6'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text6'))),
  				'text7'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text7'))),
          'text8'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text8'))),
  				'text9'         => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text9'))),
          'text10'        => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text10'))),
  				'text11'        => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text11'))),
          'text12'        => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text12'))),
  				'text13'        => str_replace('\'','§§', str_replace('"','§§§§', $this->input->post ('text13'))),
          'select0'       => $this->input->post ('select0'),
          'select1'       => $this->input->post ('select1'),
          'select2'       => $this->input->post ('select2'),
          'select3'       => $this->input->post ('select3'),
  			);**/

        $data_content = array (
          'id_block_html' => $id_block_html,
          'text0'         => $this->input->post ('text0'),
          'text1'         => $this->input->post ('text1'),
          'text2'         => $this->input->post ('text2'),
          'text3'         => $this->input->post ('text3'),
          'text4'         => $this->input->post ('text4'),
          'text5'         => $this->input->post ('text5'),
          'text6'         => $this->input->post ('text6'),
          'text7'         => $this->input->post ('text7'),
          'text8'         => $this->input->post ('text8'),
          'text9'         => $this->input->post ('text9'),
          'text10'        => $this->input->post ('text10'),
          'text11'        => $this->input->post ('text11'),
          'text12'        => $this->input->post ('text12'),
          'text13'        => $this->input->post ('text13'),
          'select0'       => $this->input->post ('select0'),
          'select1'       => $this->input->post ('select1'),
          'select2'       => $this->input->post ('select2'),
          'select3'       => $this->input->post ('select3'),
          'select0'       => $this->input->post ('select0'),
          'select1'       => $this->input->post ('select1'),
          'select2'       => $this->input->post ('select2'),
          'select3'       => $this->input->post ('select3'),
        );

  			$id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

        // Ajout et enregistrement des images

        if (!empty($_POST["img0"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img0 = 'img'.$d.$u;
          $image_care = $this->input->post ("img0");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img0.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
  					"img0" => $img0.'.jpg',
  				);

  				$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img1"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img1 = 'img'.$d.$u;
          $image_care = $this->input->post ("img1");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img1.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img1" => $img1.'.jpg',
          );

          $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img2"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img2 = 'img'.$d.$u;
          $image_care = $this->input->post ("img2");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img2.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
  					"img2" => $img2.'.jpg',
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

        redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');

      } else {
        // code...
      }

    } else {
        $this->load->view('login');
    }
  }

  public function update_block()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');

      $data = array();
      $data_block = array();
      $data_content = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $result_theme = $this->My_campagnes->get_newsletter_themes_by_id_newsletter($id_newsletter);
      $id_block_content = $this->input->post ('id_block_content');

      if (!empty($id_newsletter) && !empty($id_block_content)) {

        // Ajout du block et contenu

        $data_content = array (
          'text0'         => $this->input->post ('text0'),
          'text1'         => $this->input->post ('text1'),
          'text2'         => $this->input->post ('text2'),
          'text3'         => $this->input->post ('text3'),
          'text4'         => $this->input->post ('text4'),
          'text5'         => $this->input->post ('text5'),
          'text6'         => $this->input->post ('text6'),
          'text7'         => $this->input->post ('text7'),
          'text8'         => $this->input->post ('text8'),
          'text9'         => $this->input->post ('text9'),
          'text10'        => $this->input->post ('text10'),
          'text11'        => $this->input->post ('text11'),
          'text12'        => $this->input->post ('text12'),
          'text13'        => $this->input->post ('text13'),
          'select0'       => $this->input->post ('select0'),
          'select1'       => $this->input->post ('select1'),
          'select2'       => $this->input->post ('select2'),
          'select3'       => $this->input->post ('select3'),
          'select0'       => $this->input->post ('select0'),
          'select1'       => $this->input->post ('select1'),
          'select2'       => $this->input->post ('select2'),
          'select3'       => $this->input->post ('select3'),
        );

  			$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        // Ajout et enregistrement des images

        if (!empty($_POST["img0"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img0 = 'img'.$d.$u;
          $image_care = $this->input->post ("img0");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img0.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img0" => $img0.'.jpg',
          );

          $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img1"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img1 = 'img'.$d.$u;
          $image_care = $this->input->post ("img1");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img1.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img1" => $img1.'.jpg',
          );

          $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img2"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img2 = 'img'.$d.$u;
          $image_care = $this->input->post ("img2");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/'.$img2.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img2" => $img2.'.jpg',
          );

          $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');

      } else {
        // code...
      }

    } else {
        $this->load->view('login');
    }
  }

  public function get_block_content()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $id_block_html = $this->input->post ('id_block_html');
      $id_block_content = $this->input->post ('id_block_content');
      $data = array();
      $data_blocks = array();
      $theme = 0;

      // NEWSLETTER

      $result_block = $this->My_campagnes->get_block_by_id($id_newsletter, $id_block_content);

      //var_dump($this->db->last_query());
      //var_dump($result_block);

        $data = array(
          'img_link0' => $result_block[0]->newsletter_block_img0,
          'img_link1' => $result_block[0]->newsletter_block_img1,
          'img_link2' => $result_block[0]->newsletter_block_img2,
          'text0'     => $result_block[0]->newsletter_block_text0,
          'text1'     => $result_block[0]->newsletter_block_text1,
          'text2'     => $result_block[0]->newsletter_block_text2,
          'text3'     => $result_block[0]->newsletter_block_text3,
          'text4'     => $result_block[0]->newsletter_block_text4,
          'text5'     => $result_block[0]->newsletter_block_text5,
          'text6'     => $result_block[0]->newsletter_block_text6,
          'text7'     => $result_block[0]->newsletter_block_text7,
          'text8'     => $result_block[0]->newsletter_block_text8,
          'text9'     => $result_block[0]->newsletter_block_text9,
          'text10'    => $result_block[0]->newsletter_block_text10,
          'text11'    => $result_block[0]->newsletter_block_text11,
          'text12'    => $result_block[0]->newsletter_block_text12,
          'text13'    => $result_block[0]->newsletter_block_text13,
          'select0'   => $result_block[0]->newsletter_block_select0,
          'select1'   => $result_block[0]->newsletter_block_select1,
          'select2'   => $result_block[0]->newsletter_block_select2,
          'select3'   => $result_block[0]->newsletter_block_select3,
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

      $this->load->model('My_campagnes');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      // Inversion de l'ordre des blocks

      $result = $this->My_campagnes->get_newsletter_block_by_ordre($id_newsletter, $ordre-1);

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

      $this->load->model('My_campagnes');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $ordre = $this->input->post ('ordre');

      // Inversion de l'ordre des blocks

      $result = $this->My_campagnes->get_newsletter_block_by_ordre($id_newsletter, $ordre+1);

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

      $this->load->model('My_campagnes');

      $data_ordre = array();

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $id_block = $this->input->post ('id_block');
      $id_block_content = $this->input->post ('id_block_content');
      $ordre = $this->input->post ('ordre');

      // Ordre des autres blocks

      $result = $this->My_campagnes->get_newsletter_id_block($id_newsletter);

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

  public function listes()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_listes');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_list = $this->My_listes->get_all_listes($id_group);

      $data = array(
        'id_newsletter'     => $id_newsletter,
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


}
