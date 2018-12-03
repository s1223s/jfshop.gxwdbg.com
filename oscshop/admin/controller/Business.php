<?php

 
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use think\Db;
class Business extends AdminBase
{
	protected function _initialize(){
		parent::_initialize();
		$this->assign('breadcrumb1','商家');
				
	}
	
	function index(){
		
		$this->assign('breadcrumb2','商家管理');
		$this->assign('common',$this->get_config_by_module('common'));
		return $this->fetch();
	}
	
		
	function get_config_by_module($module){
		
		$list=Db::name('config')->where('module',$module)->select();
		if(isset($list)){
			foreach ($list as $k => $v) {
				$config[$v['name']]=$v;
			}
		}
		return $config;
	}
	
	public function create_group(){		

//		if(request()->isPost()){			  
//			return $this->single_table_insert('AuthGroup','添加了用户组');
//		}
		
		$this->assign('breadcrumb2','新增');
		$this->assign('action',url('business/create_group'));
		return $this->fetch('edit_group');
		
	}
	
	
	
	function writeoff(){
		return $this->fetch();
	}
	function add(){
		
		$data=input('post.');//数组的形式获取post的所有数据

		$model = osc_model('admin','business');

		$error=$model->validate($data);	 //调用控制器的模型验证函数
	
			if($error){					
				$this->error($error['error']);	//如果验证的时候有未达到要求的返回错误
			}
			
			$return=$model->add_merchants($data);	//通过验证后调用模块写入数据库
		
	}

}
