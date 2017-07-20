<?php
 /*
  * 供应商后台订单控制器
  */
namespace Supplier\Controller;
use Think\Controller;
class OrderController extends CommonController{
		public function index() {
 			
			$Supplier_info = session('Supplier_info');
			
			$goods = M('goods');
			$goods_info = $goods->where(array('supplier_id'=>$Supplier_info['Supplier_id']))->field('goods_id')->select();
			//dump($goods_info);
			$str = '';
			foreach($goods_info as $v){
				$str .= $v['goods_id'].',';
			}
			
			$str = trim($str,',');

			$map = $this->_search();
			if(method_exists($this, '_filter')) {
				$this->_filter($map);
			}
			
			$map['goods_id'] = array('IN',$str);
			$map['order_desc_state'] = array('NEQ',100);
			$model = M("OrderDesc");
			$this->_list($model, $map,'order_time');	
			$this->display();
	
					
		 
	}
	
	    public function edit(){
		
		    $order_desc_id=I('get.order_desc_id');
			$this->order_desc_id=$order_desc_id;
			$OrderDesc = M('OrderDesc');
			$order = M('order');
			$vo = $OrderDesc->where(array('order_desc_id'=>$order_desc_id))->find();
			
			if($vo['order_desc_state']==100){
				$this->error('该订单尚未付款，暂时无法发货');
				exit;
			}
			if($vo['order_desc_state']==400){
				$this->error('该订单已完成,无法修改');
				exit;
			}
			if($vo['order_desc_state']==500){
				$this->error('该订单已完成,无法修改');
				exit;
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
	   
	       $order_desc_id=I("post.order_desc_id");
		   $courier_number=I("post.courier_number");
	       $data['courier_number']=$courier_number;
		   $data['order_desc_state']=300;
		   if(M('OrderDesc')->where('order_desc_id='.$order_desc_id)->save($data)){
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
		$join = "LEFT JOIN vmall_order o on od.order_id = o.order_id LEFT JOIN vmall_address a on od.address_id = a.address_id";
		$field = "od.*,o.order_state,o.address_id,o.user_id,o.order_time,a.address_name,a.address_phone,a.address_content";
		$list = $model->alias('od')->where($map)->order($order.' '.$sort)->join($join)->field($field)
						->limit($p->firstRow.','.$p->listRows)
						->select();


		$user = M('user');
	
		foreach($list as $k=>$v){
			
			$user_id = $v['user_id'];
			$user_info = $user->field('user_name')->where(array('user_id'=>$user_id))->find();
			$list[$k]['user_name'] = $user_info['user_name'];
		}
		
		// dump($list[0]);
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
