<?php
/*
 * 这是用户的账户控制器Account
 */
namespace Admin\Controller;
use Think\Controller;
class UserPaymentController extends CommonController{
    	public function index() {
		//列表过滤器，生成查询Map对象
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		//判断采用自定义的Model类
		if(!defined("UserPaymentView")){
		   $model = D("UserPaymentView");
		}
		
		if(!empty($model)) {
			$this->_list($model, $map);
		}
		
		$this->display();
		return;
	}
	
	
	

	
	
	//删除状态
	public function delete_tag(){
		//删除指定记录
		$model = M("UserPaymentView");
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST[$pk];
			if (isset($id)) {
				
				$condition = array($pk => array('in', explode(',', $id)));
				if (false !== $model->where($condition)->setField('is_delete',1)) {
					$this->success(L('删除成功'));
				} else {
					$this->error(L('删除失败'));
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	
	/**
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * @param string $name 数据对象名称
	 * @return HashMap
	 */
	protected function _search($name='') {
		//生成查询条件
		if (empty($name)) {
			$name = "UserPaymentView";
		}
		$model = M($name);
		$map = array();
		foreach ($model->getDbFields() as $key => $val) {
			if (substr($key, 0, 1) == '_')
				continue;
			if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
				$map[$val] = $_REQUEST[$val];
			}
		}
		return $map;
	}
	
	



	
	

}