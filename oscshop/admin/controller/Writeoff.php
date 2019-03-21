<?php

 
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use think\Db;
class Writeoff extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
		$this->assign('breadcrumb1','商家管理');
				
	}
	
	public function index(){
		
		
		$uid = UID;
		//$where1['dtuid'] = $uid;
		$a = Db::name('merchants')->where('dtuid',$uid)->find();
		//print_r($a);
		$where['merchantNo'] =  $a['merchant_id'];
		
		$where['write_off'] = '1';
		$coupon = Db::name('order_coupon')
					->where($where)
					->paginate(10);
		
		$this->assign('coupon',$coupon);
		$this->assign('breadcrumb2','商家核销');
		return $this->fetch('index');
	}
	

	public function certificate(){
		//echo '1';
		$code = $_POST['code'];
		$where['coupon_code'] = $code;
		$where['write_off'] = '0';
		$coupon = Db::name('order_coupon')
					->where($where)
					->find();
		if($coupon)
		{
			$date =date('YmdHis'); 
			$coupon = Db::name('order_coupon')
					->where($where)
					->update(['write_off'=>1,'write_off_time'=>$date]);
			return'核销成功';
		}else{
		return '核销失败';
		}
		
		
		
		//return $code;
	}
		
	public function get_config_by_module($module){
		
		$list=Db::name('config')->where('module',$module)->select();
		if(isset($list)){
			foreach ($list as $k => $v) {
				$config[$v['name']]=$v;
			}
		}
		return $config;
	}
	
	public function add(){
		
		if(request()->isPost()){
			
			$data=input('post.');		
			$data['pid']=$data['id'];
			unset($data['id']);			
			
			$result = $this->validate($data,'Menu');
			
			if($result!==true){
				return ['error'=>$result];
			}
			$id=Db::name('Menu')->insert($data,false,true);
			if($id){
				
				storage_user_action(UID,session('user_auth.username'),config('BACKEND_USER'),'添加了后台菜单，'.$data['title']);	
											
				return ['status'=>'success','id'=>$id,'name'=>$data['title']];
			}else{
				return ['error'=>'新增失败'];
			}
			
		}
	}
	
	
	
	public function writeoff(){
		return $this->fetch();
	}

	public function partnerwrite(){
		$data = input('post.');
		//print_r($data);
				$fi='log.txt';
		$post = file_get_contents("php://input");
		$sj = date('Y-m-d H:i:s');
		
		file_put_contents($fi,$data,FILE_APPEND);
		file_put_contents($fi,$post,FILE_APPEND);
	}


}
