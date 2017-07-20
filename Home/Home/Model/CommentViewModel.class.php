<?php

namespace Home\Model;
use Think\Model\ViewModel;
class CommentViewModel extends ViewModel {  

     public $viewFields = array( 
	 
   	       'Comment'=>array('comment_id','comment_content','user_id','comment_score','comment_time','goods_id'), 
           'Goods'=>array('goods_name','_on'=>'Comment.goods_id=Goods.goods_id'),		  
		  
		 

		  );
	 
	 
	 
	 
	 
	 
}




























?>