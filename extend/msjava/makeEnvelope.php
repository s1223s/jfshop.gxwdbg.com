<?php
namespace msjava;

require_once("php_java.php");//引用LAJP提供的PHP脚本

final class makeEnvelope
{
	public static function menvelope($base64SourceData)
	{
		try
		{
		   
		   
		   $signAlg = 'SM4/CBC/PKCS7Padding';
		   $base64CertData = 'TUlJQ2x6Q0NBanVnQXdJQkFnSUZFQ1lVSnhBd0RBWUlLb0VjejFVQmczVUZBREFsTVFzd0NRWURWUVFHRXdKRApUakVXTUJRR0ExVUVDZ3dOUTBaRFFTQlRUVElnVDBOQk1UQWVGdzB4TlRBek1qWXdOakV3TXpGYUZ3MHlNREF6Ck1qWXdOakV3TXpGYU1JR0RNUXN3Q1FZRFZRUUdFd0pEVGpFU01CQUdBMVVFQ2d3SlEwWkRRU0JQUTBFeE1RMHcKQ3dZRFZRUUxEQVJEVFVKRE1Sa3dGd1lEVlFRTERCQlBjbWRoYm1sNllYUnBiMjVoYkMweE1UWXdOQVlEVlFRRApEQzB3TXpBMVFEY3hNREF3TVRnNU9EaEE1THFrNXBpVDZaTzI2S0dNVURKUTZMV0U2WWVSNW9tWTU2NmhRREV3CldUQVRCZ2NxaGtqT1BRSUJCZ2dxZ1J6UFZRR0NMUU5DQUFRMjR6c09pTmNORUxvU2RxQ3RYMktuMHBwSUpVWjIKMldtS2NVN1BheXgwTTd0cFhZMnA2T1pVYUF6RGtQci9LYzRwblRBbk1OdzR5U3VGbjVudXhIeW1vNEgyTUlIegpNQjhHQTFVZEl3UVlNQmFBRkZ5VFdDQmFKSE5XRUJ0a1VCRHM2YWZLQjBFUk1Bd0dBMVVkRXdRRk1BTUJBUUF3ClNBWURWUjBnQkVFd1B6QTlCZ2hnZ1J5Rzd5b0JBVEF4TUM4R0NDc0dBUVVGQndJQkZpTm9kSFJ3T2k4dmQzZDMKTG1ObVkyRXVZMjl0TG1OdUwzVnpMM1Z6TFRFMExtaDBiVEEzQmdOVkhSOEVNREF1TUN5Z0txQW9oaVpvZEhSdwpPaTh2WTNKc0xtTm1ZMkV1WTI5dExtTnVMMU5OTWk5amNtd3hNVFF3TG1OeWJEQUxCZ05WSFE4RUJBTUNBK2d3CkhRWURWUjBPQkJZRUZCQTkxSDVCL29zTkxMM2RZNEJCMTNjakxsLzJNQk1HQTFVZEpRUU1NQW9HQ0NzR0FRVUYKQndNQ01Bd0dDQ3FCSE05VkFZTjFCUUFEU0FBd1JRSWdPSW9md1NtU2JrU3U1akp3MTdvK1g3SktjSC9OcFgrUApVdmxzczdsZTJYVUNJUUNHSFRHcXI3NkhkcUNYMHVra3Q3T1JtcG1lcGNUcERHNW5nOVFXNERxdEF3PT0=';
		   $ret = lajp_call("cfca.sadk.api.EnvelopeKit::envelopeMessage",  $base64SourceData,$signAlg, $base64CertData);
		   return $ret;
		}
		catch(Exception $e)
		{
		  echo "Err:{$e}<br>";
		}
	}
}
?>