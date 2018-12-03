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
use osc\mobile\validate\Address;
use \think\Db;
class Cart extends MobileBase{

	function index(){
		
		$uid=null;
				
		$uid=osc_service('mobile','user')->is_login();	
		
		if(in_wechat()){
			$wechat=wechat();
			//调用微信收货地址接口，需要开通微信支付
			$this->assign('signPackage',$wechat->getJsSign(request()->url(true)));	
			session('jssdk_order',null);
		}
		
		$cart=osc_cart();
		if('points'==input('param.type')){
			$goods=$cart->get_all_goods($uid,'points');	
			$shipping=$cart->has_shipping($uid,'points');
		}else{
			$goods=$cart->get_all_goods($uid);	
			$shipping=$cart->has_shipping($uid);
		}
	
		$total_all_price=0;
		
		$total_point=0;
		
		$weight = 0;
		//dump($goods);
		if(!empty($goods)){
			foreach ($goods as $k => $v) {
				$total_point+=$v['total_pay_points'];
				$total_all_price+=$v['total'];
				if ($v['shipping']) {
					$weight += osc_weight()->convert($v['weight'], $v['weight_class_id'],config('weight_id'));
				}
			}				
		}
		
		if(isset($shipping['error'])){
				
			$this->assign('error',$shipping['error']);	
			
			$this->assign('shipping','true');
		}else{			
			$this->assign('shipping',$shipping);
		}
		
		if($shipping){//需要配送
		
			$address_id=(int)user('address_id');
			//配送地址		
			$address=Db::name('address')->where('address_id',$address_id)->find();				
			//计算运费
			if(isset($address)){			
			
				$this->assign('address',$address);
					
				$t=osc_transport()->calc_transport(config('default_transport_id'),$weight,$address['city_id']);
				
				$transport=$t['price'];
				
			}else{
				$transport=0;
			}		
			//手机版中
			if(!in_wechat()){
				$this->assign('all_address',Db::name('address')->where('uid',(int)$uid)->select());
			}
			$this->assign('transport',$transport);	
		}

		$this->assign('goods',$goods);		
		$this->assign('total_price',$total_all_price);		
		$this->assign('weight',$weight);		
		
		if('points'==input('param.type')){//积分购物车			
			$this->assign('total_point',$total_point);
			$this->assign('points',true);	
		}
		
		$this->assign('SEO',['title'=>'购物车-'.config('SITE_TITLE')]);
		$this->assign('top_title','购物车');
		$this->assign('flag','cart');
		 return $this->fetch();
	}
	
	function add(){
				
		$uid=osc_service('mobile','user')->is_login();	
		
		if(!$uid){
			return ['error'=>'请先登录','url'=>url('login/login')];
		}
		
		$cart=osc_cart();
		
		$param=input('post.');
		//print_r($param);
   		//判断商品是否存在，并验证最小起订量   		
   		if($error=$cart->check_minimum($param)){   			
   			return $error;			
   		}		
		//验证商品数量和必选项
		if($error=$cart->check_quantity($param)){			
			return $error;
		}			
		$param['uid']=$uid;
		
		if(isset($param['pay_type'])){
			$param['type']='points';
		}
		
		//加入购物车	
		if($cart->add($param)){
			//计算购物车商品数量
			$total=$cart->count_cart_total($uid);
			//设置session中购物车商品数量
			osc_service('mobile','user')->set_cart_total($total);
			
			storage_user_action($uid,user('username'),config('FRONTEND_USER'),'加入商品到购物车');
			return ['success'=>'加入成功','total'=>$total];
		}else{
			return ['error'=>'加入失败'];
		}
	}

