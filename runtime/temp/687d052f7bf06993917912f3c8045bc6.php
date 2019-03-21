<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:42:"./oscshop/mobile/view/agent/sub_agent.html";i:1512008342;s:38:"./oscshop/mobile/view/public/base.html";i:1516611140;s:41:"./oscshop/mobile/view/public/top-nav.html";i:1512008342;}*/ ?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv=Content-Type content="text/html;charset=utf-8" />
		<title><?php echo (isset($SEO['title']) && ($SEO['title'] !== '')?$SEO['title']:''); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no"> 
		<script src="__PUBLIC__/js/jquery/jquery-1.10.2.min.js"></script>
		 
<link href="__PUBLIC__/view_res/mobile/css/wshop_company_center.css" type="text/css" rel="Stylesheet" />
<style>
     a{color:#000;}
</style>

		<script>
			var _hmt = _hmt || [];
			(function() {
				var hm = document.createElement("script");
				hm.src = "https://hm.baidu.com/hm.js?920c9eb6c337fe682f18b68f6d2b2464";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(hm, s);
			})();
		</script>

	</head>

	<body>
		
<div class="listTopcaption">
<div class="holder">
    <a class="listTopArrow"  onclick="history.go(-1)"></a>
    <a class="listTopArrow home"  href="<?php echo url('/mobile'); ?>"></a>
    <p><?php echo $top_title; ?></p>
</div>
</div>
<div class="TopcaptionPos"></div>
        
<div class="comspreadstat clearfix">
	<span class="spread-item">等级<b><?php echo get_agent_level_info($agent['agent_level'],'name'); ?></b></span>
	<span class="spread-item">返点<b><?php echo num_to_percent($agent['return_percent']); ?></b></span>
    <span class="spread-item"><a href="<?php echo url('Cash/index'); ?>">已提现<b>&yen; <?php echo round($agent['cash'],3); ?></b></a></span>
    <span class="spread-item"><a href="<?php echo url('Cash/no_cash'); ?>">未提现<b>&yen; <?php echo round($agent['no_cash'],3); ?></b></a></span>
</div>
<div class="comspreadstat clearfix">
    <span class="spread-item"> <a href="<?php echo url('Agent/order',array('type'=>'today')); ?>">今日<b>&yen; <?php echo empty($today[0]['total'])?0:$today[0]['total']; ?></b> </a></span>
    <span class="spread-item"> <a href="<?php echo url('Agent/order',array('type'=>'yesterday')); ?>">昨日<b>&yen; <?php echo empty($yesterday[0]['total'])?0:$yesterday[0]['total']; ?> </b> </a></span>
    <span class="spread-item"> <a href="<?php echo url('Agent/order',array('type'=>'total')); ?>">总计<b>&yen; <?php echo round($agent['total_bonus'],3); ?> </b> </a></span>
    <span class="spread-item"> <a href="<?php echo url('Agent/member'); ?>">名下<b><?php echo $member; ?> 人</b> </a></span>
</div>

<header class="Thead">名下会员订单</header>

<div id="ulist">
    
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?>    
        <section class="ulist clearfix">
            <img src="<?php echo $order['userpic']; ?>/64" />
            <div class="info">
                <p><?php echo $order['nickname']; ?></p>
                <p>订单：<a href='<?php echo url("Order/order_info",array("order_id"=>$order["order_id"])); ?>'><b><?php echo $order['order_num_alias']; ?></b></a> 收益：<b>&yen;<?php echo $order['bonus']; ?></b></p>
            </div>
        </section>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</div>
 
	</body>

	<script>
		var _hmt = _hmt || [];
		(function() {
			var hm = document.createElement("script");
			hm.src = "//hm.baidu.com/hm.js?32e3cb4cf7e5c6772c4dc1f5d496b6af";
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hm, s);
		})();
	</script>

	

</html>