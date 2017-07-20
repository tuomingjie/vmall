<?php
/*
 * 这是后台的登录，退出的控制器
 */
namespace Admin\Controller;
 use Think\Controller;
class LoginController extends Controller {
      //后台登录
    public function index(){
         $this->display();
    }
	   //登录验证
	public function checkLogin(){

	           //实例化验证码类
	        $verify = new \Think\Verify(); 
            $code=I("post.verify");		   
		    if(!$verify->check($code,$id)){
		      // 检验验证码正确
		        $this->error('验证码输入错误!');
            }
		  
		   $admin=M('admin');
		  
		   $data['admin_pwd']=I('post.admin_pwd','','md5');
		   $data['admin_name']=I('post.admin_name','');

		   $info=$admin->where($data)->select(); 
		    //判断是否标志锁死不能登录
		   if($info[0]['admin_lock']==1){
		        $this->error('账户已经被锁了！若想登录请联系管理员');
			  
		   }

		   if($info){
		        //登录的标志
		        session('isLogin',true);
				
				//保存管理员信息
				$admin_info['admin_id']=$info[0]['admin_id'];
				$admin_info['admin_name']=$info[0]['admin_name'];
				$admin_info['admin_last_ip']=long2ip($info[0]['admin_last_ip']);
				$admin_info['admin_last_time']=$info[0]['admin_last_time'];
				$admin_info['admin_login_time']=$info[0]['admin_login_time'];
				
			     session('admin_info',$admin_info);
				//跟新管理员的登录时间和ip
				$updata['admin_last_time']=time();
				$updata['admin_last_ip']=ip2long(I('server.REMOTE_ADDR'));
				$admin->where($data)->save($updata);
				
				     //进行权限获取
				 $admin_id=$info[0]['admin_id'];
				  $sql="SELECT action_controller,action_func 
				      from vmall_action,vmall_role_action,vmall_role_admin
					  where vmall_action.action_id=vmall_role_action.action_id
                       AND vmall_role_admin.role_id=vmall_role_action.role_id and admin_id={$admin_id}";
				   
				   $nodeList=M()->query($sql);
				   
				     //对权限进行分类
				    foreach($nodeList as $list){
					     $newList[$list['action_controller']][]=$list['action_func'];
						  //如果是更新 增加显示更新操作方法
						 if($list['action_func']=="update"){
						      $newList[$list['action_controller']][]='edit';
						 }
						   //如果是插入 增加插入方法
					     if($list['action_func']=="insert"){
						      $newList[$list['action_controller']][]='add';
						 }
						 
						 
					}
					
					$newList['index'][]='index';
					
				   //把信息保存到session中
				  session(C('ADMIN_ACESS_LIST'),$newList);
				
				  $this->redirect("Index/index");
				
		   }else{
		       $this->error("登录失败!");
		   }
		 
	   
	   
	
	
	}
	  //后台退出
	public function quit(){
	        //登录标记改为假
	      session('isLogin',false);
		  //删除session信息
	      session('admin_info',null);
		  cookie(session_name(),null);
		  session('[destroy]'); 
		  $this->redirect("Login/index");
	}
	//更改密码的模板
	public function update(){
	   $this->display(); 
	
	}
	
	//更改密码
	public function save(){
	    $admin=M('admin');
		$data['admin_pwd']=I('post.admin_pwd','','md5');
		$where['admin_id']=I('post.id');
		
		$status=$admin->where($where)->save($data);
		if($status){
		   $this->success("修改成功");
		}else{
		   $this->error('修改失败');
		}
	    
	}
	
	   //生成验证码
	public function verify(){
	     
	         $config=array(
			   'imageW'=>110,
               'imageH'=>30,
               'length'=>4,
               'fontSize'=>16,
                'useNoise'=>false,			   
			 );
	       
			 $Verify = new \Think\Verify($config);
			 $Verify->entry();
	 
	 
	    
	
	
	} 
}