<?php
 /*
  * 网站后台退换货控制器
  */
namespace Admin\Controller;
use Think\Controller;
class GoodRollbackController extends CommonController{
		
		 public function index(){
		//获取所有用户的数据
		$goodrollback=D('good_rollback');
		$this->assign('list',$goodrollback->select());
		//显示页面
		$this->display();
    }
		
		  //update 修改退换货状态
	   
	    public function update(){
	   
	       $good_rollback_id=I("post.good_rollback_id");
		   $good_rollback_state=I("post.good_rollback_state");
	       $data['good_rollback_state']=$good_rollback_state;
		   if(M('good_rollback')->where('good_rollback_id='.$good_rollback_id)->save($data)){
		       $this->success('修改成功');
		   }else{
		       $this->error('修改失败');
		   }
	   

	   }
	
}