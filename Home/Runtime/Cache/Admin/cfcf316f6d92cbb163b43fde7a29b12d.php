<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Brand/insert/navTabId/listbrand/callbackType"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);"  enctype="multipart/form-data"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="brand_name"/></dd>
			</dl>
			<dl>
				<dt>头像:</dt>
				<dd><input type="file"  class="required"   style="width:100%" name="brand_img"/></dd>
			</dl>
			<dl>
				<dt>排序:</dt>
				<dd><input type="number"  class="required"   style="width:100%" name="brand_sort" value="1"/></dd>
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