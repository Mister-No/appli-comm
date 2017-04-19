<?php
class My_categories extends CI_Model {

  /******************************************/
	/* SELECT TOUTES LES CATEGORIES PARENT    */
	/******************************************/
	function get_all_parent_cat(){

		$this->db->select();
		$this->db->from('categorie');
		$this->db->where("categorie.id_parent = 0");
    $this->db->order_by ("titre", "ASC");

		$query = $this->db->get();

		return $query->result();
	}

  /******************************************/
  /* SELECT TOUTES LES CATEGORIES           */
  /******************************************/
  function get_all_cat(){

    $this->db->select();
    $this->db->from('categorie');
    $this->db->order_by ("titre", "ASC");

    $query = $this->db->get();

    return $query->result();
  }

  /******************************************/
	/* SELECT TOUTES LES CATEGORIES ENFANT    */
	/******************************************/
	function get_child_cat($id){

		$this->db->select();
		$this->db->from('categorie');
		$this->db->where("categorie.id_parent = $id");
    $this->db->order_by ("titre", "ASC");

		$query = $this->db->get();

		return $query->result();
	}

  /******************************************/
  /* SELECT UNE CATEGORIES PAR ID           */
  /******************************************/
  function get_cat_by_id($id){

    $this->db->select();
    $this->db->from('categorie');
    $this->db->where("categorie.id = $id");

    $query = $this->db->get();

    return $query->result();
  }

  /******************************************/
  /* VERIFIE L'EXISTANCE D'UNE CATEGORIE   */
  /******************************************/
  function check_exist($titre){

    $this->db->select();
    $this->db->from('categorie');
    $this->db->where("categorie.titre = '".addslashes($titre)."'");

    $query = $this->db->get();

    return $query->result();
  }

}
