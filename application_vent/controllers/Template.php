<?php 
class Template extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Category_model', 'Cat', TRUE );
	}

	protected function direct_template($pagename,$red=''){
		$data['red']=$redirect;
		if(!strpos($pagename,'/')) $pagename=$pagename.'/index';
		$data['folder']= $pagename=="index" ? '' : $pagename;
		$data['body']= $pagename=="index" ? 'index' : '';
		$data['category'] = $this->Cat->get_category();
		$this->load->view('website_template',$data);
	}
	
	protected function ajax_template($pagename,$red='') {
		$data['red'] = $red;
		$folder= $pagename=="index" ? '' : $pagename;
		$body= $pagename=="index" ? 'index' : '';
		$data['category'] = $this->Cat->get_category();
		$this->load->view('website/'.$folder.$body,$data);
	}
}