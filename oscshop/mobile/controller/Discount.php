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
class Discount extends MobileBase{


	protected function _initialize(){
		parent::_initialize();						
		define('UID',osc_service('mobile','user')->is_login());	
		//手机版
		if(!UID){
			if(!in_wechat()){
				$this->redirect('login/login');	
			}else{
				$this->error('系统错误');
			}			
		}		
	}

	
	function index(){
		//获取当先秒杀商品的时间与信息
		

		$time = date("Y-m-d h:i:s");
		$timems = Db::name('goods_discountms')->where('valid','1')->where('discount_on_time','<=' ,(int)strtotime($time))->where('discount_off_time','>=' ,(int)strtotime($time))->select();
		$timeon = date("Y-m-d h:i:s",$timems[0]['discount_on_time']);
		$timeoff = date("Y-m-d h:i:s", $timems[0]['discount_off_time']);
		// print_r($timeoff);
		$end = strtotime($timeoff);
		$now = strtotime($time);
		$Dtime = $end - $now;
		$discount_price = array();
		$goods = array();
		for ($i=0; $i < count($timems); $i++) { 
			$a = Db::name('goods')->where('goods_id',$timems[$i]['goods_id'])->select();
			$a = array_merge($a,$timems[$i]);
			$goods[$i] = $a;
		}
		$this->assign('uid',UID);
		$this->assign('userinfo',Db::name('member')->where('uid',UID)->find());
		$this->assign('Dtime',$Dtime);
		$this->assign('goods',$goods);
		$this->assign('discount_price',$discount_price);
		$this->assign('timeon',$timeon);
		$this->assign('timeoff',$timeoff);
		$this->assign('SEO',['title'=>'本场秒杀']);
		$this->assign('top_title','本场秒杀');
		$this->assign('flag','user');
		return $this->fetch();
	}
	function discount(){
		//echo $uid = UID;
		//echo '1';
		$time = date("Y-m-d h:i:s");
		$timems = Db::name('goods_discountms')->where('valid','1')->where('discount_on_time','>' ,(int)strtotime($time))->select();
		$timeon = date("Y-m-d h:i:s",$timems[0]['discount_on_time']);
		$timeoff = date("Y-m-d h:i:s", $timems[0]['discount_off_time']);
		// 处理下场
		$now = strtotime($time);
		$start = strtotime($timeon);
		$Ltime =$start - $now;
		$discount_price = array();
		$goods = array();
		for ($i=0; $i < count($timems); $i++) { 
			$a = Db::name('goods')->where('goods_id',$timems[$i]['goods_id'])->select();
			$a = array_merge($a,$timems[$i]);
			$goods[$i] = $a;
		}
		
		$this->assign('goods',$goods);
		$this->assign('discount_price',$discount_price);
		$this->assign('timeon',$timeon);
		$this->assign('timeoff',$timeoff);
		$this->assign('SEO',['title'=>'秒杀开场']);
		$this->assign('top_title','秒杀开场');
		$this->assign('flag','user');
		return $this->fetch();

	}

	// 抽奖
	function prize(){

		//$userinfo = Db::name('member')->where('uid',UID)->find();
		//print_r($userinfo);
		$this->assign('userinfo',Db::name('member')->where('uid',UID)->find());
		$this->assign('uid',UID);	
		$this->assign('SEO',['title'=>'小站用户每日福利']);
		$this->assign('top_title','小站用户每日福利');
		$this->assign('flag','user');
		return $this->fetch();
	}

