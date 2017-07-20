<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="zh-cn" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php echo ($goods_info['goods_name']); ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico" />
<link href="/vmallshop/Public/css/ec.core.css" rel="stylesheet" type="text/css">

<link href="/vmallshop/Public/css/main.css" rel="stylesheet" type="text/css">
<script src="/vmallshop/Public/js/jsapi.js?20120518" namespace="ec"></script>
<script src="/vmallshop/Public/js/jquery-1.4.4.min.js"></script>
<script src="/vmallshop/Public/js/ec.core.js?20120518"></script> 
<script src="/vmallshop/Public/js/ec.business.js?20131212"></script> 
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>


</head>



<body>
  <!-----------------隐藏表单技术商品信息------------------------->
 <input type="hidden"  name="goods_id" value="<?php echo ($goods_info["goods_id"]); ?>" id="goods_id" />
 <input type="hidden" name="goods_state_login"  value="<?php echo ($goods_state_login); ?>" id="goods_state_login"/>
   
   
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
		
		<div  class="searchBar">
			
				<div  class="searchBar-key">
	<b>热门搜索：</b>
	
	    <!--------搜索上的几个关键商品--------->
		<a  href="<?php echo U('Search/index');?>?keywords='畅玩版'"  target="_blank">畅玩版</a>
	    
	    
		<a  href="<?php echo U('Search/index');?>?keywords=荣耀3C"  target="_blank">荣耀3C</a>
	    
	    
		<a  href="<?php echo U('Search/index');?>?keywords=X1"  target="_blank">X1</a>
	    
	    
		<a  href="<?php echo U('Search/index');?>?keywords=P7"  target="_blank">华为P7</a>
	    
	    
		<a  href="<?php echo U('Search/index');?>?keywords=荣耀立方"  target="_blank">荣耀立方</a>
	   <!--------搜索上的几个关键商品--------->
</div>
			<div  class="searchBar-form"  id="searchBar-area">
			    <!-----------搜索条------------------->
				<form  method="get"  action="" onsubmit="return false;">					
					
					
					
					<input  type="text"  class="text"  maxlength="100"  id="search_kw"  style="z-index: 1;"  autocomplete="off"  placeholder="请输入搜索关键字" style="height:18px;">
					
					<input  type="submit"  class="button"  value=" " id="submit_go">
					<input  type="hidden"  id="default-search"  value="荣耀6">
				</form>
				<!-----------搜索条------------------->
			</div>
		</div>
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
					<div  class="h"><a  href="<?php echo U('Memeber/index');?>"  rel="nofollow"  timetype="timestamp">我的商城</a>
					
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
		<li  id="nav-sale"><a  href="<?php echo U('Product/index',array('g'=>2));?>"  target="_blank"><span>荣耀6
			<s><img  src="/vmallshop/Public/Images/new.png"  alt="new"></s>
		</span></a> </li>
					
		<li  id="club"><a   href="<?php echo U('Product/index',array('g'=>1));?>"  ><span>华为P7
					</span></a> </li>
		<li  class=""><a  href="javascript:return false;"><span>精彩频道</span></a>
			
		</li>
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
<script type="text/javascript">
  $(function(){
       $.ajax({
	      url:"<?php echo U('ScanGoods/add');?>",
		  type:"POST",
		  data:{
		     'goods_id':$("input[name=goods_id]").val(),
		  
		  }
	   
	   
	   
	   
	   
	   
	   
	   
	   });
  
  
  
  
  
  
  });



</script>

<script>
	$(function () {
		$('#naver-list li').hover(function () {
			$(this).addClass('hover');
		},function () {
			$(this).removeClass('hover');
		});
	});
</script>
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
$("body").addClass("wide detail");
</script>


<div class="hr-10"></div>
<div class="g">
	<!--面包屑 -->
	<div class="breadcrumb-area fcn"><a href="<?php echo U('Index/index');?>" title="首页">首页</a>&nbsp;>&nbsp;<span id="bread-pro-name"><?php echo ($goods_info['goods_name']); ?></span></div>
</div>

