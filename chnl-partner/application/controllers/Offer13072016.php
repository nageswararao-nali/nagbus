<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
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
		
		$data['offers'] = $this->offer_model->get_offers_all();	
		$data['offersusers'] = $this->offer_model->get_offers_usersall();	
		

		$this->load->view('admin_template/Header');
		
		$this->load->view('offer/Edit_offer2',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	
	
	function Edit_wallet(){
		
		//$id = $this->uri->segment(3);
		$id = 1;
		
		$data['data'] = $this->offer_model->get_offer($id);
		//$data['categories'] = $this->categories_model->list_all_categories();
		
		$data['offers'] = $this->offer_model->get_wallet_offers_all();		

		$this->load->view('admin_template/Header');
		
		$this->load->view('offer/Edit_wallet2',$data);
		
        $this->load->view('admin_template/Footer');
		
	}
	
	public function delete_wallet_offer()
	{
		$this->db->query('delete from joining_wallet_offers where id = ' . $_REQUEST["id"]);
		echo 1;
		exit;
	}
	public function delete_offer()
	{
		$this->db->query('delete from user_joining_product_offers where id = ' . $_REQUEST["id"]);
		echo 1;
		exit;
	}
	
	public function delete_useroffer()
	{
		$this->db->query('delete from joining_offers where id = ' . $_REQUEST["id"]);
		echo 1;
		exit;
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
	
	function update_walletofferamountnew(){
		
		//print("<pre>");
		//print_r($_REQUEST);
		
		$st_date = $this->input->post('st_date');
		$st_date = explode("/",$st_date);
		$st_date = $st_date[2]."-".$st_date[1]."-".$st_date[0];
		
		$end_date = $this->input->post('end_date');
		$end_date = explode("/",$end_date);
		$end_date = $end_date[2]."-".$end_date[1]."-".$end_date[0];
		
		$title = $this->input->post('title');
		$promo_code = $this->input->post('promo_code');
		$description = $this->input->post('description');
		
		
		foreach($_REQUEST['org_amount'] as $key => $value)
		{
			$user_data = array();
			
			$users = array();			
			if($key == 0)
				$users = @implode(",",$_REQUEST['users'][0]);
			else
				$users = @implode(",",$_REQUEST['users'][6]);
			
			if(!empty($value))
			{
			$user_data['org_amount'] = $value;			
			$user_data['add_amount'] = $_REQUEST['add_amount'][$key];
			$user_data['offer_type'] = $_REQUEST['offer_type'][$key];
			$user_data['offer_mode'] = $_REQUEST['offer_mode'][$key];						
			$user_data['start_date'] = $st_date;
			$user_data['end_date'] = $end_date;
			$user_data['users_type_ids']= $users;
			$user_data['title']= $title;
			$user_data['promo_code']= $promo_code;
			$user_data['description']= $description;
			$this->offer_model->update_walletoffertableprodnew($user_data);
			}
		}
		
		/*$messages['id'] = 1;
		$messages['wallet_offers'] = $this->input->post('wallet_offers');
		$messages['wallet_offers_user'] = $this->input->post('wallet_offers_user');
		$messages['wallet_offers_user_under_agent'] = $this->input->post('wallet_offers_user_under_agent');		
		$this->offer_model->update_offermsg($messages);*/
		
		
		
		exit;
	}
	
	function update_offeramountnew(){
		
		//print("<pre>");
		//print_r($_REQUEST);//update_offertablenew
		
			$users = array();
			$avl_options =array();
			
			$st_date = $this->input->post('st_date');
		$st_date = explode("/",$st_date);
		$st_date = $st_date[2]."-".$st_date[1]."-".$st_date[0];
		
		$end_date = $this->input->post('end_date');
		$end_date = explode("/",$end_date);
		$end_date = $end_date[2]."-".$end_date[1]."-".$end_date[0];
		
		$title = $this->input->post('title');
		$promo_code = $this->input->post('promo_code');
		$description = $this->input->post('description');
		
		
		
			$users = @implode(",",$this->input->post('users'));
			$avl_options = @$this->input->post('avl_options');
					
	$data= array('offer_amount' => $this->input->post('offer_amount'),
		'min_wallet_amoun' => $this->input->post('min_wallet_amoun'),
		'users' => $users,
		'st_date' => $st_date,
		'end_date' => $end_date,
		'avl_options' => $avl_options,
'title' => $title,
'promo_code' => $promo_code,
'description' => $description	
		
		);		
		
		if(!empty($users))
			$this->offer_model->update_offertablenew($data);
		
		
		$messages['id'] = 1;
		$messages['joining_offers'] = $this->input->post('joining_offers');
		$messages['joining_offers_user'] = $this->input->post('joining_offers_user');
		$messages['joining_offers_user_under_agent'] = $this->input->post('joining_offers_user_under_agent');		
		$this->offer_model->update_offermsg($messages);
		
		
		///
		$sub_cat_all = $this->input->post('all_sub_cat');
		$sub_cat = $this->input->post('sub_cat');
		
		$st_date = $this->input->post('st_date');
		$st_date = explode("/",$st_date);
		$st_date = $st_date[2]."-".$st_date[1]."-".$st_date[0];
		
		$end_date = $this->input->post('end_date');
		$end_date = explode("/",$end_date);
		$end_date = $end_date[2]."-".$end_date[1]."-".$end_date[0];
		
		$sub_cat_ids = "";
		$sub_cat_names = "";
		foreach($sub_cat as $key=>$value )
		{
			$val2 = explode("###",$value);
			$sub_cat_ids .= $val2[0].",";
			$sub_cat_names = str_replace("XXX"," ",$val2[1]);
			$subcategory_id = $val2[0];
			
			$user_data = array();
			$user_data['category_id'] = $this->input->post('cat_id');			
			$user_data['sub_cat_id'] = $sub_cat_ids;
			$user_data['subcategory_id'] = $subcategory_id;			
			$user_data['sub_cat_names'] = $sub_cat_names;					
			$user_data['st_date']= $st_date;
			$user_data['end_date']= $end_date;
			$user_data['users_type_ids']= $users;
			$user_data['discount_type']= $this->input->post('discount_type');
			$user_data['discount_value']= $this->input->post('discount_value');
			
			$user_data['title']= $title;
			$user_data['promo_code']= $promo_code;
			$user_data['description']= $description;
			
			$this->offer_model->update_offertableprodnew($user_data);
		}
		///
		
		
		exit;
	}

}
