<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./oscshop/mobile\view\discount\prize.html";i:1543398224;s:38:"./oscshop/mobile\view\public\base.html";i:1516611141;s:41:"./oscshop/mobile\view\public\top-nav.html";i:1512008342;}*/ ?>
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
		 
	<link href="__PUBLIC__/view_res/mobile/css/prize.css" type="text/css" rel="Stylesheet" />
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
 
<!-- 个人中心基本信息 -->
	<div class="header">
		<div class="head_login">
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
        <div class="head_login_info">
          	<p><?php echo $userinfo['nickname']; ?></p>
          	<p>id号:<?php echo $uid; ?></p>
          </div>  
		</div>
		<a href="<?php echo url('Discount/myprize'); ?>" class="head_login_draw" id="MyGift" >我的奖品</a>
	</div>
<!-- 个人中心基本信息 -->

<!-- 转盘抽奖模块 S-->
	<div class="draw">
		<div class="tit">
			<p>幸运转盘</p>
			<a href="javascrip:void(0)" tag="open" class="rule">规则</a>
		</div>
		<div id="listLottery" class="draw_warp">
			<div class="draw_wrap_info">
				<div class="draw_bg"></div>
				<!-- <div class="wheel_item_wrap">
					<div class="pannel_item">
						<div class="titext">未中奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">一等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">二等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">三等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">四等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">五等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div> 
					</div>
					<div class="pannel_item">
						<div class="titext">六等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
					<div class="pannel_item">
						<div class="titext">七等奖</div>
						<div class="coupon_straight">
							<div class="icon"></div>
						</div>
					</div>
				</div> -->
			</div>
			<div class="lottery_btn"></div>
		</div>
		<!-- 弹窗模块  活动结束 -->
		<div class="mask" style="display: none;">
			<div class="maskbox">
				<i class="mask_warn"></i>
				<span class="mask_warn_bottom"></span>
				<p class="mask_text"></p>
				<div class="mask_btm">
					<a href="javascript:;" tag="close">我知道了</a>
				</div>
			</div>
		</div>
	</div>
<!-- 转盘抽奖模块 E -->

<!-- 活动规则模块 S -->
	<!-- rule display -->
	<div id="drawrule_ms" class="msbox" style="display: none;">
		<div class="rulebox_info">
			<p class="rulebox_tit">活动规则</p>
			<div class="rulebox_rule">
				<dl>
					<dd>
						<p>【活动时间】</p>
						<p>2018年1月1日00:00:00-2019年1月1日00:00:00</p>
						<p>【参与方式】</p>
						<p>1.用户点击转盘按钮抽奖，即有机会抽到实物奖品和优惠券；</p>
						<p>2.用户每日可参与的次数为1次，活动期间用户中奖次数无上限；</p>
						<p>3.若不同的微信、手机号等绑定同一个小站账号多次参与活动的，以最早参与活动的账号为有效账号，其余账号视为无效，小站将保证您在填写领奖事宜的任何个人资料不外泄。</p>
						<p>【其他说明】</p>
						<p>1.用户可以在本页面头部的【我的奖品】中查询自己的中奖信息；</p>
						<p>2.所有奖品数量有限，发完即止；小站可根据活动实施情况，适时增加/调整奖品的种类和数量，具体调整以实时页面显示为准；</p>
						<p>3.发放实物奖品前，小站有权要求用户提供其身份证、护照、参与活动小站帐号等证明用户符合本活动规则的材料信息，如用户所提供的信息不真实、不完整、失效或不合法的，京东可不发放奖品。中奖后，用户需要在15天内填写完整地址及联系方式信息，否则视为用户放弃奖品。奖品会在用户中奖并填写完整地址信息后的1个月内发出，如果用户在中奖1个月后仍未收到奖品，请及时联系客服申诉，申诉时效为用户中奖后2个月内，若用户未产生申诉行为，即视为用户放弃奖品；</p>
						<p>4.本活动所发放的优惠券不得提现，不得转赠他人，不得为他人付款，活动期间，使用优惠券的订单如发生取消订单、退货、退款，该优惠券即作废；</p>
						<p>5.优惠券在指定时间范围内按照规则抵扣现金使用，优惠券使用时间及可使用范围可在【个人中心-我的优惠券】中查看具体使用详情。本活动优惠券仅限于单笔订单，同一订单不可叠加使用，且订单上的商品需同时满足用券要求；</p>
						<p>6.优惠券只限普通消费者获得，一经发现渠道商、经销商违规获取，京东有权取消其获奖资格或购买资格；</p>
						<p>7.用户在参与活动过程中，如果出现违规行为（如作弊领取、恶意套取、刷信誉等），小站平台有权将取消用户获得本次活动涉及的实物奖品、优惠券以及使用优惠券的资格，并有权撤销违规交易，收回优惠券（含已使用的及未使用的）；如给小站造成损失的，小站保留向违规用户继续追索的权利。</p>
					</dd>
				</dl>
			</div>
			<div class="rule_btm_one"><a href="javascript:;" tag="close">我知道了</a></div>
		</div>

	</div>
	
		<!--  -->
