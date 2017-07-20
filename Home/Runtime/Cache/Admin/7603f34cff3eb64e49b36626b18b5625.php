<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/vmallshop/index.php/Admin/Region/index" method="post" onsubmit="false validateCallback(this,dialogAjaxDone);">
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
					地区名称：<input type="text" name="region_name" value="<?php echo ($_POST['region_name']); ?>" /> 
						
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
			<li><a class="add" href="/vmallshop/index.php/Admin/Region/add" target="dialog" width="550" height="380" rel="user_msg" title="添加供应商"><span>添加</span></a></li>
			<li><a class="delete" href="/vmallshop/index.php/Admin/Region/del/region_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listadvice" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Region/edit/region_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="region_id" <?php if($_REQUEST['_order']== 'region_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>编号</th>
				<th width="40" orderField="parent_id" <?php if($_REQUEST['_order']== 'parent_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>父级ID</th>
				<th width="40" orderField="region_name" <?php if($_REQUEST['_order']== 'region_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>地区名称</th>
				<th width="40" orderField="region_type" <?php if($_REQUEST['_order']== 'region_type'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>等级</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["region_id"]); ?>">
					<td><?php echo ($vo["region_id"]); ?></td>
					<td><?php echo ($vo["parent_id"]); ?></td>
					<td><?php echo ($vo["region_name"]); ?></td>
					<?php if($vo["region_type"] == 0): ?><td>国家</td><?php endif; ?>
					<?php if($vo["region_type"] == 1): ?><td>省级</td><?php endif; ?>
					<?php if($vo["region_type"] == 2): ?><td>市级</td><?php endif; ?>
					<?php if($vo["region_type"] == 3): ?><td>区域</td><?php endif; ?>
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