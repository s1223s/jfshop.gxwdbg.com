<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./oscshop/mobile\view\user\index.html";i:1536632094;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:44:"./oscshop/mobile\view\public\footer-nav.html";i:1512628884;}*/ ?>
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
		 
<link href="__PUBLIC__/jquery-weui/dist/lib/weui.min.css" type="text/css" rel="Stylesheet" />
<link href="__PUBLIC__/view_res/mobile/css/uc.css" type="text/css" rel="Stylesheet" />
<link href="__PUBLIC__/jquery-weui/dist/css/jquery-weui.min.css" type="text/css" rel="Stylesheet" />
<script src="__PUBLIC__/jquery-weui/dist/js/jquery-weui.min.js"></script>

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
		 

<div id="wrapper">
    <div class="close"></div>
</div>

<div class="uc-headwrap" style='background-image: url(__RES__/mobile/images/ucbag/bag2.jpg);'>
    <div class="uc-head">
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
        <span class="uc-name"><?php echo $userinfo['nickname']; ?></span>
        <!-- 签到按钮 -->
        <!--<input type="button" class="uc-signin" value="签到" id="uc-sign" />-->
        
        <!--<input type="button" class="uc-signin" value="已签到" id="uc-in" style="display: none;"/>-->
    </div>
    <p class="uc-userid">id号:<?php echo $uid; ?></p>
    <a class="uc-sign">签到</a>
    <input id="uid" type="hidden" value="<?php echo $uid; ?>" name="uid">
    <div class="comspreadstat clearfix">
        <span class="spread-item" onclick="location.href = '<?php echo url("Points/points_list"); ?>';"><b><?php echo $userinfo['points']; ?></b>积分</span>        
        <span class="spread-item" onclick="location.href = '<?php echo url("User/wish_list"); ?>';"><b><?php echo $userinfo['wish']; ?></b>收藏</span>
    </div>
</div>

<div class="uc-section" onclick="location.href = '<?php echo url("order/index"); ?>';"><i class='dingdan'></i><b>查看全部</b>我的订单</div>

<div class='uc-order-sec clearfix'>
    <a class='uc-order-btn fukuan' href="<?php echo url('order/index',array('status'=>config('default_order_status_id'))); ?>"><i></i>待付款<b class='prices'><?php echo (isset($no_pay) && ($no_pay !== '')?$no_pay:'0'); ?></b></a>
    <a class='uc-order-btn fahuo' href="<?php echo url('order/index',array('status'=>config('paid_order_status_id'))); ?>"><i></i>待发货<b class='prices'><?php echo (isset($paid) && ($paid !== '')?$paid:'0'); ?></b></a>    
</div>

<div class="uc-section" onclick="location.href = '<?php echo url("user/wish_list"); ?>';">
    <i></i><b>我喜欢，我收藏</b>我的收藏
</div>
<div class="uc-section" onclick="location.href = '<?php echo url("coupon/index"); ?>';">
    <i></i><b>我的优惠券</b>我的优惠券
</div>

<div class="uc-section" onclick="location.href = '<?php echo url("points/index"); ?>'">
    <i class='credit'></i><b>您有 <?php echo $userinfo['points']-$userinfo['cash_points']; ?> 积分可兑换</b>积分兑换
</div>	
<!--	<?php if($userinfo['is_agent'] == 1): ?>	
	        <div class="uc-section" onclick="location.href = '<?php echo url("Agent/sub_agent"); ?>'">
	            <i class='hezuo'></i><b>总收益： &yen; <?php echo $userinfo['total_bonus']; ?> </b>我的代理
	        </div>
	        <div class="uc-section" onclick="location.href = '<?php echo url("Agent/my_agent_info"); ?>'">
	            <i class='infoedit'></i><b>可查看/修改资料</b>我的资料
	        </div>
	        <div class="uc-section" id="companyQrcode">
	            <i class='qrcode'></i><b>一起来推广吧</b>推广分享
	        </div>
	        <div style="height:100px;"></div>	        
	<?php else: ?>
	    <div class="uc-section" onclick="location.href = '<?php echo url("Agent/apply_agent"); ?>'">
	        <i class='hezuo'></i><b>加入代理，共同成长</b>成为代理
	    </div>
	<?php endif; ?>
	-->
</div>	

    <div class="weui_btn_area mui-content-padded">
<!--	<a class="weui_btn weui_btn_primary" id="drop-out-btn" style="background-color:#e4393c">退出登录</a>-->

<?php if(in_wechat()): endif; ?>

 
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

	/*var btn1=document.getElementById('uc-sign');
	var btn2=document.getElementById('sign');
	
	btn1.addEventListener("click",function(){
		btn1.style.display="none";
		btn2.style.display="block";
	})*/

$('.uc-sign').bind('click', function() {
		//alert(1);
		var uid=$('#uid').val();
		//alert(uid);
		$.post(
			"<?php echo url('user/sign'); ?>",
			{uid:uid},
				function(d){
				
				if(d){					
					if(d.error){
						//alert(1);
						$.toast(d.error,"forbidden");	
					}else if(d.success){
						//alert(2);
						$.toast(d.success);
					}					
				}
			}
		);
	}); 

</script>
<!-- <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>  -->
<!-- <script data-main="__RES__/mobile/js/shop_uchome.js" src="__RES__/mobile/js/require.min.js"></script> -->


</html>