	//更新购物车
	public function update(){
				
		$uid=osc_service('mobile','user')->is_login();	
		
		if(!$uid){
			return ['error'=>'请先登录','url'=>url('login/login')];
		}
		
		$d=input('post.');
		
		$cart=osc_cart();

		$goods_id=(int)$d['id'];	
		
		$quantity=(int)$d['q'];
		
		$cart_id=(int)$d['cart_id'];
		
		$city_id=(int)$d['city_id'];
		
		$cart_data=Db::name('cart')->find($cart_id);			
		$param['option']=json_decode($cart_data['goods_option'], true);
		$param['goods_id']=$goods_id;
		$param['quantity']=$quantity;	
		
		//判断商品是否存在，验证最小起订量   		
   		if($error=$cart->check_minimum($param)){   			
   			return $error;			
   		}			
				
		//验证商品数量和必选项
		if($error=$cart->check_quantity($param)){			
			return $error;
		}		
		
		//更新购物车商品数量		
		$return=$cart->update_goods_quantity($goods_id,$cart_id,$quantity,$uid);
		
		//更新 购物车的商品数量			
		osc_service('mobile','user')->set_cart_total($return['total_quantity']);	
		
		storage_user_action(user('uid'),user('nickname'),config('FRONTEND_USER'),'更新了购物车商品');
		
		//计算运费
		if($city_id){			
			$t=$t=osc_transport()->calc_transport(config('default_transport_id'),$return['weight'],$city_id);
			$transport=$t['price'];
		}else{
			$transport=0;
		}	
	
		return [
			//运费
			'transport'=>$transport,
			//数量
			'success'=>$return['total_quantity'],
			//商品单价
			'price'=>$return['goods_price'],
			//所有商品总价
			'total_all_price'=>$return['total_all_price'],
			//所有商品重量
			'weight'=>$return['weight'],
		];
		
		
	}
	
	public function remove(){
				
		$uid=osc_service('mobile','user')->is_login();	
		
		if(!$uid){
			return ['error'=>'请先登录','url'=>url('login/login')];
		}
		
		$cart=osc_cart();
		
		$cart->remove((int)input('param.cart_id'),$uid);	
				
		storage_user_action(user('uid'),user('nickname'),config('FRONTEND_USER'),'删除了购物车商品');
		
		if(('points'!=input('param.type'))){
			$goods=$cart->get_all_goods($uid);	
			$total=$cart->count_cart_total($uid);
		}else{
			$goods=$cart->get_all_goods($uid,'points');	
			$total=$cart->count_cart_total($uid,'points');
		}			
		
		osc_service('mobile','user')->set_cart_total($total);	
		
		$total_all_price=0;
		
		$total_point=0;
		
		$weight = 0;
		
		if(!empty($goods)){
			foreach ($goods as $k => $v) {
				$total_point+=$v['total_pay_points'];
				$total_all_price+=$v['total'];
				if ($v['shipping']) {
					$weight += osc_weight()->convert($v['weight'], $v['weight_class_id'],config('weight_id'));
				}
			}				
		}		
		
		$city_id=(int)input('param.city_id');
		
		if($city_id){			
			$t=osc_transport()->calc_transport(config('default_transport_id'),$weight,$city_id);
			$transport=$t['price'];
		}else{
			$transport=0;
		}	
			
		return [
			//运费
			'transport'=>$transport,
			//数量
			'total_num'=>$total,
			//商品单价
			'total_pay_points'=>$total_point,
			//所有商品总价
			'total_all_price'=>$total_all_price,
			//所有商品重量
			'weight'=>$weight,
		];	

	}
	
