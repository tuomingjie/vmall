<?php
 /*
  * 网站后台商品属性值管理
  */
namespace Admin\Controller;
use Think\Controller;
class AvalueController extends CommonController {
      //重写新增属性值方法
      public function  add(){
	     //获取商品属性的传到前台
		 $at=M("attr");
		 $attr=$at->select();
		 $this->attr=$attr;
		 //调用父类的方法
		 parent::add();
		 
	  
	  
	  }
	  
	  public function edit(){
	      //获取商品属性的传到前台
		 $at=M("attr");
		 $attr=$at->select();
		 $this->attr=$attr;
		  parent::edit();
	  
	  
	  
	  
	  }
	  
    
}