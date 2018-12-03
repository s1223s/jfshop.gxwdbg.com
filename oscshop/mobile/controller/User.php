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

class User extends MobileBase
{
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
		
		$this->assign('no_pay',$this->order_count(config('default_order_status_id')));	
		$this->assign('paid',$this->order_count(config('paid_order_status_id')));			
		$this->assign('userinfo',Db::name('member')->where('uid',UID)->find());

		$this->assign('SEO',['title'=>config('SITE_TITLE')]);
		$this->assign('uid',UID);
		$this->assign('flag','user');
		
		return $this->fetch();
	}
	
	function order_count($status){		
		return count(Db::name('order')->where(array('order_status_id'=>$status,'uid'=>UID))->select());		
	}
	
	function wish_list(){
		
		$this->assign('top_title','我的收藏');
		$this->assign('SEO',['title'=>'我的收藏-'.config('SITE_TITLE')]);
		return $this->fetch();
	}
	
	function ajax_wish_list(){
		
    	$page=(int)input('param.page');//页码
		
		$limit = (6 * $page) . ",6";			
			
		$list= Db::view('Goods','goods_id,image,price,name')
		->view('MemberWishlist','uid','Goods.goods_id=MemberWishlist.goods_id')						
		->where(array('MemberWishlist.uid'=>UID))->limit($limit)->select();
		
		if(isset($list)&&is_array($list)){
			foreach ($list as $k => $v) {				
				$list[$k]['image']=resize($v['image'], 200, 200);		
			}				
		}
		
		return $list;
		
	}
	function remove_wish(){
		
		$goods_id=(int)input('param.id');		
		Db::name('member_wishlist')->where(array('uid'=>UID,'goods_id'=>$goods_id))->delete();
		Db::name('member')->where('uid',UID)->setDec('wish',1);	
		storage_user_action(UID,user('nickname'),config('FRONTEND_USER'),'删除了收藏');
		
		$this->redirect('User/wish_list');
	}	
	
	function get_qr_code(){
		
		  $uid = user('uid');
		 
		  include_once EXTEND_PATH.'phpqrcode/phpqrcode.php';
		
		  $url=request()->domain().'/mobile/index/agent_share/osc_aid/'.hashids()->encode($uid);
		  	
		  $level=3;
		  
		  $size=4;	
		
		  $errorCorrectionLevel =intval($level) ;//容错级别 
		  
		  $matrixPointSize = intval($size);//生成图片大小 
		  
		  $path=DIR_IMAGE.'images/qrcode/';
		  
		  $fileName =$uid.'.png';
   
		    //判断文件是否存在，存在返回二维码图片名字
		  $checkFile = $path.$fileName;
		  
		  if (!is_dir($path)) {
				@mkdir($path, 0777);
		  }
		  
		  Db::name('wechat_share')->insert(['uid'=>UID,'type'=>'推广商城二维码','url'=>$url,'create_time'=>time()]);
		  
		  if(file_exists($checkFile)){	      
			  
			  return '/public/uploads/images/qrcode/'.$fileName;			  
		  } 
		  
		  //生成二维码图片 
		  \QRcode::png($url, $path.$fileName, $errorCorrectionLevel, $matrixPointSize);  
		 
		  return '/public/uploads/images/qrcode/'.$fileName;		 
	}
	//签到
	function sign(){
		$uid=(int)input('post.uid');
		$time = date('Ymd');
		$lssignt = Db::name('member')->where('uid',$uid)->value('lssignt');
		$points = Db::name('member')->where('uid',$uid)->value('points');
		//print_r($user);
		//echo $lssignt = $user[0]['lssignt'];
		//如果没有签到过
		if (empty($lssignt)) {
			Db::name('member')->where('uid',$uid)->update(['lssignt'=>$time],['signcounter'=>'1']);
			$points = $points+1;
			Db::name('member')->where('uid',$uid)->update(['points'=>$points]);
			return['success'=>'签到成功'];
		}else{
			//查看是否是当天重复签到
			$c = $time - $lssignt;
			if($c >= '1'){
				if ($c == '1') {
					Db::name('member')->where('uid',$uid)->update(['lssignt'=>$time]);
					$signcounter = Db::name('member')->where('uid',$uid)->value('signcounter');
						if ($signcounter <= 6) {
							$points = $points+$signcounter+1;
							$signcounter = $signcounter+1;
							Db::name('member')->where('uid',$uid)->update(['points'=>$points],['signcounter'=>$signcounter]);
							return['success'=>'签到成功'];
						}else{	
							
							$points = $points+1;
							$signcounter = 1;
							Db::name('member')->where('uid',$uid)->update(['points'=>$points],['signcounter'=>$signcounter]);
							return['success'=>'签到成功'];
						}
					}else{
						Db::name('member')->where('uid',$uid)->update(['lssignt'=>$time]);
						$points = $points+1;
						Db::name('member')->where('uid',$uid)->update(['points'=>$points],['signcounter'=>'1']);
						return['success'=>'签到成功'];
					}
			}else{
				return['error'=>'您当天已签到，明天再来吧！'];
			}
		}
	}
}








