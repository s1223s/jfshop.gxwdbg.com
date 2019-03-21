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

//主要用于处理模版的模块加载  保证之后的每个页面都回家再模块
namespace osc\common\controller;
use think\Controller;
class Base extends controller{
	
	protected function _initialize() {		
		
		//检测是否完成安装（安装了会有install 文件），如果没有安装册进去install页面
		if (!is_file(APP_PATH.'database.php')) {
			header('Location:'.request()->domain().'/install');
			die();
		}				
		//获取当前的模块名
		$module=request()->module();
	
		//检查模块是否已经安装
		if(!is_module_install($module)){
			die('该模块未安装');
		}
		
		//获取配置信息
		$config =   cache('db_config_data');
		//print_r($config);

		//如果cache读取不到则用load_config函数从数据库中倒入
        if(!$config){        	
            $config =   load_config();					
            cache('db_config_data',$config);
        }
		
        config($config); 
	}
	
}
