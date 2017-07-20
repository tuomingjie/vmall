<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Brand/update/navTabId/listbrand/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);"  enctype="multipart/form-data"><?php  ?>
		<input type="hidden" name="brand_id" value="<?php echo ($vo["brand_id"]); ?>"/>
		<input type="hidden" name="old_img" value="<?php echo ($vo["brand_img"]); ?>" />
		<div class="pageFormContent" layoutH="60">
			
			<dl>
				<dt>名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="brand_name" value="<?php echo ($vo["brand_name"]); ?>"/></dd>
			</dl>

			<dl>
				<dt>头像:</dt>
				<dd><input type="file"    style="width:100%" name="brand_img" /></dd>
			</dl>
			<dl>
				<dt>排序:</dt>
				<dd><input type="number"  class="required"   style="width:100%" name="brand_sort" value="<?php echo ($vo["brand_sort"]); ?>"/></dd>
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