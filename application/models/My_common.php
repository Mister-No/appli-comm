<?php
class My_common extends CI_Model {

  /******************************************/
/* Loggé ou pas : retourne TRUE si loggé  */
/******************************************/
function logged_in(){
  if ($this->session->userdata('logged_in') == TRUE){
    return(TRUE);
  } else {
    return(FALSE);
  }
}

/******************************************/
/* FUNCTION DE LOGIN                      */
/******************************************/
function login($username,$password){

  $password = urlencode($password);

  //$password = sha1($password);

  $this->db->select();
  $this->db->from('users');
  $this->db->where("login = '$username'");
  $this->db->where("password = '$password'");
  $this->db->where("actif = '1'");
  $query = $this->db->get();

  if($query->num_rows() == 1){
    return $query->result();
  } else {
    return false;
  }

}

/******************************************/
/* FUNCTION DE LOGIN                      */
/******************************************/
function login_recup($username){

  $this->db->select('users.*');
  $this->db->from('users');
  $this->db->where("users.email = '$username'");
  $this->db->limit(1);

  $query = $this->db->get();

  if($query->num_rows() == 1){
    return $query->result();
  } else {
    return false;
  }
}

  /****************************************************************/
	/*       Insere des données dans la base		                		*/
	/****************************************************************/
	function insert_data($table, $data){

		$this->db->insert($table, $data);
		$id =  $this->db->insert_id();
    return $id;

	}

  /****************************************************************/
  /* suppression by id dans la base                 			    */
  /****************************************************************/
  function delete_data($table, $id){

      $query = $this->db->delete($table, array('id' => $id));

  }

  /****************************************************************/
	/*  mise a jour des données dans la base		                    */
	/****************************************************************/
	function update_data($table, $champs, $id, $data){

		$this->db->where($champs, $id);
		$this->db->update($table, $data);

	}

}
