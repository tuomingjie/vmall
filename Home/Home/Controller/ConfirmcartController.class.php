<?php
    /*
	 *这是确认订单页控制器
	 */
namespace Home\Controller;
use Think\Controller;
class ConfirmcartController extends CommonController {
    public function index(){
	
	     //判断用户是否登录
		 $user_id=session(C("USER_ID"));
		    //如果用户没有登录就跳到登录页
		 if(empty($user_id)){
		    $this->redirect('Login/index');
			exit;
		 }
		//获取用户的地址分配到前台 
		 //获取用户的默认地址
		 $default_address=M("Address")->where(array('user_id'=>$user_id,'address_lock'=>1))->select();
		 $this->default_address=$default_address[0];
		 
		 //遍历其他的非默认地址
		  $auto_address=M("Address")->where(array('user_id'=>$user_id,'address_lock'=>0))->select();
		  $this->auto_address=$auto_address;

		$type = I('post.type',0);
		//判断是否有传参数
		if($type==0){
			 $this->redirect('Index/index');
		}
		
		$goods_model = M('goods');
		
		
		// 计算总金额 优惠金额  运费  最终要付的款项
		$total_money=0;   $total_sale_money=0;
		$express_money=0; $end_money=0;
		$send_car=array();//输出的数组 
		
		//通过直接购买进来
		if($type==1){
			$goods_id = I('post.goods_id');		//商品ID
			$goods_num = I('post.goods_num');	//数量
			
			$goods_info = $goods_model->where(array('goods_id'=>$goods_id))->select();
			$goods_info = final_price_list($goods_info);	//获取商品最终价格
			$data['goods_id']=$goods_info[0]['goods_id'];
			$data['goods_name']=$goods_info[0]['goods_name'];
			$data['final_price']=$goods_info[0]['final_price'];
			$data['goods_num']=$goods_num;
			$data['goods_total_money']=$goods_num*$goods_info[0]['final_price'];
			
			//计算个性定制费用
			$personality_price = $goods_num*0.3;
			if($personality_price>130){
				$data['personality_price'] = $personality_price;
			}else{
				$data['personality_price'] = 130;
			}
			
			$total_money+=$data['goods_total_money'];
			
			if($goods_info['goods_sale_price']>0){		
				$total_sale_money+=$goods_num*($data['final_price']-$goods_info['goods_sale_price']); //得出优惠金额
			}
			$send_car[]=$data;
		}
		
		//通过购物车进来
		if($type==2){
			
			$cart_id = I('post.cart_id');
			$cart_id = trim($cart_id ,',');
			
			$cart_model = M('cart');
			$where['cart_id'] = array('in',$cart_id);
			//获取用户选中的购物车信息
			$cat_info = $cart_model->where($where)->select();
			
			
			if(empty($cat_info)){
				$this->redirect('Cart/error');
			}
			foreach($cat_info as $car){
				//获取商品号去查询要的字段
				$goods_id=$car['goods_id'];
				$goods_info=M('Goods')->where(array('goods_id'=>$goods_id))->select();
				$goods_info = final_price_list($goods_info);	//获取商品最终价格
				//获取要信息
				$data['goods_id']=$goods_info[0]['goods_id'];
				$data['goods_name']=$goods_info[0]['goods_name'];
				$data['final_price']=$goods_info[0]['final_price'];
				$data['goods_num']=$car['goods_num'];
				$data['goods_total_money']=$car['goods_num']*$goods_info[0]['final_price'];
				
				//计算个性定制费用
				$personality_price = $car['goods_num']*0.3;
				if($personality_price>130){
					$data['personality_price'] = $personality_price;
				}else{
					$data['personality_price'] = 130;
				}
				
				$total_money+=$data['goods_total_money'];
				
				if($goods_info['goods_sale_price']>0){
					$total_sale_money+=$car['goods_num']*($data['final_price']-$goods_info['goods_sale_price']);
					 
				}
				$send_car[]=$data;
				//存储购物车ID
				session('cart_id',$cart_id);
			}
			
			 
		}
		 
		 
		 
		 
		 

		  
		  
		   
		   
		   
		/*  //计算是否免运费
	   if($total_money>=200){
			$express_money=0.00;
	   
	   }else{
			$express_money=15.00;
	   } */
	   
	   //计算最后需要的钱数 总金额+运费-优惠金额
	   
		$end_money=$total_money-$total_sale_money;
	   
		//分配到前台显示
		$this->new_car= $send_car;
		//分配商品总金额到前台
		$this->total_money=number_format($total_money,2);
		//分配优惠金额
		$this->total_sale_money=number_format($total_sale_money,2);
		//分配运费金额到前台
		$this->express_money=number_format($express_money,2);
		//分配最后的money到前台
		$this->end_money=number_format($end_money,2);
		
		
		
        $this->display();
    }
}   