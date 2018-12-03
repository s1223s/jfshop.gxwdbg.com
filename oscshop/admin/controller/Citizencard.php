<?php

 
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use think\Db;
class citizencard extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
		$this->assign('breadcrumb1','市民卡管理');
				
	}
	
	function index(){
		
		
		$con=mysqli_connect("localhost","root","19870214?liyu","smk"); 
		
		
		
		$filter=input('param.');
		//print_r($filter);
		if(isset($filter['type'])&&$filter['type']=='search'){
			if(!empty($filter['name'])){
			$inquiry = "SELECT * FROM log where cardid  LIKE '".$filter['name']."'";
			}else{
			$this->assign('breadcrumb2','充值信息');
			$inquiry = "SELECT * FROM log where cardid  LIKE 0";
			//return $this->fetch();
			
		}
		}else{
			$this->assign('breadcrumb2','充值信息');
			$inquiry = "SELECT * FROM log where cardid  LIKE 0";
			//return $this->fetch();
			
		}	
		$result = $con->query($inquiry);
	
		    $data = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $data[] = $row;
		}
		//print_r($data);
		$this->assign('empty','<tr><td colspan="20">没有数据~</td></tr>');
		$this->assign('data',$data);
		$this->assign('breadcrumb2','充值信息');
		
	
		return $this->fetch();
	}
	

}
