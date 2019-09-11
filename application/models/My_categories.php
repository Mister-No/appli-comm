<?php
class My_categories extends CI_Model {

  /******************************************/
	/* SELECT TOUTES LES CATEGORIES PARENT    */
	/******************************************/
	function get_all_parent_cat($id_group){

		$this->db->select();
		$this->db->from('categorie');
		$this->db->where("categorie.id_parent = 0");
    $this->db->where("categorie.id_group = $id_group");
    $this->db->order_by("titre", "ASC");

		$query = $this->db->get();

		return $query->result();
	}

  /******************************************/
  /* SELECT TOUTES LES CATEGORIES           */
  /******************************************/
  function get_all_cat($id_group){

    $this->db->select();
    $this->db->from('categorie');
    $this->db->where("categorie.id_group = $id_group");
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
  function check_exist($titre, $id_group, $id='rien'){

    $this->db->select();
    $this->db->from('categorie');
    $this->db->where("categorie.titre = '".addslashes($titre)."'");
    if($id != 'rien'){
      $this->db->where("categorie.id != '$id'");
    }

    $query = $this->db->get();

    return $query->result();
  }

  function delete_cat($table, $id){

  if ($table == 'liste_cat' || $table == 'contacts_cat' || $table == 'entreprises_cat' ) {

      $query = $this->db->delete($table, array('id_cat' => $id));

    } else {

      $this->db->where('id', $id);
      $this->db->or_where('id_parent', $id);
      $this->db->delete($table);

    }

  }

  /******************************************/
  /* SELECT TOUTES LES CATEGORIES ENFANT    */
  /******************************************/
  function get_contact_by_cat($id){

    //$this->db->select('contacts.*');
    $this->db->distinct('contacts.*');
    $this->db->from('contacts_cat');
    $this->db->join('contacts', 'contacts.id = contacts_cat.id_contact');
    $this->db->where("contacts_cat.id_cat = $id");

    $query = $this->db->get();

    return $query->result();
  }

	function get_mail_contact_by_cat($id){

		$this->db->select('contacts.email');
		//$this->db->distinct('contacts.email');
		$this->db->from('contacts_cat');
		$this->db->join('contacts', 'contacts.id = contacts_cat.id_contact');
		$this->db->where("contacts_cat.id_cat = $id");

		$query = $this->db->get();

		return $query->result();
	}

}