	function reward(){

		$uid = UID;
		$prize = array();
		for($i = 0;$i <= 6;$i++){
		$prize[$i] = Db::name('ratio')->where('reward_id',$i+1)->select('prize');
		}
		//print_r($prize);
		$prize_arr = array(
		  '0' => array('id'=>1,'min'=>1, 'max'=>29,'prize'=>$prize[0][0]['reward_name'],'v'=>$prize[0][0]['reward_ratio']),
		  '1' => array('id'=>2,'min'=>302,'max'=>328,'prize'=>$prize[1][0]['reward_name'],'v'=>$prize[1][0]['reward_ratio']),
		  '2' => array('id'=>3,'min'=>242,'max'=>268,'prize'=>$prize[2][0]['reward_name'],'v'=>$prize[2][0]['reward_ratio']),
		  '3' => array('id'=>4, 'min'=>182,'max'=>208,'prize'=>$prize[3][0]['reward_name'],  'v'=>$prize[3][0]['reward_ratio']), 
		  '4' => array('id'=>5,'min'=>122,'max'=>148,'prize'=>$prize[4][0]['reward_name'],'v'=>$prize[4][0]['reward_ratio']),
		  '5' => array('id'=>6,'min'=>62,'max'=>88,'prize'=>$prize[5][0]['reward_name'],'v'=>$prize[5][0]['reward_ratio']),
		  '6' => array('id'=>7,'min'=>array(32,92,152,212,272,332),'max'=>array(58,118,178,238,298,358),'prize'=>$prize[6][0]['reward_name'],'v'=>$prize[6][0]['reward_ratio']) 
		  ); 
		
      
		foreach ($prize_arr as $key =>$val) {
			$arr[$val['id']] = $val['v'];
		}
		 
		$rid = $this->getRand($arr); //根据概率获取奖项id
		 
		$res = $prize_arr[$rid-1]; //中奖项
		$min = $res['min'];
		$max = $res['max'];
		if($res['id']==7){ //七等奖
			$i = mt_rand(0,5);
			$result['angle'] = mt_rand($min[$i],$max[$i]);
		}else{
			$result['angle'] = mt_rand($min,$max); //随机生成一个角度
		}
		$result['prize'] = $res['prize'];
		
		$winning = array();
		$winning['winning_prize'] = $result['prize'];
		$winning['uid'] = $uid;
		$time = date("Y-m-d h:i:s");
		$winning['winning_time'] = strtotime($time);
		$winning['status'] = '已出奖';

		Db::name('ratio_winning')->insert($winning);
		//print_r($winning);
		return json_encode($result);

			}
      
      //转盘中奖概率算法
      function getRand($proArr) {
			$result = '';
		 
			//概率数组的总概率精度
			$proSum = array_sum($proArr);
		 
			//概率数组循环
			foreach ($proArr as $key =>$proCur) {
				$randNum = mt_rand(1, $proSum);
				if ($randNum <= $proCur) {
					$result = $key;
					break;
				} else {
					$proSum -= $proCur;
				}
			}
			unset ($proArr);
		 
			return $result;
		}
		public function myprize(){
			$uid = UID;
			$prize = Db::name('ratio_winning')->where('uid',$uid)->select();
			$a = count($prize);
			for ($i=0; $i < $a; $i++) { 
				$prize[$i]['winning_time'] = date('Y-m-d h:i:s',$prize[$i]['winning_time']);
			}
			//print_r($prize);
			$this->assign('SEO',['title'=>'小站奖品']);
			$this->assign('top_title','我的奖品');
			$this->assign('flag','user');
			$this->assign('prize',$prize);
			return $this->fetch();
		}

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
		$dataf = json_encode(array('msg_type'=>'01','msg_txn_code'=>'012100','msg_crrltn_id'=>$msg_crrltn_id,'msg_flg'=>'1','msg_sender'=>'660053','&msg_time'=>$msg_time,'msg_sys_sn'=>$msg_sys_sn,'msg_ver'=>'0.1','msg_rsp_code'=>'0000','msg_rsp_desc'=>'success'));
		//{"msg_type":"01","msg_txn_code":"002100","msg_crrltn_id":"".$msg_crrltn_id."","msg_flg":"1","msg_sender":"660053","msg_time":"".$msg_time."","msg_sys_sn":"".$msg_sys_sn."","msg_rsp_code":"0000","msg_rsp_desc":"成功"};
		$a = osc_sign();
		$sign = $a ->rsaSign($dataf,file_get_contents('private.txt'));
		$dataf = json_encode(array('msg_type'=>'01','msg_txn_code'=>'012100','msg_crrltn_id'=>$msg_crrltn_id,'msg_flg'=>'1','msg_sender'=>'660053','msg_time'=>$msg_time,'msg_sys_sn'=>$msg_sys_sn,'msg_ver'=>'0.1','msg_rsp_code'=>'0000','msg_rsp_desc'=>'success','sign'=>$sign));
		return $dataf;

		}

	
	}