<div class="hr-10"></div>
<div class="layout"> 
	
	<!--商品简介 -->
	<div class="pro-summary-area clearfix">
    	<div class="right-area">
        	<!--商品简介-属性 -->
        	<div class="pro-property-area clearfix">
                <div class="pro-meta-area">
                	<h1 id="pro-name"><?php echo ($goods_info['goods_name']); ?></h1>
            	
                	<!-- 插入 商品简介-广告语-->
                	<div class="pro-slogan" id="skuPromWord">
							<?php echo ($goods_info['goods_keywords']); ?>
					</div>			
                	<div class="hr-10"></div>
					<div class="line"></div>
                
                    <div class="pro-price">
							 <s id="pro-price-old"  class="hide"><label>华&nbsp;为&nbsp;&nbsp;价：</label>&yen;&nbsp; </s>
							 <span id="pro-price"><label>华&nbsp;为&nbsp;&nbsp;价：</label><b>&yen;&nbsp;<?php echo ($goods_price); ?></b></span>
                    </div>
                    
                    <!--chenzhongxian 促销和赠品合并-->
                    <!--商品简介-促销规则 -->
					
                    <div id="pro-promotions-area" class="pro-promotions-area <?php if($goods_sale_desc != '' ): else: ?>hide<?php endif; ?>      ">
                       <dl class="clearfix">
                            <dt>优惠信息：</dt>
                            <dd>
                                <ul id="pro-promotions-list">
                                 
                                </ul>
                                <ul id="pro-gift-list" >
								  <li>
                                 <span>优惠 </span>
                                 <a target="_blank" href="javascrpt:void(0)"><?php echo ($goods_sale_desc); ?></a>
                                 </li>
                                </ul> 
                            </dd>
                        </dl>
                    </div>
					
					
					<?php if($goods_state_login == 0): ?><div class="pro-price">
							 <s id="pro-price-old"  class="hide"><label>&nbsp;&nbsp;状&nbsp;&nbsp;态:</label>&yen;&nbsp; </s>
							 <span id="pro-price"><label>&nbsp;&nbsp;状&nbsp;&nbsp;态:</label><b>&nbsp<small><?php echo ($goods_state); ?></small></b></span>
                    </div>
					 <?php else: endif; ?>
                    
                    <div class="pro-coding"><label>商品编码：</label><span id="pro-sku-code"><?php echo ($goods_info["goods_no"]); ?></span></div>
					
					<!-------------商品评分------------->
                    <div class="pro-evaluate"><label>商品评分：</label>
					 <span class="pro-star">
					   <span class="starRating-area">
					 
					     <s id="prd-remark-scoreAverage" style="width:<?php echo ($goods_avg_scrore); ?>%"></s>
					   </span>
					 </span>&nbsp;
					 （<a id="prd-remark-jmptoremark" href="javascript:void(0)" onclick="ec.product.jmptoRemark()"   title="共&nbsp;0&nbsp;条评论">共&nbsp;<?php echo ($goods_comment_count); ?>&nbsp;条评论</a>）</div>
					<!-------------商品评分------------->
					<!-------------运费------------->
			        <div class="pro-freight">
					   <label>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：
					   </label>
					    满&nbsp;200&nbsp; 免运费（由华为通过顺丰发货，若顺丰不到转其他快递）
				   </div>
			      <div class="pro-service">
				    <label>服&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;务：</label>由华为商城负责发货，并提供售后服务
				 </div>
				 	
		    <div class="hr-10"></div>
		    <div class="line"></div>
		    <div class="hr-15"></div>
					
                    <!--商品简介-SKU -->
                    <div id="pro-skus" class="pro-sku-area"></div>
					
					
					 
					 
					
					
                    <div class="pro-stock-area" id="pro-quantity-area">
						<dl class="clearfix">
							<dt>购买数量：</dt>
							<dd>
							<span class="stock-area">
						      <a title="减" class="icon-minus-2 vam" id="goods_num_dec" href="javascript:;"><span>-</span></a>
							 
							  <input type="text" autocomplete="off" value="1" 
							  class="vam text" id="pro-quantity" style="ime-mode: disabled;">
							   <a title="加" class="icon-plus-2 vam" id="goods_num_incre" href="javascript:;"><span>+</span>
							   </a>
   						    </span>
						  </dd>
						</dl>
					</div><br/>
					<script type="text/javascript">
					    //js代码执行进行+ —
					    $(function(){
						    $("#goods_num_dec").click(function(){
							    $("#pro-quantity").val(function(){
								     
								     if(this.value<=1){
									    return 1;
									 }else{
									    return parseInt(this.value)-1;
									 }
								 
								 });
								
							
							});
						
						     //+ 操作
							
						    $("#goods_num_incre").click(function(){
							     
								 
								   $("#pro-quantity").val(function(){
								      if(parseInt(this.value)>9){
									    alert("亲,为了黄牛,限购10件");
										return 10;
									  }else{
									      return parseInt(this.value)+1;
									 }
								 
								
						           });
							
							});
						
						
						
						});
					
					
					</script>
					 <!-----------库存量----------------------->
					<div class="pro-service">
				    <label>库&nbsp;存&nbsp;&nbsp;量：</label>  
					  <?php if($goods_info['goods_num'] > 0): ?><span id="goods_total"><?php echo ($goods_info['goods_num']); ?></span>件
					  <?php else: ?>
					      <span id="goods_total" style="color:red">缺货</span><?php endif; ?>
				    </div>
					
					<!-----------------加入购物--------------------->
                    <div class="pro-action-area" id="pro-operation" style="visibility: visible;">
					   <a title="加入购物车" class="button-add-cart button-style-1"  href="javascript:;">
					    <span id="content">加入购物车</span>
					    </a>
						
				    </div>
<script type="text/javascript" src="/vmallshop/Public/Js/do_cat.js"></script>
<script type="text/javascript">
 $(function(){
             //ajax 实现购物车的功能
			 //获取商品的id 和状态
		 
		   var goods_id=$("#goods_id").val();
		   var goods_state_login=$("#goods_state_login").val();
		   var goods_total=parseInt($("#goods_total").html());
		  
		   
		   
		 
		  $(".button-add-cart").click(function(){
					      //ajax去结算
						 //先判断是否下架
			    if(goods_state_login==0){
				     alert("商品已经下架,不可以购买!");
				
				}else{
				  //可以购买的就ajax的形式传到后台
				  // 商品的id 和数量
				  
				  var num=$("#pro-quantity").val();
				   
				  if(num<1){
				      alert('你选取的数量小于1');
				  
				  
				  }else if(num>goods_total){
				  
				      alert('库存不足,少买点吧');
				  
				  }else{
				      //ajax处理
					  
					  $.ajax({
					       url:"<?php echo U('Product/add');?>",
						   type:'POST',
						   data:{
						      'num':num,
							  'goods_id':goods_id,
						   
						   },
						   dataType:'json',
						   success:function(responseText,status,xhr){
						       if(status=='success'){
							      if(responseText.status==1){
								  
								       //成功
									   $("#cart-total").html(responseText.content.nums);
									   $("#cart-price").html(responseText.content.price.toFixed(2));
									   $(".pro-popup-area").css('display','block');
									   do_cat("<?php echo U('SmallCat/myGoods');?>");
									 
									   
								  }else{
								    alert('加入购物车失败');
								  }
							   
							   }else{
							      alert('加入购物车失败');
							   
							   }
						   
						   },
						   error:function(){
						      alert("购买失败");
						   
						   },
						   timeout:1000*60,
					  
					  
					  
					  
					  
					  
					  
					  });
				  
				  
				  
				  
				  }
				  
				
				
				
				
				
				}	  
						
					  
		  });
		 
	
		 
		 
		 
 
 
 });	







