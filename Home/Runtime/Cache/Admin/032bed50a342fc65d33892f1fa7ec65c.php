<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Supplier/update/navTabId/listsupplier/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>ID:</dt>
				<dd><input type="text" style="width:100%" name="id" value="<?php echo ($vo["id"]); ?>" disabled="true"  /></dd>
			</dl>
			
			<dl>
				<dt>名称:</dt>
				<dd><input type="text"  style="width:100%" name="name" value="<?php echo ($vo["name"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>密码:</dt>
				<dd><input type="password"  style="width:100%" name="password" value=""/></dd>
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