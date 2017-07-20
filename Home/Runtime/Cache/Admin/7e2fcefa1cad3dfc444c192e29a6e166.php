<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/vmallshop/index.php/Admin/Goods/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条--> 
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					商品编号：<input type="text" name="goods_no" value="<?php echo ($_POST['goods_no']); ?>" /> 
						&nbsp;&nbsp;商品名：<input size="10" type="text" name="goods_name" value="<?php echo ($_POST['goods_name']); ?>"/>
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/vmallshop/index.php/Admin/Goods/add" target="dialog" width="550" height="380" rel="user_msg" title="添加商品"><span>添加</span></a></li>
			<li><a class="delete" href="/vmallshop/index.php/Admin/Goods/del/goods_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listgoods" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Goods/edit/goods_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="navTab"><span>修改</span></a></li>
			
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="10" orderField="goods_id" <?php if($_REQUEST['_order']== 'goods_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>id</th>
				<th width="20" orderField="goods_no" <?php if($_REQUEST['_order']== 'goods_no'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品编号</th>
				<th width="40" >商品名称</th>
				
				
				<th width="20" >上市时间</th>
				
				<th width="40" orderField="goods_state" <?php if($_REQUEST['_order']== 'goods_state'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品状态</th>
				
				<th width="20" orderField="goods_original_price
				" <?php if($_REQUEST['_order']== 'goods_original_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品原价</th>
				
				<th width="20" orderField="goods_sale_price
				" <?php if($_REQUEST['_order']== 'goods_sale_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品促销价</th>
				
				
				<th width="20" orderField="goods_num
				" <?php if($_REQUEST['_order']== 'goods_num'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>库存总数</th>
				
				<th width="80" >商品质量</th>
				<th width="80" >商品放大小图URL</th>
				<th width="80" >供应商</th>
				
			</tr>
			
			
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["goods_id"]); ?>">
					<td><?php echo ($vo["goods_id"]); ?></td>
					<td><?php echo ($vo["goods_no"]); ?></td>
					<td><?php echo ($vo["goods_name"]); ?></td>
					<td><?php echo (date("Y-m-d",$vo["goods_time"])); ?></td>
					<td><?php echo ($vo["goods_state"]); ?></td>
					<td><?php echo ($vo["goods_original_price"]); ?></td>
					<td><?php echo ($vo["goods_sale_price"]); ?></td>
					<td><?php echo ($vo["goods_num"]); ?></td>
					<td><?php echo ($vo["goods_weight"]); ?></td>	
					<td><?php echo ($vo["goods_big_pic"]); ?></td>
					<td><?php echo ($vo["supplier_name"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
				<option value="10" <?php if($numPerPage == 10): ?>selected<?php endif; ?>>10</option>
				<option value="15" <?php if($numPerPage == 15): ?>selected<?php endif; ?>>15</option>
				<option value="20" <?php if($numPerPage == 20): ?>selected<?php endif; ?>>20</option>
				<option value="25" <?php if($numPerPage == 25): ?>selected<?php endif; ?>>25</option>
				<option value="30" <?php if($numPerPage == 30): ?>selected<?php endif; ?>>30</option>
			</select>
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
	</div>
</div>