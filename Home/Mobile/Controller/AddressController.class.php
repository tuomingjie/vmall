<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 18:06
 */
namespace Mobile\Controller;
use Think\Controller;
class AddressController extends BaseController {
    public function index(){
        $user_info = parent::user_info();
        $condition['user_id'] = $user_info['user_id'];
        $addr = M('address')->where($condition)->select();
        $this -> assign('addr',$addr);
        $this -> display();
    }
    //修改默认地址
    public function lock(){
        $user_info = parent::user_info();
        $Dao = M('address');
        $addr_id = I('addr_id');
        $con['address_id'] = $addr_id;
        $addr = $Dao->where($con)->find();
        if($addr['address_lock'] == 1){
            $data['address_lock'] = 0;
        }else if($addr['address_lock'] == 0){
            $con2['user_id'] = $user_info['user_id'];
            $con2['address_lock'] = 1;
            $addr_lock = $Dao->where($con2)->select();
            if(empty($addr_lock)){
                $data['address_lock'] = 1;
            }else{
                $ret['status'] = 'error';
                $ret['msg'] = '已经有默认地址';
                $this -> ajaxReturn($ret);
            }
        }
        $res = $Dao->where($con)->save($data);
        if(!empty($res)){
            $ret['status'] = 'success';
            $ret['msg'] = '设置成功';
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '设置失败';
        }
        $this -> ajaxReturn($ret);
    }
    //删除地址
    public function delecte(){
        $addr_id = I('addr_id');
        $con['address_id'] = $addr_id;
        $res = M('address')->where($con)->delete();
        if(!empty($res)){
            $ret['status'] = 'success';
            $ret['msg'] = '删除成功';
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '删除失败';
        }
        $this -> ajaxReturn($ret);
    }
    //添加新地址
    public function add(){
        $this -> display();
    }
    //添加新地址
    public function addaction(){
        $user_info = parent::user_info();
        $address_phone=I("post.addr_phone");
        $address_name=I("post.addr_name");
        $s_province=I("post.s_province");
        $s_city=I("post.s_city");
        $s_county=I("post.s_county");
        $addr_psot=I("post.addr_psot");
        $addr_detail=I("post.addr_detail");
        //插入的数据
        $data['address_name'] = $address_name;
        $data['address_phone'] = $address_phone;
        $data['address_content'] = $s_province.$s_city.$s_county.$addr_detail;
        $data['address_post'] = $addr_psot;
        $data['address_lock'] = 0;
        $data['user_id'] = $user_info['user_id'];
        $res = M('address')->add($data);
        if(!empty($res)){
            $ret['status'] = 'success';
            $ret['msg'] = '添加成功';
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '添加失败';
        }
        $this -> ajaxReturn($ret);
    }
    //编辑地址
    public function edit(){
        $addr_id = I('addr_id');
        $con['address_id'] = $addr_id;
        $adata = M('address')->where($con)->find();
        $this -> assign('data',$adata);
        if($_POST){
            $address_phone=I("post.addr_phone");
            $address_name=I("post.addr_name");
            $s_province=I("post.s_province");
            $s_city=I("post.s_city");
            $s_county=I("post.s_county");
            $addr_psot=I("post.addr_psot");
            $addr_detail=I("post.addr_detail");
            //保存的数据
            $data['address_name'] = $address_name;
            $data['address_phone'] = $address_phone;
            $data['address_content'] = $s_province.$s_city.$s_county.$addr_detail;
            $data['address_post'] = $addr_psot;
            if(!empty($res)){
                $ret['status'] = 'success';
                $ret['msg'] = '修改成功';
            }else{
                $ret['status'] = 'error';
                $ret['msg'] = '修改失败';
            }
            $this -> ajaxReturn($ret);
        }
        $this -> display();
    }
}