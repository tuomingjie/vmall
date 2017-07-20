<?php
 /*
  * 网站后台客户管理
  * 继承Common控制器实现逻辑
  */
namespace Admin\Controller;
use Think\Controller;
class CustomerController extends CommonController {
      
	
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
		//搜索条件查询
        $region_id = I('region_id');
        $region_id2 = I('region_id2');
        //省级
		if(!empty($region_id)){
		    //根据id查询同级
            $con1['parent_id'] = $region_id;
            $data = M('region') ->field('region_id')-> where($con1)->select();
            $temp = array();
            for ($i=0;$i<count($data);$i++){
                $temp[$i] = $data[$i]['region_id'];
            }
		    $map['region_id'] = array('in',$temp);
        }
        //市级
        if(!empty($region_id2)){
            //根据id查询同级
            $con2['region_id'] = $region_id2;
            $data = M('region') ->field('region_id')-> where($con2)->select();
            $temp = array();
            for ($i=0;$i<count($data);$i++){
                $temp[$i] = $data[$i]['region_id'];
            }
            $map['region_id'] = array('in',$temp);
        }
		if(!empty($model)) {
			$this->_list($model, $map);
		}

		$province = M('region') -> where('region_type=1') -> select();

		$this -> assign('province',$province);

		$this -> display();
		return;
	}
	
	
    //添加代理
	function add(){
		//$customer = M('customer');
		$region = M('region');
		
		$where['region_id'] = array('GT',1);
		$info = $region->where($where)->select();
		
		$one = array();
		$two = array();
		$three = array();
		
		foreach($info as $k=>$v){
			if($v['region_type']==1){
				$one[] = $v;
			}
			
			if($v['region_type']==2){
				$two[] = $v;
			}
			
			if($v['region_type']==3){
				$three[] = $v;
			}
			
		}

		$this->assign('one',$one);
		$this->assign('two',$two);
		$this->assign('three',$three);
		$this->display('Customer/add');

	}
	
	
	//ajax  加载地区
	function ajax_region(){
		$parent_id = trim(I('post.parent_id',0));
		
		
		$region = M('region');
		$where['parent_id'] = $parent_id;
		$list = $region->where($where)->select();
	
		if(!empty($list)){
			$arr = array(
				'status'=>1,
				'info'=>$list
			);
			$this->ajaxReturn($arr);
		}else{
			$arr = array(
				'status'=>0,
				'info'=>'没有数据'
			);
			$this->ajaxReturn($arr);
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
		

		$region = M('region');
		
		foreach($list as $k=>$v){
			$where['region_id'] = $v['region_id'];
			$region_list = $region->where($where)->field('region_name,region_type,parent_id')->find();
			$list[$k]['region_name'] = $region_list['region_name'];
            $list[$k]['region_type'] = $region_list['region_type'];
			//获取上一级名称
            $con['region_id'] = $region_list['parent_id'];
            $region_data = $region->where($con)->field('region_name')->find();
            $list[$k]['parent_name'] = $region_data['region_name'];

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
	
	
	public function edit() {
		$model = M(CONTROLLER_NAME);
		$id = $_REQUEST[$model->getPk()];
		$vo = $model->find($id);
		
		
		$region = M('region');
		
		$where['region_id'] = array('GT',1);
		$info = $region->where($where)->select();
		
		$one = array();
		$two = array();
		$three = array();
		
		foreach($info as $k=>$v){
			if($v['region_type']==1){
				$one[] = $v;
			}
			
			if($v['region_type']==2){
				$two[] = $v;
			}
			
			if($v['region_type']==3){
				$three[] = $v;
			}
			
		}
		
		

		$this->assign('one',$one);
		$this->assign('two',$two);
		$this->assign('three',$three);
		
		$this->assign('vo', $vo);
		$this->display('edit');
	}
	//获取选择省份之后的市区列表
	public function city(){
	    $con['parent_id'] = I('pid');
	    $city = M('region')->where($con)->select();
	    if(!empty($city)){
            $ret['list'] = $city;
        }else{
            $ret['list'] = 0;
        }

	    $this->ajaxReturn($ret);
    }
}