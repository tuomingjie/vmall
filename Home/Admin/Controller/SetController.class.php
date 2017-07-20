<?php
 /*
  * 网站后台系统设置管理
  * 继承Common控制器实现逻辑
  */
namespace Admin\Controller;
use Think\Controller;
class SetController extends CommonController {
      
	
	public function index() {
		
		$model = D(CONTROLLER_NAME);
		$set_info = $model->select();
		$this->set_info = $set_info;
		
		
		$this->display();
		
	}
	
	
    //修改设置信息
	
	public function update(){
		$set = M('set');
		$set_id_arr = I('post.set_id');
		$set_content_arr = I('post.set_content');
		
	
		
		//判断LOGO图片是否上传
		if(!empty($_FILES['logo_img']['tmp_name'])){
			$upload = new \Think\Upload();// 实例化上传类  
			$upload->maxSize   =     3145728 ;
			// 设置附件上传大小    
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			 $upload->rootPath="./Upload";				
			$upload->savePath  =      './ad/'; 
			// 设置附件上传目录    // 上传单个文件    
			$info   =   $upload->uploadOne($_FILES['logo_img']);    
			if(!$info) {// 上传错误提示错误信息       
				  $this->error($upload->getError());    
			}else{
				
			   $path = $upload->rootPath.$set_content_arr[4]['set_content'];
			   // 上传成功 获取上传文件信息        
			  $set_content_arr[4]=ltrim($info['savepath'],".").$info['savename']; 

			  unlink($path);
			 
			}
		}
		
		//判断微信图片是否上传
		if(!empty($_FILES['weixin_img']['tmp_name'])){
			$upload = new \Think\Upload();// 实例化上传类  
			$upload->maxSize   =     3145728 ;
			// 设置附件上传大小    
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			 $upload->rootPath="./Upload";				
			$upload->savePath  =      './ad/'; 
			// 设置附件上传目录    // 上传单个文件    
			$info   =   $upload->uploadOne($_FILES['weixin_img']);    
			if(!$info) {// 上传错误提示错误信息       
				  $this->error($upload->getError());    
			}else{
				
			   $path = $upload->rootPath.$set_content_arr[5]['set_content'];
			   // 上传成功 获取上传文件信息        
			  $set_content_arr[5]=ltrim($info['savepath'],".").$info['savename']; 

			  unlink($path);
			 
			}
		}
		$arr = array();
		foreach($set_id_arr as $k=>$v){
			foreach($set_content_arr as $key=>$value){
				if($k==$key){
					$arr[$k]['set_id'] = $v;
					$arr[$k]['set_content'] = $value;
				}
			}
		}
		$arr2 =  array();
		foreach($arr as $k=>$v){
			$set->where(array('set_id'=>$v['set_id']))->save(array('set_content'=>$v['set_content']));
			$arr2[] = $set->getLastSql();
		}
		
	
		
		$this->success(L('更新成功'));
		
		
		
	}
	
	
	
}