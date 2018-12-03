<?php

 
namespace osc\mobile\controller;
use osc\mobile\validate\Address;
use \think\Db;
class Merchant extends MobileBase
{
	
	
	function index(){

		$tree= new \oscshop\Tree();

		$this->assign('category',$tree->toOdArray(Db::name('category')->field('id,pid,name')->order('sort_order asc')->select()));

		$this->assign('SEO',['title'=>'店铺-'.config('SITE_TITLE')]);
		
		$this->assign('SEO',['title'=>'店铺-'.config('SITE_TITLE')]);
		$this->assign('top_title','商家店铺');
		$this->assign('flag','search');
		$id=input('id');

		$list = Db('merchants')->where('merchant_id',$id)->select();
		//dump($list);
		//echo $list[0]['merchants_name'];

		$this->assign('merchantname',$list[0]['merchants_name']);
		$this->assign('merchantid',$id);
		return $this->fetch();

		
		//print_r($id);
		//osc_goods()->get_goods_info((int)input('merchantid.id'))
		
		//return $this->fetch();
	}
	
	//
	function get_merchant(){



		$id=input('id');
		
		
		$list = Db::view('Goods','goods_id,image,name,price,merchantNo')
				->where(array('Goods.status'=>1,'Goods.merchantNo'=>$id))->select();
	

		$this->assign('goods',$list);
		
	
		exit($this->fetch('goods'));

	
	}
	
		
	
}
