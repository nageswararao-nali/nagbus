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

    function delete_category($cat_id) {
        $delete_category = $this->supportmatrix_model->delete_category($cat_id);
        if ($delete_category) {
            echo json_encode(array("err_code" => 1, "status" => "SUCCESS"));
            exit;
        } else {
            echo json_encode(array("err_code" => 0, "status" => "FAILED"));
            exit;
        }
    }	
	function create_category(){	
	
		$category_data= array('cat_Name' => $this->input->post('name'));			
	
		$this->supportmatrix_model->create_category($category_data);		
		echo $this->db->last_query();exit;

	}
	function edit_category(){
		
		$category_id = $this->uri->segment(3);
		
		$data['category_data'] = $this->supportmatrix_model->get_category($category_id);	

		$this->load->view('admin_template/Header');
		
		$this->load->view('supportmatrix/Edit_supportmatrix',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	function update_category(){
		
	$update_category_data= array(
				'cat_Name' => $this->input->post('name'),
				'enable' => $this->input->post('status')
				
					);
						$category_id = $this->input->post('cat_id');
		
				$this->supportmatrix_model->update_category_table($update_category_data,$category_id);
		
	}

}
