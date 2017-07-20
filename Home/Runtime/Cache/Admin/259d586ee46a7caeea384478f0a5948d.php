<?php if (!defined('THINK_PATH')) exit();?><style>
	.region_div, .region_div2{clear:both;}
	#add_btn, #del_btn{margin-top:5px; background:#ddd; padding:4px 6px;float:left;border:1px solid #666;border-radius:2px;cursor:pointer;}
	.goods_ul{width:100%;}
	.goods_ul .sheng{width:100%;height:30px;border-bottom:dotted 1px #ccc;}
	.sheng_ul li{width:50%;height:30px;float:left;line-height:30px;}
	.sheng_ul li input{margin-top:5px;width:50%;}
</style>

<//商品新添加界面>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Goods/insert/navTabId/listgoods/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);"  enctype="multipart/form-data"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			
			<!--<dl>
				<dt>商品编号:</dt>
				<dd><input type="text" class="required digits"  minlength="11" maxlength="11" style="width:100%" name="goods_no"/></dd>
			</dl>-->
			
			
			
			<dl>
				<dt>商品名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="goods_name"/></dd>
			</dl>
			
			<dl class="nowrap">
			<dt>商品关键字：</dt>
			<dd><textarea name="goods_keywords" cols="80" rows="2"></textarea></dd>
		    </dl>
			
			<p>
				<label>上市时间：</label>
				<input type="text" name="goods_time" class="date required" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</p>
			
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
				<dd><input type="text" class="required number"  style="width:100%" name="goods_original_price"/></dd>
			</dl>
			<dl>
				<dt>商品促销价:</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="goods_sale_price"/></dd>
			</dl>
			
			<dl>
				<dt>供应价:</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="supply_price"/></dd>
			</dl>
			<dl>
				<dt>基准价:</dt>
				<dd><input type="text" class="required number "  style="width:100%" name="base_price"/></dd>
			</dl>
			
			<div style="width:100%;height:10px;clear:both;"></div>
			
		
		
			
			<dl class="nowrap">
			<dt>商品优惠描述：</dt>
			<dd><textarea name="goods_sale_desc" cols="80" rows="2"></textarea></dd>
		    </dl>
			
			
			<dl>
				<dt>商品数量:</dt>
				<dd><input type="text" class="required digits"  style="width:100%" name="goods_num"/></dd>
			</dl>
			<dl>
				<dt>商品重量:</dt>
				<dd><input type="text" class="required "  style="width:100%" name="goods_weight"/></dd>
			</dl>
			
			
			<p>
			<label>商品分类：</label>
		   <select class="combox required" name="category_id" id="w_combox_city" ref="w_combox_area" >
		       <option value="all">---商品分类选择---</option>
			   <?php if(is_array($cat_info)): $i = 0; $__LIST__ = $cat_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["category_id"]); ?>><?php echo ($vo["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			   
	      </select>
          </p>
		  
			<p>
				<label>供应商：</label>
				<select name="supplier_id" class="required combox">
				    <option value="0" >请选择</option>
					<?php if(is_array($supplier_info)): $i = 0; $__LIST__ = $supplier_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["supplier_id"]); ?>" ><?php echo ($vo["supplier_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</p>
			
			
			<p>
				<label>品牌：</label>
				<select name="brand_id" class="required combox">
				    <option value="0" >请选择</option>
					<?php if(is_array($brand_info)): $i = 0; $__LIST__ = $brand_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b_vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b_vo["brand_id"]); ?>" ><?php echo ($b_vo["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</p>
			
			<div class="divider"></div>
			<!----------------------------商品图片START------------------------------>
			<label style="font-weight:700;">商品图片</label><br/><br/>
			
			<dl>
				<dt >主图片：</dt>
				<dd><input type="file" class="required"  style="width:100%" name="gp_pic[]"/></dd>
			</dl>
			<dl>
				<dt >图片2：</dt>
				<dd><input type="file"   style="width:100%" name="gp_pic[]"/></dd>
			</dl>
			
			<dl>
				<dt >图片3：</dt>
				<dd><input type="file"   style="width:100%" name="gp_pic[]"/></dd>
			</dl>
			<dl>
				<dt >图片4：</dt>
				<dd><input type="file"   style="width:100%" name="gp_pic[]"/></dd>
			</dl>
			
			<dl>
				<dt >图片5：</dt>
				<dd><input type="file"   style="width:100%" name="gp_pic[]"/></dd>
			</dl>
					
				
		
			
		<!----------------------------商品图片END------------------------------>	
			
			
			<div class="divider"></div>
			<!----------------------------商品颜色START------------------------------>
			<label style="font-weight:700;">商品颜色</label><br/><br/>
			<div class="color_div">
				<div class="color_dl">
					<dl>
						<dt >颜色名：</dt>
						<dd><input type="text" class="required"  style="width:100%" name="gc_name[]"/></dd>
					</dl>
					
					<dl style="width:500px" >
						<dt>图片：</dt>
						<dd style="width:294px;">
							<input type="file"  class="required"  style="width:60%" name="gc_img[]"/>
							&nbsp;&nbsp;
							<input type="button" value="删除" onclick='del_color(this)'  />
						</dd>
					</dl>
				</div>
					
			</div>
			<div style="clear:both;"></div>
			<input type="button" value="添加" class="add_color" />
			
		 <!----------------------------商品颜色END------------------------------>
		 
		 
			<div class="divider"></div>
			
			<!----------------------------商品属性选择START------------------------------>
			<label >商品属性选择：</label><br/><br/>
			   <p>
		     <?php if(is_array($avalue_info)): $i = 0; $__LIST__ = $avalue_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$avalue): $mod = ($i % 2 );++$i;?><dl>
				 <dt><?php echo ($key); ?>:</dt>
				 <dd><select class="combox required" name="goods_attr[]"  ref="w_combox" >
				   <?php if(is_array($avalue)): $i = 0; $__LIST__ = $avalue;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$avs): $mod = ($i % 2 );++$i;?><option value="<?php echo ($avs['avalue_id']); ?>"><?php echo ($avs['avalue_value']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				  
				   
			  
			   </select></dd>
			     </dl><?php endforeach; endif; else: echo "" ;endif; ?>
			  </p>
			<!----------------------------商品属性选择END------------------------------>  
			  <div class="divider"></div>
			<!----------------------------商品自定义属性START------------------------------>
			<label style="font-weight:700;">商品自定义属性：</label><br/><br/>
			  
				<div class="custom_attr_div">
					<!-- <div class="custom_attr_dl">
						<dl>
							<dt>属性名：</dt>
							<dd><input type="text"   style="width:100%" name="ga_name[]"/></dd>
						</dl>
						
						<dl style="width:500px" >
							<dt>属性值：</dt>
							<dd style="width:294px;">
								<input type="text"   style="width:80%" name="ga_value[]"/>
								&nbsp;&nbsp;
								<input type="button" value="删除" onclick='del_custom_attr(this)'  />
							</dd>
						</dl>
					</div> -->
					
				</div>
				<div style="clear:both;"></div>
				<input type="button" value="添加" class="add_custom_attr" />
			<!----------------------------商品自定义属性END------------------------------>	
			
			<div class="divider"></div>
			<div style=" float:left; display:block; margin:10px; overflow:auto; width:60%; height:200px; border:solid 1px #CCC; line-height:21px; background:#FFF;">
				<ul class="goods_ul">
					<?php if(is_array($one)): foreach($one as $k1=>$vo1): ?><li class="sheng">
							<ul class="sheng_ul">
								<li>&nbsp;&nbsp;&nbsp; <?php echo ($vo1["region_name"]); ?></li>
								<li>
									<div>
										<input type="number" class="number "   name="region_price[]" value="0.00"/>
										<input type="hidden" name="region_id[]" value="<?php echo ($vo1["region_id"]); ?>" >
									</div>
								</li>
							</ul>
						</li>
						<?php if(is_array($two)): foreach($two as $k2=>$vo2): if($vo2["parent_id"] == $vo1["region_id"] ): ?><li class="sheng">
									<ul class="sheng_ul">
										<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo ($vo2["region_name"]); ?></li>
										<li>
											<div>
												<input type="number" class="number "   name="region_price[]" value="0.00"/>
												<input type="hidden" name="region_id[]" value="<?php echo ($vo2["region_id"]); ?>" >
											</div>
										</li>
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
			<div class="divider"></div>
			<!-----------------------------------产品详情开始----------------------------------------->
			<dl>
				<dt>商品内容：</dt>
				<dd>
					<div class="unit">
						<textarea class="editor" name="goods_content" rows="30" cols="100"
							upLinkUrl="upload.php" upLinkExt="zip,rar,txt" 
							upImgUrl="upload.php" upImgExt="jpg,jpeg,gif,png" 
							upFlashUrl="upload.php" upFlashExt="swf"
							upMediaUrl="upload.php" upMediaExt:"avi"></textarea>
					</div>
				</dd>
			</dl>
			
			
			
			<!-----------------------------------产品详情结束----------------------------------------->
		  
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
//添加自定义属性
$('.add_custom_attr').click(function(){
	var str = "<div class='custom_attr_dl'><dl><dt>属性名:</dt><dd><input type='text' class='required'  style='width:100%' name='ga_name[]'/></dd></dl>	<dl style='width:500px' ><dt>属性值:</dt><dd style='width:294px;'><input type='text'   style='width:80%' class='required' name='ga_value[]'/> &nbsp;&nbsp;<input type='button' value='删除' onclick='del_custom_attr(this)' /></dd></dl></div>";
	$('.custom_attr_div').append(str);
});

//移除自定义属性
function del_custom_attr(btn){
	if(window.confirm('你确定要删除吗？')){
		$(btn).parents('.custom_attr_dl').remove();
	}
	
}


//添加颜色
$('.add_color').click(function(){
	var str = "<div class='color_dl'><dl><dt >颜色名:</dt><dd><input type='text' class='required'  style='width:100%' name='gc_name[]'/></dd></dl><dl style='width:500px' ><dt>图片：</dt><dd style='width:294px;'><input type='file'   style='width:60%' class='required' name='gc_img[]'/>&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='删除' onclick='del_color(this)'  /></dd></dl></div>";
	$('.color_div').append(str);
});

//移除颜色
function del_color(btn){
	if(window.confirm('你确定要删除吗？')){
		$(btn).parents('.color_dl').remove();
	}
	
}
</script>