<?php
    /*
	 *这是用户意见的控制器  ajax的形式存取结果
	 */
namespace Home\Controller;
use Think\Controller;
class AdviceController extends Controller {
    public function index(){
	       //获取意见写入到数据库中
		  $phone=I('post.conect');
		  $content=I("post.content");
		  $select=I("post.select");
		  $time=time();
		  $data['advice_question_content']=$content;
		  $data['advice_question_user']=$phone;
		  $data['advice_question_time']=$time;
		  $data['advice_category_id']=$select;
		  
		  M("AdviceQuestion")->add($data);
       
    }
	
	public function makeCategory(){
	      //返回用户意见类型
		  $category_status=0;
		  $category_info=M("AdviceCategory")->select();
		  if(empty($category_info)){
		       $category_status=0;
		  }else{
		       $str="<option selected='selected'>请选择疑问类型</option>";
		       foreach($category_info as  $cat){
			       
				   $str.="<option value='{$cat['advice_category_id']}'>{$cat['advice_category_title']}</option>";
			   
			   }
		       $category_status=1;
		        
		  }
	
	      $data['status']= $category_status;
		  $data['content']=$str;
		  echo json_encode($data);
	
	
	
	
	}
	
	
	 
	 //生成验证码
	public function verify(){
	    $config =    array(  
   		    'fontSize'    =>  15,    // 验证码字体大小   
		    'length'      => 3,     // 验证码位数   
			'imageW'=>74,
			'imageH'=>34,
		    'useNoise'    =>    false, // 关闭验证码杂点
		 );
		 
		 
		 
		 $Verify =new \Think\Verify($config);
		 $Verify->entry();
    }
	  
	   //检验验证码的正确性  ajax的形式返回
	public function checkVerify($code, $id = ''){
	    //验证码的标志
		$verify_status=0;  //0 fail  1 ok 
		 
		 $code=I("get.code");
		
		 $verify = new \Think\Verify();    
		  
		  //验证合法性
		 if($verify->check($code, $id)){
		     $verify_status=1;
		 }else{
		     $verify_status=0;
		 }
	
	     echo  $verify_status;
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}