<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-cn">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>购物车_信源电商商城</title>
<link rel="shortcut icon" href="/vmallshop/Public/Ico/favicon.ico">
<link href="/vmallshop/Public/Css/cart.ec.core.css" rel="stylesheet" type="text/css">
<link href="/vmallshop/Public/Css/cart.main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/vmallshop/Public/Jquery/jquery-1.7.2.js"></script>
</head>
<body class="sc">
<!-- 20130605-qq-彩贝-start -->
<div class="qq-caibei-bar hide" id="caibeiMsg">
	<div class="layout">
		<div class="qq-caibei-bar-tips" id="HeadShow"></div>
		<div class="qq-caibei-bar-userInfo" id="ShowMsg"></div>
	</div>
</div>
<!-- 20130605-qq-彩贝-end -->
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
            <div class="logo"><a href="<?php echo U('Index/index');?>" title="信源电商商城"><img src="/vmallshop/Public/images/newLogo.png" alt="信源电商商城"></a></div>
        </div>
        <div class="fr">
            <!--步骤条-三步骤 -->
            <div class="progress-area progress-area-3">
                <!--我的购物车 -->
                <div style="display: block;" id="progress-cart" class="progress-sc-area hide">我的购物车</div>
                <!--核对订单 -->
                <div id="progress-confirm" class="progress-co-area hide">填写核对订单信息</div>
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
                                	<input id="checkAll-top" class="vam" autocomplete="off" type="checkbox">
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
		</div>
		<!--购物车-商品列表 end -->

        <!--购物车-空数据 --> 
        <div id="cart-empty-msg" class="sc-empty-area">
            亲，您购物车里还没有物品哦，<a href="<?php echo U('Index/index');?>">快去逛逛吧！</a>&nbsp;&nbsp;<span style="color:red"></span>秒后跳转..
        </div>
        <!-- 购物车列表 End-->
    </div>
<script type="text/javascript">
    $(function(){
	
	
	
	   var url="<?php echo U('Index/index');?>";

	   var timer=5;
	   var i = setInterval(function(){
	       timer--;
		   if(timer<=0){
			  clearInterval(i);
		      window.location.href = url;
		   }
	      $("#cart-empty-msg").find('span').html(timer);
	   },1000);
	   

	});
</script>
    <div class="hr-35"></div>
<!--商品删除记录-20121011 -->
    <div style="display: none;" id="pro-recover-area" class="pro-delete-area hide">
    	<div class="h clearfix">
        	<h3>已删除商品</h3>
			<table border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<th class="tr-pro">商品</th>
						<th class="tr-quantity">数量</th>
						<th class="tr-subtotal">小计<em>（元）</em></th>
						<th class="tr-operate">操作</th>
					</tr>
				</tbody>
			</table>
        </div>
        <div class="b">
          <div class="pro-delete-item">
        	<table border="0" cellpadding="0" cellspacing="0">
            	<tbody id="pro-recover-tb"></tbody>
            </table>
          </div>
        </div>
        
        
        <div id="pro-delete-shop-start" class="f button-pro-delete-expand hide"><a href="javascript:;">更多已删除商品<i></i><s></s><b></b></a></div>
        <div id="pro-delete-shop-end" class="f button-pro-delete-shrink hide"><a href="javascript:;">收起已删除商品<i></i><s></s><b></b></a></div>
    </div>
<!--删除记录结束 -->
<div class="hr-25"></div>
<!--热门推荐-20121011 -->
    <div id="pro-recommend-area" class="pro-scroller-area hide">
	   	<div class="h">
        	<h3>您可能感兴趣的商品</h3>
        </div>
        <div class="b">
        	<!--左边滚动按钮className：pro-scroller-back 不可点击className：pro-scroller-back-disabled ；右边滚动按钮className：pro-scroller-forward 不可点击className：pro-scroller-forward-disabled --> 
             <a id="cart-img-prev" class="pro-scroller-back-disabled" href="javascript:;" onclick="ec.cart.slider.prev(this)"></a>
            <div class="pro-list">
            	<!--ul的宽度等于li宽度*N -->
                <ul style="width:1158px;" id="pro-recommend-list"></ul>
            </div>
            <a id="cart-img-next" class="pro-scroller-forward" href="javascript:;" onclick="ec.cart.slider.next(this)"></a>
        </div>
    </div>
