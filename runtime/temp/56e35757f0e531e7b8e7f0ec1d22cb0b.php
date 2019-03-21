<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"./oscshop/admin/view/business/edit_group.html";i:1525251002;s:37:"./oscshop/admin/view/public/base.html";i:1512008342;}*/ ?>
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
		<?php echo $breadcrumb1; ?>
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			<?php echo $breadcrumb2; ?>
		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xs-12">	
		<div class="form-horizontal">
			
			<?php if(\think\Request::instance()->param('id')): ?>
			<input name="id" type="hidden" value="<?php echo \think\Request::instance()->param('id'); ?>" />
			<?php endif; ?>			
					
			<div class="container">
		<div class="logo">
			<img src="images/logo.jpg" alt="">
		</div>
			<form action="<?php echo url('business/add'); ?>" method="post" enctype="multipart/form-data" id="form-goods" class="form-horizontal">
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
				<h2><span>店铺基本信息</span></h2>
				<table width="100%" border="0" class="query">
					<tbody>
						<tr>
							<td class="text-right">店铺编码:</td>
							<td class="text-left">
								<input type="text" class="form-control" id="disabledInput"  disabled>
							</td>

							<td class="text-right">
								<span class="blue">*</span>
								店铺账号：
							</td>
							<td  class="text-left"><input type="text" id="shopAccout" name="shopAccount" maxlength="64" ></td>
							
							<td class="text-right">
								<span class="blue">*</span>
								店铺名称：
							</td>
							<td  class="text-left"><input type="text" id="shopName" name="shopName" maxlength="25"></td>

						</tr>

						<tr>
							<td height="10"></td>
						</tr>

						<tr>
							
							

							<td class="text-right">
								<span class="blue">*</span>
								电商企业名称：
							</td>
							<td  class="text-left"><input type="text" id="enterpriseName" name="enterpriseName" maxlength="25"></td>

							<td class="text-right">
								<span class="blue">*</span>
								联系人：
							</td>
							<td  class="text-left"><input type="text" id="linkPerson" name="linkPerson" maxlength="25"></td>

							<td class="text-right">
								<span class="blue">*</span>
								联系电话：
							</td>
							<td  class="text-left"><input type="text" id="" name="linkMobilephone" maxlength="15"></td>
						</tr>
						
						<tr>
							<td height="10"></td>
						</tr>

						<tr>
							<td height="10"></td>
						</tr>

						<tr>
							<td class="text-right">
								固定电话：
							</td>
							<td  class="text-left"><input type="text" id="linkFixphone" name="linkFixphone" maxlength="15"></td>

							<td class="text-right">
								传真电话：
							</td>
							<td  class="text-left"><input type="text" id="fax"  name="fax" maxlength="15"></td>

							<td class="text-right">
								电子邮箱：
							</td>
							<td  class="text-left"><input type="text" maxlength="32" id="eamil" name="email"></td>
						</tr>

						<tr>
							<td height="10"></td>
						</tr>

						<tr>
							<td class="text-right">
								<span class="blue">*</span>
								通信地址：
							</td>
							<td  class="text-left"><input type="text" id="mailingAddress" name="mailingAddress" maxlength="64"></td>
						</tr>

						<tr>
							<td height="10"></td>
						</tr>
							
					</tbody>
				</table>


				<h2><span>店铺资质</span></h2>
				<table width="100%" border="0" class="query">
					<tbody>
						<tr>
							<td class="text-right">
								<span class="blue">*</span>
								企业法人代表：
							</td>
							<td  class="text-left"><input type="text" id="legalPerson" name="legalPerson" max></td>

							<td class="text-right">
								<span class="blue">*</span>
								营业执照号：
							</td>
							<td  class="text-left"><input type="text" id="licenceCode" name="licenceCode"></td>
							<td class="text-right">
								法人代表身份证：
							</td>
							<td  class="text-left"><input type="text" id="" name="legalCard"></td>
							
						</tr>
						<tr>
							<td height="10"></td>
						</tr>	

						
					</tbody>
				</table>
		
	</div>
			
			
			<div class="form-group">
				<label class="col-sm-1 control-label no-padding-left"> </label>	
				<div class="col-sm-11">
					<input id="send" name="send" type="submit" value="提交" class="btn btn-primary" />
				</div>
			</div>
		</form>
		</div>
	</div>
</div>

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

var back_index="<?php echo url('AuthBackend/index'); ?>";

$('#send').click(function(){
	$.post(
		'<?php echo $action; ?>',
		$('.form-horizontal input[type=\'text\'],.form-horizontal input[type=\'hidden\']'),
		function(d){
			art_dialog(d,back_index);
		}
	);
});
</script>							

	</body>
</html>
