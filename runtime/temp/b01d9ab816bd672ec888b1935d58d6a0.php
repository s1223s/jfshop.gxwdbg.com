<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"./oscshop/mobile\view\discount\index.html";i:1541660562;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:41:"./oscshop/mobile\view\public\top-nav.html";i:1512008342;s:44:"./oscshop/mobile\view\public\footer-nav.html";i:1512628884;}*/ ?>
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
		 
	<link href="__PUBLIC__/view_res/mobile/css/discount.css" type="text/css" rel="Stylesheet" />
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
		
	<div class="listTopcaption">
<div class="holder">
    <a class="listTopArrow"  onclick="history.go(-1)"></a>
    <a class="listTopArrow home"  href="<?php echo url('/mobile'); ?>"></a>
    <p><?php echo $top_title; ?></p>
</div>
</div>
<div class="TopcaptionPos"></div>
 
	<div id="seckill_banner">
		<img src="/public/static/view_res/mobile/images/new_index/seckill_ads.png" alt="">
	</div>
	<div id="seckill_now">
		<div class="countdown">
			<div class="logo_times"></div>
			<div class="subtitle">
				<p class="countdown_text" id="timeLimit">
				<strong>距离本场抢购结束还有</strong>
					<span class="box"></span><strong>小时</strong>
					<span class="box"></span><strong>分</strong>
					<span class="box"></span><strong>秒</strong>
				</p>
			</div>
		</div>
	</div>
	<div id="subtitle_next">
		<div class="next_seckill">
			<a href="<?php echo url('Discount/discount'); ?>" class="next">查看下场抢购商品&gt;&gt;</a>
		</div>
	</div>
	
	<div id="seckill_items">
		<section class="seckill_list">
			<?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<a href="/mobile/goods/detail/id/<?php echo $v['0']['goods_id']; ?>" class="sku_item">
				<!--<img src="/public/static/view_res/mobile/images/new_index/seckill_list_p.png" alt="">-->
				<img src="/public/uploads/<?php echo $v['0']['image']; ?>" alt="">
				<div class="seckill_meta">
					
					
					<h4><?php echo $v['0']['name']; ?></h4>
					<!--<p class="shop_name"><i></i><span>鑫瑶果神</span></p>-->
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
		</section>
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
		function countTime(){
		var date = new Date();
		var now =date.getTime();
		var end = new Date('<?php echo $timeoff; ?>').getTime();
		var leftTime = end-now;
		var H,M,S;
		if(leftTime>=0){
			H = (Math.floor(leftTime / 1000 / 60 / 60 / 24))*24+(Math.floor(leftTime/(1000*60*60))%24);
			M = Math.floor(leftTime / 1000 / 60 % 60);
			S = Math.floor(leftTime / 1000 % 60);
			$('#timeLimit span:eq(0)').html(H);
			$('#timeLimit span:eq(1)').html(M);
			$('#timeLimit span:eq(2)').html(S);
			leftTime--;

			setTimeout(countTime, 1000);
		}else{
			$("#timeLimit").html();
			$("#timeLimit").html('活动已过期！！！');
		}
	}
	countTime();
		
	</script>
	


</html>