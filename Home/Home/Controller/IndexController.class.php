<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
		
		
		 /* $user_id  = 1;
		 $save_info['user_name'] = "测试的";
		 session(C("USER_ID"),$user_id);
		 session(C("USER_INFO"),$save_info); */
		
		//首页广告图
		$ad = M('ad');
		$ad_info = $ad->where(array('index_sale_area'=>1))->select();
		$this->ad_info = $ad_info;
	
		
		

		$Sale = M('IndexSale');
		
		//头部信源热销产品
		
		$topHot = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='topHot'")->select();
		$this->topHot=$topHot;
		
		
		//新品上市
		
		$newProduct = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='newProduct'")->select();
		$this->newProduct=$newProduct;
		
		
		//年历 新春礼包类商品
		
		$calendarlist = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='calendar'")->select();
		$this->calendarlist=$calendarlist;

		
		//信源热销产品
		$Hotlist = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='hot'")->select();
		$this->Hotlist=$Hotlist;
		

		
		//家居&小电器
		$homeFurnishinglist = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='homeFurnishing'")->select();
		$this->homeFurnishinglist=$homeFurnishinglist;

		//数码产品
		$numericalCodelist = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='numericalCode'")->select();
		$this->numericalCodelist=$numericalCodelist;
		
	

		//品牌信息
		
		$brand = M('brand');
		$brand_list = $brand->order(array('brand_sort','brand_id'=>'desc'))->limit(16)->select();
		$this->brand_list = $brand_list;
		

		//品牌专区
		$brand_goods_list = $Sale->join('__GOODS__ ON vmall_index_sale.goods_id=__GOODS__.goods_id')->where("index_sale_area='brand'")->limit(5)->select();
		$arr = final_price_list($brand_goods_list);	//获取最终价格
		
		$this->brand_goods_list=$arr;

		
		
		
		//友情链接
		$Index = M('link');

		$Linklist = $Index->select();
		

		$this->links=$Linklist;

		
		//头信息
		$header_info = array(
			'title'=>'首页',
			'key'=>'',
			'desc'=>''
		);
		$this->header_info = $header_info;

	  
	  
		$this->display();
	  
	}
	

	
	
}