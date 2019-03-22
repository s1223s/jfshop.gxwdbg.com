<?php
/**
 *
 * @author    李梓钿
 *
 */
namespace osc\common\service;
use think\Db;
class Order{
	
	//加入订单历史
	public function add_order_history($order_id, $data=array()) {		
		
		$order['order_id']=$order_id;
		$order['date_modified']=time();
		$order['order_status_id']=$data['order_status_id'];
		Db::name('Order')->update($order);		
		
		$oh['order_id']=$order_id;
		$oh['order_status_id']=$data['order_status_id'];
		$oh['notify']=(isset($data['notify']) ? (int)$data['notify'] : 0) ;
		$oh['comment']=strip_tags($data['comment']);
		$oh['date_added']=time();
		$oh_id=Db::name('order_history')->insert($oh,false,true);

		return $oh_id;
		
	}
	//取得订单历史
	public function get_order_histories($order_id,$uid=null) {		
		
		$map['o.order_id']=['eq',$order_id];	
		
		if($uid){
			$map['o.uid']=['eq',$uid];	
		}
		
		$order=Db::name('order')
			->alias('o')				
			->join('__ORDER_HISTORY__ oh','oh.order_id = o.order_id','left')
			->join('__ORDER_STATUS__ os','oh.order_status_id = os.order_status_id','left')			
			->field('oh.*,os.*')
			->where($map)
			->order('oh.order_history_id desc')
			->select();
			
		return $order;	
	}
	//删除订单
	public function del_order($id){
		
		Db::name('order')->where(array('order_id'=>$id))->delete();
		Db::name('order_goods')->where(array('order_id'=>$id))->delete();
		Db::name('order_history')->where(array('order_id'=>$id))->delete();
		Db::name('order_total')->where(array('order_id'=>$id))->delete();
		
	}
	//取消订单
	public function cancel_order($order_id,$uid=null){
		
		if($uid){
			$map['uid']=['eq',$uid];
		}
		$order['order_status_id']=config('cancel_order_status_id');		
		$map['order_id']=['eq',$order_id];		
		//设置订单状态	
		Db::name('order')->where($map)->update($order);	
		//写人订单历史
		Db::execute("INSERT INTO " .config('database.prefix'). "order_history SET order_status_id = ".config('cancel_order_status_id').',order_id='.$order_id.",comment='用户取消了订单',date_added=".time());
		
	}
	
