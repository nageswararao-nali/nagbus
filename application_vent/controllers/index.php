<?php

/**
* Index Controller
*/
class Index extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('users_model', 'users', TRUE );
		$this->load->model('Category_Model', 'Cat', TRUE );
	}

	public function _remap($page){
		$this->index($page);
	}
	
	public function index($page){
		if($page=="scripts") {
			// echo "<pre>"; print_r($_POST); exit;
			$this->_javascripts();
		}else if(strtolower($page)=='login' || ($page=='user' && $this->uri->segment($this->uri->total_segments())=='login' )){
			if(!check_login_status()) {
				$this->_template('user/login');
			}else{
				if(check_login_status()) {
					$this->_template('user/profile');
				}else $this->_template('user/login');
			}
		}else if(strtolower($page)=="register") {
			if(!check_login_status()){
				redirect('Index/user/register');
			}
		}else if(strtolower($page)=="logout") {
				redirect('Logout');
		}else {
			if($this->uri->total_segments()>2) {
				$page="";
				for($i=2;$i<=$this->uri->total_segments(); $i++) {
					 $page.=$this->uri->segment($i).'/';
					 // echo "<pre>"; print_r($page); exit;
				}
				$page = substr($page,0,-1);
			}
			// $roles = $this->users->get_roles();
			$this->_template($page);
		}
	}
	
	private function _template($pagename){
		
		//echo "Welcome...";
		if(!check_login_status()){
			$prevent_pages = array('recharge/proceed');
			if(in_array($pagename,$prevent_pages)){
				redirect('Login');
			}
		}
		if(!$this->input->is_ajax_request()){
			if(strtolower($pagename)=="index"){
				$this->load->model('users_model', 'users', TRUE );
				$data['folder'] ='';
				$data['body'] = 'index';
				$data['roles'] = $this->users->get_roles();
				$data['category'] = $this->Cat->get_category();
				$this->load->view('website_template',$data);
			}else {
				if(!strpos($pagename,'/')) $pagename=$pagename.'/index';
				$data['folder']= $pagename=="index" ? '' : $pagename;
				$data['body']= $pagename=="index" ? 'index' : '';
				$data['roles'] = $this->users->get_roles();
				$data['category'] = $this->Cat->get_category();
				if(!file_exists( APPPATH . 'views/website/'.$data['folder'].$data['body'].'.php')){
					$data['folder']= 'blocks/';
					$data['body']= 'page_not_found';
					$data['roles'] = $this->users->get_roles();
					// $data['category'] = $this->Cat->get_category();
					$this->load->view('website_template',$data);
					//$this->load->view('website/blocks/page_not_found');
				}
				else $this->load->view('website_template',$data);
			}
		}else if($this->input->is_ajax_request()){
			//echo $pagename;
			$folder= $pagename=="index" ? '' : (is_dir(APPPATH.'views/website/'.$pagename)? $pagename.'/' : $pagename );
			$folder = is_dir(APPPATH.'views/website/'.$folder) ? $folder.'index' : $pagename;
			$body= $this->uri->segment($this->uri->total_segments())=="index" ? $pagename : (is_dir($folder) ? 'index' : '');
			if(!file_exists(APPPATH.'views/website/'.$folder.$body.'.php')){
				$this->load->view('website/blocks/page_not_found');
			}else{
				$roles = $this->users->get_roles();
				$this->load->view('website/'.$folder.$body, $roles);
			}
		}
	}
		
	private function _javascripts(){
		$this->load->view('website_template/javascripts');
	}

}