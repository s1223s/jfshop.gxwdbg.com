<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:40:"./oscshop/mobile\view\product\index.html";i:1516267436;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="__PUBLIC__/view_res/mobile/css/pro-list.css" type="text/css" rel="Stylesheet" />
	</head>

	<body>
		<div class="contrain product">
			<!--------------content start ------------->
			<div class="a-limit">
				<img src="__PUBLIC__/view_res/mobile/images/block.png" style="width: 18px;vertical-align: middle;">
				<span style="color: #e92826;vertical-align: middle">
					限时抢购
				</span>
			</div>
			<ul class="product-list">
				<li>
					<a href="">
						<div class="img-box">
							<img src="__PUBLIC__/view_res/mobile/images/product.jpg">
						</div>
						<div class="word-box">
							<p>
								歌璐极简长款连帽女式羽绒服
							</p>
							<div id="CountMsg" class="HotDate">
								<span id="t_d">0</span><span style="background: none;color: red;">:</span>
								<span id="t_h">00</span><span style="background: none;color: red;">:</span>
								<span id="t_m">00</span><span style="background: none;color: red;">:</span>
								<span id="t_s">00</span><span style="background: none;color: red;">结束倒计时！</span>
							</div>
							<div class="price">
								<span class="red-price">￥50.00</span>
								<span class="gray-price">￥250.00</span>
								<a href="" class="link">
									马上抢
								</a>
							</div>
						</div>
					</a>
				</li>
				
			</ul>

			<!--------------content end ------------->
		</div>
		<script>
			(function() {
				var _w = document.documentElement.clientWidth;
				if (_w > 640) _w = 640;
				//屏幕可视区域宽高w3c下全兼容 
				var _fontsize = (_w / 375) * 16;
				var style = document.createElement('style');
				console.log(_fontsize)
				style.type = 'text/css';
				style.innerHTML = 'html{font-size:' + _fontsize + 'px}';
				//document.getElementsByTagName('head').item(0).appendChild(style); 
				document.documentElement.style.fontSize = _fontsize + "px";
			})
			function getRTime() {
				var EndTime = new Date('2018/02/28 10:00:00'); //截止时间   
				var NowTime = new Date();
				var t = EndTime.getTime() - NowTime.getTime();
				var d = Math.floor(t / 1000 / 60 / 60 / 24);
				var h = Math.floor(t / 1000 / 60 / 60 % 24);
				var m = Math.floor(t / 1000 / 60 % 60);
				var s = Math.floor(t / 1000 % 60);
				document.getElementById("t_d").innerHTML = d ;
				document.getElementById("t_h").innerHTML = h ;
				document.getElementById("t_m").innerHTML = m ;
				document.getElementById("t_s").innerHTML = s ;
			}
			setInterval(getRTime, 1000);
		</script>
	</body>

</html>