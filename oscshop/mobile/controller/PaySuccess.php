<?php
/**
 * oscshop2 B2C电子商务系统
 *
 * ==========================================================================
 * @link      http://www.oscshop.cn/
 * @copyright Copyright (c) 2015-2016 oscshop.cn. 
 * @license   http://www.oscshop.cn/license.html License
 * ==========================================================================
 *
 * @author    李梓钿
 *
 */
 
namespace osc\mobile\controller;
use think\Db;
class PaySuccess extends MobileBase
{
		
	function index(){

	
		
		return $this->fetch();
	}

	function jfreturn(){
		
		    $state = $_GET['state'];
			$msg = $_GET['msg'];
			$ORDERSEQ = $_GET['money'];
			$sign = $_GET['sign'];
		
			$a = $state.'   |'.$msg.'   |'.$ORDERSEQ.'   |'.$sign;

		$fi='log.txt';
	
		$sj = date('Y-m-d H:i:s');
		
		file_put_contents($fi,$sj,FILE_APPEND);
	}

}

