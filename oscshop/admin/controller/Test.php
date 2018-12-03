<?php

 
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use think\Db;
class Test extends AdminBase
{
	
	function index(){
		return $this->fetch();
	}
}

?>