<?php
/*
 * 这是供应商的登录、退出的控制器
 */
namespace Supplier\Controller;
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
		  
		   $supplier=M('supplier');
		  
		   $data['password']=I('post.password','','md5');
		   $data['name']=I('post.name','');
		   
		   $info=$supplier->where($data)->select(); 


		   if($info){
		        //登录的标志
		        session('SupplierIsLogin',true);
				
				//保存管理员信息
				$Supplier_info['Supplier_id']=$info[0]['id'];
				$Supplier_info['Supplier_name']=$info[0]['name'];
				
				
			     session('Supplier_info',$Supplier_info);
				//跟新管理员的登录时间和ip
				
				
				  $this->redirect("Index/index");
				
		   }else{
		       $this->error("登录失败!");
		   }
		 
	   
	   
	
	
	}
	  //后台退出
	public function quit(){
	        //登录标记改为假
	      session('SupplierIsLogin',false);
		  //删除session信息
	      session('Supplier_info',null);
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
	    $supplier=M('supplier');
		$data['password']=I('post.password','','md5');
		$where['id']=I('post.id');
		
		$status=$supplier->where($where)->save($data);
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