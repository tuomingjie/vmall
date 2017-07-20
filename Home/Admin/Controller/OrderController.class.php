<?php
 /*
  * 网站后台订单控制器
  */
namespace Admin\Controller;
use Think\Controller;
class OrderController extends CommonController{
	
		public function index() {
			//列表过滤器，生成查询Map对象
			$map = $this->_search();
			if(method_exists($this, '_filter')) {
				$this->_filter($map);
			}
			$model = M('order');
			
			if(!empty($model)) {
				$this->_list($model, $map);
			}
			$this->display();
			return;
		}
	
	    public function edit(){
		
			$model = M('order');
			$orderDesc = M('orderDesc');
		    $order_id=I('get.order_id');
			$where['order_id'] = $order_id;
			$vo = $model->where($where)->find();
			
			//判断是否审核状态
			if($vo['examine_status']==2){
				$orderDesc_info = $orderDesc->where(array('order_id'=>$vo['order_id']))->select();
				if(!empty($orderDesc_info)){
					foreach($orderDesc_info as $k=>$v){
						if($v['order_desc_state'] == 200 || $v['order_desc_state'] == 300 || $v['order_desc_state'] == 400 || $v['order_desc_state'] == 500){
							$this->error("该订单无法修改");
						}
					}
				}
			}
			$this->assign('vo', $vo);
			$this->display('edit');
		
		
		}
	
		public function insert(){
			  // 生成订单的编号 有时间和随机数生成
			  $order_no=date("Ymd").mt_rand(100,999);
			  $_POST['order_no']=$order_no;
			
		    //获取订单的属性进行组合处理插入数据库
			$order_attr=I("post.order");
			if(empty($order)){
			  
			      $this->error("请选择订单的属性!");
				  return;
			}
			
			$_POST['order_attr_value']=implode(',',$order_attr);
			//对上传的时间进行处理
			
			$_POST['order_time']=strtotime(I('post.order_time'));
			
			//调用父类的insert方法
	        parent::insert();
	  
	  }
	
	   //update 修改订单
	   
	   public function update(){
	   
	       $order_id=I("post.order_id");
		   $payment_status=I("post.payment_status");
		   $examine_status=I("post.examine_status");
	       $data['payment_status']=$payment_status;
		   $data['examine_status']=$examine_status;
		   $check = M('Order')->where('order_id='.$order_id)->save($data);
		   if($check){
		       $this->success('修改成功');
		   }else{
		       $this->error('修改失败');
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
		$join = "LEFT JOIN vmall_address a on o.address_id = a.address_id LEFT JOIN vmall_user u on o.user_id = u.user_id LEFT JOIN vmall_order_payment p on o.order_payment_id = p.order_payment_id";
		$field = "o.*,u.user_name,a.address_name,a.address_content,p.order_payment_content";
		$list = $model->alias('o')->where($map)->field($field)->join($join)->order($order.' '.$sort)
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
