<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller  {

  public function index()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

          $id_group = $_SESSION['id_group'];

	        $result_cont = $this->My_contacts->get_all_cont($id_group);

          $result = array();

          foreach ($result_cont as $row) {

              $result_cat = $this->My_contacts->get_cat_total_by_id($row->id);

              $cat = "";
              foreach ($result_cat as $row_cat) {
                $cat .=  $row_cat->titre." / ";
              }

            $all_cat = substr($cat, 0, -3);
            $all_cat = (strlen($all_cat) > 84) ? substr($all_cat,0,84). ' ... ' : $all_cat;

            $temp = array (
                'id' => $row->id,
                'nom' => $row->nom,
                'prenom' => $row->prenom,
                'raison_sociale' => $row->raison_sociale,
                'email' => $row->email,
                'categorie' => $all_cat
              );

            array_push ($result, $temp);

          }

	       $data = array(
	            'result' => $result,
	        );

			    $this->load->view('header', $data);
	        $this->load->view('contacts');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
  }
  
  public function get_liste()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_contacts');

          $id_group = $_SESSION['id_group'];

	        $result_cont = $this->My_contacts->get_all_cont($id_group);

          $result = array();

          foreach ($result_cont as $row) {

              $result_cat = $this->My_contacts->get_cat_total_by_id($row->id);

              $cat = "";
              foreach ($result_cat as $row_cat) {
                $cat .=  $row_cat->titre." / ";
              }

            $all_cat = substr($cat, 0, -3);
            $all_cat = (strlen($all_cat) > 84) ? substr($all_cat,0,84). ' ... ' : $all_cat;

              $bouton = '<div class="btn-group">';
              $bouton .= '<a class="btn btn-success" href="/contacts/modifier/'.$row->id.'"><i class="fa fa-edit"></i></a></div>';
              
              $bouton .= '<div class="btn-group">';
              $bouton .= '<button class="btn btn-success" onclick="popin (\''.$row->id.'\', \''.addslashes($row->nom).'\')" ><i class="fa fa-trash"></i></button></div>';       
            

            $temp = array (
                $row->email,
                $row->nom." ".$row->prenom,
                $all_cat,
                $row->raison_sociale,
                $bouton,
                $row->id,
              );

            array_push ($result, $temp);

          }
          header('Content-Type: application/json');
          $data["data"] = $result;
          echo json_encode ($data);
      
    	} else {
        	$this->load->view('login');
    	}
	}

  public function erreur()
  {
    if ($_SESSION['is_connect'] == TRUE){

      $this->load->view('header');
      $this->load->view('contacts_erreur');
      $this->load->view('footer');

      } else {
          $this->load->view('login');
      }
  }

  public function ajouter()
	{

		if ($_SESSION['is_connect'] == TRUE){

					$this->load->model('My_entreprises');
					$this->load->model('My_categories');

          $id_group = $_SESSION["id_group"];

	        $result_cat = $this->My_categories->get_all_cat($id_group);
	        $result_ent = $this->My_entreprises->get_all_ent($id_group);

	        $data = array(
	            'result_cat' => $result_cat,
	            'result_ent' => $result_ent,
	        );

					$this->load->view('header', $data);
	        $this->load->view('contacts_ajouter');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function modifier()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_contacts');
      $this->load->model('My_users');

      $id = $this->uri->segment(3, 0);
      $id_group = $_SESSION["id_group"];

      $result = $this->My_contacts->get_ent_by_id($id);
      $resultc = $this->My_contacts->get_cat_by_id($id);

      $civ_val1 = '';
      $civ_val2 = '';
      foreach ($result as $row) {
        if ($row->civ == 2) { $civ_val2 = 'selected';}
        if ($row->civ == 1) { $civ_val1 = 'selected';}
      }

      $infos_group = $this->My_users->get_group_infos($id_group);

      // verification du blacklistage :
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".$row->email,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "api-key: ".$infos_group[0]->api_sib_key,
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $response = json_decode ($response);
        if (isset ($response->code))
        {
          if ($result[0]->blacklist == 1) {
            $blacklist = 'checked';
          } else {
            $blacklist = '';
          }
        } else 
        {
          if ($response->emailBlacklisted == 1)
          {
            $blacklist = 'checked'; 
          } else 
          {
            $blacklist = ''; 
          }
        }
        
      $result_cat = array();

      foreach ($resultc as $rowc) {
        $result_cat[] = $rowc->id_cat;
      }

      $data = array(
          'result'     => $result,
          'civ_val1'   => $civ_val1,
          'civ_val2'   => $civ_val2,
          'blacklist'  => $blacklist,
          'result_cat' => $result_cat,
        );

      $this->load->view('header', $data);
      $this->load->view('contacts_modifier');
      $this->load->view('footer');
      

    } else {
        $this->load->view('login');
    }
  }

  public function add()
	{

		if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_listes');
  		$this->load->model('My_categories');
  		$this->load->model('My_users');
  		$this->load->model('My_contacts');

      $id_group = $_SESSION["id_group"];

			$result = $this->My_contacts->check_exist($this->input->post('email'), $id_group);

			if (count($result) > 0) {

		      echo 1;

		  } else {

        $infos_group = $this->My_users->get_group_infos($id_group);

        if ($this->input->post('blacklist') == 'on') {
          $data = array(
            'email'       => $this->input->post('email'),
            'blacklisted' => true,
          );
          $blacklist = 1;
        } else {
          $data = array(
            'email'       => $this->input->post('email'),
            'blacklisted' => false,
          );
          $blacklist = 0;
        }

        $data_update = json_encode ($data);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sendinblue.com/v3/contacts",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data_update,
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "api-key: ".$infos_group[0]->api_sib_key,
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
          echo 1;
        } else {
          $response = json_decode ($response);

          if (isset($response->code))
          {
            echo 1;
          } else 
          {
            $data = array(
              'id' 			    => $this->input->post('id'),
              'id_group' 		=> $id_group,
              'civ' 				=> $this->input->post('civ'),
              'nom' 				=> $this->input->post('nom'),
              'prenom' 			=> $this->input->post('prenom'),
              'fonction' 		=> $this->input->post('fonction'),
              'tel' 				=> $this->input->post('tel'),
              'fax' 				=> $this->input->post('fax'),
              'mobile' 			=> $this->input->post('mobile'),
              'email' 			=> $this->input->post('email'),
              'num_voie' 		=> $this->input->post('num_voie'),
              'nom_voie' 		=> $this->input->post('nom_voie'),
              'lieu_dit' 		=> $this->input->post('lieu_dit'),
              'bp' 				  => $this->input->post('bp'),
              'cp' 				  => $this->input->post('cp'),
              'ville' 			=> $this->input->post('ville'),
              'cedex' 			=> $this->input->post('cedex'),
              'blacklist'   => $blacklist,
            );
    
            $id = $this->My_common->insert_data ('contacts', $data);
    
            if ($this->input->post('id_cat') != '') {
    
              foreach ($_POST['id_cat'] as $key => $value) {
    
                $data =array (
                  'id_contact' => $id,
                  'id_cat' => $value,
                );
    
                $this->My_common->insert_data ('contacts_cat', $data);
    
                $cat_list = $this->My_listes->get_cat_liste($value, $id_group);

                if ($cat_list[0]->id_sib != '') {
    
                  $data_cat_list = array(
                    "listIds" 		=> array ($cat_list[0]->id_sib),
                  );

                  $data_cat_list = json_encode ($data_cat_list, JSON_NUMERIC_CHECK);
    
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".$this->input->post('email'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => $data_cat_list,
                    CURLOPT_HTTPHEADER => array(
                      "accept: application/json",
                      "api-key: ".$infos_group[0]->api_sib_key,
                      "content-type: application/json"
                    ),
                  ));
                  
                  $response = curl_exec($curl);
                  $err = curl_error($curl);
          
                  curl_close($curl);
                  
                  if ($err) {
                    echo 1;
                  } else {
                    $response = json_decode ($response);
                    
                  }
              
                }
    
              }
    
            }
            echo 'ok';
    
          }

        }
        
		  }

    } else {

      echo 3;

    }

	}

  public function update()
	{

		if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_listes');
  		$this->load->model('My_categories');
  		$this->load->model('My_users');
  		$this->load->model('My_contacts');

      $id_group = $_SESSION["id_group"];

      $result = $this->My_contacts->check_exist($this->input->post('email'), $id_group, $this->input->post('id'));

			if (count($result) > 0) {

		     echo 1;

      } else {

        $infos_group = $this->My_users->get_group_infos($id_group);

        if ($this->input->post('blacklist') == 'on') {
          $data = array(
            'emailBlacklisted' => true,
          );
          $blacklist = 1;
        } else {
          $data = array(
            'emailBlacklisted' => false,
          );
          $blacklist = 0;
        }
        $data_update = json_encode ($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".$this->input->post('email'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_POSTFIELDS => $data_update,
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "api-key: ".$infos_group[0]->api_sib_key,
            "content-type: application/json"
          ),
        ));

        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo 2;
        } else {
          echo $response;
          $response = json_decode ($response);

          if (isset ($response->code))
          {
            echo 3;
          }
          else 
          {

            $data = array(
              'id' 		      => $this->input->post('id'),
              'id_ent' 			=> $this->input->post('id_ent'),
              'civ' 				=> $this->input->post('civ'),
              'nom' 				=> $this->input->post('nom'),
              'prenom' 			=> $this->input->post('prenom'),
              'fonction' 		=> $this->input->post('fonction'),
              'tel' 				=> $this->input->post('tel'),
              'fax' 				=> $this->input->post('fax'),
              'mobile' 			=> $this->input->post('mobile'),
              'email' 			=> $this->input->post('email'),
              'num_voie' 		=> $this->input->post('num_voie'),
              'nom_voie' 		=> $this->input->post('nom_voie'),
              'lieu_dit' 		=> $this->input->post('lieu_dit'),
              'bp' 				  => $this->input->post('bp'),
              'cp' 				  => $this->input->post('cp'),
              'ville' 			=> $this->input->post('ville'),
              'cedex' 			=> $this->input->post('cedex'),
              'blacklist'   => $blacklist,
            );
            $this->My_common->update_data('contacts', 'id', $this->input->post('id'), $data);
    
            // Suppression du contact des listes auxquelles il appartient
            $contact_cat = $this->My_contacts->get_contact_cat($this->input->post('id'));
            foreach ($contact_cat as $row_list) {

              $cat_list = $this->My_listes->get_cat_liste($row_list->id_cat, $id_group);

              if ($cat_list[0]->id_sib != '') {

                $data_remove_list = array (
                  "emails" => array ($this->input->post('email')),
                );

                $data_remove_list = json_encode ($data_remove_list);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/".$cat_list[0]->id_sib."/contacts/remove",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => $data_remove_list,
                  CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "api-key: ".$infos_group[0]->api_sib_key,
                    "content-type: application/json"
                  ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);

              }

            }

            $this->My_contacts->delete_ent_cat($this->input->post('id'));
            if ($this->input->post('id_cat') != '') {
    
              // Ajout du contact aux categories et listes choisies
    
              foreach ($_POST['id_cat'] as $key => $value) {
    
                $data =array (
                  'id_contact' => $this->input->post('id'),
                  'id_cat' => $value,
                );
    
                $this->My_common->insert_data('contacts_cat', $data);
    
                $cat_list = $this->My_listes->get_cat_liste($value, $id_group);
    
                if ($cat_list[0]->id_sib != '') {
        
                  $data_cat_list = array(
                    "listIds" 		=> array ($cat_list[0]->id_sib),
                  );

                  $data_cat_list = json_encode ($data_cat_list, JSON_NUMERIC_CHECK);
    
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".$this->input->post('email'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => $data_cat_list,
                    CURLOPT_HTTPHEADER => array(
                      "accept: application/json",
                      "api-key: ".$infos_group[0]->api_sib_key,
                      "content-type: application/json"
                    ),
                  ));
                  
                  $response = curl_exec($curl);
                  $err = curl_error($curl);
          
                  curl_close($curl);
                  
                  if ($err) {
                    echo 1;
                  } else {
                    $response = json_decode ($response);
                    
                  }
    
                }
    
              }
    
            }
            echo 'ok';
    

          }

        }
        




     }

  	} else {

      echo 3;

  	}

	}

  public function delete()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_contacts');

          $this->My_common->delete_data('contacts', $this->input->post('id'));
          $this->My_contacts->delete_ent_cat($this->input->post('id'));

      redirect('contacts');

      } else {
          $this->load->view('login');
      }

  }

  
	public function importer()
	{
		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');

      $id_group = $_SESSION["id_group"];

      $result_cat = $this->My_categories->get_all_cat($id_group);

      $data = array(
        'result_cat' => $result_cat,
      );

			$this->load->view('header', $data);
	    $this->load->view('contacts_importer');
	    $this->load->view('footer');

  	} else {
      	$this->load->view('login');
  	}
	}

	public function import_save()
	{
    if ($_SESSION['is_connect'] == TRUE)
    {

      $this->load->model('My_listes');
  		$this->load->model('My_categories');
  		$this->load->model('My_users');
  		$this->load->model('My_contacts');

			$this->load->library('upload');
			$this->load->helper('url');
			$this->load->helper('text');
			$this->load->helper('directory');

			$config['upload_path'] = 'temp/';
			$config['allowed_types'] = '*';
			$config['max_size'] = '110000';
			$config['overwrite'] = true;

			$file = 'temp.xlsx';

			if ($_FILES['fichier']['name'] != ''){
				$config['file_name'] = $file;
				$this->upload->initialize($config);
        if (!$this->upload->do_upload('fichier'))
        {
					echo 'erreur 1';
          echo $this->upload->display_errors();
        } 
        else 
        {

					require(APPPATH.'libraries/PHPExcel.php');

					$objReader = PHPExcel_IOFactory::createReader('Excel2007');
					$objReader->setReadDataOnly(true);
					$objPHPExcel = $objReader->load("temp/temp.xlsx");
					$objWorksheet = $objPHPExcel->setActiveSheetIndex(0)->toArray(null,true,true,true);

          //Connexion chez send in blue
          $infos_group = $this->My_users->get_group_infos($_SESSION['id_group']);

          foreach ($objWorksheet as $row) 
          {
            if ($row['B'] != 'Nom' && $row['B'] != '')
            {
							$email 	= trim($row['H']);
							$nom 	= trim($row['B']);

							// On verifie si le contact est déjà dans la base :
							$result = $this->My_contacts->check_exist ($email, $_SESSION['id_group']);

              if (count($result) > 0) 
              {
								$id_contact = $result[0]->id;

								// si il est dans la base on verifie si il est dans la categorie
                if (isset($_POST['id_cat']))
                {

                  foreach ($_POST['id_cat'] as $key => $value) 
                  {
										$result_contact_cat = $this->My_contacts->check_contact_cat($value, $id_contact);
                    if (count ($result_contact_cat) == 0)
                    {

                      $data =array (
                        'id_contact' => $id_contact,
                        'id_cat' => $value,
                      );
                      $this->My_common->insert_data ('contacts_cat', $data);

										}
                  }
                  
								}

              } 
              else 
              {
								// Si il est pas dans la base on l'ajoute avec le categorie
                if ($row['B'] != 'nom' && $row['H'] != 'email') 
                {
                  $data = array (
                    'id_group'  => $_SESSION['id_group'],
  	  							'nom' 		  => $nom,
  	  							'email' 	  => $email,
  	  						);
  	  						$id = $this->My_common->insert_data ('contacts', $data);

                  // Ajout dans sendinblue
                  $data = array(
                    'email'       => $email,
                    'blacklisted' => false,
                  );
          
                  $data_update = json_encode ($data);
                  
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendinblue.com/v3/contacts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $data_update,
                    CURLOPT_HTTPHEADER => array(
                      "accept: application/json",
                      "api-key: ".$infos_group[0]->api_sib_key,
                      "content-type: application/json"
                    ),
                  ));
                  
                  $response = curl_exec($curl);
                  $err = curl_error($curl);
          
                  if (isset($_POST['id_cat']))
                  {

                    foreach ($_POST['id_cat'] as $key => $value) 
                    {
                      $data =array (
                        'id_contact' => $id,
                        'id_cat' => $value,
                      );
                      $this->My_common->insert_data ('contacts_cat', $data);
                    }

  				    	  }

                }
              }
              

              
              // Mise à jour des listes dans sendinblue :
              foreach ($_POST['id_cat'] as $key => $value) {
                $cat_list = $this->My_listes->get_cat_liste($value, $_SESSION['id_group']);
                if ($cat_list[0]->id_sib != '') 
                {

                  $data_cat_list = array(
                    "listIds" 		=> array ($cat_list[0]->id_sib),
                  );

                  $data_cat_list = json_encode ($data_cat_list, JSON_NUMERIC_CHECK);

                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".$email,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => $data_cat_list,
                    CURLOPT_HTTPHEADER => array(
                      "accept: application/json",
                      "api-key: ".$infos_group[0]->api_sib_key,
                      "content-type: application/json"
                    ),
                  ));
                  
                  $response = curl_exec($curl);
                  $err = curl_error($curl);
          
                  curl_close($curl);
                  echo "Email importé : ".$row['H']."<br>";
                  echo "Retour d'import : ".$response."<br><br>";

                }
              }
              


					  }
				  }
        }

        //redirect (base_url().'contacts');
      } 
      else 
      {
			  echo 'erreur';
		  }

		  

    } 
    else 
    {
      $this->load->view('login');
  	}
  }
  

}

/*


*/