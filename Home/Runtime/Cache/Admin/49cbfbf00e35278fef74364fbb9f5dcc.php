<?php if (!defined('THINK_PATH')) exit();?><style>
    .title{
        height: 60px;
        line-height: 60px;
        font-size: 30px;
        margin-left: 20px;
        margin-right: 10px;
    }
    .content{
        margin-left: 20px;
        margin-right: 10px;
        font-size: 20px;
        /*text-align: center;*/
    }
    .desc{
        margin-right: 10px;
    }
    .desc-input{
        width: 60px;
    }
    .item{
        padding-bottom: 5px;
        border-bottom: 1px solid #eeeeee;
    }
    .item-label{
        margin: 10px 0px;
    }
    .action{
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }
</style>
<div class="title">
    商品入库
</div>

<div class="content">
    <div class="item">
        入库仓库:
        <select name="store" id="store">
            <option value="0">总仓库</option>
            <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["user"]["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
    <div id="goods_name">
    </div>
    <div class="item">
        <button style="color: #0a79d5" id="add2">添加入库商品</button>
    </div>
    <div class="item action">
        <button style="color: #0a79d5" id="action">确认入库</button>
    </div>
</div>

<!--选择商品弹框内容-->
<script>
    //提交数据
    $('#action').click(function () {
        //遍历获取入库信息
        var goods_id = new Array(); //或者写成：var btns= [];
        jQuery("select[name='goods_name']").each(function(key,value) {
            goods_id[key] = $(this).val();
            if(!$(this).val()){
                alert('商品名称不能为空');
                return;
            }
        });
        var goods_num = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_num']").each(function(key,value) {
            goods_num[key] = $(this).val();
            if(!$(this).val()){
                alert('商品数量不能为空');
                return;
            }
        });
        var goods_buy_price = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_buy_price']").each(function(key,value) {
            goods_buy_price[key] = $(this).val();
        });
        var goods_sell_price = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_buy_price']").each(function(key,value) {
            goods_sell_price[key] = $(this).val();
        });
        //获取仓库id
        var storehouse_id = $('#store').val();

        $.ajax({
            url: "/vmallshop/index.php/Admin/Store/addaction",
            type: 'post',
            dataType: 'json',
            data: {
                goods_id:goods_id,
                goods_num:goods_num,
                goods_buy_price:goods_buy_price,
                goods_sell_price:goods_sell_price,
                storehouse_id:storehouse_id
            },
            success: function (data) {
                alert(data.msg);
                if(data.status == 'success'){

                }
            },
            fail: function (data) {

                return;
            }
        });
    })
    //添加商品demo结构
    $('#add2').click(function () {
        var str =['<div class="item">',
            '    商品名称：',
            '    <select class="select" name="goods_name"></select>',
            '    <a href="#" style="color: #0a79d5" onclick="goods(this)">加载商品</a>',
            '    <div class="item-label">',
            '        <label class="desc">商品数量：<input name="goods_num" class="desc-input"></label>',
            '        <label class="desc">商品进价：<input name="goods_buy_price" class="desc-input"></label>',
            '        <label class="desc">预计售价：<input name="goods_sell_price" class="desc-input"></label>',
            '    </div>',
            '</div>'].join("");
        $('#goods_name').append(str);
    })
    //加载商品
    function goods(th) {
        $.ajax({
            url: "/vmallshop/index.php/Admin/Store/goods",
            type: 'post',
            dataType: 'json',
            data: {

            },
            success: function (data) {
                if(data.status == 'success'){
                    for(var i=0;i<data.list.length;i++){
                        var li = data.list[i];
                        var str = '<option value="'+li.goods_id+'">'+li.goods_name+'</option>';
                        $(th).prev('.select').append(str);
                    }
                }else {
                    alert(data.msg);
                }

            },
            fail: function (data) {

                return;
            }
        });
    }
</script>