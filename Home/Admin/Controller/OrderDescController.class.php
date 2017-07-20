<?php
 /*
  * 网站后台订单详情控制器
  */
namespace Admin\Controller;
use Think\Controller;
class OrderDescController extends CommonController{
	
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
		
		
		if(!empty($model)) {
			$this->_list($model, $map);
		}
		$this->display();
		return;
	}
	
	public function edit() {
		
		$model = M(CONTROLLER_NAME);
		$order = M('order');
		$id = I('get.order_desc_id');
		$vo = $model->where(array('order_desc_id'=>$id))->find();
		$order_info = $order->where(array('order_id'=>$vo['order_id']))->field('examine_status')->find();
		$this->examine_status = $order_info['examine_status'];
		$this->assign('vo', $vo);
		$this->display('edit');
	}
	
	public function update(){
		$model = M(CONTROLLER_NAME);
		$order = M('order');
		$order_desc_id = I('post.order_desc_id');	//细订单ID
		$parent_status = I('post.parent_status');	//审核状态
		$where['order_desc_id'] = $order_desc_id;

		if($parent_status==2){
			$order_desc_state = I('post.order_desc_state');	//订单状态
			$courier_number = I('post.courier_number');		//订单单号
			$data['order_desc_state'] = $order_desc_state;
			$data['courier_number'] 	= $courier_number;
		}else{
			$order_desc_num = I('post.order_desc_num',1);	//商品数量
			$total_price = I('post.total_price');		//总金额
			$data['order_desc_num'] = $order_desc_num;
			$data['total_price'] 	= $total_price;
			
			$order_desc_info = $model->where(array('order_desc_id'=>$order_desc_id))->find();	//查询原有的细表数据
			$order_info = $order->where(array('order_id'=>$order_desc_info['order_id']))->find();	//原来的主表数据
			
			if($order_desc_info['total_price'] != $data['total_price']){
				if($order_desc_info['total_price']>$total_price){	//如果旧金额比提交的金额大
					$differ = $order_desc_info['total_price']-$total_price;	//得出相差值
					$order->where(array('order_id'=>$order_info['order_id']))->save(array('order_total_money'=>$order_info['order_total_money']-$differ));		//更新主表总金额
				}
				if($order_desc_info['total_price']<$total_price){	//如果旧金额比提交的金额大
					$differ = $total_price-$order_desc_info['total_price'];	//得出相差值
					$order->where(array('order_id'=>$order_info['order_id']))->save(array('order_total_money'=>$order_info['order_total_money']+$differ));		//更新主表总金额
				}
			}

		}
		
		$check = $model->where($where)->save($data);
	
		if($check){
			//成功提示
			$this->success(L('更新成功'));
		}else {
			//错误提示
			$this->error(L('更新失败'));
		}
	}
	
	
	/**
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
	 */
	protected function _list($model, $map = array(), $sortBy = '', $asc = false) {
		
		//排序字段 默认为主键名
		if (!empty($_REQUEST['_order'])) {
			$order = $_REQUEST['_order'];
		} else {
			$order = !empty($sortBy)?$sortBy:$model->getPk();
		}
		
		//排序方式默认按照倒序排列
		//接受 sort参数 0 表示倒序 非0都 表示正序
		if (!empty($_REQUEST['_sort'])) {
			$sort = $_REQUEST['_sort'] == 'asc'?'asc':'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		
		//取得满足条件的记录数
		$count = $model->where($map)->count();
		
		//每页显示的记录数
		if (!empty($_REQUEST['numPerPage'])) {
			$listRows = $_REQUEST['numPerPage'];
		} else {
			$listRows = '10';
		}
		
		
		//设置当前页码
		if(!empty($_REQUEST['pageNum'])) {
			$nowPage=$_REQUEST['pageNum'];
		}else{
			$nowPage=1;
		}
		$_GET['p']=$nowPage;
		
		//创建分页对象
		$p = new \Think\Page($count, $listRows);
		

		//分页查询数据
		if(!empty($map['order_id'])){
			$where ='0';
			$where = "od.`order_id` = ".$map['order_id'];
			$map = $where;
		} 
		$join = "LEFT JOIN vmall_order o on od.order_id = o.order_id";
		$field = "od.*,o.order_no";
		$list = $model->alias('od')->field($field)->where($map)->join($join)->order($order.' '.$sort)
						->limit($p->firstRow.','.$p->listRows)
						->select();
		//echo $model->getLastSql();die;		
		//回调函数，用于数据加工，如将用户id，替换成用户名称
		if (method_exists($this, '_tigger_list')) {
			$this->_tigger_list($list);
		}
		
		
		//分页跳转的时候保证查询条件
		foreach ($map as $key => $val) {
			if (!is_array($val)) {
				$p->parameter .= "$key=" . urlencode($val) . "&";
			}
		}
	
		//分页显示
		$page = $p->show();
		
		//列表排序显示
		$sortImg = $sort;                                 //排序图标
		$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
		$sort = $sort == 'desc' ? 1 : 0;                  //排序方式
		
		
		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('sort', $sort);
		$this->assign('order', $order);
		$this->assign('sortImg', $sortImg);
		$this->assign('sortType', $sortAlt);
		$this->assign("page", $page);
		
		$this->assign("search",			$search);			//搜索类型
		$this->assign("values",			$_POST['values']);	//搜索输入框内容
		$this->assign("totalCount",		$count);			//总条数
		$this->assign("numPerPage",		$p->listRows);		//每页显多少条
		$this->assign("currentPage",	$nowPage);			//当前页码
		
	}
	
}