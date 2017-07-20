<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 9:59
 */
namespace Mobile\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['user_name'])){
            $this->redirect('/Mobile/Login');
        }
    }
    public function user_info(){
        $uid = $_SESSION['uid'];
        $condition['user_id'] = $uid;
        $info = M('user')->where($condition)->find();
        return $info;
    }
}