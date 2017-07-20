<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/vmallshop/index.php/Admin/Address/index" method="post">
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
					<b>搜索</b> &nbsp; 关键字：<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" /> [快递]
						&nbsp;&nbsp;运费：<input size="10" type="text" name="classid" value="<?php echo ($_POST['classid']); ?>"/>
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
			<li><a class="delete" href="/vmallshop/index.php/Admin/Address/del/address_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listaddress" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Address/edit/address_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="address_id" <?php if($_REQUEST['_order']== 'address_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>地址ID号</th>
				
				<th width="100" orderField="user_name" <?php if($_REQUEST['_order']== 'user_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>会员</th>
				
				<th width="70" orderField="address_name" <?php if($_REQUEST['_order']== 'address_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>收货人</th>
				
				<th width="100" orderField="address_phone" <?php if($_REQUEST['_order']== 'address_phone'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>手机号</th>
				
				<th width="240" orderField="address_content" <?php if($_REQUEST['_order']== 'address_content'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>用户地址</th>
				
				<th width="100" orderField="address_post" <?php if($_REQUEST['_order']== 'address_post'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>用户邮编</th>
				
				<th width="240" orderField="address_lock" <?php if($_REQUEST['_order']== 'address_lock'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>用户是否默认地址</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["address_id"]); ?>">
					<td><?php echo ($vo["address_id"]); ?></td>
					<td><?php echo ($vo["user_name"]); ?></td>
					<td><?php echo ($vo["address_name"]); ?></td>
					<td><?php echo ($vo["address_phone"]); ?></td>
					<td><?php echo ($vo["address_content"]); ?></td>
					<td><?php echo ($vo["address_post"]); ?></td>
					 <?php if($vo["address_lock"] == 0): ?><td>是</td>
					 
					 <?php else: ?>
					     <td>否</td><?php endif; ?>
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