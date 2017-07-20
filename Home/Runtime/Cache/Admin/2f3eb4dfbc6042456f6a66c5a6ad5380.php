<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Ad/insert/navTabId/listAd/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);"  enctype="multipart/form-data"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<!-- <dl>
				<dt>广告ID:</dt>
				<dd><input type="text"  style="width:100%" name="ad_id"/></dd>
			</dl> -->
			
			<dl>
				<dt>广告区域:</dt>
				<dd><input type="text" class="required number"  style="width:100%" name="index_sale_area"/></dd>
			</dl>
			
			<dl>
				<dt>广告图像:</dt>
				<dd><input type="file" class="required"  style="width:100%" name="index_sale_img"/></dd>
			</dl>
			
			<dl>
				<dt>跳转的URL:</dt>
				<dd><input type="text"   style="width:100%" name="ad_url"/></dd>
			</dl>
			
			<dl>
				<dt>备注:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="ad_content"/></dd>
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