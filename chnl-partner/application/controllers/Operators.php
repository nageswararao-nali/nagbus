<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operators extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('operators_model'));		
		$this->load->model('categories_model');
    }

    public function index() {		
	
		$list_all_categories = $this->categories_model->list_all_categories();	
		$categorydata['categorydata'] = json_encode($list_all_categories);
        $this->load->view('admin_template/Header');
        $this->load->view('operators/index',$categorydata);
        $this->load->view('admin_template/Footer');
		
    }
	function edit_operators() {			
	
	$edit_operator_id = $this->uri->segment(3);
	$list_all_categories = $this->categories_model->list_all_categories();
	$categorydata['edit_operator_data'] = $this->operators_model->get_operator_data($edit_operator_id);
	$categorydata['categorydata'] = json_encode($list_all_categories);			
	$this->load->view('admin_template/Header');    
    $this->load->view('operators/edit_operators',$categorydata);     
	$this->load->view('admin_template/Footer');	
	
	}
	function update_operator(){
		
		$update_operator_data= array(
				'cat_id' => $this->input->post('categoryid'),
				'sub_cat_name' => $this->input->post('operator_name'),
				'sub_cat_code' => $this->input->post('operator_code'),
				'sub_cat_desc' => $this->input->post('description')
							);
				$sub_cat_id = $this->input->post('sub_cat_id');
				$this->operators_model->update_operator_model($update_operator_data,$sub_cat_id); 
		
	}
	

    function list_all_operators() {
		
        $list_all_operators = $this->operators_model->list_all_operators();
        echo json_encode($list_all_operators);
		
    }

    function delete_category($cat_id) {
		
        $delete_category = $this->categories_model->delete_category($cat_id);
        if ($delete_category) {
            echo json_encode(array("err_code" => 1, "status" => "SUCCESS"));
            exit;
        } else {
            echo json_encode(array("err_code" => 0, "status" => "FAILED"));
            exit;
        }
    }
	function create_operators(){
			// print_r($_POST);
			
	 	$operator_data= array(
				'cat_id' => $this->input->post('categoryid'),
				'sub_cat_name' => $this->input->post('operator_name'),
				'sub_cat_code' => $this->input->post('operator_code'),
				'sub_cat_desc' => $this->input->post('description')
				
							);
							
		$this->operators_model->insert_operators($operator_data); 
		
		
	}

}
