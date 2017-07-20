<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/vmallshop/index.php/Admin/Admin/index" method="post">
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
					管理员名：<input type="text" name="admin_name" value="<?php echo ($_POST['admin_name']); ?>" /> 
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
			<li><a class="add" href="/vmallshop/index.php/Admin/Admin/add" target="dialog" width="550" height="380" rel="user_msg" title="添加管理员"><span>添加</span></a></li>
			<li><a class="delete" href="/vmallshop/index.php/Admin/Admin/del/admin_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listadmin" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Admin/edit/admin_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="10" orderField="admin_id" <?php if($_REQUEST['_order']== 'admin_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>管理员编号</th>
				
				<th width="20" >管理员名</th>
				
				
				<th width="20" >注册时间</th>
				
				<th width="20" >最后登录时间</th>
				
				<th width="20" >最后登录ip</th>
				
				<th width="20" orderField="admin_lock
				" <?php if($_REQUEST['_order']== 'admin_lock'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>是否锁定</th>
				
				
				
				
			</tr>
			
			
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["admin_id"]); ?>">
					<td><?php echo ($vo["admin_id"]); ?></td>
					<td><?php echo ($vo["admin_name"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["admin_login_time"])); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["admin_last_time"])); ?></td>
					<td><?php echo (long2ip($vo["admin_last_ip"])); ?></td>
					 <?php if($vo["admin_lock"] == 0): ?><td>可登录</td>
					 
					 <?php else: ?>
					     <td>不可登录</td><?php endif; ?>
					
					
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