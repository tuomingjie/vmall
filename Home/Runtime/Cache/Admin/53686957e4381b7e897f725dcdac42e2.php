<?php if (!defined('THINK_PATH')) exit();?><style>
	.grid .gridTbody .goods_small_img div{height:80px;}
	.grid .gridTbody .goods_small_img div img{height:80px;}
</style>

<form id="pagerForm" action="/vmallshop/index.php/Admin/Cart/index" method="post" onsubmit="false validateCallback(this,dialogAjaxDone);">
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
					用户名称：<input type="text" name="user_name" value="<?php echo ($_POST['user_name']); ?>" /> [姓名]
						
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
			<li><a class="delete" href="/vmallshop/index.php/Admin/Cart/del/cart_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listcart" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Cart/edit/cart_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="cart_id" <?php if($_REQUEST['_order']== 'cart_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>编号</th>
				<th width="40" >商品图片</th>
				<th width="40" orderField="goods_name" <?php if($_REQUEST['_order']== 'goods_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>商品名称</th>
				<th width="40" orderField="goods_num" <?php if($_REQUEST['_order']== 'goods_num'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>数量</th>
				<th width="40" orderField="user_name" <?php if($_REQUEST['_order']== 'user_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>用户名</th>
				<th width="40" orderField="add_time" <?php if($_REQUEST['_order']== 'add_time'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>添加时间</th>
			</tr>
		</thead>
		<tbody>
			
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["cart_id"]); ?>">
					<td><?php echo ($vo["cart_id"]); ?></td>
					<td class="goods_small_img"><img src="/vmallshop/Upload<?php echo ($vo["goods_small_pic"]); ?>" ></td>
					<td><?php echo ($vo["goods_name"]); ?></td>
					<td><?php echo ($vo["goods_num"]); ?></td>
					<td><?php echo ($vo["user_name"]); ?></td>
					<td><?php echo (date('Y-m-d',$vo["add_time"])); ?></td>
					
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