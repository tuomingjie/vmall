<?php
 /*
  * 网站后台权限管理管理管理员管理
  */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
       
	      //重写添加管理员前台用户显示
	   
	   public function add(){
	      //角色名传到前台
	      $role_data=M("Role")->field("role_id,role_name")->select();
		  $this->role_data=$role_data;
		  
		  parent::add();
		   
	   
	   
	   }
	   
	      //添加新管理员到后台的数据库
	   
	   public function insert(){
	      
	       $admin_name=I('post.admin_name');
		   $role_id=I('post.role_id');
		      //判断管理员是否注册过
	       if(M('admin')->where('admin_name='.$admin_name)->select()){
		      $this->error("管理员已经存在！");
		   }
		   if(empty($role_id)){
		      $this->error('请选择角色');
		   }
		       //密码加密处理
		   $admin_pwd=I("post.admin_pwd","",'md5');
		    $data['admin_name']=$admin_name;
			$data['admin_pwd']=$admin_pwd;
			  //生成管理员的注册时间
			$data['admin_login_time']=time();
			$data['admin_lock']=I('post.admin_lock')?1:0;
			$data['admin_last_time']=time();
			$data['admin_last_ip']=ip2long(I('server.REMOTE_ADDR'));
		    $admin_id=M('admin')->add($data);
			
			 //判断用户是否插入成功;在进行插入角色
			 
		     if($admin_id){
			     foreach($role_id as $role){
				     $role_admin['role_id']=$role;
					 $role_admin['admin_id']=$admin_id;
					 M('role_admin')->add($role_admin);
				 
				 }
			 
			 }
		     
		    $this->success("增加成功！");
	   
	   }
	   
	   //重写删除
	   
	   public function del(){
	        
	        $admin_id=I("get.admin_id");
			if(!$admin_id||$admin_id==1){
			   $this->error('删除失败');
			}
			 //先删除关联角色表在删除管理员
		    if(M('role_admin')->where('admin_id='.$admin_id)->delete()){
			    M('admin')->where('admin_id='.$admin_id)->delete();
				$this->success('删除管理员成功!');
			
			}else{
			   $this->error('删除失败');
			}
	   
	   
	   }
	   
	  //重写修改方法
	  
	  public function edit(){
	     $admin_id=I("request.admin_id");
		  if(!$admin_id){
			   $this->error('修改失败');
		  }
		 
	        //角色名传到前台
	      $role_data=M("Role")->field("role_id,role_name")->select();
		  $this->role_data=$role_data;
		  
		  
		  //获取拥有的角色id
		  $role_data=M('role_admin')->where("admin_id=".$admin_id)->field('role_id')->select();
		  foreach ($role_data as $data){
		      $role_id_data[]=$data['role_id'];
		  
		  }
		  
		  $this->role_id_data=$role_id_data;
		  
		  
		  
		   parent::edit();
		  
		  
	  
	  
	  
	  }
	  
	  
	  //重写跟新
	  
	  public function update(){
	     $role_id=I("post.role_id");
		 $admin_name=I("post.admin_name");
		 $admin_id=I("post.admin_id");
		 
		 $old_name=M("Admin")->field('admin_name')->where("admin_id=".$admin_id)->select();
		  //判断修改的用户名是否存在
		 if($admin_name!=$old_name['0']['admin_name']){
		     if(M("Admin")->where("admin_name=".$admin_name)->select()){
			     $this->error("用户名存在!");return;
			 }
		 
		 }
		  //如果用户的角色不空；进行角色修改
		 if(!empty($role_id)){
		     //先删除原来的角色;在插入新的角色
			 M("role_admin")->where("admin_id=".$admin_id)->delete();
			    //进行插入
			   foreach($role_id as $role){
				     $role_admin['role_id']=$role;
					 $role_admin['admin_id']=$admin_id;
					 M('role_admin')->add($role_admin);
				 
				 }
		 
		 }
		 
		 //判断是否跟新密码
		 if(I("post.admin_pwd")){
		     $data['admin_pwd']=I("post.admin_pwd","",'md5');
		 }
		  
		   //获取锁定标志 
		 $data['admin_lock']=I("post.admin_lock");
		 
		 if(M('Admin')->where('admin_id='.$admin_id)->save($data)){
		      $this->success("更新成功!");
		 
		 }else{
		     $this->error("更新失败！");
		 }
		 
	  
	  
	  
	  }
	  
	 
    
}