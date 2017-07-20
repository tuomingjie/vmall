<?php
    /*
	 *购物车控制器
	 */
namespace Home\Controller;
use Think\Controller;
class CartController extends CommonController {
      //购物车显示页
      public function index(){
		  //获取用户的id号
		  $user_id=session(C("USER_ID"));
		  $cart_model = M('cart');
		  $data['user_id'] = $user_id;
		  $cart_info = $cart_model->where($data)->select();

		 if(empty($cart_info)){
		     //如果为空就跳转到错误的界面
		     $this->display('error');
		 }else{
		    $this->display();
		 
		 }

	  
	  }
	  
	  
	  public function  cartContent(){
	       //购物车中的数据ajax的形式返回
		   $cart_status=0; //返回的标志  0 失败没有数据 1成功有数据
		   
		   //获取用户的id号
		  $user_id=session(C("USER_ID"));
		  $cart_model = M('cart');
		  $data['user_id'] = $user_id;
		  //获取购物车信息
		  $cat_info = $cart_model->where($data)->select();
		   
		       //进行有无数据判断
		   if($cat_info){
		       //如果有数据就处理数据 得到想要的数据
			   
			   //$car_detial_info=array();
			 
			  foreach($cat_info as $info){
				   $cart_id = $info['cart_id'];
			       $goods_id=$info['goods_id'];
				   //$goods_price=$info['goods_price'];
				   $goods_num=$info['goods_num'];
				   //到商品表取其他的数据
				   $goods_info=M("Goods")->where(array('goods_id'=>$goods_id))->select();
					
				   if(empty($goods_info)){
				       //如果取不到数据就执行下一条数据
				       continue;
				   }
				   $goods_info = final_price_list($goods_info);
				   
				   $goods_original_price=$goods_info[0]['goods_original_price'];	//原价价
				   $total_money=$goods_num*$goods_original_price;		//原价总金额
				   $goods_tiny_pic=$goods_info[0]['goods_tiny_pic'];	//小图
				   $goods_name=$goods_info[0]['goods_name'];			//产品名
				   $final_price = $goods_info[0]['final_price'];		//最终金额
				   $total_final_price = $goods_num*$goods_info[0]['final_price'];		//最终总金额
				   $sale_money=$total_money-$total_final_price;			//节省金额
				  
				   $car_detial_info[]=array('cart_id'=>$cart_id,'goods_id'=>$goods_id,'goods_price'=>$goods_price,'goods_num'=>$goods_num,'goods_original_price'=>$goods_original_price,'goods_tiny_pic'=>$goods_tiny_pic,'goods_name'=>$goods_name,'total_money'=>$total_money,'final_price'=>$final_price,'total_final_price'=>$total_final_price,'sale_money'=>$sale_money);
				  
				   
			  
			  }
			   
			  
			   //计算总金额和优惠的金额、
			   $car_total_money=0;
			   $car_total_final_price=0;
			   $car_sale_money=0;
			   $str="";
			   foreach($car_detial_info as $ci){
			      $car_total_money+=$ci['total_money'];						//原价总金额
				  $car_total_final_price+=$ci['total_final_price'];			//优惠价总金额
				  $car_sale_money+=$ci['sale_money'];						//节省总金额
				  
				  $url=U("Product/index",array('g'=>$ci['goods_id']));
			      $str.=<<<EOF
				   <tr class="sc-pro-item">
								<td rowspan="1" class="tr-check">
									<input id="box-1989" class="checkbox" type="checkbox" name="skuIds"  value="{$ci['cart_id']}" >
								</td>
								<td class="tr-pro">
									<div class="pro-area clearfix">
										<p class="p-img">
											<a title="{$ci['goods_name']}" target="_blank" href="{$url}" seed="cart-item-name">
												<img src="/vmallshop/Upload{$ci['goods_tiny_pic']}">
											</a>
										</p>
										<p class="p-name">
											<a title="{$ci['goods_name']}" target="_blank" href="{$url}" seed="cart-item-name">{$ci['goods_name']}</a>
										</p>
										<p class="p-sku"></p><p class="understock-1989 hide"></p>
									</div>
								</td>
								<td class="tr-price">
									<span>{$ci['goods_original_price']}</span>
								</td>
								<td class="tr-price">
									<span>{$ci['final_price']}</span>
								</td>
								<td class="tr-quantity" rowspan="1">                
									<div class="sc-stock-area">
										<div class="stock-area">
											<a title="减" class="icon-minus-3 vam"  id="cart_num_dec"  href="javascript:;"  >
												<span>-</span>
											</a>
											<input type="text" autocomplete="off" value="{$ci['goods_num']}" class="shop-quantity textbox vam" id="quantity-1989"  data-skuid="1989" data-type="1" seed="cart-item-num">
											<a title="加" class="icon-plus-3 vam" id="cart_num_inc" href="javascript:void(0)" >
												<span>+</span>
												
											</a>
										</div><p class="normalLimitstock-1989 hide"></p>
									</div>
								</td>
		        	<td rowspan="1" class="tr-subtotal">
									<b>¥{$ci['total_final_price']}</b>
								</td>
								<td rowspan="1" class="tr-operate">
									<a href="javascript:void(0);" class="icon-sc-del" title="删除" seed="cart-item-del">删除</a>
								</td>
							</tr>     
EOF;
			   
			   
			   
			   }
			   $cat_status=1;
			   
		   }else{
		       $cat_status=0;
		   }
		   
		 $data["cat_status"]=$cat_status;
         $data["content"]=array('str'=>$str,'car_total_money'=>$car_total_money,'car_sale_money'=>$car_sale_money,'car_end_money'=>$car_total_final_price);	
        
        echo json_encode($data);	
     		
	  
	  
	  
	  }
	     //更改购物车商品的数目
	  public function changeGoodsNum(){
	      //标志  0失败 1成功
		  $change_status=0;   
		  
		  //获取用户的id号
		  $user_id=session(C("USER_ID"));
		  $cart_model = M('cart');
		  
		  $num=I('post.goods_num');	//数量
	      $cart_id=I("post.cart_id");	//购物车ID

		  $data['cart_id'] = $cart_id;
		  //获取购物车信息
		  $cat_info = $cart_model->where($data)->select();

		  if(!empty($cat_info)){
		     foreach($cat_info as $info){
			     if($info['user_id']==$user_id){
				      $save['goods_num']=$num;
					  $update_check = $cart_model->where(array('cart_id'=>$info['cart_id']))->save($save); 
					  if(!$update_check){
						$change_status=0;  
					  }
					 
					 
				 }
			 
			 }
			 
			 
			 $change_status=1;
		  
		  }else{
		     $change_status=0;
		  }
		  
		  echo $change_status;
	  
	  
	  
	  }
	  
	  
	  //购物车 删除操作
	  
