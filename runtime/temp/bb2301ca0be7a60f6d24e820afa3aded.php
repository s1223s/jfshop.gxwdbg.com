<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./oscshop/mobile\view\merchant\index.html";i:1541059193;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:44:"./oscshop/mobile\view\public\footer-nav.html";i:1512628884;}*/ ?>
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
		 
		<link href="__PUBLIC__/view_res/mobile/css/MerchantShop.css" type="text/css" rel="Stylesheet" />
		<link href="__PUBLIC__/view_res/mobile/css/productlist.css" type="text/css" rel="Stylesheet" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="__PUBLIC__/js/bt/bootstrap.min.css" />
		<link rel="stylesheet" href="__ADMIN__/ace/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link href="__PUBLIC__/view_res/mobile/css/swiper.min.css" type="text/css" rel="Stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/view_res/mobile/css/reset.css" />

		<link href="__PUBLIC__/view_res/mobile/css/category.css" type="text/css" rel="Stylesheet" />
		<link href="__PUBLIC__/jquery-weui/dist/lib/weui.min.css" type="text/css" rel="Stylesheet" />
		<link href="__PUBLIC__/jquery-weui/dist/css/jquery-weui.min.css" type="text/css" rel="Stylesheet" />
		<script src="__PUBLIC__/jquery-weui/dist/js/jquery-weui.min.js"></script>

		<script src="__PUBLIC__/jquery-weui/src/lib/jquery-2.1.4.js"></script>
		<script src="__PUBLIC__/js/bt/bootstrap.min.js"></script>

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
		 

<input type="hidden" value="<?php echo $merchantid; ?>" id="merchantid" />
		<div class="home_top">
			<img src="/public/static/view_res/mobile/images/merchant_images/shop-bg.jpg" alt="背景图片" />
			
			<div class="home_title">
				<!--<img src="/public/static/view_res/mobile/images/merchant_images/logo.png" alt="" />-->
				<div class="home_content">
					<span><?php echo $merchantname; ?></span>
					<div style="margin-top: 6px;">
						<span class="i-love"></span>
						<span class="i-love"></span>
						<span class="i-love"></span>
						<span class="i-love"></span>
					</div>
					<span class="num">105</span>
					<span class="text">粉丝数</span>
				</div>
			</div>
		</div><!--home_top-->
		
		<!--mainBox Start-->
		<div class="tabs" id="tabs">
			<li class="Item active"><a href="">8</a><span class="one">全部商品</span></li>
			<li class="Item"><a href="">8</a><span>热销</span></li>
			<li class="Item"><a href="">8</a><span>新品</span></li>
			<li class="Item"><a href="">8</a><span>推荐</span></li>
		</div>
		
		<!--banner-->
		<div id="banner" class="swiper-container swiper-container-horizontal">
			<div class="swiper-wrapper">
				<div class="swiper-slide"><img src="/public/static/view_res/mobile/images/merchant_images/shop-banner.png" alt="" /></div>
				<div class="swiper-slide"><img src="" alt="" /></div>
				<div class="swiper-slide"><img src="" alt="" /></div>
			</div>
		</div>
		<div id="viewCatRight"></div>
		<div id="tabs-container" class="swiper-container swiper-container-horizontal">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div id="viewProduct">
						<div style="margin: 0 10px;"> </div>
					</div>
					
				</div><!--	第一屏-首页	-->
				
			</div><!--silde-wrapper-->
		</div><!--swiper-container-->
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
        // 对应分类id
        //var cat = $('#cat').val() !== '' && parseInt($('#cat').val()) !== 0 ? parseInt($("#cat").val()) : parseInt($('.viewCatTopItem').eq(0).attr('data-catid'));
        var cat = $('#merchantid').val()
        // 左侧按钮点击
        $('.Item').bind({'touchend touchcancel mouseup': function (event) {
                var node = $(this);
                event.preventDefault();
                if (cat !== node.attr('data-catid')) {
                    cat = node.attr('data-catid');
                    
                    $.showLoading();
                    
                    fnLoadCatlist(cat);
                    
                    setTimeout(function (){
				        $.hideLoading();		     
				    }, 500);
				    
                    $('.Item.active').removeClass('active');
                    node.addClass('active');
                }
            }});

        // window resizer
        <!-- $(window).bind('resize', function () { -->
            <!-- // 调整高度 -->
            <!-- $('#viewCatRight').height($(window).height() - $('.search-w-box').height() - 35); -->
            <!-- $('#viewCatLeft').height($(window).height() - $('.search-w-box').height() - 20); -->
            <!-- $('#whiteWrap').height($('#viewCatRight').height() + 35); -->
            <!-- // 调整圆图标宽高 -->
            <!-- $('.subcat_item').each(function () { -->
                <!-- $(this).css({ -->
                    <!-- 'height': $(this).width() + 25 + 'px' -->
                <!-- }); -->
            <!-- }); -->
        <!-- }).resize(); -->

        // 默认load第一个分类的列表
        $('.viewCatTopItem[data-catid="' + cat + '"]').eq(0).addClass('hov');
        fnLoadCatlist(cat);

        /**
         *列表加载函数
         * @param {type} cat
         * @returns {undefined}
         */
      
        function fnLoadCatlist(cat) {
            if ($('#whiteWrap').length === 0) {
                $('#viewCatRight').append('<div id="whiteWrap"></div>');
            }
            $('#whiteWrap').height($('#viewCatRight').height() + 35);            
            
            $('#viewCatRight').load("<?php echo url('merchant/get_merchant'); ?>" +'/id/'+ cat,
                    function () {
                        // 调整圆图标宽高
                        $('.subcat_item img').each(function () {
                            $(this).css({
                                'height': $(this).width() + 'px'
                            });
                        });
                        $('.subcatBrand').width(($('#viewCatRight').width() / 2) - 15);
                    });
                  
        }
</script>
	

</html>