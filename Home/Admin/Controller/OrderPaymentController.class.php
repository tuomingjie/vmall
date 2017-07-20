<?php
 /*
  * 网站后台支付方式管理
  */
namespace Admin\Controller;

class OrderPaymentController extends CommonController{
	//添加支付方式
	public function insert(){
		$model = D('order_payment');
		unset( $_POST[$model->getPk()]);
		
		if (false === $model->create()) {
			$this->error($model->getError());
		}
		//保存当前数据对象
		if ($result = $model->add()) { //保存成功
			// 回调接口
			if (method_exists($this, '_tigger_insert')) {
				$model->id = $result;
				$this->_tigger_insert($model);
			}
			
			//成功提示
			$this->success(L('新增成功'));
		} else {
			//失败提示
			$this->error(L('新增失败').$model->getLastSql());
		}

	}

 
	   
	   
	   
	   }