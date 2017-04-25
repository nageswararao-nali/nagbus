<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    var $userrole = '';

    function __construct() {
        parent::__construct();
        //$this->load->model('admin_model', 'admin', TRUE);
        $this->load->database();
        $this->load->model(array('general_model', 'users_model', 'wallet_history', 'operators_model', 'service_provider', 'smd','Va_Commisions_model','categories_model','Sub_categories_model'));		
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"> ', '</div>');
    	
    }
	
	public function browseplan()
	{
		if(isset($_FILES["userfile"]["name"]))
		{
				//print("<pre>");
				//print_r($_FILES);
				try {
								//echo APPPATH . 'PHPExcel_1.8.0/Classes/PHPExcel.php';;
								require_once APPPATH . 'PHPExcel_1.8.0/Classes/PHPExcel.php';
								$inputFileName = $_FILES["userfile"]["tmp_name"];
								$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
								$objReader = PHPExcel_IOFactory::createReader($inputFileType);
								$objPHPExcel = $objReader->load($inputFileName);
							} catch(Exception $e) {
								die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
							}

							//  Get worksheet dimensions
							
							for($she=0;$she <1;$she++)
							{
							$sheet = $objPHPExcel->getSheet($she);
							
							$operator_id = 4;//BSNL
							//$circle_id = $sheet->getTitle();
							$circle_id = $_REQUEST['state_id'];//die;
							if( $circle_id == "AP" )
							{
								$circleid = "1";
							}
							else if ( $circle_id == "AS")
							{
								$circleid = "2";
							}
							else if ( $circle_id == "BR")
							{
								$circleid = "3";
							}
							else if ( $circle_id == "Chennai")
							{
								$circleid = "4";
							}
							else if ( $circle_id == "Delhi")
							{
								$circleid = "5";
							}
							else if ( $circle_id == "GJ")
							{
								$circleid = "6";
							}
							else if ( $circle_id == "HP")
							{
								$circleid = "7";
							}
							else if ( $circle_id == "HR")
							{
								$circleid = "8";
							}
							else if ( $circle_id == "JK")
							{
								$circleid = "9";
							}
							else if ( $circle_id == "KA")
							{
								$circleid = "10";
							}
							else if ( $circle_id == "KL")
							{
								$circleid = "11";
							}
							else if ( $circle_id == "Kolkata")
							{
								$circleid = "12";
							}
							else if ( $circle_id == "MH")
							{
								$circleid = "13";
							}
							else if ( $circle_id == "MP")
							{
								$circleid = "14";
							}
							else if ( $circle_id == "Mumbai")
							{
								$circleid = "15";
							}
							else if ( $circle_id == "NE")
							{
								$circleid = "16";
							}
							else if ( $circle_id == "OR")
							{
								$circleid = "17";
							}
							else if ( $circle_id == "PB")
							{
								$circleid = "18";
							}
							else if ( $circle_id == "RJ")
							{
								$circleid = "19";
							}
							else if ( $circle_id == "TN")
							{
								$circleid = "20";
							}
							else if ( $circle_id == "UPE")
							{
								$circleid = "21";
							}
							else if ( $circle_id == "UPW")
							{
								$circleid = "22";
							}
							else if ( $circle_id == "WB")
							{
								$circleid = "23";
							}
							
							$this->wallet_history->deletebrowseplan_previous_record($circleid,$operator_id);
							
							//END DELETE OLD DATA.
							
							//END DELETE OLD DATA.
							
							//echo $sheet->getTitle();

							//var_dump($sheet);die;
							$highestRow = $sheet->getHighestRow(); 
							$highestColumn = $sheet->getHighestColumn();
							
							$rowsData = array();
							//print("<pre>");
							//  Loop through each row of the worksheet in turn							
							$flag = true;
							for ($row = 2; $row <= $highestRow; $row++){ 
								//  Read a row of data into an array
								$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
																NULL,
																TRUE,
																FALSE);
								//  Insert row data array into your database of choice here
								//print_r($rowData);
								/*$ingredient_type = 7;
								$sql = "INSERT INTO items SET paramname ='d_all_topping' ";		
								$result = mysqli_query($conn,$sql);
								$item_id = mysqli_insert_id($conn);
								$sql = "INSERT INTO toppings SET ingredient_type ='".$ingredient_type."'
											,language_id =1
											,item_id ='".$item_id."'
											,name ='".addslashes($rowData[0][0])."'";
								$result = mysqli_query($conn,$sql);
								
								if (!$result) {
									$flag = false;
									echo "Error details: " . mysqli_error($conn) . ".";
									break;
								}


								$sql = "INSERT INTO toppings SET ingredient_type ='".$ingredient_type."'
											,language_id =2
											,item_id ='".$item_id."'
											,name ='".addslashes($rowData[0][1])."'";
								$result = mysqli_query($conn,$sql);
								if (!$result) {
									$flag = false;
									echo "Error details: " . mysqli_error($conn) . ".";
									break;
								}*/
								
								
								//$result = mysql_query($sql);
								
								if(trim($rowData[0][0]) != '' )
								{
									
								
								 $browse_data = array(
                'recharge_offer_circle_id' => $circleid,
				'recharge_offer_operators_id' => $rowData[0][6],
                'price' => $rowData[0][0],
                'talktime' => $rowData[0][1],                
                'validity' => $rowData[0][2],
                'benifits' => $rowData[0][3]
               
            );             
            $wallet_data = $this->wallet_history->insertbrowseplan($browse_data,$rowData[0][4]); //2nd parameter is category id.
			}
			
			
								
								
							}
							}
							
							/*if (!$result) {
								$flag = false;
								echo "Error details: " . mysqli_error($conn) . ".";
							}

							if ($flag) {
								mysqli_commit($conn);
								//echo "All queries were executed successfully";
							} else {
								mysqli_rollback($conn);
								//echo "All queries were rolled back";
							}*/
		}

	    $data["browse_plan"] = $this->wallet_history->getbrowseplan();
		//print("<pre>");
		//print_r($data["browse_plan"]);
		$this->load->view('admin_template/Header');
		$this->load->view('dashboard/agents/browseplan',$data);
		$this->load->view('admin_template/Footer');
	}
	
	public function wallethistory() {
		
		//$data['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();		
		//$data['categories'] = $this->categories_model->list_all_categories();
		if(!empty($_REQUEST['role_id']))
		{
			$data['user_details'] = $this->users_model->all_users($_REQUEST['role_id']);
		}
		else{
		$data['user_details'] = $this->users_model->all_users_wallet(0);	
		}
		
		
		//print_r($data['user_details']);die;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallethistory', $data);
        $this->load->view('admin_template/Footer');
    }
	
	
	
	public function get_comm_by_id() {
		$data = $this->users_model->get_comm_by_id($_REQUEST["id"]);
		echo json_encode($data);
		exit;
	}
	public function get_offer_comm_by_id() {
		$data = $this->users_model->get_offer_comm_by_id($_REQUEST["id"]);
		echo json_encode($data);
		exit;
	}
	//update_offer_comm_by_id
	public function update_offer_comm_by_id() {
		$data["id"] = $_REQUEST["id"];
		$data["our_comm_type"] = $_REQUEST["our_comm_type"];
		$data["our_comm_value"] = $_REQUEST["our_comm_value"];
		$data["agent_comm_type"] = $_REQUEST["agent_comm_type"];
		$data["agent_comm_value"] = $_REQUEST["agent_comm_value"];
		$data["agent_ref_comm_type"] = $_REQUEST["agent_ref_comm_type"];
		$data["agent_ref_comm_value"] = $_REQUEST["agent_ref_comm_value"];
		$data["mark_comm_type"] = $_REQUEST["mark_comm_type"];
		$data["mark_comm_value"] = $_REQUEST["mark_comm_value"];
		$data["dis_type"] = $_REQUEST["dis_comm_type"];
		$data["dis_value"] = $_REQUEST["dis_comm_value"];
		$data = $this->Va_Commisions_model->update_offer_comm_by_id($data);
		echo 1;
		exit;
	}
	public function update_comm_by_id() {
		$data["id"] = $_REQUEST["id"];
		$data["our_comm_type"] = $_REQUEST["our_comm_type"];
		$data["our_comm_value"] = $_REQUEST["our_comm_value"];
		$data["agent_comm_type"] = $_REQUEST["agent_comm_type"];
		$data["agent_comm_value"] = $_REQUEST["agent_comm_value"];
		$data["agent_ref_comm_type"] = $_REQUEST["agent_ref_comm_type"];
		$data["agent_ref_comm_value"] = $_REQUEST["agent_ref_comm_value"];
		$data["mark_comm_type"] = $_REQUEST["mark_comm_type"];
		$data["mark_comm_value"] = $_REQUEST["mark_comm_value"];
		$data["dis_type"] = $_REQUEST["dis_comm_type"];
		$data["dis_value"] = $_REQUEST["dis_comm_value"];
		$data = $this->Va_Commisions_model->update_comm_by_id($data);
		echo 1;
		exit;
	}

    public function index() {
        $this->load->view('admin_template/Header');
		$data["users"] = $this->users_model->get_users_lists_cnt();
		$data["users_today"] = $this->users_model->get_users_lists_cnt_today();
		
		$data["tot_wallet"] = $this->users_model->get_tot_dash_wallet();
		$data["today_wallet"] = $this->users_model->get_today_dash_wallet();
		$data["today_wallet_users"] = $this->users_model->get_today_dash_wallet_users();
		$data["today_wallet_agents"] = $this->users_model->get_today_dash_wallet_agents();
		$data["month_wallet"] = $this->users_model->get_month_dash_wallet();
		$data["agent_wallet"] = $this->users_model->get_agent_dash_wallet();
		//print_r($users);		
        $this->load->view('index', $data);
        $this->load->view('admin_template/Footer');
    }
	
	function Commission_categories() {
		$data['categories'] = $this->categories_model->list_all_categories();		
		$data['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();
		
		$this->load->view('admin_template/Header');
        $this->load->view('dashboard/Commission_categories',$data);
        $this->load->view('admin_template/Footer');
    }

    public function API_credentials() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_credentials');
        $this->load->view('admin_template/Footer');
    }

    public function API_list() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_List');
        $this->load->view('admin_template/Footer');
    }

    public function API_setup() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_setup');
        $this->load->view('admin_template/Footer');
    }

    public function categories() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/categories');
        $this->load->view('admin_template/Footer');
    }

    public function Modules() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/Modules');
        $this->load->view('admin_template/Footer');
    }

    public function Business_Promotions() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Promotions/Business_Promotions');
        $this->load->view('admin_template/Footer');
    }

    public function Purchase_Promotions() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Promotions/Purchase_Promotions');
        $this->load->view('admin_template/Footer');
    }

    public function Add_services() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Service_Provider/Add_services');
        $this->load->view('admin_template/Footer');
    }

    public function Approve_Service_Providers() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Service_Provider/Approve_Service_Providers');
        $this->load->view('admin_template/Footer');
    }

    public function Add_categories() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Add_categories');
        $this->load->view('admin_template/Footer');
    }

    public function Add_Modules() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Add_Modules');
        $this->load->view('admin_template/Footer');
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
	public function populat_sub_cat_search() {
		
		$sub_cat = $this->Sub_categories_model->get_subcategory($_REQUEST['catid']);
		$data = '';
		if(!empty($sub_cat))
		{
			foreach($sub_cat as $key=>$value)
			{
				if($_REQUEST['catid'] != 22 )
				{
					$data .= '<div  class="sub_cat_dis"><input type="checkbox" class="chksubcat" name="sub_cat[]" value='.$value->sub_cat_id.'>'.$value->sub_cat_name.' </div>';
				}
				else
				{
					$data .= '<div class="sub_cat_dis"><input class="chksubcat" name="sub_cat[]" value="81" type="checkbox">All Buses </div>';
					break;
				}
				
			}
		}
		echo $data;
		exit;		
    }
	

	
	
	public function Commission() {
		
		$data['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();
		$data['comm_limitedoffer_detils'] = $this->Va_Commisions_model->get_comm_limited_offer_details();
		//print("<pre>");
		//print_r($data['comm_limitedoffer_detils']);die;
		$data['categories'] = $this->categories_model->list_all_categories();			 
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Commission', $data);
        $this->load->view('admin_template/Footer');
    }
	
	public function Orders() {	
		
		$search_params	= array();
		if( isset($_REQUEST["search"]) )
		{
			if(!empty($_REQUEST["st_date"]))
			{
				$st_date = explode("/",$_REQUEST["st_date"]);
				$search_params["st_date"] = $st_date[2]."-".$st_date[1]."-".$st_date[0];
			}
			if(!empty($_REQUEST["end_date"]))
			{
				$end_date = explode("/",$_REQUEST["end_date"]);
				$search_params["end_date"] = $end_date[2]."-".$end_date[1]."-".$end_date[0];
			}
			if(!empty($_REQUEST["agent_id"]))
			{
				$search_params["agent_id"] = $_REQUEST["agent_id"];
			}
			if(!empty($_REQUEST["cnl_part"]))
			{
				$search_params["cnl_part"] = $_REQUEST["cnl_part"];
			}
			if(!empty($_REQUEST["cat_id"]))
			{
				$search_params["cat_id"] = $_REQUEST["cat_id"];
			}
			if(!empty($_REQUEST["sub_cat"]))
			{
				$search_params["sub_cat"] = implode(",",$_REQUEST["sub_cat"]);
			}
			
			
			
		}
		$data['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();		
		$data['categories'] = $this->categories_model->list_all_categories();
		$data['agents'] = $this->categories_model->list_all_users(6);
		$data['ch_partners'] = $this->categories_model->list_all_users(2);
		$data['order_details'] = $this->Va_Commisions_model->order_details($search_params);
		
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Orders', $data);
        $this->load->view('admin_template/Footer');
    }
	
	public function Ordersfail() {	
		
		$search_params	= array();
		if( isset($_REQUEST["search"]) )
		{
			if(!empty($_REQUEST["st_date"]))
			{
				$st_date = explode("/",$_REQUEST["st_date"]);
				$search_params["st_date"] = $st_date[2]."-".$st_date[1]."-".$st_date[0];
			}
			if(!empty($_REQUEST["end_date"]))
			{
				$end_date = explode("/",$_REQUEST["end_date"]);
				$search_params["end_date"] = $end_date[2]."-".$end_date[1]."-".$end_date[0];
			}
			if(!empty($_REQUEST["agent_id"]))
			{
				$search_params["agent_id"] = $_REQUEST["agent_id"];
			}
			if(!empty($_REQUEST["cnl_part"]))
			{
				$search_params["cnl_part"] = $_REQUEST["cnl_part"];
			}
			if(!empty($_REQUEST["cat_id"]))
			{
				$search_params["cat_id"] = $_REQUEST["cat_id"];
			}
			if(!empty($_REQUEST["sub_cat"]))
			{
				$search_params["sub_cat"] = implode(",",$_REQUEST["sub_cat"]);
			}
			
			
			
		}
		$data['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();		
		$data['categories'] = $this->categories_model->list_all_categories();
		$data['agents'] = $this->categories_model->list_all_users(6);
		$data['ch_partners'] = $this->categories_model->list_all_users(2);
		$data['order_details'] = $this->Va_Commisions_model->order_details_fail($search_params);
		
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Ordersfail', $data);
        $this->load->view('admin_template/Footer');
    }
	
	
	public function Save_comm_cat()
	{
		$user_data = array();
		$user_data['category_id'] = $this->input->post('cat_id');
		$user_data['our_comm_type'] = $this->input->post('our_comm_type');
		$user_data['our_comm_value']= $this->input->post('our_comm_value');			
		$user_data['agent_comm_type'] = $this->input->post('agent_comm_type');
		$user_data['agent_comm_value']= $this->input->post('agent_comm_value');			
		$user_data['agent_ref_comm_type'] = $this->input->post('agent_ref_comm_type');
		$user_data['agent_ref_comm_value']= $this->input->post('agent_ref_comm_value');		
		$this->Va_Commisions_model->savecommdata($user_data);
		redirect(base_url() . 'dashboard/Commission_categories/');
		exit;
	}
	
	
	public function deletecomm()
	{
		$this->Va_Commisions_model->delete_comm_cat_subcat();
		redirect(base_url() . 'dashboard/Commission');
		exit;
	}
	public function deletechannelcomm()
	{
		$this->Va_Commisions_model->deletechannelcomm();
		redirect(base_url() . 'dashboard/Commission_distribute');
		exit;
	}
	public function Save_comm_cat_subcat()
	{
		
		$sub_cat_all = $this->input->post('all_sub_cat');
		$sub_cat = $this->input->post('sub_cat');
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
			$user_data['bill_type'] = $this->input->post('bill_type');
			$user_data['sub_cat_id'] = $sub_cat_ids;
			$user_data['subcategory_id'] = $subcategory_id;			
			$user_data['sub_cat_names'] = $sub_cat_names;
			$user_data['our_comm_type'] = $this->input->post('our_comm_type');
			$user_data['our_comm_value']= $this->input->post('our_comm_value');			
			$user_data['agent_comm_type'] = $this->input->post('agent_comm_type');
			$user_data['agent_comm_value']= $this->input->post('agent_comm_value');			
			$user_data['agent_ref_comm_type'] = $this->input->post('agent_ref_comm_type');
			$user_data['agent_ref_comm_value']= $this->input->post('agent_ref_comm_value');	
			$user_data['mark_comm_type'] = $this->input->post('mark_comm_type');
			$user_data['mark_comm_value']= $this->input->post('mark_comm_value');	
			$user_data['dis_type'] = $this->input->post('dis_type');
			$user_data['dis_value']= $this->input->post('dis_value');			
			$this->Va_Commisions_model->savecommdatacatsubcat($user_data);
		}
		
		/*$sub_cat_ids = rtrim($sub_cat_ids,",");
		$sub_cat_names = rtrim($sub_cat_names,",");	
        if(!empty($sub_cat_all))	
		{
			$sub_cat_ids = 0;
		}
		*/
		
		redirect(base_url() . 'dashboard/Commission');
		exit;
	}
	
	 public function Savecommission() {		 
		 $user_data = array();
		 $user_data['our_commission_amount']= '';
		 $user_data['our_commission_percentage']= '';
		 $user_data['agent_commission_amount']= '';
		 $user_data['agent_commission_percentage']= '';
		 $user_data['markup_commission_amount']= '';
		 $user_data['markup_commission_percentage']= '';
		 $user_data['discount_amount']= '';
		 $user_data['discount_percentage']= '';
		 $user_data['agent_reference_commission_amount']= '';
		 $user_data['agent_reference_commission_percentage']= '';
		 
		 
		$our_comm_type = $this->input->post('our_comm_type');
		 if(!empty($our_comm_type))
		 {
			if($our_comm_type == 'R')
			{
				$user_data['our_commission_amount']= $this->input->post('our_comm_value');				
			}
			else
			{
				$user_data['our_commission_percentage'] = $this->input->post('our_comm_value');
			}
				
		 }
		 //2nd
		 $agt_comm_type = $this->input->post('agt_comm_type');
		 if(!empty($agt_comm_type))
		 {
			if($agt_comm_type == 'R')
			{
				$user_data['agent_commission_amount']= $this->input->post('agt_comm_value');				
			}
			else
			{
				$user_data['agent_commission_percentage'] = $this->input->post('agt_comm_value');
			}
				
		 }
		 
		 //3rd		 
		 $agt_ref_comm_type = $this->input->post('agt_ref_comm_type');
		 if(!empty($agt_ref_comm_type))
		 {
			if($agt_ref_comm_type == 'R')
			{
				$user_data['agent_reference_commission_amount']= $this->input->post('agt_ref_comm_value');				
			}
			else
			{
				$user_data['agent_reference_commission_percentage'] = $this->input->post('agt_ref_comm_value');
			}
				
		 }
		 
		 //4th		 
		 $mark_comm_type = $this->input->post('mark_comm_type');
		 if(!empty($mark_comm_type))
		 {
			if($mark_comm_type == 'R')
			{
				$user_data['markup_commission_amount']= $this->input->post('mark_comm_value');				
			}
			else
			{
				$user_data['markup_commission_percentage'] = $this->input->post('mark_comm_value');
			}
				
		 }
		 
		 //5th		 
		 $dis_type = $this->input->post('dis_type');
		 if(!empty($dis_type))
		 {
			if($dis_type == 'R')
			{
				$user_data['discount_amount']= $this->input->post('dis_value');				
			}
			else
			{
				$user_data['discount_percentage'] = $this->input->post('dis_value');
			}
				
		 }	 
		
        $this->Va_Commisions_model->insert($user_data);
			
		echo "Success";	
			
		 exit;
		 
	 }
	
	
    public function save_cnl_part_comm()
	{
		$user_data = array(
                'type' => $this->input->post('type'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'district' => $this->input->post('district'),
                'smd_percentage' => $this->input->post('smd_percentage'),
                'term1_period' => $this->input->post('term1_period'),
                'term1_percentage' => $this->input->post('term1_percentage'),
                'term2_period	' => $this->input->post('term2_period'),
                'term2_percentage' => $this->input->post('term2_percentage'),
                'term3_percentage' => $this->input->post('term3_percentage'),
               
            );			
		$this->Va_Commisions_model->savechanneldata($user_data);
		redirect(base_url() . 'dashboard/Commission_distribute');	
		exit;
	}
    public function Commission_distribute() {
		
			$data['comm_detils'] = $this->Va_Commisions_model->get_cnl_part_comm_details();	
			$data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });


                

                ';
				
				
				
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Commission_distribute',$data);
       $this->load->view('admin_template/Footer', $footerData);
    }

    public function Job() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Job');
        $this->load->view('admin_template/Footer');
    }

    public function User_under_agent_commission() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/User_under_agent_commission');
        $this->load->view('admin_template/Footer');
    }

    // only for practice
    public function practice() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/practice');
        $this->load->view('admin_template/Footer');
    }

    // end parctice
    // channel partner Started here
    public function channel_partner() {
        $this->userrole = 2;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_check_channel_partner');
        if ($this->form_validation->run() === FALSE) {
            $data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });
                

                ';
            $data['channel'] = $this->users_model->all_users($this->userrole);
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/Channel_partner/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);
            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'password' => $this->input->post('password'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'role_id' => 2
            );
            if ($this->users_model->insert($user_data)) {
                $this->session->set_flashdata('msg', array('success' => 'Channel Partner created successfully'));
                redirect(base_url() . 'dashboard/channel_partner/');
            } else {

                $this->session->set_flashdata('msg', array('error' => 'System error, please try again.'));
                redirect(base_url() . 'dashboard/channel_partner/');
            }
        }
    }

    function check_channel_partner() {

        if ($this->userrole == 2) {
            $dynamic_username = 'Channel Partner';
        } else if ($this->userrole == 6) {
            $dynamic_username = 'Agent';
        } else if ($this->userrole == 5) {
            $dynamic_username = 'Sales Marketing Department';
        }
        $email_address = $this->input->post("email_address");
        $where = " WHERE role_id = '$this->userrole' and email_id = '$email_address'";
        $user_details = $this->users_model->get_user_details($where);
        if (count($user_details) > 0) {

            $this->form_validation->set_message('check_channel_partner', "{$dynamic_username} already existed with given email address");
            return false;
        }
        if ($this->userrole == 2) {
            $country = $this->input->post("country");
            $state = $this->input->post("state");
            $district = $this->input->post("district");

            $where = " WHERE role_id = '$this->userrole' and country_name = '$country' and state_name = '$state' and district_name = '$district'";
            $cha_partner_details = $this->users_model->get_user_details($where);
            if (count($cha_partner_details) > 0) {
                $this->form_validation->set_message('check_channel_partner', "{$dynamic_username} already existed with respective of Country, State & District");
                return false;
            }
        }

        return true;
    }

    function get_states_cities_etc($country_code, $states_code = NULL, $district_code = NULL) {

        if (!empty($country_code) && empty($states_code) && empty($district_code)) {
            // show states
            $states = $this->general_model->get_states(urldecode($country_code));
            echo form_dropdown("state", $states, "", "class='form-control' id='state'");
            exit;
        } else if (!empty($country_code) && !empty($states_code) && empty($district_code)) {
            // show districts
            $districts = $this->general_model->get_districts(urldecode($country_code), urldecode($states_code));
            echo form_dropdown("district", $districts, "", "class='form-control' id='district'");
            exit;
        } else if (!empty($country_code) && !empty($states_code) && !empty($district_code)) {
            // cities
            $cities = $this->general_model->get_cities(urldecode($country_code), urldecode($states_code), urldecode($district_code));
            echo form_dropdown("city", $cities, "", "class='form-control' id='city'");
            exit;
        }
    }

    function update_channel_partner($user_id = NULL) {
        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/channel_partner/');
        }
        $this->userrole = 2;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/Channel_partner/update', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'Channel Partner data updated successfully'));
            redirect(base_url() . 'dashboard/channel_partner/');
        }
    }
	
	function add_user_money($user_id = NULL, $page = "agent") {
        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/');
        }
        $this->userrole = 2;

        $this->form_validation->set_rules('wallet', 'Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $("#addUserMoney").validate({
                              rules: {                                    
                                      wallet: {required:true, digits:true}                         
                                      },
                              messages: {
                                      wallet:{required:"Please enter Money", digits: "Please enter valid Money"}
                              }
                      });  
					  $("#mark_as_credit").click(function(){
                        if ($(this).prop("checked")==true){ 
                            $(".mark_as_credit_notes_div").removeClass("hidden");
                        }else{
                            $(".mark_as_credit_notes_div").addClass("hidden");
                        }
                      });
                ';

            $where = " WHERE user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);
            $data['page'] = $page;
            
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/wallet/add', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $mark_credit =  $this->input->post('mark_as_credit');
            if((int) $mark_credit == 1){
                $mark_credit = '1';
                $notes = $this->input->post('mark_as_credit_notes');
            }else{
                $mark_credit = '0';
                $notes = '';
            }
            
            $where = " WHERE user_id = '$user_id'";
            $user_details = $this->users_model->get_user_details($where);
            $new_amount = $this->input->post('wallet');
            $old_amount = $user_details[0]['wallet'];
            $balance = $old_amount + $new_amount;
            
            // updating wallet amount in user table            
            $user_data = array(
                'wallet' => $balance
            );            
            $user_data = $this->users_model->user_update($user_data, $user_id);
            
            // adding new record wallet history table
            
            $wallet_data = array(
                'operator_id' => 0,
                'operator_type' => '0',
                'user_id' => $user_details[0]['user_id'],
                'role_id' => $user_details[0]['role_id'],
                'amount' => $new_amount,
                'payment_status' => 'SUCCESS',
                'mark_credit' => $mark_credit,
                'notes' => $notes,
                'create_dt' => date('Y-m-d h:i:s')
            );             
            $wallet_data = $this->wallet_history->insert($wallet_data);
            $msg = "User wallet updated successfully";
            $url = "";
            if ($page == 'channel_partner') {
                $msg = "Channel Partner wallet updated successfully";
                $url = "channel_partner/";
            } else if ($page == 'agent') {
                $msg = "Agent wallet updated successfully";
                $url = "agents/";
            }
            $this->session->set_flashdata('msg', array('success' => $msg));
            redirect(base_url() . 'dashboard/'.$url);
        }
    }
        
    function user_exists() {
        $user_id = $this->uri->segment(3);
        $email_address = $this->input->post("email_address");
        $where = " WHERE role_id = '$this->userrole' and email_id = '$email_address' and user_id <> '$user_id'";
        $data['user_details'] = $this->users_model->get_user_details($where);

        if (count($data['user_details']) > 0) {
            $this->form_validation->set_message('user_exists', 'Channel Partner already existed with given email address');
            return false;
        }
    }

    // Channel Partner Ended here

    public function agents() {
        $this->userrole = 6;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_check_channel_partner');
        if ($this->form_validation->run() === FALSE) {
            $data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addAgents").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });
                

                ';
            $data['user_details'] = $this->users_model->all_users($this->userrole);
            //echo $this->db->last_query();exit;
            //print_r($data['user_details']);exit;
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/agents/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";
            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'password' => $this->input->post('password'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
                'role_id' => '6'
            );
            if ($this->users_model->insert($user_data)) {
                $this->session->set_flashdata('msg', array('success' => 'Agent has been created successfully'));
                redirect(base_url() . 'dashboard/agents/');
            } else {

                $this->session->set_flashdata('msg', array('error' => 'System error, please try again.'));
                redirect(base_url() . 'dashboard/agents/');
            }
        }
    }
	
 public function userlists() {
        $this->userrole = 4;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_check_channel_partner');
        if ($this->form_validation->run() === FALSE) {
            $data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addAgents").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });
                

                ';
            $data['user_details'] = $this->users_model->all_users($this->userrole);
            //echo $this->db->last_query();exit;
            //print_r($data['user_details']);exit;
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/users/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";
            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'password' => $this->input->post('password'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
                'role_id' => '4'
            );
            if ($this->users_model->insert($user_data)) {
                $this->session->set_flashdata('msg', array('success' => 'Agent has been created successfully'));
                redirect(base_url() . 'dashboard/userlists/');
            } else {

                $this->session->set_flashdata('msg', array('error' => 'System error, please try again.'));
                redirect(base_url() . 'dashboard/userlists/');
            }
        }
    }


    function update_agent($user_id) {

        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/agents/');
        }
        $this->userrole = '6';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);
			
			$data['kyc_details'] = $this->users_model->get_user_kyc_details("where User_id = '$user_id'");

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/agents/update', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";

            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
			
			//
			//SMS
								
