<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>购物车_华为商城</title>
<link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico"/>
<link href="/vmallshop/Public/Css/cart.ec.core.css" rel="stylesheet" type="text/css">
<link href="/vmallshop/Public/Css/cart.main.css"  rel="stylesheet" type="text/css">

<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
</head>
<body>
<!-- 捷径栏 -->

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

<!--头部 -->
<div class="order-header">
	<div class="g">
    	<div class="fl">
            <div class="logo"><a href=""><img src="/vmallshop/Public/images/newLogo.png" /></a></div>
        </div>
        <div class="fr">
            <!--步骤条-三步骤 -->
            <div class="progress-area progress-area-3">
                <!--我的购物车 -->
                <div id="progress-cart" class="progress-sc-area hide" style="display:block;">我的购物车</div>
                <!--核对订单 -->
                <div id="progress-confirm" class="progress-co-area hide" >填写核对订单信息</div>
                <!--成功提交订单 -->
                <div id="progress-submit" class="progress-sso-area hide">成功提交订单</div>
            </div>
        </div>
    </div>
</div>
<div class="layout">
    <!-- 20131223-购物车-start -->
    <div class="sc-list">
    	<!-- 20131223-购物车-商品列表-start -->
		    	<div class="sc-pro-list">
            <!-- 20131223-订单-商品-标题-start -->
            <div class="sc-pro-title-area">
                <div class="h">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="tr-check">
                                	
                                </th>
                                <th class="tr-pro">商品</th>
                                <th class="tr-price">单价<em>（元）</em></th>
                                <th class="tr-quantity">数量</th>
                                <th class="tr-subtotal">小计<em>（元）</em></th>
                                <th class="tr-operate">操作</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- 20131223-订单-商品-标题-end -->

		<form id="cart-form" autocomplete="off" onsubmit="return false;" >
			
			<span id="cart-list"><!--product-list start-->
			  
				<div class="sc-pro-area selected" id="order-pro-1989">
					<table border="0" cellpadding="0" cellspacing="0">
						
						   <!--------------------这是一个商品的信息-------------------------------->
							
						 <!--------------------这是一个商品的信息-------------------------------->
					
					</table>
				</div><!--product-list end-->
				
<script type="text/javascript">
  //ajax的形式获取购物车中的数据
  $(function(){
     
	 
	 
	  doCar();
	 function doCar(){
	   
	     var url="<?php echo U('Cart/error');?>";
	     $.ajax({
		     url:"<?php echo U('Cart/cartContent');?>",
			 type:'GET',
			 dataType:'json',
			 success:function(responseText,status,xhr){
			     if(status=="success"){
				     if(responseText.cat_status==1){
					     $("#order-pro-1989").find('table').html(responseText.content.str);
						 $("#sc-cartInfo-totalOriginalPrice").find('span').html(responseText.content.car_total_money.toFixed(2));
						 $("#sc-cartInfo-minusPrice").find('span').html(responseText.content.car_sale_money.toFixed(2));
						 $("#sc-cartInfo-totalPrice").find('span').html(responseText.content.car_end_money.toFixed(2));
						 
					 }else{
					   window.location.href=url;
					 }
				 }else{
				    window.location.href=url;
				 }
			 },
			 error:function(){
			    alert('加载失败,请重试');
			 
			 },
			 
			 timeout:60*1000,
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 });
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 }
  
  
  
  
  
  
  
  
  
  
  });


