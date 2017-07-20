<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>确认订单_华为商城</title>
<link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico" />
<link href="/vmallshop/Public/Css/cart.ec.core.css" rel="stylesheet" type="text/css">
<link href="/vmallshop/Public/Css/cart.main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>

<!------------------引入jquery插件------------------------->

<style type="text/css">
  #select_express{
      width:148px;
	  height:23px;
	  border-color:rgb(204,204,204);
	  color:#727272;
	 
  
  }

</style>
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
                <div id="progress-cart" class="progress-sc-area hide">我的购物车</div>
                <!--核对订单 -->
                <div id="progress-confirm" class="progress-co-area hide" style="display:block;">填写核对订单信息</div>
                <!--成功提交订单 -->
                <div id="progress-submit" class="progress-sso-area hide">成功提交订单</div>
            </div>
        </div>
    </div>
</div>
<div class="g order"> 
    <!--栏目 -->
    <!--订单-表单 -->
    <div class="order-form-area">
		<!--订单-表单-地址-20121012 -->
    	<div class="order-address" id="order-address-mod">
            <h3 class="title">收货人信息</h3>
            <!--地址信息-20121012 -->
		
           	<div  class="order-address-detail-area hide"  id="address-default-info"  style="display: block;">
				<div  class="form-detail-area">
				  
				 <table  cellspacing="0"  cellpadding="0"  border="0"><tbody>
					 <tr></php>
						 <th>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</th><td><?php echo ($default_address["address_name"]); ?></td>
					</tr>
					 <tr>
						 <th>收货地址：</th><td><?php echo ($default_address["address_content"]); ?></td>
					</tr>
					<tr>
					   <th>邮政编码：</th><td><?php echo ($default_address["address_post"]); ?></td>
					</tr>
					<tr>
						 <th>手机号码：</th>
						 <td><?php echo ($default_address["address_phone"]); ?></td>
					</tr>
					</tbody>
					</table>
					<p>
					<a  href="javascript:;"  class="icon-edit fcn"  title="选择其他收货地址"  id="select_other_address">
					选择其他收货地址&nbsp;</a><a href="<?php echo U('PersonCenter/address');?>" style="color:blue;">去添加新地址</a>
                    <div id="other_address" display="bolck">
                       <form action="<?php echo U('Createcart/index');?>" method="POST">
					    <?php if(is_array($auto_address)): $i = 0; $__LIST__ = $auto_address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><table  cellspacing="0"  cellpadding="0"  border="0" style="display:inline-block;"><tbody>
							 <tr>
								 <th><input type='checkbox' name='other_address' checked=false value="<?php echo ($vo["address_id"]); ?>">&nbsp;&nbsp;收&nbsp;&nbsp;货&nbsp;&nbsp;人：</th><td><?php echo ($vo["address_name"]); ?></td>
							  </tr>
							  <tr>
								 <th>收货地址：</th><td><?php echo ($vo["address_content"]); ?></td>
							  </tr>
							  <tr>
							   <th>邮政编码：</th><td><?php echo ($vo["address_post"]); ?></td>
							  </tr>
							  <tr>
								 <th>手机号码：</th>
								 <td><?php echo ($vo["address_phone"]); ?></td>
							  </tr>
							  </tbody>
							  </table><?php endforeach; endif; else: echo "" ;endif; ?>  
							 
						 
						 
						 </form>

                     </div>					
				</div>
		    </div>
			
       </div>
<script type="text/javascript" src="/vmallshop/Public/Js/jquery.cookie.js"></script>
<script type="text/javascript">
    $(function(){
	    
		$("#other_address").hide();
		$("#other_address").find("input[type=checkbox]").prop('checked',false);
		$("#select_other_address").toggle(function(){
		   $("#other_address").show();
		},function(){
		   $("#other_address").hide();
		
		});
	    var address_checkbox=$("#other_address").find("input[type=checkbox]");
		address_checkbox.click(function(){
		      $(this).prop('checked',true);
			  var address_id=$(this).val();
			     //把更改地址写入到cookie中去
				//s alert(address_id);
			 
		      $.cookie('address_id',address_id,{expires:7,path:'/'});
			  address_checkbox.not($(this)).prop("checked",false);
			
		
		});
	
	
	
	
	
	
	
	});

</script>
		
        <div class="order-delivery">
        	<h3 class="title">配送方式</h3>
            <div class="order-form-tips" id="order-delivery-tips"><p>默认选择顺风快递，若顺风不能到达,选择其他快递</p><s></s><b></b></div>
            <ul class="order-delivery-list" id="order-delivery-list">
            </ul>
        </div>
		
		
		
        <div class="order-coupon">
        	
            
		
        
    <!--购物车 -->
	<h3 class="title">商品清单 <em></em></h3>
    <div class="sc-area">
        <div class="order-pro-list" id="order-pro-list">
			<!--订单-商品-标题 -->
            <div class="order-pro-title-area">
                <div class="b">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>商品</th>
                                <th class="tr-span-3">单价<em>/元</em></th>
                                <th class="tr-span-3">数量</th>
                                <th class="tr-span-4">小计<em>/元</em></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
			<!--订单-商品-套餐-->	
		
			<!----------------------------遍历页------------------------------------>
			<?php if(is_array($new_car)): $i = 0; $__LIST__ = $new_car;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="order-pro-area">
				<table border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td class="tal">
								<ul class="pro-area-2">
									<li><a href=""><?php echo ($vo["goods_name"]); ?></a></li>
								</ul>
							</td>							
							<td class="tr-span-3">&yen;<?php echo (number_format($vo["goods_original_price"],2)); ?></td>
							<td class="tr-span-3"><?php echo ($vo["goods_num"]); ?></td>
							<td rowspan="4" class="tr-span-4"><p class="bold">&yen;<?php echo (number_format($vo["goods_total_money"],2)); ?></p></td>
						</tr>
					</tbody>
				</table>
				
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		   <!----------------------------遍历页------------------------------------>
        </div>     
       
        <!--总计 -->
        <div class="total-area clearfix">
            <div class="total-line-2"></div>
             <!--订单-费用-->
            <div class="order-cost-area">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="tal"></td>
                            <td class="tar">商品金额总计：&yen;<em id="order-cost-area" data-oldval=" 1299.00"><?php echo ($total_money); ?></em></td>
                        </tr>
                        <tr>
                            <td class="tal"></td>
                            <td class="tar">
                            	运费：<em id="order-deliveryCharge">&yen; <span><?php echo ($express_money); ?><span></em>
                            </td>
                        </tr>
                        <tr>
                            <td class="tal">
                               
                            </td>
                            <td class="tar">
                            	优惠金额：<em>- &yen; 
                                <span id="order-discountTotalPrice" data-oldVal="0.00"><?php echo ($total_sale_money); ?></span></em>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="total-left-area clearfix">

                <div class="fl order-sp-area">
                </div>    
               
                <div class="fr">
                    <em>包裹合计（含运费）</em>
                    <b>&yen;</b> <b id="order-price" class="total" data-oldval="1299.00"><?php echo ($end_money); ?></b>
                </div>
            </div>
        </div>
        <div class="hr-30"></div>
        <div class="order-action-area tar">
            <a href="<?php echo U('Createcart/index');?>"  class="button-style-1 button-submit-order " title="提交订单" seed="checkout-submit"><span>提交订单</span></a>
        </div>
    </div>
</div>
<div class="hr-60"></div>


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