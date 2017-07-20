<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Category/insert/navTabId/listcategory/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			
			
			<dl>
				<dt>分类名称:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="category_name"/></dd>
			</dl>
			<p>
			<label>商品分类：</label>
			<select class="combox required" name="category_pid" id="w_combox_city" ref="w_combox_area" >
		       <option value="0">---顶级分类---</option>
			   <?php if(is_array($cat_info)): $i = 0; $__LIST__ = $cat_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["category_id"]); ?>><?php echo ($vo["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			   
			</select>
          </p>
		 <dl>
			<dt>分类类型:</dt>
			<dd><input type="text" class="required number"  style="width:100%" name="category_type"/></dd>
		</dl>
	   
	    
		 
		
		</div>
		
		<div class="formBar">
			<ul>
			    <!-- <label style="float:left"><input type="checkbox" class="checkboxCtrl" group="category_attr" />全选</label> -->
				<!-- <li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="category_attr" selectType="invert">反选</button></div></div></li> -->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>