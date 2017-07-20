<?php
	/*
   *个人中心主页控制器
   *
   */
namespace Home\Controller;
use Think\Controller;
class OrderCenterController extends CommonController {
    public function index(){
	
		  //判断用户是否登录;没有登录就跳转到登录页
		  $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
		  //登录了;就判断用户的信息
		  $user_info=M('User')->where(array('user_id'=>$user_id))->select();

			
		  //引入数据分页进行处理
		 

		  $order_info=D('OrderView');
		  $count      = $order_info->where(array('user_id'=>$user_id))->count();
		  $Page       = new \Think\Page($count,25);
		  $show       = $Page->show();
		  $list = $order_info->where(array('user_id'=>$user_id))->order('order_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();$this->assign('list',$list);
		  //dump($list);
		  //分配到前台显示
		 
		
		  foreach($list as $li){
		     $list_array[$li['order_id']]=array('order_id'=>$li['order_id'],'order_no'=>$li['order_no'],'order_time'=>$li['order_time'],'order_total_money'=>$li['order_total_money'],'order_status'=>$li['order_state'],'goods'=>array());
			 $list_array[$li['order_id']]['goods'][]=array('goods_name'=>$li['goods_name'],'goods_price'=>$li['goods_original_price'],'goods_num'=>$li['order_desc_num'],'goods_pic'=>$li['goods_tiny_pic'],'goods_id'=>$li['goods_id']);
			
		  
		  }
		  
		
		 
		  $this->list=$list_array;
		  $this->show=$show;

        //友情链接
        $Index = M('link');

        $Linklist = $Index->select();


        $this->links=$Linklist;
			
		  $this->display();
    }
	  //收货的控制方法
	public function  receOrder(){
	      //收货的id
		  $order_status=0;
		  
	      $order_id=I("post.order_id");
		  if(empty($order_id)){
		      
			  $order_status=0;
		  
		  }else{
		      $order_info=M('Order')->where(array('order_id'=>$order_id))->save(array('order_state'=>'已收货'));
			  if($order_info){
			      $order_status=1;
			  }else{
			     $order_status=0;
			  }
		  
		  }
	
	     echo $order_status;
	}
	
	public function comment(){
	     //商品评价
		   $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
		 
		  $order_id=I('get.order_id');
		  $order_info=D('OrderView')->where(array('order_id'=>$order_id))->select();
		 
		 
		  $this->order_info=$order_info;
		  
		 
		 
		 
		 $this->display();
	
	
	
	
	}
	
	public function doComment(){
	     //进行商品评论
		  $comment_status=0;
		  $user_id=session(C("USER_ID"));
		  
		  $order_id=I("post.order_id");
		  $goods_id=I("post.goods_id");
		  $comment_value=I("post.comment_value");
		  $comment_score=I("post.comment_scroe");
		  
		  if(empty($order_id)||empty($goods_id)||empty($comment_value)||$comment_score<0){
		      $comment_status=0;
		  
		  }else{
		      $data['user_id']=$user_id;
			  
			  $data['goods_id']=$goods_id;
			  $data['comment_content']=$comment_value;
			  $data['comment_score']=$comment_score;
			  $data['comment_time']=time();
			   //进行评论插入
			   
			  $comment_info=M("Comment")->add($data);
			  
			  //判断是否成功
			  if($comment_info){
			      M("Order")->where(array('order_id'=>$order_id))->save(array('order_state'=>'已评论'));
				  $comment_status=1;
			  }else{
			  
			     $comment_status=0;
			  }
			  
		  
		  
		  
		  }
	
	     echo  $comment_status;
	
	
	
	}
	

	
	
}