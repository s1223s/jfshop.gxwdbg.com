<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./oscshop/member\view\member_backend\info.html";i:1512008342;s:37:"./oscshop/admin/view/public/base.html";i:1512008342;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>

		<meta name="description" content="<?php echo \think\Config::get('SITE_NAME'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="__PUBLIC__/js/bt/bootstrap.min.css" />
		<link rel="stylesheet" href="__ADMIN__/ace/font-awesome/4.2.0/css/font-awesome.min.css" />


		<!-- ace styles -->
		<link rel="stylesheet" href="__ADMIN__/ace/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="__ADMIN__/ace/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="__ADMIN__/ace/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="__ADMIN__/ace/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="__ADMIN__/ace/js/html5shiv.min.js"></script>
		<script src="__ADMIN__/ace/js/respond.min.js"></script>
		<![endif]-->
		<style>
			.table thead > tr > td, .table tbody > tr > td {
			    vertical-align: middle;
			}	
			.table thead td span[data-toggle="tooltip"]:after, label.control-label span:after {
				font-family: FontAwesome;
				color: #1E91CF;
				content: "\f059";
				margin-left: 4px;
			}
		</style>
		
		
			
		
		
		
		<script src="__PUBLIC__/js/jquery/jquery-2.0.3.min.js"></script>
		<script src="__PUBLIC__/js/jquery/jquery-migrate-1.2.1.min.js"></script>
			
		
		<script src="__PUBLIC__/artDialog/artDialog.js"></script>
		<link href="__PUBLIC__/artDialog/skins/default.css" rel="stylesheet" type="text/css" />			
		
		<script>
			var filemanager_url="<?php echo url('admin/FileManager/index'); ?>";
		</script>
		<script src="__PUBLIC__/js/oscshop_common.js"></script>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo url('admin/Index/index'); ?>" class="navbar-brand">
						<small>							
							<?php echo \think\Config::get('SITE_NAME'); ?> 后台管理
						</small>
					</a>
					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								
								<span class="user-info">
									<?php echo session('user_auth.username'); ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								
								<li>
									<a target="_blank" href="<?php echo \think\Request::instance()->root(true); ?>">网站前台</a>
								</li>
								
								<li>
									<a href="<?php echo url('admin/User/edit',array('id'=>session('user_auth.uid'))); ?>">修改密码</a>
								</li>
								
								<li><a href="<?php echo url('admin/Index/clear'); ?>">清空缓存</a></li>

								<li>
									<a href="<?php echo url('admin/Index/logout'); ?>">退出系统</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			
			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				
				<ul class="nav nav-list">
					<li class="hover">
						<a target="_blank" href="<?php echo \think\Request::instance()->root(true); ?>">
							<i class="menu-icon fa fa fa-home fa-lg"></i>
							<span class="menu-text">前台 </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
					</li>
					
					<?php if(is_array($admin_menu) || $admin_menu instanceof \think\Collection || $admin_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>					
					<li class="hover <?php if(isset($breadcrumb1) AND ($breadcrumb1 == $m["title"])): ?> active open <?php endif; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa <?php echo $m['icon']; ?>"></i>
							<span class="menu-text"> <?php echo $m['title']; ?> </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<?php if(isset($m['children'])): ?>
						<ul class="submenu">
							
							<?php if(is_array($m['children']) || $m['children'] instanceof \think\Collection || $m['children'] instanceof \think\Paginator): if( count($m['children'])==0 ) : echo "" ;else: foreach($m['children'] as $key=>$vo): ?>   
							<li class="hover">
								<a href="<?php echo \think\Request::instance()->root(true); ?>/<?php echo $vo['url']; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<?php echo $vo['title']; if(isset($vo['children'])): ?>
										<b class="arrow fa fa-angle-down"></b>
									<?php endif; ?>
								</a>

								<b class="arrow"></b>
								
									<?php if(isset($vo['children'])): ?>
										<ul class="submenu">
											<?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$v2): ?> 
												<li class="hover">
													<a href="<?php echo \think\Request::instance()->root(true); ?>/<?php echo $v2['url']; ?>">
														<i class="menu-icon fa fa-caret-right"></i>
														<?php echo $v2['title']; ?>
													</a>
			
													<b class="arrow"></b>
												</li> 
											<?php endforeach; endif; else: echo "" ;endif; ?> 
										</ul>	
									<?php endif; ?>
								
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							
						</ul>
						<?php endif; ?>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					
				</ul><!-- /.nav-list -->

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						
<div class="page-header">
		<h1>
			<?php echo $breadcrumb2; ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?php echo $crumbs; ?>
			</small>
		</h1>
