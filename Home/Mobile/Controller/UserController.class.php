<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 10:49
 */
namespace Mobile\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index(){
        $user_info = parent::user_info();
        $this -> assign('user_info',$user_info);
        $this -> display();
    }
    //查看资料
    public function edit(){
        $user_info = parent::user_info();
        $this -> assign('user_info',$user_info);
        $this -> display();
    }

    //修改资料
    public function editaction(){
        $user_info = parent::user_info();
        $true_name = I('true_name');
        $email = I('user_email');
        $sex = I('sex');
        if(empty($true_name)){
            $ret['status'] = 'error';
            $ret['msg'] = '真实姓名不能为空';
            $this->ajaxReturn($ret);
        }

        $con['user_id'] = $user_info['user_id'];
        $data['true_name'] = $true_name;
        $data['user_email'] =$email;
        $data['user_sex'] =$sex;
        $res =M('user')->where($con)->save($data);
        if(!empty($res)){
            $ret['status'] = 'success';
            $ret['msg'] = '修改成功';
        }else{
            $ret['status'] = 'error';
            $ret['msg'] = '修改失败';
        }
        $this->ajaxReturn($ret);
    }

    //密码展示页面
    public function password(){
        $this -> display();
    }
    //修改密码
    public function changepwd(){
        $user_info = parent::user_info();
        $oldpwd = md5(I('oldpwd'));
        $newpwd = md5(I('newpwd'));
        $con['user_id'] = $user_info['user_id'];
        $pwd = M('user')->field('user_pwd')->where($con)->find();
        if($oldpwd == $pwd['user_pwd']){
            $data['user_pwd'] = $newpwd;
            $res = M('user')->where($con)->save($data);
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
}