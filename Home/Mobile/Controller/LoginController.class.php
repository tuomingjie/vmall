<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 12:14
 */
namespace Mobile\Controller;
use Think\Controller;
class LoginController extends Controller {
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
        $condition['user_name'] = $name;
        $condition['user_pwd'] = $pwd;
        $user=M("User");
        $user_info=$user->where($condition)->select();
//        print_r($name);die;
        if($user_info){
            //能查出用户信息说明可以登录
            //$status=2;
            //账户被锁,不可登录
            if($user_info[0]['user_lock']==1){
                $this->ajaxreturn(array('status'=>0,'msg'=>'账户被锁,不可登录'));
            }else{
                //用户登录合法;对用户信息处理 更新用户登录时间和ip

                $user_last_time=time();
                $user_last_ip=ip2long(I('server.REMOTE_ADDR'));
                $user_id=$user_info[0]['user_id'];

                $data['user_last_time']=$user_last_time;
                $data['user_last_ip']=$user_last_ip;

                $user->where(array('user_id'=>$user_id))->save($data);
                //保存要的东西
                //用户名
                $save_info['user_name']=$user_info[0]['user_name'];
                //真实姓名
                $save_info['true_name']=$user_info[0]['true_name'];
                //性别 0-woman  1-man

                $save_info['user_sex']=$user_info[0]['user_sex']==1?'先生':'小姐';
                //用户的金额
                $save_info['user_money']=$user_info[0]['user_money'];

                $save_info['user_email']=$user_info[0]['user_email'];
                $save_info['user_login_time']=date("Y-m-d H:i:s",$user_info[0]['user_login_time']);
                $save_info['user_last_time']=date("Y-m-d H:i:s",$user_info[0]['user_last_time']);
                $save_info['user_last_ip']=long2ip($user_info[0]['user_last_ip']);
                $save_info['user_score']=$user_info[0]['user_score'];
                //保存到session中去
                session(C("USER_ID"),$user_id);
                session(C("USER_INFO"),$save_info);
                session('uid',$user_id);//新加测试
                session('user_name',$save_info['user_name']);//新加测试

                //判断是否需要长时间保存登录

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
        session('uid',null);
        session('user_name',null);
        $data['status'] = 'success';
        $data['msg'] = '退出成功';
        $this -> ajaxReturn($data);
    }
}