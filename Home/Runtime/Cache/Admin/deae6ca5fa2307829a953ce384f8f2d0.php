<?php if (!defined('THINK_PATH')) exit();?><!--<script src="/vmallshop/Public/Stock/stock.js"></script>-->
<form id="pagerForm" action="/vmallshop/index.php/Admin/Stock/log" method="post">
    <input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
    <input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
    <input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
        <input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        选择仓库：
                        <select name="storehouse_id" >
                            <option value="">全部</option>
                            <option value="0">总仓库</option>
                            <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                        </select><!--&nbsp;&nbsp;商品名：<input size="10" type="text" name="goods_name" value="<?php echo ($_POST['goods_name']); ?>"/>-->
                    </td>
                    <td>
                        商品名称：<input name="goods_name" value="">
                    </td>
                    <td>
                        <div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="/vmallshop/index.php/Admin/Stock/add" target="dialog" width="550" height="380" rel="user_msg" title="添加商品"><span>添加</span></a></li>
            <li><a class="delete" href="/vmallshop/index.php/Admin/Stock/delete/stock_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="/vmallshop/index.php/Admin/Stock/edit/stock_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>

            <li class="line">line</li>
            <!--<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>-->
            <!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
        </ul>
    </div>
    <table class="table" width="100%" layoutH="112">
        <thead>
        <tr>
            <th>库存ID</th>
            <th>库存单号</th>
            <th>仓库名称</th>
            <th>入库时间</th>
            <th>商品名称</th>
            <th>入库数量</th>
            <th>商品进价</th>
            <th>商品售价</th>
            <th>商品利润</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["stock_desc_id"]); ?>">
                <td><?php echo ($vo["stock_desc_id"]); ?></td>
                <td><?php echo ($vo["stock_no"]); ?></td>
                <td>
                    <?php if($vo["storehouse_id"] == 0): ?>总仓库
                        <?php else: echo ($vo["customer_name"]); endif; ?>
                </td>
                <td><?php echo (date('Y-m-d',$vo["addtime"])); ?></td>
                <td> <?php echo ($vo["goods_name"]); ?></td>
                <td><?php echo ($vo["goods_num"]); ?></td>
                <td><?php echo ($vo["goods_buy_price"]); ?></td>
                <td><?php echo ($vo["goods_sell_price"]); ?></td>
                <td><?php echo ($vo["goods_profit"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
                <option value="10" <?php if($numPerPage == 10): ?>selected<?php endif; ?>>10</option>
                <option value="15" <?php if($numPerPage == 15): ?>selected<?php endif; ?>>15</option>
                <option value="20" <?php if($numPerPage == 20): ?>selected<?php endif; ?>>20</option>
                <option value="25" <?php if($numPerPage == 25): ?>selected<?php endif; ?>>25</option>
                <option value="30" <?php if($numPerPage == 30): ?>selected<?php endif; ?>>30</option>
            </select>
            <span>共<?php echo ($totalCount); ?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
    </div>
</div>
<!--编辑记录的js预加载-->
<script>
    //提交数据
    $('#editaction').click(function () {
        var id ="<?php echo ($data["stock_desc_id"]); ?>";
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
//                    storehouse_id:storehouse_id,
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
    //提交数据
    $('#addaction').click(function () {
        //遍历获取入库信息
        var aler = true;
        var goods_id = new Array(); //或者写成：var btns= [];
        jQuery("select[name='goods_name']").each(function(key,value) {
            goods_id[key] = $(this).val();
            if(!$(this).val()){
                aler = false;
                return aler;
            }
        });
        var goods_num = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_num']").each(function(key,value) {
            goods_num[key] = $(this).val();
            if(!$(this).val()){
                aler = false;
                return aler;
            }
        });
        var goods_buy_price = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_buy_price']").each(function(key,value) {
            goods_buy_price[key] = $(this).val();
        });
        var goods_sell_price = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_sell_price']").each(function(key,value) {
            goods_sell_price[key] = $(this).val();
        });
        //获取仓库id
        var storehouse_id = $('#store').val();
        console.log(goods_sell_price);
        if(aler == true){
            $.ajax({
                url: "/vmallshop/index.php/Admin/Stock/addaction",
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
                        window.location.replace(location.href);
                    }
                },
                fail: function (data) {

                    return;
                }
            });
        }else {
            alert('商品名或数量不能为空')
        }

    })
    //添加商品demo结构
    $('#addstock').click(function () {
        $.ajax({
            url: "/vmallshop/index.php/Admin/Stock/goods",
            type: 'post',
            dataType: 'json',
            data: {

            },
            success: function (data) {
                var str =' <div class="item">商品名称：';
                str+=' <select class="select" name="goods_name" style="width: 450px;">';
                for (var i = 0; i < data.list.length; i++) {
                    var list =data.list[i];
                    str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
                }
                str+='        </select>';
                str+='        <a href="#" style="color: red;margin-left: 20px" onclick="del(this)">删除商品</a>';
                str+='        <div class="item-label">';
                str+='            <label class="desc">商品数量：<input name="goods_num" class="desc-input" value=""></label>';
                str+='            <label class="desc">商品进价：<input name="goods_buy_price" class="desc-input" value=""></label>';
                str+='            <label class="desc">预计售价：<input name="goods_sell_price" class="desc-input" value=""></label>';
                str+='        </div>';
                str+='    </div>';

                $('#goods_name').append(str);
                if(data.status == 'error'){
                    alert(data.msg);
                }
            },

        });

    })
    //删除产品demo结构
    function del(th) {
        $(th).parent('div').remove();

    }
</script>
<!--录入库存的js预加载-->