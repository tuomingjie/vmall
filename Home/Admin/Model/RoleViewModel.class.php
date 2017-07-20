<?php
 /*
  *这是个获取权限规则视图模型
  */
namespace Admin\Model;
use Think\Model\ViewModel;

class RoleViewModel extends ViewModel{
     public $viewFields=array(
	     'Action'=>array('action_controller','action_func','_type'=>'LEFT','_table'=>'vmall_action'),
		 'Role'=>array('_on'=>'Action.action_id=Role.action_id','_table'=>'vmall_role_action','_type'=>'LEFT'),
		 'Ra'=>array('_on'=>'Ra.admin_id=Role.admin_id','_table'=>'vmall_role_admin'),
	 
	   );





}







?>