</script>				
<script type="text/javascript">
	  $(function(){
		   //+
		   
		    $("#order-pro-1989").on("click",'.icon-minus-3',function(){
			     var goods_id=$(this).closest('td').parent().find("#box-1989").val();
				
				 
			      var input=$(this).next('input');
				 
				 input.val(function(i,v){
				    
				     return v<=1?1:--v;
				 
				 });
				  var value=input.val();
				  if(value>=0&&value<=10){
				  
				     doAjax(goods_id,value);
				  
				  }
			
			
			
			});
			
			
		    $("#order-pro-1989").on("click",'.icon-plus-3',function(){
			     var goods_id=$(this).closest('td').parent().find("#box-1989").val();
			     var input=$(this).prev('input');
				
				 input.val(function(i,v){
				    
				     return v>9?10:++v;
					 
				 
				 });
				 
				 var value=input.val();
				 if(value>=0&&value<=10){
				      doAjax(goods_id,value);
				 }
			
			
			
			});
			
		 function doAjax(goods_id,num){
		         $.ajax({
				      url:"<?php echo U('Cart/changeGoodsNum');?>",
					  type:"POST",
					  data:{
					      'goods_id':goods_id,
						  'goods_num':num
					  },
				      success: function(responseText,status,xhr){
					        if(status=="success"){
							     doCar();
							}else{
							   alert("修改失败");
							}
					  
					  },
					  error:function(){
					      alert("修改失败!");
					  
					  },
					  
					  timeout:60*1000,
					  
				  
				  
				  
				  });
		 
		 
		 
		 
		 }
		   
		 function doCar(){
	   
	     var url="<?php echo U('Cart/error');?>";
	     $.ajax({
		     url:"<?php echo U('Cart/cartContent');?>",
			 type:'GET',
			 dataType:'json',
			 success:function(responseText,status,xhr){
			     if(status=="success"){
				     if(responseText.cat_status==1){
					     $("#order-pro-1989").find('table').html(responseText.content.str);
						 $("#sc-cartInfo-totalOriginalPrice").find('span').html(responseText.content.car_total_money.toFixed(2));
						 $("#sc-cartInfo-minusPrice").find('span').html(responseText.content.car_sale_money.toFixed(2));
						 $("#sc-cartInfo-totalPrice").find('span').html(responseText.content.car_end_money.toFixed(2));
						 
					 }else{
					   window.location.href=url;
					 }
				 }else{
				    window.location.href=url;
				 }
			 },
			 error:function(){
			    alert('加载失败,请重试');
			 
			 },
			 
			 timeout:60*1000,
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 });
	  }
		    
	  $("#order-pro-1989").on('click','.icon-sc-del',function(){
	         var goods_id=$(this).closest('td').parent().find("#box-1989").val();
			 var url="<?php echo U('Cart/error');?>";
			 $.ajax({
			     url:"<?php echo U('Cart/carDel');?>",
			     type:"POST",
				 data:{
				      'goods_id':goods_id,
				 },
			     success:function(responseText,status,xhr){
				     if(status=='success'){
					     if(responseText=='1'){
						      var trs=$(this).closest('td').parent().children('tr').size();
						      if(trs<1){
							      doCar();
							  }
						 }else{
						     alert('删失败!');
						 }
					 
					 }else{
					    alert('删失败!');
					 }
				 
				 },
				 
				 error:function(){
				      alert("删除失败");
				 
				 },
				 timeout:60*1000,
			 
			 
			 });
	  
	  
	  
	  
	  
	  });	  
	
      //删除操作按钮点选	
		 $("#checkAll-buttom").click(function(){
		     var delStatus=$(this).prop('checked')?1:0;
			 if(delStatus){
			     $(".checkbox").prop('checked',true);
			 
			 }else{
			     $('.checkbox').prop('checked',false);
			 
			 }
		 
		 });
		
		 $("#cart-all-del").click(function(){
		     
		     var goods_select_ids=$(".checkbox:checked").size();
			 var goods_ids="";
		     if(goods_select_ids>0){
			     $(".checkbox:checked").each(function(i,v){
				     goods_ids+=","+$(this).val();
				  
				 });
			  
			   
			  //ajax执行删除操作
			 var url="<?php echo U('Cart/error');?>";
			 $.ajax({
			      url:"<?php echo U('Cart/carDelAll');?>",
				  type:"POST",
				  data:{
				      "goods_ids":goods_ids,
				  },
				  success:function(responseText,status,xhr){
				      if(status=="success"){
					     if(responseText==1){
						      doCar();
						     var trs=$("#order-pro-1989").find('table').find('tr').size();
							 if(trs>0){
							    
							 }else{
							     window.location.href=url;
							 }
						 
						 }else{
						 
						      alert("删除失败");
						 }
					  
					  
					  }else{
					     alert("删除失败!");
					  
					  }
				  
				  },
				  error:function(){
				      alert("删除失败!");
				  },
				  timeout:60*1000,
			      
			 
			 
			 });
			 
			 }
			 
			 
		  
		 
		 
		 
		 
		 });
	  
	      
	  
	  
	  });


</script>					  
					
			</span>
		</form>
	</div>
	<div class="hr-20"></div>
		<!--购物车-商品列表 end -->

        <!-- 购物车列表 End-->
    </div>
	<div class="hr-25"></div>
	<div class="sc-total-area clearfix" id="cart-total-area">
		<div class="sc-total-control">
			<input type="checkbox"  autocomplete="off" class="vam" name="" id="checkAll-buttom">
			<label for="checkAll-buttom" class="vam">全选</label>
			<a seed="cart-all-del" href="javascript:void(0);" id="cart-all-del" class="vam" >删除选中商品</a>
		</div>
		<div class="sc-total-price">
			<table cellspacing="0" cellpadding="0" border="0">
				<tbody>
					<tr>
						<th>总计金额：</th>
						<td id="sc-cartInfo-totalOriginalPrice">¥<span>00.00</span></td>
					</tr>
					<tr>
						<th>共节省：</th>
						<td id="sc-cartInfo-minusPrice">¥<span>00.00</span></td>
					</tr>
					<tr>
						<th><em>合计(不含运费)：<em></em></em></th>
						<td><b id="sc-cartInfo-totalPrice">¥<span>00.00</span><b></b></b></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="hr-25"></div>
	<div class="sc-action-area clearfix">
		<a class="button-style-4 button-go-shopping-3" href="<?php echo U('Index/index');?>">继续购物</a>
		<a class="button-style-1 button-go-checkout-2" href="<?php echo U('Confirmcart/index');?>" seed="cart-pay">去结算</a>
		<div class="sc-action-tips hide" id="sc-action-tips"><div class="tips-style-1 tips-area"><i></i><div class="tips-text"><p id="tips-text-p">购物车中有库存不足商品，请处理后结算</p></div><s></s></div>
		</div>
	</div>
	
    <div class="hr-35"></div>



<!--口号-20121025 -->

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