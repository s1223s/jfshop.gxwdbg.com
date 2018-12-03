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
class Coupon extends MobileBase
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
		$this->assign('status',(int)input('param.status'));
		$this->assign('top_title','我的订单');
		//$this->assign('SEO',['title'=>'我的订单-'.config('SITE_TITLE')]);
		if(in_wechat()){		
			$this->assign('signPackage',wechat()->getJsSign(request()->url(true)));	
		}
		
		return $this->fetch();
	}
	
	function ajax_order_list(){
		
    	$page=(int)input('param.page');//页码
    	
		$status=(int)input('param.status');
		//开始数字,数据量
		$limit = (5 * $page) . ",5";
		
		if($status==''){				
			$where=array('Order.uid'=>UID);				
		}else{				
			$where=array('Order.uid'=>UID,'Order.order_status_id'=>$status);
		}
		$orders= Db::view('Order','order_id,order_num_alias,uid,total,comment,order_status_id,points_order,pay_points')
		->view('OrderGoods','goods_id,name,order_goods_id,quantity,price','OrderGoods.order_id=Order.order_id')
		->view('Goods','image','Goods.goods_id=OrderGoods.goods_id')				
		->where($where)->order('Order.order_id desc')->limit($limit)->select();
		
		$orders_list=null;
		
		if(isset($orders)&&is_array($orders)){
			
			foreach ($orders as $k => $v) {
				$orders_list[$v['order_id']]['order']=$v;
				$orders_list[$v['order_id']]['list'][]=$v;				
			}
			
		}
		
		$this->assign('coupon',$orders_list);
		exit($this->fetch());
       
	}
	
	function order_info(){
		if(!$order=osc_order()->order_info(input('param.order_id'),UID)){
			$this->error('非法操作！！');
		}
		//var_dump($order);
		$order_id = $order['order']['order_id'];
		$goods = Db::name('order_goods')->where('order_id',$order_id)->find();
		$goods_id = $goods['goods_id'];
	
		//搜索优惠券数据库寻找对应券码
		$catgory = Db::name('goods_to_category')->where('goods_id',$goods_id)->find(); 
		//print_r($catgory);
		$catgory_id = $catgory['category_id'];
		if($catgory_id == '33')
		{
			$coupon = Db::name('order_coupon')->where('order_id',$order_id)->find();
			$coupon_code = $coupon['coupon_code'];
			//print_r($coupon);
			$this->assign('coupon_code',$coupon_code);
			
			}
		$this->assign('order',$order);	
		$this->assign('SEO',['title'=>'订单详情-'.config('SITE_TITLE')]);
		$this->assign('top_title','订单详情');
		return $this->fetch();
	}
	function cancel_order(){
		osc_order()->cancel_order((int)input('param.order_id'),UID);
		storage_user_action(UID,user('nickname'),config('FRONTEND_USER'),'取消了订单');
		return 1;
	}
	
}
