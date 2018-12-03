<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./oscshop/mobile/view/discount/myprize.html";i:1543546435;s:38:"./oscshop/mobile/view/public/base.html";i:1516611140;s:41:"./oscshop/mobile/view/public/top-nav.html";i:1512008342;}*/ ?>
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
		 
<link href="__PUBLIC__/view_res/mobile/css/prize_list.css" type="text/css" rel="Stylesheet" />
<link href="__PUBLIC__/jquery-weui/dist/lib/weui.min.css" type="text/css" rel="Stylesheet" />

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
		
	<div class="listTopcaption">
<div class="holder">
    <a class="listTopArrow"  onclick="history.go(-1)"></a>
    <a class="listTopArrow home"  href="<?php echo url('/mobile'); ?>"></a>
    <p><?php echo $top_title; ?></p>
</div>
</div>
<div class="TopcaptionPos"></div>
 
	<header id="myPrize"></header>
	<div class="wrapper">
		<!-- <ul class="Prize_nav">
			<li><span>中奖时间</span></li>
			<li><span>抽奖奖品</span></li>
			<li><span>奖品状态</span></li>
		</ul> -->
	</div>
	<div class="Prize_content">
		<ul class="Prize_list">
			<!-- <div class="item">
				<span>2018-11-14 13:05:12</span>
				<span>优酷会员7天免广告</span>
				<span>已使用</span>
			</div> -->

<!-- frist 01 -->
<?php if(is_array($prize) || $prize instanceof \think\Collection || $prize instanceof \think\Paginator): $i = 0; $__LIST__ = $prize;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<div class="Prize_counp bred">
				<div class="counp_wrapp">
					<div class="Prize_logo"><img src="/public/static/view_res/mobile/images/new_index/red_bag.png" alt=""></div>
					<div class="Prize_detail fa8">
						<span class="prize_name"><?php echo $v['winning_prize']; ?></span>
						<span class="prize_useage"><?php echo $v['winning_time']; ?></span>
						<span class="splice"></span>
						<div id="prize_status"><span><?php echo $v['status']; ?></span></div>
					</div>
                    <a href="javascript:;" class="welfareTask_btn welfareTask_gold">点击领取</a>
				</div>
			</div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
<!--second 02  
			<div class="Prize_counp bff">
				<div class="counp_wrapp">
					<div class="Prize_logo"><img src="/public/static/view_res/mobile/images/new_index/music_counp.png" alt=""></div>
					<div class="Prize_detail 333">
						<span class="prize_name"><?php echo $prize[0][winning_prize]; ?></span>
						<span class="prize_useage"><?php echo $prize[0][winning_time]; ?></span>
						<span class="splice"></span>
						<div id="prize_status"><span><?php echo $prize[0][status]; ?></span></div>
					</div>
                     <a href="javascript:;" class="welfareTask_Btn welfareTask_red">点击领取</a>
				</div>
			</div>
		</ul>-->
		<!-- end 
	</div>-->


<!-- 抽奖结果发布区 -->
	<div class="myPrize_main" style="display: none;">
        <div>您还未抽中奖品呢~快去抽奖吧</div>
    </div>
    <div class="div" id="msgbox"></div>

    <!-- 留言浮窗============================================ -->
    <div class="contact" id="contact">
        <label for="" class="contacr_now" title="联系我们">留言</label>
    </div>

<script type="text/html" id="ddress">
    <div class="dia msgbox" box-type="dialog">
        <div class="diabox diabox_info">
            <p class="diabox_tit">请填写领奖信息</p>
            <ul class="fillIn_userInfo">
                <li>
                    <span>姓名</span>
                    <input type="text" placeholder="" tag="name"/ class="userName">
                </li>
                <li>
                    <span>手机号</span>
                    <input type="text" placeholder="" tag="phone"/ class="userPhone">
                </li>
                <li>
                    <span>收货地址</span>
                    <textarea rows="3" placeholder=""  tag="address" id="userAddress"></textarea>
                </li>
            </ul>
            <div class="ms_btm_two">
                <a href="javascript:;" tag="close">取消</a>
                <a href="javascript:;"  tag="confirm" id="confirm">确认提交</a>
            </div>
        </div>
    </div>
</script>
<!-- S 信息提交成功奖品将在一周内寄出-->
<div class="dia msgbox" id="submit_sub" style="display: none">
    <div class="diabox">
        <i class="dia_cure"></i>
        <p class="dia_text">信息提交成功<br>奖品将在一个月内寄出，请留意</p>
        <div class="dia_btm_one">
            <a href="javascript:;" tag="close">我知道了</a>
        </div>
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
        $(document).ready(init);
        function init(){
            var address = $('#ddress').html();

            $('#contact').click(function(e) {
                
                $('#msgbox').html(address);

                // 关闭-----
                $('.ms_btm_two a:eq(0)').click(function(){
                   $('#msgbox').find('.dia').hide();
                });

                // 提交确定
                $('.ms_btm_two a:eq(1)').click(function(){
                    // 信息提交成功！！！！
                    // 获取信息判断
                    var use_name = $('.fillIn_userInfo').find('.userName');
                        console.log(use_name)
                    var use_phone = $('.fillIn_userInfo').find('.userPhone');
                        console.log(use_phone)
                    var use_address = $('.fillIn_userInfo').find('#userAddress');
                        console.log(use_address)

                    if(use_name.val()&&use_phone.val()&& use_address.val() ==''){
                         $.toast("请完整填写信息！", 'text');
                    }else{
                        $.toast("提交成功！", function() {
                            $('#submit_sub').show();
                            $('#msgbox').find('.dia').hide();
                        });
                       $('.dia_btm_one').click(function(){
                            $('#submit_sub').hide();
                       });
                    }

                    
                });

                


            });/*模板引入*/


            // 领取券
            $(".welfareTask_Btn").click(function(event) {
                // if(){return false;}else{}判断用户是否登录
                $.toast("恭喜你，领取成功~","text");
                    $(".welfareTask_Btn").html('已领取');
                    $(".welfareTask_Btn").addClass('welfareTask_gray');
                
                
            });
            $(".welfareTask_btn").click(function(event) {
                // if(){return false;}else{}判断用户是否登录
                $.toast("恭喜你，领取成功~","text");
                    $(".welfareTask_btn").html('已领取');
                    $(".welfareTask_btn").addClass('welfareTask_gray');
                
                
            });

        }

        // <!-- 领取时间 -->
        $.ajax({
            url:'<?php echo url("Discount/partnerwrite"); ?>',
            type:'post',
            dataType:'json',
            success:function(){}
        })
    </script>

<!--  -->


</html>