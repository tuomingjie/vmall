<?php
 /*
  * 网站后台权限管理管理角色管理
  */
namespace Admin\Controller;
use Think\Controller;
class RoleController extends CommonController {
       
	      //重写添加角色前台用户显示
	   
	   public function add(){
	      //获取操作名传到前台
	      $action_data=M("Action")->field("action_id,action_name")->select();
		  $this->action_data=$action_data;
		  
		  parent::add();
		   
	   
	   
	   }
	   
	      //添加新管理员到后台的数据库
	   
	   public function insert(){
	      
	           //后去前台的role_name
			 $role_name=I("post.role_name");
			  //去后台获取action_id
			 $action_id=I("post.action_id");
		     //检测是否有role_name
			 if(M('Role')->where('role_name='.$role_name)->select()){
			      $this->error("角色名已经存在");
			 }
			 //判断是否选择了操作
			 if(empty($action_id)){
			     $this->error("没有选择操作");
			 }
			 //没有插入
			 $data['role_name']=$role_name;
		     $role_id=M('Role')->add($data);
			
			 //判断用户是否插入成功;在进行插入角色
			 
		     if($role_id){
			     foreach($action_id as $action){
				     $role_action['role_id']=$role_id;
					 $role_action['action_id']=$action;
					 
					 M('role_action')->add($role_action);
				 
				 }
			 
			 }
		     
		    $this->success("增加成功！");
	   
	   }
	   
	   //重写删除
	   
	   public function del(){
	        
	        $role_id=I("get.role_id");
			if(!$role_id){
			   $this->error('选择不成功!');
			}
			
			 //先删除关联角色表在删除管理员
		        M('role_action')->where('role_id='.$role_id)->delete();
			   
			if(M('role')->where('role_id='.$role_id)->delete()){
				$this->success('删除管理员成功!');
			
			}else{
			    $this->error('删除失败');
			}
	   
	   
	   }
	   
	  //重写修改方法
	  
	  public function edit(){
	     $role_id=I("request.role_id");
		  if(!$role_id){
			   $this->error('修改失败');
		  }
		 
	        //操作名传到前台
	      $action_data=M("Action")->field("action_id,action_name")->select();
		  $this->action_data=$action_data;
		  
		  
		  //获取拥有的操作id
		  $action_data=M('role_action')->where("role_id=".$role_id)->field('action_id')->select();
		  
		  foreach ($action_data as $data){
		      $action_id_data[]=$data['action_id'];
		  
		  }
		  
		  $this->action_id_data=$action_id_data;
		  
		  
		  
		   parent::edit();
		  
		  
	  
	  
	  
	  }
	  
	  
	  //重写跟新
	  
	  public function update(){
	     $role_id=I("post.role_id");
		 $role_name=I("post.role_name");
		 $action_id=I("post.action_id");
		 
		 $old_name=M("Role")->field('role_name')->where("role_id=".$role_id)->select();
		  //判断修改的用户名是否存在
		 if($role_name!=$old_name['0']['role_name']){
		     if(M("Role")->where("role_name=".$role_name)->select()){
			     $this->error("角色名存在!");return;
			 }
		 
		 }
		  //如果用户的操纵不空；进行操作修改
		 if(!empty($action_id)){
		     //先删除原来的角色;在插入新的角色
			 M("role_action")->where("role_id=".$role_id)->delete();
			    //进行插入
			   foreach($action_id as $action){
				     $role_action['action_id']=$action;
					 $role_action['role_id']=$role_id;
					 M('role_action')->add($role_action);
				 
				 }
		 
		 }
		 
		
		     $data['role_name']=$role_name;
		  //更新角色名
		    M('Role')->where('role_id='.$role_id)->save($data);
		    $this->success("更新成功!");
		 
		
	  
	  
	  
	  }
	  
	 
    
}