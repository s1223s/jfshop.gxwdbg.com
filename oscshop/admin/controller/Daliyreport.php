<?php
namespace osc\admin\controller;
use osc\common\controller\AdminBase;
use thinkphp\Db;


class daliyreport extends  AdminBase{
	public function index(){
		
		$con=mysqli_connect("localhost","root","19870214?liyu","smk"); 
		$heada = '0053600003000060220000000008002038000000C00004';//固定参数
		$transaction = '800000';
		//$serialnumber = 
		$data = date('Ymd');
		$time = date('his');
		$samnumber = '450100012008';
		$serialnumber = $data.$time.'450100012008000000';
		$long1 = '0010';
		$Recipienttype = '103003    ';	//网点编码
		
		$a = $heada.$transaction.$serialnumber.$time.$data;
		$b = $samnumber.$samnumber;
		$e = $a.bin2hex($b).$long1.bin2hex($Recipienttype);
		$Sendmessage = pack("H*",$e);
		$czsqf = $this->socket($Sendmessage);
		$quota = substr($czsqf,116,8);
		$quota = number_format($quota);


		$value = "SELECT * FROM log where to_days(time) = to_days(now())";
		$result = $con->query($value);

		$sw = "SELECT * FROM switch where id  = '1'";
		$abc = $con->query($sw);
		$abc = mysqli_fetch_array($abc);
		$btn = $abc['status'];

		$data = array();
		while ($row = mysqli_fetch_assoc($result)) {
		    $data[] = $row;
		}

		//计算当日的总充值量
		$sum = 0;
		foreach($data as $v){
		  $sum += (int) $v['amount'];
		}
		$sum = number_format($sum/100);
		
		




		//计算各个站点的月总充值量


		$z = array();
		for ($i= 0; $i <= 19; $i++) { 
			
			$a = dechex($i);
				foreach($data as $v){
					if($i <= 15)
					{//echo '45010001200'.strtoupper(dechex($i));
						if($v['psamid'] == '45010001200'.strtoupper(dechex($i)))
						  {
							  
						  	$z[$i] += ((int) $v['amount'])/100;
						  }
					}
					if($i >= 16){
						//echo '4501000120'.$i;
						if($v['psamid'] == '4501000120'.strtoupper(dechex($i)))
						  {
							
						  	$z[$i] += ((int) $v['amount'])/100;
						  }
					}
				  
			}
		}
		//echo 1;
		
	//print_r($z);
		
		$this->assign('btn',$btn);
		$this->assign('z',$z);
		$this->assign('sum',$sum);
		$this->assign('quota',$quota);
		return $this->fetch();
	}
	public function quota(){

	}

	public function switch(){
		$btn = input('post.btn');
		$con=mysqli_connect("localhost","root","19870214?liyu","smk");
		
		if ($btn == 'on') {
			$value = "UPDATE switch SET status = 'off'";
		}else{
			$value = "UPDATE switch SET status = 'on'";
		}
		
		$result = $con->query($value);
		$sw = "SELECT * FROM switch where id  = '1'";
		$abc = $con->query($sw);
		$abc = mysqli_fetch_array($abc);
		//print_r($abc['status']);
		if($abc['status'] == 'on'){
			return['success'=>'已开启充值'];
		}else{
			return['error'=>'已关闭充值'];
		}
		
		//var_dump($abc);
	}

	public function Amount()
	{

		//ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
		//set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
		//$interval=60*30;// 每隔半小时运行
		$interval = 15;
		$con=mysqli_connect("localhost","root","19870214?liyu","smk"); 

			$sw = "SELECT * FROM switch where id  = '1'";
			$abc = $con->query($sw);
			$abc = mysqli_fetch_array($abc);
			if($abc['status'] == 'on'){
				$heada = '0053600003000060220000000008002038000000C00004';//固定参数
				$transaction = '800000';
				//$serialnumber = 
				$data = date('Ymd');
				$time = date('his');
				$samnumber = '450100012008';
				$serialnumber = $data.$time.'450100012008000000';
				$long1 = '0010';
				$Recipienttype = '103003    ';	//网点编码
				
				$a = $heada.$transaction.$serialnumber.$time.$data;
				$b = $samnumber.$samnumber;
				$e = $a.bin2hex($b).$long1.bin2hex($Recipienttype);
				$Sendmessage = pack("H*",$e);
				$czsqf = $this->socket($Sendmessage);
				$quota = (int)substr($czsqf,116,8);
				//echo $quota = number_format($quota);
				if ($quota <= '8000') {
						$value = "UPDATE switch SET status = 'off'";
						$result = $con->query($value);
						$fi='log.txt';
		    			echo $s = $data.$data.'关闭充值   ';
		    			file_put_contents($fi,$s,FILE_APPEND);
		    			unset($result);
		    			unset($s);
					}else{
						$fi='log.txt';
		    			echo $s = $data.$time.'检查额度  ';
		    			file_put_contents($fi,$s,FILE_APPEND);
						unset($s);
						//echo '额度充足';
					}
				}
		//sleep($interval);
		//file_get_contents($url);
	}
	

}?>