</script>					
					
					
					
				    <!----------购物车的数据---------------->
				    <div class="pro-popup-area hide" id="cart-tips" style="display:none;">
                         <div class="h">
	                        <a title="关闭" class="pro-popup-close" onclick="$('#cart-tips').hide()" href="javascript:;"><span>关闭</span></a>
                         </div>
                     <div class="b">
	               	   <div class="pro-add-success">
						  <dl>
							 <dt><s></s></dt>
							<dd>
							 <p></p>
							  <div class="pro-add-success-msg">成功加入购物车!</div>
							  <div class="pro-add-success-total">
								 购物车中共&nbsp;
								 <b id="cart-total"></b>
								  &nbsp;件商品，金额合计&nbsp;
								  <b id="cart-price"></b>
							 </div>
							 <div class="pro-add-success-button">
								<a  title="去购物车结算" class="button-style-1 button-go-cart" href="<?php echo U('Cart/index');?>">去结算</a>
								<a onclick="$('#cart-tips').hide()" title="继续逛逛" href="javascript:;" class="button-style-4 button-walking">
								  继续逛逛&nbsp;&gt;&gt;</a>
							 </div>									
						  </dd>
						</dl>					
		           </div>
                    </div>
                 </div>
				
<script type="text/javascript">
				    
  
					  
					 
					  
				 
				 
				 
</script>
				 <!----------购物车的数据---------------->	
            </div>
              
             <div id="pro-select-sku" class="pro-selected"></b></div>
                
             
<!-- Baidu Button BEGIN -->


<!-- Baidu Button END -->            </div>
        </div>
        <!--------------------左侧放大镜------------------------->
        <div class="left-area">
        	<!--商品简介-图片画廊 -->
        	<div class="pro-gallery-area">
			   
            	<div class="pro-gallery-img" >
					<a id="product-img" href='/vmallshop/Upload<?php echo ($goods_info["goods_big_pic"]); ?>' class = 'cloud-zoom'  >
					   <div  style="position:relative;width:480px;height:480px;" id="pic_small">
					   <img src="/vmallshop/Upload<?php echo ($goods_info["goods_small_pic"]); ?>" alt="<?php echo ($goods_info['goods_name']); ?>" width="428" height="428"/>
					    <!-----------图层-------------->
						    <div  id="pic_shade" style="width:200px;height:200px;position:absolute;z-index:98;border:3px solid #E5E5E5;background:#E5E5E5;opacity:0.5;left:0px;top:0px;display:none;"></div>
					   </div>
					</a>
					
				</div>
				<div id="pic_big_minnr" style="width:428px;height:428px;border:1px solid #E5E5E5;z-index:500;position:absolute;top:30px;left:520px;overflow:hidden;display:none;">
				   <img src="/vmallshop/Upload<?php echo ($goods_info["goods_big_pic"]); ?>" style="position:absolute;left:0px;top:0px;"/>
				</div>
				    
                
            </div>
			  <script type="text/javascript">
			     //放大镜js代码
				 $(function(){
				     var small_div=$("#pic_small");
					 var pic_shade=$("#pic_shade");
					 var big_pic=$("#pic_big_minnr img");
					 var big_pic_div=$("#pic_big_minnr");
				      
				     small_div.hover(function(e){
					     var small_div_left=$(this).offset().left;
					     var small_div_top=$(this).offset().top;
                         pic_shade.show();
						 big_pic_div.show();
						 
						  $(this).mousemove(function(e){
						     var pic_shade_left=e.pageX;
							 var pic_shade_top=e.pageY;
							 
							 var L=pic_shade_left-small_div_left;
							 var T=pic_shade_top-small_div_top;
							 
							 var pic_shade_width=pic_shade.outerWidth();
							 var pic_shade_height=pic_shade.outerHeight();
							 
							 
							 
							 var big_L=-parseInt(L/480*(800-428));
						     var big_T=-parseInt(T/480*(800-428));
							 
							 big_pic.css({'left':big_L,'top':big_T});
						     
							  var sL=L-parseInt(pic_shade_width/2),sT=T-parseInt(pic_shade_height/2);
							 if(L<parseInt(pic_shade_width/2)){
							      sL=0;
							 }
							 
							 if(L>(480-pic_shade_width)){
							     sL=480-pic_shade_width;
							 }
						     
							 if(T<pic_shade_height/2){
							      
								  sT=0;
								  
							 
							 }
							 
							  
							 if(T>(480-pic_shade_height)){
							     sT=480-parseInt(pic_shade_height);
							 }
							 
							  pic_shade.css({
						       'left':sL,
							   'top':sT
						      });
						  
						  });
						  
				         
						 
						
					 
					 },function(e){
					     pic_shade.hide();
						 big_pic_div.hide();
					 
					 });
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 });
				    
			     
			  </script>
			
        </div>
        <!--------------------左侧放大镜------------------------->
    </div>

</div>






