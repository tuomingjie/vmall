<?php
/*
  * 网站后台订单Model类
  */
namespace Admin\Model;
use Think\Model\ViewModel;
Class OrderViewModel extends ViewModel{
	 public $viewFields = array(     
	  'Orde'=>array('order_id','order_no','order_time','order_money','order_state','order_total_money','_table'=>"__ORDER__"),     
	  'Address'=>array('address_name','address_content','_on'=>'Orde.address_id=Address.address_id'),     
	  'User'=>array('user_name','_on'=>'Orde.user_id=User.user_id'),
	  'Express'=>array('express_name','express_money','_on'=>'Orde.express_id=Express.express_id'),
	  'Order_payment'=>array('order_payment_content','_on'=>'Orde.order_payment_id=Order_payment.order_payment_id'),
	);		 		
}

