<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('categories_model'));
		$this->load->model(array('lockamount_model'));
		$this->load->model(array('offer_model'));
		 $this->load->model(array('general_model', 'users_model', 'wallet_history', 'operators_model', 'service_provider', 'smd','Va_Commisions_model','categories_model','Sub_categories_model'));		
		
    }
	
	public function populat_sub_cat() {
		
		$sub_cat = $this->Sub_categories_model->get_subcategory($_REQUEST['catid']);
		$data = '';
		if(!empty($sub_cat))
		{
			foreach($sub_cat as $key=>$value)
			{
				$data .= '<div  class="sub_cat_dis"><input type="checkbox" class="chksubcat" name="sub_cat[]" value='.$value->sub_cat_id.'###'.str_replace(" ","XXX",$value->sub_cat_name).'>'.$value->sub_cat_name.' </div>';
			}
		}
		echo $data;
		exit;		
    }

    function Add_matrix() {
        $this->load->view('admin_template/Header');
        $this->load->view('supportmatrix/Add_lockamount');
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
	function Edit_lockamount(){
		
		//$id = $this->uri->segment(3);
		$id = 1;
		
		$data['data'] = $this->lockamount_model->get_lockamount($id);	

		$this->load->view('admin_template/Header');
		
		$this->load->view('lockamount/Edit_lockamount',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	
	function Edit_offer(){
		
		//$id = $this->uri->segment(3);
		$id = 1;
		
		$data['data'] = $this->offer_model->get_offer($id);
			$data['categories'] = $this->categories_model->list_all_categories();

		$this->load->view('admin_template/Header');
		
		$this->load->view('offer/Edit_offer2',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	
	function update_offeramount(){
		

					
					$users = implode(",",$this->input->post('users'));
					
	$data= array('offer_amount' => $this->input->post('offer_amount'),
		'min_wallet_amoun' => $this->input->post('min_wallet_amoun'),
		'users' => $users						
		);		
		$id = 1;		
		$this->offer_model->update_offertable($data,$id);
		
		//redirect('Offer/Edit_offer');
		
	}

}
