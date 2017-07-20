<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<link rel="stylesheet" href="/vmallshop/Public/Mobile/ionic/css/ionic.min.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/ionic/js/ionic.js"></script>
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="/vmallshop/Public/Mobile/layer/need/layer.css" />
<script type="text/javascript" src="/vmallshop/Public/Mobile/layer/layer.js"></script>

    <title>编辑地址</title>
</head>
<style>

</style>
<body>
    <div class="bar bar-header  bar-positive bar-positive">
        <h1 class="title">编辑地址</h1>
    </div>
    <div style="margin-top: 44px">

    </div>

    <div class="list">
        <label class="item item-input">
            <span class="input-label">收货人：</span>
            <input type="text" id="addr_name" name="addr_name" placeholder="收货人" value="<?php echo ($data["address_name"]); ?>" >
        </label>
        <label class="item item-input">
            <span class="input-label">手机号：</span>
            <input type="text" id="addr_phone" name="addr_phone" placeholder="收货联系电话" value="<?php echo ($data["address_phone"]); ?>" >
        </label>
        <label class="item item-input">
            <span class="input-label">选择地址：</span>
            <select name="s_province" id="s_province" ></select>
                <select name="s_city" id="s_city"></select>
                <select name="s_county" id="s_county"></select>
                <script type="text/javascript" src="/vmallshop/Public/Js/area.js"></script>
        </label>

        <label class="item item-input">
            <span class="input-label">详细地址：</span>
            <input type="text" id="address_content" name="address_content" placeholder="不用重复省、市、区/县" value="<?php echo ($data["address_content"]); ?>" >
        </label>
        <label class="item item-input">
            <span class="input-label">邮政编码：</span>
            <input type="text" id="addr_post" name="addr_post" placeholder="邮政编码" value="<?php echo ($data["address_post"]); ?>" >
        </label>
    </div>
    <div class="content padding">
        <button class="button button-block button-calm" id="action">保存</button>
        <button class="button button-block button-assertive" onclick="window.history.go(-1); ">返回</button>
    </div>

</body>
<script type="text/javascript">
    $('#action').click(function() {
        var addr_name = $('#addr_name').val();
        var addr_phone = $('#addr_phone').val();
        var s_province = $('#s_province').val();
        var s_city = $('#s_city').val();
        var s_county = $('#s_county').val();
        var addr_detail = $('#addr_detail').val();
        var addr_post = $('#addr_post').val();
        if(!addr_name || !addr_phone ) {
            layer.open({
                content: '收货人或号码不能为空'
                ,skin: 'msg'
                ,time: 3 //3秒后自动关闭
            });
            return;
        }
        if(!(/^1(3|4|5|7|8)\d{9}$/.test(addr_phone))) {
            layer.open({
                content: '手机号码不正确'
                ,skin: 'msg'
                ,time: 3 //3秒后自动关闭
            });
            return;
        }
        if(s_province == '选择省份') {
            layer.open({
                content: '请选择省份'
                ,skin: 'msg'
                ,time: 3//2秒后自动关闭
            });
            return;
        }
        if(s_city == '选择市') {
            layer.open({
                content: '请选择市'
                ,skin: 'msg'
                ,time: 3//2秒后自动关闭
            });
            return;
        }
        if(s_county == '选择县区') {
            layer.open({
                content: '请选择县区'
                ,skin: 'msg'
                ,time: 3//2秒后自动关闭
            });
            return;
        }
        if(!addr_detail) {
            layer.open({
                content: '请填写详细地址'
                ,skin: 'msg'
                ,time: 3//2秒后自动关闭
            });
            return;
        }
        $.ajax({
            url: "/vmallshop/index.php/Mobile/Address/addaction",
            type: 'post',
            dataType: 'json',
            data: {
                addr_name:addr_name,
                addr_phone :addr_phone,
                s_province :s_province,
                s_city :s_city,
                s_county :s_county,
                addr_detail:addr_detail,
                addr_post :addr_post
            },
            success: function (data) {
                if(data.status == 'success'){
                    window.location.href = "/vmallshop/index.php/Mobile/Address/index";
                }else{
                    layer.open({
                        content: data.msg
                        ,skin: 'msg'
                        ,time: 3 //2秒后自动关闭
                    });
                    return;
                }
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