<!--热门推荐结束 -->

    <!-- 购物车主体 End　-->
</div>
<div class="hr-75"></div>

<textarea id="product-list-html" class="hide">&lt;!--#macro product-list
 data--&gt;
&lt;!--#var context=data.context--&gt;
&lt;!--#var mediaPath=data.mediaPath--&gt;
&lt;!--#list data.bundlerList as b--&gt;
&lt;div class="sc-pro-area selected" id="order-pro-{#b.bundleId}"&gt;
	&lt;table border="0" cellpadding="0" cellspacing="0"&gt;
		&lt;tbody&gt;
			&lt;!--#var rows=b.skuList.length--&gt;
			&lt;!--#var giftLen=0--&gt;
			&lt;!--#var lst_i=1--&gt;
			&lt;!--#list b.skuList as lst--&gt;
				&lt;!--#if (lst.giftList)--&gt;
					&lt;!--#var giftLen=giftLen+lst.giftList.length--&gt;
				&lt;!--/#if--&gt;
			&lt;!--/#list--&gt;

			&lt;!--#list b.skuList as lst--&gt;			
			&lt;tr class="sc-pro-item"&gt;
				&lt;!--#if (lst_i==1)--&gt;
				&lt;td rowspan="{#rows+giftLen}" class="tr-check"&gt;
					&lt;input id="box-{#b.bundleId}" class="checkbox" type="checkbox" 
name="bundleIds" onclick="ec.shoppingCart.check(this);" 
value="{#b.bundleId}" checked /&gt;
				&lt;/td&gt;
				&lt;!--/#if--&gt;
				
				&lt;td class="tr-pro"&gt;
				&lt;div class="pro-area clearfix" id="skuId-{#lst.skuId}"&gt;
					&lt;p class="p-img"&gt;
					&lt;!--#var skuId='#'+lst.skuId;--&gt;
					&lt;a title="{#lst.prdSkuName?html}" target="_blank" 
href="{#context}/product/{#lst.id}.html{#skuId}" 
seed="cart-item-name"&gt;
						&lt;img alt="{#lst.prdSkuName?html}" 
src="{#mediaPath}{#lst.photoPath}78_78_{#lst.photoName}" /&gt;
					&lt;/a&gt;
					&lt;/p&gt;
					&lt;p class="p-name"&gt;
						&lt;b&gt;[套餐]&lt;/b&gt;
						&lt;a title="{#lst.prdSkuName?html}" target="_blank" 
