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
namespace osc\common\controller;
use think\Db;
class AdminBase extends Base{	
	
	protected $user;
	
	protected function _initialize() {
		parent::_initialize();

		define('UID',osc_service('admin','user')->is_login());

        if(!UID){  
			$this->redirect('admin/Login/login');
        }		
		//统一 AdminBase 跳转模板
		config('dispatch_error_tmpl',APP_PATH.'common/view/public/error.tpl');
		config('dispatch_success_tmpl',APP_PATH.'common/view/public/success.tpl');
		
		$this->get_menu();
		
        //权限判断  
        if(session('user_auth.username')!=config('administrator')&&session('user_auth.username')!='gxm001'){//超级管理员不需要验证        
	       // echo session('user_auth.username');
			$auth = new \auth\Auth();
			
			if (!$auth->check(request()->module().'/'.to_under_score(request()->controller()).'/'.request()->action(), session('user_auth.uid'))) {
								
				$this->error('没有权限！');
			}
		}
	
	
	}

	public function get_menu(){

		if(session('user_auth.username')!=config('administrator')){
			$this->assign('admin_menu',$this->get_auth_menu());
		}else{
			$this->assign('admin_menu',$this->get_admin_menu());
		}

	}

	public function get_admin_menu(){

		$menu=Db::query('select * from '.config('database.prefix')."menu  where type='nav' and status=1 order by sort_order");

		$parent_menu=list_to_tree($menu,'id','pid','children',0);

		return $parent_menu;
	}

	public function get_auth_menu(){

		$menu=Db::query('select m.* from '.config('database.prefix').'auth_rule ar,'.config('database.prefix')."menu m where m.id=ar.menu_id and m.type='nav' and m.status=1 and ar.group_id=".session('user_auth.group_id').' order by m.sort_order');

		$parent_menu=list_to_tree($menu,'id','pid','children',0);

		return $parent_menu;
	}
	
	//用于单表插入操作
	public function single_table_insert($table_name,$user_action){
				
			$data=input('post.');			
			$result = $this->validate($data,$table_name);			
			if($result!==true){
				return ['error'=>$result];
			}			
			$id=Db::name($table_name)->insert($data,false,true);			
			if($id){								
				storage_user_action(UID,session('user_auth.username'),config('BACKEND_USER'),$user_action);						
				return ['success'=>'新增成功','action'=>'add'];				
			}else{			
				return ['error'=>'新增失败'];
			}
		
	}
	//用于单表更新操作
	public function single_table_update($table_name,$user_action){
				
			$data=input('post.');			
			$result = $this->validate($data,$table_name);			
			if($result!==true){
				return ['error'=>$result];
			}			
			$r=Db::name($table_name)->update($data,false,true);			
			if($r){				
				storage_user_action(UID,session('user_auth.username'),config('BACKEND_USER'),$user_action);							
				return ['success'=>'更新成功','action'=>'edit'];
			}else{			
				return ['error'=>'更新失败'];
			}
		
	}
	//用于单表删除操作
	public function single_table_delete($table_name,$user_action){
		
		$r=Db::name($table_name)->delete((int)input('id'));	
		
		if($r){				
			storage_user_action(UID,session('user_auth.username'),config('BACKEND_USER'),$user_action);							
			return ['success'=>'删除成功','action'=>'delete'];
		}
		
	}
	//用于市民卡的信息查询
	public function socket($Sendmessage){
	$port = 9003;   //端口号
 	$ip = "219.159.71.141";	//服务器地址
 	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);   //在指定端口打开监听
 	if ($socket < 0) {  
        echo "socket创建失败原因: " . socket_strerror($socket) . "\n";  //修改写在日志中
	} else {  
        echo "";  
    }
    $con=socket_connect($socket,$ip,$port); 		//开始连接
    if ($con < 0) {  
        echo "SOCKET连接失败原因: ($result) " . socket_strerror($result) . "\n";   //修改写在日志中
	} else {  
        echo "";  //修改写在日志中
	}   
	 if(!socket_write($socket, $Sendmessage, strlen($Sendmessage))) {     //写数据到socket缓存
     echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
 		}else {
     //错误写在日志中
 	} 
	$out = socket_read($socket, 8192);
 	return bin2hex($out);
	
 	socket_close($socket);
 
	}	
	
}
