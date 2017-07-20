<?php
    /*
	 *这是用户登录的控制器 ajax的形式登录 session形式保存用户信息 
	 *
	 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    
	 //到登录页
	public  function index(){
	      //获取到此页面的url地址
		  $get_url=I('server.HTTP_REFERER');
		  if(empty($get_url)||!preg_match('/vmallshop\/index.php/',$get_url)||preg_match('/vmallshop\/.*Login\/index/',$get_url)||preg_match('/vmallshop\/.*\/Forget.*/i',$get_url)){
		      //如果是外网站的连接就去首页
			 $url=U("Index/index");
		  
		  }else if(preg_match('/vmallshop\/index\.php/',$get_url)){
		      //如果是本网站的就去首页
		     $url=$get_url;
		  
		  }else{
		      //去首页
		     $url=U("Index/index");
		  }
		  
		  $this->url=$url;
		  
		  
		  //友情链接
		$Index = M('link');
		$Linklist = $Index->select();
		$this->links=$Linklist;
		
		$this->display();
		  
    }
	  
      //进行验证	  
	public function remoteLogin(){
	     //ajax的形式返回  sataus 0 失败 1 账户被锁  2成功
		 //获取用户输入的名字和密码 以及是否长时间登录的标志
		 
	     $name=I('post.uname');
		 $pwd=I('post.pwd','','md5');
		 $rembername=I('post.rembername');
		 
		    //判断名字和密码是否存在
		 if(empty($name)||empty($pwd)){
		     
			$this->ajaxreturn(array('status'=>0,'msg'=>'用户名或密码不能为空！'));
		    
		 }else{
				 
				 //进行数库查询
				 $user=M("User");
				 
				 
				 
				 $user_info=$user->where(array('user_name'=>$name,'user_pwd'=>$pwd))->select();
				 if($user_info){
				     //能查出用户信息说明可以登录
				      //$status=2;
					    //账户被锁,不可登录
					 if($user_info[0]['user_lock']==1){
					      $this->ajaxreturn(array('status'=>0,'msg'=>'账户被锁,不可登录'));
					 
					 }else{
					     //用户登录合法;对用户信息处理 更新用户登录时间和ip
						 
						 $user_last_time=time();
						 $user_last_ip=ip2long(I('server.REMOTE_ADDR'));
						 $user_id=$user_info[0]['user_id'];
						 
						 $data['user_last_time']=$user_last_time;
						 $data['user_last_ip']=$user_last_ip;
						
						 $user->where(array('user_id'=>$user_id))->save($data);
						  //保存要的东西
						    //用户名
						  $save_info['user_name']=$user_info[0]['user_name'];
						    //真实姓名
						  $save_info['true_name']=$user_info[0]['true_name'];
						    //性别 0-woman  1-man
							
					      $save_info['user_sex']=$user_info[0]['user_sex']==1?'先生':'小姐';
						   //用户的金额
						  $save_info['user_money']=$user_info[0]['user_money'];
						     
						  $save_info['user_email']=$user_info[0]['user_email'];
						  $save_info['user_login_time']=date("Y-m-d H:i:s",$user_info[0]['user_login_time']);
						  $save_info['user_last_time']=date("Y-m-d H:i:s",$user_info[0]['user_last_time']);
						  $save_info['user_last_ip']=long2ip($user_info[0]['user_last_ip']);
						  $save_info['user_score']=$user_info[0]['user_score'];
						   //保存到session中去
						   session(C("USER_ID"),$user_id);
						   session(C("USER_INFO"),$save_info);
						   //判断是否需要长时间保存登录
						   if($rembername){
						      //保存10
							  $time=60*60*24*10+time();
							  
							  cookie(session_name(),session_id(),array('expire'=>$time));
							
						   }
						  
						 
						$this->ajaxreturn(array('status'=>1,'msg'=>'登录成功'));
					 
					 
					 
					 }
					  
				 }else{
				 
				      $this->ajaxreturn(array('status'=>0,'msg'=>'用户名或密码错误！'));
				 }
				 
				 
				 
		
		 }
		// echo $status;
	
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
	 
	  //头部粉红条的登录状态验证
	  
	  public function checkLogin(){
	      //看session是否保存有用户信息
		     $login_status=0;  //登录后的标志  0 未登录 1 登录
		  $user_id=session(C("USER_ID"));
		  $user_info=session(C("USER_INFO"));
		   //存在表示用户已经登录
		  if($user_id&&$user_info){
		      $login_status=1;
			  $user_name=$user_info['user_name'];
		      //去查用户用多时候score分
			  $score=M('User')->where(array('user_id'=>$user_id))->field('user_score')->select();
			  // <1000  0  <2000  1 <3000 2  <4000 3 <5000 4   >6000  5
			    if($score[0]['user_score']>=5000){
				    $user_level=5;
				}else if($score[0]['user_score']>=4000){
				    $user_level=4;
				}else if($score[0]['user_score']>=3000){
				    $user_level=3;
				}else if($score[0]['user_score']>=2000){
				    $user_level=2;
				}else if($score[0]['user_score']>=1000){
				    $user_level=1;
				}else{
				   $user_level=1;
				}
			  
		  }else{
		     $login_status=0;
		    
		  
		  }
		 $data['login_status']=$login_status;
		 $data['user_name']=$user_name;
	     $data['user_level']=$user_level;
	     echo json_encode($data);
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  }
	  
	  //退出登录
	  
	  public function  quit(){
	     
		    session(C("USER_ID"),null);
		    session(C("USER_INFO"),null);
			
			$this->redirect('Index/index');
	  
	  
	  
	  
	  }
	  
	
	
    
	
	
	
	
	
}
	
	
?>