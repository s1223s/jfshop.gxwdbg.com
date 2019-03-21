<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:38:"./oscshop/mobile/view/index/index.html";i:1550542459;s:38:"./oscshop/mobile/view/public/base.html";i:1516611140;s:44:"./oscshop/mobile/view/public/header_top.html";i:1539075834;s:40:"./oscshop/mobile/view/public/search.html";i:1512545342;s:44:"./oscshop/mobile/view/public/footer-nav.html";i:1512628884;}*/ ?>
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
		 
	<link rel="stylesheet" href="__PUBLIC__/view_res/mobile/css/header-home.css">
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="__PUBLIC__/view_res/mobile/css/reset.css">
	<script src="__PUBLIC__/artTemplate/template.js"></script>
	<script src="__PUBLIC__/view_res/mobile/load_list.js"></script>
	<script src="__PUBLIC__/view_res/mobile/index.js"></script>

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

	<div style="text-align: center;padding: .5rem 0 0 0;">
	<img src="__PUBLIC__/view_res/mobile/images/logo1.png" style="width: 150px;height: 40px;"></div>
<form class="search-w-box" onsubmit='searchdo(this);return false;'>
	<input type="search" name="search" id="searchBox" targ="<?php echo url('search/index'); ?>" value="<?php echo input('param.search'); ?>" class="search-w-input" placeholder="搜一搜，找到你想要的" />
