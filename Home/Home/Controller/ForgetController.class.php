<?php
    /*
	 *这是用户密码找回的控制器  ajax的形式找密码
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class  ForgetController extends Controller {
          //找回密码的首页
        public function index(){
		      //取密保问题
			  
			  $sec=M('Secure')->select();
			  //分配到前台
			 
			  $this->sec=$sec;
		   
		
		      $this->display();
		
		}		 
		  
	    
        public function checkName(){
				//对名字进行验证  $userStatus 0没有找到  1存在
				  $name=I("post.name");
				  //存在的标志
				  $userStatus=0;
				  if(empty($name)){
					   $userStatus=0;
				  }else{
					 //非空就去数据库查询
					 
					 $user_info=M("User")->where(array('user_name'=>$name))->select();
					 if($user_info){
						 $userStatus=1;
					 }else{
						 $userStatus=0;
					 }		 
				  
				  }
				  
				  
				  echo $userStatus;
	
	
	
	}		
	      //对密码问题验证
	 public function checkQuestion(){
	     //接受传递到进行判断
		         $user_status=0;
		  
	      $user=I("post.user");
		  $sec_id=I("post.sec_id");
		  $sec_answer=I("post.sec_answer");
		 
		  if(empty($user)||empty($sec_id)||empty($sec_answer)){
		  
		       $user_status=0;
		  }else{
		      //验证用户密码信息
		     $user_info=M("User")->where(array('user_name'=>$user,'user_answer'=>$sec_answer,'secure_id'=>$sec_id))->select();
			   
			 if($user_info){
			     $user_status=1;
				 //保存一个标志到session中
				 $unique=uniqid();
				 $save_user['user_name']=$user;
				 $save_user['unique']=$unique;
				 session('user_forget',$save_user);
			 }
		  
		  }
		  
		  $data['user_status']=$user_status;
		  $data['unique']=$unique?$unique:'';
		  
		  echo json_encode($data);
		  
		 
	 
	 
	 
	 
	 
	 
	 }
	      //设置新密码
	 public function  newPwd(){
	        $unique=I('get.unique');
	        $save_info=session('user_forget');
			
			if($unique!=$save_info['unique']){
				$this->redirect('Forget/index');
			}else{
				$this->display();
			
			}
	       
	 
	 }
	    //进行修改密码
	 public function modifierPwd(){
	      //获取密码
		  //设置密码标志位 0 失败 1和原来密码相同 2更新成功
		  $pwd_login=0;
		  $pwd=I("post.pwd",'','md5');
		  $save_info=session('user_forget');
		  $user_name=$save_info['user_name'];
		     //如果为空
		  if(empty($user_name)||empty($pwd)){
		      $pwd_login=0;
		  }else{
		      $old_pwd==M('User')->where(array('user_name'=>$user_name))->field('user_pwd')->select();
			  if($pwd==$old_pwd){
			      $pwd_login=1;
			  }else{
			         //进行更新密码处理
					 $save_status=M('User')->where(array('user_name'=>$user_name))->save(array('user_pwd'=>$pwd));
						 //跟新成功!
					 if($save_status){
						 $pwd_login=2;
						 //清除保存用户的session
						  session(C("USER_ID"),null);
						  session(C("USER_INFO"),null);
					 }else{
						 $pwd_login=0;
					 }
			  
			  
			  }
				  
		    
		  
		 }
		  
		  
	  
	 
	     echo $pwd_login;
	 
	 
	 
	 
	 
	 
	 
	 
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 //验证码
	public function verify(){
	     //配置验证码
	     $config=array(
		   'imgW'=>'140',
		   'imgH'=>'65',
		   'length'=>4,
		   'bg'=>array(253,253,253),
		   'useNoise'=>false,
		   'fontSize'=>30
		    
		 
		 );
	     $Verify = new \Think\Verify($config);
		 $Verify->entry();
	
	}
	
	
	//验证注册码
	
	// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
	  function check_verify($code, $id =''){  
	           $code=I('get.code');
			   
   	          $verify = new \Think\Verify();  
			  if($verify->check($code, $id)){
			     $data=1;
			  }else{
			     $data=0;
			  }
		     echo $data;
	  }
	
    
	
	
	
	
	
}
	
	
?>