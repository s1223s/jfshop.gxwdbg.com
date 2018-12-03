<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"./oscshop/mobile\view\points\index.html";i:1512008342;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:41:"./oscshop/mobile\view\public\top-nav.html";i:1512008342;}*/ ?>
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
		 
<link href="__PUBLIC__/view_res/mobile/css/uc.css" type="text/css" rel="Stylesheet" />
<link href="__PUBLIC__/view_res/mobile/css/productlist.css" type="text/css" rel="Stylesheet" />
        
<script src="__PUBLIC__/artTemplate/template.js"></script>
<script src="__PUBLIC__/view_res/mobile/load_list.js"></script>
<script src="__PUBLIC__/view_res/mobile/index.js"></script>
<style>
	.prices{text-align: center;}
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
 
<div id="likes_list" class="clearfix">
	<div class="clearfix pdBlock"  id="likes_list_box">
	</div>
</div>
<div id="list-loading" style="display: none;"><img src="__PUBLIC__/view_res/mobile/images/icon/spinner-g-60.png" width="30"></div>

<script id="list" type="text/html">
    	<@each list as value i@>	        
	        <section class="productListWrap hoz">
                <a class="productList clearfix" href='/mobile/points/detail/id/<@value.goods_id@>'>
                    <img class="photo" src="/<@value.image@>" />           
                    <section>
                        <title class="title"><@value.name@></title>
                        <span class='prices'>积分:<@value.pay_points@>分</span>                                  
                    </section>
                </a>
            </section>	        
        <@/each@>
</script>
 
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
$(function(){
scroll_load('mobile/points/ajax_goods_list','list','likes_list_box');
});
</script>


</html>