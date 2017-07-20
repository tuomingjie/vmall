<?php
    /*
	 *这是订单付款界面控制器
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class OrderPaymentController extends Controller {
       public function index (){
	      //获取order_id   
		  
		  $order_id=I("get.order_id");
		  
		  //判断用户是否登录
		  $user_id=session(C("USER_ID"));
		  
		  if(empty($user_id)){
		      $this->redirect('Login/index');
			  exit;
		  }
		  if(empty($order_id)){
		      
			 $this->redirect('Index/index','',4, '未找到订单!页面跳转中...'); 
			  exit;
		  
		  }
		  
		  //判断订单是否存在
		  
		  $order_info=M('Order')->where(array('order_id'=>$order_id,'user_id'=>$user_id))->select();
		  if(empty($order_info)){
		      $this->error("订单未找到");
			  exit;
		  }
		  
		  //找到订单进行处理
		  
		  $address_id=$order_info[0]['address_id'];
		  
		  $address_info=M("Address")->where(array('address_id'=>$address_id))->select();
		  
		  //取余额
		  
		  $money=M("User")->where(array('user_id'=>$user_id))->field('user_money')->select();
		  
		  //保存订单id到session中
		  
		 session(C("USER_ORDER_ID"),$order_id);
		
		 $this->order_info=$order_info[0];
		 $this->address_info=$address_info[0];
		 $this->money=$money[0]['user_money'];
		 $this->express_money=number_format(($order_info[0]['order_total_money']-$order_info[0]['order_money']),2);
		  
	      
		  
		  
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	     $this->display();
	   }
}   