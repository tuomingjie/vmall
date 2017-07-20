<?php
	/*
   *个人中心主页控制器
   *
   */
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function index(){
		  //判断用户是否登录;没有登录就跳转到登录页
		  $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
		  //登录了;就判断用户的信息
		  $user_info=M('User')->where(array('user_id'=>$user_id))->select();
		  
		  //计算用户的等级
          $user_score=$user_info[0]['user_score'];
		  //计算用户等级 <1000 level0    <2000 level1   <5000 levle4   >5000  level5
		  if($user_score<1000){
		      $user_level="icon-vip-level-0";
		  }elseif($user_score<2000){
		     $user_level="icon-vip-level-1";
		  }elseif($user_score<3000){
		     $user_level="icon-vip-level-2";
		  }elseif($user_score<4000){
		     $user_level="icon-vip-level-3";
		  }elseif($user_score<5000){
		     $user_level="icon-vip-level-4";
		  }elseif($user_score>=5000){
		     $user_level="icon-vip-level-5";
		  }else{
		      $user_level="icon-vip-level-0";
		  }
		  //分配到前台处理显示
		  $this->user_level=$user_level;
		  //分配用户名到前台
		  $this->user_info=array('user_name'=>$user_info[0]['user_name'],'user_score'=>$user_info[0]['user_score']);
		  //计算用户的商品到前台显示 //查找已付款的订单和收货需要评价的商品
		  $payment_order=M("Order")->where(array('user_id'=>$user_id,'payment_status'=>'1'))->select();
		  $payment_count=count($payment_order);
		  //查找已经收货的订单
//		  $finish_order=M("Order")->where(array('user_id'=>$user_id,'payment_status'=>'已收货'))->field('order_id')->select();
//		  $finish_order_id=array();
//		  foreach($finish_order as $finish){
//		     $finish_order_id[]=$finish['order_id'];
//		  }
//		  //查询需要评价的商品总数目
//		  $comment_goods=M('OrderDesc')->where(array('order_id'=>array('in',$finish_order_id)))->select();
//		  $comment_goods_count=count($comment_goods);
//		  $this->order_handle=array('order_count'=> $payment_count,'comment_goods_count'=> $comment_goods_count);
//
//
//
		  
		  
		  
          	  
		 
		  
         $this->display();
    }
	

	
	
}