</div>	
	<ul class="nav nav-tabs">
		
	  <li class="active"><a href="#tab-member" data-toggle="tab">会员资料</a></li>
	 
	  <li><a href="#tab-shipping" data-toggle="tab">收货地址</a></li>
	  
	</ul>

	<form class="form-horizontal" id="validation-form"  method="post" action='<?php echo url("MemberBackend/edit"); ?>'>	
	<div class="tab-content">		
		<input name="uid" type="hidden" value="<?php echo \think\Request::instance()->param('id'); ?>" />		
		<div class="tab-pane active" id="tab-member">
			<table class="table table-binfoed">
				<tr>
				    <td>ID</td>
				    <td><?php echo $data['info']['uid']; ?></td>
				</tr>
	
				<tr>
					<td>用户名</td>
					<td>
					<?php if($data['info']['reg_type'] != 'weixin'): ?>
						<?php echo $data['info']['username']; else: ?>
						<?php echo $data['info']['nickname']; endif; ?>
									
					</td>
				</tr>
				
				<?php if($data['info']['wechat_openid']): ?>
				<tr>
					<td>微信openid</td>
					<td>				
					<?php echo $data['info']['wechat_openid']; ?>					
					</td>
				</tr>
				<?php endif; ?>
				
				<tr>
					<td>密码</td>
					<td><input id="pwd" name="password" type="text" style="width:400px;" value="<?php echo think_ucenter_decrypt($data['info']['password'],config('PWD_KEY')); ?>" /></td>
				</tr>
				<tr>
				    <td>电子邮件</td>
				    <td><input name="email" type="text" style="width:400px;" value="<?php echo (isset($data['info']['email']) && ($data['info']['email'] !== '')?$data['info']['email']:''); ?>" /></td>
				    
				</tr>
				
				<tr>
				    <td>联系电话</td>
				    <td><input name="telephone" type="text" style="width:400px;" value="<?php echo (isset($data['info']['telephone']) && ($data['info']['telephone'] !== '')?$data['info']['telephone']:''); ?>" /></td>
				  
				</tr> 
					
				<tr>
					<td>用户组</td>
					<td><select class="form-control" name="groupid">							
						<?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
							<option <?php if($data['info']['groupid'] == $group['id']): ?> selected="selected"<?php endif; ?> value="<?php echo $group['id']; ?>"><?php echo $group['title']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>				
						</select>	
					</td>
				</tr>
					
				<tr>
					<td>登录IP地址</td>
					<td><?php echo $data['info']['lastip']; ?></td>
				</tr>  
				<tr>
					<td>登录次数</td>
					<td><?php echo $data['info']['loginnum']; ?></td>
				</tr>
				<tr>
					<td>创建时间</td>
					<td><?php echo date("Y-m-d",$data['info']['regdate']); ?></td>
				</tr>
				<tr>
					<td>最近登录时间</td>
					<td>
						<?php if(empty($data['info']['lastdate'])): ?>
							无
						<?php else: ?>
							<?php echo date("Y-m-d",$data['info']['lastdate']); endif; ?>
					</td>
				</tr>
				<tr>
					<td>状态</td>
					<td>	
							<label class="radio-inline">
							<input type="radio" checked="checked" value="1" name="checked">审核通过</label>
							<label class="radio-inline">
							<input type="radio" value="0" name="checked">未通过审核</label>
					</td>
				</tr>
				</table>
				<div class="form-group">
				
				<div style="margin-left:20px;">
					<input name="send" type="submit" value="提交" class="btn btn-primary" />
				</div>
			</div>
		</div>
		
		<div class="tab-pane" id="tab-shipping">
            <table class="table table-binfoed">
          <?php if(is_array($data['address']) || $data['address'] instanceof \think\Collection || $data['address'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['address'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <tr>
            <td>收货人姓名: <?php echo $vo['name']; ?></td>          
            <td>所在地:</td>
            <td>
            	<?php echo get_area_name($vo['province_id']); ?>，
            	<?php echo get_area_name($vo['city_id']); ?>，
            	<?php echo get_area_name($vo['country_id']); ?>
            </td>         
            <td>地址:</td>
            <td><?php echo $vo['address']; ?></td>        
          	<td>联系电话:</td>
          	<td><?php echo $vo['telephone']; ?></td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>  
        </table>        
      </div>	
	
	</div>
	</form>	
	

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->



			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='__ADMIN__/ace/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='__ADMIN__/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='__ADMIN__/ace/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='__ADMIN__/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="__PUBLIC__/js/bt/bootstrap.min.js"></script>

		<!-- ace scripts -->
		<script src="__ADMIN__/ace/js/ace-elements.min.js"></script>
		<script src="__ADMIN__/ace/js/ace.min.js"></script>

		

<script>
$(function(){	
	
	<?php if(\think\Request::instance()->param('id')): ?>
			Oscshop.setValue("checked", <?php echo (isset($data['info']['checked']) && ($data['info']['checked'] !== '')?$data['info']['checked']:1); ?>);		
	<?php endif; ?>
	
	$('.btn').click(function(){		
		
		if($('#pwd').val()==''){
			alert('密码必填');
			return false;
		}
		if($('#pwd').val().length<6){
			alert('密码长度必须大于等于6位！！');
			return false;
		}
	});		
});
</script>							

	</body>
</html>
