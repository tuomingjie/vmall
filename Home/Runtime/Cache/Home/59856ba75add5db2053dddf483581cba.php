<?php if (!defined('THINK_PATH')) exit();?><style>

    .content{
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding: 0 10px;
    }
    .desc{
        margin-right: 10px;
        width: 260px;
        font-size: 14px;
    }
    .desc-input{
        width: 100px;
    }
    .item{
        padding: 10px;
        border-bottom: 1px solid #d2d2d2;
    }
    .item span{
        margin-left: 30px;
        font-size: 14px;
    }
    input,select{
        margin-left: 30px;
        font-size: 14px;
    }
    .action{
        text-align: center;
        margin: 10px 0;
    }
</style>

<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>个人中心</title>
    <link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico">
    <link href="/vmallshop/Public/Css/person/ec.css" rel="stylesheet" type="text/css">
    <link href="/vmallshop/Public/Css/person/main.css" rel="stylesheet" type="text/css">
    <link href="/vmallshop/Public/Home/Css/common.css" rel="stylesheet" type="text/css">


</head>
<body>

<!---1---------------------------头部粉红色条--------------------------------------->
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<div  class="qq-caibei-bar hide"  id="caibeiMsg">
	<div  class="layout">
		<div  class="qq-caibei-bar-tips"  id="HeadShow"></div>
		<div  class="qq-caibei-bar-userInfo"  id="ShowMsg"></div>
	</div>
</div>

<!----------------头部的粉红色条--------------------->
<div  class="shortcut">
	<div  class="layout">
	  <!-----登录注册要去修改地方------>
	<span id="unlogin_status">
	  
	   <a  href="<?php echo U('Login/index');?>"  rel="nofollow">[登录]</a><a  href="<?php echo U('Sign/index');?>"  rel="nofollow">[注册]</a>
	  
	</span>
	 <!-----登录注册要去修改地方------>
	 <!---------登录后的状态----------->
	<span  id="login_status"  class="hide">欢迎您，<a  href="<?php echo U('Member/index');?>"  id="customer_name"  rel="nofollow"  timetype="timestamp"></a>
	<!---------登录后的状态----------->
	
	[<a  href="<?php echo U('Login/quit');?>">退出</a>]</span>
    <b>|</b><a  href="<?php echo U('OrderCenter/index');?>"  rel="nofollow"  timetype="timestamp">我的订单</a><span  id="preferential"></span><b>|</b><a  href="<?php echo U('Help/vmall');?>"  rel="nofollow"  class="red">帮助中心</a><!--<b>|</b><a  href="javascript:return  false;"  >华为商城手机版</a>-->

	</div>
</div>

<script type="text/javascript">
  // 顶部粉红条 ajax进行处理结果
  $(function(){
      $.ajax({
	      url:'<?php echo U("Login/checkLogin");?>',
		  type:'GET',
		  dataType:'json',
		  success:function(responseText,status,xhr){
		      if(status=="success"){
			     if(responseText.login_status==1){
				     $("#login_status").removeClass('hide');
					 $("#login_status #customer_name").html(responseText.user_name);
					 $("#unlogin_status").addClass('hide');
				 }else{
				     $("#login_status").addClass('hide');
				     $("#unlogin_status").removeClass('hide');
				 
				 }
				
			  }else{
			       $("#login_status").addClass('hide');
				   $("#unlogin_status").removeClass('hide');
			  
			  }
		  
		  },
		  
		  error:function(){
		      $("#login_status").addClass('hide');
		      $("#unlogin_status").removeClass('hide');
		  },
		  
		  timeout:60*1000,
	  
	  
	  
	  
	  
	  
	  
	  
	  });
  
  
  
  
  
  
  });
  

</script>

<!------------------搜索导航---作者:曹建伟------------------------------->
<script  src="/vmallshop/Public/Js/base.js"></script>

