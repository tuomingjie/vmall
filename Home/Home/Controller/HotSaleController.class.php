<?php
    /*
	 *这是热销商品的控制器 会以ajax的形式返回
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class HotSaleController extends Controller {
    public function index(){
         //去热销商品表遍历处理ajax返回结果
		 
		 $hotInfo=M("HotSale")->field("vmall_goods.goods_id,goods_name,goods_original_price,goods_sale_price,goods_tiny_pic")->join("LEFT JOIN __GOODS__ ON __HOT_SALE__.goods_id=__GOODS__.goods_id")->limit(6)->select();
		
		 if($hotInfo){
		     $data['status']=1;
			  //循环遍历输出
			 $i=1;
			 
			 foreach($hotInfo as $info){
			      
		          if($info['goods_original_price']>$info['goods_sale_price']&&$info['goods_sale_price']>0){
				       $price=$info['goods_sale_price'];
				     
				  
				  }else{
				      
					  $price=$info['goods_original_price'];
				  
				  }
				
				  //路径信息
				  $url=U('Product/index',array('g'=>$info['goods_id']));
              $str=<<<EOF
			   
			    <li>
				<div>
					<p  class="p-img"><a  href="{$url}"  title="{$info['goods_name']}"><img  src="/vmallshop/Upload{$info['goods_tiny_pic']}"  alt="{$info['goods_name']}"></a>
					<!--------S记录着第几个商品-------->
					<s  class="s{$i}"></s></p>
					<p  class="p-name"><a  href="{$url}"  title="{$info['goods_name']}">{$info['goods_name']}</a></p>
					<p  class="p-price"><b>¥{$price}</b></p>
				</div>
		    </li>
			   
			   
			   
EOF;
			 $hotStr.=$str; 
			 
			 
		     $i++;
			 
		     
		 
		 
		 
		    }//foreach
		  
		    $data['content']=$hotStr;
		     //返回到前台
			  //ajax的形式返回到前台
			 $this->ajaxReturn($data);
		 
		 
	     }else{
		      $data['status']=0;
		      //ajax的形式返回到前台
			  $this->ajaxReturn($data);
		 
		 }
		 
		 
	 
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}