</form>
<script>
	function searchdo(form) {
		var search = $('input[type=search]', form);
		if (search.val() === '')
			return;
		var url = search.attr('targ');
		var query = $('.search-w-box').find('input,select').serialize();
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

<script>
	var swiper = new Swiper('.swiper-container', {
		direction: "horizontal",
		/*横向滑动*/
		loop: true,
		/*形成环路（即：可以从最后一张图跳转到第一张图*/
		pagination: ".swiper-pagination",
		/*分页器*/
		prevButton: ".swiper-button-prev",
		/*前进按钮*/
		nextButton: ".swiper-button-next",
		/*后退按钮*/
		autoplay: 3000 /*每隔3秒自动播放*/
	});
</script>
 
	<div id="ontouch">
	<!-- header S -->
		<div class="common_header">
			<header class="header">
				<div class="header_new_bar">
					<div id="msShortUser">
						<?php if(in_wechat()): ?>
	        <a class="headwrap"><img src="<?php echo $userinfo['userpic']; ?>/0"/></a>	             
        <?php else: ?>
	        <a class="headwrap">
	        	<?php if(!empty($userinfo['userpic'])): ?>
	        	<img src="<?php echo $userinfo['userpic']; ?>"/>
	        	<?php else: ?>
	        	<img src="__RES__/mobile/images/icon/iconfont-iconname_2x.png"/>
	        	<?php endif; ?>
	        </a>  
        <?php endif; ?>
					</div>
					<div class="head_new_title"></div>
					<div id="msShortType"></div>
				</div>
			</header>
			<div class="headr_search">
				<form action="" class="header_search_form">
					<div class="header_search_box">
						<div class="header_search_input">
							<input type="text" maxlength="20" name="keyword" autocomplete="off" placeholder="大家都在搜：美食电影K歌">
						</div>
					</div>
				</form>
			</div>
		</div>
	
	<!-- 二级导航 -->
		<div class="head_tab_bar" id="sub_Nav">
			<div class="tab_bar_inner swiper-container" id="tab_scrollbar">
				<ul class="clearfix swiper-wrapper">
					<li class="swiper-slide" style="width: 70px;"><a href=""><span class="cur">今日推荐</span></a></li>
					<li class="swiper-slide" style="width: 70px;"><a href=""><span>秒杀特价</span></a></li>
					<li class="swiper-slide" style="width: 70px;"><a href=""><span>精品商家</span></a></li>
				</ul>
			</div>
			<div id="tab_bar_more" class="tab_bar_more">
				<div class="tab_btn_more">
					<i class="icon_arrow_down"></i>
					<i class="icon_arrow_up"></i>
				</div>
				<div class="channel_category_wrap"></div>
			</div>
		</div>
	
	<!-- 广告轮播 -->
		<div class="new_slide_content">
			<div class="news_slide_wrap">
				<ul class="news_slide_list">
					<li><a href="#"><img src="" alt=""></a></li>
				</ul>
			</div>
		</div>

	<!-- quick S -->
		<div class="floor box_wrapper">
			<div class="quick_nav_list">
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_00.png" alt="美食"><span>美食</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_01.png" alt="电影"><span>电影</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_02.png" alt="乐园"><span>乐园</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_03.png" alt="酒店"><span>酒店</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_04.png" alt="音乐会"><span>音乐会</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_05.png" alt="船票" style="width: 4rem"><span>船票</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_06.png" alt="服装"><span>服装</span></a>
				<a href="" class="box"><img src="/public/static/view_res/mobile/images/quick_nav_07.png" alt="酒水"><span>酒水</span></a>
			</div>
		</div>

	<!-- sec_kill S -->
		<section class="sec_kill_floor">
			<div class="sec_title_wrap">
				<div class="sec_kill_title">
					<img src="/public/static/view_res/mobile/images/sec_kill_title.png" alt="">
				</div>
				<div class="sec_kill_time">
					<span class="clock">距离本场</span>
					<span class="margin_left">还剩</span>
					<div id="sec_limit_time">
						<span>00</span>:
						<span>00</span>:
						<span>00</span>
						<?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<a href="/mobile/goods/detail/id/<?php echo $v['0']['goods_id']; ?>" class="sku_item">
							<img src="/public/uploads/<?php echo $v['0']['image']; ?>" alt="">
							<div class="seckill_meta">
								
								
								<h4><?php echo $v['0']['name']; ?></h4>
								<p class="seckill_price">
									<span>秒杀价</span>
									<span>&yen;<strong><?php echo $v['discount_price']; ?></strong></span>
									<del>&yen;<?php echo $v['0']['originalprice']; ?></del>
								</p>

								
					         
					            	
					            	</dl>
			            		
								<p class="seckill_btn">
									<button class="seckill_buy">马上抢</button>
								</p>
								<h6>库存:<?php echo $v['0']['quantity']; ?>份</h6>
							
								
							</div>
						</a>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
			<div id="seckillSlider" class="sec_kill_slider">
				<ul class="sec_kill_list"></ul>
			</div>
		</section>

	<!-- channel_shop S-->
		<section class="channel_shop_wrap">
			<div class="channel_shop">
				<div class="channel_shop_title">
					<img src="/public/static/view_res/mobile/images/channel_shop_title.png" alt="">
				</div>
				<div class="business_one">
					<a href="" class="business_one_wrap"></a>
					<div class="business_one_detail">
						<h2>南宁万达影城</h2>
						<p><span>低至<em class="blod">38.8</em></span><span>优惠影券不限量</span></p>	
					</div>
				</div>
				<div class="business_two">
					<a href="" class="business_two_wrap"></a>
					<div class="business_two_detail">
						<h2>广西音乐厅</h2>
						<p><span class="blod">全网最低价</span><span>感受来自音乐的陶冶</span></p>
					</div>
				</div>
				<div class="business_three">
					<a href="" class="business_three_wrap"></a>
					<div class="business_three_detail">
						<h2>广西北港邮轮观光</h2>
						<p><span class="blod">一票多娱</span><span>一场碧海蓝天的旅行</span></p>
					</div>
				</div>
			</div>
		</section>

	<!-- 为您推荐 S -->
		<section class="recommend">
			<div class="rec_title_wrap">
				<img src="/public/static/view_res/mobile/images/rec_title_0.webp" alt="">
			</div>
			<section class="rec_content_wrap" id="goods_list">
				
			</section>
			<div id="list-loading" style="display: none;"><img src="__PUBLIC__/view_res/mobile/spinner-g-60.png" width="30"></div>
		</section>
		<script id="list" type="text/html">
			<@each list as value i@>
				<div class="re_content_item">
					<a href="/mobile/goods/detail/id/<@value.goods_id@>">
						<img src="/<@value.image@>" />
					</a>
					<p><@value.name@></p>
					<span class="price">&yen;<@value.price@></span>
					<!-- <span class="view">400人付款</span> -->
				</div>
			<@/each@>
		</script>
		
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

	
	<script>
		$(function(){
			scroll_load('mobile/index/ajax_goods_list','list','goods_list');
		});//商品加载
		// 二级导航
	</script>


</html>