<!--  中奖项目排行-->
	<div class="chance_module" style="display: none;">
	 	<div class="chance_wrap">
	 		<div class="txt_wrap hide" style="color:#478854">
	            <span class="wheel_txt">您还有</span>
	            <span class="wheel_chance" style="color:#daa35f"></span>
	            <span class="wheel_txt">次抽奖机会</span>
          </div>
	 	</div>
	 	<!-- <div class="winning_list_wrap">
	 		<div class="winning_list">
	 			<div class="win_slide">
	 				<ul class="win_slide_list">
	 					<li><span>j***o</span><span>抽到</span><span>3个xx</span></li>
						<li><span>z***2</span><span>抽到</span><span>3个xx</span></li>
						<li><span>c***3</span><span>抽到</span><span>3个xx</span></li>
						<li><span>x***C</span><span>抽到</span><span>3个xx</span></li>
						<li><span>O***</span><span>抽到</span><span>3个xx</span></li>
				        <li><span>v***w</span><span>抽到</span><span>3个xx</span></li>
						<li><span>Z***0</span><span>抽到</span><span>3个xx</span></li>
	 					<li><span>小***</span><span>抽到</span><span>3个xx</span></li>
	 					<li><span>p***3</span><span>抽到</span><span>3个xx</span></li>
	 					<li><span>j***k</span><span>抽到</span><span>3个xx</span></li>
	 					<li><span>原***0</span><span>抽到</span><span>3个xx</span></li>
	 					<li><span>j***n</span><span>抽到</span><span>3个xx</span></li>
	 				</ul>
	 			</div>
	 		</div>
	 	</div> -->
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

	
<script src="__PUBLIC__/view_res/mobile/js/prize.js"></script>
<script src="__PUBLIC__/view_res/mobile/js/jQueryRotate.2.2.js"></script>
<script src="__PUBLIC__/view_res/mobile/js/jquery.easing.min.js"></script>

<script>
	// 转盘抽奖设置
	var speed,n,io,draw_bg,draw_btn;
	speed = 1800;
	n=1;
	io=true;
	draw_bg = $('.draw_bg');
	draw_btn = $('.lottery_btn');
	$(document).ready(init);

	function init(){
		draw_btn.click(start);
		draw_bg.css({
			'transition':'all '  + speed  + 'ms',
		});
	}

	function start(){
		if(!io){return;}
		io = false;
		n++;
		$.ajax({
			url: '<?php echo url("Discount/reward"); ?>',
			type: 'POST',
			dataType: 'json',
			async:false,
			success:function(data){
				console.log(data);
				var $obj = JSON.parse(data);
				var deg = $obj.angle+ 15  - n*720;
				console.log(deg);
				draw_bg.css({
					'transform':'rotate('+deg+'deg)',
					'-webkit-transform':'rotate('+deg+'deg)', //
				});

				setTimeout(function(){
					var prize = $obj.prize;
					console.log(prize);
					io = true;//重新让开关打开
					var level = '';
					level +='<div class="maskbox">'+'<i class="mask_warn">'+'</i>'+'<span class="mask_warn_bottom">'+'</span>'+'<p class="mask_text" style="text-align: center;">'+prize+'</p>'+'<div class="mask_btm">'+'<a href="javascript:;" tag="close" class="close">'+'我知道了'+'</a>'+'</div>'+'</div>';
					$('.mask').show();
					$('.mask').empty();
					$('.mask').append(level);
					$('.mask_btm').click(function(event){
						$('.mask').hide();
					});
				
				}, speed  );

			}
		});
	}
</script>	
<script>
	var wining_go = $('.win_slide_list');
	function autoScroll(){
		wining_go.animate({
			marginTop : "-48px"},
			3000, function() {
			$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
		});
	}
    $(function(){
    	var scroll = setInterval('autoScroll("wining_go"),3500');
    	wining_go.hover(function() {
    		 clearInterval(scroll);
    	}, function() {
    		 scroll=setInterval('autoScroll("wining_go")',1500);
    	});
    })
</script>


</html>