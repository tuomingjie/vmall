<?php if (!defined('THINK_PATH')) exit();?>
<form id="pagerForm" action="/vmallshop/index.php/Admin/Stock/index" method="post">
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
                        选择仓库：
                        <select name="storehouse_id" >
                            <option value="">全部</option>
                            <option value="0">总仓库</option>
                            <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>

                        <!--&nbsp;&nbsp;商品名：<input size="10" type="text" name="goods_name" value="<?php echo ($_POST['goods_name']); ?>"/>-->
                    </td>
                    <td>
                        商品名称：<input name="goods_name" value="">
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
            <!--<li><a class="add" href="/vmallshop/index.php/Admin/Stock/add" target="dialog" width="550" height="380" rel="user_msg" title="添加商品"><span>添加</span></a></li>-->
            <!--<li><a class="delete" href="/vmallshop/index.php/Admin/Stock/del/stock_desc_id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->
            <!--<li><a class="edit" href="/vmallshop/index.php/Admin/Stock/redeploy"  width="550" height="380" target="dialog"><span>调拨</span></a></li>-->

            <li class="line">line</li>
            <li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
            <!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
        </ul>
    </div>
    <table class="table" width="100%" layoutH="112">
        <thead>
        <tr>
            <th>库存ID</th>
            <th>仓库名称</th>
            <th>商品名称</th>
            <th>总库存</th>
            <th>更新时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["stock_id"]); ?>">
            <td><?php echo ($vo["stock_id"]); ?></td>
            <td>
                <?php if($vo["storehouse_id"] == 0): ?>总仓库
                    <?php else: echo ($vo["customer_name"]); endif; ?>
            </td>

            <td> <?php echo ($vo["goods_name"]); ?></td>
            <td><?php echo ($vo["stock_num"]); ?></td>
            <td><?php echo (date('Y-m-d H:i:s',$vo["updata_time"])); ?></td>
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