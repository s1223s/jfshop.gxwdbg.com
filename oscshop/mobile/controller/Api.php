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
class Api extends MobileBase{


	
		//核销券码
		function partnerwrite(){
		$data = input('post.');
		// print_r($data);
				$fi='log.txt';
		//$post = file_get_contents("php://input");
		$sj = date('YmdHis').'<br>';
		// $data = $sj.$data;
		//file_put_contents($fi,$data,FILE_APPEND);
		//file_put_contents($fi,$post,FILE_APPEND);
		$msg_crrltn_id = $data['msg_crrltn_id'];
		$msg_time = date("YmdHis");//时间
		$msg_sys_sn = $data['msg_sys_sn'];//平台流水号
		//$dataf = json_encode(array('msg_type'=>'01','msg_txn_code'=>'012100','msg_crrltn_id'=>$msg_crrltn_id,'msg_flg'=>'1','msg_sender'=>'660053','msg_time'=>$msg_time,'msg_sys_sn'=>$msg_sys_sn,'msg_ver'=>'0.1','msg_rsp_code'=>'0000','msg_rsp_desc'=>'success'));
		//{"msg_type":"01","msg_txn_code":"002100","msg_crrltn_id":"".$msg_crrltn_id."","msg_flg":"1","msg_sender":"660053","msg_time":"".$msg_time."","msg_sys_sn":"".$msg_sys_sn."","msg_rsp_code":"0000","msg_rsp_desc":"成功"};
		echo $dataf = 'msg_type=01&msg_txn_code=012100&msg_crrltn_id='.$msg_crrltn_id.'&msg_flg=1&msg_sender=660053&msg_time='.$msg_time.'&msg_sys_sn='.$msg_sys_sn.'msg_ver=0.1&msg_rsp_code=0000&msg_rsp_desc=success'.'</br>';
		$a = osc_sign();
		$sign = $a ->rsaSign($dataf,file_get_contents('private.txt'));
		$dataf = json_encode(array('msg_type'=>'01','msg_txn_code'=>'012100','msg_crrltn_id'=>$msg_crrltn_id,'msg_flg'=>'1','msg_sender'=>'660053','msg_time'=>$msg_time,'msg_sys_sn'=>$msg_sys_sn,'msg_ver'=>'0.1','msg_rsp_code'=>'0000','msg_rsp_desc'=>'success','sign'=>$sign));
		return $dataf;

		}

	
	}
