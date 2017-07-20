<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>信源电商商城后台管理系统</title>
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
					<li><a href="#" target="_blank">欢迎您：<?php echo ($_SESSION['admin_info']['admin_name']); ?></a></li>
					<li><a href="/vmallshop/index.php/Admin/Login/update" target="dialog">修改密码</a></li>
					<li><a href="/vmallshop/index.php/Admin/Login/quit/">退出</a></li>
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
						<h2><span>Folder</span>会员管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/user/index" target="navTab" rel="listuser" title="用户信息" >用户信息表</a></li>
							<!-- <li><a href="/vmallshop/index.php/Admin/Secure/index" target="navTab" rel="listSecure" title="问题信息" >查看密保问题</a></li>
							<li><a href="/vmallshop/index.php/Admin/Account/index" target="navTab" rel="listAccount"  width="550" height="300">账户信息</a></li>
							<li><a href="/vmallshop/index.php/Admin/UserPayment/index" target="navTab" rel="listUserPayment"  width="550" height="300">用户消费情况</a></li> -->
						</ul>
					</div>	
					<div class="accordionHeader">
						<h2><span>Folder</span>商品管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Goods/index" target="navTab" rel="listgoods" title="商品列表" >商品列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Goods/add" target="navTab"  width="550" height="300">添加新商品</a></li>
							<li><a href="/vmallshop/index.php/Admin/GoodsPic/index" target="navTab" width="550" height="300">商品相册</a></li>
							
							<li><a href="/vmallshop/index.php/Admin/Category/index" rel="listcategory" target="navTab" width="550" height="300">商品分类</a></li>
							<li><a href="/vmallshop/index.php/Admin/Attr/index" target="navTab" width="550" height="300" rel="listattr">商品属性列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Avalue/index" target="navTab" width="550" height="300" rel="listAvalue">商品属性值列表</a></li>
							
							<!-- <li><a href="/vmallshop/index.php/Admin/HotSale/index" target="navTab" width="550" height="300" rel="listHotSale">热销榜单商品</a></li>
							
							<li><a href="/vmallshop/index.php/Admin/Comment/index" target="navTab" width="550" height="300" rel="listcomment">商品评论信息</a></li> -->
							
						</ul>
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>购物车管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Cart/index" target="navTab" rel="listcart" title="购物车列表" >购物车列表</a></li>
						</ul>
						
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>库存管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Stock/index" target="navTab" rel="liststock" title="库存列表" >库存列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Stock/log" target="navTab" rel="listlog" title="入库记录" >入库记录</a></li>
							<li><a href="/vmallshop/index.php/Admin/Stock/redeploy_log" target="navTab" rel="redeploy_log" title="调拨记录" >调拨记录</a></li>
							<li><a href="/vmallshop/index.php/Admin/Stock/redeploy" target="navTab" rel="redeploy" title="商品调拨" >商品调拨</a></li>
							<li><a href="/vmallshop/index.php/Admin/Stock/add" target="navTab"  width="550" height="300">商品入库</a></li>
						</ul>
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>供应商管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Supplier/index" target="navTab" rel="listsupplier" title="供应商列表" >供应商列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Supplier/add" target="navTab"  title="供应商添加" >供应商添加</a></li>
						</ul>
						
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>客户管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Customer/index" target="navTab" rel="listcustomer" title="客户列表" >客户列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Customer/add" target="navTab"  title="客户添加" >客户添加</a></li>
						</ul>
						
					</div>
					
					
					<div class="accordionHeader">
						<h2><span>Folder</span>地区管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Region/index" target="navTab" rel="listregion" title="地区列表" >地区列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Region/add" target="navTab"  title="地区添加" >地区添加</a></li>
						</ul>
						
					</div>

					<div class="accordionHeader">
						<h2><span>Folder</span>订单管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Order/index" target="navTab" rel="listorder" title="订单列表" >订单列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/OrderDesc/index" target="navTab" rel="listorder_desc" title="订单详情" >订单详情</a></li>
							<li><a href="/vmallshop/index.php/Admin/Address/index" target="navTab"  rel="listaddress" title="收货地址">收货地址</a></li>
							<li><a href="/vmallshop/index.php/Admin/OrderPayment/index" target="navTab" rel="listorder_payment" title="支付方式">支付方式</a></li>
							<li><a href="/vmallshop/index.php/Admin/Express/index" target="navTab" rel="listexpress" title="配送方式">配送方式</a></li>
							<!-- <li><a href="/vmallshop/index.php/Admin/GoodRollback/index" target="navTab" rel="listgood_rollback" title="退换货列表">退换货列表</a></li> -->
						</ul>
					</div>					
					<!-- <div class="accordionHeader">

						<h2><span>Folder</span>友链管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Link/index" target="navTab" rel="listlink" title="友链信息" >浏览友情链接</a></li>
							<li><a href="/vmallshop/index.php/Admin/Link/add" target="dialog" width="550" height="300">添加友情链接</a></li>
						</ul>
					</div> -->

					<div class="accordionHeader">
						<h2><span>Folder</span>广告管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Ad/index" target="navTab" rel="listad" title="广告信息" >浏览广告信息</a></li>
							<li><a href="/vmallshop/index.php/Admin/Ad/add" target="navTab" width="550" height="300">添加广告信息</a></li>
						</ul>
					</div>
					<!--
					<div class="accordionHeader">
						<h2><span>Folder</span>用户意见管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/AdviceCategory/index" target="navTab" rel="listAdviceCategory" title="意见信息" >浏览用户意见</a></li>
							<li><a href="/vmallshop/index.php/Admin/AdviceQuestion/index" target="navTab" rel="listadvice" title="意见信息" >用户意见信息</a></li>
						</ul>
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>用户帮助中心</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/HelpCategory/index" target="navTab" rel="listhelp_category" title="帮助列表" >帮助类别</a></li>
							<li><a href="/vmallshop/index.php/Admin/HelpQuestion/index" target="navTab" rel="listhelp_question" title="帮助类别" >帮助列表</a></li>	
						</ul>
					</div> -->
					<div class="accordionHeader">
						<h2><span>Folder</span>首页管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/IndexSale/index" target="navTab" rel="listIndexSale" title="首页信息" >浏览首页管理</a></li>
							<li><a href="/vmallshop/index.php/Admin/IndexSale/add" target="navTab" width="550" height="300">添加首页信息</a></li>
						</ul>
					</div>
					
					
					<div class="accordionHeader">
						<h2><span>Folder</span>品牌管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Brand/index" target="navTab" rel="listbrand" title="品牌列表" >品牌列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Brand/add" target="dialog" width="550" height="300">添加品牌</a></li>
						</ul>
					</div>
					
					
					<div class="accordionHeader">
						<h2><span>Folder</span>资讯管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Info/index" target="navTab" rel="listinfo" title="资讯列表" >资讯列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Info/add" target="navTab"  title="资讯添加" >资讯添加</a></li>
						</ul>
						
					</div>
					
                     
					  <div class="accordionHeader">
						<h2><span>Folder</span>后台权限管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/vmallshop/index.php/Admin/Admin/index" target="navTab" rel="listadmin" title="管理员列表" >管理员列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Role/index" target="navTab"  rel="listrole" width="550" height="300">角色列表</a></li>
							<li><a href="/vmallshop/index.php/Admin/Action/index" target="navTab"  rel="listaction" width="550" height="300">操作列表</a></li>
						</ul>
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>系统设置</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							
							<li><a href="/vmallshop/index.php/Admin/Set/index" target="navTab" rel="listset" title="设置管理" >设置管理</a></li>
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
							<p>信源电商商城后台管理系统
								<a href="#" target="_blank"></a>
							</p>
							<p>今天是:<?php echo date('Y-m-d',time()); ?></p>
						</div>
						
						<div class="pageFormContent" layoutH="80" style="margin-right:230px">
							<table border="1" cellspacing='0'  style="width:60%;height:auto;border-collapse:collapse;height:60%;color:#183152;margin-left:200px;border-color:#EBF1F3;">


                             <caption><h3>欢迎管理员,以下是个人信息:</h3></caption>
							    <tr >
								 <td style="border-color:#EBF1F3; width:100px;">上次登录ip:</td>
								 <td style="border-color:#EBF1F3;"><?php echo ($admin_info["admin_last_ip"]); ?></td>
								</tr>
                                 <tr style="border-color:#EBF1F3;">
								 <td style="border-color:#EBF1F3;">上次登录时间:</td>
								 <td style="border-color:#EBF1F3;"><?php echo (date('Y-m-d H:i:s',$admin_info["admin_last_time"])); ?></td>
								</tr>
								<tr >
								 <td style="border-color:#EBF1F3;">权限角色:</td>
								 <td style="border-color:#EBF1F3;"><?php echo ($roles); ?></td>
								</tr>
								<tr>
								 <td style="border-color:#EBF1F3;">拥有管理操作:</td>
								 <td style="border-color:#EBF1F3;">
									<style>
										.j_action{width:100%;
											height:220px;
											overflow:auto;
										}
										.j_action li{
											width:100px;height:15px;line-height:15px;text-align:center;border:1px solid #ddd;
											float:left;
										}
									</style>
									<ul class="j_action">
										<?php if(is_array($j_ction_arr)): $i = 0; $__LIST__ = $j_ction_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								 </td>
								</tr>
                             </table>							
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
	<div id="footer">Copyright &copy; 2014 <a href="http://www.dede168.com/" target="_blank">信源电商商城</a><!-- Tel：--></div>
</body>
<!--文本编辑器start-->
<script type="text/javascript" charset="utf-8" src="/vmallshop/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/vmallshop/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/vmallshop/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<!---文本编辑器 END-->

</html>