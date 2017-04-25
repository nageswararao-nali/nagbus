<?php
require_once APPPATH.'models/Interfaces.php';
require_once APPPATH.'models/global/Parent_model.php';
class CommissionModule extends Parent_model implements CommissionInterface{
	function __construct(){
		parent::__construct();
	}
	private $operatorid;
	private $our_cal_type;
	private $our_amount;
	private $agent_cal_type;
	private $agent_amount;
	private $mark_cal_type;
	private $mark_amount;
	private $discount_cal_type;
	private $discount_amount;
	private $package_id=1;
	
	private $category_id;
	private $module_id;
	
	private $smdPercentage;
	private $laabusPercentage;
	private $cpTerm1Period;
	private $cpTerm1Percentage;
	private $cpTerm2Period;
	private $cpTerm2Percentage;
	private $cpTerm3Percentage;

		public function setOperatorId($a){
			$this->operatorid=$a;
		}
		
		public function setPackageId($a){
			$this->package_id=$a;
		}
		public function setOurCalType($a){
			$this->our_cal_type=$a;
		}
		public function setOurAmount($a){
			$this->our_amount=$a;
		}
		public function setAgentCalType($a){
			$this->agent_cal_type=$a;
		}
		public function setAgentAmount($a){
			$this->agent_amount=$a;
		}
		public function setMarkCalType($a){
			$this->mark_cal_type=$a;
		}
		public function setMarkAmount($a){
			$this->mark_amount=$a;
		}
		public function setDiscountCalType($a){
			$this->discount_cal_type=$a;
		}
		public function setDiscountAmount($a){
			$this->discount_amount=$a;
		}
		public function setCategoryId($a){
			$this->category_id=$a;
		}
		public function setModuleId($a){
			$this->module_id=$a;
		}
		
		
		public function getOperatorId(){
			return $this->operatorid;
		}
		public function getPackageId(){
			return $this->package_id;
		}
		public function getOurCalType(){
			return $this->our_cal_type;
		}
		public function getOurAmount(){
			return $this->our_amount;
		}
		public function getAgentCalType(){
			return $this->agent_cal_type;
		}
		public function getAgentAmount(){
			return $this->agent_amount;
		}
		public function getMarkCalType(){
			return $this->mark_cal_type;
		}
		public function getMarkAmount(){
			return $this->mark_amount;
		}
		public function getDiscountCalType(){
			return $this->discount_cal_type;
		}
		public function getDiscountAmount(){
			return $this->discount_amount;
		}
		
		public function getCategoryId(){
			return $this->category_id;
		}
		public function getModuleId(){
			return $this->module_id;
		}
		
		public function getLogin(){
			return "0";
		}
		public function save(){
			$this->db->select('operator_id, package_id');
			$this->db->where('operator_id',$this->getOperatorId());
			$this->db->where('package_id',$this->getPackageId());
			$qu=$this->db->get('va_commissions');
			$commission = array('operator_id' => $this->getOperatorId(),
								//'package_id' => $this->getPackageId(),
								'our_commission_amount' => $this->getOurCalType() == "R" ? $this->getOurAmount() : NULL,
								'our_commission_percentage' =>$this->getOurCalType() == "P" ? $this->getOurAmount() : NULL,
								'agent_commission_amount' => $this->getAgentCalType() =="R" ? $this->getAgentAmount() : NULL,
								'agent_commission_percentage' =>$this->getAgentCalType() =="P" ? $this->getAgentAmount() : NULL,
								'markup_commission_amount' => $this->getMarkCalType() =="R" ? $this->getMarkAmount() : NULL,
								'markup_commission_percentage' =>$this->getMarkCalType() =="P" ? $this->getMarkAmount() : NULL,
								'discount_amount' => $this->getAgentCalType() == "R" ? $this->getAgentAmount() : NULL,
								'discount_percentage' =>$this->getAgentCalType() == "P" ? $this->getAgentAmount() : NULL,
								'update_login' =>$this->getLogin()
								);
			
			if($qu->num_rows()==0){
				$this->db->set("creation_date",'NOW()',FALSE);
				if($this->db->insert('va_commissions',$commission)) return TRUE; else return FALSE;
			}
			else{
				$this->db->where('operator_id',$this->getOperatorId());
				$this->db->where('package_id',$this->getPackageId());
				if($this->db->update('va_commissions',$commission))
				return TRUE;
				else return false;
			}
		}
		
	function get_operators($limit=10){
		
		$this->db->select('o.operator_id, o.operator_name, o.operator_code, c.package_id, 
							c.our_commission_amount,
							c.our_commission_percentage,
							c.agent_commission_amount,
							c.agent_commission_percentage,
							c.markup_commission_amount,
							c.markup_commission_percentage,
							c.discount_amount,
							c.discount_percentage,
							c.user_commission_amount,
							c.user_commission_percentage,
							c.update_login');
		$this->db->from('va_commissions c');
		$this->db->join('va_operators o','o.operator_id=c.operator_id','right');
		$this->db->where('o.category_id',$this->getCategoryId());
		$this->db->where('o.module_id',$this->getModuleId());
		$query = $this->db->get();
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	public function setSmdPercentage($val){
		$this->smdPercentage = $val;
	}
	public function setLaabusPercentage($val){
		$this->laabusPercentage = $val;
	}
	public function setCpTerm1Period($val){
		$this->cpTerm1Period = $val;
	}
	public function setCpTerm1Amount($val){
		$this->cpTerm1Percentage = $val;
	}
	public function setCpTerm2Period($val){
		$this->cpTerm2Period = $val;
	}
	public function setCpTerm2Amount($val){
		$this->cpTerm2Percentage = $val;
	}
	public function setCpTerm3Amount($val){
		$this->cpTerm3Percentage = $val;
	}
	
	
	private function getSmdPercentage(){
		return $this->smdPercentage;
	}
	private function getLaabusPercentage(){
		return $this->laabusPercentage;
	}
	private function getCpTerm1Period(){
		return $this->cpTerm1Period;
	}
	private function getCpTerm1Percentage(){
		return $this->cpTerm1Percentage;
	}
	private function getCpTerm2Period(){
		return $this->cpTerm2Period;
	}
	private function getCpTerm2Percentage(){
		return $this->cpTerm2Percentage;
	}
	private function getCpTerm3Percentage(){
		return $this->cpTerm3Percentage;
	}
	
	function save_commission_distribute(){
			$arr = array('smd_percentage'=>$this->getSmdPercentage(),
						'laabus_percentage'=>$this->getLaabusPercentage(),
						'cp_term1period'=>$this->getCpTerm1Period(),
						'cp_term1percentage'=>$this->getCpTerm1Percentage(),
						'cp_term2period'=>$this->getCpTerm2Period(),
						'cp_term2percentage'=>$this->getCpTerm2Percentage(),
						'cp_term3percentage'=>$this->getCpTerm3Percentage());
		if(!$this->fetch_commission_distribute()){
			return $this->db->insert('va_commission_share',$arr)==true ? TRUE  : FALSE;
		}else {
			$this->db->select_max('commission_share_id');
			$query = $this->db->get('va_commission_share');
			$query_result = $query->result();
			$this->db->where('commission_share_id', $query_result[0]->commission_share_id);
			return $this->db->update('va_commission_share', $arr) ? TRUE  : FALSE;
		}
	}
	
	function fetch_commission_distribute(){
		$cnd = $this->whereCnd();
		unset($cnd['category_id']);
		return $this->get_result('smd_percentage, laabus_percentage, cp_term1period, cp_term1percentage, cp_term2period, cp_term2percentage, cp_term3percentage','va_commission_share',$cnd);
	}
}