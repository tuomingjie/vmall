<?php
    /*
	 *这是商品列表页控制器
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class ListController extends Controller {
    public function index(){
	     
	
	
	     //分类页的轮换版处理
		    //其id是2
		 $adImg=M("Ad")->field("index_sale_img,ad_url,ad_content")->where('index_sale_area=2')->order("ad_id asc")->select();
		   //分配到前台处理
		  $this->adImg=$adImg;
	     
		 //分类处理/接受分类id进行处理
		 $category=I('get.f');
		
		  //找到父类的id
		 $parent_category=M('Category')->where('category_id='.$category)->select();
		  if(empty($parent_category)){
		      $this->error("出错！");
		  }
		   //如果是父分类就去找子分类
         if($parent_category[0]['category_pid']==0){
		      $child_category=M('Category')->where('category_pid='.$category)->order('category_id asc')->select();
			   //整合成要的结果
			   
			   $parents=array($category,$parent_category[0]['category_name']);
			   $current_category=$child_category[0]['category_id'];
			   foreach($child_category as $value){
			     
			     $c_array[]=array('id'=>$value['category_id'],'name'=>$value['category_name']);
			    
			   
			   
			   }
			   
		 }else{
		    //不是父类 就要找到父类和同辈
		     $parent_id=$parent_category[0]['category_pid'];
			 
			 $parent_c=M('Category')->where('category_id='.$parent_id)->select();
			 $siblings=M('Category')->where('category_pid='.$parent_id)->select();
			 
			 $parents=array($parent_c[0]['category_id'],$parent_c[0]['category_name']);
			 foreach($siblings as $value){
			    $c_array[]=array('id'=>$value['category_id'],'name'=>$value['category_name']);
			 
			 }
			  
			 $current_category=$category;
		     
		 
		 }		  
		
		 //返回结果到前台
		  //最大类
		 $this->parents=$parents;
		
         $this->current_category=$current_category;
          //子类
		 
         $this->categorys=$c_array;	
        
         //获取排序类型
         $order=I('get.order');
		  //如果$order为空 就按销量排序
		 if(empty($order)){
		     $order="goods_id";
		 }else if($order=="time"){
		     //按时间排序
		     $order="goods_time";
		 
		 }else if($order=="price"){
		     //按价格排序
		     $order="goods_original_price";
		 }
		 
		 
		  //对分类进行处理再去找商品如果是父分类就要找到所有的子分类在去查商品
		      $goods_category= $current_category;
			   //去找当前分类下的子类
			  $goods_path=M('Category')->where('category_id='.$goods_category)->field('category_path')->select();
		      $path=$goods_path[0]['category_path'].'-'.$goods_category."%";
			  $child_cate=M('Category')->where(array('category_path'=>array('like',$path)))->field('category_id')->select();
		      //如果查不出子类说明自己就是最低的分类
			  if($child_cate){
			        $category_query=$goods_category;
			       foreach($child_cate as $value){
				          $category_query.=','.$value['category_id']; 
				    
				   }
				   
				 
			  }else{
			     
			     $category_query=$goods_category;
			  }
		  
		    
	      $count=M('Goods')->where(array('category_id'=>array('in', $category_query)))->count();
		
	      //实例化分页类进行处理
		  $Page= new \Think\Page($count,12);
		  
	      $show = $Page->show();
		  $list = M('Goods')->where(array('category_id'=>array('in', $category_query)))->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		  $Page->setConfig('first',"<<");
		  $Page->setConfig('prev',"<");
          $Page->setConfig('next',">");
		  $Page->setConfig('last',">>");
          $Page->setConfig('theme', '
				  <li  class="pgNext link first first-empty">%FIRST%</li>
				  <li  class="pgNext link pre pre-empty">%UP_PAGE%</li>
				    <span  class="qpages">
					<li  class="page-number link">%LINK_PAGE%</li>  
				   </span>
			       <li  class="pgNext link next">%DOWN_PAGE%</li>
			       <li  class="pgNext link last">%END%</li>);');
		  if($list){
		    foreach($list as $value){
		       //商品的评价分
		       $score=M("Comment")->where('goods_id='.$value['goods_id'])->avg('comment_score');
			   if($score){
			     $goods_score=(int)($score/5*100);
			   }else{
			      $goods_score=100;
			   }
			    //商品的总评论数
			   $count_comment=M("Comment")->where('goods_id='.$value['goods_id'])->count('comment_id');
			  
			   $list_goods[]=array('goods_id'=>$value['goods_id'],'goods_name'=>$value['goods_name'],'goods_keywords'=>$value['goods_keywords'],'goods_original_price'=>$value['goods_original_price'],'goods_state'=>$value['goods_state'],'goods_score'=>$goods_score,'count_comment'=>$count_comment,'goods_tiny_pic'=>$value['goods_tiny_pic']);
		       
		       
		   
		   
		     }
			   $this->list_show=$show;
			   $this->list_goods=$list_goods;
			  
			   
			   $this->display();
			 
		  }else{
		      $this->error("未找到分类下的商品");
		  }
		   
		
         
    }
}