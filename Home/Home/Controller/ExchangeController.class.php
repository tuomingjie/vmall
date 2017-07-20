<?php
	/*
   *个人中心退换货控制器
   *
   */
namespace Home\Controller;
use Think\Controller;
class ExchangeController extends Controller {
    public function index(){
		  //判断用户是否登录;没有登录就跳转到登录页
		  $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 2, '未登录,页面跳转到登录页面中...');
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
		  //计算用户的退换货商品到前台显示 
		  //$exchange=M("good_rollback")->where(array('good_rollback_id'=>$good_rollback_id,'good_rollback_state'=>'申请换货'))->select();
		  
		   $good_rollback=M("good_rollback")->select();
		   
		   $this->assign('rollback',$good_rollback);
		    //dump($good_rollback);
		  
         $this->display();
    }
	

	
	
}