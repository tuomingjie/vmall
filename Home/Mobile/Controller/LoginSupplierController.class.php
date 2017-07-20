<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 12:14
 */
namespace Mobile\Controller;
use Think\Controller;
class LoginSupplierController extends Controller {
    public function index(){
        $this -> display();
    }
    public function loginaction(){
        $name = I('post.uname');
        $pwd=md5(I('post.pwd'));
        $verify = I('verify');
        $resverify = $this->check_verify($verify,'');
        if(!$resverify){
            $ret['status'] = 'error';
            $ret['msg'] ='验证码输入错误';
            $this->ajaxReturn($ret);
        }
        $condition['name'] = $name;
        $condition['password'] = $pwd;
        $user=M("supplier");
        $user_info=$user->where($condition)->find();
//        print_r($name);die;
        if($user_info){
            //能查出用户信息说明可以登录
            //$status=1;
            //账户被锁,不可登录
            if($user_info['is_del']==1){
                $this->ajaxreturn(array('status'=>0,'msg'=>'账户已经被限制,不可登录'));
            }else{
                //用户登录合法;对用户信息处理 更新用户登录时间和ip

                session('id',$user_info['id']);
                session('name',$user_info['name']);

                $this->ajaxreturn(array('status'=>1,'msg'=>'登录成功'));
            }
        }else{
            $this->ajaxreturn(array('status'=>0,'msg'=>'用户名或密码错误！'));
        }
    }
    public function verify(){
        //配置验证码
        $config=array(
            'imgW'=>'160',
            'imgH'=>'60',
            'length'=>4,
            'bg'=>array(253,253,253),
            'useNoise'=>false,
            'fontSize'=>40

        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();

    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    private function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    public function loginout(){
        session('id',null);
        session('name',null);
        $data['status'] = 'success';
        $data['msg'] = '退出成功';
        $this -> ajaxReturn($data);
    }
}