<div  class="top-banner"  id="top-banner-block"></div>
<!----1----------------------------------------------------------------------------->
<!--------2-搜索条部分---------------------------------------------------------------->
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<header  class="header">
	<div  class="layout">
		
		<div  class="logo" style="padding-top:8px;"><a  href="<?php echo U('Index/index');?>"  title="Vmall.com - 华为商城"><img  src="/vmallshop/Public/Images/newLogo.png"  alt="Vmall.com - 华为商城"></a></div>

		<script type="text/javascript">
		   $(function(){
		  
		      var url="<?php echo U('Search/index');?>";
			 
			  $("#submit_go").click(function(){
			     
			      var search_kw=$("#search_kw").val();
				     
				  if(search_kw.length==0){
				       alert('搜索关键字不能为空');
				  
				  }else{
				     window.location.href=url+'?keywords='+search_kw;
				  
				  }
			  
			  
			  
			  
			  });
			  
		   
		   
		   
		   
		   
		   
		   
		   
		   });
		
		
		
		</script>
		
		
		
		<div  class="header-toolbar">
			
			<div  class="header-toolbar-item"  id="header-toolbar-imall">
				
				<div  class="i-mall">
				     <!------------自己的商城---------------->
					<div  class="h"><a  href="<?php echo U('Member/index');?>"  rel="nofollow"  timetype="timestamp">我的商城</a>
					
					<i></i><s></s><u></u></div>
					  <!---------登录注册--------------------->
					<div  class="b"  id="header-toolbar-imall-content">
						<div  class="i-mall-prompt"  id="cart_unlogin_info" style="display:block;">
							<p>你好，请&nbsp;&nbsp;<a  href="<?php echo U('Login/index');?>"  rel="nofollow">登录</a> / <a  href="<?php echo U('Sign/index');?>"  rel="nofollow">注册</a></p>
							
						  
						</div>
						<div class="i-mall-prompt" id="cart_login_info" style="display:none">
							<p><a href="<?php echo U('Member/index');?>" id="cart_memeber"></a><em class="vip-state" id="vip-info">&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Member/index');?>" title="VMALL V0会员" id="vip-Active"><i class="icon-vip-level-0"></i></a></em></p>
						</div>
						 <!---------登录注册--------------------->
						<div  class="i-mall-uc "  id="cart_nlogin_info">
							<ul>
							     <!-----------代付款和-------------->
								<li><a  href="<?php echo U('OrderCenter/index');?>"  timetype="timestamp">待付款</a><span  id="toolbar-orderWaitingHandleCount">0</span></li>
								<li><a  href="<?php echo U('OrderCenter/index');?>"  timetype="timestamp">待评论</a><span  id="toolbar-notRemarkCount">0</span></li>
								<!------------代付款------------>
							</ul>
						</div>
						
						
						<div  class="i-mall-uc ">
							<p><br></p>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
    $(function(){
	     
	    $.ajax({
		     url:"<?php echo U('SmallCat/myShop');?>",
			 type:'POST',
			 dataType:'json',
			 success:function(responseText,status,xhr){
			    
			      if(status=='success'){
				      
				     if(responseText.login_status==1){
					   
					     $("#cart_login_info").show();
					     $("#cart_unlogin_info").hide();
					     var user_name=responseText.user_name;
						 $("#cart_login_info #cart_memeber").html(responseText.user_name);
						  //计算用户的级别
						 var ico_user_level="icon-vip-level-0";
						 switch(responseText.user_level){
						     case 5: ico_user_level="icon-vip-level-5";break;
						     case 4: ico_user_level="icon-vip-level-4";break;
						     case 3: ico_user_level="icon-vip-level-3";break;
						     case 2: ico_user_level="icon-vip-level-2";break;
						     case 1: ico_user_level="icon-vip-level-1";break;
						     case 0: ico_user_level="icon-vip-level-0";break;
							 default:ico_user_level="icon-vip-level-0";
						 }
						 $("#cart_login_info #vip-Active").find('i').addClass('ico_user_level');
						 $("#toolbar-orderWaitingHandleCount").html(responseText.unpay_count);
						  $("#toolbar-notRemarkCount").html(responseText.uncomment_count);
						 
					 }else{
					     $("#cart_unlogin_info").show();
					     $("#cart_login_info").hide();
					 }
				  }else{
				      $("#cart_unlogin_info").show();
					  $("#cart_login_info").hide();
				  
				  }
			 
			 },
			 
			 error:function(){
			       $("#cart_unlogin_info").show();
				   $("#cart_login_info").hide();
			 },
			 
			 timeout:60*1000,
		
		
		
		
		
		
		});
	
	
	
	
	
	
	
	}); 