	//订单信息
	public function order_info($order_id,$uid=null){
		
		$map['o.order_id']=['eq',$order_id];	
		
		if($uid){
			$map['m.uid']=['eq',$uid];	
		}
		
		$order=Db::name('order')
			->alias('o')
			->join('__MEMBER__ m','o.uid = m.uid','left')			
			->join('__ORDER_STATUS__ os','o.order_status_id = os.order_status_id','left')
			->join('__ADDRESS__ a','o.address_id = a.address_id','left')
			->field('o.*,m.username,a.*')
			->where($map)
			->find();
		
		if(!$order){
			return false;
		}
			
		return array(
			'order'=>$order,
			'order_product'=>Db::name('order_goods')->alias('og')
			->join('__GOODS__ g','og.goods_id = g.goods_id','left')
			->field('og.*,g.image')->where('og.order_id',$order_id)->select(),			
			'order_total'=>Db::name('order_total')->where('order_id',$order_id)->select(),
			'order_statuses'=>Db::name('OrderStatus')->select(),
			'order_history'=>Db::name('order_history')->where('order_id',$order_id)->select()
		);	
			
	}
	//订单列表
	public function order_list($param=array(),$page_num=20,$uid=null){
		
		$query=[];
		
		if(isset($param['order_num'])){
			$map['Order.order_num_alias']=['eq',$param['order_num']];	
			$query['order_num']=urlencode($param['order_num']);
		}
		if(isset($param['username'])){
			$map['Member.username']=['like',"%".$param['username']."%"];
			$query['username']=urlencode($param['username']);
		}
		if(isset($param['status'])){
			$map['Order.order_status_id']=['eq',$param['status']];	
			$query['status']=urlencode($param['status']);
		}
		if (isset($param['merchant_id'])) {
			$map['Order.merchant_id']=['eq',$param['merchant_id']];	
			$query['merchant_id']=urlencode($param['status']);
		}
		if($uid){
			$map['Member.uid']=['eq',$uid];	
		}
		
		$map['Order.order_id']=['gt',0];
	
		return Db::view('Order','*')
		->view('Member','username,reg_type,nickname','Order.uid=Member.uid')
		->view('OrderStatus','order_status_id,name','Order.order_status_id=OrderStatus.order_status_id')
		->where($map)
		->order('Order.order_id desc')
		->paginate($page_num,false,['query'=>$query]);
	}
	public function order_listm($param=array(),$page_num=20,$uid=null){
		
		$query=[];
		
		if(isset($param['order_num'])){
			$map['Order.order_num_alias']=['eq',$param['order_num']];	
			$query['order_num']=urlencode($param['order_num']);
		}
		if(isset($param['username'])){
			$map['Member.username']=['like',"%".$param['username']."%"];
			$query['username']=urlencode($param['username']);
		}
		if(isset($param['status'])){
			$map['Order.order_status_id']=['eq',$param['status']];	
			$query['status']=urlencode($param['status']);
		}
		
		if($uid){
			$map['Member.uid']=['eq',$uid];	
		}
		
		$map['Order.order_id']=['gt',0];
		
		$uid = UID;
		$a = Db::name('merchants')->where('dtuid',$uid)->find();
		//print_r($a);
		$map['merchant_id'] =  $a['merchant_id'];
		
		return Db::view('Order','*')
		->view('Member','username,reg_type,nickname','Order.uid=Member.uid')
		->view('OrderStatus','order_status_id,name','Order.order_status_id=OrderStatus.order_status_id')
		->where($map)
		->order('Order.order_id desc')
		->paginate($page_num,false,['query'=>$query]);
	}
		
	
	/**
	 * 写人订单
	 * @param $payment_code 支付方式
	 * @param $order_data 订单数据
	 * return array
	 */
	public function add_order($payment_code,$order_data=array()) {	
		
		$data=$this->get_order_data($order_data);
		//print_r($data);
		$order['uid']=$data['uid'];			
		$order['order_num_alias']=$data['order_num_alias'];
		$order['name']=$data['name'];
		
		$order['email']=$data['email'];
		$order['tel']=$data['tel'];
		
		$order['shipping_name']=$data['shipping_name'];		
		
		$order['shipping_city_id']=$data['shipping_city_id'];		
		$order['shipping_country_id']=$data['shipping_country_id'];
		$order['shipping_province_id']=$data['shipping_province_id'];
		$order['shipping_tel']=$data['shipping_tel'];	
		$order['shipping_method']=$data['shipping_method'];
		$order['address_id']=$data['address_id'];
		$order['merchant_id']=$data['merchant_id'];
		
		$order['comment']=$data['comment'];		
		
		if(isset($data['pay_type'])&&$data['pay_type']=='points'){//积分兑换订单
			$order['order_status_id']=config('paid_order_status_id');
			$order['points_order']=1;
			$order['pay_points']=$data['total'];
			$data['total']=0;
			$order['pay_time']=time();
		}else{
			$order['order_status_id']=config('default_order_status_id');
		}
		
		$order['ip']=get_client_ip();
		
		$order['date_added'] =time();
		$order['total'] =$data['total'];
		$order['user_agent']=$data['user_agent'];
		//$fi='log.txt';
	
		//$sj = date('Y-m-d H:i:s').'    |'.$out_trade_no;
		
		//file_put_contents($fi,$order['user_agent'],FILE_APPEND);
		
		$order['payment_code']=$payment_code;
		
		
		$order['pay_subject']=isset($data['pay_subject'])?$data['pay_subject']:'';
		$order['return_points']=isset($data['return_points'])?$data['return_points']:'';
		
		 $order_id=Db::name('Order')->insert($order,false,true);	//c错误根源
	//	$order_id=Db::name('Order')->insert($order);
	//	print_r($order_id);

		if(isset($data['goodss'])){
			foreach ($data['goodss'] as $goods) {
				
				$goods_id=$goods['goods_id'];			
				
				$order_goods_id=Db::name('order_goods')->insert(array(
					'order_id'=>$order_id,					
					'goods_id'=>$goods_id,
					'name'=>$goods['name'],
					'model'=>$goods['model'],
					'quantity'=>(int)$goods['quantity'],
					'price'=>(float)$goods['price'],
					'total'=>(float)$goods['total']					
				),false,true);
				
				foreach ($goods['option'] as $option) {
					Db::execute("INSERT INTO ".config('database.prefix')."order_option SET order_id = '" .$order_id
					."',order_goods_id='".$order_goods_id."'"
					.",goods_id='".(int)$option['goods_id']."'"
					.",option_id='".(int)$option['option_id']."'"
					.",option_value_id='".(int)$option['option_value_id']."'"
					.",name='".$option['name']."'"
					.",value='".$option['value']."'"
					.",type='".$option['type']."'"
					);				
				}				
				//支付成功后扣除库存
			
			}
		}		
	
		if(isset($data['totals'])){
			foreach ($data['totals'] as $total) {
				Db::execute("INSERT INTO ".config('database.prefix')."order_total SET order_id = '" .$order_id				
				."',code='".$total['code']."'"
				.",title='".$total['title']."'"
				.",text='".$total['text']."'"
				.",value='".(float)$total['value']."'");
			}	
		}
		
		$oh['order_id']=$order_id;
		
		if(isset($data['pay_type'])&&$data['pay_type']=='points'){
			$oh['order_status_id']=config('paid_order_status_id');
		}else{
			$oh['order_status_id']=config('default_order_status_id');
		}				
		
		$oh['comment']=$data['comment'];
		$oh['date_added']=time();
		$oh_id=Db::name('OrderHistory')->insert($oh);
		

		return [
			'order_id'=>$order_id,
			'subject'=>$order['pay_subject'],			
			'name'=>$order['shipping_name'],//收货人姓名
			'pay_order_no'=>$order['order_num_alias'],
			'pay_total'=>$order['total'],
			'uid'=>$order['uid']
		];
		
	}
	
