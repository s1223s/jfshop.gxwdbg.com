<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"./oscshop/mobile\view\index\index.html";i:1543281022;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:44:"./oscshop/mobile\view\public\header_top.html";i:1539075834;s:44:"./oscshop/mobile\view\public\footer-nav.html";i:1512628884;}*/ ?>
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
		 
	<link href="__PUBLIC__/view_res/mobile/css/swiper.min.css" type="text/css" rel="Stylesheet" />
	<link rel="shortcut icon" href=" /favicon.ico" /> 
	<link rel="stylesheet" href="__PUBLIC__/view_res/mobile/css/home_index.css">
	<script src="__PUBLIC__/artTemplate/template.js"></script>
	<script src="__PUBLIC__/view_res/mobile/load_list.js"></script>
	<script src="__PUBLIC__/view_res/mobile/index.js"></script>
<script>
	var pixclPatio = 1 / window.devicePixelRatio;
	document.write('<meta name="viewport" content="width=device-width,initial-scale='+pixclPatio+',minimum-scale='+pixclPatio+',maximum-scale='+pixclPatio+',user-scalable=no" />');
			
	var html = document.getElementsByTagName('html')[0];
	var pageWidth = html.getBoundingClientRect().width;
	html.style.fontSize = pageWidth /15 + 'px';
</script>

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
		
	<header class="header_box">
	<a href="" class="btn_type"></a>
	<div id="search_box">
		<form action="" class="search_form" onsubmit='searchdo(this);return false;'>
			<input type="search" class="search_input" targ="<?php echo url('search/index'); ?>" value="<?php echo input('param.search'); ?>">
		</form>
	</div>
	<a href="" class="btn_ms"></a>
