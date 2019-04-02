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
  /* SELECT TOUTES LES UTILISATEURS           */
  /********************************************/
  function get_all_users_super_admin(){

    $this->db->select();
    $this->db->from('users');
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
  function get_all_group(){

    $this->db->select();
    $this->db->from('group_infos');
    $this->db->order_by ('id_group', 'ASC');

    $query = $this->db->get();

    return $query->result();

  }

  /********************************************/
  /*         SELECT UN UTILISATEUR            */
  /********************************************/
  function get_user_group($id_group){

    $this->db->select();
    $this->db->from('group_infos');
    $this->db->where('group_infos.id_group', $id_group);

    $query = $this->db->get();

    return $query->result();

  }

  /********************************************************/
  /*           SELECT LES SUCCURSALES D'UN GROUPE         */
  /********************************************************/
  function get_all_succursales($id_group) {

    $this->db->select();
    $this->db->from('succursales');
    $this->db->where('succursales.id_group', $id_group);

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
