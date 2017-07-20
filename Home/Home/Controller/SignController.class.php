<?php
    /*
	 *这是用户注册的控制器 ajax的形式注册 session形式保存用户信息 
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class SignController extends Controller {
    
	
	public  function index(){
	    
		  $this->display();
		  
    }
	  
  
	
	public function checkName(){
	    //对名字进行验证  $userStatus 0不可用   1数据中有  2 可用
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
			     $userStatus=2;
			 }		 
		  
		  }
		  
		  
	      echo $userStatus;
	
	
	
	}
	     //进行注册
	public  function loginDo(){
	  //获取名字和密码网数据库插入
	        //登录成功的标志 1 ok  0 fail 
			 $login_status=0;
	            $username=I("post.name");
		   // $pwd=222;
		    $pwd=I("post.pwd","",'md5');
			 //先判断是否用户是否注册
			 $id=M('User')->where(array('user_name'=>$username))->select();
			// echo 'id='.$id;
			 if($id){
			     $login_status=0;
				 echo $login_status;
				 exit;
			 }
			   //对数据进行判断
			 if(empty($username)||empty($pwd)){
			     $login_satatus=0;
			 
			 }else{
				//echo "jinru";
			      //非空往数据库插入
			      $data['user_login_time']=time();
				  $data['user_last_ip']=ip2long(I('server.REMOTE_ADDR'));
				  $data['user_last_time']=time();
				  $data['user_score']=0;
				  $data['user_money']=0;
				  $data['user_name']=$username;
				  $data['user_pwd']=$pwd;
				 
				 $user_id=M('User')->add($data);
				// echo "user_id=".$user_id;
				  //判断插入是否成功
				 if($user_id){
				      $login_status=1;
					   //保存用户的信息到session 中
					     $save_info['user_money']=0;
						 $save_info['user_name']=$username;
						 $save_info['user_login_time']=date("Y-m-d H:i:s",$data['user_login_time']);
						 $save_info['user_last_time']=date("Y-m-d H:i:s",$data['user_last_time']);
						 $save_info['user_last_ip']=I('server.REMOTE_ADDR');
						 $save_info['user_score']=0;
					         session(C("USER_ID"),$user_id);
				                 session(C("USER_INFO"),$save_info);
				 }else{
				  
				   $login_status=0;
				 
				 }
			 
			 
			 }
			 
			 
			 
			 echo $login_status; 
	
	
	
	
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