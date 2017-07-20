<?php
/*
*网站后台的主文件主要调入DWZ框架
*
*/
namespace Admin\Controller;
use Think\Controller;
class IndexSaleController extends CommonController
{		

		  //商品新增的显示界面
	 public function add(){
	 
	     $cat=M('goods');
		 $info=$cat->field('goods_id,goods_no,goods_name,goods_keywords,goods_time,goods_state,goods_original_price,goods_sale_price,goods_sale_desc,goods_num,goods_weight,goods_small_pic,goods_big_pic,goods_desc_pic,goods_attr_value,category_id,concat("-",goods_id) as path')->order('path asc')->select();
		 $i=0;
		 //进行商品分类处理
		 foreach($info as $cat){
		     
		     $path=strlen($cat['path'])==3?0:strlen($cat['path']);
			 $data[$i]['goods_id']=$cat['goods_id'];
			 $data[$i]['goods_name']=$cat['goods_id']=str_repeat('&nbsp;',2*$path).$cat['goods_name'];
			 $i++;
		 }
		$this->cat_info=$data;
			
		 $this->display();
		 

	  }
	  
		public function insert(){
	      
			
			$upload = new \Think\Upload();// 实例化上传类  
     			$upload->maxSize   =     3145728 ;
				// 设置附件上传大小    
				$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
				// 设置附件上传类型
                 $upload->rootPath="./Upload";				
				$upload->savePath  =      './ad/'; 
				// 设置附件上传目录    // 上传单个文件    
				$info   =   $upload->uploadOne($_FILES['index_sale_img']);    
				if(!$info) {// 上传错误提示错误信息       
				      $this->error($upload->getError());    
				}else{
				   // 上传成功 获取上传文件信息        
				  $data['index_sale_img']=ltrim($info['savepath'],".").$info['savename']; 
			    }
			
			
			
			
			$data['index_sale_area']=I("request.index_sale_area");
			$data['goods_id']=I("request.goods_id");
			$data['index_sale_title']=I("request.index_sale_title");
			$data['index_sale_keywords']=I("request.index_sale_keywords");					

			
			if(M("index_sale")->add($data)){
			     $this->success("新增成功!");
			}else{
			      $this->error("新增失败!");
			}
			
	    }
		
		
		function del(){
			$img_name = 'index_sale_img';	//图片字段名
			parent::del($img_name);
		}
	

	function edit(){
		//商品信息
		$cat=M('goods');
		 $info=$cat->field('goods_id,goods_no,goods_name,goods_keywords,goods_time,goods_state,goods_original_price,goods_sale_price,goods_sale_desc,goods_num,goods_weight,goods_small_pic,goods_big_pic,goods_desc_pic,goods_attr_value,category_id,concat("-",goods_id) as path')->order('path asc')->select();
		 $i=0;
		 //进行商品分类处理
		 foreach($info as $cat){
		     
		     $path=strlen($cat['path'])==3?0:strlen($cat['path']);
			 $data[$i]['goods_id']=$cat['goods_id'];
			 $data[$i]['goods_name']=$cat['goods_id']=str_repeat('&nbsp;',2*$path).$cat['goods_name'];
			 $i++;
		 }
		$this->cat_info=$data;
		
		parent::edit();
	}
	
		
	//修改首页管理信息
	function update(){
		
		
		$model = M(CONTROLLER_NAME);
		$data['index_sale_id'] = I('post.index_sale_id');
		$data['index_sale_area'] = I('post.index_sale_area');
		$data['goods_id'] = I('post.goods_id');
		$data['index_sale_title'] = I('post.index_sale_title');
		$data['index_sale_keywords'] = I('post.index_sale_keywords');
		$old_img = I('post.old_img');
		

		
		if(!empty($_FILES['index_sale_img']['tmp_name'])){
			$upload = new \Think\Upload();// 实例化上传类  
			$upload->maxSize   =     3145728 ;
			// 设置附件上传大小    
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			 $upload->rootPath="./Upload";				
			$upload->savePath  =      './ad/'; 
			// 设置附件上传目录    // 上传单个文件    
			$info   =   $upload->uploadOne($_FILES['index_sale_img']);    
			if(!$info) {// 上传错误提示错误信息       
				  $this->error($upload->getError());    
			}else{
			   // 上传成功 获取上传文件信息        
			  $data['index_sale_img']=ltrim($info['savepath'],".").$info['savename']; 
			  
			  $path = $upload->rootPath.$old_img;
			  unlink($path);
			 
			}
		}else{
			$data['index_sale_img'] = $old_img;
		}
		
		
		
		$where['index_sale_id'] = $data['index_sale_id'];
		$check = $model->where($where)->save($data);
		
		if($check){
			$this->success(L('更新成功'));
		}else{
			$this->error(L('更新失败'));
		} 
	}
		

}