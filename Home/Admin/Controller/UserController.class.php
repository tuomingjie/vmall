<?php
/*
 * 这是（用户信息管理）控制器User
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
	
	//用户添加
	public function add(){
		
		$secure = M('secure');
		$secure_info = $secure->select();
		$this->assign('secure',$secure_info);
		$customer = M('customer');
		$customer_info = $customer->select();
		$this->assign('customer_info',$customer_info);
		parent::add();
	}
	
	public function insert(){
		$_POST['user_login_time'] = time();

		parent::insert();
	}
	
	
	 //用户更改界面
	public function edit(){
		
		$secure = M('secure');
		$secure_info = $secure->select();
		$this->assign('secure',$secure_info);
		$customer = M('customer');
		$customer_info = $customer->select();
		$this->assign('customer_info',$customer_info);
		parent::edit();
	}
	
	
	public function update(){
		
		$user = M('User');
		
	     //接受数据进行处理
		 
	     $data=I('post.');
		
		if(empty($data['user_pwd'])){
			unset($data['user_pwd']);
		}else{
			$data['user_pwd'] = md5($data['user_pwd']);
		}
		
		if(empty($data['user_answer'])){
			unset($data['user_answer']);
		}
		
		$where['user_id'] = $data['user_id'];
		
		$check = $user->where($where)->save($data);
		if($check){
			 $this->success('更改成功!');
		}else{
			 $this->error('更新失败');
		}

		/*  //判断跟新什么
		
		 if(!empty($user_pwd)){
		     $user_info=M('User')->where(array('user_id'=>$user_id))->save(array('user_lock'=>$user_lock,'user_pwd'=>md5($user_pwd)));
			 if($user_info){
			     $this->success('更改成功!');
			 }else{
			     $this->error('更新失败');
			 }
		 
		 }else if(empty($user_pwd)){
				$data['user_lock'] = $user_lock;
				$data['customer_id'] = $customer_id;
				$user_info=M('User')->where(array('user_id'=>$user_id))->save($data);
			 
				if($user_info){
					 $this->success('更改成功!');
				}else{
					 $this->error('更新失败');
				}
		 }
		  */

	
	
	
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
		$list = $model->where($map)->order($order.' '.$sort)
						->limit($p->firstRow.','.$p->listRows)
						->select();
				
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
		
		$customer = M('customer');
		
		foreach($list as $k=>$v){
			$where['customer_id'] = $v['customer_id'];
			$region_list = $customer->where($where)->field('customer_name')->find();
			$list[$k]['customer_name'] = $region_list['customer_name'];
		}
		

		
		
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