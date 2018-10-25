<?php
class My_builder extends CI_Model {

  /******************************************/
	/*         SELECT NEWSLETTER              */
	/******************************************/
	function get_newsletter($id_news, $id_group){

		$this->db->select();
		$this->db->from('builder_block');
		$this->db->where("builder_block.id", $id_news);
    $this->db->where("builder_block.id_group", $id_group);

		$query = $this->db->get();

		return $query->result();
	}

}
