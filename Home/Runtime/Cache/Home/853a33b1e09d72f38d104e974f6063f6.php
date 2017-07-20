<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title><?php echo ($header_info["title"]); ?></title>
<meta name="keywords" content="<?php echo ($header_info["key"]); ?>" />
<meta name="description" content="<?php echo ($header_info["desc"]); ?>" />
<link rel="stylesheet" href="/vmallshop/Public/Home/css/common.css">
<script type="text/javascript" src="/vmallshop/Public/Home/js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="/vmallshop/Public/Home/css/user.css">
</head>
<body>
<div class="user-header">
    <div class="left-logo">
        <a href="<?php echo U('Index/index');?>" class="logo"><img src="/vmallshop/Public/Home/images/user_logo.jpg"></a>
        <div class="logo-txt">
            <p>中国邮政信源</p>
            <p>电商产品直采平台</p>
        </div>
    </div>
    <div class="welcome">欢迎登录！</div>
</div>
<div class="user-content clearfix">
    <div class="user-img">
        <img src="/vmallshop/Public/Home/images/user_img.jpg">
    </div>
    <div class="user-login">
        <h3>账号登录 / login</h3>
        <div class="loginFalse" id="errorInfo" >
              提交后测试
        </div>
        <div class="login_user">
            <input type="text" name="user_name" id='user' class="inp-user" placeholder="用户名" oninput="show(this)">
            <span class="btnDel"></span>
        </div>
        <div class="login_password">
            <input type="password" name="user_pwd" id='password' class="inp-user">
            <span class="btneye"></span>
        </div>
        <div class="loginSelf">
            <input type="checkbox" name="remem_pass" id="remenberMe">
            <span>请保存我的这次登录信息</span>
        </div>
        <a href="javascript:;" class="btnLogin">登录</a>
        <div class="Login-tip">
            <a href="<?php echo U('Forget/index');?>" class="fogmi">忘记密码</a>
            <a href="<?php echo U('Sign/index');?>" class="mima">立即注册</a>
        </div>
    </div>
</div>
<div class="user-footer">
    <div class="user-footer-bd">
        <div class="user-foot-nav">
            <a href="">网站首页</a>
            <a href="">新闻中心</a>
            <a href="">投诉与建议</a>
            <a href="">公司案例</a>
            <a href="">公司简介</a>
            <a href="">联系我们</a>
            <a href="">关于我们</a>
            <a href="">帮助中心</a>
        </div>
        <div class="user-foot-info"> 
            <p>友情链接：<?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="_blank"><?php echo ($vo["link_name"]); ?>&nbsp;&nbsp;|</a><?php endforeach; endif; ?></p>
            <p>技术支持：*****</p>
        </div>
    </div>
</div>
<script src="/vmallshop/Public/Home/js/jquery.min.js"></script>
<script type="text/javascript">

$('.btnLogin').click(function() {
    var account = $('#user').val();
    var password = $('#password').val();
    var showBox = $('#errorInfo');
    var remenberMe = $('#remenberMe').val()

    // console.log(remenberMe);return;

    if(!account) {
        showBox.html('账户不能为空');
        showBox.fadeIn()
        return;
    }

    if(!password) {
        showBox.html('密码不能为空');
        showBox.fadeIn()
        return;
    }
	
	
	$.ajax({
		url: "<?php echo U('Login/remoteLogin');?>",
		type: 'post',
		dataType: 'json',
		data: {
			uname:account,
			pwd:password,
			rembername:remenberMe
			
		},
		success: function (data) {
			if(data.status){
				window.location.href = "<?php echo U('Index/index');?>";
			}else{
				showBox.html(data.msg);
				showBox.fadeIn()
				return;
			}
		},
		fail: function (data) {
			showBox.html('登录失败');
			showBox.fadeIn()
			return;
		}
	});
	
	
    

})

$('.btneye').click(function() {
    var type = $(this).prev();
    if(type.attr('type') === 'password') {
        type.attr('type', 'text');
        return;
    } else {
        type.attr('type', 'password');
        return;
    }
})

$('.btnDel').click(function() {
    $(this).css('display', 'none');
    $(this).prev().val('');
})

function show(obj) {
    if($(obj).val()) {
        $(obj).next('span').css('display', 'block')
    } else{
        $(obj).next('span').css('display', 'none')
    }
}
</script>
</body>
</html>