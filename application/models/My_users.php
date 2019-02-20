<?php
class My_users extends CI_Model {

  /********************************************************/
  /* SELECT TOUTES LES INFOS DU GROUPE DE L'UTILISATEUR   */
  /********************************************************/
  function get_group_infos($id_group){

    $this->db->select();
    $this->db->from('group_infos');
    $this->db->where("group_infos.id_group = $id_group");

    $query = $this->db->get();

    return $query->result();

  }

  /********************************************/
  /* SELECT TOUTES LES UTILISATEURS           */
  /********************************************/
  function get_all_users($id_group){

    $this->db->select();
		$this->db->from('users');
    $this->db->where("users.id_group = $id_group");
    $this->db->order_by ('nom', 'ASC');

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

  /********************************************/
  /*      SELECT TOUTES LES CLIENTS           */
  /********************************************/
  function get_all_clients(){

    $this->db->select('users.id_group, users.entreprise');
    $this->db->distinct();
    $this->db->from('users');
    $this->db->order_by ('entreprise', 'ASC');

    $query = $this->db->get();

    return $query->result();

  }

  /********************************************/
  /*         SELECT UN UTILISATEUR            */
  /********************************************/
  function get_user_entreprise($id_group){

    $this->db->select();
    $this->db->from('entreprises');
    $this->db->where('entreprises.id_group', $id_group);
    $this->db->where('entreprises.id_parent', 0);

    $query = $this->db->get();

    return $query->result();

  }

  /******************************************/
  /*  VERIFIE L'EXISTANCE D'UN UTILISATEUR  */
  /******************************************/
  function check_exist($email, $login='rien', $id_group='rien', $id='rien'){

    $this->db->select();
    $this->db->from('users');
    $this->db->where("users.email = '$email'");
    if($id != 'rien' || $id_group != 'rien' || $login != 'rien'){
      $this->db->where("users.login = '$login'");
      $this->db->where("users.id_group = '$id_group'");
      $this->db->where("users.id != '$id'");
    }

    $query = $this->db->get();

    return $query->result();
  }

}
