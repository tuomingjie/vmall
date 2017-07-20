<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>供应商管理后台</title>
<link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico" />
<link href="/vmallshop/Public/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/vmallshop/Public/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/vmallshop/Public/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="/vmallshop/Public/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="/vmallshop/Public/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<script src="/vmallshop/Public/dwz/js/speedup.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/js/jquery-1.7.1.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>

<script src="/vmallshop/Public/dwz/xheditor/xheditor-1.1.12-zh-cn.min.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>


<script src="/vmallshop/Public/dwz/js/dwz.min.js" type="text/javascript"></script>
<script src="/vmallshop/Public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("/vmallshop/Public/dwz/dwz.frag.xml", {
		//loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
		//loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{ pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({ themeBase:"/vmallshop/Public/dwz/themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="#">标志</a>
				<ul class="nav">
					<li><a href="#" target="_blank">欢迎您：<?php echo ($_SESSION['Supplier_info']['Supplier_name']); ?></a></li>
					<li><a href="/vmallshop/index.php/Supplier/Login/update" target="dialog">修改密码</a></li>
					<li><a href="/vmallshop/index.php/Supplier/Login/quit/">退出</a></li>
				</ul>

				<ul class="themeList" id="themeList">
					<li theme="default"><div >蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<li theme="purple"><div class="selected">紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>
				<div class="accordion" fillSpace="sidebar">
					
			
					<div class="accordionHeader">
						<h2><span>Folder</span>商品管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Supplier/Goods/index" target="navTab" rel="listgoods" title="商品列表" >商品列表</a></li>
							
							
							<!-- <li><a href="/vmallshop/index.php/Supplier/HotSale/index" target="navTab" width="550" height="300" rel="listHotSale">热销榜单商品</a></li>
							
							<li><a href="/vmallshop/index.php/Supplier/Comment/index" target="navTab" width="550" height="300" rel="listcomment">商品评论信息</a></li> -->
							
						</ul>
					</div>
					
					
					
					
					<div class="accordionHeader">
						<h2><span>Folder</span>订单管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Supplier/Order/index" target="navTab" rel="listorder" title="订单列表" >订单列表</a></li>
							
						</ul>
					</div>					
	
				</div>
			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<p>供应商管理后台
								<a href="#" target="_blank"></a>
							</p>
							<p>今天是:<?php echo date('Y-m-d',time()); ?></p>
						</div>
						
						<div class="pageFormContent" layoutH="80" style="margin-right:230px">
							
						</div>
						<!--
						<div style="width:230px;position: absolute;top:60px;right:0" layoutH="80">
							<img src="001.jpg" width="200">
							
							<h2>事件消息</h2>
							<ul>
								<li >1.XXXXXXXXXXXXXXXXXXXXXXXxx</li>
								<li >2.XXXXXXXXXXXXXXXXXXXXXXXxx</li>
								<li >3.XXXXXXXXXXXXXXXXXXXXXXXxx</li>
								<li >4.XXXXXXXXXXXXXXXXXXXXXXXxx</li>
								<li >5.XXXXXXXXXXXXXXXXXXXXXXXxx</li>
							</ul>
						</div>
						
						-->
						
					</div>

				</div>
			</div>
		</div>
	</div>
	<div id="footer">Copyright &copy; 2014 <a href="http://www.dede168.com/" target="_blank">华为商城</a><!-- Tel：--></div>
</body>
</html>