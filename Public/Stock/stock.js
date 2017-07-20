// /**
//  * Created by Administrator on 2017/7/14.
//  */
// $('#editaction').click(function () {
//     var id =$('#desc_id').val();
//     //遍历获取入库信息
//     var goods_id = $("select[name='goods_name']").val(); //或者写成：var btns= [];
//     var goods_num = $("input[name='goods_num']").val(); //或者写成：var btns= [];
//     var goods_buy_price = $("input[name='goods_buy_price']").val(); //或者写成：var btns= [];
//     var goods_sell_price = $("input[name='goods_sell_price']").val(); //或者写成：var btns= [];
//     //获取仓库id
// //        var storehouse_id = $('#store').val();
//
//     $.ajax({
//         url: "__CONTROLLER__/edit_action",
//         type: 'post',
//         dataType: 'json',
//         data: {
//             goods_id:goods_id,
//             goods_num:goods_num,
//             goods_buy_price:goods_buy_price,
//             goods_sell_price:goods_sell_price,
//             stock_desc_id:id
//         },
//         success: function (data) {
//             alert(data.msg);
//             if(data.status == 'success'){
//                 window.location.replace(location.href);
//             }
//         },
//         fail: function (data) {
//
//             return;
//         }
//     });
//
// })
// //提交数据
// $('#addaction').click(function () {
//     //遍历获取入库信息
//     var aler = true;
//     var goods_id = new Array(); //或者写成：var btns= [];
//     jQuery("select[name='goods_name']").each(function(key,value) {
//         goods_id[key] = $(this).val();
//         if(!$(this).val()){
//             aler = false;
//             return aler;
//         }
//     });
//     var goods_num = new Array(); //或者写成：var btns= [];
//     jQuery("input[name='goods_num']").each(function(key,value) {
//         goods_num[key] = $(this).val();
//         if(!$(this).val()){
//             aler = false;
//             return aler;
//         }
//     });
//     var goods_buy_price = new Array(); //或者写成：var btns= [];
//     jQuery("input[name='goods_buy_price']").each(function(key,value) {
//         goods_buy_price[key] = $(this).val();
//     });
//     var goods_sell_price = new Array(); //或者写成：var btns= [];
//     jQuery("input[name='goods_sell_price']").each(function(key,value) {
//         goods_sell_price[key] = $(this).val();
//     });
//     //获取仓库id
//     var storehouse_id = $('#store').val();
//     console.log(goods_sell_price);
//     if(aler == true){
//         $.ajax({
//             url: "__CONTROLLER__/add_action",
//             type: 'post',
//             dataType: 'json',
//             data: {
//                 goods_id:goods_id,
//                 goods_num:goods_num,
//                 goods_buy_price:goods_buy_price,
//                 goods_sell_price:goods_sell_price,
//                 storehouse_id:storehouse_id
//             },
//             success: function (data) {
//                 alert(data.msg);
//                 if(data.status == 'success'){
//                     window.location.replace(location.href);
//                 }
//             },
//             fail: function (data) {
//
//                 return;
//             }
//         });
//     }else {
//         alert('商品名或数量不能为空')
//     }
//
// })
// //添加商品demo结构
// $('#addstock').click(function () {
//     $.ajax({
//         url: "__CONTROLLER__/goods",
//         type: 'post',
//         dataType: 'json',
//         data: {
//
//         },
//         success: function (data) {
//             var str =' <div class="item">商品名称：';
//             str+=' <select class="select" name="goods_name" style="width: 450px;">';
//             for (var i = 0; i < data.list.length; i++) {
//                 var list =data.list[i];
//                 str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
//             }
//             str+='        </select>';
//             str+='        <a href="#" style="color: red;margin-left: 20px" onclick="del(this)">删除商品</a>';
//             str+='        <div class="item-label">';
//             str+='            <label class="desc">商品数量：<input name="goods_num" class="desc-input" value=""></label>';
//             str+='            <label class="desc">商品进价：<input name="goods_buy_price" class="desc-input" value=""></label>';
//             str+='            <label class="desc">预计售价：<input name="goods_sell_price" class="desc-input" value=""></label>';
//             str+='        </div>';
//             str+='    </div>';
//
//             $('#goods_name').append(str);
//             if(data.status == 'error'){
//                 alert(data.msg);
//             }
//         },
//
//     });
//
// })
// //删除产品demo结构
// function del(th) {
//     $(th).parent('div').remove();
//
// }
// //库存调配
// function jiankong(th) {
//     var storehouse_id = $("input[name='out']").val();
//     var goods_id =$(th).val();
//     $.ajax({
//         url: "__CONTROLLER__/stock_num",
//         type: 'post',
//         dataType: 'json',
//         data: {
//             goods_id:goods_id,
//             storehouse_id:storehouse_id
//         },
//         success: function (data) {
//             $(th).parent().next().children('.stock_num1').val(data.stock_num);
//             $(th).parent().next().children('.stock_num2').html(data.stock_num);
//             aj = false;
//             return aj;
//         }
//     });
// }
// $("#addredeploy").click(function () {
//     var storehouse_id = $("input[name='out']").val();
//     $.ajax({
//         url: "__CONTROLLER__/stock_name",
//         type: 'post',
//         dataType: 'json',
//         data: {
//             storehouse_id:storehouse_id
//         },
//         success: function (data) {
//             var str ='';
//             str+='    <div>';
//             str+='    <div class="item">';
//             str+='    <label class="desc">商品名称：</label>';
//             str+=' <select class="select" name="goods_id" style="width: 60%;" onchange="jiankong(this)">';
//             for (var i = 0; i < data.list.length; i++) {
//                 var list =data.list[i];
//                 str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
//             }
//             str+='        </select>';
//             str+='        <a href="#" style="color: red;margin-left: 20px" onclick="delb(this)">删除商品</a>';
//             str+='    </div>';
//             str+='         <div class="item">';
//             str+='<label class="desc">库存数量：</label>';
//             str+='<input class="stock_num1" name="stock_num" value="0"  type="hidden">';
//             str+=' <span class="stock_num2" style="color: red">0</span>';
//             str+=' <label class="desc" style="margin-left: 10px;">调配数量：</label>';
//             str+='<input name="goods_num" class="desc-input" style="margin-left: 10px;" value="1">';
//             str+='<span style="color: #c2c2c2;text-align: center;margin-left: 10px; ">*调配数量不能大于库存</span>';
//             str+=' </div>';
//             str+='    </div>';
//
//             $('#demo').append(str);
//             if(data.status == 'error'){
//                 alert(data.msg);
//             }
//         },
//
//     });
// })
// function delb(th) {
//     $(th).parent('div').parent().remove();
//
// }
// //获取数据
// $('#redeploy').click(function () {
//     //遍历获取入库信息
//     var aler = true;
//     var goods_id = new Array(); //或者写成：var btns= [];
//     jQuery("select[name='goods_id']").each(function(key,value) {
//         goods_id[key] = $(this).val();
//         if(!$(this).val()){
//             aler = false;
//             return aler;
//         }
//     });
//     var goods_num = new Array(); //或者写成：var btns= [];
//     jQuery("input[name='goods_num']").each(function(key,value) {
//         goods_num[key] = $(this).val();
//         if(!$(this).val()){
//             aler = false;
//             return aler;
//         }
//     });
//     //获取当前库存
//     var stock_num = new Array(); //或者写成：var btns= [];
//     jQuery("input[name='stock_num']").each(function(key,value) {
//         stock_num[key] = $(this).val();
//     });
//     //获取仓库id
//     var out_storehouse_id = $("input[name='out']").val();
//     var into_storehouse_id = $('#into').val();
//
//     if(aler == true){
//         $.ajax({
//             url: "__CONTROLLER__/redeploy_action",
//             type: 'post',
//             dataType: 'json',
//             data: {
//                 goods_id:goods_id,
//                 goods_num:goods_num,
//                 into:into_storehouse_id,
//                 out:out_storehouse_id,
//                 stock_num:stock_num
//             },
//             success: function (data) {
//                 alert(data.msg);
//                 if(data.status == 'success'){
//                     window.location.replace(location.href);
//                 }
//             },
//             fail: function (data) {
//
//                 return;
//             }
//         });
//     }else {
//         alert('商品名或数量不能为空')
//     }
//
// })