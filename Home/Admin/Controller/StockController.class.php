<?php
/**
 * 库存管理总部版
 * Created by PhpStorm.
 * customer: Administrator
 * Date: 2017/7/11
 * Time: 10:59
 */
namespace Admin\Controller;
use Think\Controller;
class StockController extends CommonController{
    public function index(){
        $goods_name = I('goods_name');
        $map = $this->_search();
        if(method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $model = M('stock');
        //根据商品名查询
        if(!empty($goods_name)){
            $con['goods_name'] = array('LIKE','%'.$goods_name.'%');
            $temp = M('goods')->field('goods_id')->where($con)->select();
            $goods_id = array();
            for ($i=0;$i<count($temp);$i++){
                $goods_id[$i] = $temp[$i]['goods_id'];
            }
            $map['goods_id'] =array('in',$goods_id);
        }
        if(!empty($model)) {
            $this->_list2($model, $map);
        }
        $customer = M('customer')->select();
        $this->assign('customer',$customer);
        $this->display();
        return;

    }
    //入库记录列表
    public function log(){
        $goods_name = I('goods_name');
        $map = $this->_search();
        if(method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $model = M('stock_desc');
        //根据商品名查询
        if(!empty($goods_name)){
            $con['goods_name'] = array('LIKE','%'.$goods_name.'%');
            $temp = M('goods')->field('goods_id')->where($con)->select();
            $goods_id = array();
            for ($i=0;$i<count($temp);$i++){
                $goods_id[$i] = $temp[$i]['goods_id'];
            }
            $map['goods_id'] =array('in',$goods_id);
        }
        if(!empty($model)) {
            $this->_list2($model, $map);
        }
        if(!empty($model)) {
            $this->_list2($model, $map);
        }
        $customer = M('customer')->select();
        $this->assign('customer',$customer);
        $this->display();
        return;
    }
    //库存调拨记录表
    public function redeploy_log(){
        $redeploy_id = I('redeploy_no');
        $map = $this->_search();
        if(method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $model = M('stock_redeploy_log');
        if(!empty($redeploy_id)){
            $map['redeploy_no'] = array('LIKE','%'.$redeploy_id.'%');
        }

        if(!empty($model)) {
            $this->_list1($model, $map);
        }
        $this->display();
        return;
    }
    //商品入库页面
    public function add()
    {
        $customer = M('customer')->select();
        $goods = M('goods')->select();//获取商品列表
        $this->assign('goods',$goods);
        $this->assign('customer',$customer);
        $this->display();
    }
    //执行入库操作
    public function add_action(){
        $stock_no =date('YmyHis',time()).rand(10000,99999);//生成入库单号
        $goods_id = I('goods_id');
        $goods_num = I('goods_num');
        $goods_buy_price = I('goods_buy_price');
        $goods_sell_price = I('goods_sell_price');
        $storehouse_id = I('storehouse_id');

        $length = count($goods_id);
        if($length == 0){
            $ret['status'] = 'error';
            $ret['msg'] = '请添加商品';
            $this ->ajaxReturn($ret);
        }
        //库存主表插入、更新
        for($j=0;$j<$length;$j++){
            $con['storehouse_id'] = $storehouse_id;
            $con['goods_id'] = $goods_id[$j];
            $stock = M('stock')->where($con)->find();
            if(!empty($stock)){
                $data2['updata_time'] = time();
                $data2['stock_num'] = $goods_num[$j]+$stock['stock_num'];
                $res2 = M('stock')->where($con)->save($data2);
            }else{
                $data3['storehouse_id'] = $storehouse_id;
                $data3['updata_time'] = time();
                $data3['goods_id'] = $goods_id[$j];
                $data3['stock_num'] = $goods_num[$j];
                $res2 = M('stock')->add($data3);
            }

        }
        //插入入库明细记录
        if(!empty($res2)){
            for ($i=0;$i<$length;$i++){
                $data1['goods_id'] = $goods_id[$i];
                $data1['goods_num'] = $goods_num[$i];
                $data1['goods_buy_price'] = $goods_buy_price[$i];
                $data1['goods_sell_price'] = $goods_sell_price[$i];
//                $data1['stock_id'] = $res2;
                $data1['addtime'] = time();
                $data1['storehouse_id'] = $storehouse_id;
                $data1['stock_no'] = $stock_no;
                $res1 = M('stock_desc')->add($data1);//插入库存明细表
                if(!empty($res1)){
                    $ret['status'] = 'success';
                    $ret['msg'] = '入库成功';
                }else{
                    $ret['status'] = 'error';
                    $ret['msg'] = '入库失败';
                    $this ->ajaxReturn($ret);
                }
            }
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '入库失败';
        }
        $this ->ajaxReturn($ret);
    }
    //请求商品列表
    public function goods()
    {
        $list = M('goods')->select();
        if(!empty($list)){
            $ret['status'] = 'success';
            $ret['list'] = $list;
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '没有商品';
        }
        $this ->ajaxReturn($ret);
    }
    //请求仓库列表
    public function storehouse()
    {
        $list = M('customer')->select();
        if(!empty($list)){
            $ret['status'] = 'success';
            $ret['list'] = $list;
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '没有商品';
        }
        $this ->ajaxReturn($ret);
    }
    //请求指定仓库商品
    public function stock_goods_name(){
        $id = I('storehouse_id');
        $con['storehouse_id'] = $id;
            $stock = M('stock')->where($con)->select();
            $goods_id = array();
            foreach ($stock as $key=>$val){
                $goods_id[$key] = $stock[$key]['goods_id'];
            }
            $con2['goods_id'] = array('in',$goods_id);
            $goodslist = M('goods')->field('goods_id,goods_name')->where($con2)->select();
            if($goodslist){
                $ret['status'] = 'success';
                $ret['list'] = $goodslist;
            }else{
                $ret['status'] = 'error';
                $ret['stock_num'] = '找不到数据';
            }
        $this ->ajaxReturn($ret);


    }
    //请求商品库存
    public function stock_num(){
        $con['goods_id'] = I('goods_id');
        $con['storehouse_id'] = I('storehouse_id');
        $data = M('stock')->where($con)->find();//根据good_id请求当前库存
        if(!empty($data)){
            $ret['status'] = 'success';
            $ret['stock_num'] = $data['stock_num'];
        }else{
            $ret['status'] = 'error';
            $ret['stock_num'] = 0;
        }
        $this ->ajaxReturn($ret);
    }
    //执行删除
    public function delete()
    {
        $con['stock_desc_id'] = I('get.stock_desc_id');
        $stock_desc = M('stock_desc')->where($con)->find();



        $res = M('stock_desc')->where($con)->delete();
        if(!empty($res)){
            //更新库存
            $con1['storehouse_id'] = $stock_desc['storehouse_id'];
            $con1['goods_id'] = $stock_desc['goods_id'];
            $stock = M('stock')->where($con1)->find();
            $data['updata_time'] = time();
            $data['stock_num'] = $stock['stock_num']-$stock_desc['goods_num'];
            $res2 = M('stock')->where($con1)->save($data);
            $this->success(L('删除成功'));
        }else{
            $this->error(L('删除失败'));
        }
    }
    //修改页面
    public function edit(){
        $goods = M('goods')->select();//获取商品列表
        $desc_id = I('stock_desc_id');
        $con['stock_desc_id'] = $desc_id;
        $data = M('stock_desc')->where($con)->find();
        $con2['customer_id'] = $data['storehouse_id'];
        $customer = M('customer')->where($con2)->find();
        $data['customer_name'] = $customer['customer_name'];

        $this->assign('customer',$customer);
        $this->assign('data',$data);
        $this->assign('desc_id',$desc_id);
        $this->assign('goods_id',$data['goods_id']);
        $this->assign('goods',$goods);
        $this->display();
    }
    //执行修改入库信息
    public function edit_action(){
        $stock_desc_id = I('stock_desc_id');
        $goods_id = I('goods_id');
        $goods_num = I('goods_num');
        $goods_buy_price = I('goods_buy_price');
        $goods_sell_price = I('goods_sell_price');
        //查询当前记录的信息
        $con['stock_desc_id'] = $stock_desc_id;
        $stock_desc = M('stock_desc')->where($con)->find();
        $storehouse_id = $stock_desc['storehouse_id'];

        //更新入库主表
        $con1['goods_id'] = $stock_desc['goods_id'];
        $con1['storehouse_id'] = $storehouse_id;
        $stock = M('stock')->where($con1)->find();

        //  判断入库商品是否改变，然后再判断数量是否改变
        if($goods_id == $stock_desc['goods_id']){
            $num = $goods_num - $stock_desc['goods_num'];
            $data0['updata_time'] = time();
            $data0['stock_num'] = $stock['stock_num']+$num;
            $res2 = M('stock')->where($con1)->save($data0);
        }else{
            //商品已经改变，先减去当前产品库存，然后判断当前仓库是否存在该商品
            $data１['updata_time'] = time();
            $data１['stock_num'] = $stock['stock_num'] -$stock_desc['goods_num'];//商品现有库存，减去本次入库数量
            $res2 = M('stock')->where($con1)->save($data１);

             if(!empty($res2)){
                 //判断当前仓库是否存在该商品
                 $con12['goods_id'] = $goods_id;
                 $con12['storehouse_id'] = $storehouse_id;
                 $stock2 = M('stock')->where($con12)->find();
                 if(!empty($stock2)){
                     //存在就更新数量
                     $data2['updata_time'] = time();
                     $data2['stock_num'] = $stock2['stock_num']+$goods_num;
                     $res2 = M('stock')->where($con12)->save($data2);
                 }else{
                     //不存在就主库存表增加
                     $data3['storehouse_id'] = $storehouse_id;
                     $data3['updata_time'] = time();
                     $data3['goods_id'] = $goods_id;
                     $data3['stock_num'] = $goods_num;
                     $res2 = M('stock')->add($data3);
                 }
             }else{
                 $ret['status'] = 'error';
                 $ret['msg'] = ' 库存修改失败';
                 $this ->ajaxReturn($ret);
             }

        }
        //更新入库明细
        $data['goods_id'] = $goods_id;
        $data['goods_num'] = $goods_num;
        $data['goods_buy_price'] = $goods_buy_price;
        $data['goods_sell_price'] = $goods_sell_price;

        $res = M('stock_desc')->where($con)->save($data);//插入库存明细表
        if(!empty($res)){
            $ret['status'] = 'success';
            $ret['msg'] = '修改成功';
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '修改失败';
        }
        $this ->ajaxReturn($ret);
    }
    //库存调拨
    public function redeploy(){

        //获取当前仓库的所有产品
        $con1['storehouse_id'] = 0;
        $stock = M('stock')->field('goods_id,stock_num')->where($con1)->select();
        $goods_id = array();
        foreach ($stock as $key=>$val){
            $goods_id[$key] = $stock[$key]['goods_id'];
        }
        $con2['goods_id'] = array('in',$goods_id);
        $goodslist = M('goods')->where($con2)->select();
//        print_r($goodslist);die;
        //获取所有仓库
        $customerlist = M('customer')->select();
//        print_r($con);die;
        //获取第一条数据
        $con3['goods_id'] = $stock[0]['goods_id'];
        $data = M('goods')->where($con3)->field('goods_id,goods_name')->select();
        $this->assign('customerlist',$customerlist);
        $this->assign('goodslist',$goodslist);
        $this->assign('data',$data);
        $this->assign('goods_id',$data);//获取第一个产品id
        $this->assign('storehouse_id',$data);
        $this->display();
    }
    //执行库存调拨
    public function redeploy_action(){
        $redeploy_no =date('YmyHis',time()).rand(10000,99999);//生成单号
        $goods_num = I('goods_num');
        $goods_id = I('goods_id');
        $out = I('out');
        $into =I('into');
        $stock_num =I('stock_num');//剩余库存
//        print_r($goods_id);die;
        if($out == $into){
            $ret['status'] = 'error';
            $ret['msg'] = '调出调入仓库不能一样';
            $this ->ajaxReturn($ret);
//            $this->error(L('调拨数量不能大于库存数量'));
        }
        if($goods_num > $stock_num){
            $ret['status'] = 'error';
            $ret['msg'] = '调拨数量不能大于库存数量';
            $this ->ajaxReturn($ret);
//            $this->error(L('调拨数量不能大于库存数量'));
        }
        $length = count($goods_id);
        //插入调拨记录表
        for ($i=0;$i<$length;$i++){
            $data['goods_num'] = $goods_num[$i];
            $data['goods_id'] = $goods_id[$i];
            $data['out_storehouse_id'] = $out;
            $data['into_storehouse_id'] = $into;
            $data['addtime'] = time();
            $data['redeploy_no'] = $redeploy_no;
            $res = M('stock_redeploy_log')->add($data);
        }
        if(!empty($res)){
            for($j=0;$j<$length;$j++){
                //如果插入数据成功，更新调出仓库库存
                $con1['goods_id'] = $goods_id[$j];
                $con1['storehouse_id'] = $out;
                $data1['stock_num'] = $stock_num[$j] - $goods_num[$j];
                $data1['updata_time'] = time();
                M('stock')->where($con1)->save($data1);
                //更新调入仓库库存
                $con2['goods_id'] = $goods_id[$j];
                $con2['storehouse_id'] = $into;
                $stock = M('stock')->where($con2)->find();
                if(!empty($stock)){
                    //存在就更新数量
                    $data2['updata_time'] = time();
                    $data2['stock_num'] = $stock['stock_num']+$goods_num[$j];
                    $res2 = M('stock')->where($con2)->save($data2);
                }else{
                    //不存在库存表增加
                    $data3['storehouse_id'] = $into;
                    $data3['updata_time'] = time();
                    $data3['goods_id'] = $goods_id[$j];
                    $data3['stock_num'] = $goods_num[$j];
                    $res2 = M('stock')->add($data3);
                }
                if(!empty($res2)){
                    $ret['status'] = 'success';
                    $ret['msg'] = '调拨成功';
                }else{
                    $ret['status'] = 'error';
                    $ret['msg'] = '调拨失败';
                    $this ->ajaxReturn($ret);
                }
            }

//            $this->success(L('调拨成功'));
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '调拨失败';
//            $this->error(L('调拨失败'));
        }
        $this ->ajaxReturn($ret);
        //
//        $data['operator'] = $goods_num;
    }
    //调拨记录
    protected function _list1($model, $map = array(), $sortBy = '', $asc = false) {

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
        foreach ($list as &$data){
            $con2['goods_id'] = $data['goods_id'];
            $goods = M('goods')->where($con2)->field('goods_name')-> find();
            $data['goods_name'] = $goods['goods_name'];

            $con3['customer_id'] = $data['out_storehouse_id'];
            $customer =M('customer')->where($con3)->field('customer_name')-> find();
            $data['out_customer_name'] = $customer['customer_name'];
            $con4['customer_id'] = $data['into_storehouse_id'];
            $customer2 =M('customer')->where($con4)->field('customer_name')-> find();
            $data['into_customer_name'] = $customer2['customer_name'];
        }
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
    //库存记录
    protected function _list2($model, $map = array(), $sortBy = '', $asc = false) {

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
        foreach ($list as &$data){
            $data['goods_profit'] = $data['goods_sell_price']-$data['goods_buy_price'];

            $con2['goods_id'] = $data['goods_id'];
            $goods = M('goods')->where($con2)->field('goods_name')-> find();
            $data['goods_name'] = $goods['goods_name'];

            $con3['customer_id'] = $data['storehouse_id'];
            $customer =M('customer')->where($con3)->field('customer_name')-> find();
            $data['customer_name'] = $customer['customer_name'];

        }
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
//更新主表库存