<?php
class My_users extends CI_Model {

  /********************************************/
  /* SELECT TOUTES LES UTILISATEURS           */
  /********************************************/
  function get_all_users($id_group){

    $this->db->select();
		$this->db->from('users');
    $this->db->where("users.id_group = $id_group");
    $this->db->order_by ("nom", "ASC");

    $query = $this->db->get();

    return $query->result();

  }

  /********************************************/
  /*         SELECT UN UTILISATEUR            */
  /********************************************/
  function get_user($id){

    $this->db->select();
    $this->db->from('users');
    $this->db->where("users.id = $id");

    $query = $this->db->get();

    return $query->result();

  }


  /******************************************/
  /* VERIFIE L'EXISTANCE D'UN CONTACT   */
  /******************************************/
  function check_exist($email, $nom){

    $this->db->select();
    $this->db->from('users');
    $this->db->where("users.nom = '".addslashes($nom)."'");
    $this->db->where("users.email = '$email'");

    $query = $this->db->get();

    return $query->result();
  }

}
