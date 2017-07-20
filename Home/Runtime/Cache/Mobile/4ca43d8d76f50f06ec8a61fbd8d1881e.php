<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<link rel="stylesheet" href="/vmallshop/Public/Mobile/ionic/css/ionic.min.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/ionic/js/ionic.js"></script>
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="/vmallshop/Public/Mobile/layer/need/layer.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/layer/layer.js"></script>

    <title>供应商登录</title>
</head>
<body>
<div class="bar bar-header bar-positive">
    <h1 class="title">供应商登录</h1>
</div>
<div class="list" style="margin-top: 44px">
    <label class="item item-input">
        <span class="input-label">用户名：</span>
        <input type="text" id="user" name="user_name" placeholder="用户名" value="" >
    </label>
    <label class="item item-input">
        <span class="input-label">密码：</span>
        <input type="password" id="password" name="user_pwd" placeholder="密码" value="">
    </label>
    <label class="item item-input">
        <span class="input-label">验证码：</span>
        <input type="password" id="verify" name="verify" placeholder="验证码" value="">
    </label>
    <label class="item item-input" id="ttt">
        <span style="margin-left: 120px;">
            <img class="vam pointer" id="verifyimg" src="/vmallshop/index.php/Mobile/LoginSupplier/verify" alt="验证码" onclick="fleshVerify()" width="160">
        </span>
    </label>
</div>
<div class="content padding" style="text-align: right">
    <button class="button button-block button-calm" id="action">登录</button>
    <a href="/vmallshop/index.php/Mobile/Login/index">普通用户登录</a>
</div>
</body>
<script>
    $('#ttt').click(function() {
        var verifyimg = $("#verifyimg").attr("src");
        if( verifyimg.indexOf('?')>0){
            $("#verifyimg").attr("src", verifyimg+'&random='+Math.random());
        }else{
            $("#verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    })

</script>
<script type="text/javascript">
    $('#action').click(function() {
        var account = $('#user').val();
        var password = $('#password').val();
        var verify = $('#verify').val();
        if(!account) {
            layer.open({
                content: '账户不能为空'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return;
        }
        if(!password) {
            layer.open({
                content: '密码不能为空'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return;
        }
        if(!verify) {
            layer.open({
                content: '验证码不能为空'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return;
        }
        $.ajax({
            url: "/vmallshop/index.php/Mobile/LoginSupplier/loginaction",
            type: 'post',
            dataType: 'json',
            data: {
                uname:account,
                pwd:password,
                verify:verify
            },
            success: function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });

                if(data.status){
                    window.location.href = "/vmallshop/index.php/Mobile/Supplier/index";
                }
                return;
            },
            fail: function (data) {
                layer.open({
                    content: '登录失败'
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                return;
            }
        });
    })
</script>
</html>