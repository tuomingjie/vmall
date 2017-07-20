<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Supplier/insert/navTabId/listsupplier/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="name"/></dd>
			</dl>
			<dl>
				<dt>密码:</dt>
				<dd><input type="password" id="mypass" class="required alphanumeric" minlength="6" maxlength="20"  style="width:100%" name="password"/></dd>
			</dl>
			<dl>
				<dt>确认密码:</dt>
				<dd><input type="password" equalto="#mypass" class="required" equalto="#xxxId"  style="width:100%" name="password1"/></dd>
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