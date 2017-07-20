<?php
 /*
  * 网站后台用户评论管理
  */
namespace Admin\Controller;
use Think\Controller;
class  CommentController extends CommonController {
	  public function index() {
		//列表过滤器，生成查询Map对象
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		//判断采用自定义的Model类
		if(!defined("CommentView")){
		   $model = D("CommentView");
		}
		
		if(!empty($model)) {
			$this->_list($model, $map);
		}
		
		
		$this->display();
		return;
	}
	
	 //删除评论操作
	 public function del() {
		  $where['comment_id']=I("get.comment_id");
		 
		  if(M('Comment')->where($where)->delete()){
		       $this->success('删除成功');
		  }else{
		       $this->error('删除失败！');
		  }
		  
	 }
	
	
	
	
	
     
    
}