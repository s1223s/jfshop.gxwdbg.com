<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"./oscshop/admin\view\daliyreport\index.html";i:1539671277;s:37:"./oscshop/admin\view\public\base.html";i:1512008342;}*/ ?>
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
		
		
<style>
	li{
    list-style: none;
}
.list-group-item {
    position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid #ddd;
}
.tile,.title {
    background-color: #279fe0;
    border-radius: 3px;
    color: #ffffff;
    margin-bottom: 15px;
    transition: all 1s ease 0s;
}
.tile-heading,.title-heading {
    background-color: #1e91cf;
    color: #fff;
    padding: 5px 8px;
    text-transform: uppercase;
}
.tile-body ,.title-body{
    background-color: #279fe0;
    color: #ffffff;
    line-height: 48px;
    padding: 15px;
}
.tile-footer,.title-foot {
    background-color: #3da9e3;
    padding: 5px 8px;
}
.tile a ,.title a{
    color: #ffffff;
}
.day{
    margin-top: 30px;
    margin-right: -15px;
    margin-left: -15px;
}
.on{font-weight: bold;}

  label.iSwitch{
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
  border-radius: 15px;
  background: #dcdcdc;
  border:1px solid #dcdcdc;
  box-shadow: 0 0 5px #dcdcdc;
  overflow: hidden;
  vertical-align: middle;

}
label.iSwitch input{
  visibility: hidden;
}
label.iSwitch i{
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: 50%;
  height: 100%;
  border-radius: 100%;
  background: #fff;
}
label.iSwitch i::before{
  content: "";/*On*/
  display: none;
  width: 200%;
  height: 100%;
  border-radius: 25%;
  background:#1e91cf;
}
label.iSwitch i::after{
  content: "";/*Off*/
  position: absolute;
  left: 0;
  top: 0;
  z-index: 2;
  display: inline-block;
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background: #fff;
}
label.iSwitch input:checked + i{
  transform:translateX(100%);
  -webkit-transform:translateX(100%);
}
label.iSwitch input:checked + i:before{
  display: inline-block;
  transform:translateX(-50%);
  -webkit-transform:translateX(-50%);
} 