	  public function carDel(){
	     //删除购车中商品的操作
		 $del_status=0; //删除的标志
		 $cart_id=I("post.cart_id");	//购物车ID
		 //获取用户的id号
		 $user_id=session(C("USER_ID"));
		 $cart_model = M('cart');
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
		  
	      
	      echo $del_status;
	  
	  
	  }
	  
	     //购物车删除所有的操作
	  public function carDelAll(){
	      $cart_ids=I("post.cart_ids");
		  $delAll_status=0;
		 
		 //获取用户的id号
		 $user_id=session(C("USER_ID"));
		 $cart_model = M('cart');
		  //获取购物车信息
		 
		 
		 
		  if(!empty($cart_ids)){
		      $cart_ids_str = trim($cart_ids,",");
			  $data['cart_id'] = array('in',$cart_ids_str);
			  $cat_info = $cart_model->where($data)->select();
			  if(!empty($cat_info)){
				 foreach($cat_info as $info){
				     if($info['user_id']==$user_id){
						$del_check = $cart_model->where(array('cart_id'=>$info['cart_id']))->delete();
						if(!$del_check){
							$del_status=0; 
						}
					 }else{
					    $delAll_status=0;
					 }
				 }
				
				 $delAll_status=1;
			  }else{
			     $delAll_status=0;
			  }
		  }else{
		     $delAll_status=0;
		  
		  }
		
	       echo  $delAll_status;
	  
	  
	  }
	
	 
	  
	  
	  

}