<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./oscshop/mobile/view/goods/recharge.html";i:1550199584;s:38:"./oscshop/mobile/view/public/base.html";i:1516611140;s:41:"./oscshop/mobile/view/public/top-nav.html";i:1512008342;}*/ ?>
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
		 
	<link href="__PUBLIC__/view_res/mobile/css/charge.css" type="text/css" rel="Stylesheet" />
	<link rel="stylesheet" href="__PUBLIC__/view_res/mobile/css/reset.css">


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
 
	<div id="charge" class="charge">
		<header class="input_phone_wrap">
			<div class="input_phone_inner">
				<input type="tel" maxlength="13" placeholder="请输入充值号码">
				<span class="tel-mark"></span>
			</div>
		</header>
		<div class="price_section">
			<ul class="price_list" id="Price">
				<li faceamount="30" saleprice="3000"><div class="li_box price"><span class="old">30元</span><span class="new">售价: ￥30.00</span></div></li>
				<li><div class="li_box price"><span class="old">50元</span><span class="new">售价: ￥50.00</span></div></li>
				<li><div class="li_box price"><span class="old">100元</span><span class="new">售价: ￥100.00</span></div></li>
			</ul>
		</div>
		<div class="footer_section">
			<div class="ui_flex footer_box">
				<span class="cell total_num">
            		<em>合计：</em><i class="yen">¥</i><i class="int"></i><i id="onlinePay" class="decima">30.00</i>
        		</span>
        		<a href="javascript:;" id="charge_submit" class="ui_btn">立即支付</a>
			</div>
		</div>
		<div id="posMsg" class="hide">
			<input type="hidden" id="salePrice" value="">
		</div>
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

	
	<script>

	</script>	


</html>