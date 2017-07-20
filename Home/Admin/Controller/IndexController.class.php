<?php
 /*
  * 网站后台的主文件主要调入DWZ框架
  */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
		header("Content-type:text/html;charset=utf-8");
	     //获取管理员信息
	     $admin_info=I('session.admin_info');
		  //获取管理员id
		 $admin_id=$admin_info['admin_id'];
		
		  //查询管理员拥有的操作和权限
		  $role_sql="select role_name from vmall_role join vmall_role_admin using(`role_id`) where admin_id='{$admin_id}'";
		  $roles=M()->query($role_sql);
		  
		  $action_sql="select action_name from vmall_action as a,vmall_role_admin as ra,vmall_role_action  as rac where ra.role_id=rac.role_id AND  rac.action_id=a.action_id AND admin_id={$admin_id}";
		  
		  $actions=M()->query($action_sql);
		   
		   foreach($roles as $role){
		        $r.=','.$role['role_name'];
		   }
		   foreach($actions as $action){
		        $a.=','.$action['action_name'];
		   }
		   
		   $jurisdiction = trim($a,',');
		   $j_ction_arr = explode(',',$jurisdiction);
		   
		   $this->j_ction_arr = $j_ction_arr;

		   //分配到前台
		  $this->admin_info=$admin_info;
		  $this->roles=ltrim($r,",");
		  $this->actions=ltrim($a,",");
		  
		  
		  
		  
		  
		$User = M('index');  
		$list = $User->select();  
		$this->assign('list',$list); 
		 
	    //引入dwz后台框架
        $this->display();
    }
}