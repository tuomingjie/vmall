<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录界面</title>
    <link href="/vmallshop/Public/Admin/Login/index/Css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" runat="server" action="/vmallshop/index.php/Admin/Login/checkLogin" method="post">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB"><span><img src="/vmallshop/Public/Admin/Login/index/Img/logo.gif" alt="" style="" /></span></li>
            <li class="topC"></li>
            <li class="topD">
                <ul class="login">
                    <li><span class="left login-text">用户名：</span> <span style="left">
                        <input id="Text1" type="text" class="txt" name="admin_name"/>  
                     
                    </span></li>
                    <li><span class="left login-text">密码：</span> <span style="left">
                       <input id="Text2" type="password" class="txt" name="admin_pwd" />  
                    </span></li>
					    <li><span class="left login-text">验证码：</span> <span style="left">
					 
                        <input id="Text1" type="text" class="txt1" name="verify"/><img class='vercode' src="/vmallshop/index.php/Admin/Login/verify" onclick="this.src=this.src+='?'+Math.random()">  
                     
                    </span></li>
					
                </ul>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"><span class="btn"><input name="" type="image" src="/vmallshop/Public/Admin/Login/index/Img/btnlogin.gif" /></span></li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
            <li class="bottom_B">网站后台管理系统--信源电商商城</li>
        </ul>
    </div>
    </form>
</body>
</html>