<?php
class My_builder extends CI_Model {

  /************************************************/
	/*         SELECT NEWSLETTER BLOCK              */
	/************************************************/
	function get_newsletter($id_newsletter, $id_group){

		$this->db->select('newsletter.id as id_newsletter, newsletter.theme as theme, builder_block_html.id as id_block_html, builder_block_html.nom as builder_block_nom, newsletter_has_block.id as id_block, newsletter_has_block.id_block_content as id_block_content, newsletter_has_block.ordre as builder_block_ordre, builder_block_html.type as builder_block_type, builder_block_html.block_html as builder_block_html, builder_block_content.img as builder_block_img, builder_block_content.text as builder_block_text, builder_block_content.text1 as builder_block_text1');
		$this->db->from('newsletter');
		$this->db->join('newsletter_has_block', 'newsletter.id = newsletter_has_block.id_newsletter', 'left');
		$this->db->join('builder_block_html', 'newsletter_has_block.id_block_html = builder_block_html.id', 'left');
		$this->db->join('builder_block_content', 'newsletter_has_block.id_block_content = builder_block_content.id', 'left');
		//$this->db->join('block_has_content', 'builder_block.id = block_has_content.id_block', 'left');
		//$this->db->join('builder_block_content', 'builder_block.id = builder_block_content.id_block', 'left');
		$this->db->where("newsletter.id", $id_newsletter);
    $this->db->where("newsletter.id_group", $id_group);
		$this->db->order_by ('newsletter_has_block.ordre', 'ASC');

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER BLOCK CONTENT              */
	/********************************************************/
	function get_newsletter_block_content($id_newsletter, $id_group){

		$this->db->select();
		$this->db->from('newsletter');
		$this->db->join('newsletter_has_block', 'newsletter.id = newsletter_has_block.id_newsletter', 'left');
		$this->db->join('builder_block_html', 'newsletter_has_block.id_block = builder_block_html.id', 'left');
		$this->db->join('block_has_content', 'builder_block.id = block_has_content.id_block', 'left');
		$this->db->join('builder_block_content', 'block_has_content.id_block = builder_block_content.id', 'left');
		$this->db->where("newsletter.id", $id_newsletter);
		$this->db->where("newsletter.id_group", $id_group);

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************************/
	/*         SELECT NEWSLETTER BLOCK ID                  */
	/********************************************************/
	function get_newsletter_id_block($id_newsletter){

		$this->db->select();
		$this->db->from('newsletter_has_block');
		$this->db->where("newsletter_has_block.id_newsletter", $id_newsletter);

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
