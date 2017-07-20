<?php
	/*
   *个人中心主页控制器
   *
   */
namespace Home\Controller;
use Think\Controller;
class PersonCenterController extends CommonController {
    public function index(){
		  //判断用户是否登录;没有登录就跳转到登录页
		  $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
		  //登录了;就判断用户的信息
		  $user_info=M('User')->where(array('user_id'=>$user_id))->select();
		  
		  $this->user_info=$user_info[0];
		  //遍历密保问题到前台去修改
		  $secure_info=M("Secure")->select();
		 
		  $this->secure_info=$secure_info;
        //友情链接
        $Index = M('link');

        $Linklist = $Index->select();


        $this->links=$Linklist;
		  $this->display();
    }
	    //修改用户的信息
	public function modifierUser(){
	     //修改用户信息
		 $modifier_status=0;
		 $user_id=session(C("USER_ID"));
		 $true_name=I('post.true_name');
		 $user_email=I('post.user_email');
		 $secure_question=I('post.secure_question');
		 $secure_answer=I("post.secure_answer");
		 
		 if(!empty($user_email)){
		      $data['user_email']=$user_email;
		 
		 }
		 if(!empty($secure_answer)){
		      $data['user_answer']=$secure_answer;
			  $data['secure_id']=$secure_question;
		 }
		 $data['true_name']=$true_name;
		 
		
		 $user_info=M('User')->where(array('user_id'=>$user_id))->save($data);
		
		 if($user_info){
		     $modifier_status=1;
		 
		 }else{
		      $modifier_status=0;
		 }
	
	     echo $modifier_status;
	
	}
	
	public function pwd(){
	    //修改密码
		 $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
        //友情链接
        $Index = M('link');

        $Linklist = $Index->select();


        $this->links=$Linklist;
	   $this->display();
	}
	
	public  function modifierPwd(){
	      //修改密码的操作
		   $user_id=session(C("USER_ID"));
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
	     $pwd_status=0;
		 
		 $old_pwd=I('post.old_pwd','','md5');
		 $new_pwd=I('post.new_pwd');
		 $user_id=session(C("USER_ID"));
		 
		 if(empty($user_id)){
		     $pwd_status=0;
		 }else{
		      
			  $user_info=M("User")->where(array('user_id'=>$user_id,'user_pwd'=>$old_pwd))->save(array('user_pwd'=>md5($new_pwd)));
			  if($user_info){
			      $pwd_status=1;
				   //如果修改成功,就要让用户重新登录
			     session(C("USER_ID"),null);
				  session(C("USER_INFO"),null);
			  }else{
			     $pwd_status=0;
			  }
		       
		 
		 }
		  
	     echo $pwd_status;
	
	
	}
	
	public function account(){
	    //账户余额
	   $user_id=session(C("USER_ID"));
	   
		  if(empty($user_id)){
		      
			 $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
	     //查询账户余额
		$account=M("User")->where(array('user_id'=>$user_id))->field("user_money")->select();
		$this->account_money=number_format($account[0]['user_money'],2);
		//查询用户的明细单
		$status=1;//是否有数据
		//引入数据分页类
		
		$User = M('UserPayment'); // 实例化User对象
		$count = $User->where(array('user_id'=>$user_id))->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,6);//每页显示6
		
		$show       = $Page->show();// 分页显示输出
		$list = $User->where(array('user_id'=>$user_id))->order('user_payment_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		
		if($count==0){
		     $data_status=0;
			 $none_hide="";
		}else{
		     $data_status=1;
			 $none_hide="hide";
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->data_status=$data_status;
		$this->none_hide=$none_hide;

        //友情链接
        $Index = M('link');

        $Linklist = $Index->select();


        $this->links=$Linklist;
		
	
	  $this->display();
	}
	
	//地址信息
	
	public function  address(){
	     $user_id=session(C("USER_ID"));
		 if(empty($user_id)){
		     $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		 }
		 
		 $address_info=M('Address')->where(array('user_id'=>$user_id))->order('address_lock desc')->select();
		 
		 
		 $this->address_info=$address_info;
        //友情链接
        $Index = M('link');

        $Linklist = $Index->select();


        $this->links=$Linklist;
		 
		 $this->display();
	
	
	
	
	
	
	
	}
	   
	public function delAddress(){
	        //删除地址
	      $user_id=session(C("USER_ID"));
		     if(empty($user_id)){
		     $this->redirect('Login/index','', 3, '未登录,页面跳转到登录页面中...');
		     exit;
		  
		  }
		  
		  $address_id=I('get.address_id');
		  $address_lock=M('Address')->where(array('address_id'=> $address_id))->field('address_lock')->select();
		 
		  if($address_lock[0]['address_lock']){
		      //表示删除是默认地址
			  $this->error("默认地址不能删除");
		  }else{
		     
		      $del_info=M('Address')->where(array('address_id'=>$address_id))->delete();
			  if($del_info){
			      $this->success('删除成功!',U('PersonCenter/address'),2);
			  }else{
			       $this->error('删除失败');
			  }
		  
		  }
	
	
	
	}
	
	public function  addAddress(){
	      //增加地址
		  
		 $address_phone=I("post.mobile");
		 $address_name=I("post.address_name");
		 $s_province=I("post.s_province");
		 $s_city=I("post.s_city");
		 $s_county=I("post.s_county");
		 $address=I("post.address");
		 $zipCode=I("post.zipCode");
		 $defaultFlag=I('post.defaultFlag');
		 
			 
		if(empty($address_phone)||!preg_match('/^1\d{10}$/',$address_phone)){
		     
			 $this->error("手机号不和要求");
		
		}	
        if(empty($address_name)){
		     
			 $this->error("联系人不能为空");
		
		}	
		if($s_provice=="选择省份"){
		     $this->error("请选择省份");
		}
		
		if($s_city=="选择市"){
		     $this->error("请选择市");
		}
		
		if($s_county=="选择县区"){
		     $this->error("请选择县区");
		}
		if(empty($address)){
		    $this->error("请填写地址详情");
		}
		 
        $user_id=session(C("USER_ID"));
		if($defaultFlag==1){
		     //如果1表示要设置为默认地址 需要先去除以前的默认地址
			 
			 M("Address")->where(array('user_id'=>$user_id))->save(array('address_lock'=>0));
		
		}
		//进行数据插入
		if($defaultFlag==1){
		    $data['address_lock']=1;
		}
		
		
		$data['address_name']=$address_name;
		$data['address_phone']=$address_phone;
		$data['address_post']=$zipCode;
	    $data['user_id']=$user_id;
		$data['address_content']=$s_province.$s_city.$s_county.$address;
		
		$add_info=M("Address")->add($data);
		if($add_info){
		   $this->success('插入成功',U("PersonCenter/address"),3);
		}else{
		   $this->error('插入失败');
		}
	
	
	}

	
	
}