	private function get_order_data($param=array()){
			
		if(empty($param)){
			$shipping_address_id=(int)session('shipping_address_id');//送货地址
			$shipping_method=session('shipping_method');//送货方式
			$payment_method=session('payment_method');//支付方式
			$weight=(float)session('weight');//重量
			$shipping_city_id=(int)session('shipping_city_id');//配送的城市，到市级地址
			$comment=session('comment');//留言
			$uid=(int)member('uid');
		}else{
			$shipping_address_id=(int)$param['shipping_address_id'];
			$shipping_method=$param['shipping_method'];
			$payment_method=$param['payment_method'];
			$weight=(float)$param['weight'];
			$shipping_city_id=(int)$param['shipping_city_id'];
			$comment=$param['comment'];
			$uid=(int)$param['uid'];
		}	
		
		if(isset($param['type'])){
			$type=$param['type'];
			$data['pay_type']=$param['type'];
		}else{
			$type='money';
		}
		
		$goodss = osc_cart()->get_all_goods($uid,$type);
		//付款人
		$payment=Db::name('member')->find($uid);
		//收货人 
		$shipping=Db::name('address')->find($shipping_address_id);
		
		$data['uid']=$payment['uid'];
		$data['name']=$payment['username'];
		$data['email']=$payment['email'];
		$data['tel']=$payment['telephone'];		
		
		//此处为了支持免配送商品
		$data['shipping_name']=empty($shipping['name'])?'':$shipping['name'];	
		$data['shipping_tel']=empty($shipping['telephone'])?'':$shipping['telephone'];	
		$data['shipping_province_id']=empty($shipping['province_id'])?'':$shipping['province_id'];	
		$data['shipping_city_id']=empty($shipping['city_id'])?'':$shipping['city_id'];
		$data['shipping_country_id']=empty($shipping['country_id'])?'':$shipping['country_id'];			
		$data['address_id']=empty($shipping_address_id)?'':$shipping_address_id;		
		$data['shipping_method']=empty($shipping_method)?'':$shipping_method;		
		
		$data['payment_method']=$payment_method;

		$data['user_agent']=$_SERVER['HTTP_USER_AGENT'];
		$data['date_added']=time();		

		$data['comment']=empty($comment)?'':$comment;
				
		$subject='';

		if($goodss){				
				//运费				
				$transport_fee=osc_transport()->calc_transport($shipping_method,$weight,$shipping_city_id);					
				
				$t=0;		
				$pay_points=0;
				$return_points=0;
				foreach ($goodss as $goods) {
					
					$option_data = array();
	
					foreach ($goods['option'] as $option) {
						
						$value = $option['value'];						
	
						$option_data[] = array(
							'goods_id'	  			  => $goods['goods_id'],						
							'option_id'               => $option['option_id'],
							'option_value_id'         => $option['option_value_id'],								   
							'name'                    => $option['name'],
							'value'                   => $value,
							'type'                    => $option['type']
						);					
					}
					
					$t+=$goods['total'];					
					$pay_points+=$goods['total_pay_points'];					
					$return_points+=$goods['total_return_points'];
					
					$goods_data[] = array(
						'goods_id'   => $goods['goods_id'],
						'name'       => $goods['name'],
						'model'      => $goods['model'],		
						'option'     => $option_data,						
						'quantity'   => $goods['quantity'],
						'subtract'   => $goods['subtract'],
						'price'      => $goods['price'],
						'total'      => $goods['total']				
					);								
						
				}
				if(count($goodss)>1){
					$subject=$goodss[0]['name'].'等商品';
				}else{
					$subject=$goodss[0]['name'];
				}	
				$data['pay_subject']=$subject;
				
				if($type=='points'){//积分兑换的
					$data['total']=$pay_points;
				
					$data['totals'][0]=array(
					'code'=>'sub_total',
					'title'=>'商品价格',
					'text'=>'￥ 0',
					'value'=>0				
					);
					$data['totals'][1]=array(
						'code'=>'shipping',
						'title'=>'运费',
						'text'=>'￥ 0',
						'value'=>0				
					);				
					$data['totals'][2]=array(
						'code'=>'total',
						'title'=>'总价',
						'text'=>'￥ 0',
						'value'=>0				
					);
				
				}elseif($type=='money'){//在线支付的
					$data['total']=($t+$transport_fee['price']);					
					$data['return_points']=$return_points;//可得积分					
					$data['totals'][0]=array(
					'code'=>'sub_total',
					'title'=>'商品价格',
					'text'=>'￥'.$t,
					'value'=>$t				
					);
					$data['totals'][1]=array(
						'code'=>'shipping',
						'title'=>'运费',
						'text'=>'￥'.$transport_fee['price'],
						'value'=>$transport_fee['price']				
					);				
					$data['totals'][2]=array(
						'code'=>'total',
						'title'=>'总价',
						'text'=>'￥'.($t+$transport_fee['price']),
						'value'=>($t+$transport_fee['price'])				
					);
					
				}				
				
				$data['goodss'] = $goods_data;
				$data['order_num_alias']=build_order_no();
				
				$a = Db::name('goods')->where('name',$subject)->find();
				
				//echo $a['merchantNo'];
				$data['merchant_id'] =  $a['merchantNo'];
					
			return $data;
		}
	}

