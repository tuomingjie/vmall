<?php
 /*
  *这是个查询评论的的视图模型
  */
namespace Admin\Model;
use Think\Model\ViewModel;

class CommentViewModel extends ViewModel{
     public $viewFields=array(
	     'Comment'=>array('comment_id','comment_content','comment_score','comment_time','_type'=>'LEFT'),
		 'Goods'=>array('goods_name','goods_no','_on'=>'Comment.goods_id=Goods.goods_id','_type'=>'LEFT'),
		 'User'=>array('user_name','_on'=>'Comment.user_id=User.user_id'),
	   );





}







?>