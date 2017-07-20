<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Customer/update/navTabId/listcustomer/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="customer_id" value="<?php echo ($vo["customer_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="customer_name" value="<?php echo ($vo["customer_name"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>地区选择:</dt>
				<select class="combox required" name="region_id" id="w_combox_city" ref="w_combox_area" >
				   <option value="0">---地区选择---</option>
				   <?php if(is_array($one)): foreach($one as $one_k=>$one_v): ?><option value=<?php echo ($one_v["region_id"]); ?>  <?php echo $one_v['region_id']==$vo['region_id']?'selected':''; ?> ><?php echo ($one_v["region_name"]); ?>省</option>
						<?php if(is_array($two)): foreach($two as $two_k=>$two_v): if($two_v["parent_id"] == $one_v["region_id"] ): ?><option value=<?php echo ($two_v["region_id"]); ?> <?php echo $two_v['region_id']==$vo['region_id']?'selected':''; ?>>&nbsp;&nbsp;&nbsp;<?php echo ($two_v["region_name"]); ?>市</option>
								<?php if(is_array($three)): foreach($three as $three_k=>$three_v): if($three_v["parent_id"] == $two_v["region_id"] ): ?><option value=<?php echo ($three_v["region_id"]); ?> <?php echo $three_v['region_id']==$vo['region_id']?'selected':''; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($three_v["region_name"]); ?>区/市</option><?php endif; endforeach; endif; endif; endforeach; endif; endforeach; endif; ?>
				</select>
			   
			</dl>
			
			
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>