<?php 
class Mobile extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('APIS/Recharge_offers');
		$this->load->library('simple_html_dom');
		//$this->load->model('APIS/Storage');
	}
	private $html;
	
	function offers(){
		ini_set('max_execution_time', 2000000);
		//$url="http://www.ireff.in/plans/mtnl/andra-pradesh-telangana";
		//$this->html=file_get_html($url);
		//$data=array();
		
		//$this->circles($html);		
		//$this->operators($html);
		$this->prepare_url();
		//$this->recharge_plans($html);

	}
	
	function operators($html){
		$c = $this->Recharge_offers;
		//for storing Operators
		$re = $html->find('//*[@id="serviceSelection"]/option');
		for($i=1;$i<=count($re); $i++){
			$va = $html->find('//*[@id="serviceSelection"]/option['.$i.']');
			
			$c->setOperatorName($va[0]->innertext);
			$c->setOperatorCode($va[0]->getAttribute('value'));
			if(!$c->store_operators()){ echo "records already existed breaked";break;}
			else echo "Operator Name : ".$va[0]->innertext."  <br/> Value : ".$va[0]->getAttribute('value')."<hr/>";
		}
	}
	
	function circles($html){
		$c = $this->Recharge_offers;
		//for storing Circles
		$re = $html->find('//*[@id="circleSelection"]/option');
		for($i=1;$i<=count($re); $i++){
			$va = $html->find('//*[@id="circleSelection"]/option['.$i.']');
			
			$c->setCircleName($va[0]->innertext);
			$c->setCircleCode($va[0]->getAttribute('value'));
			if(!$c->store_circles()){ echo "records already existed breaked";break;}
			else echo "Circle Name : ".$va[0]->innertext."  <br/> Circle Code : ".$va[0]->getAttribute('value')."<hr/>";
		}
	}
	
	function recharge_plans($html){
		echo '<table border="1px">';
		$ret = $html->find('//*[@id="Topupa"]/tr');
		for($i=1;$i<=count($ret); $i++){
			echo "<tr>";
			$res = $html->find('//*[@id="Topupa"]/tr['.$i.']/td');
			for($j=0; $j<count($res); $j++)
			{
				print_r($res[$j]->outertext);
			}
			echo "</tr>";
		}
	}
	
	function prepare_url(){
		$c = $this->Recharge_offers;
		$result = $c->get_circle_url();
		$result2 = $c->get_operator_url();
		if($result){
			for($i=0; $i<count($result); $i++){
				if($result[$i]->circle_url!=""){
					for($j=0; $j<count($result2); $j++){
						if($result2[$j]->operator_url!=""){
							//echo "http://www.ireff.in/plans/".$result2[$j]->operator_url."/".$result[$i]->circle_url."<br/>";
							$c=$this->Recharge_offers;
							$c->setOperatorId($result2[$j]->recharge_offer_operators_id);
							$c->setCircleId($result[$i]->recharge_offer_circle_id);
							
							$this->fetch_offers("http://www.ireff.in/plans/".$result2[$j]->operator_url."/".$result[$i]->circle_url);
							
						}
					}
				}
			}
		}
	}
	
	function fetch_offers($url){
		$this->html=file_get_html($url);
		$data=array();
		if(!$this->check_plan_exists()){	}
		else{
			echo "<h3>Top Up plans</h3>";
			$this->topup();
		}
	}
	
	function check_plan_exists(){
		//no products found 
		$re = $this->html->find('//*[@id="Topup"]/div/h3');
		return count($re)==0 ? TRUE : FALSE;
		echo count($re);echo $re[0]->plaintext;
	}
	
	
	private $price;
	private $validity;
	private $benifits;
	private $talktime;
	private $operatorid;
	private $circle_id;
	private $tags=array();
	
	function topup(){
		$ret = $this->html->find('//*[@id="Topupa"]/tr');
		echo "<pre>";
		$c=$this->Recharge_offers;
							
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="Topupa"]/tr['.$i.']/td'); //lenght is 5 
			
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			
			/*echo "Recharge value " .$recharge_value = strip_tags($res[0]->innertext) ."<br/>";
			echo "Recharge validity " .$validity = strip_tags($res[1]->innertext) ."<br/>";
			echo "Recharge Talktime ".$talktime = strip_tags($res[2]->innertext) ."<br/>"; 
			echo "Recharge Tags ".print_r($tags);
			echo "Recharge Benifits ".$benifits = strip_tags($res[4]->innertext) ."<br/>";*/
			echo "<hr/>";
		}
		echo "<h3>SMS Plans</h3>";
		$this->sms();
	}
	
	function sms(){
		$ret = $this->html->find('//*[@id="SMSa"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="SMSa"]/tr['.$i.']/td'); //lenght is 5
			 
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			
			echo "<hr/>";
		}
		echo "<h3>Two g Plans</h3>";
		$this->two_g();
	}
	
	function two_g(){
		
		$ret = $this->html->find('//*[@id="2Ga"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="2Ga"]/tr['.$i.']/td'); //lenght is 5 
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			
			$this->go_to_db();
			echo "<hr/>";
		}
		echo "<h3>Three g Plans</h3>";
		$this->three_g();
	}
	
	function three_g(){		
		$ret = $this->html->find('//*[@id="3Ga"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="3Ga"]/tr['.$i.']/td'); //lenght is 5 
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			echo "<hr/>";
		}
		echo "<h3>Local Plans</h3>";
		$this->local();
	}
	
	function local(){
		$ret = $this->html->find('//*[@id="Locala"]/tr');
		echo "<pre>";
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="Locala"]/tr['.$i.']/td'); //lenght is 5 
			
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);	
			$this->go_to_db();
			echo "<hr/>";
		}
		echo "<h3>STD Plans</h3>";
		$this->std();
		
	}
	
	function std(){
		
		$ret = $this->html->find('//*[@id="STDa"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="STDa"]/tr['.$i.']/td'); //lenght is 5 
			
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			
			echo "<hr/>";
		}
		echo "<h3>ISD Plans</h3>";
		$this->isd();
	}
	
	function isd(){
		$ret = $this->html->find('//*[@id="ISDa"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="STDa"]/tr['.$i.']/td'); //lenght is 5 
			
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			
			echo "<hr/>";
		}
		echo "<h3>Other Plans</h3>";
		$this->others();
	}
	
	function others(){
		$ret = $this->html->find('//*[@id="Othera"]/tr');
		for($i=1;$i<=count($ret); $i++){
			$res = $this->html->find('//*[@id="Othera"]/tr['.$i.']/td'); //lenght is 5 
			
			$this->price 	= 	strip_tags($res[0]->innertext);
			$this->validity = 	strip_tags($res[1]->innertext);
			$this->talktime	=	strip_tags($res[2]->innertext);
			$tags = preg_replace('/[^A-Za-z0-9\-]/', ' ', strip_tags($res[3]->innertext));
			$tags=array_filter(explode("  ",$tags));
			$this->tags = $tags;
			$this->benifits = strip_tags($res[4]->innertext);
			$this->go_to_db();
			
			echo "<hr/>";
		}
	}	
	
	function go_to_db(){
	
			$c=$this->Recharge_offers;
			$c->setPrice($this->price);
			$c->setValidity($this->validity);
			$c->setTalktime($this->talktime);
			$c->setTags($this->tags);
			$c->setBenifits($this->benifits);
			$c->store_offers();		
	}
}