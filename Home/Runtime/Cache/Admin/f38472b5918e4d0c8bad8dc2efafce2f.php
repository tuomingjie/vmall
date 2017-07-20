<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/index.php/Admin/Avalue/insert/navTabId/listavalue/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			
			
			<dl>
				<dt>商品属性值:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="avalue_value"/></dd>
			</dl>
			<p>
			<label>所属属性：</label>
		   <select class="combox required" name="attr_id" id="w_combox_city" ref="w_combox_area" >
		       <option value="all">---商品属性---</option>
			   <?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["attr_id"]); ?>><?php echo ($vo["attr_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			   
	      </select>
          </p>
			
			
			
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>