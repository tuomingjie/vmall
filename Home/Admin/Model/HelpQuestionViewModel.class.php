<?php
/*
  * ��վ��̨��������Model��
  */
namespace Admin\Model;
use Think\Model\ViewModel;
Class HelpQuestionViewModel extends ViewModel{
	 public $viewFields = array(     
	 'Help_question'=>array('help_question_id','help_title','help_content'),     
	 'Help_category'=>array('help_category_name','_on'=>'help_question.help_category_id=Help_Category.help_category_id'),     
	);		 		
}