<?php
/**
 *
 * @author    李梓钿
 *
 */
namespace osc\common\service;
use think\Db;
class Coupon{
	
	public function Writeoff(){
		$data = request()->isPost();

				$fi='log.txt';
	
		$sj = date('Y-m-d H:i:s');
		
		file_put_contents($fi,$data,FILE_APPEND);
	}


	}


