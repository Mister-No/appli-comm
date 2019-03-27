<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campagnes extends CI_Controller {

  // AFFICHAGE DES CAMPAGNES
  public function en_cours()
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

      $result_campagnes = $this->My_campagnes->get_unsent_campagnes($id_group);

      $data = array(
        'result' => $result,
        'result_campagnes' => $result_campagnes,
      );

      $this->load->view('header', $data);
      $this->load->view('campagnes_en_cours');
      $this->load->view('footer');


    } else {
        $this->load->view('login');
    }
  }

  public function envoyees()
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

      $result_campagnes = $this->My_campagnes->get_sent_campagnes($id_group);

      $data = array(
        'result' => $result,
        'result_campagnes' => $result_campagnes,
      );

      $this->load->view('header', $data);
      $this->load->view('campagnes_envoyees');
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
  }

  public function archivees()
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

      $result_campagnes = $this->My_campagnes->get_archived_campagnes($id_group);

      $data = array(
        'result' => $result,
        'result_campagnes' => $result_campagnes,
      );

      $this->load->view('header', $data);
      $this->load->view('campagnes_archivees');
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
      $data_infos = array();
      $data_sender = array();

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_sender = $this->My_campagnes->get_senders($id_group);
      $result_theme_newsletter = $this->My_campagnes->get_newsletter_themes_by_group($id_group);

      $data_infos = array(
        'result_theme_newsletter' => $result_theme_newsletter,
        'result_sender' => $result_sender,
      );

      if ($etape == 'creation') {

        $this->load->view('header', $data_infos);
        $this->load->view('campagnes_infos_ajouter');
        $this->load->view('footer');
      }

      if ($etape == 'modification') {

        $data_newsletter = array(
          'id_newsletter'       => $id_newsletter,
          'nom_campagne'        => $result_newsletter[0]->nom_campagne,
          'objet_campagne'      => $result_newsletter[0]->objet,
          'expediteur_campagne' => $result_newsletter[0]->expediteur,
          'theme_campagne' => $result_newsletter[0]->theme,
        );

        $this->load->view('header', $data_infos);
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
        $type_envoi = $row_newsletter->type_envoi;
        $date_envoi = $row_newsletter->date_envoi;
        $heure_envoi = $row_newsletter->heure_envoi;
        $theme = $row_newsletter->theme;
        $html = $row_newsletter->newsletter_block_html;
        $nom_block = $row_newsletter->newsletter_block_nom;
        $type = $row_newsletter->newsletter_block_type;
        $ordre = $row_newsletter->newsletter_block_ordre;
        $img_link0 = $row_newsletter->newsletter_block_img0;
        $img_link1 = $row_newsletter->newsletter_block_img1;
        $img_link2 = $row_newsletter->newsletter_block_img2;
        $img_link3 = $row_newsletter->newsletter_block_img3;
        //$text0 = addcslashes($row_newsletter->newsletter_block_text0, '"\\/');
        $text0 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text0));
        //$text0 = $row_newsletter->newsletter_block_text0;
        $text1 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text1));
        $text2 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text2));
        $text3 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text3));
        $text4 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text4));
        $text5 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text5));
        $text6 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text6));
        $text7 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text7));
        $text8 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text8));
        $text9 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text9));
        $text10 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text10));
        $text11 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text11));
        $text12 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text12));
        $text13 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text13));
        $text14 = str_replace('"','#&§#&§', nl2br($row_newsletter->newsletter_block_text14));
        $select0 = $row_newsletter->newsletter_block_select0;
        $select1 = $row_newsletter->newsletter_block_select1;
        $select2 = $row_newsletter->newsletter_block_select2;
        $select3 = $row_newsletter->newsletter_block_select3;

        // Choix Select

        $url0 = '';
        $url1 = '';
        $url2 = '';
        $url3 = '';

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

        switch ($select1) {

          case 0:
            $url1 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url1 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url1 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url1 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        switch ($select2) {

          case 0:
            $url2 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url2 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url2 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url2 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        switch ($select3) {

          case 0:
            $url3 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url3 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url3 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url3 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_newsletter}}'    => $id_newsletter,
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{nom}}'              => $nom_block,
          '{{ordre}}'            => $ordre,
          '{{type}}'             => $type,
          '{{img0}}'             => $img_link0,
          '{{img1}}'             => $img_link1,
          '{{img2}}'             => $img_link2,
          '{{img3}}'             => $img_link3,
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
          '{{select0}}'          => $select0,
          '{{select1}}'          => $select1,
          '{{select2}}'          => $select2,
          '{{select3}}'          => $select3,
          '{{displayimg0}}'      => (!empty($img_link0))?'':'display:none;mso-hide:all; ',
          '{{displayimg1}}'      => (!empty($img_link1))?'':'display:none;mso-hide:all; ',
          '{{displayimg2}}'      => (!empty($img_link2))?'':'display:none;mso-hide:all; ',
          '{{displayimg3}}'      => (!empty($img_link2))?'':'display:none;mso-hide:all; ',
          '{{display0}}'         => (!empty($text0))?'':'display:none;mso-hide:all; ',
          '{{display1}}'         => (!empty($text1))?'':'display:none;mso-hide:all; ',
          '{{display2}}'         => (!empty($text2))?'':'display:none;mso-hide:all; ',
          '{{display3}}'         => (!empty($text3))?'':'display:none;mso-hide:all; ',
          '{{display4}}'         => (!empty($text4))?'':'display:none;mso-hide:all; ',
          '{{display5}}'         => (!empty($text5))?'':'display:none;mso-hide:all; ',
          '{{display6}}'         => (!empty($text6))?'':'display:none;mso-hide:all; ',
          '{{display7}}'         => (!empty($text7))?'':'display:none;mso-hide:all; ',
          '{{display8}}'         => (!empty($text8))?'':'display:none;mso-hide:all; ',
          '{{display9}}'         => (!empty($text9))?'':'display:none;mso-hide:all; ',
          '{{display10}}'        => (!empty($text10))?'':'display:none;mso-hide:all; ',
          '{{display11}}'        => (!empty($text11))?'':'display:none;mso-hide:all; ',
          '{{display12}}'        => (!empty($text12))?'':'display:none;mso-hide:all; ',
          '{{display13}}'        => (!empty($text13))?'':'display:none;mso-hide:all; ',
          '{{display14}}'        => (!empty($text13))?'':'display:none;mso-hide:all; ',
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
      $this->load->view('campagnes_newsletter', $data_blocks);
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

      /**if ($this->input->post ('nom_campagne') != '' && $this->input->post ('theme') != '') {

        $id_group = $_SESSION['id_group'];
        $data = array();
        $data_block = array();
        $data_content = array();
        $content = '';
        $ordre = 1;

        //CREATION DE LA CAMPAGNE CHEZ SEND IN BLUE

        $infos_group = $this->My_users->get_group_infos($id_group);

        require(APPPATH.'libraries/Mailin.php');
        $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

        $data = array(
          "category"=> "",
          "from_name"=> $result_expediteur[0]->nom_expediteur,
          "from_email"=> $result_expediteur[0]->email_expediteur,
          "name"=> $this->input->post ('nom_campagne'),
          "bat"=> '',
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

        if ($result['code'] == 'success') {

          //AJOUT EN BASE DES INFORMATIONS DE LA CAMPAGNE

          $data = array(
            'nom_campagne'    => $this->input->post ('nom_campagne'),
            'objet'           => $this->input->post ('objet'),
            'expediteur'      => $this->input->post ('expediteur'),
            'theme'           => $this->input->post ('theme'),
            'id_group'        => $id_group,
            'id_sib'          => $result['data']['id'],
            'date_creation'   => date('Y-m-d'),
          );

          $id_newsletter = $this->My_common->insert_data('newsletter', $data);

          $result_theme = $this->My_campagnes->get_newsletter_theme($this->input->post ('theme'));

          mkdir('mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter);

          $image_template = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/img_1.png';

          $image_copy = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/img_1.png';

          copy($image_template, $image_copy);

          //CRÉATION DU TEMPLATE DE BASE

          //Récupération id du block du template par ordre
          $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($this->input->post ('theme'));

          foreach ($result_html_block as $block) {
            //Récupération du contenu
            $result_contenu = $this->My_campagnes->get_template_content($block->id);

            if (count($result_contenu) > 0) {

              if ($result_contenu[0]->type == 1) {
                $content = 'img0';
              } elseif ($result_contenu[0]->type == 2) {
                $content = 'text0';
              } elseif ($result_contenu[0]->type == 3) {
                $content = 'select0';
              } else {
                $content = '';
              }

              $data_content = array(
                'id_newsletter' => $id_newsletter,
                'id_block_html' => $block->id,
                $content => $result_contenu[0]->content,
              );
              $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

              $data_block = array(
                'id_newsletter'    => $id_newsletter,
                'id_block_html'    => $block->id,
                'id_block_content' => $id_block_content,
                'ordre'            => $ordre,
              );

              $id_block = $this->My_common->insert_data('newsletter_has_block', $data_block);

              if (count($result_contenu) > 1 && !empty($id_block_content)) {
                $i=0;
                //$b = false;
                foreach ($result_contenu as $contenu) {
                  /**if (!$b) {
                    $b = true;
                    continue;
                  } else {
                    if ($contenu->type == 1) {
                      $content = 'img'.$i;
                    } elseif ($contenu->type == 2) {
                      $content = 'text'.$i;
                    } elseif ($contenu->type == 3) {
                      $content = 'select'.$i;
                    } else {
                      $content = '';
                    }
                    $data_content = array(
                      $content => $contenu->content,
                    );
                    $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);
                  //}
                  $i++;
                }
              }
              $ordre++;

            } else {

              $data_content = array(
                'id_newsletter' => $id_newsletter,
                'id_block_html' => $block->id,
              );
              $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

              $data_block = array(
                'id_newsletter'    => $id_newsletter,
                'id_block_html'    => $block->id,
                'id_block_content' => $id_block_content,
                'ordre'            => $ordre,
              );

              $id_block = $this->My_common->insert_data('newsletter_has_block', $data_block);

              $ordre++;
            }
          }
        redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');
        } else {
          // code...
        }
      } else {
        echo 8;
      }**/

      if ($this->input->post ('nom_campagne') != '' && $this->input->post ('theme') != '') {

        $id_group = $_SESSION['id_group'];
        $theme = $this->input->post ('theme');
        $result_expediteur = $this->My_campagnes->get_campagne_sender($this->input->post ('id_expediteur'));
        $data = array();
        $data_block = array();
        $data_content = array();

        //CREATION DE LA CAMPAGNE CHEZ SEND IN BLUE

        $infos_group = $this->My_users->get_group_infos($id_group);

        require(APPPATH.'libraries/Mailin.php');
        $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

        $data = array(
          "category"=> "",
          "from_name"=> $result_expediteur[0]->nom_expediteur,
          "from_email"=> $result_expediteur[0]->email_expediteur,
          "name"=> $this->input->post ('nom_campagne'),
          "bat"=> '',
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

        if ($result['code'] == 'success') {

          //AJOUT EN BASE DES INFORMATIONS DE LA CAMPAGNE

          $data = array(
            'nom_campagne'    => $this->input->post ('nom_campagne'),
            'objet'           => $this->input->post ('objet'),
            'expediteur'      => $result_expediteur[0]->id,
            'theme'           => $this->input->post ('theme'),
            'id_group'        => $_SESSION['id_group'],
            'id_sib'          => $result['data']['id'],
            'date_creation'   => date('Y-m-d'),
          );

          $theme = $this->input->post ('theme');
    			$id_newsletter = $this->My_common->insert_data('newsletter', $data);

          $result_theme = $this->My_campagnes->get_newsletter_theme($theme);

          mkdir('mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter);

          $image_template = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/img_1.png';

          $image_copy = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/img_1.png';

          copy($image_template, $image_copy);

          //CRÉATION DU TEMPLATE DE BASE

          //Block Top

          //Récupération id du block du template par ordre
          $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 1);

          if (count($result_html_block) > 0) {

            $data_content = array (
              'id_newsletter' => $id_newsletter,
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

          }

          //Block Header

          //Récupération id du block du template par ordre
          $result_html_block = $this->My_campagnes->get_id_block_html_by_theme_and_template($theme, 2);

          if (count($result_html_block) > 0) {

            $data_content = array (
              'id_newsletter' => $id_newsletter,
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
              'id_newsletter' => $id_newsletter,
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
              'id_newsletter' => $id_newsletter,
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
              'id_newsletter' => $id_newsletter,
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

            if ($theme == 3) {
              $data_content = array (
                'id_newsletter' => $id_newsletter,
                'id_block_html' => $result_html_block[0]->id,
                'text0' => 'Lorem ipsum dolor sit amet',
                'text1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'text2' => 'En savoir +',
                'text3' => '#',
              );
            } else {
              $data_content = array (
                'id_newsletter' => $id_newsletter,
                'id_block_html' => $result_html_block[0]->id,
                'text0' => '1. Lorem ipsum dolor sit amet',
                'text1' => 'Lorem ipsum',
                'text2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'text3' => 'En savoir +',
                'text4' => '#',
              );
            }

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
              'id_newsletter' => $id_newsletter,
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
              'id_newsletter' => $id_newsletter,
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
              'id_newsletter' => $id_newsletter,
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

        } else {

        }

      } else {
        echo 8;
      }

    } else {
      $this->load->view('login');
    }
  }

  public function update_informations()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_newsletter = $this->uri->segment(3, 0);
      $data = array();
      $id_group = $_SESSION['id_group'];

      // INFOS NEWSLETTER

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_expediteur = $this->My_campagnes->get_campagne_sender($this->input->post ('id_expediteur'));

      //UPDATE DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $data = array(
        "id"=> $result_newsletter[0]->id_sendinblue,
        "category"=> "",
        "from_name"=> $result_expediteur[0]->nom_expediteur,
        "from_email"=> $result_expediteur[0]->email_expediteur,
        "name"=> $this->input->post ('nom_campagne'),
        "bat"=> '',
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
        'expediteur'      => $result_expediteur[0]->email_expediteur,
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
        $img_link3 = $row_newsletter->newsletter_block_img3;
        $text0 = nl2br($row_newsletter->newsletter_block_text0);
        $text1 = nl2br($row_newsletter->newsletter_block_text1);
        $text2 = nl2br($row_newsletter->newsletter_block_text2);
        $text3 = nl2br($row_newsletter->newsletter_block_text3);
        $text4 = nl2br($row_newsletter->newsletter_block_text4);
        $text5 = nl2br($row_newsletter->newsletter_block_text5);
        $text6 = nl2br($row_newsletter->newsletter_block_text6);
        $text7 = nl2br($row_newsletter->newsletter_block_text7);
        $text8 = nl2br($row_newsletter->newsletter_block_text8);
        $text9 = nl2br($row_newsletter->newsletter_block_text9);
        $text10 = nl2br($row_newsletter->newsletter_block_text10);
        $text11 = nl2br($row_newsletter->newsletter_block_text11);
        $text12 = nl2br($row_newsletter->newsletter_block_text12);
        $text13 = nl2br($row_newsletter->newsletter_block_text13);
        $text14 = nl2br($row_newsletter->newsletter_block_text14);
        $select0 = $row_newsletter->newsletter_block_select0;
        $select1 = $row_newsletter->newsletter_block_select1;
        $select2 = $row_newsletter->newsletter_block_select2;
        $select3 = $row_newsletter->newsletter_block_select3;

        // Choix Select

        $url0 = '';
        $url1 = '';
        $url2 = '';
        $url3 = '';

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

        switch ($select1) {

          case 0:
            $url1 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url1 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url1 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url1 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        switch ($select2) {

          case 0:
            $url2 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url2 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url2 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url2 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        switch ($select3) {

          case 0:
            $url3 = 'https://www.facebook.com/pages/Groupe-Steva/203522023189062';
            break;

          case 1:
            $url3 = 'https://www.instagram.com/villa.beausoleil/?hl=fr';
            break;

          case 2:
            $url3 = 'https://twitter.com/groupesteva';
            break;

          case 3:
            $url3 = 'https://fr.linkedin.com/company/groupe-steva';
            break;

          default:
            // code...
            break;
        }

        $replace = array(
          '{{base_url}}'         => base_url(),
          '{{id_newsletter}}'    => $id_newsletter,
          '{{id_block}}'         => $id_block,
          '{{id_block_html}}'    => $id_block_html,
          '{{id_block_content}}' => $id_block_content,
          '{{nom}}'              => $nom_block,
          '{{ordre}}'            => $ordre,
          '{{img0}}'             => $img_link0,
          '{{img1}}'             => $img_link1,
          '{{img2}}'             => $img_link2,
          '{{img3}}'             => $img_link3,
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
          '{{select0}}'          => $select0,
          '{{select1}}'          => $select1,
          '{{select2}}'          => $select2,
          '{{select3}}'          => $select3,
          '{{displayimg0}}'      => (!empty($img_link0))?'':'display:none;mso-hide:all; ',
          '{{displayimg1}}'      => (!empty($img_link1))?'':'display:none;mso-hide:all; ',
          '{{displayimg2}}'      => (!empty($img_link2))?'':'display:none;mso-hide:all; ',
          '{{displayimg3}}'      => (!empty($img_link2))?'':'display:none;mso-hide:all; ',
          '{{display0}}'         => (!empty($text0))?'':'display:none;mso-hide:all; ',
          '{{display1}}'         => (!empty($text1))?'':'display:none;mso-hide:all; ',
          '{{display2}}'         => (!empty($text2))?'':'display:none;mso-hide:all; ',
          '{{display3}}'         => (!empty($text3))?'':'display:none;mso-hide:all; ',
          '{{display4}}'         => (!empty($text4))?'':'display:none;mso-hide:all; ',
          '{{display5}}'         => (!empty($text5))?'':'display:none;mso-hide:all; ',
          '{{display6}}'         => (!empty($text6))?'':'display:none;mso-hide:all; ',
          '{{display7}}'         => (!empty($text7))?'':'display:none;mso-hide:all; ',
          '{{display8}}'         => (!empty($text8))?'':'display:none;mso-hide:all; ',
          '{{display9}}'         => (!empty($text9))?'':'display:none;mso-hide:all; ',
          '{{display10}}'        => (!empty($text10))?'':'display:nonemso-hide:all; ;',
          '{{display11}}'        => (!empty($text11))?'':'display:nonemso-hide:all; ',
          '{{display12}}'        => (!empty($text12))?'':'display:none;mso-hide:all; ',
          '{{display13}}'        => (!empty($text13))?'':'display:none;mso-hide:all; ',
          '{{display14}}'        => (!empty($text13))?'':'display:none;mso-hide:all; ',
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
      $search = '/<form.*?<\/form>/is';
      $replace = '';
      $newsletter = preg_replace($search,$replace,$newsletter);
      //$search = '/<tr class="display.*?<\/tr>/is';
      //$replace = '';
      //$newsletter = preg_replace($search,$replace,$newsletter);
      $search = '/§§§§/';
      $replace = '"';
      //$newsletter = preg_replace($search,$replace,$newsletter);
      //$search = "/§§/";
      //$replace = '\'';
      $newsletter = preg_replace($search,$replace,$newsletter);

      if ($this->uri->segment(2, 0) == 'preview') {
        echo $newsletter;
      } else {
        return $newsletter;
      }

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
          'id_newsletter' => $id_newsletter,
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
          'text14'        => $this->input->post ('text14'),
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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img0.'.jpg';

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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img1.'.jpg';

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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images//campagne_'.$id_newsletter.'/'.$img2.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
  					"img2" => $img2.'.jpg',
  				);

  				$this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img3"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img2 = 'img'.$d.$u;
          $image_care = $this->input->post ("img3");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images//campagne_'.$id_newsletter.'/'.$img3.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img3" => $img3.'.jpg',
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
          'text14'        => $this->input->post ('text14'),
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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img0.'.jpg';

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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img1.'.jpg';

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

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img2.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img2" => $img2.'.jpg',
          );

          $this->My_common->update_data('newsletter_block_content', 'id', $id_block_content, $data_content);

        }

        if (!empty($_POST["img3"]))
        {

          $d = new dateTime();
          $d = $d->format('YmdHis');
          $u = str_replace(' ', '', substr(microtime(), 2));
          $img2 = 'img'.$d.$u;
          $image_care = $this->input->post ("img3");

          $image_original = $_SERVER['DOCUMENT_ROOT'] . '/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/'.$img3.'.jpg';

          copy($image_care, $image_original);

          $data_content = array (
            "img3" => $img3.'.jpg',
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
          'img_link3' => $result_block[0]->newsletter_block_img3,
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
          'text14'    => $result_block[0]->newsletter_block_text14,
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

  public function delete_block()
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

      $this->load->model('My_categories');
      $this->load->model('My_listes');
      $this->load->model('My_users');
      $this->load->model('My_campagnes');

			$id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION["id_group"];

      // recuperation des listes

      $result_liste = $this->My_listes->get_all_listes($id_group);

			$tab_cat = array();
			$tab_child_cat = array();
      $result = array();

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

			// Informations sur la campagne

      $infos_group = $this->My_users->get_group_infos($id_group);
      $data_campagne = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

			$campagne = $mailin->get_campaigns_v2(array('id' => $data_campagne[0]->id_sendinblue));

      $data = array(
        'id_newsletter' => $id_newsletter,
        'nom_campagne' => $data_campagne[0]->nom_campagne,
    		'result' => $result,
    		'campagne' => $campagne['data'],
    	);

    	$this->load->view('header', $data);
      $this->load->view('campagnes_listes');
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
	}

  public function listes_add()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_categories');
      $this->load->model('My_listes');
      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $data = array();
      $email_array = array();
      $nom_array = array();
      $csv = 'NAME;SURNAME;EMAIL\n';

      // Effacement de liste de contact existante en base

      $this->My_common->delete_data_detail('newsletter_has_contacts', 'id_newsletter', $id_newsletter);

      // enregistrement de la liste de contact

      if (!empty($_POST['id_cat'])) {

        foreach ($_POST['id_cat'] as $key => $value) {

          $result_contact = $this->My_categories->get_contact_by_cat($value);

          foreach ($result_contact as $row_contact) {
            if (count($row_contact->nom) > 0){
              $csv .= $row_contact->nom.';'.$row_contact->prenom.';'.$row_contact->email.'\n';
            } else {
              $csv .= ';;'.$row_contact->email.'\n';
            }
          }

          if (count($result_contact) > 0) {
            $data_contact = array(
              'id_newsletter'				  => $id_newsletter,
              'id_contact'            => $result_contact[0]->id,
            );
            $this->My_common->insert_data('newsletter_has_contacts', $data_contact);
          }

        }

        // Informations sur la campagne

        $infos_group = $this->My_users->get_group_infos($id_group);
        $data_campagne = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

        require(APPPATH.'libraries/Mailin.php');
        $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

  			$campagne = $mailin->get_campaigns_v2(array('id' => $data_campagne[0]->id_sendinblue));

        $data = array(
          'body' => $csv,
          'name' => 'liste_'.$campagne['data'][0]['id'],
        );

        $result = $mailin->import_users($data);

        $id_liste = $result['data']['list_id'][0];

        $code = $result['code'];

        if ($code == 'success'){

          $data_campagne = array(
            'id'				  => $data_campagne[0]->id_sendinblue,
            'listid'			=> array($id_liste),
            'send_now'		=> 0,
          );
          /**echo '<pre>';
          print_r($data);
          echo '</pre>';**/
          $result = $mailin->update_campaign($data_campagne);

          $code = $result['code'];

          if ($code == 'success'){

            echo 'ok';

          } else {

            echo 10;

          }

        }

      } else {

        echo 9;

      }

    } else {
        $this->load->view('login');
    }
  }

  public function envoyer()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_users');
      $this->load->model('My_campagnes');

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION["id_group"];

      // Informations sur la campagne

      $infos_group = $this->My_users->get_group_infos($id_group);
      $data_campagne = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $campagne = $mailin->get_campaigns_v2(array('id' => $data_campagne[0]->id_sendinblue));

      $data = array(
        'id_newsletter' => $id_newsletter,
        'nom_campagne' => $data_campagne[0]->nom_campagne,
        'campagne' => $campagne['data']
      );

      $this->load->view('header', $data);
      $this->load->view('campagnes_envoi_ajouter');
      $this->load->view('footer');

    } else {
        $this->load->view('login');
    }
  }

  public function send()
	{
		if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_users');
      $this->load->model('My_campagnes');

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION["id_group"];
      $date_envoi = $this->My_common->date_fr_mysql($this->input->post ('date_envoi'));
      $heure_envoi = $this->input->post ('heure_envoi') .':'.$this->input->post ('minute_envoi');
      $scheduled_date = $date_envoi.' '.$heure_envoi.':00';

      // Informations sur la campagne

      $infos_group = $this->My_users->get_group_infos($id_group);
      $data_campagne = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $campagne = $mailin->get_campaigns_v2(array('id' => $data_campagne[0]->id_sendinblue));

      if ($this->input->post ('type_envoi') == 1) {
        $data = array(
  				'id'				      => $data_campagne[0]->id_sendinblue,
          'scheduled_date'  => $scheduled_date,
          'html_content'		=> $this->preview(),
  			);
      } else {
        $data = array(
  				'id'				      => $data_campagne[0]->id_sendinblue,
          'html_content'		=> $this->preview(),
  				'send_now'		   	=> 1,
  			);
      }

			$result = $mailin->update_campaign($data);
			$code = $result['code'];

			if ($code == 'success'){

        $data = array(
          'type_envoi'           => $this->input->post ('type_envoi'),
          'date_envoi'           => $date_envoi,
          'heure_envoi'          => $heure_envoi,
          'envoi'                => 1,
        );

        $this->My_common->update_data('newsletter', 'id', $id_newsletter, $data);

        redirect(base_url().'campagnes/envoyees.html');

			} else {

				redirect(base_url().'campagnes/envoyer/'.$id_newsletter.'.html');

			}

  	} else {
      	$this->load->view('login');
  	}
	}

  public function bat()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_users');
      $this->load->model('My_campagnes');
      $this->load->model('My_contacts');

      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION["id_group"];
      $email = $this->input->post ('email');

			$result_contact = $this->My_contacts->check_exist($email, $id_group);

      if (count($result_contact) == 0) {
        $data_contact = array(
          'email'	=> $email,
        );
        $this->My_common->insert_data('contacts', $data_contact);
      }

      // Informations sur la campagne

      $infos_group = $this->My_users->get_group_infos($id_group);
      $data_campagne = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $campagne = $mailin->get_campaigns_v2(array('id' => $data_campagne[0]->id_sendinblue));

      $data = array(
        'id'			     	    => $data_campagne[0]->id_sendinblue,
        'send_now'			    => 0,
        'html_content'			=> $this->preview(),
      );

      $result = $mailin->update_campaign($data);
      $code = $result['code'];

      if ($code == 'success'){

        $data = array(
          'id' => $data_campagne[0]->id_sendinblue,
          'emails' => array($email)
        );

        $mailin->send_bat_email($data);

        redirect(base_url().'campagnes/newsletter/'.$id_newsletter.'.html');

      } else {

        echo 'Erreur';

      }

      } else {
          $this->load->view('login');
      }
  }

  public function duplicate()
  {
    if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $data = array();
      $data_block = array();
      $id_newsletter = $this->uri->segment(3, 0);
      $id_group = $_SESSION['id_group'];
      $image = '';
      $image_copy = '';
      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);
      $result_expediteur = $this->My_campagnes->get_campagne_sender($result_newsletter[0]->expediteur);

      //CREATION DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

      $data = array(
        "category"=> "",
        "from_name"=> $result_expediteur[0]->nom_expediteur,
        "from_email"=> $result_expediteur[0]->email_expediteur,
        "name"=> $result_newsletter[0]->nom_campagne.' copie',
        "bat"=> '',
        "html_content"=> "<html><body></body></html>",
        "html_url"=> "",
        "listid"=> array(),
        "scheduled_date"=> "",
        "subject"=> $result_newsletter[0]->objet,
        "reply_to"=> $result_newsletter[0]->expediteur,
        "to_field"=>"[PRENOM] [NOM]",
        'exclude_list'=> array(),
        "attachment_url"=> "",
        "inline_image"=> 0,
        "mirror_active"=> 0,
        "send_now"=> 0,
        "utm_campaign"=> "",
      );

      $result = $mailin->create_campaign($data);

      if ($result['code'] == 'success') {

        //COPIE DE LA NEWSLETTER

        //AJOUT EN BASE DES INFORMATIONS DE LA CAMPAGNE

        $data = array(
          'nom_campagne'    => $result_newsletter[0]->nom_campagne.' copie',
          'objet'           => $result_newsletter[0]->objet,
          'expediteur'      => $result_newsletter[0]->expediteur,
          'theme'           => $result_newsletter[0]->theme,
          'type_envoi'      => $result_newsletter[0]->type_envoi,
          'date_envoi'      => $result_newsletter[0]->date_envoi,
          'heure_envoi'     => $result_newsletter[0]->heure_envoi,
          'id_group'        => $_SESSION['id_group'],
          'id_sib'          => $result['data']['id'],
        );

        $id_newsletter_copy = $this->My_common->insert_data('newsletter', $data);

        // CREATION DU NOUVEAU DOSSIER

        $result_theme = $this->My_campagnes->get_newsletter_theme($result_newsletter[0]->theme);

        mkdir('mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter_copy);

        // COPIE DES IMAGES VERS LA NOUVELLE NEWSLETTER

        $dir = $_SERVER['DOCUMENT_ROOT'].'/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter.'/';

        $dir_copy = $_SERVER['DOCUMENT_ROOT'].'/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter_copy.'/';

        foreach(scandir($dir) as $file) {
          if ('.' === $file || '..' === $file) continue;
          copy($dir.$file, $dir_copy.$file);
        }

        // COPIE DES DONNEES

        foreach ($result_newsletter as $row_newsletter) {

          $data_content = array (
            'id_newsletter' => $id_newsletter_copy,
            'id_block_html' => $row_newsletter->id_block_html,
            'img0'          => $row_newsletter->newsletter_block_img0,
            'img1'          => $row_newsletter->newsletter_block_img1,
            'img2'          => $row_newsletter->newsletter_block_img2,
            'img3'          => $row_newsletter->newsletter_block_img3,
            'text0'         => $row_newsletter->newsletter_block_text0,
            'text1'         => $row_newsletter->newsletter_block_text1,
            'text2'         => $row_newsletter->newsletter_block_text2,
            'text3'         => $row_newsletter->newsletter_block_text3,
            'text4'         => $row_newsletter->newsletter_block_text4,
            'text5'         => $row_newsletter->newsletter_block_text5,
            'text6'         => $row_newsletter->newsletter_block_text6,
            'text7'         => $row_newsletter->newsletter_block_text7,
            'text8'         => $row_newsletter->newsletter_block_text8,
            'text9'         => $row_newsletter->newsletter_block_text9,
            'text10'        => $row_newsletter->newsletter_block_text10,
            'text11'        => $row_newsletter->newsletter_block_text11,
            'text12'        => $row_newsletter->newsletter_block_text12,
            'text13'        => $row_newsletter->newsletter_block_text13,
            'text14'        => $row_newsletter->newsletter_block_text14,
            'select0'       => $row_newsletter->newsletter_block_select0,
            'select1'       => $row_newsletter->newsletter_block_select1,
            'select2'       => $row_newsletter->newsletter_block_select2,
            'select3'       => $row_newsletter->newsletter_block_select3,
          );

          $id_block_content = $this->My_common->insert_data('newsletter_block_content', $data_content);

          $data_block = array(
            'id_newsletter'    => $id_newsletter_copy,
            'id_block_html'    => $row_newsletter->id_block_html,
            'id_block_content' => $id_block_content,
            'ordre'            => $row_newsletter->newsletter_block_ordre,
          );

          $this->My_common->insert_data('newsletter_has_block', $data_block);
        }

        redirect(base_url().'campagnes/newsletter/'.$id_newsletter_copy.'.html');

      } else {

      }

    } else {
      $this->load->view('login');
    }
  }

  public function archive()
	{

		if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $data = array();
      $data_block = array();
      $id_newsletter = $this->input->post ('id');
      $id_group = $_SESSION['id_group'];

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      //RECUPERATION DES INFOS DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

    	$data = array( 'id'=> $infos_group[0]->api_sib_key );
    	$mailin->delete_campaign($data);

      $data = array(
        'archive'    => 1,
      );

			$this->My_common->update_data('newsletter', 'id', $id_newsletter, $data);

      redirect(base_url().'campagnes/archivees.html');

  	} else {
      	$this->load->view('login');
  	}

	}

  public function delete()
	{

		if ($_SESSION["is_connect"] == TRUE){

      $this->load->model('My_campagnes');
      $this->load->model('My_users');
      $data = array();
      $data_block = array();
      $id_newsletter = $this->input->post ('id');
      $id_group = $_SESSION['id_group'];

      $result_newsletter = $this->My_campagnes->get_newsletter($id_newsletter, $id_group);

      //RECUPERATION DES INFOS DE LA CAMPAGNE CHEZ SEND IN BLUE

      $infos_group = $this->My_users->get_group_infos($id_group);

      require(APPPATH.'libraries/Mailin.php');
      $mailin = new Mailin("https://api.sendinblue.com/v2.0", $infos_group[0]->api_sib_key);

    	$data = array( 'id'=> $infos_group[0]->api_sib_key );
    	$mailin->delete_campaign($data);

      $this->My_common->delete_data('newsletter', $id_newsletter);
      $this->My_common->delete_data_detail('newsletter_has_block', 'id_newsletter', $id_newsletter);
      $this->My_common->delete_data_detail('newsletter_block_content', 'id_newsletter', $id_newsletter);
      $this->My_common->delete_data_detail('newsletter_has_contacts', 'id_newsletter', $id_newsletter);

      $result_theme = $this->My_campagnes->get_newsletter_theme($result_newsletter[0]->theme);
      $dir = $_SERVER['DOCUMENT_ROOT'].'/mediatheque/newsletter/'.$result_theme[0]->nom.'/images/campagne_'.$id_newsletter;

      foreach(scandir($dir) as $file) {
          if ('.' === $file || '..' === $file) continue;
          if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
          else unlink("$dir/$file");
      }
      rmdir($dir);

      redirect(base_url().'campagnes/en_cours.html');

  	} else {
      	$this->load->view('login');
  	}

	}

}
