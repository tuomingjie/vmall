<?php if (!defined('THINK_PATH')) exit();?>
<form id="pagerForm" action="/vmallshop/index.php/Admin/Stock/redeploy_log" method="post">
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
                        调配单号：<input type="text" name="redeploy_no" value="" />
                        <!--&nbsp;&nbsp;商品名：<input size="10" type="text" name="goods_name" value="<?php echo ($_POST['goods_name']); ?>"/>-->
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
    <!--<div class="panelBar">-->
        <!--<ul class="toolBar">-->
            <!--<li><a class="add" href="/vmallshop/index.php/Admin/Stock/add" target="dialog" width="550" height="380" rel="user_msg" title="添加商品"><span>添加</span></a></li>-->
            <!--<li><a class="delete" href="/vmallshop/index.php/Admin/Stock/del/stock_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->
            <!--<li><a class="edit" href="/vmallshop/index.php/Admin/Stock/redeploy/stock_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>调配</span></a></li>-->

            <!--<li class="line">line</li>-->
            <!--<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>-->
            <!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
        <!--</ul>-->
    <!--</div>-->
    <table class="table" width="100%" layoutH="112">
        <thead>
        <tr>
            <th>调配ID</th>
            <th>调配单号</th>
            <th>出仓仓库</th>
            <th>商品名称</th>
            <th>商品数量</th>
            <th>入仓仓库</th>
            <th>操作时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["redeploy_id"]); ?>">
                <td><?php echo ($vo["redeploy_id"]); ?></td>
                <td> <?php echo ($vo["redeploy_no"]); ?></td>
                <td>
                    <?php if($vo["out_storehouse_id"] == 0): ?>总仓库
                        <?php else: echo ($vo["out_customer_name"]); endif; ?>
                </td>

                <td> <?php echo ($vo["goods_name"]); ?></td>
                <td> <?php echo ($vo["goods_num"]); ?></td>
                <td>
                    <?php if($vo["into_storehouse_id"] == 0): ?>总仓库
                        <?php else: echo ($vo["into_customer_name"]); endif; ?>
                </td>
                <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
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