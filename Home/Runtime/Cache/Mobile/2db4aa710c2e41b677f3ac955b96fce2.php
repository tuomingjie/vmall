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

    <title>供应商订单中心</title>
</head>
<style>

    .order_topbar{
        height: 44px;
        width: 100%;
        background: #fff;
        border-bottom: 1px solid #e3e3e3;
    }
    .nav{
        height: 44px;
        width: 20%;
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
    <h1 class="title">供应商订单中心</h1>
</div>
<div class="order_topbar" style="margin-top: 44px">
    <a href="index"><div class="nav" id="a">全部</div></a>
    <!--<a href="index?sta=100"><div class="nav" id="b">待处理</div></a>-->
    <a href="index?sta=200"><div class="nav" id="c">已生产</div></a>
    <a href="index?sta=300"><div class="nav" id="d">已发货</div></a>
    <a href="index?sta=400"><div class="nav" id="e">已完成</div></a>
    <a href="index?sta=500"><div class="nav" id="f">已评论</div></a>';
</div>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="order-main ">
        <div class="item padding">
            订单号：<?php echo ($vo["supply_num"]); ?>
            <span class="order-state">
                <?php switch($vo["order_desc_state"]): case "100": ?>待处理<?php break;?>
                    <?php case "200": ?>已生产<?php break;?>
                    <?php case "300": ?>已发货<?php break;?>
                    <?php case "400": ?>已完成<?php break;?>
                    <?php case "500": ?>已评论<?php break;?>
                    <?php default: ?>未知<?php endswitch;?>
            </span>
        </div>
        <div class="order-info">
                <div class="item item-avatar" >
                    <img src="/vmallshop/Upload<?php echo ($vo["goods_big_pic"]); ?>">
                    <h2><?php echo ($vo["goods_name"]); ?></h2>
                    <p>供应价￥<?php echo ($vo["supply_price"]); ?>&nbsp;&nbsp;
                    </p>
                    <p>收货信息：<?php echo ($vo["address_content"]); ?></p>
                    <p><?php echo ($vo["address_name"]); ?>&nbsp;收&nbsp;&nbsp;&nbsp;&nbsp;会员：<?php echo ($vo["user_name"]); ?></p>
                    <span style="float: right;margin-top: -20px;color: #2c2c2c">x <?php echo ($vo["order_desc_num"]); ?></span>
                </div>
        </div>
        <div class="item padding">
            下单时间：<?php echo (date('Y-m-d H:i:s',$vo["order_time"])); ?>
            <span class="order-money">￥<?php echo ($vo["supply_total"]); ?></span>
        </div>
    </div><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
<div style="text-align: right">
    <?php echo ($page); ?>
</div>

</body>
<script>
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        if(str == 'sta=100'){
            $('#b').addClass('on');
        }else if(str == 'sta=200'){
            $('#c').addClass('on');
        }else if(str == 'sta=300'){
            $('#d').addClass('on');
        }else if(str == 'sta=400'){
            $('#e').addClass('on');
        }else if(str == 'sta=500'){
            $('#f').addClass('on');
        }
    }else {
        $('#a').addClass('on');
    }
    $('#back').click(function () {
        window.location.href = "/vmallshop/index.php/Mobile/Supplier/index";
    })
</script>
</html>