</style>		

		
		
	<script src="__PUBLIC__/js/jquery/jquery-2.0.3.min.js"></script>
	<script src="__PUBLIC__/js/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script src="__PUBLIC__/ztree/Chart.min.js"></script>
	
	
		
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
						
		<link href="__PUBLIC__/jquery-weui/dist/lib/weui.min.css" type="text/css" rel="Stylesheet" />
		<link href="__PUBLIC__/jquery-weui/dist/css/jquery-weui.min.css" type="text/css" rel="Stylesheet" />
		<script src="__PUBLIC__/jquery-weui/dist/js/jquery-weui.min.js"></script>
	
	<div class="container-fluid">
			<div class="row" id="tab">
				<div class="col-xs-12">
					<div class="row" id="tile">
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="tile">
								<div class="tile-heading">今日交易量
									<span class="pull-right"></span>
								</div>
								<div class="tile-body">
									<!--<i class="glyphicon glyphicon-credit-card"></i>-->
									<i class="fa fa-credit-card"></i>
									<h2 class="pull-right" id="sum"><?php echo $sum; ?>元</h2>
								</div>
								<div class="tile-footer">
									<a href="">显示详细...</a>
								</div>
							</div>
						</div> 
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="tile" id="title2">
								<div class="tile-heading">本周交易量
									<span class="pull-right">总1385笔</span>
								</div>
								<div class="tile-body">
									<!--<i class="glyphicon glyphicon-credit-card"></i>-->
									<i class="fa fa-credit-card"></i>
									<h2 class="pull-right">0</h2>
								</div>
								<div class="tile-footer">
									<a href="">显示详细...</a>
								</div>
							</div>
						</div>  
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="tile">
								<div class="tile-heading">本月交易量
									<span class="pull-right">总15598笔</span>
								</div>
								<div class="tile-body">
									<!--<i class="glyphicon glyphicon-credit-card"></i>-->
									<i class="fa fa-credit-card"></i>
									<h2 class="pull-right">0</h2>
								</div>
								<div class="tile-footer">
									<a href="">显示详细...</a>
								</div>
							</div>
						</div> 
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="title">
								<div class="title-heading">总额度
									<span class="pull-right"></span>
								</div>
								<div class="title-body">
									<!--<i class="glyphicon glyphicon-credit-card"></i>-->
									<i class="fa fa-credit-card"></i>
									<h2 class="pull-right" id="quota"><?php echo $quota; ?>元</h2>
								</div>
								<div class="title-foot">
									<a href="">显示详细...</a><!---->
									
									<!--Switch 开关 S-->
									<input hidden="hidden" id="btn" name="btn1" type="radio" value="<?php echo $btn; ?>" checked="checked" />
	  								<label class="iSwitch">
									    <input class="Switch" type="checkbox" id="button1" name="button1">
									    <i></i>
									</label>
	  								<!--Switch 开关 S-->
	  								
								</div>
							</div>
						</div> 
					</div>
				</div>
			</div>
			<!--S-part-1日交易量-->
			<div class="day">
					<div class="row">
					<div class="col-lg-4 col-md-12 col-sm-12 col-sx-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									站点行为
									<a style="font-size: 14px" href="" class="pull-right">更多..</a>
								</h3>
								
							</div>
							
							<ul class="list-group">
								<li class="list-group-item">火车东站  <span style="float: right;"><?php echo $z[17]; ?>元</span></li>
								<li class="list-group-item">百花岭站  <span style="float: right;"><?php echo $z[2]; ?>元</span></li>
								<li class="list-group-item">琅东站  <span style="float: right;"><?php echo $z[14]; ?>元</span></li>
								<li class="list-group-item">凤岭站   <span style="float: right;"><?php echo $z[18]; ?>元</span></li>
								<li class="list-group-item">东盟商务区站  <span style="float: right;"><?php echo $z[15]; ?>元</span></li>
								<li class="list-group-item">万象城站   <span style="float: right;"><?php echo $z[10]; ?>元</span></li>
								<li class="list-group-item">会展站宁家  <span style="float: right;"><?php echo $z[12]; ?>元</span></li>
								<li class="list-group-item">会展站走廊  <span style="float: right;"><?php echo $z[13]; ?>元</span></li>
								<li class="list-group-item">金湖站   <span style="float: right;"><?php echo $z[11]; ?>元</span></li>
								<li class="list-group-item">南湖站   <span style="float: right;"><?php echo $z[3]; ?>元</span></li>
								<li class="list-group-item">麻村站   <span style="float: right;"><?php echo $z[0]; ?>元</span></li>
								<li class="list-group-item">民族广场站   <span style="float: right;"><?php echo $z[1]; ?>元</span></li>
								<li class="list-group-item">新民路站    <span style="float: right;"><?php echo $z[19]; ?>元</span></li>
								<li class="list-group-item">火车站1   <span style="float: right;"><?php echo $z[4]; ?>元</span></li>
								<li class="list-group-item">火车站2  <span style="float: right;"><?php echo $z[5]; ?>元</span></li>
								<li class="list-group-item">白苍岭站   <span style="float: right;"><?php echo $z[6]; ?>元</span></li>
								<li class="list-group-item">广西大学站  <span style="float: right;"><?php echo $z[8]; ?>元</span></li>
								<li class="list-group-item">民族大学站   <span style="float: right;"><?php echo $z[7]; ?>元</span></li>
								<li class="list-group-item">清川站    <span style="float: right;"><?php echo $z[9]; ?>元</span></li>
								<li class="list-group-item">鹏飞路站  <span style="float: right;"><?php echo $z[16]; ?>元</span></li>
							</ul>
							
						</div> 
					</div>
					
					<div class="col-lg-8 col-md-12 col-sm-12 col-sx-12">
						<div class="row">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">日交易量统计</h3>
								</div>
								<div class="table-responsive">
									<table class="table" id="table">
										<canvas width="1000" height="800" id="cvs"></canvas>
									</table>
								</div>
							</div> 
						</div>
					</div> 
				</div>
			</div>
			
			<!--<!-E-part-1日交易量-->
			
			<!--<!-S-part-2周交易量-->
			<div class="day" style="display:none;">
					<div class="row"><!-- style="display:none;" -->
					<div class="col-lg-4 col-md-12 col-sm-12 col-sx-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									站点行为
									<a style="font-size: 14px" href="" class="pull-right">更多..</a>
								</h3>
								
							</div>
							
							<ul class="list-group">
								<li class="list-group-item">1</li>
								<li class="list-group-item">2</li>
								<li class="list-group-item">3</li>
								<li class="list-group-item">4</li>
								<li class="list-group-item">5</li>
								<li class="list-group-item">6</li>
								<li class="list-group-item">7</li>
								<li class="list-group-item">8</li>
							</ul>
						</div> 
					</div>
					
					<div class="col-lg-8 col-md-12 col-sm-12 col-sx-12">
						<div class="row">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">周交易量统计</h3>
								</div>
								<div class="table-responsive">
									<table class="table" id="table">
										<canvas width="5000" height="1800" id="ctx"></canvas>
									</table>
								</div>
							</div> 
						</div>
					</div> 
				</div>
			</div>
			
			
			<!--S-part-3月交易量-->
		<div class="day" style="display:none;">
			<div class="row"><!-- style="display:none;" -->
				<div class="col-lg-4 col-md-12 col-sm-12 col-sx-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								站点行为
								<a style="font-size: 14px" href="" class="pull-right">更多..</a>
							</h3>
							
						</div>
						
						<ul class="list-group">
							<li class="list-group-item">1</li>
							<li class="list-group-item">2</li>
							<li class="list-group-item">3</li>
							<li class="list-group-item">4</li>
							<li class="list-group-item">5</li>
							<li class="list-group-item">6</li>
							<li class="list-group-item">7</li>
							<li class="list-group-item">8</li>
						</ul>
					</div> 
				</div>
				
				<div class="col-lg-8 col-md-12 col-sm-12 col-sx-12">
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">月交易量统计</h3>
							</div>
							<div class="table-responsive">
								<table class="table" id="table">
									<canvas width="1000" height="1000" id="cns"></canvas>
								</table>
							</div>
						</div> 
					</div>
				</div> 
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
    var lis = document.querySelectorAll('#tab .tile');
    console.log(lis.length)
	for(var i=0; i<lis.length;i++){

		(function(_i){
			lis[_i].onclick = function(){

//				console.log('你点中了第几个:' + _i);

				for(var p=0; p<lis.length;p++){ 
					document.getElementsByClassName('day')[p].style.display = 'none'; 
				}
				document.getElementsByClassName('day')[_i].style.cursor='pointer';
				document.getElementsByClassName('day')[_i].style.display = 'block';

				for(var p=0; p<lis.length;p++){ 
					lis[p].className = '';
				}
				 lis[_i].className = 'on';

			}		

		})(i) ;
		
	}
	
	//
	//柱状图
	//柱状图
	//日交易量
