<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/vmallshop/index.php/Admin/IndexSale/insert/navTabId/listIndexSale/callbackType/closeCurrent"  class="pageForm required-validate" onsubmit="return iframeCallback(this, navTabAjaxDone);" enctype="multipart/form-data"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			
			<dl>
				<dt>首页区域:</dt>
				<dd><input type="text"  style="width:100%" name="index_sale_area" value="<?php echo ($vo["index_sale_area"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>促销的图片:</dt>
				<dd><input type="file"  style="width:100%" name="index_sale_img" value="<?php echo ($vo["index_sale_img"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>关联商品名:</dt>
					<select class="combox required" name="goods_id" id="w_combox_city" ref="w_combox_area" >
						<option value="all">---商品列表选择---</option>
						<?php if(is_array($cat_info)): $i = 0; $__LIST__ = $cat_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=<?php echo ($vo["goods_id"]); ?>><?php echo ($vo["goods_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>			
			</dl>
			<dl>
				<dt>促销名:</dt>
				<dd><input type="text"  style="width:100%" name="index_sale_title" value="<?php echo ($vo["index_sale_title"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>促销关键字:</dt>
				<dd><input type="text"  style="width:100%" name="index_sale_keywords" value="<?php echo ($vo["index_sale_keywords"]); ?>"/></dd>
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