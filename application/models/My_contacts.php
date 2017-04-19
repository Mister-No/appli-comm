<?php
class My_contacts extends CI_Model {

  /******************************************/
  /* SELECT TOUTES LES contactsS           */
  /******************************************/
  function get_all_cont(){

    $this->db->select('contacts.*, entreprises.raison_sociale');
		$this->db->from('contacts');
		$this->db->join('entreprises', 'entreprises.id = contacts.id_ent', 'LEFT');
    $this->db->order_by ("nom", "ASC");

    $query = $this->db->get();

    return $query->result();

  }

  /******************************************/
  /* SELECT UNE CATEGORIE PAR ID CONTACT    */
  /******************************************/
  function get_cat_by_id($id){

    $this->db->select();
    $this->db->from('contacts_cat');
    $this->db->where("contacts_cat.id_contact = $id");

    $query = $this->db->get();

    return $query->result();
  }

  function get_cat_total_by_id($id){

    $this->db->select('categorie.titre');
		$this->db->from('contacts_cat');
		$this->db->join('categorie', 'categorie.id = contacts_cat.id_cat', 'LEFT');
		$this->db->where("contacts_cat.id_contact = $id");

		$query = $this->db->get();

    return $query->result();
  }

  /******************************************/
  /* VERIFIE L'EXISTANCE D'UN CONTACT   */
  /******************************************/
  function check_exist($email, $nom){

    $this->db->select();
    $this->db->from('contacts');
    $this->db->where("contacts.nom = '".addslashes($nom)."'");
    $this->db->where("contacts.email = '$email'");

    $query = $this->db->get();

    return $query->result();
  }

  /************************************************/
  /*   SELECT UNE CONTACT PAR ID AVEC ENTREPRISE  */
  /***********************************************/
  function get_ent_by_id($id){

    $this->db->select('contacts.*, entreprises.siret as ent_siret, entreprises.tel as ent_tel, entreprises.fax as ent_fax, entreprises.email as ent_email, entreprises.site_web as ent_site_web, entreprises.num_voie as ent_num_voie, entreprises.nom_voie as ent_nom_voie, entreprises.lieu_dit as ent_lieu_dit, entreprises.bp as ent_bp, entreprises.cp as ent_cp, entreprises.ville as ent_ville, entreprises.cedex as ent_cedex');
    $this->db->from('contacts');
    $this->db->join('entreprises', 'entreprises.id = contacts.id_ent', 'LEFT');
    $this->db->where("contacts.id = $id");

    $query = $this->db->get();

    return $query->result();
  }

  /********************************************/
  /* SUPPRIMER LES CATEGORIE D'UNE ENTREPRISE */
  /********************************************/
  function delete_ent_cat($id){
    $query = $this->db->delete("contacts_cat", array('id_contact' => $id));
  }

}
