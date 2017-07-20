<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/17
 * Time: 9:40
 */
namespace Mobile\Controller;
use Think\Controller;
class GoodsController extends Controller{
    public function index(){
        $this->display();
    }
    public function detail(){
        $goods_id = I('get.giids_id');
        $con['goods_id'] = 1;
        $data = M('goods')->where($con)->find();
        $desc_pic = M('goods_pic')->where($con)->select();
//        print_r($desc_pic);die;
        $this-> assign('desc_pic',$desc_pic);
        $this->assign('data',$data);

        $this->display();
    }
}