<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supportmatrix extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('categories_model'));
		$this->load->model(array('supportmatrix_model'));
    }

    function Add_matrix() {
        $this->load->view('admin_template/Header');
        $this->load->view('supportmatrix/Add_supportmatrix');
        $this->load->view('admin_template/Footer');
    }

    function list_all_supportmatrix() {
        $list_all_supportmatrix = $this->supportmatrix_model->list_all_supportmatrix();
        echo json_encode($list_all_supportmatrix);
    }

    function delete_supportmatrix($id) {
        $delete_supportmatrix = $this->supportmatrix_model->delete_supportmatrix($id);
        if ($delete_supportmatrix) {
            echo json_encode(array("err_code" => 0, "status" => "SUCCESS"));
            exit;
        } else {
            echo json_encode(array("err_code" => 1, "status" => "FAILED"));
            exit;
        }
    }	
	function create_supportmatrix(){	
	
		$data= array('email' => $this->input->post('email'),
		'contact_no' => $this->input->post('contact_no'),
		'timings' => $this->input->post('timings'),
		'comments' => $this->input->post('comments'),
		'role_id' => $this->input->post('role_id'),
		'support_type' => $this->input->post('support_type')						
		);	
	
		$this->supportmatrix_model->create_supportmatrix($data);		
		echo $this->db->last_query();exit;

	}
	function edit_supportmatrix(){
		
		$id = $this->uri->segment(3);
		
		$data['data'] = $this->supportmatrix_model->get_supportmatrix($id);	

		$this->load->view('admin_template/Header');
		
		$this->load->view('supportmatrix/Edit_supportmatrix',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	function update_supportmatrix(){
		
	/*$update_category_data= array(
				'cat_Name' => $this->input->post('name'),
				'enable' => $this->input->post('status')
				
					);*/
					
	$data= array('email' => $this->input->post('email'),
		'contact_no' => $this->input->post('contact_no'),
		'timings' => $this->input->post('timings'),
		'comments' => $this->input->post('comments'),
		'role_id' => $this->input->post('role_id'),
		'support_type' => $this->input->post('support_type')						
		);	
		
		
						$id = $this->input->post('id');
		
				$this->supportmatrix_model->update_supportmatrixtable($data,$id);
		
	}

}
