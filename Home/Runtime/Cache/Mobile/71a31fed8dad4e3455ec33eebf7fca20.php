<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<link rel="stylesheet" href="/vmallshop/Public/Mobile/ionic/css/ionic.min.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/ionic/js/ionic.js"></script>
<script type="text/javascript" src="/vmallshop/Public/Mobile/ionic/js/ionic.bundle.js"></script>
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="/vmallshop/Public/Mobile/layer/need/layer.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/layer/layer.js"></script>

    <title>用户中心</title>
</head>
<body>
<div class="bar bar-header bar-positive">
    <h1 class="title">用户中心</h1>
</div>
<div style="margin-top: 44px"></div>
<div class="list card">
    <a href="/vmallshop/index.php/Mobile/User/edit" class="item item-avatar" >
        <img src="http://www.runoob.com/try/demo_source/nin_logo.jpeg">
        <h2><?php echo ($user_info["user_name"]); ?></h2>
        <p><?php echo (date("Y-m-d H:i:s",$user_info["user_login_time"])); ?></p>
        <div style="float: right;margin-top: -44px;">
            <h2>积分:<?php echo ($user_info["user_score"]); ?></h2>
            <p>余额:<?php echo ($user_info["user_money"]); ?></p>
        </div>
    </a>
</div>
<div class="list">
    <a class="item item-icon-left item-icon-right" href="/vmallshop/index.php/Mobile/Order/index">
        <i class="icon ion-ios-list"></i>
        我的订单
        <i class="icon ion-ios-arrow-forward"></i>
    </a>
    <a class="item item-icon-left item-icon-right" href="/vmallshop/index.php/Mobile/Address/index">
        <i class="icon ion-ios-location"></i>
        收货地址
        <i class="icon ion-ios-arrow-forward"></i>
    </a>
    <a class="item item-icon-left item-icon-right" href="/vmallshop/index.php/Mobile/User/password">
        <i class="icon ion-ios-locked"></i>
        修改密码
        <i class="icon ion-ios-arrow-forward"></i>
    </a>

</div>
<div class="content padding">
    <button class="button button-block button-assertive" id="action">退出登录</button>
</div>
</body>
<script>
    $('#action').click(function () {
        $.ajax({
            url: "/vmallshop/index.php/Mobile/Login/loginout",
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                if(data.status == 'success'){
                    window.location.href = "/vmallshop/index.php/Mobile/Login/index";
                }else{

                }
            },
            fail: function (data) {
                layer.open({
                    content: data
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return;
            }
        });
    })
</script>
</html>