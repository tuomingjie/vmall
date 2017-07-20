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

    <title>我的订单</title>
</head>
<style>
    body{
        padding-bottom: 44px;
    }
    .order_topbar{
        height: 44px;
        width: 100%;
        background: #fff;
        border-bottom: 1px solid #e3e3e3;
    }
    .nav{
        height: 44px;
        width: 16.6%;
        line-height: 44px;
        text-align: center;
        font-size: 14px;
        float: left;
        color: #666;
    }
    .on{
        height: 42px;
        color: #ff771b;
        border-bottom: 2px solid #ff771b;
    }
    .order-main{
        padding-top: 5px;
        background-color: #eeeeee;

    }
    .order-main .order-state{
        color: #FF5722;
        float: right;
        background-color: #ffffff;
    }
    .order-main .order-money{
        float: right;
        background-color: #ffffff;
    }
    .back{
        padding:8px 10px 8px 5px;
        font-size: 20px;
        margin: 0 10px;
        z-index: 999
    }
</style>
<body>
<div class="bar bar-header bar-positive">
    <i class="icon ion-ios-arrow-left back" id="back"></i>
    <h1 class="title">我的订单</h1>
</div>
<div class="order_topbar" style="margin-top: 44px">
    <a href="index"><div class="nav" id="a">全部</div></a>
    <a href="index?sckey=payment_status&sta=0"><div class="nav" id="b">未付款</div></a>
    <a href="index?sckey=payment_status&sta=1"><div class="nav" id="c">已付款</div></a>
    <a href="index?sckey=examine_status&sta=0"><div class="nav" id="d">审核中</div></a>
    <a href="index?sckey=examine_status&sta=2"><div class="nav" id="e">已审核</div></a>
    <a href="index?sckey=examine_status&sta=1"><div class="nav" id="f">未通过</div></a>';
</div>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="order-main ">
        <div class="item padding">
            订单号：<?php echo ($vo["order_no"]); ?>
            <span class="order-state">
               <?php if($vo["payment_status"] == 0): ?>未付款
                <?php elseif($vo["examine_status"] == 0): ?>审核中
                <?php elseif($vo["examine_status"] == 1): ?>未通过
                   <?php elseif($vo["examine_status"] == 2): ?>已审核
                <?php else: endif; ?>
            </span>
        </div>
        <div class="order-info">
            <?php if(is_array($vo['goods'])): $i = 0; $__LIST__ = $vo['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><div class="item item-avatar" >
                    <img src="/vmallshop/Upload<?php echo ($obj["goods_big_pic"]); ?>">
                    <h2><?php echo ($obj["goods_name"]); ?></h2>
                    <p>单价￥<?php echo ($obj["goods_sale_price"]); ?>&nbsp;&nbsp;
                        <?php if($obj["is_customized"] == 1): ?>个性定制￥<?php echo ($obj["personality_price"]); endif; ?>
                            </p>
                    <span style="float: right;margin-top: -20px;color: #2c2c2c">x <?php echo ($obj["buy_num"]); ?></span>
                </div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
        </div>
        <div class="item padding">
        下单时间：<?php echo (date('Y-m-d H:i:s',$vo["order_time"])); ?>
            <span class="order-money">￥<?php echo ($vo["order_total_money"]); ?></span>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
<div style="text-align: right">
    <?php echo ($page); ?>
</div>
<div class="bar bar-footer">
    <button class="button button-clear" style="color: #000">
        <i class="icon ion-ios-home"></i>首页</button>
    <div class="title" style="color: #000;font-size: 18px">
        <i class="icon ion-ios-list" style="font-size: 22px"></i></i>订单</div>
    <button class="button button-clear" style="color: #000">
        <i class="icon ion-ios-person" ></i>个人中心</button>
</div>
</body>
<script>
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        if(str == 'sckey=payment_status&sta=0'){
                $('#b').addClass('on');
        }else if(str == 'sckey=payment_status&sta=1'){
            $('#c').addClass('on');
        }else if(str == 'sckey=examine_status&sta=0'){
            $('#d').addClass('on');
        }else if(str == 'sckey=examine_status&sta=2'){
            $('#e').addClass('on');
        }else if(str == 'sckey=examine_status&sta=1'){
            $('#f').addClass('on');
        }
    }else {
        $('#a').addClass('on');
    }
    $('#back').click(function () {
        window.location.href = "/vmallshop/index.php/Mobile/User/index";
    })
</script>
</html>