href="{#context}/product/{#lst.id}.html{#skuId}" 
seed="cart-item-name"&gt;{#lst.prdSkuName?html}&lt;/a&gt;
					&lt;/p&gt;
					&lt;p class="p-sku"&gt;
						&lt;em class="p-spite-sku"&gt;{#lst.skuAttrValues?html}&lt;/em&gt;
					&lt;/p&gt;
					&lt;!--#if (lst.shopName &amp;&amp; lst.shopId != 1)--&gt;
					&lt;p class="p-explain"&gt;此商品由{#lst.shopName?html}发货&lt;/p&gt;
					&lt;!--/#if--&gt;
					&lt;p class="limitstock-{#lst.skuId} hide"&gt;&lt;/p&gt;
					&lt;p class="understock-{#lst.skuId} hide"&gt;&lt;/p&gt;
					&lt;input type="checkbox" name="skuIds" class="hide" 
value="{#lst.skuId}"&gt;
				&lt;/div&gt;
				&lt;/td&gt;

				&lt;td class="tr-price"&gt;
					&lt;s&gt;原价:¥{#lst.skuPrice.toFixed(2)}&lt;/s&gt;
					&lt;span&gt;现价:¥{#lst.preferentialPrice.toFixed(2)}&lt;/span&gt;
				&lt;/td&gt;

				&lt;!--#if (lst_i==1)--&gt;
				&lt;td class="tr-quantity" rowspan="{#rows+giftLen}"&gt;
				&lt;div class="sc-stock-area"&gt;
					&lt;div class="stock-area"&gt;
						&lt;input id="quantity-{#b.bundleId}" type="text" 
class="shop-quantity textbox vam" value="{#b.quantity}" 
data-skuId="{#b.bundleId}" data-type="2" seed="cart-item-num" /&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;/td&gt;
				
				&lt;td rowspan="{#rows+giftLen}" class="tr-subtotal"&gt;
				    &lt;b&gt;¥{#b.totalBundlePrice.toFixed(2)}&lt;/b&gt;
				  	
&lt;span&gt;&lt;i&gt;省&lt;/i&gt;&lt;em&gt;
¥{#b.preferentialPrice.toFixed(2)}&lt;/em&gt;&lt;/span&gt;
				&lt;/td&gt;
				
				&lt;td rowspan="{#rows+giftLen}" class="tr-operate"&gt;
					&lt;a href="javascript:;" class="icon-sc-del" title="删除" 
onclick="ec.shoppingCart.del(this , {#b.bundleId}, 2)" 
seed="cart-item-del"&gt;删除&lt;/a&gt;
				&lt;/td&gt;
				&lt;!--/#if--&gt;
			&lt;/tr&gt;
			&lt;!--#var lst_i=lst_i+1--&gt;
			&lt;!--/#list--&gt;

			&lt;!--#list b.skuList as lst--&gt;
			&lt;!--#if (giftLen &gt; 0)--&gt; 
			&lt;!--#list lst.giftList as gif--&gt;
				&lt;!--#var skuId='#'+gif.skuId;--&gt;
				&lt;tr class="sc-pro-gift-item"&gt;
				  &lt;td class="tr-pro"&gt;
					&lt;div class="pro-area clearfix"&gt;
						&lt;p class="p-img"&gt;
							&lt;a title="{#gif.prdSkuName}" 
href="{#context}/product/{#gif.id}.html{#skuId}"&gt;
								&lt;img alt="{#gif.prdSkuName}" 
src="{#mediaPath}{#gif.photoPath}78_78_{#gif.photoName}" /&gt;
							&lt;/a&gt;
							&lt;input type="checkbox" name="skuIds" class="hide" 
value="{#gif.skuId}"&gt;
						&lt;/p&gt;
						&lt;p class="p-name"&gt;
							&lt;b&gt;[赠品]&lt;/b&gt;
							&lt;a title="{#gif.prdSkuName}" 
href="{#context}/product/{#gif.id}.html{#skuId}"&gt;{#gif.prdSkuName}&lt;/a&gt;

						&lt;/p&gt;
						&lt;p class="understock-{#gif.skuId} hide"&gt;&lt;/p&gt;
					&lt;/div&gt;
				&lt;/td&gt;
				&lt;td class="tr-price"&gt;
					&lt;s&gt;原价:{#gif.skuPrice.toFixed(2)}&lt;/s&gt;
					&lt;span&gt;现价:¥0.00&lt;/span&gt;
				&lt;/td&gt;
				&lt;/tr&gt;
			&lt;!--/#list--&gt;
			&lt;!--/#if--&gt;
			&lt;!--/#list--&gt;
		&lt;/tbody&gt;
	&lt;/table&gt;
&lt;/div&gt;
&lt;!--/#list--&gt;

&lt;!--#list data.productList as lst--&gt;
&lt;!--#var skuId = "#" + lst.skuId; --&gt;
&lt;div class="sc-pro-area selected" id="order-pro-{#lst.skuId}"&gt;
	&lt;table border="0" cellpadding="0" cellspacing="0"&gt;
		&lt;tbody&gt;
			&lt;tr class="sc-pro-item"&gt;
				&lt;td rowspan="{#lst.giftList.length+lst.extendList.length + 
lst.accidentList.length + 1}" class="tr-check"&gt;
					&lt;input id="box-{#lst.skuId}" class="checkbox" type="checkbox" 
name="skuIds" onclick="ec.shoppingCart.check(this);" 
value="{#lst.skuId}" checked /&gt;
				&lt;/td&gt;
				&lt;td class="tr-pro"&gt;
				&lt;div class="pro-area clearfix"&gt;
					&lt;p class="p-img"&gt;
						&lt;a title="{#lst.prdSkuName?html}" target="_blank" 
href="{#context}/product/{#lst.id}.html{#skuId}" 
seed="cart-item-name"&gt;
							&lt;img alt="{#lst.prdSkuName?html}" 
src="{#mediaPath}{#lst.photoPath}78_78_{#lst.photoName}" /&gt;
						&lt;/a&gt;
					&lt;/p&gt;
					&lt;p class="p-name"&gt;
						&lt;a title="{#lst.prdSkuName?html}" target="_blank" 
href="{#context}/product/{#lst.id}.html{#skuId}" 
seed="cart-item-name"&gt;{#lst.prdSkuName?html}&lt;/a&gt;
					&lt;/p&gt;
					&lt;p class="p-sku"&gt;
						&lt;em class="p-spite-sku"&gt;{#lst.skuAttrValues?html}&lt;/em&gt;
					&lt;/p&gt;
					&lt;!--#if (lst.shopName &amp;&amp; lst.shopId != 1)--&gt;
					&lt;p class="p-explain"&gt;此商品由{#lst.shopName?html}发货&lt;/p&gt;
					&lt;!--/#if--&gt;
					&lt;p class="understock-{#lst.skuId} hide"&gt;&lt;/p&gt;
				&lt;/div&gt;
				&lt;/td&gt;
				&lt;td class="tr-price"&gt;
					&lt;!--#if (lst.skuPrice != lst.preferentialPrice)--&gt;
						&lt;s&gt;原价:¥{#lst.skuPrice.toFixed(2)}&lt;/s&gt;
						&lt;span&gt;现价:¥{#lst.preferentialPrice.toFixed(2)}&lt;/span&gt;
					&lt;!--#else--&gt;
						&lt;span&gt;¥{#lst.skuPrice.toFixed(2)}&lt;/span&gt;
					&lt;!--/#if--&gt;
				&lt;/td&gt;
				&lt;td class="tr-quantity" 
rowspan="{#lst.giftList.length+lst.extendList.length + 
lst.accidentList.length + 1}"&gt;
                	&lt;div class="sc-stock-area"&gt;
						&lt;div class="stock-area"&gt;
							&lt;input id="quantity-{#lst.skuId}" type="text" 
class="shop-quantity textbox vam" value="{#lst.quantity}" 
data-skuId="{#lst.skuId}" data-type="{#lst.productType}" 
seed="cart-item-num" /&gt;
						&lt;/div&gt;
						&lt;p class="normalLimitstock-{#lst.skuId} hide"&gt;&lt;/p&gt;
					&lt;/div&gt;
				&lt;/td&gt;
				
				&lt;td rowspan="{#lst.giftList.length + 1}" class="tr-subtotal"&gt;
					&lt;b&gt;¥{#(lst.preferentialPrice * 
lst.quantity).toFixed(2)}&lt;/b&gt;
					&lt;!--#if (lst.skuPrice != lst.preferentialPrice)--&gt;
						&lt;span&gt;&lt;i&gt;省&lt;/i&gt;&lt;em&gt;¥ {#((lst.skuPrice - 
lst.preferentialPrice) * 
lst.quantity).toFixed(2)}&lt;/em&gt;&lt;/span&gt;
					&lt;!--/#if--&gt;		
				&lt;/td&gt;
				&lt;td rowspan="{#lst.giftList.length + 1}" class="tr-operate"&gt;
					&lt;a href="javascript:;" class="icon-sc-del" title="删除" 
onclick="ec.shoppingCart.del(this , {#lst.skuId})" 
seed="cart-item-del"&gt;删除&lt;/a&gt;
				&lt;/td&gt;
			&lt;/tr&gt;
			&lt;!--#list lst.giftList as gif--&gt;
			&lt;!--#var skuId='#'+gif.skuId;--&gt;
			&lt;tr class="sc-pro-gift-item"&gt;
				&lt;td class="tr-pro"&gt;
					&lt;div class="pro-area clearfix"&gt;
						&lt;p class="p-img"&gt;
							&lt;a title="{#gif.prdSkuName}" 
href="{#context}/product/{#gif.id}.html{#skuId}"&gt;
								&lt;img alt="{#gif.prdSkuName}" 
src="{#mediaPath}{#gif.photoPath}78_78_{#gif.photoName}" /&gt;
							&lt;/a&gt;
							&lt;input type="checkbox" name="skuIds" class="hide" 
value="{#gif.skuId}"&gt;
						&lt;/p&gt;
						&lt;p class="p-name"&gt;
							&lt;b&gt;[赠品]&lt;/b&gt;
							&lt;a title="{#gif.prdSkuName}" 
href="{#context}/product/{#gif.id}.html{#skuId}"&gt;{#gif.prdSkuName}&lt;/a&gt;

						&lt;/p&gt;
						&lt;p class="understock-{#gif.skuId} hide"&gt;&lt;/p&gt;
					&lt;/div&gt;
				&lt;/td&gt;
				&lt;!--td class="tr-span-3"&gt;{#lst.quantity * gif.quantity}&lt;p 
class="limitstock-{#gif.skuId} hide"&gt;&lt;/p&gt;&lt;/td--&gt;
				&lt;td class="tr-price"&gt;
					&lt;s&gt;原价:¥{#gif.skuPrice.toFixed(2)}&lt;/s&gt;
					&lt;span&gt;现价:¥0.00&lt;/span&gt;
				&lt;/td&gt;
			&lt;/tr&gt;
			&lt;!--/#list--&gt;
			&lt;!--#if (lst.extendList)--&gt;
			&lt;!--#list lst.extendList as yb--&gt;
			&lt;!--#var ybSkuId='#'+yb.skuId;--&gt;
			&lt;tr class="sc-pro-gift-item"&gt;
				&lt;td class="tr-pro"&gt;
					&lt;div class="pro-area clearfix"&gt;
						&lt;p class="p-img"&gt;
							&lt;a title="{#yb.prdSkuName}" target="_blank" 
href="{#context}/product/{#yb.id}.html{#ybSkuId}"&gt;
								&lt;img alt="{#yb.prdSkuName}" 
src="{#mediaPath}{#yb.photoPath}78_78_{#yb.photoName}" /&gt;
							&lt;/a&gt;
						&lt;/p&gt;
						&lt;p class="p-name"&gt;
							&lt;b&gt;[延保]&lt;/b&gt;
							&lt;a title="{#yb.prdSkuName}" target="_blank" 
href="{#context}/product/{#yb.id}.html{#ybSkuId}"&gt;{#yb.prdSkuName}&lt;/a&gt;

						&lt;/p&gt;
						&lt;p class="p-sku"&gt;&lt;em&gt;&lt;/em&gt;&lt;/p&gt;
						&lt;input type="checkbox" name="extendIds" class="hide" 
value="{#yb.skuId}"&gt;
					&lt;/div&gt;
				&lt;/td&gt;
				&lt;!--td class="tr-span-3"&gt;{#yb.quantity}&lt;/td--&gt;
				&lt;td class="tr-price"&gt;
					&lt;s&gt;原价:¥{#yb.skuPrice.toFixed(2)}&lt;/s&gt;
					&lt;span&gt;现价:¥{#yb.skuPrice.toFixed(2)}&lt;/span&gt;
				&lt;/td&gt;
				&lt;td class="tr-subtotal"&gt;&lt;b&gt;¥{#(yb.skuPrice * 
lst.quantity).toFixed(2)}&lt;/b&gt;&lt;/td&gt;
				&lt;td class="tr-operate"&gt;
					&lt;a href="javascript:;" class="icon-sc-del" title="删除" 
onclick="ec.shoppingCart.del(this, {#yb.skuId}, 6, {#yb.mainSkuId})" 
seed="cart-item-del"&gt;删除&lt;/a&gt;
				&lt;/td&gt;
			&lt;/tr&gt;
			&lt;!--/#list--&gt;
			&lt;!--/#if--&gt;
			&lt;!--#if (lst.accidentList)--&gt;
			&lt;!--#list lst.accidentList as ya--&gt;
			&lt;!--#var yaSkuId='#'+ya.skuId;--&gt;
			&lt;tr class="sc-pro-gift-item"&gt;
				&lt;td class="tr-pro"&gt;
					&lt;div class="pro-area clearfix"&gt;
						&lt;p class="p-img"&gt;
							&lt;a title="{#ya.prdSkuName}" target="_blank" 
href="{#context}/product/{#ya.id}.html{#yaSkuId}"&gt;
								&lt;img alt="{#ya.prdSkuName}" 
src="{#mediaPath}{#ya.photoPath}78_78_{#ya.photoName}" /&gt;
							&lt;/a&gt;
						&lt;/p&gt;
						&lt;p class="p-name"&gt;
							&lt;b&gt;[意外保]&lt;/b&gt;
							&lt;a title="{#ya.prdSkuName}" target="_blank" 
href="{#context}/product/{#ya.id}.html{#yaSkuId}"&gt;{#ya.prdSkuName}&lt;/a&gt;

						&lt;/p&gt;
						&lt;p class="p-sku"&gt;&lt;em&gt;&lt;/em&gt;&lt;/p&gt;
						&lt;input type="checkbox" name="accidentIds" class="hide" 
value="{#ya.skuId}"&gt;
					&lt;/div&gt;
				&lt;/td&gt;
				&lt;!--td class="tr-span-3"&gt;{#ya.quantity}&lt;/td--&gt;
				&lt;td class="tr-price"&gt;
					&lt;s&gt;原价:¥{#ya.skuPrice.toFixed(2)}&lt;/s&gt;
					&lt;span&gt;现价:¥{#ya.skuPrice.toFixed(2)}&lt;/span&gt;
				&lt;/td&gt;
				&lt;td class="tr-subtotal"&gt;&lt;b&gt;¥{#(ya.skuPrice * 
lst.quantity).toFixed(2)}&lt;/b&gt;&lt;/td&gt;
				&lt;td class="tr-operate"&gt;
					&lt;a href="javascript:;" class="icon-sc-del" title="删除" 
onclick="ec.shoppingCart.del(this, {#ya.skuId}, 7, {#ya.mainSkuId})" 
seed="cart-item-del"&gt;删除&lt;/a&gt;
				&lt;/td&gt;
			&lt;/tr&gt;
			&lt;!--/#list--&gt;
			&lt;!--/#if--&gt;
		&lt;/tbody&gt;
	&lt;/table&gt;
&lt;/div&gt;
&lt;!--/#list--&gt;
&lt;!--/#macro--&gt;
</textarea>

<!--口号-20121025 -->
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
  <!-- footer end--></body></html>