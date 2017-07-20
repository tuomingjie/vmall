<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/Category/update/navTabId/listcategory/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>分类id:</dt>
				<dd><input type="text" class="required"  style="width:100%" name="category_id" value="<?php echo ($vo["category_id"]); ?>"/ readonly></dd>		</dl>
			
			<dl>
				<dt>分类名称:</dt>
				<dd><input type="text"  style="width:100%" name="category_name" value="<?php echo ($vo["category_name"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>分类父类pid:</dt>
				<select class="combox required" name="category_pid" id="w_combox_city" ref="w_combox_area" >
				   <option value="0">---顶级分类---</option>
				   <?php if(is_array($cat_info)): $i = 0; $__LIST__ = $cat_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo1["category_id"]); ?> <?php echo $vo['category_pid']==$vo1['category_id']?'selected':'';?>><?php echo ($vo1["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			   
				</select>
			  </dd>
			</dl>
			<dl>
				<dt>分类路径:</dt>
				<dd><input type="text"  style="width:100%" name="category_path" value="<?php echo ($vo["category_path"]); ?>" readonly></dd>
			</dl>
			<dl>
				<dt>分类类型:</dt>
				<dd><input type="text"  style="width:100%" name="category_type" value="<?php echo ($vo["category_type"]); ?>" readonly></dd>
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