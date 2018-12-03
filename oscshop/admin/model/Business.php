<?php
namespace osc\admin\model;
use think\Db;


/**
* 
*/
class Business
{
	public function validate($data){
		$error=array();
		if(empty($data['shopAccount'])||empty($data['shopName'])||empty($data['enterpriseName'])||empty($data['linkPerson'])||empty($data['linkMobilephone'])||empty($data['mailingAddress'])){
			$error['error']='店铺基本信息不足';
		}elseif(empty($data['legalPerson'])||empty($data['licenceCode'])){
			$error['error']='店铺资质信息不足';
		}

		if($error){
			return $error;				
		}
	}
	public function add_merchants($data){

		$merchants['merchant_account'] = $data['shopAccount'];
		$merchants['merchants_name'] = $data['shopName'];
		$merchants['company_name'] = $data['enterpriseName'];
		$merchants['contacts'] = $data['linkPerson'];
		$merchants['contact_number'] = $data['linkMobilephone'];
		$merchants['contact_address'] = $data['mailingAddress'];
		//$merchants['fixed_telephone'] = $data['linkFixphonefax'];
		//$merchants['E-mail'] = $data['eamil'];
		
		$merchants['artificial_person'] = $data['legalPerson'];
		//$merchants['business_license _number'] = $data['licenceCode'];
		//$merchants['ID_card'] = $data['legalCard'];	

		$goods_id=Db::name('merchants')->insert($merchants);
	}
}
?>