<?php



		//$state = $_GET['state'];
		//$out_trade_no = $_GET['ORDERSEQ'];
		$fi='log.txt';
	
		$sj = date('Y-m-d H:i:s').'    |'.$out_trade_no;
		
		file_put_contents($fi,$sj,FILE_APPEND);
	/*	if($state == 0){
			$url = 'http://jfshop.gxwdbg.com/mobile/payment/yjfpaynotify';						
			}
		}else{
			die('支付失败');
		}

		function curl_post($url,$post_data)
			{
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, $url);
				//curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

				$output = curl_exec($ch);
				curl_close($ch);

				
			}*/
?>