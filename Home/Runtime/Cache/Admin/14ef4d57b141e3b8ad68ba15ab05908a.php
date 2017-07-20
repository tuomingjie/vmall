<?php if (!defined('THINK_PATH')) exit();?><!--* 网站后台订单查看视图 * author:莫顺渠 -->
<form id="pagerForm" action="/vmallshop/index.php/Admin/Order/index" method="post">
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
					订单号：<input type="text" name="order_no" value="<?php echo ($_POST['order_no']); ?>" />
						
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
			
			<li><a class="delete" href="/vmallshop/index.php/Admin/Order/del/order_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listorder" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Order/edit/order_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="order_id" <?php if($_REQUEST['_order']== 'order_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单ID</th>
				
				<th width="40" orderField="order_no" <?php if($_REQUEST['_order']== 'order_no'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单号</th>
				
				<th width="40" orderField="user_name" <?php if($_REQUEST['_order']== 'user_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>会员名</th>
				
				<th width="40" orderField="order_time" min="6" <?php if($_REQUEST['_order']== 'order_time'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单生成时间</th>
				
				<th width="40" orderField="order_money" <?php if($_REQUEST['_order']== 'order_money'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>订单金额</th>
				
				
				
				<th width="40" orderField="order_total_money" <?php if($_REQUEST['_order']== 'order_total_money'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>总金额(含其他费用)</th>
				
				<th width="40" orderField="order_payment_content" <?php if($_REQUEST['_order']== 'order_payment_content'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>付款方式</th>
				
				<th width="40" orderField="payment_status" <?php if($_REQUEST['_order']== 'payment_status'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>支付状态</th>
				
				<th width="40" orderField="examine_status" <?php if($_REQUEST['_order']== 'examine_status'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>审核状态</th>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["order_id"]); ?>">
					<td><?php echo ($vo["order_id"]); ?></td>
					<td><?php echo ($vo["order_no"]); ?></td>
					<td><?php echo ($vo["user_name"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["order_time"])); ?></td>
					<td><?php echo ($vo["order_money"]); ?></td>
					

					<td><?php echo ($vo["order_total_money"]); ?></td>
					<td><?php echo ($vo["order_payment_content"]); ?></td>

					<td><?php if( $vo["payment_status"] == 1): ?>已支付<?php else: ?>未支付<?php endif; ?></td>
					
					<?php if( $vo["examine_status"] == 0): ?><td>审核中</td><?php endif; ?>
					<?php if( $vo["examine_status"] == 1): ?><td>不通过</td><?php endif; ?>
					<?php if( $vo["examine_status"] == 2): ?><td>已通过</td><?php endif; ?>
					
					
					<style>
						.select_to{padding:2px 6px;background:#ddd;text-align:center;border:1px solid #999;border-radius:2px;}
						.select_to:hover{ text-decoration: none;}
					</style>
					<td>
						<a href="/vmallshop/index.php/Admin/OrderDesc/index/order_id/<?php echo ($vo["order_id"]); ?>" target="navTab" rel="listorder" title="查看" class="select_to" >查看</a>
					
					</td>
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