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
use osc\common\controller\Base;
use \think\Db;
use wechat\Curl;
use msjava\p1Sign;
use msjava\makeEnvelope;
use msjava\openEnvelope;
class Payment extends Base{
	
	//积分兑换
	public function points_pay(){
		if(request()->isPost()){
		
			$result=$this->validate_pay('points');
			
			if(isset($result['error'])){
				return $result;
			}
			
			$cart=osc_cart();
			//兑换所需积分
			$pay_points=$cart->get_pay_points($result['uid'],'points');
			
			if(user('points')<$pay_points){
				return ['error'=>'积分不足，剩余积分'.user('points')];
			}
			
			//需要配送的,积分兑换都不需要运费
			if($result['shipping']){							
				$order['shipping_method']=config('default_transport_id');			
			}else{				
				$order['shipping_method']='';
			}
	
			$order['shipping_address_id']=input('post.address_id');
			
			$order['payment_method']='points';
			$order['weight']=0;
			$order['shipping_city_id']=$result['city_id'];
			$order['comment']=input('post.comment');
			$order['uid']=$result['uid'];
			$order['type']='points';
			//print_r($order);
			//写入订单
			$_order=osc_order()->add_order('points',$order);			
			//积分
			Db::name('member')->where('uid',$result['uid'])->setDec('points',$pay_points);	//剩余
			Db::name('member')->where('uid',$result['uid'])->setInc('cash_points',$pay_points);	//已经兑换
			//写入积分记录
			Db::name('points')->insert([
				'uid'=>$result['uid'],
				'order_id'=>$_order['order_id'],
				'order_num_alias'=>$_order['pay_order_no'],
				'points'=>$pay_points,
				'description'=>'积分兑换',
				'prefix'=>2,
				'creat_time'=>time(),
				'type'=>1				
			]);	
			//清空购物车
			Db::name('cart')->where(array('uid'=>$result['uid'],'type'=>'points'))->delete();
			//清空购物车
			osc_order()->update_order($_order['order_id']);
			
			return ['success'=>1];			
		}	
	}

	//清空购物车
	private function clear_cart($uid,$type='money'){
		Db::name('cart')->where(array('uid'=>$uid,'type'=>$type))->delete();
		session('mobile_total',null);
	}
	
