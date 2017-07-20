<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Address/update/navTabId/listaddress/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="address_id" value="<?php echo ($vo["address_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			
			<dl>
				<dt>收货人姓名:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="address_name" value="<?php echo ($vo["address_name"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>手机号码:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="address_phone" value="<?php echo ($vo["address_phone"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>用户地址:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="address" value="<?php echo ($vo["address_content"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>邮编:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="address_post" value="<?php echo ($vo["address_post"]); ?>"/></dd>
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