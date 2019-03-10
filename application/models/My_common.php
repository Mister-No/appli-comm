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

  //$password = urlencode($password);

  $password = sha1($password);

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

/******************************************/
/*          Fonction de date              */
/******************************************/

function date_mysql_fr($date){
    if ($date != "0000-00-00" && $date != "" && $date != null){
        $my_date =  Datetime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        return $my_date;
    } else {
        return null;
    }
}

function date_fr_mysql($date){
    if ($date != null && $date != '0000-00-00' && trim($date) != '') {
        $my_date =  Datetime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        return $my_date;
    } else {
        return null;
    }
}

function date_us_mysql($date){
    if ($date != null && $date != '0000-00-00' && trim($date) != '') {
        $my_date =  Datetime::createFromFormat('m/d/Y', $date)->format('Y-m-d');
        return $my_date;
    } else {
        return null;
    }
}

function date_mysql_us($date){
    if ($date != "0000-00-00" && $date != "" && $date != null){
        $my_date =  Datetime::createFromFormat('Y-m-d', $date)->format('m/d/Y');
        return $my_date;
    } else {
        return null;
    }
}

function date_mysql_time_fr($date){
    if ($date != null && $date != '0000-00-00 00:00:00' && trim($date) != '') {
        $my_date =  Datetime::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y à H:i');
    } else {
        return null;
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
