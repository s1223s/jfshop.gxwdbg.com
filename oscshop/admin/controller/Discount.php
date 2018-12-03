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
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use think\Db;
class Discount extends AdminBase{
	protected function _initialize(){
		parent::_initialize();
		$this->assign('breadcrumb1','商品');
		$this->assign('breadcrumb2','商品折扣');
	}

	public function index(){

		//获取已激活的秒杀活动
		$discount = DB::name('goods_discountms')->where('valid',1)->select();
		//print_r($discount);
		return $this->fetch();
	}

	//新增折扣
	public function add(){
	 	//获取已激活的秒杀活动
	 	$discountms = DB::name('goods_discountms')->where('valid',1)->select();
	 	// print_r($discountms[0]);
		$discount = array();
		for ($i=0; $i < count($discountms); $i++) { 
			$a = Db::name('goods')->where('goods_id',$discountms[$i]['goods_id'])->select();
			// print_r($a);
			$a = array_merge($a,$discountms[$i]);
			// print_r($a);
			$a['discount_on_time'] = date('Y-m-d H:i:s',$a['discount_on_time']);
			$a['discount_off_time'] = date('Y-m-d H:i:s',$a['discount_off_time']);
			$discount[$i] = $a;
		}


		if(request()->isPost()){
			
			$data=input('post.');
			//print_r($data);
			if($data['goods_id']&&$data['discount_price']&&$data['discount_on_time']&&$data['discount_off_time']&&$data['quantity']) {
				if(strtotime($data['discount_on_time']) > strtotime($data['discount_off_time'])){
					echo "结束时间早于开始时间";
				}else{
					$data['discount_on_time'] = strtotime($data['discount_on_time']);
					$data['discount_off_time'] = strtotime($data['discount_off_time']);
					$model=osc_model('admin','discount');
					$discount_id = $model->add_discount($data);
					print_r($discount_id);
					return ['success'=>'添加成功！'];
				 	
				}
			}else{
				//echo "条件不足";
				return ['error'=>'添加失败！'];
;
			}
		}
		//$a = Db::name('Merchants')->select();
		//print_r($discount);
		$this->assign('discount',$discount);
		$this->assign('merchants',Db::name('Merchants')->select());
	 	return $this->fetch('edit');
	}


	public function goodschs(){
	 	
	 	$merchantid = input('post.');
	 	$value = Db::name('Goods')->where('merchantNo',$merchantid['merchantNo'])->select();
				 	$this->assign('goods',$value);
				 	return $value;

	 	//print_r($value[]);
	 		// echo 1;
	 		// exit();

	 }
	
	public function active(){

	 	$this->assign('crumbs', '折扣活动');	
	 	return $this->fetch('activeList');
	 }

	 function del(){
	 	$model=osc_model('admin','discount'); 
			
		$r=$model->del_discount((int)input('param.discount_id'));	
		
		if($r){
			
			//storage_user_action(UID,session('user_auth.username'),config('BACKEND_USER'),'删除商品'.input('get.id'));
			
			$this->redirect('Discount/add');
			
		}else{
			
			return $this->error('删除失败！',url('Discount/add'));
		}
	 }
	

}
?>