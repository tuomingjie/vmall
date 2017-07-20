<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台订单修改视图 * author:莫顺渠 -->
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Order/update/navTabId/listorder/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="order_id" value="<?php echo ($order_id); ?>"/>
		<div class="pageFormContent" layoutH="60">
				<dt>订单状态：</dt>
				<select name="order_state" class="required combox">
					<option value="未付款" selected>未付款</option>
					<option value="已付款" >已付款</option>
					<option value="未发货" >未发货</option>
					<option value="已发货" >已发货</option>
					<option value="订单已取消" >订单已取消</option>
			        <option value="订单成功" >订单提交成功</option>
				</select>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>