<div class="hr-20"></div>
<!-----------------下面部分------------------------>
<div class="layout">
	<div class="fr u-3-4">
	 <!----------------商品详情-------------------->
		<div class="pro-detail-area clearfix" >
		<div class="tool-fixed-holder"></div>
		<div id="pro-tab-all" class="pro-detail-tool">
			
		<!--商品详情-书签 --> 
        <div id="pro-tab-area" class="pro-detail-tab clearfix">
		    <!----------商品详情导航条------------   -->
        	<div class="pro-detail-tab-nav" id="pro-detail-tab-nav-x">
            <ul>
                <li id="pro-tab-feature"  class="current" >
				   <a href="javascript:;" title="商品详情"><span>商品详情</span></a>
				</li>
                <li id="pro-tab-evaluate" >
				   <a href="javascript:;" title="用户评价">
				    <span id="prd-remark-span-tab-evaluate">用户评价
					      <em>（<?php echo ($comment_count); ?>）</em>
				    </span>
				   </a>
				</li>
                <li id="pro-tab-parameter" data-skulist="2171,1991,2069,2170,2202,2203,2204,2205"  >
				    <a href="javascript:;" title="规格参数">
				    <span>规格参数</span></a>
				</li>
                <li id="pro-tab-package" >
				  <a href="javascript:;" title="包装清单" >
				    <span>包装清单</span>
				  </a>
				</li>
		        <li id="pro-tab-software">
				  <a href="javascript:;" title="软件下载">
				     <span>软件下载</span>
				  </a>
				</li>
                <li id="pro-tab-service">
				    <a href="javascript:;" title="售后服务">
					    <span>售后服务</span>
				    </a>
				</li>
              
            </ul>
           </div>
            <!----------商品详情导航条------------------>
            
		   
        </div>
        </div>

     <!--内容东西-->
    <div class="pro-detail-area ">
            <!-------------------商品详情-------------------------->
		  <div id="pro-tab-feature-content" class="pro-detail-tab-area pro-feature-area">
			
				 <div class="hr-20"></div>
				     <div id="pro-tab-parameter-content-1733">
					     <table cellspacing="0" cellpadding="0" border="0">
						      <tbody>
							    <tr>
								 <th colspan="2"><h3><b>主体</b></h3></th>
								 
								</tr>
								<hr/>
								<tr>
								 <td class="p-name"><b>品牌：</b></td>
								 <td class="p-desc">华为（HUAWEI）</td>
								 </tr>
								 <tr><td class="p-name"><b>上市时间：</b></td>
								 <td class="p-desc"><?php echo (date("Y-m-d",$goods_info["goods_time"])); ?></td>
								 </tr>
								 <tr>
								 <tr><td class="p-name"><b>商品状态：</b></td>
								 <td class="p-desc"><?php echo ($goods_info["goods_state"]); ?></td>
								 </tr>
								 <tr><td class="p-name"><b>商品重量：</b></td>
								 <td class="p-desc"><?php echo ($goods_info["goods_weight"]); ?></td>
								 </tr>
								 <?php if(is_array($goods_attr_values)): $i = 0; $__LIST__ = $goods_attr_values;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td class="p-name"><b><?php echo ($vo["attr_name"]); ?>：</b></td>
								 <td class="p-desc"><?php echo ($vo["avalue_value"]); ?></td>
								 </tr><?php endforeach; endif; else: echo "" ;endif; ?>
									
									
									
									</tbody></table>
					   
					   </div>	
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				 <div class="pro-disclaimer-area">
				  <p>※本网站尽可能地提供准确的信息。本网站内所涉及的产品图片与实物可能有细微区别，效果演示图和示意图仅供参考（图片为合成图、模拟演示图），有关产品的外观（包括但不限于颜色）请以实物为准。</p>
				  <p>※限于篇幅，本网站中所包含的信息（包括但不限于产品规格、功能说明等）可能不完整，请以有关产品使用说明书的具体信息为准。</p>
				</div>
		 </div>
		   
		   
		            <!--用户评价 -->
       <div id="pro-tab-evaluate-content" class="pro-detail-tab-area pro-evaluate-area  hide">
                
                <div class="pro-score-area clearfix">
                	<div class="pro-score-average">
						<span><b id="pro-evaluate-avgSorce"><?php echo ($good_status); ?></b>%</span>
						<em>好评度</em>
					</div>
					
					
					<div class="pro-score-percent">
						<dl>
							<dt>好评<em id="pro-score-percent-high"></em></dt>
							<dd><s id="pro-score-draw-high" style="width:<?php echo ($good_status); ?>%"></s></dd>
						</dl>
						<dl>
							<dt>中评<em id="pro-score-percent-mid"></em></dt>
							<dd><s id="pro-score-draw-mid" style="width:<?php echo ($middle_status); ?>%"></s></dd>
						</dl>
						<dl>
							<dt>差评<em id="pro-score-percent-low"></em></dt>
							<dd><s id="pro-score-draw-low"  style="width:<?php echo ($bad_status); ?>%"></s></dd>
						</dl>
					</div>
					
                  <div id="pro-score-impress"  class="pro-score-impress"></div>
                  
                   
                </div>
                
                <!-- 20131220-商品详情-用户评论-书签-start -->
				<div class="pro-evaluate-tab clearfix">
				     <!--------------评价导航------------------->
					<div class="pro-evaluate-tab-nav">
						<ul id="pro-evaluate-click-type">
						
							<li id="pro-evaluate-click-all" class="current">、
							   <a href="javascript:;">
							       <span>全部评价
								   <em id="pro-evaluate-number-all"></em>
								   </span>
								</a>
							</li>
							<li id="pro-evaluate-click-high">
							   <a  href="javascript:;">
							      <span>好评(<?php echo ((isset($good_comment_count) && ($good_comment_count !== ""))?($good_comment_count):0); ?>)
								  <em id="pro-evaluate-number-high" ></em>
								  </span>
								</a>
							</li>
							<li id="pro-evaluate-click-mid" >
							    <a href="javascript:;">
									<span >中评(<?php echo ((isset($middle_comment_count) && ($middle_comment_count !== ""))?($middle_comment_count):0); ?>)
									   <em id="pro-evaluate-number-mid"></em>
									</span>
								</a>
						    </li>
							
							<li id="pro-evaluate-click-low">
							    <a href="javascript:;">
								    <span  >差评(<?php echo ((isset($bad_comment_count) && ($bad_comment_count !== ""))?($bad_comment_count):0); ?>)
									    <em id="pro-evaluate-number-low"></em>
									</span>
								</a>
							</li>
						</ul>
					</div>
					 <!--------------评价导航------------------->
					<div class="pro-evaluate-page">
					<!-- 20131220-分页-start -->
					<div id="pro-msg-pagerup" class="pager">
					   <ul>
					    <li class="pgNext link first first-empty"></li>
						<li class="pgNext link pre pre-empty"></li>
						<span class="qpages">
						   <li class="page-number link pgCurrent"></li>
						   <li class="page-number link"></li>
						   <li class="page-number link"></li>
						   <li class="page-number link"></li>
						   <li class="page-number link"></li>
						   <li class="text">...</li>
						   <li class="page-number link page-number-last"></li>
						</span>
						<li class="pgNext link next"></li>
						<li class="pgNext link last"></li>
						<li class="text quickPager">
						   <span class="fl"></span>
						   <div id="chatpage">
						     <input id="quickPager" class="pagenum fl" value="1" style="width:20px;">
							 <a id="enter" class="enter fl" href="javascript:void(0)"></a>
						   </div>
						   <span class="fl"></span>
						</li>
					  </ul>
					   
					</div>
					<!-- 20131220-分页-end -->
					<div class="hr-15"></div>
				</div>
					
			 </div>
			 <!---------------评价内容部分-------------------->
			 <div id="pro-msg-list" class="pro-comment-list">
			     <!---------------------一个评论--------------------------->
			    
				  <!---------------------一个评论--------------------------->
				  
				  
				  <!---------------------页面加载中--------------------------->
			         <div  id="get_more_content" class="pro-user-comment-main" style="width:400px;height:30px;margin-left:250px;text-align:center;line-height:30px;">
					     <center><a href="javascript:void(0)">加载更多内容</a></center>
					 
					 </div>
				  
				 <!------------------------页面加载中-------------------------------->
				 
				 
				
		 </div> 
		  <script type="text/javascript">
		     //ajax形式获取用户评论
			 $("#pro-tab-evaluate").click(function(){
			        getPage();
			  });
		        var get_more_content=$("#get_more_content");
				 get_more_content.click(function(){
				 
				     getPage();
				 
				 });
				function getPage(){
				      
				      $.ajax({
				         url:"<?php echo U('Product/userComment','','');?>",
						 type:'GET',
						 data:{
						     'g':$("input[name=goods_id]").val(),
							 'type':$(".comment_content").size(),
						 },
						 beforeSend:function(){
						     
						 },
						 
						success:function(responseText,status,xhr){
						    
						     if(status=='success'){
							     $(responseText).insertBefore(get_more_content);
							 
							 }else{
							   $("#pro-msg-list").html("评论加载失败.......");
							 
							 
							 }
						 
						 
						 
					    }
						
						});
				      
				 
				 
				 
				 }//getPage结束
			 
			 
			
		  
		  </script>
		 
		  <!---------评价尾部分-------------------->	
				
               
             
        </div>
          <!--规格参数 -->
		 <div id="pro-tab-parameter-content" class="pro-detail-tab-area pro-parameter-area hide">
		     <p>手机（含内置电池） x 1，2A充电器 x 1，2A USB线 x 1，TP保护膜 x 1，后盖保护膜 x 1，插卡拔片 x 1，快速指南 x 1，售后服务手册 x 1，安全说明 x 1<br />
			  </p>
			  <p><br /></p><p><br /></p>
	     </div>
		 <!--规格参数 -->
         <!--包装清单 -->
         <div id="pro-tab-package-content" class="pro-detail-tab-area pro-package-area hide  ">
         <div id="pro-tab-package-content-2171">
              <p>手机（含内置电池） x 1，2A充电器 x 1，2A USB线 x 1，TP保护膜 x 1，后盖保护膜 x 1，插卡拔片 x 1，快速指南 x 1，售后服务手册 x 1，安全说明 x 1<br />
			  </p>
			  <p><br /></p><p><br /></p>
         </div>
    </div>   
         <!--包装清单 -->
		 <!--售后服务 -->
         <div id="pro-tab-service-content" class="pro-detail-tab-area pro-service-area hide">
		 <div id="pro-tab-service-content-2171" class=>
		   <p>本产品全国联保，享受三包服务，质保期为：一年质保<br />如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7天内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！<br />售后服务电话：400-830-8300<br /><span>华为消费者BG官网： <a href="http://consumer.huawei.com/cn/">http://consumer.huawei.com/cn/</a></span><br /></p><p><br /></p>
		</div>
   </div>
	    

    </div>       	