	//更新地址，计算运费(积分兑换的不需要计算运费)
	function update_address(){
		if(request()->isPost()){
			$data=input('post.');					
				 	
			$validate=new Address();
				
			if(!$validate->check($data)){				
			    return ['error'=>$validate->getError()];				
			}
			
			$province_id=get_area_id_by_name($data['province']);
			
			$city_id=get_area_id_by_name($data['city_id']);
			
			$country_id=get_area_id_by_name($data['country_id']);
			
			$weight=$data['weight'];
			
			$address['uid']=user('uid');
			$address['name']=$data['name'];
			$address['telephone']=$data['tel'];		
			$address['address']=$data['address'];
			
			$address['province_id']=$province_id;
			$address['city_id']=$city_id;
			$address['country_id']=$country_id;
			
			if($data['type']=='add'){
				$r=Db::name('address')->insert($address,false,true);
				$address_id=$r;
			}elseif($data['type']=='edit'){
				$r=Db::name('address')->where('address_id',(int)$data['address_id'])->update($address,false,true);
				$address_id=(int)$data['address_id'];
			}		
			storage_user_action(user('uid'),user('nickname'),config('FRONTEND_USER'),'更新了收货地址');
			
			Db::name('member')->where('uid',user('uid'))->update(['address_id'=>$address_id]);
			
			if($r){
				$transport=osc_transport()->calc_transport(config('default_transport_id'), $weight,$city_id);
				return ['success'=>'1','transport'=>$transport,'city_id'=>$city_id,'address_id'=>$address_id];
			}else{
				return ['error'=>'编辑失败'];
			}
		}
	}
	
	function get_address_list(){
		
		$list=Db::name('address')->where('uid',user('uid'))->select();
		
		if($list){
			return ['list'=>$list];
		}else{
			return null;
		}
		
	}
	//选择收货地址后，计算运费,手机版
	function update_transport(){
		if(request()->isPost()){
			$weight=input('post.weight');
			$city_id=input('post.city_id');
			
			Db::name('member')->where('uid',user('uid'))->update(['address_id'=>(int)input('post.address_id')]);
			
			$transport=osc_transport()->calc_transport(config('default_transport_id'),$weight,$city_id);
			if($transport){
				return ['transport'=>$transport];
			}else{
				return ['error'=>'运费计算失败，请设置一个默认的运费模板'];
			}
		}
		
	}
	
	//选择收货地址后，计算运费,微信版，(地址名称和数据库表area数据不同有可能找不到数据)
	function weixin_update_transport(){
		
		$data=input('post.');
		
		$province_id=get_area_id_by_name($data['province']);
		
		$city_id=get_area_id_by_name($data['area_id']);
		
		$country_id=get_area_id_by_name($data['country']);		
		
		$uid=(int)user('uid');
		
		$address['uid']=$uid;
		$address['name']=$data['name'];
		$address['telephone']=$data['tel'];		
		$address['address']=$data['address'];
		
		$address['province_id']=$province_id;
		$address['city_id']=$city_id;
		$address['country_id']=$country_id;
		
		Db::name('address')->where('uid',$uid)->delete();
		
		$address_id=Db::name('address')->insert($address,false,true);
		
		storage_user_action($uid,user('nickname'),config('FRONTEND_USER'),'更新了收货地址');
		
		Db::name('member')->where('uid',$uid)->update(['address_id'=>$address_id]);		
		
		$transport=osc_transport()->calc_transport(config('default_transport_id'),$data['weight'],$city_id);		
		
		return ['transport'=>$transport,'address_id'=>$address_id,'city_id'=>$city_id];
	}
	
