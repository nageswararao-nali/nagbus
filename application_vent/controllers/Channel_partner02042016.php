<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel_partner extends CI_Controller {
	function __construct() {
		parent::__construct();
                $this->load->model('Category_model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
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