</div>
     <script type="text/javascript">
	     $(function(){
		     $("#pro-detail-tab-nav-x ul li").click(function(){
			     
				 $(this).addClass("current").siblings('li').removeClass("current");
			     var index=$(this).index();
				 $(".pro-detail-tab-area").eq(index).removeClass("hide").siblings('div').addClass("hide");
			 
			 
			 
			 });
		 
		 
		 
		 
		 
		 });
	 
	 </script>

     <!-------------------商品已经到了头----------->
    <!--------------------咨询部分------------------------------------->
        <div class="pro-detail-area clearfix" id="prd_detail_counsel">
			<div class="pro-detail-tool">
				<!-- 20140624-商品详情-书签-start -->
				<div class="pro-detail-tab clearfix">
					<div class="pro-detail-tab-nav">
						<ul>
							<li class="current" id="prd_detail_counsel_1"><a href="javascript:;" onclick="ec.product.divchange(1)"><span>全部咨询</span></a></li>
							<li id="prd_detail_counsel_2"><a href="javascript:;" onclick="ec.product.divchange(2)"><span>商品咨询</span></a></li>
							<li id="prd_detail_counsel_3"><a href="javascript:;" onclick="ec.product.divchange(3)"><span>支付</span></a></li>
							<li id="prd_detail_counsel_4"><a href="javascript:;" onclick="ec.product.divchange(4)"><span>配送</span></a></li>
							<li id="prd_detail_counsel_5"><a href="javascript:;" onclick="ec.product.divchange(5)"><span>售后</span></a></li>
							<li id="prd_detail_counsel_6"><a href="javascript:;" onclick="ec.product.divchange(6)"><span>常见问题</span></a></li>
						</ul>
					</div>
					<div class="pro-detail-tab-link"><a href="#inquire-form" onclick="ec.product.loginCheckBefCoun();">发表咨询&gt;&gt;</a></div>
				</div><!-- 20140624-商品详情-书签-end -->
			</div>

			<!-- 20140624-商品详情-全部咨询-start -->
			<div class="pro-detail-tab-area pro-inquire-area " id="prddetail_counsel_all">
				<!-- 20140624-商品详情-咨询提示-start -->
				<div class="pro-inquire-tips">
					<label>温馨提示：</label>因产线可能更改商品包装、产地、附配件等未及时通知，且每位咨询者购买、提问时间等不同。为此，客服给到的回复仅对提问者3天内有效，其他网友仅供参考！给您带来的不便还请谅解，谢谢！
				</div><!-- 20140624-商品详情-咨询提示-end -->
				<div class="pro-inquire-list" id="all_prd_counsel_content">
				
					
					
				
				</div>
				
			</div><!-- 20140624-商品详情-全部咨询-end -->

			
			<div class="pro-detail-tab-area pro-inquire-area " id="prddetail_counsel_prd" style="display:none;">
				<!-- 20140624-商品详情-咨询提示-start -->
				<div class="pro-inquire-tips">
					<label>温馨提示：</label>因产线可能更改商品包装、产地、附配件等未及时通知，且每位咨询者购买、提问时间等不同。为此，客服给到的回复仅对提问者3天内有效，其他网友仅供参考！给您带来的不便还请谅解，谢谢！
				</div><!-- 20140624-商品详情-咨询提示-end -->
				<div class="pro-inquire-list" id="prd_prd_counsel_content">
				</div>
				<div class="pro-inquire-page clearfix" id="prddetail_counsel_prd_total">
					<div class="pro-inquire-record">共<em></em>条</div>
					<!-- 20131220-分页-start -->
					<div class="pager" id="prd_prd_counsel">
					</div><!-- 20131220-分页-end -->
				</div>
			</div><!-- 20140624-商品详情-商品咨询-end -->

			
			<div class="pro-detail-tab-area pro-inquire-area " id="prddetail_counsel_pay" style="display:none;">
				
				<div class="pro-inquire-tips" >
					<label>温馨提示：</label>因产线可能更改商品包装、产地、附配件等未及时通知，且每位咨询者购买、提问时间等不同。为此，客服给到的回复仅对提问者3天内有效，其他网友仅供参考！给您带来的不便还请谅解，谢谢！
				</div><!-- 20140624-商品-咨询提示-end -->
				<div class="pro-inquire-list" id="pay_prd_counsel_content">
				</div>
				<div class="pro-inquire-page clearfix" id="prddetail_counsel_pay_total">
					<div class="pro-inquire-record">共<em></em>条</div>
					<!-- 20131220-分页-start -->
					<div class="pager" id="pay_prd_counsel_page">
					</div><!-- 20131220-分页-end -->
				</div>
		   </div>

			<div class="pro-detail-tab-area pro-inquire-area " id="prddetail_counsel_trans" style="display:none;">
				<!-- 20140624-商品详情-咨询提示-start -->
				<div class="pro-inquire-tips">
					<label>温馨提示：</label>
				</div><!-- 20140624-商品详情-咨询提示-end -->
				<div class="pro-inquire-list" id="trans_prd_counsel_content">
				</div>
				<!--分页判断-->
				<div class="pro-inquire-page clearfix" id="prddetail_counsel_trans_total">
					<div class="pro-inquire-record" >共<em></em>条</div>
					<!-- 20131220-分页-start -->
					<div class="pager" id="trans_prd_counsel_page" >
					</div>
					<!-- 20131220-分页-end -->
				</div>
			</div><!-- 20140624-商品-配送咨询-end -->

			
	</div>
	<!--------------------咨询部分尾------------------------------------->
    </div>
    
	
	
	
	
	
    

	            <!------------------热销和浏览部分------------------------->
				<div class="fl u-1-4">
						<div class="hot-area">
							<div class="h">
								<h3><span>热销榜单</span></h3>
							</div>
							<div class="b">
								<!--商品列表 -->
								


