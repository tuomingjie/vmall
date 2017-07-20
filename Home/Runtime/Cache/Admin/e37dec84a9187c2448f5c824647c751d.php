<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Info/insert/navTabId/listinfo/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return iframeCallback(this, navTabAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>资讯名:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="info_name"/></dd>
			</dl>
			<div style="clear:both;"></div>
			<dl>
				<dt>资讯内容:</dt>
				<dd>
					<div class="unit">
						<textarea class="editor" name="info_content" rows="30" cols="100"
							upLinkUrl="upload.php" upLinkExt="zip,rar,txt" 
							upImgUrl="upload.php" upImgExt="jpg,jpeg,gif,png" 
							upFlashUrl="upload.php" upFlashExt="swf"
							upMediaUrl="upload.php" upMediaExt:"avi"></textarea>
					</div>
				</dd>
			</dl>
			
			
			
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit"  id="info_btn" onclick="add_info()" >保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>