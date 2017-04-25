<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('categories_model'));
    }

    function Add_categories() {
        $this->load->view('admin_template/Header');
        $this->load->view('categories/Add_categories');
        $this->load->view('admin_template/Footer');
    }

    function list_all_categories() {
        $list_all_categories = $this->categories_model->list_all_categories();
        echo json_encode($list_all_categories);
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
	function create_category(){	
	
		$category_data= array('cat_Name' => $this->input->post('name'));			
	
		$this->categories_model->create_category($category_data);		
		echo $this->db->last_query();exit;

	}
	function edit_category(){
		
		$category_id = $this->uri->segment(3);
		
		$data['category_data'] = $this->categories_model->get_category($category_id);	

		$this->load->view('admin_template/Header');
		
		$this->load->view('categories/Edit_categories',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	function update_category(){
		
	$update_category_data= array(
				'cat_Name' => $this->input->post('name'),
				'enable' => $this->input->post('status')
				
					);
						$category_id = $this->input->post('cat_id');
		
				$this->categories_model->update_category_table($update_category_data,$category_id);
		
	}

}
