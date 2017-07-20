<?php
/**
 * 库存管理用户版
 * Created by PhpStorm.
 * customer: Administrator
 * Date: 2017/7/11
 * Time: 10:59
 */
namespace Home\Controller;
use Think\Controller;
use think\Session;

class StockController extends CommonController{
    public function index(){
        //获取本仓库与下级
        $customer = $this->same();

        $customer_id = I('get.customer_id');
        $goods_name = I('get.goods_name');

        $model = M('stock');
        //搜索查询
        if(!empty($customer_id)){
            $map['storehouse_id'] = $customer_id;
        }else{
            $customer_arr = array();
            for($i=0;$i<count($customer);$i++){
                $customer_arr[$i] = $customer[$i]['customer_id'];
            }
            $map['storehouse_id'] =array('in',$customer_arr);
        }
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
//        print_r($customer);die;
        $this->assign('customer',$customer);
//        $this->assign('customer_id',$customer_id);
        //友情链接
        $Index = M('link');
        $Linklist = $Index->select();
        $this->links=$Linklist;

        $this->display();
        return;
    }
    //入库记录列表
    public function log(){
        $customer = $this->same();
        $customer_id = I('customer_id');
        $goods_name = I('goods_name');
        $model = M('stock_desc');
        //搜索查询
        if(!empty($customer_id)){
            $map['storehouse_id'] = $customer_id;
        }else{
            $customer_arr = array();
            for($i=0;$i<count($customer);$i++){
                $customer_arr[$i] = $customer[$i]['customer_id'];
            }
            $map['storehouse_id'] =array('in',$customer_arr);
        }

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
        $this->assign('customer',$customer);
        //友情链接
        $Index = M('link');
        $Linklist = $Index->select();
        $this->links=$Linklist;

        $this->display();
        return;
    }
    //库存调配记录表
    public function redeploy_log(){
        $customer = $this->same();
        $customer_id = I('customer_id');

        $model = M('stock_redeploy_log');
        //进仓出仓记录
        if(!empty($customer_id)){
            $condition['out_storehouse_id'] = $customer_id;
            $condition['into_storehouse_id'] = $customer_id;
            $condition['_logic'] = "or";
            $map['_complex']=$condition;
        }else{
            $customer_arr = array();
            for($i=0;$i<count($customer);$i++){
                $customer_arr[$i] = $customer[$i]['customer_id'];
            }
            $condition['out_storehouse_id'] = array('in',$customer_arr);
            $condition['into_storehouse_id'] = array('in',$customer_arr);
            $condition['_logic'] = "or";
            $map['_complex']=$condition;
        }
        if(!empty($model)) {
            $this->_list1($model, $map);
        }
        $this->assign('customer',$customer);

        //友情链接
        $Index = M('link');
        $Linklist = $Index->select();
        $this->links=$Linklist;

        $this->display();

    }
    //商品入库页面
    public function add()
    {
        $customerlist = $this->same();

        $goodslist = $this ->customer_goods();
        $this->assign('goods',$goodslist);
        $this->assign('customerlist',$customerlist);
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
                $data3['user_id'] = session(C("USER_ID"));
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
                $data1['user_id'] = session(C("USER_ID"));
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
        $list = $this->customer_goods();
        if(!empty($list)){
            $ret['status'] = 'success';
            $ret['list'] = $list;
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '没有商品';
        }
        $this ->ajaxReturn($ret);
    }
    //请求所有仓库列表
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
    //请求当前仓库所有商品
    public function stock_goods_name(){
        $con1['storehouse_id'] = I('storehouse_id');
        $stock = M('stock')->field('goods_id')->where($con1)->select();
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
    //请求已经选择仓库，商品库存
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
        $con['stock_desc_id'] = I('del_id');
        $stock_desc = M('stock_desc')->where($con)->find();

        $res = M('stock_desc')->where($con)->delete();
        if(!empty($res)){
            //更新库存
            $con1['storehouse_id'] = $stock_desc['post.storehouse_id'];
            $con1['goods_id'] = $stock_desc['goods_id'];
            $stock = M('stock')->where($con1)->find();
            $data['updata_time'] = time();
            $data['stock_num'] = $stock['stock_num']-$stock_desc['goods_num'];
            $res2 = M('stock')->where($con1)->save($data);
            if($res2){
                $ret['status'] = 'success';
                $ret['msg'] = '删除成功';
            }else{
                $ret['status'] = 'error';
                $ret['msg'] = '删除失败';
            }
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '该记录不存在';
        }
    }
    //修改页面
    public function edit(){
        $goods = $this->customer_goods();//获取商品列表
        $con['stock_desc_id'] = I('stock_desc_id');
        $data = M('stock_desc')->where($con)->find();

        $con2['user_id'] = $data['user_id'];
        $user = M('user')->where($con2)->find();
        $data['user_name'] = $user['user_name'];

        $this->assign('user',$user);
        $this->assign('data',$data);
        $this->assign('goods_id',$data['goods_id']);
        $this->assign('goods',$goods);
        //友情链接
        $Index = M('link');
        $Linklist = $Index->select();
        $this->links=$Linklist;

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
        $stock_desc = M('stock_desc')->where($con)->field('storehouse_id,goods_num,goods_id,user_id')->find();
        $storehouse_id = $stock_desc['storehouse_id'];

        //更新入库主表
        $con1['goods_id'] = $stock_desc['goods_id'];
        $con1['storehouse_id'] = $storehouse_id;
        $stock = M('stock')->where($con1)->find();
        //  判断入库商品是否改变
        if($goods_id == $stock_desc['goods_id']){
            $num = $goods_num - $stock_desc['goods_num'];
            $data0['updata_time'] = time();
            $data0['stock_num'] = $stock['stock_num']+$num;//直接更新库存
            $res2 = M('stock')->where($con1)->save($data0);
        }else{
            //商品已经改变，先减去当前产品库存，然后判断当前仓库是否存在该商品
            $data１['updata_time'] = time();
            $data１['stock_num'] = $stock['stock_num']-$stock_desc['goods_num'];//商品现有库存，减去本次入库数量
            $res2 = M('stock')->where($con1)->save($data１);
            //判断当前仓库是否存在该商品
            if(!empty($res2)){
                //判断当前仓库是否存在该商品
                $con12['goods_id'] = $goods_id;
                $con12['storehouse_id'] = $storehouse_id;
                $stock2 = M('stock')->where($con12)->find();
                if(!empty($stock2)){
                    //存在就更新数量
                    $data2['updata_time'] = time();
                    $data2['stock_num'] = $stock['stock_num']+$goods_num;
                    $res2 = M('stock')->where($con1)->save($data2);
                }else{
                    //不存在就主库存表增加
                    $data3['storehouse_id'] = $storehouse_id;
                    $data3['updata_time'] = time();
                    $data3['goods_id'] = $goods_id;
                    $data3['stock_num'] = $goods_num;
                    $data3['user_id'] = session(C("USER_ID"));
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
        $res = M('stock_desc')->where($con)->save($data);// 更新库存明细表
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
        $con0['storehouse_id'] = $this->customer_id();
        $stock = M('stock')->field('goods_id')->where($con0)->select();
        $goods_id = array();
        foreach ($stock as $key=>$val){
            $goods_id[$key] = $stock[$key]['goods_id'];
        }
        $con2['goods_id'] = array('in',$goods_id);
        $goodslist = M('goods')->field('goods_id,goods_name')->where($con2)->select();

        //获取本仓库，以及下级所有仓库
        $customerlist = $this->same();

        // 获取第一个产品的库存
        $con['storehouse_id'] = $this->customer_id();
        $data = M('stock')->field('stock_num')->where($con)->select();
        $con1['customer_id'] = $this->customer_id();
        $customer = M('customer')->field('customer_name')->where($con1)->find();
//        print_r($customerlist);die;
        $this->assign('customerlist',$customerlist);
        $this->assign('goodslist',$goodslist);
        $this->assign('data',$data[0]);
        $this->assign('customer',$customer);
        //友情链接
        $Index = M('link');
        $Linklist = $Index->select();
        $this->links=$Linklist;

        $this->display();
    }
    //执行库存调拨
    public function redeploy_action(){
        $redeploy_no =date('YmyHis',time()).rand(10000,99999);//生成单号
        $goods_num = I('goods_num');
        $goods_id = I('goods_id');
        $into =I('into');
        $out =I('out');
        $stock_num =I('stock_num');//剩余库存
//        print_r($goods_id);die;
        if($out == $into){
            $ret['status'] = 'error';
            $ret['msg'] = '调出调入仓库不能一样';
            $this ->ajaxReturn($ret);
//            $this->error(L('调拨数量不能大于库存数量'));
        }
//        if($goods_num > $stock_num){
//            $ret['status'] = 'error';
//            $ret['msg'] = '调拨数量不能大于库存数量';
//            $this ->ajaxReturn($ret);
////            $this->error(L('调拨数量不能大于库存数量'));
//        }
        $length = count($goods_id);
        //插入调拨记录表
        for ($i=0;$i<$length;$i++){
            $data['goods_num'] = $goods_num[$i];
            $data['goods_id'] = $goods_id[$i];
            $data['out_storehouse_id'] = $out;
            $data['into_storehouse_id'] = $into;
            $data['addtime'] = time();
            $data['redeploy_no'] = $redeploy_no;
            $data['user_id'] = session(C("USER_ID"));
            $res = M('stock_redeploy_log')->add($data);
        }
        if(!empty($res)){
            for($j=0;$j<$length;$j++){
                //如果插入数据成功，更新调出仓库库存
                $con1['goods_id'] = $goods_id[$j];
                $con1['storehouse_id'] = $out;
                $stock2 = M('stock')->where($con1)->find();
                $data1['stock_num'] = $stock2['stock_num'] - $goods_num[$j];
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
                    $data3['user_id'] = session(C("USER_ID"));
                    $data3['updata_time'] = time();
                    $data3['goods_id'] = $goods_id[$j];
                    $data3['stock_num'] = $goods_num[$j];
                    $res2 = M('stock')->add($data3);
                }
            }
            $ret['status'] = 'success';
            $ret['msg'] = '调拨成功';

//            $this->success(L('调拨成功'));
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '调拨失败';
//            $this->error(L('调拨失败'));
        }
        $this ->ajaxReturn($ret);
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

        $Page       = new \Think\Page($count,10);
        $Page->lastSuffix=false;
        $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条订单&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页&nbsp;&nbsp;');
        $Page->setConfig('prev','<');
        $Page->setConfig('next','>');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        //分页查询数据
        $list = $model->where($map)->order($order.' '.$sort)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach ($list as &$data){
            $con2['goods_id'] = $data['goods_id'];
            $goods = M('goods')->where($con2)->field('goods_name')-> find();
            $data['goods_name'] = $goods['goods_name'];

            if(!empty($data['out_storehouse_id'])){
                $con3['customer_id'] = $data['out_storehouse_id'];
                $customer =M('customer')->where($con3)->field('customer_name')-> find();
                $data['out_customer_name'] = $customer['customer_name'];
            }else{
                $data['out_customer_name'] = '总仓库';
            }
            if(!empty($data['into_storehouse_id'])){
                $con4['customer_id'] = $data['into_storehouse_id'];
                $customer2 =M('customer')->where($con4)->field('customer_name')-> find();
                $data['into_customer_name'] = $customer2['customer_name'];
            }else{
                $data['into_customer_name'] = '总仓库';
            }
            if(!empty($data['user_id'])){
                $con5['user_id'] = $data['user_id'];
                $user =M('user')->where($con5)->field('user_name')-> find();
                $data['user_name'] = $user['user_name'];
            }else{
                $data['user_name'] = '总部';
            }


        }


        //分页显示
        $page = $Page->show();

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
        $this->assign("numPerPage",		$Page->listRows);		//每页显多少条

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
        $Page       = new \Think\Page($count,10);
        //分页跳转的时候保证查询条件

//        foreach ($map as $key => $val) {
//                $Page->parameter .= "$key=" . urlencode($val) . "&";
//
//        }
        $Page->lastSuffix=false;
        $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条订单&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页&nbsp;&nbsp;');
        $Page->setConfig('prev','<');
        $Page->setConfig('next','>');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        //分页查询数据
        $list = $model->where($map)->order($order.' '.$sort)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach ($list as &$data){
            $data['goods_profit'] = $data['goods_sell_price']-$data['goods_buy_price'];
            $con2['goods_id'] = $data['goods_id'];
            $goods = M('goods')->where($con2)->field('goods_name')-> find();
            $data['goods_name'] = $goods['goods_name'];

            if(!empty($data['storehouse_id'])){
                $con3['customer_id'] = $data['storehouse_id'];
                $customer =M('customer')->where($con3)->field('customer_name')-> find();
                $data['customer_name'] = $customer['customer_name'];
            }else{
                $data['customer_name'] = '总仓库';
            }
            if(!empty($data['user_id'])){
                $con5['user_id'] = $data['user_id'];
                $user =M('user')->where($con5)->field('user_name')-> find();
                $data['user_name'] = $user['user_name'];
            }else{
                $data['user_name'] = '总部';
            }
        }



        //分页显示
        $show = $Page->show();
        //列表排序显示
        $sortImg = $sort;                                 //排序图标
        $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
        $sort = $sort == 'desc' ? 1 : 0;                  //排序方式


        //模板赋值显示
        $this->assign('list', $list);
        $this->assign("page", $show);

        $this->assign("search",			$search);			//搜索类型
        $this->assign("values",			$_POST['values']);	//搜索输入框内容
    }
    //获取客户(仓库)id
    protected function customer_id(){
        $con['user_id'] = session(C("USER_ID"));
        $data = M('user')->field('customer_id')->where($con)->find();
        return $data['customer_id'];
    }
    //请求当前区域客户的商品,根据仓库id查询商品,总部获取商品
    protected function customer_goods(){
//        $con1['storehouse_id'] = $this->customer_id();
        //根据上级来选择入库商品
//        $stock = M('stock')->field('goods_id')->where($con1)->select();
//        $goods_id = array();
//        foreach ($stock as $key=>$val){
//            $goods_id[$key] = $stock[$key]['goods_id'];
//        }
//        $con2['goods_id'] = array('in',$goods_id);
//        $list = M('goods')->field('goods_id,goods_name')->where($con2)->select();
        //直接从总部获取入库商品
        $list = M('goods')->field('goods_id,goods_name')->select();
        return $list;
    }
    //获取当前用户的仓库，以及下级区域仓库
    protected function same(){
        $con1['customer_id'] = $this->customer_id();//当前仓库
        $data = M('customer')->field('region_id')->where($con1)->find();

        $con2['parent_id'] = $data['region_id'];//下级仓库
        $data2  = M('region')->field('region_id')->where($con2)->select();
        $region_id2 =array();
        foreach ($data2 as $key=>$val){
            $region_id2[$key] = $val['region_id'];
        }
        $con['region_id'] = $data['region_id'];//当前仓库（省级）
        $con['parent_id'] = $data['region_id'];//下级仓库（市级）
        $con['_logic'] = "or";
        $map['_complex'] = $con;//当前仓库以及下级仓库
        $map['parent_id'] = array('in',$region_id2);//下下级仓库（县区）
        $map['_logic'] = "or";
        $map1['_complex'] = $map;//本仓库到三级仓库
        $region = M('region')->where($map1)->select();

        $region_id =array();
        foreach ($region as $k=>$v){
            $region_id[$k] = $v['region_id'];
        }
        $con4['region_id'] = array('in',$region_id);
        $customer = M('customer')->where($con4)->select();
        return $customer;
    }

}
