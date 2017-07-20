<?php
    /*
	 *这是付款成功界面控制器
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class  PaymentController extends Controller {
	//支付宝支付
	public $objectpay;  //类里全局对象
	public function _initialize(){
		//取出默认支付方式
		import("Home.Util.Alipay"); //动态引入支付类，具体是哪个类根据获取的$platform_en决定
		$this->objectpay = new \Alipay();  //动态实例化类
	}
	
       public function index (){
	      $user_id=session(C("USER_ID"));
		  $order_id=session(C("USER_ORDER_ID"));
		  //判断用是否登录
		  if(empty($user_id)){
		      $this->redirect('Login/index','',3, '未登录,正在跳转到登录页...');
			  exit;
		  }
		   //判断是否找到订单id
		  if(empty($order_id)){
		     $this->error("付款失败!");exit;
		  }
		  //进行付款 用户的余额是否够付款
		  
		  $order_info=M('Order')->where(array('order_id'=>$order_id))->select();
		//  dump($order_info);die;
		    //订单总金额
		  $order_total_money=$order_info[0]['order_total_money'];
		  
		  $user_info=M('User')->where(array('user_id'=>$user_id))->select();
		  
		  $user_money=$user_info[0]['user_money'];
		    //判断余额是否够付款
			
		 if($user_money<$order_total_money){
		      
		     $this->objectpay->doalipay($order_info[0]['order_no'],"买家在下单哦",$order_total_money,"");
			 
		 }
		  
		 //进行付款处理   事务实现付款
		 
		 $user=M('User');
		 $user->startTrans();
		// $new_user_money=$user_money-$order_total_money;
		   //用户的积分增加
		 $user_score= $user_info[0]['user_score']+$order_total_money;
		 $user_status=$user->where(array('user_id'=>$user_id))->save(array('user_score'=>$user_score));
		// $order_status=M("Order")->where(array('order_id'=>$order_id))->save(array('order_state'=>'已付款'));
		    //判断两个是否都执行成功
		 if($order_status&&$user_status){
		      $user->commit();
			  //付款成功就显示到页面上
			  //把信息写到用户消费表
			  $user_payment['user_payment_money']="-".$order_total_money;
			  $user_payment['user_payment_why']="在线购买";
			  $user_payment['user_payment_time']=time();
			  $user_payment['user_id']=$user_id;
			  M('UserPayment')->add($user_payment);
			    //删除session中保存的order_id信息
				session(C("USER_ORDER_ID"),null);
			  //显示信息到前台去
			  
			  $this->order_no=$order_info[0]['order_no'];
			  $this->order_total_money=$order_info[0]['order_total_money'];
 
		 
		 }else{
		      //执行失败就回滚
		     $user->rollback();
			 $this->error('付款失败');
			 exit;
		 
		 }
		 

	     
		 $this->display();
		  
	   }
	   
    public function notifyurl(){
            $this->objectpay->notifyurl();
    }

    public function returnurl(){
            $this->objectpay->returnurl();
    }
   
    //成功返回的页面
    public function successinf(){
            $this->display();
    }
   //失败返回的页面
    public function errorinf(){
            $this->display();
    }
}   