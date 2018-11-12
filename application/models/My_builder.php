<?php
class My_builder extends CI_Model {

  /************************************************/
	/*         SELECT NEWSLETTER BLOCK              */
	/************************************************/
	function get_newsletter($id_newsletter, $id_group){

		$this->db->select('newsletter.id as id_newsletter, newsletter.theme as theme, newsletter_block_html.id as id_block_html, newsletter_block_html.nom as newsletter_block_nom, newsletter_has_block.id as id_block, newsletter_has_block.id_block_content as id_block_content, newsletter_has_block.ordre as newsletter_block_ordre, newsletter_block_html.type as newsletter_block_type, newsletter_block_html.block_html as newsletter_block_html, newsletter_block_content.img as newsletter_block_img, newsletter_block_content.text as newsletter_block_text, newsletter_block_content.text1 as newsletter_block_text1');
		$this->db->from('newsletter');
		$this->db->join('newsletter_has_block', 'newsletter.id = newsletter_has_block.id_newsletter', 'left');
		$this->db->join('newsletter_block_html', 'newsletter_has_block.id_block_html = newsletter_block_html.id', 'left');
		$this->db->join('newsletter_block_content', 'newsletter_has_block.id_block_content = newsletter_block_content.id', 'left');
		//$this->db->join('block_has_content', 'builder_block.id = block_has_content.id_block', 'left');
		//$this->db->join('newsletter_block_content', 'builder_block.id = newsletter_block_content.id_block', 'left');
		$this->db->where("newsletter.id", $id_newsletter);
    $this->db->where("newsletter.id_group", $id_group);
		$this->db->order_by ('newsletter_has_block.ordre', 'ASC');

		$query = $this->db->get();

		return $query->result();

	}

	/******************************************************/
	/*         SELECT NEWSLETTER BLOCK BY ID             */
	/******************************************************/
	function get_block_by_id($id_newsletter, $id_block_content){

		$this->db->select('newsletter_block_content.img as newsletter_block_img, newsletter_block_content.text as newsletter_block_text, newsletter_block_content.text1 as newsletter_block_text1');
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
