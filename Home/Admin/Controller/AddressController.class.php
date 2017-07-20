<?php
 /*
  * 网站后台收货方式管理
  */
namespace Admin\Controller;
use Think\Controller;
class AddressController extends CommonController{
	
		public function index() {
 					//列表过滤器，生成查询Map对象
					$map = $this->_search();
					//dump($map);
					if(method_exists($this, '_filter')) {
						$this->_filter($map);
					}
					//判断采用自定义的Model类
					if(!defined("AddressView")){
					   $model = D("AddressView");
					}
					
					if(!empty($model)) {
						$this->_list($model, $map);
					}
					
					$model = D("AddressView")->select();
					$this->assign('list',$model);
					//var_dump($model);
					$this->display();
					return; 
		 
	}

	
}