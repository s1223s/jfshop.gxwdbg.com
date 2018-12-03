<?php

namespace osc\admin\model;
use think\Db;
class Discount{
	
	public function add_discount($data)
	{
		$discount['goods_id'] = $data['goods_id'];
		$discount['discount_price'] = $data['discount_price'];
		$discount['discount_on_time'] = $data['discount_on_time'];
		$discount['discount_off_time'] = $data['discount_off_time'];
		$discount['quantity'] = $data['quantity'];

		$discount_id=@Db::name('goods_discountms')->insert($discount);
		if($discount_id){
			return $discount_id;
		}else{
			return 'cuowu ';
		}
	}
	public function del_discount($data)
	{
		try{

			Db::name('goods_discountms')->where('discount_id',$data)->delete();
			
			return true;	
		}catch(Exception $e){
			return false;
		}
	}
}