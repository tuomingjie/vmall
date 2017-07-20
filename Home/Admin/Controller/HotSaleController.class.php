<?php
 /*
  * 网站后台热销榜单商品管理
  */
namespace Admin\Controller;
use Think\Controller;
class HotSaleController extends CommonController {
     //重写父类的方法
	 public function index(){
	     $data=M('goods')->field('goods_id,goods_name,goods_tiny_pic')->select();
		 
	      $this->goods=$data;
	     //继承父类的方法
		 parent::index();
	 
	 }
      
   
   
   
      //商品新增的显示界面
	 public function add(){
	      //遍历所有商品名称和id传到前天
		  $data=M('goods')->field('goods_id,goods_name')->select();
	      
		  $this->goods=$data;
		  $this->display();
	  }
	    //增加操作
	  public function insert(){
	       $goods_id=I('request.goods_id');
		   if(empty($goods_id)){
		      $this->error('请选择商品');
		   }
	   
	      
		     
			  //传递goods_id参数
			  $data['goods_id']=$goods_id;
		      
			  if(M('hot_sale')->add($data)){
			     $this->success("添加成功!");
			  }else{
			     $this->error("添加错误!");
			  }
	  
	  }
	  
	 
	  
	  //重写更新方法
	 public function update(){
	        //判断是否传过来id
			$hot_sale_id=I("request.hot_sale_id");
			if(empty($hot_sale_id)){
			   $this->error("更新失败");
			}
	 
		  
	     $upload = new \Think\Upload();
		   // 实例化上传类    
		   $upload->maxSize=3*1000*1000;
		   // 设置附件上传大小   
		   $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
		   // 设置附件上传类型    
		   $uplaod->autoSub=true;
		   //开启上传的子路经
		   $upload->subName=array('date','YmdHi');
		   $upload->rootPath="./Upload";
		   //上传路径
		   $upload->savePath  ='./HotSale/'; 
		   $info   =  $upload->upload();
		   if(!$info) {
		    
			}else{
			     // 上传成功 获取上传文件信息   
                   	 
			        $data['hot_sale_img']=ltrim($info['hot_sale_img']['savepath'],'.').$info['hot_sale_img']['savename'];
				  
				 
				 
				 
		     }
			  
			 
	         
	         if(M('hot_sale')->where('hot_sale_id='.$hot_sale_id)->save($data)){
			     $this->success("更新成功!");
			 }else{
			     $this->error("更新失败");
			 } 
	      
	 
	 }
	 
	 
	 //删除热门商品
	 
	 public  function  del(){
	      //获取hot_sale_id
	     $hot_sale_id=I("request.hot_sale_id");
		 //判断是否飞空
		 if(empty($hot_sale_id)){
		     $this->error("非法操作");
		 }
		 // 进行删除
		 $where['hot_sale_id']=$hot_sale_id;
		 if(M('hot_sale')->where($where)->delete()){
		     $this->success('删除成功');
		 }else{
		     $this->error('删除失败');
		 }
	     
	 
	 
	 }
    
}