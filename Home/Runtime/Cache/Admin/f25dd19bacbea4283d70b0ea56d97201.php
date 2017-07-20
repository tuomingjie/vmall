<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/vmallshop/index.php/Admin/Customer/index" method="post" onsubmit="false validateCallback(this,dialogAjaxDone);">
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
					省份
					<select name="region_id" id="region_id" onchange="addcity()">
						<option value="">请选择省份</option>
						<?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>"><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
				<td>
					市区
					<select name="region_id2" id="city">
						<option value=""> 请选择市</option>
					</select>
				</td>
				<td>
					客户名称：<input type="text" name="customer_name" value="<?php echo ($_POST['customer_name']); ?>" />
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
			<li><a class="add" href="/vmallshop/index.php/Admin/Customer/add" target="dialog" width="550" height="380" rel="user_msg" title="添加供应商"><span>添加</span></a></li>
			<li><a class="delete" href="/vmallshop/index.php/Admin/Customer/del/customer_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/listcustomer" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/vmallshop/index.php/Admin/Customer/edit/customer_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="customer_id" <?php if($_REQUEST['_order']== 'customer_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>编号</th>
				<th width="40" orderField="customer_name" <?php if($_REQUEST['_order']== 'customer_name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>名称</th>
				<th width="40" orderField="region_type" <?php if($_REQUEST['_order']== 'region_type'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>等级</th>
				<th width="40" orderField="region_id" <?php if($_REQUEST['_order']== 'region_id'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>地区</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["customer_id"]); ?>">
					<td><?php echo ($vo["customer_id"]); ?></td>
					<td><?php echo ($vo["customer_name"]); ?></td>
					<td>
						<?php switch($vo["region_type"]): case "1": ?>省级<?php break;?>
							<?php case "2": ?>市级<?php break;?>
							<?php case "3": ?>区级<?php break;?>
							<?php default: ?>总部<?php endswitch;?>
					</td>
					<td><?php echo ($vo["parent_name"]); ?>&nbsp;&nbsp;<?php echo ($vo["region_name"]); ?></td>
					
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
<script>
	function addcity() {
	    var region_id = $('#region_id').val();
        $('#city').html('<option value="">请选择市</option>');
        $.ajax({
            url: "/vmallshop/index.php/Admin/Customer/city",
            type: 'post',
            dataType: 'json',
            data: {
                pid:region_id
            },
            success: function (data) {
                var str = '';
                if(data.list.length >0){
                    for (var i=0;i<data.list.length;i++){
                        var list = data.list[i];
                        str +='<option value="'+list.region_id+'"> '+list.region_name+'</option>';
                    }
                    $('#city').append(str);
				}else {
                    var str = '<option value="">没有数据</option>';
                    $('#city').append(str);
				}

            }
        });
    }
</script>