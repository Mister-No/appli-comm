<?php
class My_campagnes extends CI_Model {

	/********************************************************/
	/*        				 SELECT ALL CAMPAGNES	   			        */
	/********************************************************/
	function get_all_campagnes($id_group){

		$this->db->select('newsletter.id as id_newsletter, newsletter.id_group, theme, nom_campagne, objet, expediteur, envoi_programme, date_envoi, heure_envoi, id_sib, id_theme');
		$this->db->from('newsletter');
		$this->db->join('group_has_theme', 'group_has_theme.id_theme = newsletter.theme', 'left');
		$this->db->where("group_has_theme.id_group", $id_group);
		$this->db->order_by('newsletter.nom_campagne', 'ASC');

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER THEMES BY GROUP	          */
	/********************************************************/
	function get_newsletter_themes_by_group($id_group){

		$this->db->select();
		$this->db->from('newsletter_themes');
		$this->db->join('group_has_theme', 'group_has_theme.id_theme = newsletter_themes.id', 'left');
		$this->db->where("group_has_theme.id_group", $id_group);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER THEMES BY GROUP	          */
	/********************************************************/
	function get_newsletter_themes_by_id_newsletter($id){

		$this->db->select('newsletter_themes.nom');
		$this->db->from('newsletter_themes');
		$this->db->join('newsletter', 'newsletter.theme = newsletter_themes.id', 'left');
		$this->db->where("newsletter.id", $id);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER TEMPLATE	BY THEMES          */
	/********************************************************/
	/**function get_id_block_html_by_theme_and_template($theme){

		$this->db->select();
		$this->db->from('newsletter_block_html');
		$this->db->where("newsletter_block_html.theme", $theme);
		$this->db->where("newsletter_block_html.template !=", NULL);
		$this->db->order_by('newsletter_block_html.template', 'ASC');

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER TEMPLATE	CONTENT         */
	/********************************************************/
	function get_template_content($id){

		$this->db->select();
		$this->db->from('newsletter_template_content');
		$this->db->join('newsletter_block_html_template_has_content', 'newsletter_block_html_template_has_content.template_block_content = newsletter_template_content.id', 'left');
		$this->db->where("newsletter_block_html_template_has_content.template_block_html", $id);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER THEMES BY TEMPLATE	          */
	/********************************************************/
	function get_id_block_html_by_theme_and_template($theme, $template){

		$this->db->select('newsletter_block_html.id');
		$this->db->from('newsletter_block_html');
		$this->db->where("newsletter_block_html.theme", $theme);
		$this->db->where("newsletter_block_html.template", $template);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER THEME 			                */
	/********************************************************/
	function get_newsletter_theme($id_theme){

		$this->db->select();
		$this->db->from('newsletter_themes');
		$this->db->where("newsletter_themes.id", $id_theme);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT ID SEND IN BLUE 			                */
	/********************************************************/
	function get_id_send_in_blue($id_newsletter){

		$this->db->select('id_sib');
		$this->db->from('newsletter');
		$this->db->where('newsletter.id', $id_newsletter);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->result();
	}

  /************************************************/
	/*         SELECT NEWSLETTER BLOCK              */
	/************************************************/
	function get_newsletter($id_newsletter, $id_group){

		$this->db->select('newsletter.id as id_newsletter, newsletter.id_sib as id_sendinblue, newsletter.expediteur as expediteur, newsletter.objet as objet, newsletter.theme as theme, newsletter.nom_campagne as nom_campagne, newsletter.envoi_programme as envoi_programme, newsletter.date_envoi as date_envoi, newsletter.heure_envoi as heure_envoi, newsletter_block_html.id as id_block_html, newsletter_block_html.nom as newsletter_block_nom, newsletter_has_block.id as id_block, newsletter_has_block.id_block_content as id_block_content, newsletter_has_block.ordre as newsletter_block_ordre, newsletter_block_html.type as newsletter_block_type, newsletter_block_html.block_html as newsletter_block_html, newsletter_block_content.img0 as newsletter_block_img0, newsletter_block_content.img1 as newsletter_block_img1, newsletter_block_content.img2 as newsletter_block_img2, newsletter_block_content.text0 as newsletter_block_text0, newsletter_block_content.text1 as newsletter_block_text1, newsletter_block_content.text2 as newsletter_block_text2, newsletter_block_content.text3 as newsletter_block_text3, newsletter_block_content.text4 as newsletter_block_text4, newsletter_block_content.text5 as newsletter_block_text5, newsletter_block_content.text6 as newsletter_block_text6, newsletter_block_content.text7 as newsletter_block_text7, newsletter_block_content.text8 as newsletter_block_text8, newsletter_block_content.text9 as newsletter_block_text9, newsletter_block_content.text10 as newsletter_block_text10, newsletter_block_content.text11 as newsletter_block_text11, newsletter_block_content.text12 as newsletter_block_text12, newsletter_block_content.text13 as newsletter_block_text13, newsletter_block_content.text14 as newsletter_block_text14, newsletter_block_content.select0 as newsletter_block_select0, newsletter_block_content.select1 as newsletter_block_select1, newsletter_block_content.select2 as newsletter_block_select2, newsletter_block_content.select3 as newsletter_block_select3');
		$this->db->from('newsletter');
		$this->db->join('newsletter_has_block', 'newsletter.id = newsletter_has_block.id_newsletter', 'left');
		$this->db->join('newsletter_block_html', 'newsletter_has_block.id_block_html = newsletter_block_html.id', 'left');
		$this->db->join('newsletter_block_content', 'newsletter_has_block.id_block_content = newsletter_block_content.id', 'left');
		//$this->db->join('block_has_content', 'builder_block.id = block_has_content.id_block', 'left');
		//$this->db->join('newsletter_block_content', 'builder_block.id = newsletter_block_content.id_block', 'left');
		$this->db->where("newsletter.id", $id_newsletter);
    $this->db->where("newsletter.id_group", $id_group);
		$this->db->order_by('newsletter_has_block.ordre', 'ASC');

		$query = $this->db->get();

		return $query->result();

	}

	/******************************************************/
	/*         SELECT NEWSLETTER BLOCK BY ID             */
	/******************************************************/
	function get_block_by_id($id_newsletter, $id_block_content){

		$this->db->select('newsletter_block_content.img0 as newsletter_block_img0, newsletter_block_content.img1 as newsletter_block_img1, newsletter_block_content.img2 as newsletter_block_img2, newsletter_block_content.text0 as newsletter_block_text0, newsletter_block_content.text1 as newsletter_block_text1, newsletter_block_content.text2 as newsletter_block_text2, newsletter_block_content.text3 as newsletter_block_text3, newsletter_block_content.text4 as newsletter_block_text4, newsletter_block_content.text5 as newsletter_block_text5, newsletter_block_content.text6 as newsletter_block_text6, newsletter_block_content.text7 as newsletter_block_text7, newsletter_block_content.text8 as newsletter_block_text8, newsletter_block_content.text9 as newsletter_block_text9, newsletter_block_content.text10 as newsletter_block_text10, newsletter_block_content.text11 as newsletter_block_text11, newsletter_block_content.text12 as newsletter_block_text12, newsletter_block_content.text13 as newsletter_block_text13, newsletter_block_content.text14 as newsletter_block_text14, newsletter_block_content.select0 as newsletter_block_select0, newsletter_block_content.select1 as newsletter_block_select1, newsletter_block_content.select2 as newsletter_block_select2, newsletter_block_content.select3 as newsletter_block_select3');
		$this->db->from('newsletter_block_content');
		$this->db->join('newsletter_has_block', 'newsletter_block_content.id = newsletter_has_block.id_block_content', 'left');
		$this->db->where("newsletter_has_block.id_newsletter", $id_newsletter);
		$this->db->where("newsletter_block_content.id", $id_block_content);

		$query = $this->db->get();

		return $query->result();

	}

	/********************************************************/
	/*         SELECT BUILDER BLOCK				                  */
	/********************************************************/
	function get_builder_block($theme){

		$this->db->select();
		$this->db->from('builder_block_type');
		$this->db->where("builder_block_type.theme", $theme);
		$this->db->where("builder_block_type.affichage", 1);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER BLOCK BY ID                */
	/********************************************************/
	function get_newsletter_id_block($id_newsletter){

		$this->db->select();
		$this->db->from('newsletter_has_block');
		$this->db->where("newsletter_has_block.id_newsletter", $id_newsletter);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER BLOCK BY ORDRE             */
	/********************************************************/
	function get_newsletter_block_by_ordre($id_newsletter, $ordre) {

		$this->db->select();
		$this->db->from('newsletter_has_block');
		$this->db->where("newsletter_has_block.id_newsletter", $id_newsletter);
		$this->db->where("newsletter_has_block.ordre", $ordre);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->result();
	}

	/****************************************************************/
	/*  mise a jour de l'ordre des block builder             */
	/****************************************************************/

	function update_data($table, $champs, $id, $data){

		$this->db->where($champs, $id);
		$this->db->update($table, $data);

	}

}
