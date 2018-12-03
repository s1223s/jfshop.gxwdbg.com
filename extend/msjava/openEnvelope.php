<?php
namespace msjava;

require_once("php_java.php");//引用LAJP提供的PHP脚本

final class openEnvelope
{
	public static function oenvelope($base64EnvelopeData)
	{
		try
		{
		   
		   $signAlg = 'SM4/CBC/PKCS7Padding';
		   $base64P12Data = 'TUlJREJRSUJBVEJIQmdvcWdSelBWUVlCQkFJQkJnY3FnUnpQVlFGb0JEQS9YWlE2V3h6Nm1ycGJwV05wWWtwOEt0ZHRtbGw2aEI4YQp6ZFhpc3lOeEVNM0MrSEtFb3kvOTlYRnVINUQzaVJRd2dnSzFCZ29xZ1J6UFZRWUJCQUlCQklJQ3BUQ0NBcUV3Z2dKRW9BTUNBUUlDCkJSQ1JGWWNrTUF3R0NDcUJITTlWQVlOMUJRQXdKVEVMTUFrR0ExVUVCaE1DUTA0eEZqQVVCZ05WQkFvTURVTkdRMEVnVTAweUlFOUQKUVRFd0hoY05NVGN3TlRFeU1EY3lNekl3V2hjTk1qSXdOVEV5TURjeU16SXdXakNCaGpFTE1Ba0dBMVVFQmhNQ1EwNHhFakFRQmdOVgpCQW9NQ1VOR1EwRWdUME5CTVRFTk1Bc0dBMVVFQ3d3RVEwMUNRekVaTUJjR0ExVUVDd3dRVDNKbllXNXBlbUYwYVc5dVlXd3RNVEU1Ck1EY0dBMVVFQXd3d01ETXdOVUE0T1RFME5UQXhNRE13T1RVeE1USXdOak5FUUVFd01EQXhNakF4TnpBMU1EQXdNREF3TVRBNE1FQXgKTUZrd0V3WUhLb1pJemowQ0FRWUlLb0VjejFVQmdpMERRZ0FFeFEvNmxQZFhjYkl4YmpjeUNlUmFxTlI3dEJkaU9rc0QraXo0d2p0bApVL0hFYlRrUDByYmdZb1V0SWNMUEF1MmMwTkZTMXlQUjNxQTZRQ2xneXZnb09LT0IvRENCK1RBZkJnTlZIU01FR0RBV2dCUmNrMWdnCldpUnpWaEFiWkZBUTdPbW55Z2RCRVRCSUJnTlZIU0FFUVRBL01EMEdDR0NCSElidktnRUJNREV3THdZSUt3WUJCUVVIQWdFV0kyaDAKZEhBNkx5OTNkM2N1WTJaallTNWpiMjB1WTI0dmRYTXZkWE10TVRRdWFIUnRNQWtHQTFVZEV3UUNNQUF3TmdZRFZSMGZCQzh3TFRBcgpvQ21nSjRZbGFIUjBjRG92TDJOeWJDNWpabU5oTG1OdmJTNWpiaTlUVFRJdlkzSnNOall4TG1OeWJEQUxCZ05WSFE4RUJBTUNBK2d3CkhRWURWUjBPQkJZRUZKZVdnYWtkVy84dEk3d05ZY1k2RWdvRmtQbEZNQjBHQTFVZEpRUVdNQlFHQ0NzR0FRVUZCd01DQmdnckJnRUYKQlFjREJEQU1CZ2dxZ1J6UFZRR0RkUVVBQTBrQU1FWUNJUUN0NGVyWUxSR3VYa0psMFVrNVJ5R3VhVE96RnZ3ckRoakhpU3c5T05PMwp4QUloQUlvQ1ExRmdqTWZQT1dxVE1SV2l0cHZrZkFpNWVCeEJTVVkzdVArb2lrdlg=';
		   $p12Password = '348752';
		 
		   $ret = lajp_call("cfca.sadk.api.EnvelopeKit::openEvelopedMessage",  $base64EnvelopeData,$signAlg, $base64P12Data, $p12Password);
		   return $ret;
		}
		catch(Exception $e)
		{
		  echo "Err:{$e}<br>";
		}
	}
}
	?>
