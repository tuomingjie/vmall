<?php
 /*
  * 网站后台品牌管理
  * 继承Common控制器实现逻辑
  */
namespace Admin\Controller;
use Think\Controller;
class BrandController extends CommonController {
      
	//添加品牌
	public function insert(){
			$upload = new \Think\Upload();// 实例化上传类  
			$upload->maxSize   =     3145728 ;
			// 设置附件上传大小    
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			 $upload->rootPath="./Upload";				
			$upload->savePath  =      './ad/'; 
			// 设置附件上传目录    // 上传单个文件    
			$info   =   $upload->uploadOne($_FILES['brand_img']);    
			if(!$info) {// 上传错误提示错误信息       
				  $this->error($upload->getError());    
			}else{
			   // 上传成功 获取上传文件信息        
			  $_POST['brand_img']=ltrim($info['savepath'],".").$info['savename']; 
			}
			//调用父类的insert方法
	        parent::insert();

	    }
	
	//修改品牌信息
	function update(){
		$brand = M('brand');
		$data = I('post.');

		
		if(!empty($_FILES['brand_img']['tmp_name'])){
			$upload = new \Think\Upload();// 实例化上传类  
			$upload->maxSize   =     3145728 ;
			// 设置附件上传大小    
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			 $upload->rootPath="./Upload";				
			$upload->savePath  =      './ad/'; 
			// 设置附件上传目录    // 上传单个文件    
			$info   =   $upload->uploadOne($_FILES['brand_img']);    
			if(!$info) {// 上传错误提示错误信息       
				  $this->error($upload->getError());    
			}else{
			   // 上传成功 获取上传文件信息        
			  $data['brand_img']=ltrim($info['savepath'],".").$info['savename']; 
			  
			  $path = $upload->rootPath.$data['old_img'];
			  unlink($path);
			 
			}
		}else{
			$data['brand_img'] = $data['old_img'];
		}
		
		$where['brand_id'] = $data['brand_id'];
		unset($data['old_img']);
		unset($data['ajax']);
		$check = $brand->where($where)->save($data);
		
		if($check){
			$this->success(L('更新成功'));
		}else{
			$this->error(L('更新失败'));
		} 
	}
	
	
	function del(){
		
		$img_name = 'brand_img';	//图片字段名
		parent::del($img_name);
	}
}