<div  class="pro-list" id="pro-list">
		<ul>
		     <!-----------热销榜单---------------------->
		     <!--<li>
				<div>
					<p  class="p-img"><a  href="{}"  title="华为 荣耀 畅玩版 真8核 双卡双待 移动版 TD-SCDMA/GSM（白色）套餐一"><img  src="/vmallshop/Public/Images/60_60_11.jpg"  alt="华为 荣耀 畅玩版 真8核 双卡双待 移动版 TD-SCDMA/GSM（白色）套餐一"></a>
					-->
					<!--------S记录着第几个商品-------->
					<!---<s  class="s1"></s></p>
					<p  class="p-name"><a  href="http://www.vmall.com/product/1274.html#2155"  title="华为 荣耀 畅玩版 真8核 双卡双待 移动版 TD-SCDMA/GSM（白色）套餐一">荣耀 畅玩版 移动版（白色）套餐一</a></p>
					<p  class="p-price"><b>¥1299</b></p>
				</div>
		    </li>--->
			<!-----------热销榜单---------------------->
			
			
		</ul>		
</div>
     <script type="text/javascript">
	     //ajax的形式加载
		 
		 $(function(){
		     $.ajax({
			      url:"<?php echo U('HotSale/index');?>",
				  type:'GET',
				  dataType:'json',
				  success:function(responseText,status,xhr){
				       if(status=='success'){
					      if(responseText['status']==1){
						       var Str=responseText.content.toString();
							   
						       $(Str).appendTo($("#pro-list ul"));
							 
						  
						  }else{
						     
						  }
					      
					   
					   }
				  
				  }
				  
                 				 
				 
			 
			 
			 
			 
			 
			 
			 
			 });
		 
		 
		 
		 
		 
		 
		 });
		 
		 
		 
	 
	 
	 
	 
	 
	 
	 </script>
							</div>
						</div>
								<div id="pro-seg-hot" class="hr-20"></div>
						<!-- 最近浏览过的商品  -->
						<div id="product-history-area" class="rl-area ">
							 <!-- 最近浏览过的商品  -->
							     
	
	
	
	<div  class="h">
        <h3  class="fl"><span>最近浏览过的商品</span></h3>
        <span  class="fr"><a  class="icon-clear"  href="javascript:;" >清空</a></span>
    </div>
    <div  class="b">
        
        <div  class="pro-list">
            <ul  id="product-history-list">
			   <!--------浏览过的商品----------------->
			
			 <!--------浏览过的商品----------------->
		</ul>
        </div>
		<script type="text/javascript">
		      //浏览商品的js代码
		      $(function(){
			      $.ajax({
				     url:"<?php echo U('ScanGoods/index');?>",
					 type:"POST",
					 dataType:'json',
					 
					 success:function(responseText,status,xhr){
					     if(status=="success"){
						    if(responseText.status==1){
							  var scanString=responseText.content;
							   $(scanString).appendTo("#product-history-list");
							}
						 
						 }
					 
					 
					 
					 
					 }
				  
				  
				  
				  
				  
				  
				  
				  });
				  
				     //清空商品信息
				  $(".h .fr").click(function(){
				     
				     $("#product-history-list li").remove();
				  
				     $.ajax({
					     url:"<?php echo U("ScanGoods/del");?>",
						 type:"POST",
					 
					 
					 });
				  
				  
				  
				  
				  }
				  );
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  });
		
		</script>
		
 </div>
 
 
							
						</div>   
				</div>
		        <!------------------热销和浏览部分------------------------->
