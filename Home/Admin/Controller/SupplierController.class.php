<?php
 /*
  * 网站后台供应商资料管理
  * 继承Common控制器实现逻辑
  */
namespace Admin\Controller;
use Think\Controller;
class SupplierController extends CommonController {
      
	//添加供应商
	function insert(){
		$_POST['addtime'] = time();
		$_POST['password'] = md5(trim($_POST['password']));
		parent::insert();
	}
	
	//修改供应商信息
	function update(){
		$supplier = M('supplier');
		$data = I('post.');
		if(empty($data['password'])){
			unset($data['password']);
		}else{
		  	$data['password'] = md5($data['password']);
		}

		
		$where['id'] = $data['id'];
		$check = $supplier->where($where)->save($data);
		
		if($check){
			$this->success(L('更新成功'));
		}else{
			$this->error(L('更新失败'));
		}
	}
}