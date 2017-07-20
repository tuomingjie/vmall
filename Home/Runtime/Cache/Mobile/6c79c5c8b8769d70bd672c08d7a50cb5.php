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

    <title>修改资料</title>
</head>
<body>
<div class="bar bar-header  bar-positive">
    <h1 class="title">修改资料</h1>
</div>
<div class="list" style="margin-top: 44px">
    <label class="item item-input">
        <span class="input-label">用户名：</span>
        <span><?php echo ($user_info["user_name"]); ?></span>
    </label>
    <label class="item item-input">
        <span class="input-label">真实姓名：</span>
        <input type="text" value="<?php echo ($user_info["true_name"]); ?>" id="true_name">
    </label>
    <label class="item item-input">
        <span class="input-label">邮箱：</span>
        <input type="text" value="<?php echo ($user_info["user_email"]); ?>" id="user_email">
    </label>
    <label class="item" style="padding: 6px 0 5px 16px">
        <span class="input-label">性别：</span>
        <div style="float: left;margin-left: 35%;margin-top: -28px">
            <label><input name="man" type="radio" <?php if($user_info["user_sex"] == 1): ?>checked="checked"<?php endif; ?> value="1"/>男&nbsp;&nbsp;</label>
            <label><input name="man" type="radio" <?php if($user_info["user_sex"] == 0): ?>checked="checked"<?php endif; ?> value="2" />女&nbsp;&nbsp;</label>
            <label><input name="man" type="radio" <?php if($user_info["user_sex"] == 0): ?>checked="checked"<?php endif; ?> value="0" />保密</label>
        </div>
    </label>
    <label class="item item-input">
        <span class="input-label">注册时间：</span>
        <span><?php echo (date("Y-m-d H:i:s",$user_info["user_login_time"])); ?></span>
    </label>
</div>
<div class="content padding">
    <button class="button button-block button-calm" id="action">保存</button>
    <button class="button button-block button-assertive" onclick="window.history.go(-1); ">取消</button>
</div>
</body>
<script>
    $('#action').click(function () {
        $.ajax({
            url: "/vmallshop/index.php/Mobile/User/editaction",
            type: 'post',
            dataType: 'json',
            data: {
                true_name:$('#true_name').val(),
                user_email:$('#user_email').val(),
                sex:$('input[name="man"]:checked').val()
            },
            success: function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                if(data.status =='success'){
                    window.location.href = "/vmallshop/index.php/Mobile/User/edit";
                }
                    return;
            },
            fail: function (data) {
                layer.open({
                    content: '保存异常'
                    ,btn: '确定'
                });
                return;
            }
        });
    })
</script>
</html>