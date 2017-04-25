<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel_partner extends CI_Controller {
	function __construct() {
		parent::__construct();
                $this->load->model('Category_model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
		  $this->load->model(array('Va_Commisions_model','categories_model','Sub_categories_model'));
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function dashboard() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                $role_id=$this->session->userdata('role_id');
                if(!check_login_status()){
                    redirect('login');
                }else{
                     if(!$this->input->is_ajax_request()) {
		          $this->load->view('website_template/header',$data);
		          $this->load->view('website/channel_partner/dashboard');
		          $this->load->view('website_template/footer');
                     }else{
                          $this->load->view('website/channel_partner/dashboard');
                     }
                }
	}
	
	public function populat_sub_cat_search() {
		
		$sub_cat = $this->Sub_categories_model->get_subcategory($_REQUEST['catid']);
		$data = '';
		if(!empty($sub_cat))
		{
			foreach($sub_cat as $key=>$value)
			{
				$data .= '<div  class="sub_cat_dis"><input type="checkbox" class="chksubcat" name="sub_cat[]" value='.$value->sub_cat_id.'>'.$value->sub_cat_name.' </div>';
			}
		}
		echo $data;
		exit;		
    }
	
	
	public function Orders() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$user_id=$this->session->userdata('user_id');
		
		//echo "<br>";
		//print_r($_REQUEST);
		
		
		$search_params["cnl_part"] = $user_id;
		if( isset($_REQUEST["search"]) )
		{
			
			if(!empty($_REQUEST["st_date"]))
			{
				$st_date = explode("/",$_REQUEST["st_date"]);
				$search_params["st_date"] = $st_date[2]."-".$st_date[0]."-".$st_date[1];
			}
			if(!empty($_REQUEST["end_date"]))
			{
				$end_date = explode("/",$_REQUEST["end_date"]);
				$search_params["end_date"] = $end_date[2]."-".$end_date[0]."-".$end_date[1];
			}
			if(!empty($_REQUEST["agent_id"]))
			{
				$search_params["agent_id"] = $_REQUEST["agent_id"];
			}
			if(!empty($_REQUEST["cnl_part"]))
			{
				//$search_params["cnl_part"] = $_REQUEST["cnl_part"];
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
		$data1['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();		
		$data1['categories'] = $this->categories_model->list_all_categories();
		$data1['agents'] = $this->categories_model->list_all_users(6);
		$data1['ch_partners'] = $this->categories_model->list_all_users(2);
		$data1['order_details'] = $this->Va_Commisions_model->order_details($search_params);

		 $this->load->view('website_template/header', $data);
	   $this->load->view('website/channel_partner/orders',$data1);
	   $this->load->view('website_template/footer');
	}
        public function agentApproval() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/agent_approvals',$data);
		$this->load->view('website_template/footer');
	}
        public function profile() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                $role_id=$this->session->userdata('role_id');
                if(!check_login_status()){
                    redirect('login');
                }else{
                     if(!$this->input->is_ajax_request()) {
		          $this->load->view('website_template/header',$data);
		          $this->load->view('website/channel_partner/dashboard');
		          $this->load->view('website_template/footer');
                     }else{
                          $this->load->view('website/channel_partner/dashboard');
                     }
                }
        }
	public function spApproval() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/sp_approvals',$data);
		$this->load->view('website_template/footer');
	}
	public function Addpartner() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/partner',$data);
		$this->load->view('website_template/footer');
	}
	public function AddAgent() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/add_agent',$data);
		$this->load->view('website_template/footer');
	}
	public function Addsp() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/add_sp',$data);
		$this->load->view('website_template/footer');
	}
	public function TotalAgents() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/total_agents',$data);
		$this->load->view('website_template/footer');
	}
	public function Totalsp() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/total_sp',$data);
		$this->load->view('website_template/footer');
	}
	public function TotalUsers() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/total_users',$data);
		$this->load->view('website_template/footer');
	}
	public function AgentEarning() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/agent_earning',$data);
		$this->load->view('website_template/footer');
	}
	public function spEarning() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/sp_earning',$data);
		$this->load->view('website_template/footer');
	}
	public function ServicesEarning() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/services_earning',$data);
		$this->load->view('website_template/footer');
	}
	public function TotalEarning() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/total_earnings',$data);
		$this->load->view('website_template/footer');
	}
	public function Dailyreport() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/reports/daily_report',$data);
		$this->load->view('website_template/footer');
	}
	public function Monthlyreport() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/reports/monthly_report',$data);
		$this->load->view('website_template/footer');
	}
	public function Agentwise() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/reports/agent_wise',$data);
		$this->load->view('website_template/footer');
	}
	public function spreport() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/reports/sp_report',$data);
		$this->load->view('website_template/footer');
	}
	public function ReversalsCancels() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/reports/reversals_cancels',$data);
		$this->load->view('website_template/footer');
	}
	public function Invoice() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/invoice_list',$data);
		$this->load->view('website_template/footer');
	}
	public function Feedback() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header',$data);
		$this->load->view('website/channel_partner/feedback',$data);
		$this->load->view('website_template/footer');
	}
	
}
