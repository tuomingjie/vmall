<?php
 /*
  * 网站后台帮助分类管理
  */
namespace Home\Controller;
use Think\Controller;
class HelpController extends Controller
{
	
	public function vmall() {
		
		  /*  $help_catgory=M('HelpCategory')->select();
		   $new_array=array();
		    foreach($help_catgory as $cat){
			$question_ids=M('HelpQuestion')->where(array('help_category_id'=>$cat['help_category_id']))->field('help_question_id,help_title')->select();
				
				$new_array[$cat['help_category_id']]=array('category_title'=>$cat['help_category_name'],'category_content'=>$question_ids);
			
		  }
		   
		 $this->help_category=$help_catgory;
		 $this->help_questions=$new_array;
		 
         //dump($new_array);	 */	 
		
		  
	     $this->display();	  
	    
	}	
	
   public function bd(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function buy(){
   
   
        $this->display();	  
         
   
   
   }
   
   
    public function company(){
   
   
        $this->display();	  
         
   
   
   }
   
   
	public function delivery(){
   
   
        $this->display();	  
         
   
   
   }
    public function deliverySelect(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function index(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function order(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function orderDel(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function paymentHDFK(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function regAgreement(){
   
   
        $this->display();	  
         
   
   
   }
   
    public function regForget(){
   
   
        $this->display();	  
         
   
   
   }
   
   
   
   


	
}