</div>
<!----------下面部分------------------->
<div id="remarkLoading"></div>
<div class="hr-60"></div>




                




<!--口号-20121025 -->

<div class="slogan">
	<ul>
		<li class="s1"><i></i>500强企业&nbsp;品质保证</li>
		<li class="s2"><i></i>7天退货&nbsp;15天换货</li>
		<li class="s3"><i></i>200元起免运费</li>
		<li class="s4"><i></i>448家维修网点&nbsp;全国联保</li>
	</ul>
</div><!--口号-end -->
<!--服务-20121025 -->
<div class="service">
		<dl class="s1">
			<dt><i></i>帮助中心</dt>
			<dd>
				<ol>        
					<li><a   href="javascript:void(0)">购物指南</a></li>
					<li><a   href="javascript:void(0)">配送方式</a></li>
					<li><a   href="javascript:void(0)">支付方式</a></li>
					<li><a   href="javascript:void(0)">常见问题</a></li>
				</ol>
			</dd>
		</dl>
		<dl class="s2">
			<dt><i></i>售后服务</dt>
			<dd>
				<ol>
					<li><a target="_blank" href="javascript:void(0)">保修政策</a></li>
					<li><a target="_blank" href="javascript:void(0)">退换货政策</a></li>
					<li><a target="_blank" href="javascript:void(0)">退换货流程</a></li>
					<li><a target="_blank" href="javascript:void(0)">手机寄修服务</a></li>
				</ol>
			</dd>
		</dl>
		<dl class="s3">
			<dt><i></i>技术支持</dt>
			<dd>
				<ol>        
					<li><a   href="javascript:void(0)">售后网点</a></li>
					<li><a   href="javascript:void(0)">常见问题</a></li>
					<li><a   href="javascript:void(0)">产品手册</a></li>
					<li><a   href="javascript:void(0)">软件下载</a></li>
				</ol>       
			</dd>
		</dl>
		<dl class="s4">
			<dt><i></i>关于商城</dt>
			<dd>
				<ol>
					<li><a   href="javascript:void(0)">公司介绍</a></li>
					<li><a   href="javascript:void(0)">华为商城简介</a></li>
					<li><a   href="javascript:void(0)">联系客服</a></li>
					<li><a   href="javascript:void(0)">商务合作</a></li>
				</ol>
			</dd>
		</dl>
		<dl class="s5">
			<dt><i></i>关注我们</dt>
			<dd>
				<ol>
					<li><a class="sina" href="javascript:void(0)" target="_blank">新浪微博</a></li>
					<li><a class="qq" href="javascript:void(0)" target="_blank">腾讯微博</a></li>
					<li><a class="huafen" href="javascript:void(0)" target="_blank">花粉社区</a></li>
					<li><a href="javascript:void(0)" >商城手机版</a></li>
				</ol>
			</dd>
		</dl>
</div>
<!--服务-end -->

<!--确认对话框-->
<div id="ec_ui_confirm" class="popup-area popup-define-area hide">
    <div class="b">
        <p id="ec_ui_confirm_msg"></p>
        <div class="popup-button-area"><a id="ec_ui_confirm_yes" href="javascript:;" class="button-action-yes" title="是"><span>是</span></a><a id="ec_ui_confirm_no" href="javascript:;" class="button-action-no" title="否"><span>否</span></a></div>
    </div>
    <div class="f"><s class="icon-arrow-down"></s></div>
</div>

<!--提示对话框-->
<div id="ec_ui_tips" class="popup-area popup-define-area hide">
    <div class="b">
        <p id="ec_ui_tips_msg" class="tac"></p>
        <div class="popup-button-area tac"><a id="ec_ui_tips_yes" href="javascript:;" class="button-action-yes" title="确定"><span>确定</span></a></div>
    </div>
    <div class="f"><s class="icon-arrow-down"></s></div>
</div>

<!--在线客服-->
<div style="top: 230px; left: 1301px; z-index: 500; position: fixed;" class="hungBar" id="tools-nav">
	<a style="opacity: 1;" title="返回顶部" class="hungBar-top" href="#" id="hungBar-top">返回顶部</a>
	<a style="display: block;" id="tools-nav-survery" title="意见反馈" class="hungBar-feedback hide" href="javascript:;" >意见反馈</a>		
	
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
	<!--意见反馈box-- hide-->
	<div id="survery-box" class="form-feedback-area  hide">
		<div class="h">
			<a class="form-feedback-close" title="关闭" href="javascript:;"></a>
		</div>
		<div class="b">
				<div class="form-edit-area">
					<form onsubmit="return false;" autocomplete="off">
						<div class="form-edit-table">
							<table border="0" cellpadding="0" cellspacing="0">
								<tbody>
							    <tr>
                                    <td>
                                        <b>疑问类型：</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select id="type" name="type">
                                        	
                                          
                        
                                        </select>
                                    </td>
                                </tr>
								
								<tr>
									<td><b>您的问题或建议：</b><span id="errMsg" style="color:red;font-size:14px;"></span></td>
								</tr>
								<tr>
									<td><textarea class="textarea" type="textarea" name="content" id="surveryContent" placeholder="200字内"></textarea></td>
								</tr>
								<tr>
									<td>您的联系方式：</td>
								</tr>
								<tr>
									<td><input class="text" name="contact" id="surveryContact" type="text" placeholder="邮箱或手机号"></td>
								</tr>
								<tr>
									<td><div class="fl"><input name="code" id="surveryVerify" class="verify vam" maxlength="4" type="text">&nbsp;&nbsp;<img id="surveryVerifyImg" onclick="this.src=this.src+'?'+Math.random()" class="vam" alt="验证码" src="<?php echo U('Advice/verify');?>">&nbsp;&nbsp;&nbsp;&nbsp;<span class="vam"><a 
									 id="surveryVerify_do"  class="u" >看不清，换一张</a></span></div><div class="fr"><input value="提交" id="advice_submit" type="button"></div></td>
								</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
		</div>
	</div>
	