//Code using curl

//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application. 

//Change your configurations here.
//---------------------------------
$uid="766172696e69696e666f"; //your uid
$pin="ccdb37d4de7737d75924ab4507e03303"; //your api pin
$sender="LAABUS"; // approved sender id
$domain="smsalertbox.com"; // connecting url 
$route="5";// 0-Normal,1-Priority
$method="POST";
//---------------------------------



	$mobile = $this->input->post('mobile_number');
	$name = $this->input->post('name');	
    //$amount=$this->session->userdata('rcAmount');
	
	

	
	//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
  $message = 'Dear '.$name.' your request approved with admin successfully, as an Agent. now you can login with www.laabus.com for exiting offers.';
	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);
	//
            $this->session->set_flashdata('msg', array('success' => 'Agent data has been updated successfully'));
            redirect(base_url() . 'dashboard/agents/');
        }
    }
	
	
 function update_user($user_id) {

        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/userlists/');
        }
        $this->userrole = '4';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);
			
			$data['kyc_details'] = $this->users_model->get_user_kyc_details("where User_id = '$user_id'");

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/users/update', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";

            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'User data has been updated successfully'));
            redirect(base_url() . 'dashboard/userlists/');
        }
    }
	
		   
	   function view_agent($user_id) {

        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/agents/');
        }
        $this->userrole = '6';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/agents/view', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";

            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'Agent data has been updated successfully'));
            redirect(base_url() . 'dashboard/agents/');
        }
    }

    
	  function view_user($user_id) {

        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/userlists/');
        }
        $this->userrole = '4';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateChannelPartner").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/users/view', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";

            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'Agent data has been updated successfully'));
            redirect(base_url() . 'dashboard/agents/');
        }
    }


	public function service_providers() {
        $this->userrole = 3;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_check_channel_partner');
        if ($this->form_validation->run() === FALSE) {
            $data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $data["home_repairs"] = $this->operators_model->list_category_operators(11);
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addServiceProviders").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      home_repairs:{required:true},
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                                      home_repairs:{required:"Please select Home Repair"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });
                

                ';
            $data['user_details'] = $this->service_provider->all_service_providers($this->userrole);
//            echo '<pre>';
//            print_r($data['user_details']);
//            die();
            //echo $this->db->last_query();exit;
            //print_r($data['user_details']);exit;
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/service_providers/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";
            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'password' => $this->input->post('password'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
                'role_id' => '3'
            );
            $sp_user_id = $this->users_model->insert($user_data);
            if ($sp_user_id) {
                $_data = array(
                    'user_id' => $sp_user_id,
                    'sub_cat_id' => $this->input->post('home_repairs'),
                    'lupdate' => date("Y-m-d H:i:s")
                );

                $this->service_provider->insert($_data);
                $this->session->set_flashdata('msg', array('success' => 'Service Provider has been created successfully'));
                redirect(base_url() . 'dashboard/service_providers/');
            } else {

                $this->session->set_flashdata('msg', array('error' => 'System error, please try again.'));
                redirect(base_url() . 'dashboard/service_providers/');
            }
        }
    }

    public function update_service_provider($user_id) {

        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/service_providers/');
        }
        $this->userrole = '3';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateServiceProvider").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE a.role_id = '$this->userrole' and a.user_id = '$user_id'";
            $data['user_details'] = $this->service_provider->get_service_provider_details($where);

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);
            $data["home_repairs"] = $this->operators_model->list_category_operators(11);
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/service_providers/update', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $where = " WHERE role_id = '2' and country_name = '" . $this->input->post('country') . "' and state_name = '" . $this->input->post('state') . "' and district_name = '" . $this->input->post('district') . "' limit 1";

            $cha_partner_details = $this->users_model->get_user_details($where);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'chp_id' => isset($cha_partner_details[0]['user_id']) ? $cha_partner_details[0]['user_id'] : '0',
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $_data = array(
                'sub_cat_id' => $this->input->post('home_repairs'),
                'lupdate' => date("Y-m-d H:i:s")
            );
            $service_provider_data = $this->service_provider->service_provider_update($_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'Service Provider data has been updated successfully'));
            redirect(base_url() . 'dashboard/service_providers/');
        }
    }

    // SMDs  Started here
    public function sales_marketing_department() {
        $this->userrole = 5;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_check_channel_partner');
        if ($this->form_validation->run() === FALSE) {
            $data["countries"] = $this->general_model->get_countries();
            $data["states"] = array("" => "Select State"); //$this->general_model->get_states();
            $data["districts"] = array("" => "Select District"); //$this->general_model->get_districts();
            $data["cities"] = array("" => "Select City"); //$this->general_model->get_districts();
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addSMDs").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
}
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });
                

                ';
            $data['smds'] = $this->users_model->all_users($this->userrole);
            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/smd/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $_data = array(
                'lupdate' => date("Y-m-d H:i:s")
            );
            $smd_id = $this->smd->insert($_data);
            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);
            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'password' => $this->input->post('password'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
                'role_id' => 5,
                'smd_id' => $smd_id
            );
            $user_id = $this->users_model->insert($user_data);
            if ($user_id) {
                $this->session->set_flashdata('msg', array('success' => 'Sales Marketing Department created successfully'));
                redirect(base_url() . 'dashboard/sales_marketing_department/');
            } else {
                $this->session->set_flashdata('msg', array('error' => 'System error, please try again.'));
                redirect(base_url() . 'dashboard/sales_marketing_department/');
            }
        }
    }

    function update_sales_marketing_department($user_id = NULL) {
        if (empty($user_id)) {
            redirect(base_url() . 'dashboard/sales_marketing_department/');
        }
        $this->userrole = 5;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|callback_user_exists');

        if ($this->form_validation->run() === FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#updateSMDs").validate({
                              rules: {                                    
                                      name: {required:true},
				      email_address:{required:true, email:true},
                                      mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},
                                      state:{required:true},
                                      country:{required:true},
                                      district:{required:true},
                                      city:{required:true},
                                      pincode:{required:true},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter Name"},
				      email_address:{required:"Please enter Email Address", email:"Please enter Valid Email Address"},
                                      mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},
                                      state:{required:"Please select State"},
                                      country:{required:"Please select Country"},
                                      district:{required:"Please select District"},
                                      city:{required:"Please select City"},
                                      pincode:{required:"Please enter Pincode"},
                              }
                      });
                
                $("#country").change(function() {
                
                        $("#state").val("");                        
                        $("#district").val("");
                        $("#city").val("");
                        
                    var counry_id = $(this).val();
                    
                    if(!counry_id){
                        $("#state").attr("disabled", true);
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return;
                    }
                    
                    $("#state").attr("disabled", false)
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                    
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#state").html(data);
                            }                            
                          });
                });
                
            $("#state").on("change",function() {
            
                    $("#district").val("");
                    $("#city").val("");
                        
                    var counry_id = $("#country").val();
                    var state_id = $(this).val();
                    if(!state_id) {
                        $("#district").attr("disabled", true);
                        $("#city").attr("disabled", true);
                        return
                    };
                    
                    $("#district").attr("disabled", false);
                    $("#city").attr("disabled", false);
                        
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#district").html(data);
                            }                            
                          });
                });

            $("#district").on("change",function() {           
            
                    $("#city").val("");
                    var counry_id = $("#country").val();
                    var state_id = $("#state").val();
                    var district_id = $(this).val();
                    if(!district_id) {
                        $("#city").attr("disabled", true);
                        return
                    };
                    $("#city").attr("disabled", false);
                    var url = baseurl +"dashboard/get_states_cities_etc/" + counry_id + "/" + state_id + "/" + district_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            cache: false,
                            async: false,
                            success: function(data)
                            {  
                                $("#city").html(data);
                            }                            
                          });
                });               
                ';

            $where = " WHERE role_id = '$this->userrole' and user_id = '$user_id'";
            $data['user_details'] = $this->users_model->get_user_details($where);

            $data["countries"] = $this->general_model->get_countries();

            $data["states"] = $this->general_model->get_states($data['user_details'][0]['country_name']);

            $data["districts"] = $districts = $this->general_model->get_districts($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name']);

            $data["cities"] = $cities = $this->general_model->get_cities($data['user_details'][0]['country_name'], $data['user_details'][0]['state_name'], $data['user_details'][0]['district_name']);

            $this->load->view('admin_template/Header');
            $this->load->view('dashboard/smd/update', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {

            $citypincodeexp = explode('<=>', $this->input->post("city"));
            $city_name = trim($citypincodeexp[0]);
            $pincode_num = trim($citypincodeexp[1]);

            $user_data = array(
                'name' => $this->input->post('name'),
                'email_id' => $this->input->post('email_address'),
                'mobile' => $this->input->post('mobile_number'),
                'country_name' => $this->input->post('country'),
                'state_name' => $this->input->post('state'),
                'district_name' => $this->input->post('district'),
                'city_name' => $city_name,
                'pincode' => $pincode_num,
                'status' => $this->input->post('status'),
            );
            $user_data = $this->users_model->user_update($user_data, $user_id);
            $this->session->set_flashdata('msg', array('success' => 'Sales Marketing Department data updated successfully'));
            redirect(base_url() . 'dashboard/sales_marketing_department/');
        }
    }

}
