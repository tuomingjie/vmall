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

    <title>修改密码</title>
</head>
<body>
<div class="bar bar-header bar-positive">
    <h1 class="title">修改密码</h1>
</div>
<div class="list" style="margin-top: 44px">
    <label class="item item-input">
        <span class="input-label">旧密码：</span>
        <input type="password" id="old_password" name="old_password" placeholder="请输入旧密码" value="" >
    </label>
    <label class="item item-input">
        <span class="input-label">新密码：</span>
        <input type="password" id="new_password" name="new_password" placeholder="请输入新密码6-20个字符" value="">
    </label>
    <label class="item item-input">
        <span class="input-label">确认密码：</span>
        <input type="password" id="sure_password" name="sure_password" placeholder="请确认密码" value="">
    </label>
</div>
<div class="content padding">
    <button class="button button-block button-calm" id="action">保存</button>
    <button class="button button-block button-assertive" onclick="window.history.go(-1); ">返回</button>
</div>
</body>
<script type="text/javascript">
    $('#action').click(function() {
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var sure_password = $('#sure_password').val();
        // console.log(remenberMe);return;

        if(!old_password || !new_password || !sure_password) {
            layer.open({
                content: '输入框不能为空'
                ,skin: 'msg'
                ,time: 3 //3秒后自动关闭
            });
            return;
        }
        if(new_password.length<6) {
            layer.open({
                content: '请输入6-20数字和字母组合'
                ,skin: 'msg'
                ,time: 3 //3秒后自动关闭
            });
            return;
        }
        if(new_password != sure_password) {
            layer.open({
                content: '新密码两次输入不一致'
                ,skin: 'msg'
                ,time: 3//2秒后自动关闭
            });
            return;
        }

        $.ajax({
            url: "/vmallshop/index.php/Mobile/Supplier/changepwd",
            type: 'post',
            dataType: 'json',
            data: {
                oldpwd:old_password,
                newpwd:new_password,
            },
            success: function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                if(data.status == 'success'){
                    window.location.href = "/vmallshop/index.php/Mobile/Supplier/index";
                }
                return;
            },
            fail: function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                return;
            }
        });

    })
</script>
</html>