	//更新订单，订单历史，积分，商品数量
	public function update_order($order_id){
		
		$order_info=Db::name('order')->where('order_id',$order_id)->find();
		$fi='log.txt';
		//$s = '.  ';
		//file_put_contents($fi,$order_info,FILE_APPEND);
		$order['order_id']=$order_id;
		$order['order_status_id']=config('paid_order_status_id');
		$order['date_modified']=time();
		$order['pay_time']=time();
		Db::name('order')->update($order);
		
		$order_history['order_id']=$order_id;
		$order_history['order_status_id']=config('paid_order_status_id');
		$order_history['comment']='买家已付款';
		$order_history['date_added']=time();
		$order_history['notify']=1;
		
		Db::name('order_history')->insert($order_history);
		$goods = Db::name('order_goods')->where('order_id',$order_id)->find();
		$quantity = $goods['quantity'];
		$goods_id = $goods['goods_id'];
		//file_put_contents($fi,$quantity,FILE_APPEND);
		$catgory = Db::name('goods_to_category')->where('goods_id',$goods_id)->find(); 
		$catgory_id = $catgory['category_id'];
		
	//如果购买的是优惠券，则添加优惠券信息
		if($catgory_id == '33'){
			$merchant = Db::name('goods')->where('goods_id',$goods_id )->find();
			$coupon['merchantNo'] = $merchant['merchantNo'];
			$coupon['name'] = $merchant['name'];
			for ($i=1; $i <= $quantity; $i++) { 
			
				if($merchant['coupon_type'] == '1')
				{
					$fixed = Db::name('coupon')->where('merchantNo',$coupon['merchantNo'])->where('goods_id',$merchant['goods_id'])->where('creation','0')->column('couponcode');
					//print_r($fixed);
					//exit;
					$fi='log.txt';
					//$s = '.  ';
					file_put_contents($fi,$fixed,FILE_APPEND);
					$coupon['coupon_code'] = $fixed[0];
					$coupon['uid'] = $order_info['uid'];
					$coupon['order_id'] = $order_id;
					$coupon['write_off'] = '0';
					$coupon['creation'] = '1';
					$coupon['creation_date'] = date('YmdHis');
					Db::name('coupon')->where('couponcode',$fixed[0])
							->update(['creation_date' => $coupon['creation_date'],'uid'=>$coupon['uid'],'creation'=>'1']);
				}else{

					
					$hm = microtime();
					$sj = rand(1000,9999);
					$hm = (substr($hm,0,5)*10000);
					$coupon_code = 'WDBG'.$hm.$sj.$i;
					
					$coupon['coupon_code'] = $coupon_code ;
					$coupon['uid'] = $order_info['uid'];
					$coupon['order_id'] = $order_id;
					$coupon['write_off'] = '0';
					$coupon['creation'] = '1';
					$coupon['creation_date'] = date('YmdHis');
				}
			
			Db::name('order_coupon')->insert($coupon);
		}
		}
		
		//更新积分
		if(!empty($order_info['return_points'])){			
			Db::name('points')->insert(
				[
					'uid'=>$order_info['uid'],
					'order_id'=>$order_info['order_id'],
					'order_num_alias'=>$order_info['order_num_alias'],
					'points'=>$order_info['return_points'],
					'description'=>'下单积分',
					'prefix'=>1,
					'creat_time'=>time(),
					'type'=>1
				]
			);
			Db::name('member')->where('uid',$order_info['uid'])->setInc('points',$order_info['return_points']);				
		}
		
	
		$member=Db::name('member')->where('uid',$order_info['uid'])->find();
		//获取利润
		$merchant = Db::name('goods')->where('goods_id',$goods_id )->find();
		$profit = $merchant ['profit'];
	
		//存在上级代理商,本系统代理商只做一级分红
		if($member['is_agent']!=0){
			
			$agent_info=Db::name('agent')->where('uid',$member['pid'])->find();
			$usagent_info=Db::name('agent')->where('uid',$order_info['uid'])->find();
			//file_put_contents($fi,$usagent_info,FILE_APPEND);	
			//代理商是状态是开启的
			if($usagent_info['status']==1){
				//本人50%利润
				Db::name('agent')->where('agent_id',$usagent_info['agent_id'])->setInc('total_bonus',$profit*0.5);
				Db::name('agent')->where('agent_id',$usagent_info['agent_id'])->setInc('no_cash',$profit*0.5);	
				//分润1
				$profit1 = $profit*0.5;

				//$profit1为总利润
				Db::name('member')->where('uid',$member['uid'])->setInc('total_bonus',$profit1);

				//存储到agent_bonus库中
				$bonus['uid']=$member['uid'];
				$bonus['agent_id']=$usagent_info['agent_id'];
				$bonus['order_id']=$order_info['order_id'];
				$bonus['order_num_alias']=$order_info['order_num_alias'];
				$bonus['buyer_id']=$order_info['uid'];
				$bonus['bonus']=$profit1;
				$bonus['return_percent']=$agent_info['return_percent'];
				$bonus['order_total']=$order_info['total'];
				$bonus['pay_time']=$order['pay_time'];
				
				$bonus['create_time']=date('Y-m-d',time());
				$bonus['month_time']=date('m',time());
				$bonus['year_time']=date('Y',time());
				$bonus['order_status_id']=config('paid_order_status_id');
				
				Db::name('agent_bonus')->insert($bonus);


				//存在上层代理
				if ($member['pid']!=0 ) {
				//上层35%
				Db::name('agent')->where('agent_id',$agent_info['agent_id'])->setInc('total_bonus',$profit*0.35);	
				Db::name('agent')->where('agent_id',$agent_info['agent_id'])->setInc('no_cash',$profit*0.35);
				$profit2 = $profit*0.35;
				//$profit2为总利润
				Db::name('member')->where('uid',$member['pid'])->setInc('total_bonus',$profit2);

				//存储到agent_bonus库中
				$bonus['uid']=$member['pid'];
				$bonus['agent_id']=$agent_info['agent_id'];
				$bonus['order_id']=$order_info['order_id'];
				$bonus['order_num_alias']=$order_info['order_num_alias'];
				$bonus['buyer_id']=$order_info['uid'];
				$bonus['bonus']=$profit2;
				$bonus['return_percent']=$agent_info['return_percent'];
				$bonus['order_total']=$order_info['total'];
				$bonus['pay_time']=$order['pay_time'];
				
				$bonus['create_time']=date('Y-m-d',time());
				$bonus['month_time']=date('m',time());
				$bonus['year_time']=date('Y',time());
				$bonus['order_status_id']=config('paid_order_status_id');
				
				Db::name('agent_bonus')->insert($bonus);


					//获取上层代理的用户id
					$topmember = Db::name('member')->where('uid',$member['pid'])->find();

					//存在顶层代理
					if ($topmember['pid']!=0) {
						//file_put_contents($fi,$topmember,FILE_APPEND);
						$topagent_info=Db::name('agent')->where('uid',$topmember['pid'])->find();
						Db::name('agent')->where('agent_id',$topagent_info['agent_id'])->setInc('total_bonus',$profit*0.15);	
						Db::name('agent')->where('agent_id',$topagent_info['agent_id'])->setInc('no_cash',$profit*0.15);
						$profit3 = $profit*0.15;
						Db::name('member')->where('uid',$topmember['pid'])->setInc('total_bonus',$profit3);
						$bonus['uid']=$topmember['pid'];
						$bonus['agent_id']=$topagent_info['agent_id'];
						$bonus['order_id']=$order_info['order_id'];
						$bonus['order_num_alias']=$order_info['order_num_alias'];
						$bonus['buyer_id']=$order_info['uid'];
						$bonus['bonus']=$profit3;
						$bonus['return_percent']=$agent_info['return_percent'];
						$bonus['order_total']=$order_info['total'];
						$bonus['pay_time']=$order['pay_time'];
						
						$bonus['create_time']=date('Y-m-d',time());
						$bonus['month_time']=date('m',time());
						$bonus['year_time']=date('Y',time());
						$bonus['order_status_id']=config('paid_order_status_id');
						
						Db::name('agent_bonus')->insert($bonus);
					}
				}



					
				

				
				
			}
			
		}
		
		$list=Db::name('goods')
			->alias('g')				
			->join('__ORDER_GOODS__ og','g.goods_id = og.goods_id','left')
			->join('__ORDER_OPTION__ oo','og.order_goods_id = oo.order_goods_id','left')			
			->field('oo.*,g.*,og.quantity as goods_quantity')
			->where('og.order_id',$order_id)	
			->select();
		
		//更新商品数量
		foreach ($list as $k => $v) {
			//存在选项
			if($v['order_option_id']){
				if($v['subtract']){//需要扣减库存
				
					$map['goods_id']=['eq',$v['goods_id']];
					$map['option_id']=['eq',$v['option_id']];
					$map['option_value_id']=['eq',$v['option_value_id']];
					
					Db::name('goods_option_value')->where($map)->setDec('quantity',$v['goods_quantity']);			
					Db::name('goods')->where('goods_id',$v['goods_id'])->setDec('quantity',$v['goods_quantity']);
				}
			//不存在选项	
			}else{
				//需要扣减库存
				if($v['subtract']) 	
				Db::name('goods')->where('goods_id',$v['goods_id'])->setDec('quantity',$v['goods_quantity']);
			}
		}
		storage_user_action($order_info['uid'],$order_info['name'],config('FRONTEND_USER'),'成功支付了订单');
		
	} 
	//清空购物车，用于电脑端
	public function clear_cart($uid){
		Db::name('cart')->where('uid',$uid)->delete();
		session('weight',null);
		session('shipping_address_id',null);
		session('shipping_city_id',null);
		session('shipping_name',null);
		session('shipping_method',null);
		session('comment',null);
		session('payment_method',null);	
		session('total',null);	
	}
	//会员中心点击立即支付，验证商品数量
	public function check_goods_quantity($order_id){
		$goods_list=Db::view('OrderGoods','name,quantity as order_quantity')
		->view('Goods','quantity as goods_quantity','Goods.goods_id=OrderGoods.goods_id')	
		->where('order_id',$order_id)->select();
		
		foreach ($goods_list as $k => $v) {
			if($v['order_quantity']>$v['goods_quantity']){
				return ['error'=>$v['name'].',数量不足，剩余'.$v['goods_quantity']];
			}
		}
		
	}
}

?>