</header>
<script>
function searchdo(form) {
    var search = $('input[type=search]', form);
    if (search.val() === '')
    return;            
 	var url = search.attr('targ');
 	
    var query = $('.header_box').find('input,select').serialize();
    query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
    query = query.replace(/^&/g, '');
    if (url.indexOf('?') > 0) {
        url += '&' + query;
    } else {
        url += '?' + query;
    }
    window.location.href = url;            
}	
</script>

 
<div id="main">
	<div class="swiper-container" id="banner">
	    <div class="swiper-wrapper">
	        <div class="swiper-slide"><a href=""><img src="/public/static/view_res/mobile/images/banner-1.jpg" alt=""></a></div>
	        <div class="swiper-slide"><a href=""><img src="/public/static/view_res/mobile/images/banner-2.jpg" alt=""></a></div>
	        <div class="swiper-slide"><a href=""><img src="/public/static/view_res/mobile/images/banner-3.jpg" alt=""></a></div>
	    </div>
	    <div class="focus_btn"></div>
	</div>
	<nav id="quick_nav">
		<a href="http://jfshop.gxwdbg.com/mobile/category/index"><img src="/public/static/view_res/mobile/images/new_index/icon_nav_1.png" alt=""><span>热销商品</span></a>
		<a href="http://jfshop.gxwdbg.com/mobile/merchant/index/id/6"><img src="/public/static/view_res/mobile/images/new_index/icon_nav_2.png" alt=""><span>必吃美食</span></a>
		<a href="http://jfshop.gxwdbg.com/mobile/merchant/index/id/8"><img src="/public/static/view_res/mobile/images/new_index/icon_nav_3.png" alt=""><span>影院大片</span></a>
		<a href="http://jfshop.gxwdbg.com/mobile/merchant/index/id/7"><img src="/public/static/view_res/mobile/images/new_index/icon_nav_4.png" alt=""><span>优惠券</span></a>
		<a href="http://jfshop.gxwdbg.com/mobile/points/index"><img src="/public/static/view_res/mobile/images/new_index/icon_nav_5.png" alt=""><span>积分兑换</span></a>
	</nav>
	<div id="sexkill">
		<div class="sildeLeft">
			<a href="http://jfshop.gxwdbg.com/mobile/discount/index">
				<h3 class="limit_title"></h3>
				<span>限时限量 先到先得</span>
				<img src="/public/static/view_res/mobile/images/new_index/seckill_show.png" alt="" class="sekill_F">
			</a>
		</div>
		<div class="sildeRight">
			<div class="RightT">
				<a href="">
					<h3></h3>
					<span>拼团优惠 惊喜连连</span>
					<img src="/public/static/view_res/mobile/images/new_index/seckill_show2.png" alt="" class="sekill_S">
				</a>
			</div>
			<div class="RightB">
				<a href="http://jfshop.gxwdbg.com/mobile/discount/prize">
					<h3></h3>
					<span>低价狂欢 砍价不停</span>
					<img src="/public/static/view_res/mobile/images/new_index/seckill_show3.png" alt="" class="sekill_T">
				</a>
			</div>
		</div>
	</div>
	<div id="new_product">
		<a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/81">
			<h3></h3>
			<img src="/public/static/view_res/mobile/images/new_index/new_pro_banner.png" alt="" class="new_pro">
		</a>
	</div>
	<div id="hot_season">
		<a href="">
			<h3></h3>
			<img src="/public/static/view_res/mobile/images/new_index/season_banner.png" alt="" class="hot_son">
		</a>
	</div>
	<div id="recommrnd">
		<h3></h3>
		<div id="list_pro"> 
				<ul id="recommond_list">
					<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/54">
							<img src="/public/uploads/cache/images/osc1/28901522655608_.pic_hd-200x200.jpg" alt="">
							<p>南宁万达影城双人观影券套餐(有效期至18年10月31日）</p>
							<i>&yen;</i>
							<span class="price">78.8</span>
							<span class="view">324人付款</span>
						</a></li>
					<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/51">
							<img src="/public/uploads/cache/images/osc1/28901522655608_.pic_hd-200x200.jpg" alt="">
							<p>南宁万达影城单人人观影券套餐(有效期至18年10月31日）</p>
							<i>&yen;</i>
							<span class="price">40</span>
							<span class="view">130人付款</span>
						</a></li>
					<!-- <li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/49">
							<img src="/public/uploads/cache/images/osc1/1-200x200.jpg" alt="">
							<p>佰迪乐2小时厢费券</p>
							<i>&yen;</i>
							<span class="price">15</span>
							<span class="view">267人付款</span>
						</a></li> -->
					<!-- <li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/48">
							<img src="/public/uploads/cache/images/osc1/3.1-200x200.jpg" alt="">
							<p>佰迪乐38元罗汉果茶券</p>
							<i>&yen;</i>
							<span class="price">15</span>
							<span class="view">128人付款</span>
						</a></li> -->
					<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/47">
							<img src="/public/uploads/cache/images/osc1/2.1-200x200.jpg" alt="">
							<p>佰迪乐18元小吃券（2份）</p>
							<i>&yen;</i>
							<span class="price">15</span>
							<span class="view">96人付款</span>
						</a></li>
					<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/81">
							<img src="/public/uploads/cache/images/osc1/xinyao/1/5b77bd8cN26155f8f-200x200.jpg" alt="">
							<p>鑫瑶果神原汁山葡萄酒甜型酒女士酒礼盒装50ml*12瓶买就送茶儿香</p>
							<i>&yen;</i>
							<span class="price">198</span>
							<span class="view">190人付款</span>
						</a></li>

								<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/105">
									<img src="/public/uploads/cache/images/osc1/yinyuehui/0001-200x200.png" alt="">
									<p>《猫和老鼠的贝多芬》古典音乐启蒙亲子钢琴快乐视听音乐会</p>
									<i>&yen;</i>
									<span class="price">80</span>
									<span class="view">0人付款</span>
								</a></li>
							<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/107">
									<img src="/public/uploads/cache/images/osc1/yinyuehui/0001-200x200.png" alt="">
									<p>《猫和老鼠的贝多芬》古典音乐启蒙亲子钢琴快乐视听音乐会</p>
									<i>&yen;</i>
									<span class="price">128</span>
									<span class="view">0人付款</span>
								</a></li>
								<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/108">
									<img src="/public/uploads/cache/images/osc1/yinyuehui/00002-200x200.png" alt="">
									<p>Anime Piano Live 2018经典动漫钢琴曲极致纯音演奏会</p>
									<i>&yen;</i>
									<span class="price">80</span>
									<span class="view">0人付款</span>
								</a></li>
							<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/109">
									<img src="/public/uploads/cache/images/osc1/yinyuehui/00002-200x200.png" alt="">
									<p>Anime Piano Live 2018经典动漫钢琴曲极致纯音演奏会</p>
									<i>&yen;</i>
									<span class="price">128</span>
									<span class="view">0人付款</span>
								</a></li>

							<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/111">
									<img src="/public/uploads/cache/images/osc1/meishi/coolkie03-200x200.jpg" alt="">
									<p>仅39.9元抢萨贝尔单人牛排套餐~西冷、沙朗、T骨3选1+自调饮品1杯~可叠加~地铁直达</p>
									<i>&yen;</i>
									<span class="price">39.9</span>
									<span class="view">0人付款</span>
								</a></li>
								<li><a href="http://jfshop.gxwdbg.com/mobile/goods/detail/id/119">
									<img src="/public/uploads/cache/images/osc4/1-200x200.jpg" alt="">
									<p>¥39.9抢嘻游记100元代金券~食肉兽们的打卡天堂～定位万象城6楼    </p>
									<i>&yen;</i>
									<span class="price">39.9</span>
									<span class="view">0人付款</span>
								</a></li>

						

								
				</ul> 


			</div>
	</div>
</div>

 
	<footer id="footer">
<div class="bottom_nav"><a class="nav_index <?php if(isset($flag) AND ($flag == 'index')): ?> hover<?php endif; ?>" href="<?php echo url('/mobile'); ?>"><i></i>购物</a>
<a class="nav_search <?php if(isset($flag) AND ($flag == 'search')): ?> hover<?php endif; ?>" href="<?php echo url('category/index'); ?>"><i></i>搜索</a>	
<a class="nav_shopcart <?php if(isset($flag) AND ($flag == 'cart')): ?> hover<?php endif; ?>" href="<?php echo url('cart/index'); ?>"><i></i>购物车</a>	
<a class="nav_me <?php if(isset($flag) AND ($flag == 'user')): ?> hover<?php endif; ?>" href="<?php echo url('user/index'); ?>"><i></i>个人中心</a></div>		
</footer>

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

	
	<script src="__PUBLIC__/view_res/mobile/swiper.min.js"></script>
	<script>
	var swiper = new Swiper('#banner', {
		direction: "horizontal",
		/*横向滑动*/
		loop: true,
		/*形成环路（即：可以从最后一张图跳转到第一张图*/
		pagination: ".focus_btn",
		/*分页器*/
		/*后退按钮*/
		autoplay: 3000 /*每隔3秒自动播放*/
	});
</script>

<!--  -->


</html>