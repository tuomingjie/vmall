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
	<link rel="stylesheet" href="/vmallshop/Public/home/css/index.css">
	<script type="text/javascript" src="/vmallshop/Public/home/js/ss.js"></script>
</head>
<body>
  <style>
	.minicart-pro-item {
		
		padding: 0 15px 15px;
		margin-top: 15px;
		vertical-align: top;
	}
	.p-img {
		border: 1px solid #DDD;
		float: left;
		width: 60px;
		margin-left:7px;
	}
	.p-name {
		float: left;
		width: 135px;
		padding-left: 12px;
	}
	.p-price {
		float: left;
		width: 100px;
		padding-left: 10px;
	}
	.p-price b {
		color: #e01d20;
	}
	.p-price em {
		color: #9c9590;
		margin: 0 7px;
	}
	.p-price span {
		color: #9c9590;
	}
	.icon-minicart-del {
		display: inline-block;
		width: 15px;
		height: 15px;
		border-radius: 2px;
		font-size: 1px;
		line-height: 1px;
		background-position: -35px -43px;
		text-indent: 100%;
		white-space: nowrap;
		overflow: hidden;
		margin-top: 22px;
		float: right;
	}
	.icon-minicart-del:hover {
		background-color: #e5393c;
		background-position: -52px -43px;
	}
	.icon-minicart-del {
		margin-top: 22px;
		float: right;
		background: transparent url(/vmallshop/Public/Images/icon1.png) scroll no-repeat;
		background-position: -35px -43px;
	}
	.minicart-pro-settleup {
		background-color: #fbfaf9;
		position: relative;
		height: 50px;
		padding-top: 5px;
		margin-top:5px;
	}
	.minicart-pro-settleup p {
		color: #75706c;
		height: 22px;
		padding-left: 22px;
	}
	.minicart-pro-settleup em {
		font-weight: 700;
		color: #e5393c;
		margin: 0 6px;
	}
	.minicart-pro-settleup b {
		font-size: 15px;
		color: #e5393c;
		margin-left: 6px;
		position: relative;
		top: 1px;
	}
	.button-minicart-settleup {
		color: #FFF !important;
		font-size: 16px;
		font-family: \5FAE\8F6F\96C5\9ED1;
		border: 1px solid #b3131a;
		background-color: #d81b24;
		border-radius: 3px;
		position: absolute;
		padding: 0 11px;
		height: 35px;
		text-align: center;
		line-height: 33px;
		
		top: 19px;
		right: 17px;
	}
	
