<?php if (!defined('THINK_PATH')) exit();?><style>
	.region_div, .region_div2{clear:both;}
	#add_btn, #del_btn{margin-top:5px; background:#ddd; padding:4px 6px;float:left;border:1px solid #666;border-radius:2px;cursor:pointer;}
	.goods_btn{
	margin-top:5px; background:#ddd; padding:4px 6px;float:left;border:1px solid #666;border-radius:2px;cursor:pointer;margin-right:5px;
	}
	
	.goods_ul{width:100%;}
	.goods_ul .sheng{width:100%;height:30px;border-bottom:dotted 1px #ccc;}
	.sheng_ul li{width:50%;height:30px;float:left;line-height:30px;}
	.sheng_ul li input{margin-top:5px;width:50%;}
</style>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Goods/update/navTabId/listgoods/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);" 
		enctype="multipart/form-data"><?php  ?>
		<input type="hidden" name="goods_id" value="<?php echo ($vo["goods_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			
			<dl>
				<dt>商品编号:</dt>
				<dd><input type="text"  style="width:100%" name="goods_no" value="<?php echo ($vo["goods_no"]); ?>" readonly></dd>
			</dl>
			
			<dl>
				<dt>商品名称:</dt>
				<dd><input type="text"  style="width:100%" name="goods_name" value="<?php echo ($vo["goods_name"]); ?>"/></dd>
			</dl>
			<dl class="nowrap">
			<dt>商品关键描述：</dt>
			<dd><textarea name="goods_keywords" cols="80" rows="2"><?php echo ($vo["goods_keywords"]); ?></textarea></dd>
		    </dl>
			<dl>
				<dt>商品上市时间:</dt>
				<dd><input type="text"  style="width:100%" name="goods_time" value="<?php echo (date('Y-m-d',$vo["goods_time"])); ?>" readonly></dd>
			</dl>
			<p>
				<label>商品状态：</label>
				<select name="goods_state" class="required combox">
				    <option value="无" >无</option>
					<option value="新品" selected>新品</option>
					<option value="热卖" >热卖</option>
					
					<option value="首发" >首发</option>
					<option value="人气" >人气</option>
			        <option value="商品已下架" >商品已下架</option>
				   
				</select>
			</p>
			<dl>
				<dt>商品原价:</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="goods_original_price" value='<?php echo ($vo["goods_original_price"]); ?>'/></dd>
			</dl>
			<dl>
				<dt>商品促销价:</dt>
				<dd><input type="text" class="number number"  style="width:100%" name="goods_sale_price" value="<?php echo ($vo["goods_sale_price"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>供应价:</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="supply_price" value="<?php echo ($vo["supply_price"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>基准价:</dt>
				<dd><input type="text" class="required number "  style="width:100%" name="base_price" value="<?php echo ($vo["base_price"]); ?>"/></dd>
			</dl>
			
			<!--
			<div style="width:100%;height:10px;clear:both;"></div>
			
			<div class="region_div">
				<?php if(is_array($region_price_info)): $k = 0; $__LIST__ = $region_price_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k % 2 );++$k;?><div class="region_div2">
						<dl>
							<dt>地区:</dt>
							<dd title="<?php echo ($vo2["region_id"]); ?>">
								<select class="combox required" name="region_id[]" id="w_combox_city<?php echo ($k); ?>" ref="w_combox_area"  >
								   <option value="0">---地区选择---</option>
								   <?php if(is_array($one)): foreach($one as $one_k=>$one_v): ?><option value=<?php echo ($one_v["region_id"]); ?> <?php echo $vo2['region_id']==$one_v['region_id']?'selected':'';?> ><?php echo ($one_v["region_name"]); ?>省</option>
										<?php if(is_array($two)): foreach($two as $two_k=>$two_v): if($two_v["parent_id"] == $one_v["region_id"] ): ?><option value=<?php echo ($two_v["region_id"]); ?> <?php echo $vo2['region_id']==$two_v['region_id']?'selected':'';?>>&nbsp;&nbsp;&nbsp;<?php echo ($two_v["region_name"]); ?>市</option>
												<?php if(is_array($three)): foreach($three as $three_k=>$three_v): if($three_v["parent_id"] == $two_v["region_id"] ): ?><option value=<?php echo ($three_v["region_id"]); ?> <?php echo $vo2['region_id']==$three_v['region_id']?'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($three_v["region_name"]); ?>区/市</option><?php endif; endforeach; endif; endif; endforeach; endif; endforeach; endif; ?>
								</select>
							</dd>
						</dl>
						<dl>
							<dt>价格:</dt>
							<dd><input type="text" class=" number"  style="width:50%" name="region_price[]" value="<?php echo ($vo2["rp_price"]); ?>" title="<?php echo ($vo2["rp_price"]); ?>"/></dd>
							
						</dl>
						<span class="goods_btn update" value="<?php echo ($vo2["rp_id"]); ?>"  >确定修改</span>
						<span class="goods_btn del" value="<?php echo ($vo2["rp_id"]); ?>">确定删除</span>
						
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="region_div2"><span class="goods_btn" id="add_btn" >添加</span></div>
			<div style="width:100%;height:20px;clear:both;"></div>
			-->
			
			
			<dl class="nowrap">
			<dt>商品优惠描述：</dt>
			<dd><textarea name="goods_sale_desc" cols="80" rows="2"><?php echo ($vo["goods_sale_desc"]); ?></textarea></dd>
		    </dl>
			
			
			<dl>
				<dt>商品数量:</dt>
				<dd><input type="text" class="required digits"  style="width:100%" name="goods_num" value="<?php echo ($vo["goods_num"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>商品重量:</dt>
				<dd><input type="text" class="required "  style="width:100%" name="goods_weight" value="<?php echo ($vo["goods_weight"]); ?>"/></dd>
			</dl>
			
			<p>
				<label>商品大图：</label>
				<input name="goods_img" type="file" style="width:240px;" />
			</p>
			<div style="width:100%;height:20px;clear:both;"></div>
			<p>
			
			<label>商品分类：</label>
		   <select class="combox required" name="category_id" id="w_combox_city" ref="w_combox_area" >
		       
			   <?php if(is_array($cat_info)): $i = 0; $__LIST__ = $cat_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cs): $mod = ($i % 2 );++$i; if(($cs["category_id"]) == $vo["category_id"]): ?><option value=<?php echo ($cs["category_id"]); ?> selected><?php echo ($cs["category_name"]); ?></option>
				   <?php else: ?>
				     <option value=<?php echo ($cs["category_id"]); ?>><?php echo ($cs["category_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			   
	      </select>
			 </p>
			 
			 <p>
				<label>供应商：</label>
				<select name="supplier_id" class="required combox">
				    <option value="0" >请选择</option>
					<?php if(is_array($supplier_info)): $i = 0; $__LIST__ = $supplier_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$su): $mod = ($i % 2 );++$i;?><option value="<?php echo ($su["supplier_id"]); ?>" <?php echo $vo['supplier_id'] == $su['supplier_id']?'selected':'';?>  ><?php echo ($su["supplier_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</p>
			
			<p>
				<label>品牌：</label>
				<select name="brand_id" class="required combox">
				    <option value="0" >请选择</option>
					<?php if(is_array($brand_info)): $i = 0; $__LIST__ = $brand_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b_vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b_vo["brand_id"]); ?>" <?php echo $vo['brand_id']==$b_vo['brand_id']?'selected':'';?>><?php echo ($b_vo["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</p>
			 
			 <p>
				<label>商品拥有的属性：</label>
				<input name="goods_attr_value"  value="<?php echo ($vo["goods_attr_value"]); ?>" />
			</p>
			
			
			<div class="divider"></div>
			<div style=" float:left; display:block; margin:10px; overflow:auto; width:60%; height:200px; border:solid 1px #CCC; line-height:21px; background:#FFF;">
				<ul class="goods_ul">
					<?php if(is_array($one)): foreach($one as $k1=>$vo1): ?><li class="sheng">
							<ul class="sheng_ul">
								<li>&nbsp;&nbsp;&nbsp; <?php echo ($vo1["region_name"]); ?></li>
								<?php if(is_array($region_price_info)): foreach($region_price_info as $rp_k=>$rp_vo): if($vo1["region_id"] == $rp_vo["region_id"] ): ?><li>
										<div>
											<input type="number" class="number "   name="region_price[]" value="<?php echo ($rp_vo["rp_price"]); ?>"/>
											<input type="hidden" name="region_id[]" value="<?php echo ($vo1["region_id"]); ?>" >
										</div>
									</li><?php endif; endforeach; endif; ?>
							</ul>
						</li>
						<?php if(is_array($two)): foreach($two as $k2=>$vo2): if($vo2["parent_id"] == $vo1["region_id"] ): ?><li class="sheng">
									<ul class="sheng_ul">
										<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo ($vo2["region_name"]); ?></li>
										<?php if(is_array($region_price_info)): foreach($region_price_info as $rp_k=>$rp_vo): if($vo2["region_id"] == $rp_vo["region_id"] ): ?><li>
												<div>
													<input type="number" class="number "   name="region_price[]" value="<?php echo ($rp_vo["rp_price"]); ?>"/>
													<input type="hidden" name="region_id[]" value="<?php echo ($vo2["region_id"]); ?>" >
												</div>
											</li><?php endif; endforeach; endif; ?>
									</ul>
								</li>
								<?php if(is_array($three)): foreach($three as $k3=>$vo3): if($vo3["parent_id"] == $vo2["region_id"] ): ?><li class="sheng">
											<ul class="sheng_ul">
												<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($vo3["region_name"]); ?></li>
												<li>
													<div>
														<input type="number" class="number "   name="region_price[]" value="0.00"/>
														<input type="hidden" name="region_id[]" value="<?php echo ($vo3["region_id"]); ?>" >
													</div>
												</li>
											</ul>
										</li><?php endif; endforeach; endif; endif; endforeach; endif; endforeach; endif; ?>
				</ul>
			</div>
			
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>



<script>
/*
$(function(){

//增加一个地区和金额(原有)
$('#add_btn').click(function(){
	var str = "<div class='region_div2'><dl><dt>地区:</dt><dd>";
	str += "<?php echo ($html); ?>";
	str += "</dd></dl><dl><dt>价格:</dt><dd><input type='text' class=' number'  style='width:50%' name='region_price[]'/></dd></dl><span class='goods_btn'  type='1' onclick='operation(this)' title='' oldRegionId='' oldPrice='' >确认添加</span><span id='del_btn' onclick='del(this)' title=''>取消添加</span></div>";
	$('.region_div').append(str);
});


//更新地区金额(原有)
$('.update').click(function(){
	
	var rp_id =  $(this).attr('value');	//当前ID值

	var region_id = $(this).parents('.region_div2').children(":first").children('dd').children('.combox').children('.select').children('a').attr('value');	//地区ID
	var region_ids = $(this).parents('.region_div2').children(":first").children('dd').attr('title');	//原来地区ID
	
	var region_price = $(this).parents('.region_div2').children("dl").eq(1).children('dd').children('input[name="region_price[]"]').val();	//金额
	var region_prices = $(this).parents('.region_div2').children("dl").eq(1).children('dd').children('input[name="region_price[]"]').attr('title');	//原来金额
	
	if(region_id != region_ids || region_price != region_prices){
		ajax_update(rp_id,region_id,region_price);
	}else{
		alert('没有修改信息');
	}
	
	
});





//删除地区金额(原有)

$('.del').click(function(){
	var rp_id = $(this).attr('value');
	if(window.confirm('你确定要删除吗？')){
		 
		var result = ajax_del(rp_id);
		if(result){
			$(this).parents(".region_div2").remove();
			alert('删除成功');
		}else{
			alert('删除失败');
		}
		
		
		
	}else{
		 //alert("取消");
		 return false;
	}

})

	
});
//移除一个新添加的地区和金额
function del(btn){
	$(btn).parents(".region_div2").remove();
}


//新添加的地区金额  添加和修改操作
function operation(btn){
	var goods_id = $('input[name="goods_id"]').val();	//商品ID
	var type = $(btn).attr('type');
	var region_id = $(btn).parents('.region_div2').children(":first").children('dd').children('select').val();	//地区ID 
	var region_price = $(btn).parents('.region_div2').children("dl").eq(1).children('dd').children('input[name="region_price[]"]').val();	//金额
	
	if(type==1){
		
		if(region_id == 0 || region_price ==''){
			alert("请填写完整地区和金额");
			return false;
		}
		
		var check = ajax_add(goods_id,region_id,region_price);
		if(check){
			$(btn).text('确认修改');
			$(btn).attr('type',2);
			$(btn).attr('oldRegionId',region_id);
			$(btn).attr('oldPrice',region_price);
			$(btn).attr('title',check);
			$(btn).next('span').text('确定删除');
			$(btn).next('span').attr('title',check);
			$(btn).next('span').attr('onclick','n_del(this)');
			alert('添加成功!');
		}else{
			alert('添加失败!');
		}
	}else{
	
		var region_ids = $(btn).attr('oldRegionId');	//获取原有地区ID
		var region_prices = $(btn).attr('oldPrice'); //获取原有地区金额
		var rp_id = $(btn).attr('title');		//编号id
		
		if(region_id != region_ids || region_price != region_prices){
			ajax_update(rp_id,region_id,region_price);
		}else{
			alert('没有修改信息');
		}
		
		
	}
	
	

	
}

//删除地区金额(新添加)
function n_del(btn){
	var rp_id = $(btn).attr('title');
	if(window.confirm('你确定要删除吗？')){
		 
		var result = ajax_del(rp_id);
		if(result){
			$(btn).parents(".region_div2").remove();
		}
		
		
		
	}else{
		 //alert("取消");
		 return false;
	}
}



//ajax 更新地区金额
 
function ajax_update(a,b,c){
	$.ajax({
            type: "POST",
            url: "<?php echo U('Goods/ajax_update');?>",
            data: {
				rp_id:a,
				region_id:b,
				rp_price:c
			},
            dataType: "json",
            success: function (data) {
                if(data.status){
					alert(data.msg);
				}else{
					alert(data.msg);
				}
			}
    });
}

//ajax  删除地区金额纪录

function ajax_del(a){
	var str = false;
	$.ajax({
            type: "POST",
            url: "<?php echo U('Goods/ajax_del');?>",
			async:false, 
            data: {
				rp_id:a
			},
            dataType: "json",
            success: function (data) {
                if(data.status){
					
					str=true;
				}else{
					
					str = false;
				}
			}
    });
	return str;
}


//ajax 添加地区金额
 
function ajax_add(a,b,c){
	var check = false;
	$.ajax({
            type: "POST",
            url: "<?php echo U('Goods/ajax_add');?>",
            data: {
				goods_id:a,
				region_id:b,
				rp_price:c
			},
			async:false, 
            dataType: "json",
            success: function (data) {
                if(data.status){
					
					check = data.rp_id;
				}else{
					
					check = false;
				}
			}
    });
	return check;
}




*/




</script>