<?php
    /*
	 *这是用户浏览商品的控制器 保存在cookie中 会以ajax的形式存取
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class ScanGoodsController extends Controller {
     //浏览商品的显示方法
	 
	public  function index(){
	      //到cookie去用户浏览的数据
		  
		  $cat_info=cookie(C("USER_SCAN_GOODS"));
		 
		  if(empty($cat_info)){
		     //如果不存在
			 $scan_goods['status']=0;
		     $this->ajaxReturn($scan_goods);
		  }else{
		  
		     if(strlen($cat_info)){
			     $goods_ids=$cat_info;
			 }else{
			    $scan_arr=explode(",",$cat_info);
				//大于六个 取最后六个
		        if(count($scan_arr)>6){
			       $goods_ids=join(',',array_slice($scan_arr,-6));
			    }else{
			     $goods_ids=join(',',$scan_arr);
			 
			    }
				
			 }
		     
			  //数据库进行查询商品
			  
			  $goods_info=M("Goods")->field('goods_id,goods_name,goods_original_price,goods_sale_price,goods_tiny_pic')->where(array('goods_id'=>array('in',$goods_ids)))->select();
			   //循环遍历处理
              foreach($goods_info as $info){
			        //生成URL路径
				   $url=U('Product/index',array('g'=>$info['goods_id']));
				   //判断价格
				   if($info['goods_original_price']>$info['goods_sale_price']&&$info['goods_sale_price']!=0){
				      $price=$info['goods_sale_price'];
				   
				   }else{
				      $price=$info['goods_original_price'];
				   
				   }
				 
				 $str.=<<<EOF
				     <li>
						   <div>
							<p  class="p-img">
							 
							  <a  href="{$url}"  title="{$info['goods_name']}">
							  <img  src="/vmallshop/Upload{$info['goods_tiny_pic']}"  alt="{$info['goods_name']}">
							  </a>
							</p>
							<p  class="p-name">
							  <a  href="{$url}"  title="{$info['goods_name']}">{$info['goods_name']}</a>
							</p>
							<p  class="p-price">
							   <b>¥{$price}</b>
							</p>
						  </div>
			       </li>
				 
				 
EOF;
			  
			  
			    
			  
			  }
			 
			 
			 $scan_goods['status']=1;
			 $scan_goods['content']=$str;
			 
			 $this->ajaxReturn($scan_goods);
			 
			
		  
		  
		  }
		 
	
	
	
	
	
	
	}

     //增加商品浏览操作方法
    public function add(){
	     
         $goods_id=I("post.goods_id");
		 
		  
		 
		 //获取cookie中保存信息
		 $cat_info=cookie(C("USER_SCAN_GOODS"))?cookie(C("USER_SCAN_GOODS")):'';
		   //判断是否非空
		  //切割cat_info
		   if(empty($cat_info)){
		     $cat_arr=array();
		   }else{
		     $cat_arr=explode(',',$cat_info);
		   }
		  
		 if(empty($cat_info)){
		       $cat_arr[]=$goods_id;
		 }else{
		     //判断商品是否在购物车内
			 
		      if(!in_array($goods_id,$cat_arr)){
			     //不在增加到购物车内
				  $cat_arr[]=$goods_id;
			  }
			  
			  
		 
		 
		 }
		 
		 $cat_info=join(",",$cat_arr);
		 cookie(C("USER_SCAN_GOODS"),$cat_info,array('expire'=>60*60*24*10));
			
	      
		
		 
		 
		 
		  
		 
	 
    }
	
	
	 //删除商品浏览的方法
	public function del(){
	    
		 //删除保存商品的cookie
		cookie(C("USER_SCAN_GOODS"),null);
	    
	
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}