	//数据验证
	private function validate_pay($type='money'){
		
		$uid=user('uid');
		
		if(!$uid){
			return ['error'=>'请先登录'];
		}
		
		$cart=osc_cart();
		//print_r($cart);
		if(!$cart->count_cart_total($uid,$type)) {	
			return ['error'=>'您的购物车没有商品'];	
		}
		
		$city_id=input('post.city_id');		
		
		$shipping=$cart->has_shipping(user('uid'),$type);
		//配送验证
		if(isset($shipping['error'])){			
			return ['error'=>$shipping['error']];
		}
		
		//需要配送的
		if($shipping){
			if($city_id==''){
				return ['error'=>'请选择收货地址'];
			}
		}
		
		// 验证商品数量		
		$cart_list=Db::name('cart')->where('uid',$uid)->select();
		
		foreach ($cart_list as $k => $v) {
			
			$param['option']=json_decode($v['goods_option'], true);
			$param['goods_id']=$v['goods_id'];
			$param['quantity']=$v['quantity'];
			
			//判断商品是否存在，验证最小起订量   		
	   		if($error=$cart->check_minimum($param)){   			
	   			return $error;			
	   		}			
					
			//验证商品数量和必选项
			if($error=$cart->check_quantity($param)){			
				return $error;
			}
			
		}
		return [
			'uid'=>$uid,
			'city_id'=>$city_id,
			'shipping'=>$shipping
		];
	}
	//支付宝支付
	function alipay_pay(){
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
			
		}
	}
	//支付宝异步通知
	function alipay_notify(){
		
		$alipay= new \payment\alipay\Alipay(payment_config('alipay'));	
		
		$verify_result = $alipay->verifyNotify();
		
		if($verify_result) {		
			
			$post=input('post.');
			
			$order=Db::name('order')->where('order_num_alias',$post['out_trade_no'])->find();
			
			if($post['trade_status'] == 'TRADE_FINISHED') {				
				
		    }elseif($post['trade_status'] == 'TRADE_SUCCESS') {		
				
				if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
										
					osc_order()->update_order($order['order_id']);
					
					echo "success";		
									
				}else{
					echo "fail";
				}		        
				
		    }			
			
		}else{
			
			echo "fail";
		}
	}
	//支付宝同步通知
	function alipay_return(){
		
		$alipay= new \payment\alipay\Alipay(payment_config('alipay'));		
		//对进入的参数进行远程数据判断
		$verify = $alipay->return_verify();
	
		if($verify){
		
			$get=input('param.');
			
			$order=Db::name('order')->where('order_num_alias',$get['out_trade_no'])->find();
			
			if($order['order_status_id']==config('paid_order_status_id')){
				@header("Location: ".url('pay_success/index'));	
				die;
			}
			
			if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
				//支付完成
				if($get['trade_status']=='TRADE_SUCCESS'){					
					
					osc_order()->update_order($order['order_id']);
					
					@header("Location: ".url('pay_success/index'));	
				}						
			}else{
				die('订单不存在');
			}
			
		}else{
			die('支付失败');
		}
	}
	
	//支付宝，我的订单-》立即支付
	function alipay_repay(){
		
		$order_id=(int)input('param.order_id');
		
		$check=osc_order()->check_goods_quantity($order_id);
		
		if(isset($check['error'])){
			return $check;
		}
		
		$order=Db::name('order')->where('order_id',$order_id)->find();
		
		if($order&&($order['order_status_id']!=config('paid_order_status_id'))){		
		
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
					"out_trade_no"	=> $order['order_num_alias'],
					"subject"	=> $order['pay_subject'],
					"total_fee"	=> $order['total'],
					"show_url"	=> '',
					'transport'=>'http',
					'sign_type'=>strtoupper('MD5'),
					//"app_pay"	=> "Y",//启用此参数能唤起钱包APP支付宝
					"body"	=> '',								
			);
	
			
			$alipay = new \payment\alipay\Alipay($alipay_config,'mobile');
			
			$url = $alipay->get_payurl();
			
			return ['success'=>1,'url'=>$url];
		}else{
			return ['error'=>'订单已经支付'];
		}
	}
	//微信支付
	function weixin_pay(){
		if(request()->isPost()){
			
			$jssdk_order=session('jssdk_order');
			
			if(!empty($jssdk_order)){
				
				$return=$jssdk_order;
				
			}else{
				
				$result=$this->validate_pay();
				 //print_r($result);
				if(isset($result['error'])){
					return $result;
				}
				//$uid = 
				$cart=osc_cart();
				
				//需要配送的
				if($result['shipping']){								
					$weight = $cart->get_weight($result['uid']);	
					$order['shipping_method']=config('default_transport_id');			
				}else{
					$weight=0;
					$order['shipping_method']='';
				}
				//支付成功后向数据库插入订单信息
				$order['shipping_address_id']=input('post.address_id');
				
				$order['payment_method']='weixin';
				$order['weight']=$weight;
				$order['shipping_city_id']=$result['city_id'];
				$order['comment']=input('post.comment');
				$order['uid']=$result['uid'];
				//$order['merchant_id'] = 
				$jssdk_order=session('jssdk_order');			
			
				$return=osc_order()->add_order('weixin',$order);
				//var_dump($return);
				session('jssdk_order',$return);
				
				$this->clear_cart($return['uid']);
			}				
			
			return $this->getBizPackage($return);
			
		}
	}
	//微信，我的订单-》立即支付
	function weixin_repay(){
		$order_id=(int)input('param.order_id');
		
		$check=osc_order()->check_goods_quantity($order_id);
		
		if(isset($check['error'])){
			return $check;
		}
		
		$order=Db::name('order')->where('order_id',$order_id)->find();
		
		if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
				
			$return['pay_total']=$order['total'];
			$return['subject']=$order['pay_subject'];
			$return['pay_order_no']=$order['order_num_alias'];
			
		
			return $this->getBizPackage($return);
		}else{
			return ['error'=>'订单已经支付'];
		}
	}
	public function jsskd_notify(){
		
		if(wechat()->checkPaySign()){
			
			$sourceStr = file_get_contents('php://input');		
		 
	        // 读取数据
	        $postObj = simplexml_load_string($sourceStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		 
			if (!$postObj) {
	       		 echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
	        } else {
			
				$order=Db::name('order')->where('order_num_alias',$postObj->out_trade_no)->find();		
					
				if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
										
					osc_order()->update_order($order['order_id']);
					
					echo "<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>";	
									
				}else{
					echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
				}	
				
	        }			
			
		}else{  
			
			echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
			
		}
		die;
	}

	//微信jssdk回调
	public function jsskd_notify1(){
		//$fi ='log.txt';
		//$sj ='3     ';
		//file_put_contents($fi,$sj,FILE_APPEND);
		$input = file_get_contents('php://input');
		$input = json_decode($input,true);
		$input = openEnvelope::oenvelope($input['context']);
		$input = json_decode($input,true);
		$input = base64_decode($input['Base64SourceString']);

		$input = json_decode($input,true);
		$input = $input['body'];
		 
		$input = json_decode($input,true);
		$tradeStatus = $input['tradeStatus'];
		$tee = $input['amount'];
		$orderNo = $input['orderNo'];
		//$result_code = $input['result_code'];
		
		$input = (explode("|",$input['centerInfo']));
		
		
		//if(wechat()->checkPaySign()){
		if($tradeStatus == 'S'){
			$sourceStr = '<xml><appid><![CDATA[wxda24132f43802300]]></appid><bank_type><![CDATA[CFT]]></bank_type><cash_fee><![CDATA['.$tee.']]></cash_fee><fee_type><![CDATA[CNY]]></fee_type><is_subscribe><![CDATA[Y]]></is_subscribe><mch_id><![CDATA[1357020302]]></mch_id><nonce_str><![CDATA[B839ZINk7uJTJXeg]]></nonce_str><openid><![CDATA['.substr($input[0],7,28).']]></openid><out_trade_no><![CDATA['.$orderNo.']]></out_trade_no><result_code><![CDATA[SUCCESS]]></result_code><return_code><![CDATA[SUCCESS]]></return_code><sign><![CDATA[616F531560F3B83BB9C8791F97E66D1C]]></sign><time_end><![CDATA['.substr($input[3],9,14).']]></time_end><total_fee>'.$tee.'</total_fee><trade_type><![CDATA[JSAPI]]></trade_type><transaction_id><![CDATA['.substr($input[5],15,28).']]></transaction_id></xml>';
			//$sourceStr = file_get_contents('php://input');	
				//file_put_contents($fi,$sourceStr,FILE_APPEND);
		 
	        // 读取数据
	        $postObj = simplexml_load_string($sourceStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		 //file_put_contents($fi,$postObj,FILE_APPEND);
			if (!$postObj) {
	       		 echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
	        } else {
			
				$order=Db::name('order')->where('order_num_alias',$postObj->out_trade_no)->find();	
				if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
																		
					osc_order()->update_order($order['order_id']);
					
					if($order)
					echo "<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>";	
									
				}else{
					echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
				}	
				
	        }			
			
		}else{  
			
			echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
			
		}
		die;
	}

	//积分回调
	public function jssjf_notify(){

		file_put_contents($fi,$input,FILE_APPEND);
		if(wechat()->checkPaySign()){
			
			$sourceStr = file_get_contents('php://input');	
		 
	        // 读取数据
	        $postObj = simplexml_load_string($sourceStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		 file_put_contents($fi,$postObj,FILE_APPEND);
			if (!$postObj) {
	       		 echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
	        } else {
			
				$order=Db::name('order')->where('order_num_alias',$postObj->out_trade_no)->find();	
				if($order&&($order['order_status_id']!=config('paid_order_status_id'))){
																		
					osc_order()->update_order($order['order_id']);
					
					if($order)
					echo "<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>";	
									
				}else{
					echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
				}	
				
	        }			
			
		}else{  
			
			echo "<xml><return_code><![CDATA[FAIL]]></return_code></xml>";
			
		}
		die;
	}
	//微信支付 package
	function getBizPackage1($data){
		   
	
			$wx=wechat();
			
			$m = ($data['pay_total'])*100;
			$time = date('YmdHis');
			$date = date('Ymd');
			$hm = microtime();
			$hm = (substr($hm,0,5)*1000);
			$time = $time.$hm;
			//商户订单号
			$merchantSeq = $data['pay_order_no'];
			//商户流水号
			//$mchSeqNo = 'WDBG2018001'.$time;
			$mchSeqNo = 'wdbg00000000000'.$data['pay_order_no'];
			$json = '{"platformId":"A00012017050000001080","merchantNo":"M55002017050000563579","merchantSeq":"'.$merchantSeq.'","mchSeqNo":"'.$mchSeqNo.'","selectTradeType":"H5_WXJSAPI","amount":"'.$m.'","orderInfo":"统一下单DEMO-H5_WXJSAPI","notifyUrl":"http://jfshop.gxwdbg.com/mobile/payment/jsskd_notify.php","remark":"","transDate":"'.$date.'","transTime":"'.$time.'","inExtData":"测试请求扩展大字段","subOpenId":"'.$wx->getOpenId().'","subAppId":"wxda24132f43802300"}';
			$basejson = base64_encode($json);
			$signjson = p1Sign::sign($basejson);
			
			$encrypt = json_decode($signjson);
			//print_r($encrypt);
			$signjson = $encrypt->{'Base64SignatureData'};
			
			$mqsignjson = '{"sign":"'.$signjson.'","body":"{\"platformId\":\"A00012017050000001080\",\"merchantNo\":\"M55002017050000563579\",\"merchantSeq\":\"'.$merchantSeq.'\",\"mchSeqNo\":\"'.$mchSeqNo.'\",\"selectTradeType\":\"H5_WXJSAPI\",\"amount\":\"'.$m.'\",\"orderInfo\":\"统一下单DEMO-H5_WXJSAPI\",\"notifyUrl\":\"http://jfshop.gxwdbg.com/mobile/payment/jsskd_notify.php\",\"remark\":\"\",\"transDate\":\"'.$date.'\",\"transTime\":\"'.$time.'\",\"inExtData\":\"测试请求扩展大字段\",\"subOpenId\":\"'.$wx->getOpenId().'\",\"subAppId\":\"wxda24132f43802300\"}"}';
			
	

			//加密后数据
			$mhsignjson = makeEnvelope::menvelope(base64_encode($mqsignjson));
			$mhsignjson = json_decode($mhsignjson);
			
			$business = $mhsignjson->{'Base64EnvelopeMessage'};
			
			$api = '{"businessContext":"'.$business.'","merchantNo":"","merchantSeq":"","reserve1":"","reserve2":"","reserve3":"","reserve4":"","reserve5":"","reserveJson":"","securityType":"","sessionId":"","source":"","transCode":"","transDate":"","transTime":"","version":""}';
			
			
			$ch = curl_init('http://epay.cmbc.com.cn/appweb/appserver/lcbpPay.do');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $api);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' .strlen($api))                                                                       
			);                                                                                                                 
			$result = json_decode(curl_exec($ch));
			//print_r($result);
			$apif = $result->{'businessContext'};
			//print_r($apif);
			$apif = json_decode(openEnvelope::oenvelope($apif));
			$apif = base64_decode($apif->{'Base64SourceString'});
			
			$apif = json_decode($apif,true);
			$apif = json_decode($apif['body'],true);
			//print_r($apif);
			$payInfo = $apif['payInfo'];
			//$sign1 = substr($js[3],8,344);
			//echo $sign1 = json_decode(openEnvelope::oenvelope($sgin1));
			//print_r($payInfo);
			$js = (explode("|",$payInfo));
			$jt['timestamp'] = substr($js[1],10,13);
			$jt['nonceStr'] = substr($js[2],9,32);
			$jt['package'] = 'prepay_id='.substr($js[0],9,36);
			$jt['signType'] = 'RSA';
			$jt['paySign'] =  substr($js[3],8,344);;
			//$sign = 'appid=wx9484c7fa7eb1fbec'.'&nonceStr='.$jt['nonceStr'].'&package='.$jt['package'].'&signType=MD5'.'&timestamp='.$jt['timestamp'].'&key=wDbg4955123HYJc5385705WdBG123123';

			//$string = md5($jt['paySign']);
			//签名步骤四：所有字符转为大写
			//$result = strtoupper($string);

			//$jt['paySign'] = $result;
			//var_dump($js);
		//	var_dump($jt);
			return json(['ret_code'=>0,'bizPackage'=>$jt]);
         
	  //}	

	}
		function getBizPackage($data){
		
		$wx=wechat();
		// 订单总额
        $totalFee = ($data['pay_total'])*100;
        // 随机字符串
        $nonceStr = $wx->generateNonceStr();	

		$config=payment_config('weixin');


        // 时间戳
       $timeStamp = strval(time());		
		
		
		
		
	$pack = array(
	        //'appid' =>$config['appid'],
	        'appid' =>'wxda24132f43802300',
			'body' => $data['subject'],
	        //'mch_id' =>$config['weixin_partner'],
	        'mch_id' =>'1357020302',
			'nonce_str' => $nonceStr,
	        'notify_url' =>request()->domain().url('payment/jsskd_notify'),
	        'spbill_create_ip' => get_client_ip(),
	        'openid' => $wx->getOpenId(),
	        // 外部订单号
	        'out_trade_no' => $data['pay_order_no'],
	        'timeStamp' => $timeStamp,
	        'total_fee' => $totalFee,
	        'trade_type' => 'JSAPI'
		);
		
        $pack['sign'] = $wx->paySign($pack);

         $xml = $wx->toXML($pack);
		//print_r($xml);
        $ret = Curl::post('https://api.mch.weixin.qq.com/pay/unifiedorder', $xml);					
		
        $postObj = json_decode(json_encode(simplexml_load_string($ret, 'SimpleXMLElement', LIBXML_NOCDATA)));
		//var_dump($postObj);
		if (empty($postObj->prepay_id) || $postObj->return_code == "FAIL") {
		   
              return json(['ret_code'=>11,'bizPackage'=>'']);			  
        } else {
			
			
            $packJs = array(
                'appId' => $config['appid'],
                'timeStamp' => $timeStamp,
                'nonceStr' => $nonceStr,
                'package' => "prepay_id=" . $postObj->prepay_id,
                'signType' => 'MD5'
            );
			
            $JsSign = $wx->paySign($packJs);			               
		
            $p['timestamp'] = $timeStamp;
			$p['nonceStr'] = $nonceStr;							
			$p['package'] = "prepay_id=" . $postObj->prepay_id;
			$p['signType'] = 'MD5';
            $p['paySign'] = $JsSign;
			//var_dump($p);
			return json(['ret_code'=>0,'bizPackage'=>$p]);
         
	  }	

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
	public function sendcode(){
		$phone = $_GET['tell'];
		$merchant = '10026';//商户号
		
		$linkstr = "merchant=".$merchant."phone=".$phone."&key=n261e99472ff6vu7a5lroxqd6e6kvs6h";
		$sign = md5($linkstr);
		$a = "merchant=".$merchant."&phone=".$phone."&sign=".$sign;
		$dx = "http://pay.icares.me/sendIdentifyCodeSub?".$a;
		
		$json_data = $this->curl_get($dx);
		$data = json_decode($json_data);
		$data = $this->object_array($data);
		//print_r($data);
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
			
			$order['payment_method']='jfpay';
			$order['weight']=$weight;
			$order['shipping_city_id']=$result['city_id'];
			$order['comment']=input('post.comment');
			$order['uid']=$result['uid'];
		
			$order=osc_order()->add_order('jfypay',$order);
			
			//$this->clear_cart($order['uid']);
			
		/*------------以上是同用代码，用于将订单写入数据库-------------- */
			
			//$money = $_GET['total_price'];
			$phone =input('post.phone');
			$money = ($order['pay_total']*100);
			$ORDERSEQ = $order['pay_order_no'];
			$PAYER = '4626';
			$sign = 'kkwqfutqhoe8hp50yixz1k8qh20u6rk5';
			$Ynotify_url = 'http://jfshop.gxwdbg.com/jffh.php';
			$return_url = 'http://jfshop.gxwdbg.com/mobile/pay_success/index';
			$url = 'http://easepay.icares.me/yzfApi.ashx?cmd=yzfSendOrder';
			$data = "phone=".$phone."&money=".$money."&ORDERSEQ=".$ORDERSEQ."&PAYER=".$PAYER."&Ynotify_url=".$Ynotify_url."&return_url=".$return_url."&sign=".$sign;
			$json_data = $this->curl_post($url,$data);
			//return $phone;
			//return $json_data;
			//header("Location: $json_data"); 
			//确保重定向后，后续代码不会被执行 
			//exit;
			//var_dump($json_data);	
				}
			}
		
		public function ydjfpay()
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
			
			$order['payment_method']='jfpay';
			$order['weight']=$weight;
			$order['shipping_city_id']=$result['city_id'];
			$order['comment']=input('post.comment');
			$order['uid']=$result['uid'];
		
			$order=osc_order()->add_order('jfypay',$order);
			//print_r($order);
			//$this->clear_cart($order['uid']);
			
		/*------------以上是同用代码，用于将订单写入数据库-------------- */	
			
			//$money = $_GET['total_price'];
			$phone = input('post.phone');
			$money = ($order['pay_total']*100);
			$acceptid = input('post.acceptid');
			$code = input('post.code');
			$merchant = '10026';
			//$merchant = '1';
			$ordernum = substr($order['pay_order_no'],0,13);
			$notify_url = 'http://jfshop.gxwdbg.com/mobile/payment/jssjf_notify.php';
			//echo '&not';
			$key = 'n261e99472ff6vu7a5lroxqd6e6kvs6h';
			$linkstr = 'acceptid='.$acceptid.'&code='.$code.'&merchant='.$merchant.'&money='.$money.'&notify_url='.$notify_url.'&ordernum='.$ordernum.'&phone='.$phone."&key=".$key;
			$sign = md5($linkstr);
			$pay = 'acceptid='.$acceptid.'&code='.$code.'&merchant='.$merchant.'&money='.$money.'&notify_url='.$notify_url.'&ordernum='.$ordernum.'&phone='.$phone."&sign=".$sign;
			$url = "http://pay.icares.me/paySub";
			return $json_data = $this->curl_post($url,$pay);
			//print_r($json_data);
			//var_dump($json_data);
		}
		}
	//合包支付
	public function hbpay()
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
			
			$order['payment_method']='jfpay';
			$order['weight']=$weight;
			$order['shipping_city_id']=$result['city_id'];
			$order['comment']=input('post.comment');
			$order['uid']=$result['uid'];
		
			$order=osc_order()->add_order('jfypay',$order);
			
			//$this->clear_cart($order['uid']);
			
		/*------------以上是同用代码，用于将订单写入数据库-------------- */
			
			//$money = $_GET['total_price'];
			$userToken =input('post.phone');
			$amount = ($order['pay_total']*100);
			$requestId = $order['pay_order_no'];
			$callbackUrl = 'http://jfshop.gxwdbg.com/mobile/pay_success/index';
			$userID = '4626';
			$notify = 'http://jfshop.gxwdbg.com/mobile/pay_success/index';
			$url = 'http://easepay.icares.me/hbApi.ashx?cmd=SendMsgOrder';
			//echo $data = "amount=".$amount."callbackUrl=".$callbackUrl."notify=".$notify."requestId=".$requestId."userID=".$userID."userToken=".$userToken;
			$data = "callbackUrl=".$callbackUrl."&requestId=".$requestId."&amount=".$amount."&userToken=".$userToken."&productName=ceshi&reserved1=".$userID."&notify=".$notify;
			//$json_data = $this->curl_post($url,$data);
			//return $phone;
			//return $json_data;
			//header("Location: $json_data"); 
			//确保重定向后，后续代码不会被执行 
			//exit;
			//var_dump($json_data);
				}
			}
		
}
?>