var ctx  = document.getElementById("cvs").getContext('2d');  

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["火车东站", "百花岭站", "琅东站", "风岭站", "东盟商务区站", "万象城站","会展站宁家","会展站走廊","金湖站","南湖站","麻村站","民族广场站","新民路站","火车站1","火车站2","白苍岭站","广西大学站","民族大学站","清川站","鹏飞路站" ],//x轴数据
        datasets: [{
            label: '今日交易量',
            data: [<?php echo $z[17]; ?>, <?php echo $z[2]; ?>, <?php echo $z[14]; ?>, <?php echo $z[18]; ?>, <?php echo $z[15]; ?>,<?php echo $z[10]; ?>,<?php echo $z[12]; ?>,<?php echo $z[13]; ?>,<?php echo $z[11]; ?>,<?php echo $z[3]; ?>,<?php echo $z[0]; ?>,<?php echo $z[1]; ?>,<?php echo $z[19]; ?>,<?php echo $z[4]; ?>,<?php echo $z[5]; ?>,<?php echo $z[6]; ?>,<?php echo $z[8]; ?>,<?php echo $z[7]; ?>,<?php echo $z[9]; ?>,<?php echo $z[16]; ?>],//y轴数据
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

//周交易量
var cvs  = document.getElementById("ctx").getContext('2d');  

var myChart2 = new Chart(cvs, {
    type: 'bar',
    data: {
        labels: ["火车东站", "百花岭站", "琅东站", "风岭站", "东盟商务区站", "万象城站","会展站宁家","会展站走廊","金湖站","南湖站","麻村站","民族广场站","新民路站","火车站1","火车站2","白苍岭站","广西大学站","民族大学站","清川站","鹏飞路站" ],//x轴数据
        datasets: [{
            label: '本周交易量',
            data: [612, 319, 930, 1095, 1128,1060,968,898,1810,902,1228,1945,1061,1550,2180,3281,488,1005,2100,1095],//y轴数据
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
						 'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
//月交易量
var cns  = document.getElementById("cns").getContext('2d');  

var myChart3 = new Chart(cns, {
    type: 'bar',
    data: {
        labels: ["火车东站", "百花岭站", "琅东站", "风岭站", "东盟商务区站", "万象城站","会展站宁家","会展站走廊","金湖站","南湖站","麻村站","民族广场站","新民路站","火车站1","火车站2","白苍岭站","广西大学站","民族大学站","清川站","鹏飞路站" ],//x轴数据
        datasets: [{
            label: '本月交易量',
            data: [92392112345, 32882112345, 23762112345, 56710912311, 71311012128,43421220560,34231113268,52520312198,51622114810,23421010402,691312028,634016345,702317461,56135515012,71241118012,60281198811,42011045511,27032321012,45632178611,63123456789],//y轴数据
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,69,132,1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

//
window.onload=function(){
	var Oh2=document.getElementById("quota");
	//alert(num)
	if(parseInt(<?php echo $quota; ?>)<=parseInt(5000)){
		
		Oh2.style.color="red";
	}else{
		Oh2.style.color="#fff";
	}
	
}
		// switch 开关js控制点
		
		$(function () { $("#button1").bind("click", function () {
	 		// console.log( $("#button1").val() );
			  	if(parseInt(<?php echo $quota; ?>)<=parseInt(5000)||$("#btn").val()=="off"){
			   		$("#btn").val("on");
			    	console.log("开关S当前状态:"+$("#btn").val());
			    }else{
			      $("#btn").val("off");
			       console.log("开关S当前状态:"+$("#btn").val());
			    } 
	    	});
		});


$('.Switch').bind('click', function() {
//		alert(1);
		var btn=$('#btn').val();
		//alert(btn);
		$.post(
			"<?php echo url('daliyreport/switch'); ?>",
			{btn:btn},
				function(d){
					// console.log(d)
				if(d){					
					if(d.error){
						 //alert('已关闭充值');
						$.toast(d.error,"forbidden");	
					}else if(d.success){
						 //alert('已开启充值');
						$.toast(d.success);
					}					
				}
			}
		);
	}); 
</script>	

	</body>
</html>
