<?php
 /*
  * 供应商后台商品管理
  */
namespace Supplier\Controller;
use Think\Controller;
class GoodsController extends CommonController {
   
   
	public function index() {
		//列表过滤器，生成查询Map对象
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		//判断采用自定义的Model类
		if(!defined(CONTROLLER_NAME)){
		   $model = D(CONTROLLER_NAME);
		}
		$Supplier_info=I('session.Supplier_info');

		$map['supplier_id'] = $Supplier_info['Supplier_id'];
		
		if(!empty($model)) {
			$this->_list($model, $map);
		}
		$this->display();
		return;
	}
   
   
  
}