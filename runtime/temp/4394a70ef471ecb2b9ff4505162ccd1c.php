<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:39:"./oscshop/admin/view/discount/edit.html";i:1543328250;s:37:"./oscshop/admin/view/public/base.html";i:1512008342;}*/ ?>
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
	input#time_start,input#time_end{
		height: 28px;
	}
	.Wdate {
		width: 150px;
		height: 28px;
		line-height: 28px;
    	background: #fff url(/public/static/js/My97DatePicker/skin/datePicker.gif) no-repeat right!important;
	}
	.form-group {
	    margin-top: 10px!important;
	    margin-bottom: 36px!important;
	}
	#Pagination {
    	float: right;
	}
	.pagerBar {
	    height: 28px;
	    margin-top: 30px;
	    margin-bottom: 15px;
	    text-align: center;
	    position: relative;
	    font-size: 14px;
	}
	.pages span {
		display: inline-block;
	    height: 32px;
	    padding: 2px 10px;
	    margin-left: 3px;
	    line-height: 48px;
	    font-size: 14px;
	    overflow: hidden;
	}
	.pagerBar li, .pagerBar a {
		display: inline-block;
	    width: auto;
	    height: 32px;
	    padding: 0px 12px;
	    background: #f7f7f7;
	    text-align: center;
	    line-height: 32px;
	}
	.shangping{
		width:213px;
		height:34px;
		border:2px solid red;
		display: none;
	}
	.shangping select.choose{
		width: 210px;
		height: 30px;
		border:1px solid yellow;
	}
	.shangping select option.getname{
		font-size:14px;
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
						
<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>

	<div class="page-header">
		<h1>
			<?php echo $breadcrumb1; ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?php echo $breadcrumb2; ?>
			</small>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?php echo $crumbs; ?>
			</small>			
			<button id="send" form="form-goods" type="submit" style="float:right;"  class="btn btn-sm btn-primary">提交</button>			
		</h1>
	</div>

	<div class="row">
		<div class="col-xs-12">	
			<div class="panel-body">
				<form action="">
					<ul class="nav nav-tabs">
			          	<li class="active"><a href="#tab-data" data-toggle="tab">买/满就送</a></li>
			          	
			            <li><a href="#tab-general" data-toggle="tab">满件优惠</a></li>
			            <li><a href="#tab-discount" data-toggle="tab">限时秒杀</a></li>   
	          		</ul>
	          		<div class="tab-content">
	          		 	<div class="tab-pane active" id="tab-data">
	          		 		<div class="table-responsive">
				                <table id="discount-sale" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td></td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
		                		<div>
		                			<a class="add_image btn btn-primary " href="<?php echo url("Discount/active"); ?>">
		                				<i class="ace-icon fa fa-destop"></i>
		                			新增买/满就送
		                			</a>
		                		</div>
                  			</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-name2">折扣名称：</label>
								<div class="col-sm-3">
									<input id="input-name2" class="form-control" type="text" placeholder="折扣名称" value="" name="name">
								</div>
								<div class="col-sm-6">
									<label class="control-label" for="input-name2">折扣时间：</label>
									<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_start">
									<span>-</span>
									<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_end">
								</div>
								<div class="col-sm-1">
									<a href="" id="search-sale">搜索</a>
								</div>
							</div>

							<div class="col-xs-12" style="margin: 16px 0;">
								<table id="table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>折扣名称</th>
											<th>折扣有效期</th> 			
											<th>折扣状态</th>
											<th>相关操作</th>		
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
								<div class="pagerBar pages" id="Pagination">
        							<span>共<b class="orange">&nbsp;0&nbsp; </b>条记录
       	 							</span>
        							<li class="">上一页</li>
        							<li class="pgCurrent">1</li>
        							<li class="">下一页 </li>
        							<span style="padding-right:0px">跳到
        								<input type="text" style="float:none;text-align:center;height:31px;width:auto;text-align: center;margin-top:-6px;font-size:14px;padding:1px;" value="1" id="jump-index" title="请输入正整数" size="1">/1
        							</span>
        							<a href="#">确定</a></div>
								</div>
	          		 	</div>
	          		 	<div class="tab-pane" id="tab-general">
	          		 		<div class="table-responsive">
				                <table id="discount-hot" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td></td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
		                		<div>
		                			<a class="add_image btn btn-primary" href="<?php echo url("Discount/active"); ?>">
		                				<i class="ace-icon fa fa-destop"></i>
		                			创建优惠方式
		                			</a>
		                		</div>
			                	<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-name2">折扣名称：</label>
									<div class="col-sm-3">
										<input id="input-name2" class="form-control" type="text" placeholder="折扣名称" value="" name="name">
									</div>
									<div class="col-sm-6">
										<label class="control-label" for="input-name2">折扣时间：</label>
										<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_start">
										<span>-</span>
										<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_end">
									</div>
									<div class="col-sm-1">
										<a href="" id="search-sale">搜索</a>
									</div>
								</div>
                  			</div>

                  			<div class="col-xs-12" style="margin: 16px 0;">
								<table id="table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>商品名称</th>
											<th>折扣价格</th>
											<th>开始时间</th> 
											<th>结束时间</th>	
											<th>折扣数量</th>		
											<th>折扣状态</th>
											<th>相关操作</th>		
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
								<div class="pagerBar pages" id="Pagination">
        							<span>共<b class="orange">&nbsp;0&nbsp; </b>条记录
       	 							</span>
        							<li class="">上一页</li>
        							<li class="pgCurrent">1</li>
        							<li class="">下一页 </li>
        							<span style="padding-right:0px">跳到
        								<input type="text" style="float:none;text-align:center;height:31px;width:auto;text-align: center;margin-top:-6px;font-size:14px;padding:1px;" value="1" id="jump-index" title="请输入正整数" size="1">/1
        							</span>
        							<a href="#">确定</a></div>
								</div>
	          		 	</div>
	          		 	<div class="tab-pane" id="tab-discount">
	          		 		<div class="table-responsive">
				                <table id="discount-sole" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td></td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
		                		<div>
		                			<a class="add_image btn btn-primary " id="addParent">
		                			创建秒杀商品
		                			</a>
		                		</div>
			                		<div class="form-group required">
										<label class="col-sm-2 control-label pdl" for="input-name2">商品名称：</label>
										<div class="col-sm-3">
											<input id="input-name2" class="form-control" type="text" placeholder="折扣名称" value="" name="name">
										</div>
										<div class="col-sm-6">
											<label class="control-label" for="input-name2">秒杀时间：</label>
											<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_start">
											<span>-</span>
											<input class="Wdate" name="start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="time_end">
										</div>
										<div class="col-sm-1">
											<a href="" id="search-sale">搜索</a>
										</div>
									</div>
                  			</div>
							<div class="col-xs-12" style="margin: 16px 0;">
								<table id="table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>折扣序号</th>
											<th>商品名称</th>
											<th>折扣价格</th>
											<th>开始时间</th>
											<th>结束时间</th>
											<th>折扣数量</th>
											<th>折扣状态</th>
											<th>相关操作</th>		
										</tr>
									</thead>
									<tbody>
										<?php if(is_array($discount) || $discount instanceof \think\Collection || $discount instanceof \think\Paginator): $i = 0; $__LIST__ = $discount;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?>
										<tr>
											<td><?php echo $d['discount_id']; ?></td>
											<td><?php echo $d['0']['name']; ?></td>
											<td><?php echo $d['discount_price']; ?></td>
											<td><?php echo $d['discount_on_time']; ?></td>
											<td><?php echo $d['discount_off_time']; ?></td>
											<td><?php echo $d['quantity']; ?></td>
											<td></td>
											<td>
												<a href="" class="execute btn btn-xs btn-success">执行</a>
												<a href='' class="editing btn btn-xs btn-primary">修改</a>
												<a class="delete btn btn-xs btn-danger" href='<?php echo url("Discount/del",array("discount_id"=>$d["discount_id"])); ?>' >
													<i class="fa fa-trash bigger-120"></i>
												</a>

											</td>
										</tr>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</tbody>
								</table>
								<div class="pagerBar pages" id="Pagination">
        							<span>共<b class="orange">&nbsp;0&nbsp; </b>条记录
       	 							</span>
        							<li class="">上一页</li>
        							<li class="pgCurrent">1</li>
        							<li class="">下一页 </li>
        							<span style="padding-right:0px">跳到
        								<input type="text" style="float:none;text-align:center;height:31px;width:auto;text-align: center;margin-top:-6px;font-size:14px;padding:1px;" value="1" id="jump-index" title="请输入正整数" size="1">/1
        							</span>
        							<a href="#">确定</a></div>
								</div>
								<div id="dialog" class="dialog" style="display:none">
								    <div class="dialog_content">
								    
								        <dl>
								        <label class="col-sm-2 control-label" for="input-length-class">所属商户：</label>
					
											<select id="input-length-class" class="form-control" name="merchantNo" >
												<?php if(is_array($merchants) || $merchants instanceof \think\Collection || $merchants instanceof \think\Paginator): $i = 0; $__LIST__ = $merchants;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
													<option value="<?php echo $v['merchant_id']; ?>"><?php echo $v['merchants_name']; ?></option>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
											<div class="shangping">
												<select name="goods_id" id="choose" class="choose">

													<?php if(is_array($goods_id) || $goods_id instanceof \think\Collection || $goods_id instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_id;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$q): $mod = ($i % 2 );++$i;?>
													<option value="<?php echo $q['goods_id']; ?>" name="goods_id"><?php echo $q['name']; ?></option>
													<?php endforeach; endif; else: echo "" ;endif; ?>

												</select>
											</div>
								        	<dt>折扣价格</dt>
								    		<dd><input name="discount_price" type="text" value=""   /></dd>    	
								    		
								    		<dt>开始时间</dt>
								    		<dd><input class="Wdate" name="discount_on_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="discount_on_time"></dd>  
								    		
								    		<dt>结束时间</dt>
								    		<dd><input class="Wdate" name="discount_off_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" id="discount_off_time"></dd> 
								    		
								    		<dt>数量</dt>
								    		<dd><input name="quantity" type="text" value=""  /></dd> 
								    		
								        </dl> 


								   
								      
								    </div>
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
		$(document).ready(function(){
		$("#addParent").bind("click", {isParent:true}, add);
	});
		function add(e) {
			console.log(e)
			
			var dialog=$('#dialog').html();
			 
			var title='新增折扣';
			
			art.dialog({
				title: title,
				content:dialog,
				lock: true,
				ok: function () {	 		
			 	  save('add');	    	
			      return false;
			    },
			    cancelVal: '关闭',
				cancel: true 
			});	

			var tanchuang = $('.dialog_content').find('#input-length-class');
			var chuang = $('.dialog_content').find('.shangping');
			var item = $('.dialog_content').find('#choose');
			tanchuang.change(function(){
				// alert($(this).children('option:selected').val()); 
					$.ajax({
						url:"<?php echo url('Discount/goodschs'); ?>",
						type:'post',
						data:{merchantNo:$('#input-length-class').val()},
						dataType: 'json',
						success:function(data){
							console.log(data);
							chuang.show();
							var list = "";
							for(i=0;i<data.length;i++){
								console.log(data.length)
								list+="<option value='"+data[i].goods_id+"'>"+data[i].name+"</option>";
								item.empty();
								item.append(list);
								
							 
							}
						},
						error:function(data){

						}

					});
			});
		}
			
		
		function onclick(event){
			WdatePicker({
				dateFmt:"yyyy-MM-dd HH:00:00"
			})
		}
		function save(type){
			//alert($('#choose').val())
			$.post(
				'<?php echo url("Discount/add"); ?>',
				{					
					'goods_id':$('#choose').val(),
					'discount_price':$("input[name='discount_price']").val(),
					'discount_on_time':$("input[name='discount_on_time']").val(),
					'discount_off_time':$("input[name='discount_off_time']").val(),
					'quantity':$("input[name='quantity']").val()
					
				},
				function(d){			
					alert(d);
				}
			);	
			//alert($("input[name='goods_id']").val());
		}
			

			

	</script>

	</body>
</html>
