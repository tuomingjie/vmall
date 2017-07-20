<?php
 /*
  * 网站后台帮助分类管理
  */
namespace Admin\Controller;
use Think\Controller;
class HelpQuestionController extends CommonController
{
	public function index() {
 					//列表过滤器，生成查询Map对象
					$map = $this->_search();
					if(method_exists($this, '_filter')) {
						$this->_filter($map);
					}
					//判断采用自定义的Model类
					if(!defined("HelpQuestionView")){
					   $model = D("HelpQuestionView");
					}
					
					if(!empty($model)) {
						$this->_list($model, $map);
					}
					
					$model = D("HelpQuestionView")->select();
					$this->assign('list',$model);
					 //var_dump($model);
					$this->display();
					return; 
		 
	}	


		//重写新增属性值方法
	public function  add(){
	     //获取帮助分类传到前台
		 $hp=M("help_category");
		 $help=$hp->select();
		 
		 $this->help_category=$help;
		 //调用父类的方法
		 parent::add();
		 
	  
	  
	  }
	  
	public function edit(){
	      //获取帮助分类传到前台
		 $hp=M("help_category");
		 $help=$hp->select();
		 $this->help_category=$help;
		  parent::edit();
	  
	  
	  
	  
	  }

	
}