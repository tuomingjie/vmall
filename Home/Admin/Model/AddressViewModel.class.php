<?php
/*
  * 网站后台订单Model类
  */
namespace Admin\Model;
use Think\Model\ViewModel;
Class AddressViewModel extends ViewModel{
	 public $viewFields = array(     
	  'Address'=>array('address_id','address_name','address_phone','address_content','address_post','address_lock'),     
	  'User'=>array('user_name','_on'=>'Address.user_id=User.user_id'),
	);		 		
}

