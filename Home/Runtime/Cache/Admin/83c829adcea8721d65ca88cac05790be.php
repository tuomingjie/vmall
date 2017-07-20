<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台详情订单视图 * author:莫顺渠 -->
<form id="pagerForm" action="/vmallshop/index.php/Admin/GoodRollback/index" method="post">
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
					<b>搜索</b> &nbsp; 关键字：<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" /> [姓名]
						&nbsp;&nbsp;班级：<input size="10" type="text" name="classid" value="<?php echo ($_POST['classid']); ?>"/>
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/vmallshop/index.php/Admin/GoodRollback/add" target="dialog" width="550" height="380" rel="user_msg" title="添加链接信息"><span>添加</span></a></li>
			<li><a class="delete" href="/vmallshop/index.php/Admin/GoodRollback/del/order_rollback_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listorder_rollback" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/GoodRollback/edit/good_rollback_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="good_rollback_id" <?php if($_REQUEST['_order']== 'good_rollback_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>用户退/换货ID</th>
				
				<th width="40" orderField="good_rollback_why" <?php if($_REQUEST['_order']== 'good_rollback_why'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>退换原因</th>
				
				<th width="40" orderField="order_id" <?php if($_REQUEST['_order']== 'order_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>退换订单ID号</th>
				
				<th width="40" orderField="goods_id" <?php if($_REQUEST['_order']== 'goods_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品号</th>
				
				<th width="40" orderField="good_rollback_state" <?php if($_REQUEST['_order']== 'good_rollback_state'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>退换状态</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["good_rollback_id"]); ?>">
					<td><?php echo ($vo["good_rollback_id"]); ?></td>
					<td><?php echo ($vo["good_rollback_why"]); ?></td>
					<td><?php echo ($vo["order_id"]); ?></td>
					<td><?php echo ($vo["goods_id"]); ?></td>
					<td><?php echo ($vo["good_rollback_state"]); ?></td>
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