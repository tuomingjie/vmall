<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台详情订单视图 * author:莫顺渠 -->
<form id="pagerForm" action="/vmallshop/index.php/Admin/OrderDesc/index" method="post">
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
					主订单编号：<input type="text" name="order_no" value="<?php echo ($_POST['order_no']); ?>" /> 						
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
			
			<li><a class="delete" href="/vmallshop/index.php/Admin/OrderDesc/del/order_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listorder_desc" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/OrderDesc/edit/order_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="order_desc_id" <?php if($_REQUEST['_order']== 'order_desc_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单详细ID</th>
				
				<th width="40" orderField="order_desc_num" <?php if($_REQUEST['_order']== 'order_desc_num'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>购买数量</th>
				
				<th width="40" orderField="order_id" <?php if($_REQUEST['_order']== 'order_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单ID</th>
				
				<th width="40" orderField="order_no" <?php if($_REQUEST['_order']== 'order_no'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>主表订单编号</th>
				
				<th width="40" orderField="supply_num" <?php if($_REQUEST['_order']== 'supply_num'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>子表订单编号</th>
				
				<th width="40" orderField="supply_price" <?php if($_REQUEST['_order']== 'supply_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>供应价</th>
				
				<th width="40" orderField="supply_total" <?php if($_REQUEST['_order']== 'supply_total'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>供应总金额</th>
				
				<th width="40" orderField="unit_price" <?php if($_REQUEST['_order']== 'unit_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品单价</th>
				
				<th width="40" orderField="personality_price" <?php if($_REQUEST['_order']== 'personality_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>个性地址金额</th>
				
				<th width="40" orderField="other_price" <?php if($_REQUEST['_order']== 'other_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>其他金额</th>
				
				<th width="40" orderField="total_price" <?php if($_REQUEST['_order']== 'total_price'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>总金额</th>
				
				<th width="40" orderField="courier_number" <?php if($_REQUEST['_order']== 'courier_number'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>快递单号</th>
				
				<th width="40" orderField="order_desc_state" <?php if($_REQUEST['_order']== 'order_desc_state'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单状态</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["order_desc_id"]); ?>">
					<td><?php echo ($vo["order_desc_id"]); ?></td>
					<td><?php echo ($vo["order_desc_num"]); ?></td>
					<td><?php echo ($vo["order_id"]); ?></td>
					<td><?php echo ($vo["order_no"]); ?></td>
					<td><?php echo ($vo["supply_num"]); ?></td>
					<td><?php echo ($vo["supply_price"]); ?></td>
					<td><?php echo ($vo["supply_total"]); ?></td>
					<td><?php echo ($vo["unit_price"]); ?></td>
					<td><?php echo ($vo["personality_price"]); ?></td>
					<td><?php echo ($vo["other_price"]); ?></td>
					<td><?php echo ($vo["total_price"]); ?></td>
					<td><?php echo ($vo["courier_number"]); ?></td>
					<?php if($vo["order_desc_state"] == 100): ?><td>待处理</td><?php endif; ?>
					<?php if($vo["order_desc_state"] == 200): ?><td>确认生产</td><?php endif; ?>
					<?php if($vo["order_desc_state"] == 300): ?><td>已发货</td><?php endif; ?>
					<?php if($vo["order_desc_state"] == 400): ?><td>已完成</td><?php endif; ?>
					<?php if($vo["order_desc_state"] == 500): ?><td>已评论</td><?php endif; ?>
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