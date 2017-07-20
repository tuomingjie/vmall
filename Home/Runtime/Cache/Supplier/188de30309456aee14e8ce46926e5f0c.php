<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台订单修改视图 * author:莫顺渠 -->
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Supplier/Order/update/navTabId/listorder/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="order_desc_id" value="<?php echo ($order_desc_id); ?>"/>
		<div class="pageFormContent" layoutH="60">
				<dt>快递单号：</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="courier_number" value='<?php echo ($vo["courier_number"]); ?>'/></dd>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>