</script>
			
			
			       <!--------------购物车的商品--------------------->
			<div  class="header-toolbar-item"  id="header-toolbar-minicart">
				
				<div class="minicart">
					<div class="h" id="header-toolbar-minicart-h"><a href="<?php echo U('Cart/index');?>" rel="nofollow" timetype="timestamp">我的购物车<span><em id="header-cart-total">0</em><b></b></span></a><i></i><s></s><u></u></div>
					    <div style="display:block;" class="b" id="header-toolbar-minicart-content">
						<div style="display:block;" class="minicart-pro-empty" id="minicart-pro-empty">
							<span class="icon-minicart">您的购物车是空的，赶紧选购吧！</span>
						</div>
						
						<div style="display:none;" id="minicart-pro-list-block">
						<ul class="minicart-pro-list" id="minicart-pro-list"><!--microCartList start-->
						<!--microCartList end-->
						</ul>
						</div>
						<div style="display:none;" class="minicart-pro-settleup" id="minicart-pro-settleup">
							<p>共<em id="micro-cart-total">1</em>件商品</p>
							<p>共计<b id="micro-cart-totalPrice">¥&nbsp;<span>2888.00<span></b></p>
							<a class="button-minicart-settleup" href="<?php echo U('Cart/index');?>">去结算</a>
						</div>
						
					</div>
				</div>
			</div>
<script type="text/javascript">
 //购物进行ajax处理
 $(function(){
         //鼠标移入移除事件
	  $("#header-toolbar-minicart-content").hide();
	 $("#header-toolbar-minicart-h").hover(function(){
	      $("#header-toolbar-minicart-content").show();
	 
	 },function(){
	      $("#header-toolbar-minicart-content").hide();
	 });
	 
	  $("#header-toolbar-minicart-content").hover(function(){
	         $(this).show();
	  
	  },function(){
	        $(this).hide();
	  });

     
	  //ajax查询数量和商品
	  
	  do_cat();
	  
function do_cat(){
	 $.ajax({
	     
		 url:"<?php echo U('SmallCat/myGoods');?>",
		 type:'GET',
		 dataType:'json',
		 success:function(responseText,status,xhr){
		     if(status=="success"){
			     if(responseText.cat_status==1){
				     $("#header-cart-total").html(responseText.content.total_nums);
					 $("#minicart-pro-empty").hide();
					 $("#minicart-pro-list-block").show();
					 $("#minicart-pro-list-block #minicart-pro-list").html(responseText.info);
					 $("#minicart-pro-settleup").show();
					 $("#minicart-pro-settleup #micro-cart-total").html(responseText.content.total_nums);
					 $("#minicart-pro-settleup #micro-cart-totalPrice").find('span').html(responseText.content.total_price.toFixed(2));
					 
				 }else{
				  $("#header-cart-total").html('0');
			      $("#minicart-pro-list-block").hide();
			      $("#minicart-pro-settleup").hide();
			      $("#minicart-pro-empty").show();
				 
				 }
			 
			 }else{
			  $("#header-cart-total").html('0');
			  $("#minicart-pro-list-block").hide();
			  $("#minicart-pro-settleup").hide();
			  $("#minicart-pro-empty").show();
			 
			 }
		   
		 },
		 error:function(){
		     $("#header-cart-total").html('0');
			 $("#minicart-pro-list-block").hide();
			 $("#minicart-pro-settleup").hide();
			 $("#minicart-pro-empty").show();
		 },
		 timeout:60*1000,
	 
	 
	 
	 
	 
	 
	 
	 });
 
} 

 //事件委托的形式添加事件

$("#minicart-pro-list").on('click',".icon-minicart-del",function(){
      var goods_id=$(this).next('input').val();
	  var parent_li=$(this).closest('li');
	    //ajax的形式删除元素
	  $.ajax({
	     url:"<?php echo U('SmallCat/delGoods');?>",
		 type:'POST',
		 data:{
		    'goods_id':goods_id,
		 },
		 dataType:'json',
		 success:function(responseText,status,xhr){
		     if(status=='success'){
			      //返回1 说明session 中删除成功!
			     if(responseText.del_status==1){
				    
					    //删除此条信息
					   
					  parent_li.remove();
					   //修改金额和总数量
					  $("#header-cart-total").html(responseText.total_num);
					  $("#minicart-pro-settleup #micro-cart-total").html(responseText.total_num);
					   $("#minicart-pro-settleup #micro-cart-totalPrice").find('span').html(responseText.total_money.toFixed(2));
	                 var lis=$("#minicart-pro-list li").size();
					 
					 if(lis<=0){
					   $("#header-cart-total").html('0');
			           $("#minicart-pro-list-block").hide();
			           $("#minicart-pro-settleup").hide();
			           $("#minicart-pro-empty").show();
					 
					 }else{
					 
					 
					 }
					
				 
				 }
			 }
		 
		 }
		 
	  
	  
	  
	  });
	  
});
 
 
 
 
 
 });
 




