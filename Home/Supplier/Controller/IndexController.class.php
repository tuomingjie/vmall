<?php
 /*
  * 供应商管理后台的主文件主要调入DWZ框架
  */
namespace Supplier\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function index(){
		//header("Content-type:text/html;charset=utf-8");
	     //获取管理员信息
	     $Supplier_info=I('session.Supplier_info');
		  //获取管理员id
		 $Supplier_id=$Supplier_info['Supplier_id'];
		


		   //分配到前台
		  $this->admin_info=$admin_info;
		  
	    //引入dwz后台框架
        $this->display();
    }
}