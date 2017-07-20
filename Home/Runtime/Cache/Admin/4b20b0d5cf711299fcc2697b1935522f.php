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
    商品调拨
</div>

<div class="content">
  <div class="item">
        <label class="desc">出库仓库：</label>
      <select name="out" id="out" onchange="out_stock()">
          <option value="0">总仓库</option>
          <?php if(is_array($customerlist)): $i = 0; $__LIST__ = $customerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
    <diV class="item">
        <label class="desc">进入仓库：</label>
        <select name="into" id="into">
            <option value="0">总仓库</option>
            <?php if(is_array($customerlist)): $i = 0; $__LIST__ = $customerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </diV>
    <div id="demo">
        <div>
            <div class="item">
                <label class="desc">商品名称：</label>
                <select class="select goods_id" name="goods_id"  style="width: 60%;" onchange="jiankong(this)">
                    <?php if($goods_id == $data['goods_id']): ?><option value="<?php echo ($goods_id); ?>" selected="selected"><?php echo ($data["goods_name"]); ?></option><?php endif; ?>
                    <?php if(is_array($goodslist)): $i = 0; $__LIST__ = $goodslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goods["goods_id"]); ?>"><?php echo ($goods["goods_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="item">
                <label class="desc">库存数量：</label>
                <input name="stock_num" value="<?php echo ($data['stock_num']); ?>" class="stock_num1" type="hidden">
                <span class="stock_num2" style="color: red"><?php echo ($data['stock_num']); ?></span>
                <label class="desc" style="margin-left: 10px;">调拨数量：</label>
                <input name="goods_num" class="desc-input" style="margin-left: 10px;" value="1">
                <span style="color: #c2c2c2;text-align: center;margin-left: 10px; ">*调拨数量不能大于库存</span>
            </div>
        </div>

    </div>
        <div class="item">
            <a href="#" style="color: #0a79d5" id="addredeploy">继续添加商品</a>
        </div>
    <div class="action">
        <button  style="color: #000000;font-size: 18px;" id="redeploy_action">确认</button>
    </div>
</div>
<script>
   function jiankong(th) {
       var storehouse_id = $("#out").val();
       var goods_id =$(th).val();
           $.ajax({
               url: "/vmallshop/index.php/Admin/Stock/stock_num",
               type: 'post',
               dataType: 'json',
               data: {
                   goods_id:goods_id,
                   storehouse_id:storehouse_id
               },
               success: function (data) {
                   $(th).parent().next().children('.stock_num1').val(data.stock_num);
                   $(th).parent().next().children('.stock_num2').html(data.stock_num);
                   aj = false;
                   return aj;
               }
           });
   }
    $("#addredeploy").click(function () {
        var storehouse_id = $("#out").val();
        $.ajax({
            url: "/vmallshop/index.php/Admin/Stock/stock_goods_name",
            type: 'post',
            dataType: 'json',
            data: {
                storehouse_id:storehouse_id
            },
            success: function (data) {
                var str ='';
                str+='    <div>';
                str+='    <div class="item">';
                str+='    <label class="desc">商品名称：</label>';
                str+=' <select class="select goods_id"  name="goods_id" style="width: 60%;" onchange="jiankong(this)">';
                for (var i = 0; i < data.list.length; i++) {
                    var list =data.list[i];
                    str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
                }
                str+='        </select>';
                str+='        <a href="#" style="color: red;margin-left: 20px" onclick="delb(this)">删除商品</a>';
                str+='    </div>';
                str+='         <div class="item">';
                str+='<label class="desc">库存数量：</label>';
                str+='<input class="stock_num1" name="stock_num" value="0"  type="hidden">';
                str+=' <span class="stock_num2" style="color: red">0</span>';
                str+=' <label class="desc" style="margin-left: 10px;">调拨数量：</label>';
                str+='<input name="goods_num" class="desc-input" style="margin-left: 10px;" value="1">';
                str+='<span style="color: #c2c2c2;text-align: center;margin-left: 10px; ">*调拨数量不能大于库存</span>';
                str+=' </div>';
                str+='    </div>';

                $('#demo').append(str);
                if(data.status == 'error'){
                    alert(data.msg);
                }
            },

        });
    })
    function delb(th) {
        $(th).parent('div').parent().remove();

    }
    //获取数据
   $('#redeploy_action').click(function () {
       //遍历获取入库信息
       var aler = true;
       var goods_id = new Array(); //或者写成：var btns= [];
       jQuery("select[name='goods_id']").each(function(key,value) {
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
       //获取当前库存
       var stock_num = new Array(); //或者写成：var btns= [];
       jQuery("input[name='stock_num']").each(function(key,value) {
           stock_num[key] = $(this).val();
       });
       //获取仓库id
       var out_storehouse_id = $("#out").val();
       var into_storehouse_id = $('#into').val();

       if(aler == true){
           $.ajax({
               url: "/vmallshop/index.php/Admin/Stock/redeploy_action",
               type: 'post',
               dataType: 'json',
               data: {
                   goods_id:goods_id,
                   goods_num:goods_num,
                   into:into_storehouse_id,
                   out:out_storehouse_id,
                   stock_num:stock_num
               },
               success: function (data) {
                   alert(data.msg);
                   if(data.status == 'success'){
                       window.location.replace(location.href);
                       aler = false;
                       return aler;
                   }
               },
               fail: function (data) {
                   aler = false;
                   return aler;
               }
           });
       }else {

       }

   })
   function out_stock() {
       var storehouse_id =$("#out").val();
       $.ajax({
           url: "/vmallshop/index.php/Admin/Stock/stock_goods_name",
           type: 'post',
           dataType: 'json',
           data: {
               storehouse_id:storehouse_id,
           },
           success: function (data) {
               var str ='';
               if(data.list.length > 0){
                   for (var i = 0; i < data.list.length; i++) {
                       var list =data.list[i];
                       str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
                   }
               }else {
                   str+='<option value="">'+data.msg+'</option>';
               }

               $('.goods_id').html(str)
           }
       });
   }
</script>