<?php
abstract class Operator extends CI_Controller{
	abstract public function create_api();
	//abstract public function load_operators($moduleid, $catid);
}
class APISetup extends Operator{
	function __construct(){
		parent :: __construct();
		$this->load->model('Admin/APIModule');
	}
	public function index(){
		$data['body']="Admin/ApiIntegrations/API_setup";
		$this->load->view("Admin_template",$data);
	}
	
	public function view_all(){
		$data['body']="Admin/ApiIntegrations/API_List";
		$this->load->view("Admin_template",$data);
	}
	function create_api(){
		$c=$this->APIModule;
		$apiUrl = $this->input->post('api_protocol',TRUE).$this->input->post('operator_base_url',TRUE);
		if(!$this->valid_url_format($apiUrl)) return FALSE;
		if(substr($apiUrl,0,-1)=="/")  $apiUrl .="/";
		else $apiUrl .="/";
		//setting url with php extension
		if(substr($this->input->post('api_url_path',TRUE),0,-4) || substr($this->input->post('api_url_path',TRUE),0,-5) || substr($this->input->post('api_url_path',TRUE),0,-2)){
			$apiUrl .= $this->input->post('api_url_path',TRUE);
		}
		$c->setCategoryId($this->input->post('categoryid',TRUE));
		$c->setBaseUrl($apiUrl);
		$c->setAPITitle($this->input->post('api_title',TRUE));
		$c->setParamNames($_POST['param_name']);
		$c->setParamDesc($_POST['param_desc']);
		echo $c->save()==TRUE ? TRUE : FALSE;
	}
	
	private function valid_url_format($str){
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)){
            $this->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
            return FALSE;
        }
        return TRUE;
    }
	
	public function get_operator_apis($category_id){
		$c=$this->APIModule;
		$c->setCategoryId($category_id);
		echo json_encode($c->get_apis());
	}
		
	function API_credentials(){
		$data['body']="Admin/ApiIntegrations/API_credentials";
		$this->load->view("Admin_template",$data);
	}
	
	function API_save_credentials(){
		$c=$this->APIModule;
		$c->setCategoryId($this->input->post('categoryid',TRUE));
		$c->setAPIUid($this->input->post('APIuserid',TRUE));
		$c->setAPIPwd($this->input->post('APIpassword',TRUE));
		$c->setAPIPin($this->input->post('APISecurityPin',TRUE));
		$c->save_credentials();
	}
}