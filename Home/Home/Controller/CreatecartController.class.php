<?php
    /*
	 *这是订单创建成功页控制器
	 */
namespace Home\Controller;
use Think\Controller;
class CreatecartController extends CommonController {
    public function index(){

	     $address_id=cookie('address_id');
		   //获取用户的id号
		 $user_id=session(C("USER_ID"));
		 
		 if(empty($user_id)){
			$this->redirect('Login/index'); 
		 }
		 
		if(!IS_POST){
			$this->error('非法操作',U('Index/index'),2);
		}
		
		//防止订单重复提交
		if (!checkToken($_POST['TOKEN'])) {
            $this->redirect('index/index');
            return;
        }

		
		
		$data =  I('post.');

		
		$new_arr = array();
		foreach($data['goods_id'] as $k=>$v){
			$new_arr[$k]['goods_id'] = $v;
			foreach($data['goods_num'] as $k2=>$v2){
				if($k==$k2){
					$new_arr[$k]['goods_num'] = $v2;
				}
			}
			foreach($data['goods_price'] as $k3=>$v3){
				if($k==$k3){
					$new_arr[$k]['goods_price'] = $v3;
				}
			}
			foreach($data['is_customized'] as $k4=>$v4){
				if($k==$k4){
					$new_arr[$k]['is_customized'] = $v4;
				}
			}
			foreach($data['is_upload'] as $k5=>$v5){
				if($k==$k5){
					$new_arr[$k]['is_upload'] = $v5;
				}
			}
			foreach($data['other_price'] as $k6=>$v6){
				if($k==$k6){
					$new_arr[$k]['other_price'] = $v6;
				}
			}
			foreach($data['personality_text'] as $k7=>$v7){
				if($k==$k7){
					$new_arr[$k]['personality_text'] = $v7;
				}
			}
			
		}
		
		
		foreach($_FILES['personality_img']['name'] as $k=>$v){
			if($v != ''){
				/************************************上传图片********************************/
			   $upload = new \Think\Upload();
			   // 实例化上传类    
			   $upload->maxSize=3*1000*1000;
			   // 设置附件上传大小   
			   $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
			   // 设置附件上传类型    
			   $uplaod->autoSub=true;
			   //开启上传的子路经
			   $upload->subName=array('date','YmdHis');
			   $upload->rootPath="./Upload";
			   //上传路径
			   $upload->savePath ='./order/'; 
			   $info = $upload->upload();
			  
				if(!$info) {
					 // 上传错误提示错误信息  
				  $this->error($upload->getError());
				}else{
					// 上传成功 获取上传文件信息   

					$personality_img = array();	//定制图片数组

					
					foreach($info as $k=>$v){
							$personality_img[] = ltrim($v['savepath'],'.').$v['savename'];
					}
					
					
					   
				}
			/************************************上传图片结束********************************/
				break;
			}else{
				continue;
			}
		}
	
		
		$cat_info = array();
		$i = 0;
		foreach($new_arr as $k=>$v){
			if($v['is_upload'] == '1'){
				$v['personality_img'] = $personality_img[$i];
				$i = ++$i;
				
			}else{
				$v['personality_img'] = "";
			}
			
			$cat_info[] = $v;
		}

		
		 
		  //如果cookie中地址为空 则表示用默认地址
		 if(empty($address_id)){
		      $address_info=M("Address")->where(array('address_lock'=>1,'user_id'=>$user_id))->select();
			  $address_id=$address_info[0]['address_id'];
		 }else{
		     
			  $address_info=M("Address")->where(array('address_id'=>$address_id))->select();
			  $address_id=$address_info[0]['address_id'];
		 }
		 
		  //计算总金额和和个性定制费其他费用以及向数据库插入
		  $total_goods_money=0;			//商品金额
		  $personality_total_money=0;	//个性化总金额
		  $other_total_money=0;			//其他费用总金额
		  $total_end_money=0;			//总金额
		  $total_goods=array();
		  //开始计算
		  foreach($cat_info as $cat){
		       $total_goods_money+=$cat['goods_num']*$cat['goods_price'];
			   $personality_total_money+=$cat['goods_num']*0.3>130?$cat['goods_num']*0.3:130;	
			   $other_total_money+=$cat['other_price'];
			   $total_goods[]=array(
				'goods_id'=>$cat['goods_id'],
				'goods_num'=>$cat['goods_num'],
				'goods_price'=>$cat['goods_price'],
				'personality_price'=>$cat['goods_num']*0.3>130?$cat['goods_num']*0.3:130,
				'other_price'=>$cat['other_price'],
				'is_customized'=>$cat['is_customized'],
				'personality_img'=>$cat['personality_img'],
				'personality_text'=>$cat['personality_text'],
				);
		  }
		 

		
		  
		  
		 $total_end_money=$total_goods_money+$personality_total_money+$other_total_money+$total_end_money;
		
		  //随机生成一个13位的订单号
		 $order_no=date("mdis").mt_rand(10000,99999);
		 $data = array();
		 $data['order_no']=$order_no;
		 $data['order_time']=time();
		 $data['order_money']=$total_goods_money;
		 $data['order_total_money']= $total_end_money;
		 $data['address_id']=$address_id;
		 $data['user_id']=$user_id;
		 $data['express_id']=1; //默认选择1
		 $data['order_payment_id']=1;	//付款方式
		 $data['payment_status']=0;		//支付状态
		 $data['examine_status']=0;		//审核状态
		 $data['personality_total_money']=$personality_total_money;		//个性化总金额
		 $data['other_total_money']=$other_total_money;		//其他总金额
		 
		 

		 $order_id=M("Order")->add($data);
		//echo  M("Order")->getLastSql();die;
		// echo M("Order")->getLastSql();
		// die;
		// dump($order_id);
		 if($order_id){
		      //将商品插入商品详细表
			  $goods = M('goods');	
			  
		      foreach($total_goods as $order_goods){
				  $goods_info = $goods->where(array('goods_id'=>$order_goods['goods_id']))->field('supply_price')->find();
				  
			      M("OrderDesc")->add(array(
				  'order_desc_num'=>$order_goods['goods_num'],	//数量
				  'order_id'=>$order_id,						//订单ID
				  'goods_id'=>$order_goods['goods_id'],			//商品ID
				  'supply_num'=>$order_no."-".$order_goods['goods_id'],//供应商单号
				  'supply_price'=>$goods_info['supply_price'],	//供应价格
				  'supply_total'=>$goods_info['supply_price']*$order_goods['goods_num'],	//供应总额
				  'courier_number'=>'',							//快递单号
				  'address_id'=>$address_id,					//地址ID
				  'order_desc_state'=>'100',					//订单状态
				  'unit_price'=>$order_goods['goods_price'],	//商品单价
				  'total_price'=>$order_goods['goods_price']*$order_goods['goods_num'],	//商品总额
				  'personality_price'=>$order_goods['personality_price'],//个性化定制金额
				  'other_price'=>$order_goods['other_price'],	//其他金额
				  'is_customized'=>$order_goods['is_customized'],//是否开启定制
				  'personality_img'=>$order_goods['personality_img'],//个性图片
				  'personality_text'=>$order_goods['personality_text']//个性文字
				  )
				  );
				 
			  }
			
			  //执行成功清除购物车的数据
			 $cart_id = session('cart_id');
			 $where['cart_id'] = array('in',$cart_id);
			 M('cart')->where($where)->delete();
			 session('cart_id',null);
			 cookie('address_id',null);
			 
			 //控制向前台显示
			 
			 $this->address_info=$address_info[0];
			 $order_info=array('order_no'=>$order_no,'order_money'=>number_format($total_end_money,2),'order_end_money'=>number_format($total_end_money,2),'order_time'=>$data['order_time']);
			 
			 $this->order_info=$order_info;
			 $this->express_money=number_format($express_money,2);
			 
			 $user_money=M("User")->where(array('user_id'=>$user_id))->field('user_money')->select();
			
		     $this->user_money=$user_money[0]['user_money'];	 
			 //保存订单id到session中
			 session(C("USER_ORDER_ID"),$order_id);
		 
		 }else{
		     $this->error('订单提交失败');
		 }
		 
		 
         //创建token
         creatToken();
		 $this->address_info=$address_info[0];
		
         $this->display();
    }
}