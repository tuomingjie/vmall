<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Region/insert/navTabId/listregion/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			
			<!-- <dl>
				<dt>编号ID:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="region_id"/></dd>
			</dl>	 -->
			
			<dl>
				<dt>父级ID:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="parent_id"/></dd>
			</dl>	
			
			<dl>
				<dt>地区名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="region_name"/></dd>
			</dl>
			<dl>
				<dt>等级:</dt>
			   <select class="combox required" name="region_type" id="w_combox_city" ref="w_combox_area" >
		        <option value="0">---国家---</option>
				<option value="1">---省级---</option>
				<option value="2">---市级---</option>
				<option value="3" selected>---区域---</option>
			   </select>
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