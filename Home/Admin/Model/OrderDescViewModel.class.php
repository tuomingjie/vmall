<?php
/*
  * 网站后台订单详情Model类
  */
namespace Admin\Model;
use Think\Model\ViewModel;
Class OrderDescViewModel extends ViewModel{
	 public $viewFields = array(     
	 'Order_desc'=>array('order_desc_id','order_desc_num','supply_num','supply_price','supply_total','courier_number','order_desc_state'),     
	 'Goods'=>array('goods_no','_on'=>'Order_desc.goods_id=Goods.goods_id'),     
	 'Orde'=>array('order_id','_on'=>'Order_desc.order_id=Orde.order_id','_table'=>"__ORDER__"),
	);		 		
}