</script>			
			 <!--------------购物车的商品--------------------->
			
		</div>
	</div>			
</header>
<!--------2-搜索条部分---------------------------------------------------------------->

<!----------------------3-----导航条部分----------------------------------------------->

<textarea  id="micro-cart-tpl"  class="hide">
</textarea>




﻿<!-----------------折叠-导航条---------------------------->
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
<div  class="naver-main">
	<div  class="layout">
		
		<div  class="category"  id="category-block">
			
			<div  class="h"  id="category-h">
				<h2>全部商品</h2>
				<i  class="icon-category"  id="category-icon"></i>
			</div>
			<div  class="b"  id="category-list">
				<ul>
					  <li>
							<h3><a  href="http://www.vmall.com/list-1"><span>手机
														</span></a></h3>
								<a  href="http://www.vmall.com/list-1#2"><span>手机
																</span></a>
								<a  href="http://www.vmall.com/list-1#5"><span>配件
																</span></a>
						</li>
						<li  class="odd">
							<h3><a  href="http://www.vmall.com/list-27"><span>运营商
														</span></a></h3>
								<a  href="http://www.vmall.com/list-27#29"><span>购机送费
																</span></a>
								<a  href="http://www.vmall.com/list-27#28"><span>选号入网
																</span></a>
								<a  href="http://www.vmall.com/list-27#33"><span>上网卡
																</span></a>
						</li>
						<li>
							<h3><a  href="http://www.vmall.com/list-9"><span>平板电脑
														</span></a></h3>
								<a  href="http://www.vmall.com/list-9#10"><span>平板电脑
																</span></a>
								<a  href="http://www.vmall.com/list-9#11"><span>配件
																</span></a>
						</li>
						<li  class="odd">
							<h3><a  href="http://www.vmall.com/list-6"><span>宽带网络
														</span></a></h3>
								<a  href="http://www.vmall.com/list-6#7"><span>移动网络
																</span></a>
								<a  href="http://www.vmall.com/list-6#8"><span>家庭网络
																</span></a>
						</li>
						<li>
							<h3><a  href="http://www.vmall.com/list-12"><span>增值服务
														</span></a></h3>
								<a  href="http://www.vmall.com/list-12#30"><span>华为秘盒
																</span></a>
								<a  href="http://www.vmall.com/list-12#35"><span>服务
																</span></a>
								<a  href="http://www.vmall.com/list-12#14"><span>配件
																</span></a>
						</li>
					<li  class="odd">
						<h3><a  href="http://app.vmall.com/"  target="_blank"><span>应用市场</span></a></h3>
						<a  href="http://app.vmall.com/game/list"  target="_blank"><span>手机游戏</span></a>
						<a  href="http://app.vmall.com/"  target="_blank"><span>手机应用</span></a>
					</li>
				</ul>
			</div>

		</div>
