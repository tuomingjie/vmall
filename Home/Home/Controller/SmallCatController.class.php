<?php
  /*
   * 这是个顶部微型购物车的控制器 主要是ajax的形式获取信息
   *
   */
namespace Home\Controller;
use Think\Controller;
class SmallCatController extends Controller {
      
     public function myShop(){
	     //这是我的商城的控制器
		 //看session是否保存有用户信息
		     $login_status=0;  //登录后的标志  0 未登录 1 登录
		     $user_id=session(C("USER_ID"));
		     $user_info=session(C("USER_INFO"));
		   //存在表示用户已经登录
		  if($user_id&&$user_info){
		      $login_status=1;
			  $user_name=$user_info['user_name'];
		      //去查用户用多时候score分
			  $score=M('User')->where(array('user_id'=>$user_id))->field('user_score')->select();
			  // <1000  0  <2000  1 <3000 2  <4000 3 <5000 4   >6000  5
			    if($score[0]['user_score']>=5000){
				    $user_level=5;
				}else if($score[0]['user_score']>=4000){
				    $user_level=4;
				}else if($score[0]['user_score']>=3000){
				    $user_level=3;
				}else if($score[0]['user_score']>=2000){
				    $user_level=2;
				}else if($score[0]['user_score']>=1000){
				    $user_level=1;
				}else{
				   $user_level=1;
				}
			   //计算需要评论和付款的订单
			   $unpay_count=M('Order')->where(array('user_id'=>$user_id,'order_state'=>'未付款'))->count();
			   $uncomment_count=M('Order')->where(array('user_id'=>$user_id,'order_state'=>'未评论'))->count();
			    
			  
		  }else{
		     $login_status=0;
		    
		  
		  }
		 $data['login_status']=$login_status;
		 $data['user_name']=$user_name;
	     $data['user_level']=$user_level;
		 $data['unpay_count']=$unpay_count;
		 $data['uncomment_count']=$uncomment_count;
	     echo json_encode($data);
		 
	 
	 
	 
	 }
	    
	 public function myGoods(){
	     //查询购物车中的商品
		  
		 $cat_status=0;  //标志0失败 1成功
		 $session_info=session(C("USER_CAT_INFO"));
		 
		$cart_model =  M('cart');
		$user_id=session(C("USER_ID")); 
		if(empty($user_id)){
			$user_id = 0;
		}
		
		$cart_info = $cart_model->where(array('user_id'=>$user_id))->select();
		
		
		 
		 
		 //判断购物车是否有商品
		 if($cart_info){
		     //如果存在就进行遍历想要的数据 对数据遍历想要的形式
			 $new_sort_goods=array();
			 foreach($cart_info as $info){
			    
			     $goods_id=$info['goods_id'];
				 //到数据查询要的信息 名字
			     $goods_info=M('Goods')->where(array('goods_id'=>$goods_id))->select();
				 if(!$goods_info){
				     continue;
				 }
				 $goods_info = final_price_list($goods_info);
				 $data['cart_id']=$info['cart_id'];
				 $data['goods_id']=$goods_id;
				 $data['goods_name']=$goods_info[0]['goods_name'];
				 $data['goods_tiny_pic']=$goods_info[0]['goods_tiny_pic'];
				 $data['goods_num']=$info['goods_num'];
				 $data['goods_price']=$goods_info[0]['final_price'];
				 $new_sort_goods[]=$data;
			 
			 }
             
			 //往前台显示
			
			 if(count($new_sort_goods)){
			      $cat_total_num=0; $cat_total_price=0;
			      foreach($new_sort_goods as $new_goods){
				    
			         $url=U('Product/index',array('g'=>$new_goods['goods_id']));
					 $tiny_pic="/vmallshop/Upload".$new_goods['goods_tiny_pic'];
					 
				 $str.=<<<EOF
				  <li class="minicart-pro-item"><div class="pro-info"><div class="p-img"><a href="{$url}" title="{$new_goods['goods_name']}" target="_blank"><img src="{$tiny_pic}" alt="{title}"></a></div><div class="p-name"><a href="{$url}" title="{$new_goods['goods_name']}" target="_blank">{$new_goods['goods_name']}&nbsp;<span class="p-slogan"></span><span class="p-promotions hide"></span></a></div><div class="p-price"><b>¥&nbsp;{$new_goods['goods_price']}</b><em>x</em><span>{$new_goods['goods_num']}</span></div><a href="javascript:;" class="icon-minicart-del" title="删除" >删除</a><input type="hidden" name="cart_id" value="{$new_goods['cart_id']}"></div>
						</li>
EOF;
                   $cat_total_num+=$new_goods['goods_num'];
				   $cat_total_price+=$new_goods['goods_num']*$new_goods['goods_price'];
			       
			 
			 
			 
			      }
			  
			     $cat_status=1;
			 }else{
			     
				 $cat_status=0;
			  
			 }
			
			
			 
 			 
			
			
		 
		 }else{
		     $cat_status=0;
		 }
	   
	     $cat_data['cat_status']=$cat_status;
		 $cat_data['content']=array('total_nums'=>$cat_total_num,'total_price'=>$cat_total_price);
		 $cat_data['info']=$str;
	   
	     echo json_encode($cat_data);
	 
	 
	 
	 
	 }
	 
	 public function delGoods(){
	     //删除商品 ajax实现
		   $del_status=0; //删除成功是否的标志 0失败 1成功
		  $cart_id=I('post.cart_id');
		  $cart_model = M('cart');
		  $user_id=session(C("USER_ID"));
		 
		  if(empty($cart_id)){
		     $del_status=0;
		  }else{
		     $data['cart_id'] = $cart_id;
			//获取购物车信息
			$cat_info = $cart_model->where($data)->select();
			if(!empty($cat_info)){
		      foreach($cat_info as $info){
			     if($info['user_id']==$user_id){
					 
					$del_check = $cart_model->where(array('cart_id'=>$info['cart_id']))->delete();
					if(!$del_check){
						$del_status=0; 
					}
				 }else{
					$del_status=0; 
				 }
			 
			 }
			 
			 
			 $del_status=1;
		  
		  }else{
		     $del_status=0;
		  }
			 
			
			$cart_info = $cart_model->where(array('user_id'=>$user_id))->select();
			 
			 //计算新的数目和总金额
			  $total_num=0;$total_money=0;
			  foreach($cart_info as $info){
			      $total_num+=$info['goods_num'];
				  $goods_info = M('goods')->where(array('goods_id'=>$info['goods_id']))->select();
				  $goods_info = final_price_list($goods_info);
				  $total_money+=$info['goods_num']*$goods_info[0]['final_price'];
			  
			  
			  }
		
			 $del_status=1;
			 
		  
		  
		  }
	 
	      $data['del_status']=$del_status;
		  $data['total_num']=$total_num;
		  $data['total_money']=$total_money;
		  echo json_encode($data);
	 
	 }
	 
	 
	 
	 
}