<?php
/**
 * 供应商相关功能，商品，订单查看，密码修改
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/10
 * Time: 10:35
 */
namespace Mobile\Controller;
use Think\Controller;
class SupplierController extends BaseController {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['name'])){
            $this->redirect('/Mobile/LoginSupplier');
        }
    }
    public function user_info(){
        $uid = $_SESSION['id'];
        $condition['id'] = $uid;
        $info = M('supplier')->where($condition)->find();
        return $info;
    }
    //用户中心
    public function index(){
        $user_info = $this->user_info();
        $this->assign('user_info',$user_info);
        $this->display();
    }


    //商品查看
    public function goods(){
        $user_info = $this->user_info();
        $con['supplier_id'] = $user_info['id'];

        //分页
        $count = M('goods')-> where($con)->count();
        $Page       = new \Think\Page($count,3);
        $Page->lastSuffix=false;
        $Page->setConfig('header','共<b>%TOTAL_ROW%</b>个商品&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页&nbsp;&nbsp;');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $Page->show();// 分页显示输出
        $list = M('goods') -> where($con) ->limit($Page->firstRow.','.$Page->listRows)-> select();

        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);
        $this -> display();
    }
    //订单查看
    public function order(){
        $user_info = $this->user_info();
        $con['supplier_id'] = $user_info['id'];

        $goods = M('goods');
        $goods_info = $goods->where($con)->field('goods_id')->select();
        $str = '';
        foreach($goods_info as $v){
            $str .= $v['goods_id'].',';
        }
        $str = trim($str,',');
        $status = I('sta');
        if(!empty($status)){
            $map['order_desc_state'] =$status;
        }else{
            $map['order_desc_state'] = array('NEQ',100);
        }
        $map['goods_id'] = array('IN',$str);

        //分页
        $count = M('order_desc')-> where($map)->count();
        $Page       = new \Think\Page($count,2);
        $Page->lastSuffix=false;
        $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页&nbsp;&nbsp;');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $Page->show();// 分页显示输出

        $list = M('order_desc')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

        foreach ($list as &$data){
            //查找用户信息，收货信息
            $con1['order_id'] = array('IN',$data['order_id']);
            $orderdata = M('order')->where($con1)->find();
            $uid= $orderdata['user_id'];
            $addr_id = $orderdata['address_id'];
            $con2['user_id'] = $uid;
            $u_info = M('user')->where($con2)->find();//用户信息
            $con3['address_id'] = $addr_id;
            $address = M('address')->where($con3)->find();//地址
            $con4['goods_id'] = $data['goods_id'];
            $goodsdata = M('goods')->where($con4)->find();//商品信息
            $data['order_time'] = $orderdata['order_time'];
            $data['user_name'] = $u_info['user_name'];
            $data['goods_big_pic'] = $goodsdata['goods_big_pic'];
            $data['goods_name'] = $goodsdata['goods_name'];
            $data['address_content'] = $address['address_content'];
            $data['address_name'] = $address['address_name'];
        }

        $this->assign('page',$show);// 赋值分页输出
        $this -> assign('list',$list);
        $this -> display();
    }
    //密码展示页面
    public function password(){
        $this -> display();
    }
    //修改密码
    public function changepwd(){
        $user_info = $this->user_info();
        $oldpwd = md5(I('oldpwd'));
        $newpwd = md5(I('newpwd'));
        $con['id'] = $user_info['id'];
        $pwd = M('supplier')->field('password')->where($con)->find();
        if($oldpwd == $pwd['password']){
            $data['password'] = $newpwd;
            $res = M('supplier')->where($con)->save($data);
            if(!empty($res)){
                $ret['status'] = 'success';
                $ret['msg'] = '修改成功';
            }else{
                $ret['status'] = 'error';
                $ret['msg'] = '修改失败';
            }
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '旧密码错误';
        }
        $this -> ajaxReturn($ret);
    }
    //删除数组相同的值
    protected function formatArray($array)
    {
        sort($array);
        $tem = "";
        $temarray = array();
        $j = 0;
        for($i=0;$i<count($array);$i++)
        {
            if($array[$i]!=$tem)
            {
                $temarray[$j] = $array[$i];
                $j++;
            }
            $tem = $array[$i];
        }
        return $temarray;
    }
}