<script type="text/javascript">
   $(function(){
       $.ajax({
	      'url':"<?php echo U('Category/index');?>",
		  'type':'GET',
		  'success':function(responseText,status,xhr){
		     if(status=='success'){
			     $("#category-list").find('ul').html(responseText);
				 $("#category-list ul li:odd").addClass('odd');
			 }else{
			     window.location.reload();
			 }
		  
		  }
	   
	   
	   
	   
	   });
   
   
   
   
   
   });
</script>	
		 <!-------------导航条---------------->
		<nav  class="naver">
				<ul  id="naver-list">
			<li  id="index"><a  href="<?php echo U('Index/index');?>"  class="current"><span>首 页
					</span></a>
					</li>
		<li  id="nav-sale"><a  href="<?php echo U('Product/index',array('g'=>2));?>"  target="_blank"><span>品牌专区

		</span></a> </li>
					
		<li  id="club"><a   href="<?php echo U('Product/index',array('g'=>1));?>"  ><span>公司介绍
					</span></a> </li>

</ul>
		</nav><!-- 20130909-导航-end -->
	</div>
</div>
<!-------------导航条---------------->
<script>
    
	$(function () {
		$('#naver-list li').hover(function () {
			$(this).addClass('hover');
		},function () {
			$(this).removeClass('hover');
		});
	});
	
	
</script>
			
		</nav>
	</div>
</div>
<script>
(function () {
	//所有分类显示隐藏控制
	var isIndex =  false,
		categoryBlock = gid('category-block');
		
	if(isIndex) return;

	categoryBlock.onmouseover = function () {
		categoryBlock.className = 'category category-hove';
	};
	categoryBlock.onmouseout = function () {
		categoryBlock.className = 'category';
	};
	
}());
$(function () {
	//分类间隔背景色
	$('#category-list li:odd').addClass('odd');
	$('#category-list li a').click(function () {
		setTimeout(function () {
			var id = location.hash.split("#", 2)[1];
			if(id)return ec.product.showCategory(gid('pro-cate-'+ id) , id);
		}, 200);
		
	});
});
</script>
<script>
(function(){
	var n = $("#nav-1");
	n.children("a").addClass("current");
	n.siblings().children("a").removeClass("current");
})();
</script>
<script src="/vmallshop/Public/Js/base.js"></script>
<script src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>



<div class="hr-10"></div>

<div class="g">
    <!--面包屑 -->
    <div class="breadcrumb-area icon-breadcrumb fcn">您现在的位置：
        <a href="<?php echo U('Index/index');?>" title="首页">首页</a>&nbsp;&gt;&nbsp;
        <span id="personCenter"><a href="<?php echo U('Member/index');?>" title="个人中心">个人中心</a></span>
        <span id="pathPoint">&nbsp;&gt;&nbsp;</span>
        <b id="pathTitle">商品调拨</b>
    </div>
</div>
<div class="hr-15"></div>

