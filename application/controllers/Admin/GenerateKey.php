<?php
class GenerateKey extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function _remap(){
		$this->index();
	}
	private function index(){
		echo md5('key');
	}
}
?>