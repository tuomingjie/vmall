<?php
  /*
   *评论中心主页控制器
   */
namespace Home\Controller;
use Think\Controller;
class CommentController extends CommonController {
     public function index(){
	       //判断用户是否登录
		   $user_id=session(C("USER_ID"));
		   if(empty($user_id)){
		      $this->redirect("Login/index",'',5,'未登录,页面跳转中.....');
			  exit;
		   }
		   
		   //查询用户评价
		    $comment=D('CommentView');
		    
		    $count=$comment->where(array('user_id'=>$user_id))->count();
			$Page= new \Think\Page($count,6);
			$show       = $Page->show();
			$list = $comment->where(array('user_id'=>$user_id))->order('comment_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			$this->assign('list',$list);
			$this->assign('page',$show);
			//判断是否有值
			if($count){
			   $comment_status=1;
			   $hide="hide";
			}else{
			   $comment_status=0;
			   $hide="";
			}
		    $this->comment_status=$comment_status;
            $this->hide=$hide;
         //友情链接
         $Index = M('link');

         $Linklist = $Index->select();


         $this->links=$Linklist;

	       $this->display();
	 }
	 
	 

	
	
}