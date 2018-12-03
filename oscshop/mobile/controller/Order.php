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
use code\src\BCGColor;
use code\src\BCGDrawing;
use code\src\BCGFontFile;
use code\barcode1d\src\BCGcode39;
class Order extends MobileBase
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
		
		$this->assign('order',$orders_list);
		exit($this->fetch());
       
	}
	//一维码生成
	function barcodegen()
	{
		$font = new BCGFontFile(__DIR__ . '/../font/Arial.ttf', 18);

		// Don't forget to sanitize user inputs
		$text = isset($_GET['text']) ? $_GET['text'] : '1';

		// The arguments are R, G, B for color.
		$color_black = new BCGColor(0, 0, 0);
		$color_white = new BCGColor(255, 255, 255);

		$drawException = null;
		try {
			$code = new BCGcode39();
			$code->setScale(2); // Resolution
			$code->setThickness(30); // Thickness
			$code->setForegroundColor($color_black); // Color of bars
			$code->setBackgroundColor($color_white); // Color of spaces
			$code->setFont($font); // Font (or 0)
			$code->setChecksum(false);
			$code->parse($text); // Text
		} catch (Exception $exception) {
			$drawException = $exception;
		}

		/* Here is the list of the arguments
		1 - Filename (empty : display on screen)
		2 - Background color */
		$drawing = new BCGDrawing('', $color_white);
		if ($drawException) {
			$drawing->drawException($drawException);
		} else {
			$drawing->setBarcode($code);
			$drawing->draw();
		}

		// Header that says it is an image (remove it if you save the barcode to a file)
		header('Content-Type: image/png');
		header('Content-Disposition: inline; filename="barcode.png"');

		// Draw (or save) the image into PNG format.
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
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
			$coupon = Db::name('order_coupon')->where('order_id',$order_id)->select();
			$coupon_code = $coupon['coupon_code'];
			//var_dump($coupon);
			$this->assign('coupon_code',$coupon);
			
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
