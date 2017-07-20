<?php
/*
  * 网站后台帮助中心Model类
  */
namespace Home\Model;
use Think\Model\ViewModel;
Class HelpViewModel extends ViewModel{
	 public $viewFields = array(     
	 'Help_question'=>array('help_question_id','help_title','help_content'),     
	 'Help_category'=>array('help_category_name','_on'=>'help_question.help_category_id=Help_Category.help_category_id'),     
	);		 		
}