<?php if (!defined('THINK_PATH')) exit();?><style>
    .title{
        text-align: center;
        height: 60px;
        line-height: 60px;
        font-size: 30px;
        margin-left: 20px;
        margin-right: 10px;

    }
    .content{
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding: 0 10px;
        /*text-align: center;*/
    }
    .desc{
        margin-right: 10px;
        width: 260px;
        font-size: 14px;
    }
    .desc-input{
        width: 100px;
    }
    .item{
        padding: 10px;
        border-bottom: 1px solid #d2d2d2;
    }
    .item span{
        margin-left: 30px;
        font-size: 14px;
    }
    input,select{
        margin-left: 30px;
        font-size: 14px;
    }
    .action{
        text-align: center;
        margin: 10px 0;
    }
</style>
<div class="title">
    商品入库记录修改
</div>

<div class="content">
    <div class="item">
        <input name="desc_id" id="desc_id" value="<?php echo ($desc_id); ?>" type="hidden">
        <label class="desc">所在仓库:</label>
            <?php if($data["storehouse_id"] == 0): ?><span>总仓库</span>
                <?php else: ?>
                <span><?php echo ($data['customer_name']); ?></span><?php endif; ?>

    </div>

    <div class="item">
        <label class="desc">商品名称：</label>
        <select class="select" name="goods_name">
            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["goods_id"] == $goods_id): ?><option value="<?php echo ($vo["goods_id"]); ?>" selected="selected"><?php echo ($vo["goods_name"]); ?></option>
                <?php else: ?>
                    <option value="<?php echo ($vo["goods_id"]); ?>"><?php echo ($vo["goods_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
    <div class="item">
    <label class="desc">商品数量：<input name="goods_num" class="desc-input" value="<?php echo ($data["goods_num"]); ?>"></label>
    </div>
    <div class="item">
        <label class="desc">商品进价：<input name="goods_buy_price" class="desc-input" value="<?php echo ($data["goods_buy_price"]); ?>"></label>
    </div>
    <div class="item">
        <label class="desc">预计售价：<input name="goods_sell_price" class="desc-input" value="<?php echo ($data["goods_sell_price"]); ?>"></label>
    </div>

    <div class="action">
        <button style="color: #000000;font-size: 18px;" id="editaction">确认修改</button>
    </div>
</div>

<!--选择商品弹框内容-->
<script>
    //提交数据
    $('#editaction').click(function () {
        var id =$('#desc_id').val();
        //遍历获取入库信息
        var goods_id = $("select[name='goods_name']").val(); //或者写成：var btns= [];
        var goods_num = $("input[name='goods_num']").val(); //或者写成：var btns= [];
        var goods_buy_price = $("input[name='goods_buy_price']").val(); //或者写成：var btns= [];
        var goods_sell_price = $("input[name='goods_sell_price']").val(); //或者写成：var btns= [];
        //获取仓库id
//        var storehouse_id = $('#store').val();

            $.ajax({
                url: "/vmallshop/index.php/Admin/Stock/edit_action",
                type: 'post',
                dataType: 'json',
                data: {
                    goods_id:goods_id,
                    goods_num:goods_num,
                    goods_buy_price:goods_buy_price,
                    goods_sell_price:goods_sell_price,
                    stock_desc_id:id
                },
                success: function (data) {
                    alert(data.msg);
                    if(data.status == 'success'){
                        window.location.replace(location.href);
                    }
                },
                fail: function (data) {

                    return;
                }
            });

    })

</script>