</div>
<script type="text/javascript">
      //用户意见提交的控制代码 曹建伟提供
    $(function(){
	      //控制验证码的更改
		  function changeImg(){
		     
			 $("#surveryVerifyImg").attr('src',function(i,v){
			      return v+'?='+Math.random();
			 });
		   
		  }
		  $("#surveryVerify_do").click(function(){
		       
		        changeImg();
		  
		  });
		 //控制窗口的显示
	    $("#tools-nav-survery").toggle(function(){
		     $("#survery-box").removeClass("hide");
			 changeImg();
		},function(){
		      $("#survery-box").addClass("hide");
			  changeImg();
		
		});
	    
		$(".form-feedback-close").click(function(){
		   
		      $("#survery-box").addClass("hide");
			  changeImg();
 
		});
		//获取疑问问题ajax的形式返回
		$.ajax({
		      url:"<?php echo U('Advice/makeCategory');?>",
			  type:"POST",
			  dataType:'json',
			  success:function(responseText,status,xhr){
			        if(status=='success'){
					    if(responseText.status==1){
						
						    $("#type").html(responseText.content);
						}
					}else{
					   alert("加载分类失败");
					}
			  },
			  error:function(){
			     alert("加载分类失败");
			  },
			  timeout:1000*60,
		     
		
		
		});
		
		
		var select=$("#type"); //选择类型
		var content=$("#surveryContent");//内容
		var connect=$("#surveryContact");//联系方式
		var code=$("#surveryVerify");//验证码
		var errMsg=$("#errMsg");
		$(select).focus(function(){
		     errMsg.html("");
		});
		$(content).focus(function(){
		     errMsg.html("");
		});
		$(connect).focus(function(){
		     errMsg.html("");
		});
		$(code).focus(function(){
		     errMsg.html("");
		});
		$("#advice_submit").click(function(){
		    //单击提交按钮进行数据判断
		 	
		     var select_val=select.val();
			 var content_val=content.val();
			 var connect_val=connect.val();
			 var code_val=code.val();
			
			 if(select_val<0){
			     errMsg.html("请选择疑问类型"); 
                
				 changeImg()
                  return;				 
			 }else if(content_val.length<1){
			    errMsg.html("请输入建议"); 
			  
				changeImg();
				return ;
			 }else if(connect.length<1){
			    errMsg.html("请输入联系方式"); 
				changeImg();
				
				 return;
			 }else if(code.length<1){
			     errMsg.html("请输入验证码"); 
				 changeImg();
				 
				 return;
			}
			//进行ajax验证验证码
			$.ajax({
			     url:"<?php echo U('Advice/checkVerify');?>",
				 type:"GET",
				 data:{
				    code:code_val,
				 },
				 success:function(responseText,statuss,xhr){
				     if(statuss=="success"){
					     if(responseText==0){
						    errMsg.html("验证码错误"); 
						    changeImg();
							return;
						 }else{
						    $.ajax({
							    url:"<?php echo U('Advice/index');?>",
                                type:"POST",
                                data:{
								   'select': select_val,
								   'content':content_val,
								   'conect':connect_val,
								},
                                success:function(responseText,status,xhr){
								      alert('提交成功!感谢你的宝贵建议');
									  $("#survery-box").addClass("hide");
								},
                                timeout:60*1000,								
							    
							});
						 
						 }
					 }else{
					  errMsg.html("验证码错误"); 
					   changeImg();
					   status=0;
					   return;
					 }
				 },
				 
				 error:function(){
				    errMsg.html("验证码错误"); 
					 changeImg();
					 status=0;
					 return;
				 },
				 timeout:60*1000,
			
			});
			
		    
			
			
			
			
			
			
			
		
		});
		
		
		 
	
	
	});


</script>
<div id="globleParameter" class="hide" context="" stylepath="http://res.vmall.com/20140826/css" scriptpath="http://res.vmall.com/20140826/js" imagepath="http://res.vmall.com/20140826/images" mediapath="http://res.vmall.com/pimages/"></div>
<!--底部 -->

<footer class="footer">
    <!-- 20130902-底部-友情链接-start -->
	<div class="footer-otherLink">
		<p>热门<a href="javascript:void(0)" >华为手机</a>：<a href="javascript:void(0)" target="_blank">华为Mate7</a> | <a href="javascript:void(0)" target="_blank">荣耀3C畅玩版</a> | <a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀6</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀3c</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀畅玩版</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为P7</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀X1</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀3X</a><span style="line-height:1.5;"> | <a href="javascript:void(0)" target="_blank">荣耀平板</a> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀立方</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">荣耀手环</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为麦芒</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为喵王</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为秘盒</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为P6</a><span style="line-height:1.5;"> | </span><a href="javascript:void(0)" target="_blank" style="line-height:1.5;">华为mate2</a><span style="line-height:1.5;"> | </span></p><p><br></p>
	</div>


</footer>



<div id="AutocompleteContainter_d3d73" style="position: absolute; z-index: 9999; top: 93px; left: 556.5px;"><div class="autocomplete-w1"><div class="autocomplete" id="Autocomplete_d3d73" style="display: none; width: 315px; max-height: 400px;"></div></div></div>


</body>
</html>