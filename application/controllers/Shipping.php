<?php 
require_once APPPATH.'controllers/Template.php';
class Shipping extends Template{
	function __construct(){
		parent::__construct();
		$this->load->model('Category_Model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
                $this->load->model('Sale/Salemodel');
                $this->load->model(array('common_model'));
	}
        
	private $key='hanisoft';
        
	function index(){
            //print_r($this->session->userdata());
			$data['offers'] = $this->users->getoffers();
		$data['offerswallet'] = $this->users->getofferswallet();
		
		//echo "Test 123";
		$data['offers'] = $this->users->getoffers();
		//$data['offerswallet'] = $this->users->getofferswallet();
		// print_r($usertypes);
				$role_id = $this->session->userdata('role_id');
				if($this->session->userdata('user_id') && $role_id ==4  )
				{
					$usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
					$agent_id = $usertypes[0]->agent_id;
					if(empty($agent_id))
					{
						$role_id = 4;
					}
					else
					{
						$role_id =44;
					}
				}		
		$data['offers'] = $this->users->getalloffers($role_id);
		$data["offerswallet"] = $this->users->getallofferswallet($role_id);
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/shipping/index');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/shipping/index', $data);
                }
	}	
	
}
