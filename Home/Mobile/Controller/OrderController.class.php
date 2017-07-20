<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 14:52
 */
namespace Mobile\Controller;
use Think\Controller;
class OrderController extends BaseController {
    public function index(){
        $user_info = parent::user_info();
        $user_id=$user_info['user_id'];
        $sckey = I('sckey');
        $status = intval(I('sta'));
        if(!empty($sckey)){
            $con[$sckey] = $status;
        }
        $con['user_id'] = $user_id;

        //分页
        $count = M('order')-> where($con)->count();
        $Page       = new \Think\Page($count,3);
        $Page->lastSuffix=false;
        $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条订单&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页&nbsp;&nbsp;');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $Page->show();// 分页显示输出

        $orderlist = M('order')->where($con)->limit($Page->firstRow.','.$Page->listRows)->select();
//        print_r($orderdata);
        foreach ($orderlist as &$data){
            $condition['order_id'] = $data['order_id'];
            $ordergoods = M('order_desc') -> where($condition)->select();
            for($i=0;$i<count($ordergoods);$i++){
                $condition2['goods_id'] = $ordergoods[$i]['goods_id'];
                $goods = M('goods') -> where($condition2)->find();
                $goods['buy_num'] = $ordergoods[$i]['order_desc_num'];
                $goods['is_customized'] = $ordergoods[$i]['is_customized'];
                $goods['personality_price'] = $ordergoods[$i]['personality_price'];
                $data['goods'][$i] = $goods;
            }
        }
//        print_r($ordergoods);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$orderlist);
        $this -> display();
    }
}