</style>
<div class="header">
    <div class="head-top">
      <div class="yzbody clearfix">
          <div class="head-top-l">
              <div class="fl">欢迎光临<?php echo ($set_info[0]['set_content']); ?>！</div>
              <div class="link">
                <a href="<?php echo U('Index/index');?>" class="ico_sy">首页</a>
				<?php if($_SESSION['user_id']== ''): ?><span>|</span>
					<a href="<?php echo U('Login/index');?>">登录</a>
					<span>|</span>
					<a href="<?php echo U('Sign/index');?>">免费注册</a>
					<?php else: ?>
					<span>|</span>
					<a href="<?php echo U('Member/index');?>"><?php echo ($_SESSION['user_info']['user_name']); ?></a>
					<span>|</span>
					<a href="<?php echo U('Login/quit');?>">退出</a><?php endif; ?>
              </div>
          </div>
		  
          <div class="head-top-r">
              <ul>
                  <li><a href="<?php echo U('OrderCenter/index');?>"><img src="/vmallshop/Public/Home/images/ico_dd.png" class="order">我的订单</a></li>
                  <li>|</li>
                  <li class="head-memu cart-menu">
                      <a class="tit cart-a head-memu-a" href="<?php echo U('Cart/index');?>">购物车</a>
                      <div class="subnav cart-b">
                          <div class="catr-no" style="display:block;">暂时没有商品</div>
						  
						  
						
						  <!---购物车信息-->
						<div style="display:none;" id="minicart-pro-list-block">
							<ul class="minicart-pro-list" id="minicart-pro-list">
								<li class="minicart-pro-item">
									<div class="pro-info">
										<div class="p-img">
											<a href="/vmallshop2/index.php/Home/Product/index/g/13.html" title="信源电商P7" target="_blank">
												<img src="/vmallshop/Upload/goods/20140911085711/60_60_5410f367c7bbd.jpg" alt="{title}">
											</a>
										</div>
										<div class="p-name">
											<a href="/vmallshop2/index.php/Home/Product/index/g/13.html" title="信源电商P7" target="_blank">信源电商P7&nbsp;<span class="p-slogan"></span><span class="p-promotions hide"></span>
											</a>
										</div>
										<div class="p-price"><b>¥&nbsp;12.00</b><em>x</em><span>1</span></div>
										<a href="javascript:;" class="icon-minicart-del" title="删除">删除</a>
										<input type="hidden" name="cart_id" value="13">
									</div>
								</li>
							</ul>
							<div style="clear:both;"></div>
							<div style="" class="minicart-pro-settleup" id="minicart-pro-settleup">
								<p>共<em id="micro-cart-total">1</em>件商品</p>
								<p>共计<b id="micro-cart-totalPrice">¥&nbsp;<span>12.00</span></b></p>
								<a class="button-minicart-settleup" href="/vmallshop2/index.php/Home/Cart/index.html">去结算</a>
							</div>  
						</div>
						
						  <!---购物车信息-->
						  
						  
						  
						  
						  
						  
                      </div>
                  </li>
                  <li>|</li>
                  <li class="head-memu">
                      <a href="" class="tit">我的收藏<span class="drop-img"><img src="/vmallshop/Public/Home/images/drop.png"></span></a>
                      <div class="subnav nav_a">
                          <p><a href="#">申请退款</a></p>
                          <p><a href="#">申请退换货</a></p>
                          <p><a href="#">查看美团劵</a></p>
                          <p><a href="#">换绑手机号</a></p>
                          <p><a href="#">常见问题</a></p>
                      </div>
                  </li>
                  <li>|</li>
                  <li class="head-memu">
                      <a href="" class="tit">我的浏览<span class="drop-img"><img src="/vmallshop/Public/Home/images/drop.png"></span></a>
                      <div class="subnav nav_a">
                          <p><a href="#">申请退款</a></p>
                          <p><a href="#">申请退换货</a></p>
                          <p><a href="#">查看美团劵</a></p>
                          <p><a href="#">换绑手机号</a></p>
                          <p><a href="#">常见问题</a></p>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
    </div>
    <div class="head-box">
        <div class="l-logo">
            <a href="<?php echo U('Index/index');?>" class="logo"><img src="/vmallshop/Upload<?php echo ($set_info[4]['set_content']); ?>"></a>
            <div class="logo-text">
                <p>中国邮政信源</p>
                <p>电商产品直采平台</p>
            </div>
        </div>
        <div class="searchBar">
            <div class="searchBar-form">
                <form  method="get"  action="" onsubmit="return false;">
                      <input type="text"   placeholder="请输入搜索关键字" class="inp_srh"   id="search_kw"/>
                      <input type="submit"  value="搜索" class="btn_srh" id="submit_go"  />
                </form>
            </div>
            <div class="searchBar-key">
                <a href="<?php echo U('Search/index');?>?keywords='明信片'">明信片</a>
                <a href="<?php echo U('Search/index');?>?keywords='年历'">年历</a>
                <a href="<?php echo U('Search/index');?>?keywords='年历'">年历</a>
                <a href="<?php echo U('Search/index');?>?keywords='明信片'">明信片</a>
                <a href="<?php echo U('Search/index');?>?keywords='年历'">年历</a>
                <a href="<?php echo U('Search/index');?>?keywords='年历'">年历</a>
            </div>
        </div>
        <div class="head-cart-r">
            <a href="<?php echo U('Cart/index');?>">
                <h3 class="cart-num">0</h3>
                <p>我的购物车</p>
            </a>
        </div>
    </div>
    <div class="header_nav">
        <div class="yzbody clearfix">
            <div class="nav-all">
                <div class="mod_cate_hd">全部商品分类</div>
                <div class="category-list none">
                     <ul>
						<?php if(is_array($category_info)): foreach($category_info as $k1=>$v1): ?><li>
                              <h3><a href=""><i class="bg0<?php echo ($k1+1); ?>"></i><span><?php echo ($v1["category_name"]); ?></span></a></h3>
                              <div class="nav">
								<?php if(is_array($v1["children"])): foreach($v1["children"] as $k2=>$v2): if($k2 < 3 ): ?><a href=""><?php echo ($v2["category_name"]); ?></a><?php endif; endforeach; endif; ?>  
                              </div>
                          </li><?php endforeach; endif; ?>  
                     </ul>
                </div>
            </div>
            <div class="nav-list">
                <ul>
                    <li><a href="">首页</a></li>
                    <li><a href="">品牌专区</a></li>
                    <li><a href="">公司介绍</a></li>
                </ul>
            </div>
        </div>
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
				 $(".cart-num").html(responseText.content.total_nums);
				 $(".catr-no").hide();
				 $("#minicart-pro-list-block").show();
				 $("#minicart-pro-list-block #minicart-pro-list").html(responseText.info);
				 $("#minicart-pro-settleup").show();
				 $("#minicart-pro-settleup #micro-cart-total").html(responseText.content.total_nums);
				 $("#minicart-pro-settleup #micro-cart-totalPrice").find('span').html(responseText.content.total_price.toFixed(2));
				 
			 }else{
			  $(".cart-num").html('0');
			  $("#minicart-pro-list-block").hide();
			  $("#minicart-pro-settleup").hide();
			  $(".catr-no").show();
			 
			 }
		 
		 }else{
		  $(".cart-num").html('0');
		  $("#minicart-pro-list-block").hide();
		  $("#minicart-pro-settleup").hide();
		  $(".catr-no").show();
		 
		 }
	   
	 },
	 error:function(){
		 $(".cart-num").html('0');
		 $("#minicart-pro-list-block").hide();
		 $("#minicart-pro-settleup").hide();
		 $(".catr-no").show();
	 },
	 timeout:60*1000,

 });
 
 
  //事件委托的形式添加事件