	function get_address(){
		
		$address_id=(int)input('param.aid');
		if(!$address_id){
			return ['error'=>'操作失败'];
		}
		$address=Db::name('address')->where('address_id',$address_id)->find();
		
		return ['success'=>'1',
		'address'=>$address,
		'area'=>get_area_name($address['province_id']).' '.get_area_name($address['city_id']).' '.get_area_name($address['country_id'])];		
	}
		public function object_array($array) {  
	    if(is_object($array)) {  
	        $array = (array)$array;  
	     } if(is_array($array)) {  
	         foreach($array as $key=>$value) {  
	             $array[$key] = $this->object_array($value);  
	             }  
	     }  
		     return $array;  
		}
		public function curl_get($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		$output = curl_exec($ch);
		curl_close($ch);
		//print_r($output);
		return $output;
		}
		//移动积分支付
		public function sendcode(){
		$phone = $_GET['tell'];
		$merchant = '10019';//商户号
		
		$linkstr = "merchant=".$merchant."phone=".$phone."&key=10dc50a2c62346d38c2f23970ce08196";
		$sign = md5($linkstr);
		$a = "merchant=".$merchant."&phone=".$phone."&sign=".$sign;
		echo $dx = "http://pay.icares.me/sendIdentifyCodeSub?".$a;
		
		$json_data = $this->curl_get($dx);
		$data = json_decode($json_data);
		$data = $this->object_array($data);
		print_r($data);
		$acceptid = $data['data']['acceptid'];
		header("Content-type: application/json");
		exit(json_encode($acceptid));
		}
		function curl_post($url,$post_data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}
	//电信翼支付积分支付
		public function sendcodedx()
		{
			if(request()->isPost()){
		
			$result=$this->validate_pay();
			
			if(isset($result['error'])){
				return $result;
			}
			
			$cart=osc_cart();
			
			//需要配送的
			if($result['shipping']){								
				$weight = $cart->get_weight($result['uid']);	
				$order['shipping_method']=config('default_transport_id');			
			}else{
				$weight=0;
				$order['shipping_method']='';
			}
	
			$order['shipping_address_id']=input('post.address_id');
			
			$order['payment_method']='alipay';
			$order['weight']=$weight;
			$order['shipping_city_id']=$result['city_id'];
			$order['comment']=input('post.comment');
			$order['uid']=$result['uid'];
		
			$order=osc_order()->add_order('alipay',$order);
			
			$this->clear_cart($order['uid']);
			$config=payment_config('alipay');
			
			$alipay_config = array(
					"service"       => 'alipay.wap.create.direct.pay.by.user',
					"partner"       => $config['partner'],
					"seller_id"     => $config['partner'],
					"key"			=> $config['key'],
					"payment_type"	=> 1,
					"notify_url"	=> request()->domain().url('payment/alipay_notify'),
					"return_url"	=> request()->domain().url('payment/alipay_return'),
					"_input_charset"	=> trim(strtolower(strtolower('utf-8'))),
					"out_trade_no"	=> $order['pay_order_no'],
					"subject"	=> $order['subject'],
					"total_fee"	=> $order['pay_total'],
					"show_url"	=> '',
					'transport'=>'http',
					'sign_type'=>strtoupper('MD5'),
					//"app_pay"	=> "Y",//启用此参数能唤起钱包APP支付宝
					"body"	=> '',								
			);
	
			
			$alipay = new \payment\alipay\Alipay($alipay_config,'mobile');
			
			$url = $alipay->get_payurl();
			
			return ['success'=>1,'type'=>'alipay','url'=>$url];
		/*------------以上是同用代码，用于将订单写入数据库-------------- */	
			/*$config=payment_config('alipay');
			//$money = $_GET['total_price'];
			$phone = $_POST['phone'];
			$money = '1';
			$ORDERSEQ = date('YmdHis');
			$PAYER = '3415';
			$sign = 'cjv2bh8te6hw9gdls2gu8wi3dzwjzzkb';
			$Ynotify_url = 'http://jfshop.gxwdbg.com/jffh.php';
			$return_url = 'http://jfshop.gxwdbg.com/mobile/pay_success/index';
			$url = 'http://easepay.icares.me/yzfapi.ashx?cmd=order';
			$data = "phone=".$phone."&money=".$money."&ORDERSEQ=".$ORDERSEQ."&PAYER=".$PAYER."&Ynotify_url=".$Ynotify_url."&return_url=".$return_url."&sign=".$sign;
			$json_data = $this->curl_post($url,$data);
			return $json_data;*/
			//header("Location: $json_data"); 
			//确保重定向后，后续代码不会被执行 
			//exit;
			//var_dump($json_data);
			
			}
		}
	
}
