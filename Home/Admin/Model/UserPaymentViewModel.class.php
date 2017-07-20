<?php
 /*
  *这是个用户消费视图模型
  */
namespace Admin\Model;
use Think\Model\ViewModel;

class UserPaymentViewModel extends ViewModel{
       public $viewFields=array(
	     'Payment'=>array('user_payment_id','user_payment_money','user_payment_why','user_payment_time','user_id','_type'=>'LEFT','_table'=>'vmall_user_payment'),
		 'User'=>array('_on'=>'Payment.user_id=User.user_id','_table'=>'vmall_user'),
		
	 
	   );



    





}







?>