<?php
class My_entreprises extends CI_Model {

	/******************************************/
	/* SELECT TOUTES LES ENTREPRISES           */
	/******************************************/
	function get_all_ent(){

		$this->db->select();
		$this->db->from('entreprises');
    $this->db->order_by ("raison_sociale", "ASC");

		$query = $this->db->get();

		return $query->result();
	}

	/******************************************/
	/* SELECT UNE ENTREPRISES PAR ID           */
	/******************************************/
	function get_ent_by_id($id){

		$this->db->select();
		$this->db->from('entreprises');
		$this->db->where("entreprises.id = $id");

		$query = $this->db->get();

		return $query->result();
	}


	/********************************************/
	/* SELECT UNE ENTREPRISES PAR ID ENTREPRISE */
	/********************************************/
	function get_cat_by_id($id){

		$this->db->select();
		$this->db->from('entreprises_cat');
		$this->db->where("entreprises_cat.id_ent = $id");

		$query = $this->db->get();

		return $query->result();
	}

	/********************************************/
	/* SUPPRIMER LES CATEGORIE D'UNE ENTREPRISE */
	/********************************************/
	function delete_ent_cat($id){
		$query = $this->db->delete("entreprises_cat", array('id_ent' => $id));
	}

}