<div class="g">
    <div class="fr u-4-5"><!--栏目 -->
        <div class="part-area clearfix">
            <div class="fl">
                <h1 style="font-size: 18px;">商品调拨</h1>
            </div>
        </div>
        <div class="hr-3"></div>
        <!--搜索条件-->
        <!--库存 -->
        <div class="myOrders-area">
            <div class="myOrders-title-area">

                <div class="content">
                    <div class="item">
                        <label class="desc">出库仓库：</label>
                        <select name="out" id="out" onchange="out_stock()">
                            <?php if(is_array($customerlist)): $i = 0; $__LIST__ = $customerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <diV class="item">
                        <label class="desc">进入仓库：</label>
                        <select name="into" id="into">
                            <?php if(is_array($customerlist)): $i = 0; $__LIST__ = $customerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["customer_id"]); ?>"><?php echo ($vo["customer_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </diV>
                    <div id="demo">
                        <div>
                            <div class="item">
                                <label class="desc">商品名称：</label>
                                <select class="select goods_id" name="goods_id" style="width: 60%;" onchange="jiankong(this)">
                                    <?php if(is_array($goodslist)): $i = 0; $__LIST__ = $goodslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><option value="<?php echo ($goods["goods_id"]); ?>"><?php echo ($goods["goods_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="item">
                                <label class="desc">库存数量：</label>
                                <input name="stock_num" value="<?php echo ($data['stock_num']); ?>" class="stock_num1" type="hidden">
                                <span class="stock_num2" style="color: red"><?php echo ($data['stock_num']); ?></span>
                                <label class="desc" style="margin-left: 10px;">调配数量：</label>
                                <input name="goods_num" class="desc-input" style="margin-left: 10px;" value="1">
                                <span style="color: #c2c2c2;text-align: center;margin-left: 10px; ">*调配数量不能大于库存</span>
                            </div>
                        </div>

                    </div>
                    <div class="item">
                        <a href="#" style="color: #0a79d5" id="addredeploy">继续添加商品</a>
                    </div>
                    <div class="action">
                        <button class="button-action-save vam" style="color: #000000;font-size: 18px;" id="redeploy"></button>
                    </div>
                </div>
                <!--分页--------- -->
                <div class="hr-3"></div>
                <div class="pager" id="list-pager">
                </div>
            </div>
            <div class="hr-2"></div>
        </div>


    </div>
    <!--左边菜单 -->
    <!--个人中心左边菜单栏-->

<div class="fl u-1-5">
<div class="mc-menu-area">
    <div class="h"><a href="<?php echo U('Member/index');?>" class="button-go-mc" title="个人中心"><span>个人中心</span></a></div>
    <div class="b">
        <ul>
            <li>
                <h3>订单中心</h3>
                <ol>
                    <li id="li-order"><a href="<?php echo U('OrderCenter/index');?>" title="我的订单"><span>我的订单</span></a></li>

                </ol>
            </li>
            <li>
                <h3>个人中心</h3>
                <ol>
                    <li id="li-account" ><a href="<?php echo U('PersonCenter/index');?>" title="个人信息"><span>个人信息</span></a></li>
                    <li id="li-security"><a href="<?php echo U('PersonCenter/pwd');?>" title="密码管理"><span>密码管理</span></a></li>
                    <li id="li-balance" ><a href="<?php echo U('PersonCenter/account');?>" title="账户余额"><span>账户余额</span></a></li>
                    <li id="li-myAddress"><a href="<?php echo U('PersonCenter/address');?>" title="收货信息"><span>收货信息</span></a></li>
                    <li id="li-enterprise" class="hide"></li>
                </ol>
            </li>
            <li>
                <h3>库存管理</h3>
                <ol>
                    <li id="li-stock"><a href="<?php echo U('Stock/index');?>" title="库存列表"><span>库存列表</span></a></li>
                    <li id="li-stock2"><a href="<?php echo U('Stock/log');?>" title="入库记录"><span>入库记录</span></a></li>
                    <li id="li-stock3"><a href="<?php echo U('Stock/redeploy_log');?>" title="调拨记录"><span>调拨记录</span></a></li>
                    <li id="li-stock4"><a href="<?php echo U('Stock/redeploy');?>" title="商品调拨"><span>商品调拨</span></a></li>
                    <li id="li-stock5"><a href="<?php echo U('Stock/add');?>" title="商品入库"><span>商品入库</span></a></li>

                </ol>
            </li>
            <li>
                <h3>社区中心</h3>
                <ol>
                    <li id="li-prdRemark" class="current"><a href="<?php echo U('Comment/index');?>" title="商品评价"><span>商品评价</span></a></li>
                </ol>
            </li>
        </ul>
    </div>
    <div class="f"></div>
</div>
</div>
</div>
<div class="hr-60"></div>
 <!-- footer star -->
  <div class="footer">
      <div class="footer-t">
          <div class="yzbody">
              <ul class="ft-nav">
                  <li>
                      <span class="pic"><img src="/vmallshop/Public/Home/images/ft01.jpg"></span>
                      <span class="tit">正品保障</span>
                  </li>
                  <li>
                      <span class="pic"><img src="/vmallshop/Public/Home/images/ft02.jpg"></span>
                      <span class="tit">7天包退</span>
                  </li>
                  <li>
                      <span class="pic"><img src="/vmallshop/Public/Home/images/ft03.jpg"></span>
                      <span class="tit">好评如潮</span>
                  </li>
                  <li>
                      <span class="pic"><img src="/vmallshop/Public/Home/images/ft04.jpg"></span>
                      <span class="tit">闪电发货</span>
                  </li>
                  <li>
                      <span class="pic"><img src="/vmallshop/Public/Home/images/ft05.jpg"></span>
                      <span class="tit">权威荣誉</span>
                  </li>
              </ul>
              <div class="dh-list">
                  <dl>
                      <dt>新手上路</dt>
                      <dd><a href="">隐私保护</a></dd>
                      <dd><a href="">会员介绍</a></dd>
                      <dd><a href="">会员注册</a></dd>
                  </dl>
                  <dl>
                      <dt>购物指南</dt>
                      <dd><a href="">购物流程</a></dd>
                      <dd><a href="">常见问题</a></dd>
                      <dd><a href="">生活旅行</a></dd>
                  </dl>
                  <dl>
                      <dt>售后服务</dt>
                      <dd><a href="">购售后服务与说明</a></dd>
                      <dd><a href="">返工/退换货</a></dd>
                      <dd><a href="">退款说明</a></dd>
                  </dl>
                  <dl>
                      <dt>配送方式</dt>
                      <dd><a href="">配送服务查询</a></dd>
                      <dd><a href="">配送收费标准</a></dd>
                  </dl>
                  <dl>
                      <dt>联系我们</dt>
                      <dd><a href="">联系我们</a></dd>
                      <dd><a href="">公司简介</a></dd>
                      <dd><a href="">投诉与建议</a></dd>
                  </dl>
                  <div class="contact-box">
                      <p>服务热线</p>
                      <h3><?php echo ($set_info[1]['set_content']); ?></h3>
                      <a href="" class="kf">联系客服</a>
                  </div>
                  <div class="f-weixin">
                      <p class="tit">微信公众号</p>
                      <p class="weix"><img src="/vmallshop/Upload<?php echo ($set_info[5]['set_content']); ?>"></p>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer-b">
          <div class="yzbody">
              <div class="nav-link">
                <a href="">我的订单</a>
                <a href="">我的浏览</a>
                <a href="">我的收藏</a>
                <a href="">公司案例</a>
                <a href="">企业简介</a>
                <a href="">联系我们</a>
                <a href="">新闻中心</a>
                <a href="">帮助中心</a>
              </div>
              <div class="link-c">
                  <p>友情链接：
				  <?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="_blank"><?php echo ($vo["link_name"]); ?></a>&nbsp;&nbsp;|<?php endforeach; endif; ?>
				  </p>
                  <p>技术支持：<?php echo ($set_info[2]['set_content']); ?></p>
              </div>
          </div>
      </div>
  </div>
  <!-- footer end-->
<script>
    function jiankong(th) {
        var storehouse_id =$("#out").val();
        var goods_id =$(th).val();
        $.ajax({
            url: "/vmallshop/index.php/Home/Stock/stock_num",
            type: 'post',
            dataType: 'json',
            data: {
                goods_id:goods_id,
                storehouse_id:storehouse_id
            },
            success: function (data) {
                $(th).parent().next().children('.stock_num1').val(data.stock_num);
                $(th).parent().next().children('.stock_num2').html(data.stock_num);

            }
        });
    }
    $("#addredeploy").click(function () {
        var storehouse_id =$("#out").val();
        $.ajax({
            url: "/vmallshop/index.php/Home/Stock/stock_goods_name",
            type: 'post',
            dataType: 'json',
            data: {
                storehouse_id:storehouse_id
            },
            success: function (data) {
                var str ='';
                str+='    <div>';
                str+='    <div class="item">';
                str+='    <label class="desc">商品名称：</label>';
                str+=' <select class="select goods_id" name="goods_id" style="width: 60%;" onchange="jiankong(this)">';
                for (var i = 0; i < data.list.length; i++) {
                    var list =data.list[i];
                    str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
                }
                str+='        </select>';
                str+='        <a href="#" style="color: red;margin-left: 20px" onclick="delb(this)">删除商品</a>';
                str+='    </div>';
                str+='         <div class="item">';
                str+='<label class="desc">库存数量：</label>';
                str+='<input class="stock_num1" name="stock_num" value="0"  type="hidden">';
                str+=' <span class="stock_num2" style="color: red">0</span>';
                str+=' <label class="desc" style="margin-left: 10px;">调配数量：</label>';
                str+='<input name="goods_num" class="desc-input" style="margin-left: 10px;" value="1">';
                str+='<span style="color: #c2c2c2;text-align: center;margin-left: 10px; ">*调配数量不能大于库存</span>';
                str+=' </div>';
                str+='    </div>';

                $('#demo').append(str);
                if(data.status == 'error'){
                    alert(data.msg);
                }
            },

        });
    })
    function delb(th) {
        $(th).parent('div').parent().remove();

    }
    function out_stock() {
        var storehouse_id =$("#out").val();
        $.ajax({
            url: "/vmallshop/index.php/Home/Stock/stock_goods_name",
            type: 'post',
            dataType: 'json',
            data: {
                storehouse_id:storehouse_id,
            },
            success: function (data) {
                var str ='';
                if(data.list.length > 0){
                    for (var i = 0; i < data.list.length; i++) {
                        var list =data.list[i];
                        str+='<option value="'+list.goods_id+'">'+list.goods_name+'</option>';
                    }
                }else {
                    str+='<option value="">'+data.msg+'</option>';
                }

                $('.goods_id').html(str)
            }
        });
    }
    //获取数据
    $('#redeploy').click(function () {
        //遍历获取入库信息
        var aler = true;
        var goods_id = new Array(); //或者写成：var btns= [];
        jQuery("select[name='goods_id']").each(function(key,value) {
            goods_id[key] = $(this).val();
            if(!$(this).val()){
                aler = false;
                return aler;
            }
        });
        var goods_num = new Array(); //或者写成：var btns= [];
        jQuery("input[name='goods_num']").each(function(key,value) {
            goods_num[key] = $(this).val();
            if(!$(this).val()){
                aler = false;
                return aler;
            }
        });
        //获取当前库存
        var stock_num = new Array(); //或者写成：var btns= [];
        jQuery("input[name='stock_num']").each(function(key,value) {
            stock_num[key] = $(this).val();
        });
        //获取仓库id
        var out_storehouse_id = $('#out').val();
        var into_storehouse_id = $('#into').val();

        if(aler == true){
            $.ajax({
                url: "/vmallshop/index.php/Home/Stock/redeploy_action",
                type: 'post',
                dataType: 'json',
                data: {
                    goods_id:goods_id,
                    goods_num:goods_num,
                    into:into_storehouse_id,
                    out:out_storehouse_id,
                    stock_num:stock_num
                },
                success: function (data) {
                    alert(data.msg);
                    if(data.status == 'success'){
                        window.location.replace(location.href);
                        aler = false;
                        return aler;
                    }
                },
                fail: function (data) {
                    aler = false;
                    return aler;
                }
            });
        }else {

        }

    })

</script>
</body></html>