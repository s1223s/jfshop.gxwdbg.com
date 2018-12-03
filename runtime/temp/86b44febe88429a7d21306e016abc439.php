<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:44:"./oscshop/mobile\view\pay_success\index.html";i:1512008342;}*/ ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="__PUBLIC__/jquery-weui/dist/lib/weui.min.css" type="text/css" rel="Stylesheet" />
    <title>下单成功</title>
</head>
<body>
	<div class="weui_msg">
	    <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
	    <div class="weui_text_area">
	        <h2 class="weui_msg_title">下单成功</h2>	      
	    </div>
	    <div class="weui_opr_area">
	        <p class="weui_btn_area">
	            <a href="<?php echo url('/mobile'); ?>" class="weui_btn weui_btn_primary">继续购物</a>
	        </p>
	    </div>
	   <div class="weui_opr_area">
	        <p class="weui_btn_area">
	            <a href="<?php echo url('Order/index'); ?>" class="weui_btn weui_btn_primary">查看订单</a>
	        </p>
	    </div>
	</div>

</body>
</html>