$("#minicart-pro-list").on('click',".icon-minicart-del",function(){
      var cart_id=$(this).next('input').val();
	  var parent_li=$(this).closest('li');
	    //ajax的形式删除元素
	  $.ajax({
	     url:"<?php echo U('SmallCat/delGoods');?>",
		 type:'POST',
		 data:{
		    'cart_id':cart_id,
		 },
		 dataType:'json',
		 success:function(responseText,status,xhr){
		     if(status=='success'){
			      //返回1 说明session 中删除成功!
			     if(responseText.del_status==1){
				    
					    //删除此条信息
					   
					  parent_li.remove();
					   //修改金额和总数量
					  $(".cart-num").html(responseText.total_num);
					  $("#minicart-pro-settleup #micro-cart-total").html(responseText.total_num);
					   $("#minicart-pro-settleup #micro-cart-totalPrice").find('span').html(responseText.total_money.toFixed(2));
	                 var lis=$("#minicart-pro-list li").size();
					 
					 if(lis<=0){
					   $(".cart-num").html('0');
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
 
 
 

}



</script>
  <div class="barner-box">
    <div class="flexslider">
      <ul class="slides">  
		<?php if(is_array($ad_info)): foreach($ad_info as $k=>$vo): if($k < 3 ): ?><li style="background:url(/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>) 50% 0 no-repeat;"><a href="#"></a></li><?php endif; endforeach; endif; ?>
      </ul>
    </div>
    <div class="user-info-bd">
        <div class="user-info-box">
          <div class="top-pic">
            <a href="" class="user-pic"><img src="/vmallshop/Public/Home/images/user.png"></a>
           </div>
           <div class="welcome">hi,欢迎登录邮乐印平台！</div>
           <a href="" class="login-btn">登录</a>
        </div>
        <div class="user-info-nav">
            <h3>快捷入口</h3>
            <ul class="k-list">
                <li>
                    <a href="">
                        <i><img src="/vmallshop/Public/Home/images/k_ico01.png"></i>
                        <p>我的浏览</p>
                    </a>
                </li>
                <li style="background: none;">
                    <a href="">
                        <i><img src="/vmallshop/Public/Home/images/k_ico02.png"></i>
                        <p>我的收藏</p>
                    </a>
                </li>
                <li style="border-bottom: none;">
                    <a href="">
                        <i><img src="/vmallshop/Public/Home/images/k_ico03.png"></i>
                        <p>我的订单</p>
                    </a>
                </li>
                <li style="border: none;background: none;">
                    <a href="">
                        <i><img src="/vmallshop/Public/Home/images/k_ico04.png"></i>
                        <p>我的分享</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- banner end -->
  </div>
  <div class="inx-content-bd">
    <div class="yz-content">
      <div class="w1200 clearfix">
          <div class="inx-hot-pro">
              <div class="hot-pro-l">
                <div class="top-head">
                  <a href="">
                    <span>信源热销产品</span>
                    <i><img src="/vmallshop/Public/Home/images/hot.png"></i>
                  </a>
                </div>
                <div class="f-box">
                    <h3><a href="<?php echo U('Product/index',array('g'=>$topHot[0]['goods_id']));?>"><?php echo ($topHot[0]['index_sale_title']); ?></a></h3>
                    <div class="pro">
                        <div class="text"><?php echo ($topHot[0]['index_sale_keywords']); ?></div>
                        <div class="img"><img src="/vmallshop/Upload<?php echo ($topHot[0]['index_sale_img']); ?>"></div>
                    </div>
                </div>
              </div>
              <div class="hot-pro-r">
                  <ul>
                      <li>
                          <div class="info">
                              <h3><a href="<?php echo U('Product/index',array('g'=>$topHot[1]['goods_id']));?>"><?php echo ($topHot[1]['index_sale_title']); ?></a></h3>
                              <a href="<?php echo U('Product/index',array('g'=>$topHot[1]['goods_id']));?>" class="piang-g">抢购</a>
                          </div>
                          <a href="<?php echo U('Product/index',array('g'=>$topHot[1]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($topHot[1]['index_sale_img']); ?>"></a>
                      </li>
                      <li>
                          <div class="info">
                              <h3><a href="<?php echo U('Product/index',array('g'=>$topHot[2]['goods_id']));?>"><?php echo ($topHot[2]['index_sale_title']); ?></a></h3>
                              <a href="<?php echo U('Product/index',array('g'=>$topHot[2]['goods_id']));?>" class="piang-g">抢购</a>
                          </div>
                          <a href="<?php echo U('Product/index',array('g'=>$topHot[2]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($topHot[2]['index_sale_img']); ?>"></a>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="inx-new-pro">
              <div class="l-new">
                   <h3><a href="">新品上市</a></h3>
                   <a href="<?php echo U('Product/index',array('g'=>$newProduct[0]['goods_id']));?>" class="new"><?php echo ($newProduct[0]['index_sale_title']); ?></a>
                   <div class="pro">
                        <a href="<?php echo U('Product/index',array('g'=>$newProduct[0]['goods_id']));?>" class="look-btn">查看详情 ></a>
                        <div class="img">
                            <a href="<?php echo U('Product/index',array('g'=>$newProduct[0]['goods_id']));?>"><img src="/vmallshop/Upload<?php echo ($newProduct[0]['index_sale_img']); ?>"></a>
                        </div>
                   </div>
              </div>
              <div class="r-new-pro">
                  <ul>
					<?php if(is_array($newProduct)): foreach($newProduct as $k=>$vo): if($k > 0 && $k < 5 ): ?><li>
							  <div class="info">
								  <h3><a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>"><?php echo ($vo["index_sale_title"]); ?></a></h3>
								  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="look-btn">查看详情 ></a>
							  </div>
							  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="img"><img src="/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>"></a>
						  </li><?php endif; endforeach; endif; ?>  
                  </ul>
              </div>
          </div>
      </div>
      <div class="w1200 mt15">
          <div class="inx-titel">
              <div class="l-titel">
                  <span class="tit-1"><em>年</em>历 新春礼包 /</span>
                  <span class="tit-2">New Year's spring gift package</span>
              </div>
              <ul class="r-nav">
                  <li><a href="">吊牌</a></li>
                  <li><a href="">老黄历</a></li>
                  <li><a href="">挂历</a></li>
                  <li><a href="">吊牌</a></li>
                  <li><a href="">老黄历</a></li>
                  <li><a href="">挂历</a></li>
              </ul>
          </div>
          <div class="f-pro-list-bd">
              <ul class="l-pro-list">
				<?php if(is_array($calendarlist)): foreach($calendarlist as $k=>$vo): if($k < 5 ): if($k % 2 == 0 ): ?><li>
							  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>"></a>
							  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="titbtn fl"><?php echo ($vo["index_sale_title"]); ?></a>
						  </li>
						<?php else: ?>
						  <li>
							  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="titbtn fr"><?php echo ($vo["index_sale_title"]); ?></a>
							  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>"></a>
						  </li><?php endif; endif; endforeach; endif; ?>  
              </ul>
              <ul class="r-pro-list">
				<?php if(is_array($calendarlist)): foreach($calendarlist as $k=>$vo): if($k > 4 && $k < 11 ): ?><li>
						  <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>">
							  <P class="tit">
								  <span class="lt"><?php echo ($vo["index_sale_title"]); ?></span>
								  <span class="price"><?php echo ($vo["index_sale_keywords"]); ?></span>
							  </P>
							  <div class="img"><img src="/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>"></div>
						  </a>
					  </li><?php endif; endforeach; endif; ?> 
              </ul>
          </div>
      </div>
      <div class="1200 mt15">
          <div class="inx-titel">
              <div class="l-titel">
                  <span class="tit-1"><em>信</em>源热销产品 /</span>
                  <span class="tit-2">Goods sell like hot cakes</span>
              </div>
              <ul class="r-nav">
                  <li><a href="">新品上市</a></li>
                  <li><a href="">火爆热销</a></li>
              </ul>
          </div>
          <div class="yz-pro-list">
              <div class="t-box">
                  <div class="top-text">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$Hotlist[0]['goods_id']));?>"><?php echo ($Hotlist[0]['index_sale_title']); ?></a></h3>
                      <p><?php echo ($Hotlist[0]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$Hotlist[0]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                  <a href="<?php echo U('Product/index',array('g'=>$Hotlist[0]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($Hotlist[0]['index_sale_img']); ?>"></a>
              </div>
              <div class="s-pro-list">
                  <ul>
					<?php if(is_array($Hotlist)): foreach($Hotlist as $k=>$vo): if($k > 0 && $k < 7 ): ?><li>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="tit"><?php echo ($vo['index_sale_keywords']); ?></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="more">查看详情 ></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($vo['index_sale_img']); ?>"></a>
							</li><?php endif; endforeach; endif; ?>
                  </ul>
              </div>
               <div class="r-box">
                  <a href="<?php echo U('Product/index',array('g'=>$Hotlist[7]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($Hotlist[7]['index_sale_img']); ?>"></a>
                  <div class="top-text">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$Hotlist[7]['goods_id']));?>"><?php echo ($Hotlist[7]['index_sale_title']); ?></a></h3>
                      <a href="" class="jingping">精品特价</a>
                      <p><?php echo ($Hotlist[7]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$Hotlist[7]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                 
              </div>
          </div>
      </div>
      <div class="inx-ggt"><a href="<?php echo ($ad_info[3]['ad_url']); ?>"><img src="/vmallshop/Upload<?php echo ($ad_info[3]['index_sale_img']); ?>"></a></div>
      <div class="1200 mt15">
          <div class="inx-titel">
              <div class="l-titel">
                  <span class="tit-1"><em>家</em>居&小电器</span>
                  <span class="tit-2">Small household electrical appliance</span>
              </div>
              <ul class="r-nav">
                  <li><a href="">个人护理</a></li>
                  <li><a href="">生活电器</a></li>
                  <li><a href="">厨房电器</a></li>
              </ul>
          </div>
		  
          <div class="yz-pro-list">
              <div class="t-box">
                  <div class="top-text">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[0]['goods_id']));?>"><?php echo ($homeFurnishinglist[0]['index_sale_title']); ?></a></h3>
                      <p><?php echo ($homeFurnishinglist[0]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[0]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                  <a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[0]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($homeFurnishinglist[0]['index_sale_img']); ?>"></a>
              </div>
              <div class="s-pro-list">
                  <ul>
					<?php if(is_array($homeFurnishinglist)): foreach($homeFurnishinglist as $k=>$vo): if($k > 0 && $k < 7 ): ?><li>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="tit"><?php echo ($vo['index_sale_keywords']); ?></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="more">查看详情 ></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($vo['index_sale_img']); ?>"></a>
							</li><?php endif; endforeach; endif; ?>
                  </ul>
              </div>
               <div class="r-box">
                  <a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[7]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($homeFurnishinglist[7]['index_sale_img']); ?>"></a>
                  <div class="top-text" style="background: #F6518D;">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[7]['goods_id']));?>"><?php echo ($homeFurnishinglist[7]['index_sale_title']); ?></a></h3>
                      <a href="" class="jingping">精品特价</a>
                      <p><?php echo ($homeFurnishinglist[7]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$homeFurnishinglist[7]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                 
              </div>
          </div>
		  
		  
		  
	  </div>
      <div class="inx-ggt"><a href="<?php echo ($ad_info[4]['ad_url']); ?>"><img src="/vmallshop/Upload<?php echo ($ad_info[4]['index_sale_img']); ?>"></a></div>
      <div class="1200 mt15">
          <div class="inx-titel">
              <div class="l-titel">
                  <span class="tit-1"><em>数</em>码产品 /</span>
                  <span class="tit-2">Digital product</span>
              </div>
              <ul class="r-nav">
                  <li><a href="">电脑配件</a></li>
                  <li><a href="">手机配件</a></li>
                  <li><a href="">车载用品</a></li>
                  <li><a href="">移动电源</a></li>
              </ul>
          </div>
		  
          <div class="yz-pro-list">
              <div class="t-box">
                  <div class="top-text">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[0]['goods_id']));?>"><?php echo ($numericalCodelist[0]['index_sale_title']); ?></a></h3>
                      <p><?php echo ($numericalCodelist[0]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[0]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                  <a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[0]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($numericalCodelist[0]['index_sale_img']); ?>"></a>
              </div>
              <div class="s-pro-list">
                  <ul>
					<?php if(is_array($numericalCodelist)): foreach($numericalCodelist as $k=>$vo): if($k > 0 && $k < 7 ): ?><li>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="tit"><?php echo ($vo['index_sale_keywords']); ?></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="more">查看详情 ></a>
								<a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($vo['index_sale_img']); ?>"></a>
							</li><?php endif; endforeach; endif; ?>
                  </ul>
              </div>
               <div class="r-box">
                  <a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[7]['goods_id']));?>" class="pic"><img src="/vmallshop/Upload<?php echo ($numericalCodelist[7]['index_sale_img']); ?>"></a>
                  <div class="top-text" style="background: #F6518D;">
                      <h3><a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[7]['goods_id']));?>"><?php echo ($numericalCodelist[7]['index_sale_title']); ?></a></h3>
                      <a href="" class="jingping">精品特价</a>
                      <p><?php echo ($numericalCodelist[7]['index_sale_keywords']); ?></p>
                      <a href="<?php echo U('Product/index',array('g'=>$numericalCodelist[7]['goods_id']));?>" class="look">查看详情 ></a>
                  </div>
                 
              </div>
          </div>
		  
		  
      </div>
      <div class="inx-f-link">
        <ul>
			<?php if(is_array($brand_list)): foreach($brand_list as $key=>$vo): ?><li><a href=""><img src="/vmallshop/Upload<?php echo ($vo["brand_img"]); ?>"></a></li><?php endforeach; endif; ?>
        </ul>
      </div>
      <div class="inx-pinpai">
          <div class="pingpai-t"><h3>品牌专区</h3></div>
          <div class="mr_frbox">
              <img class="mr_frBtnL prev" src="/vmallshop/Public/Home/images/left_btn.png" width="55" height="55" />
              <div class="mr_frUl">
                <ul>
					<?php if(is_array($brand_goods_list)): foreach($brand_goods_list as $key=>$vo): ?><li>
						 <p><img src="/vmallshop/Upload<?php echo ($vo["index_sale_img"]); ?>" width="264" height="404" /></p>
						 <div class="txt">
							<h3><?php echo ($vo["index_sale_title"]); ?></h3>
							<p>售价：<?php echo ($vo["final_price"]); ?>元/条</p>
						 </div>
						 <a href="<?php echo U('Product/index',array('g'=>$vo['goods_id']));?>" class="botton">立即参与</a>
					  </li><?php endforeach; endif; ?>
				</ul>
              </div>
              <img class="mr_frBtnR next" src="/vmallshop/Public/Home/images/right_btn.png" width="55" height="55" />
          </div>
          <script language="javascript">
            jQuery(".mr_frbox").slide({titCell:"",mainCell:".mr_frUl ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:5});
          </script>
      </div>
    </div>
  </div>
  <!-- footer star -->
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
  <!-- footer end-->
  <script type="text/javascript" src="/vmallshop/Public/Home/js/common.js"></script>
  <script type="text/javascript" src="/vmallshop/Public/Home/js/jquery.flexslider-min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
	$('.category-list').attr('class','category-list block');
      $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false,
        slideshowSpeed:5000,
      });
    });
</script>
</body>
</html>