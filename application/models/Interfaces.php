<?php
interface ModuleCrud {
    public function create();
    public function load($limit);
    public function update();
    public function delete();
	
	public function activate($id);
	public function deactivate($id);
}

interface CommissionInterface{
	public function setOperatorId($a);
	public function setPackageId($a);
	public function setOurCalType($a);
	public function setOurAmount($a);
	public function setAgentCalType($a);
	public function setAgentAmount($a);
	public function setMarkCalType($a);
	public function setMarkAmount($a);
	public function setDiscountCalType($a);
	public function setDiscountAmount($a);
	
	
	public function getOperatorId();
	public function getPackageId();
	public function getOurCalType();
	public function getOurAmount();
	public function getAgentCalType();
	public function getAgentAmount();
	public function getMarkCalType();
	public function getMarkAmount();
	public function getDiscountCalType();
	public function getDiscountAmount();
}

interface OperatorsInterface {
	function setModuleId($val);
	function setCategoryId($val);
	function setOperatorName($val);
	function setOperatorCode($val);
	function setOperatorDescription($val);
	
	function getModuleId();
	function getCategoryId();
	function getOperatorName();
	function getOperatorCode();
	function getOperatorDescription();
}

interface FetchNetwork{
	function setCategoryId($val);
	function setMobileNo($val);
	
	function getCategoryId();
	function getMobileNo();
	function getAPIUid();
	function getAPIPwd();
	function getAPIPin();
	function getAPIResponseFormat();
	function getAPIVersion();
}


interface Operators_API{
	function setCategoryId($val);
	function setBaseUrl($val);
	function setAPITitle($val);
	function setBaseUrlId($val);
	function setParamNames($a);
	function setParamDesc($a);
	
	function getCategoryId();
	function getAPITitle();
	function getBaseUrl();
	function getBaseUrlId();
	function getParamNames();
	function getParamDesc();
	
}