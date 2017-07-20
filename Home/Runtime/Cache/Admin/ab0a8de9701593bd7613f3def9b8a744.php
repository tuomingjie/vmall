<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台订单修改视图 * author:莫顺渠 -->
<div class="pageContent">
	<form method="post" action="/index.php/Admin/OrderDesc/update/navTabId/listorder/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="order_desc_id" value="<?php echo ($vo["order_desc_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
				<dl>
					<dt>订单状态：</dt>
					<dd><select name="order_desc_state" class="required combox">
						
						<option value="200" <?php echo $vo['order_desc_state']=='200'?'selected':'';?>>已付款</option>
						<option value="300" <?php echo $vo['order_desc_state']=='300'?'selected':'';?>>已发货</option>
						<option value="400" <?php echo $vo['order_desc_state']=='400'?'selected':'';?>>已完成</option>
						<option value="500" <?php echo $vo['order_desc_state']=='500'?'selected':'';?>>已评论</option>
					</select></dd>
				</dl>
				
				<dl>
					<dt>订单号:</dt>
					<dd><input type="text"  style="width:100%" class="required number" name="courier_number" value="<?php echo ($vo["courier_number"]); ?>"/></dd>
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