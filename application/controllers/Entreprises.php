<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entreprises extends CI_Controller {

  public function index()
  {
    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_entreprises');

      $id_group = $_SESSION['id_group'];

      $result = $this->My_entreprises->get_all_ent($id_group);

      $data = array(
          'result' => $result,
      );

      $this->load->view('header', $data);
      $this->load->view('entreprises');
      $this->load->view('footer');

    } else {
          $this->load->view('login');
    }
  }

  public function ajouter()
  {

    if ($_SESSION['is_connect'] == TRUE){

          $this->load->view('header');
          $this->load->view('entreprises_ajouter');
          $this->load->view('footer');

      } else {
          $this->load->view('login');
      }
  }

  public function modifier()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_categories');
			$this->load->model('My_entreprises');

			$id = $this->uri->segment(3, 0);

	        $result = $this->My_entreprises->get_ent_by_id($id);
	        $resultc = $this->My_entreprises->get_cat_by_id($id);

          $result_cat = '';

          foreach ($resultc as $rowc) {
            $result_cat[] = $rowc->id_cat;
          }

	        $data = array(
	            "result" => $result,
	            "result_cat" => $result_cat,
	        );

			    $this->load->view('header', $data);
	        $this->load->view('entreprises_modifier');
	        $this->load->view('footer');

    	} else {
        	$this->load->view('login');
    	}
	}

  public function add()
	{

		if ($_SESSION['is_connect'] == TRUE){

      $id_group = $_SESSION['id_group'];

      var_dump($id_group);

			$data = array(
        'id_group' 		    => $id_group,
				'id_parent' 		  => $this->input->post('id_parent'),
				'raison_sociale' 	=> $this->input->post('raison_sociale'),
				'siret' 			    => $this->input->post('siret'),
				'tel' 				    => $this->input->post('tel'),
				'fax' 				    => $this->input->post('fax'),
				'email' 			    => $this->input->post('email'),
				'site_web' 			  => $this->input->post('site_web'),
				'num_voie' 			  => $this->input->post('num_voie'),
				'nom_voie' 			  => $this->input->post('nom_voie'),
				'lieu_dit' 			  => $this->input->post('lieu_dit'),
				'bp' 				      => $this->input->post('bp'),
				'cp' 				      => $this->input->post('cp'),
				'ville' 			    => $this->input->post('ville'),
				'cedex' 			    => $this->input->post('cedex'),
			);

	        $id = $this->My_common->insert_data ('entreprises', $data);

	        foreach ($_POST['id_cat'] as $key => $value) {
	        	$data =array (
	        		'id_ent' => $id,
	        		'id_cat' => $value,
	        	);
	        	$this->My_common->insert_data ('entreprises_cat', $data);
	        }

			redirect('entreprises');

    	} else {
        	$this->load->view('login');
    	}

	}

	public function update()
	{

		if ($_SESSION['is_connect'] == TRUE){

			$this->load->model('My_entreprises');

	        $this->My_entreprises->delete_ent_cat($this->input->post('id'));

			$data = array(
				'id'      		    => $this->input->post('id'),
				'id_parent'    		=> $this->input->post('id_parent'),
				'raison_sociale' 	=> $this->input->post('raison_sociale'),
				'siret' 			    => $this->input->post('siret'),
				'tel' 				    => $this->input->post('tel'),
				'fax' 			     	=> $this->input->post('fax'),
				'email' 	     		=> $this->input->post('email'),
				'site_web' 			  => $this->input->post('site_web'),
				'num_voie' 		 	  => $this->input->post('num_voie'),
				'nom_voie' 	  		=> $this->input->post('nom_voie'),
				'lieu_dit'   			=> $this->input->post('lieu_dit'),
				'bp'       				=> $this->input->post('bp'),
				'cp' 				      => $this->input->post('cp'),
				'ville'      			=> $this->input->post('ville'),
				'cedex'      			=> $this->input->post('cedex'),
			);

	        $this->My_common->update_data('entreprises', 'id', $this->input->post('id'), $data);

	        foreach ($_POST['id_cat'] as $key => $value) {
	        	$data =array (
	        		'id_ent' => $this->input->post('id'),
	        		'id_cat' => $value,
	        	);
	        	$this->My_common->insert_data ('entreprises_cat', $data);
	        }


			redirect('entreprises');

    	} else {
        	$this->load->view('login');
    	}

	}

  public function delete()
  {

    if ($_SESSION['is_connect'] == TRUE){

      $this->load->model('My_entreprises');

          $this->My_common->delete_data('entreprises', $this->input->post('id'));
          $this->My_entreprises->delete_ent_cat($this->input->post('id'));

      redirect('entreprises');

    } else {
          $this->load->view('login');
    }

  }

}
