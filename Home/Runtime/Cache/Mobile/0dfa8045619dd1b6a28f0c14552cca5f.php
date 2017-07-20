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

    <title>收货地址管理</title>
</head>
<body>
    <div class="bar bar-header  bar-positive">
        <h1 class="title">收货地址管理</h1>
    </div>
    <div style="margin-top: 44px;">
            <div class="list">
                <?php if(is_array($addr)): $i = 0; $__LIST__ = $addr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                    <a href="/vmallshop/index.php/Mobile/Address/edit?addr_id=<?php echo ($vo["address_id"]); ?>" style=" text-decoration:none;">
                        <h2> 收货人：<?php echo ($vo["address_name"]); ?>&nbsp&nbsp<?php echo ($vo["address_phone"]); ?></h2>
                        <h2>邮政编码：<?php echo ($vo["address_post"]); ?></h2>
                        <p><?php echo ($vo["address_content"]); ?></p>
                    </a>
                    <div style="float: right">
                        <?php if($vo["address_lock"] == 1): ?><button class="button button-calm button-small" style="margin-top: -44px" onclick="lock(<?php echo ($vo["address_id"]); ?>)">取消默认</button>
                            <?php else: ?>
                            <button class="button button-assertive button-small" style="margin-top: -44px" onclick="lock(<?php echo ($vo["address_id"]); ?>)">设置默认</button><?php endif; ?>
                        <button class="button button-stable button-small" style="margin-top: -44px" onclick="delecte(<?php echo ($vo["address_id"]); ?>,this)">删除</button>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

    </div>
    <div class="content padding">
        <a class="button button-block button-calm" href="/vmallshop/index.php/Mobile/Address/add">添加新地址</a>
        <button class="button button-block button-assertive" onclick="window.history.go(-1); ">返回</button>
    </div>
</body>
<script>
    function lock(addr_id) {
        $.ajax({
            url:"/vmallshop/index.php/Mobile/Address/lock",
            type:'post',
            dataType:'json',
            data:{
                addr_id:addr_id
            },
            success:function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                if(data.status == 'success'){
                    window.location.reload();
                }
                return;
            },
            fail:function () {
                layer.open({
                    content: '设置失败'
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                return;
            }
        })
    }
    function delecte(addr_id,th) {
        $.ajax({
            url:"/vmallshop/index.php/Mobile/Address/delecte",
            type:'post',
            dataType:'json',
            data:{
                addr_id:addr_id
            },
            success:function (data) {
                layer.open({
                    content: data.msg
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                if(data.status == 'success'){
                        $(th).parent().parent().remove();
                }
                return;
            },
            fail:function () {
                layer.open({
                    content: '删除异常'
                    ,skin: 'msg'
                    ,time: 3 //2秒后自动关闭
                });
                return;
            }
        })
    }

</script>
</html>