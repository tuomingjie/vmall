<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>首页</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" href="/vmallshop/Public/Home/css/common.css">
<script type="text/javascript" src="/vmallshop/Public/Home/js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="/vmallshop/Public/home/css/css.css">
	<style>
		.company-main  .side-nav .side-li a{color:green;}
	</style>
</head>
<body>
  <div class="header">
    <div class="head-top">
      <div class="yzbody clearfix">
          <div class="head-top-l">
              <div class="fl">欢迎光临中国邮政信源农村电商产品直采平台！</div>
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
                      <a class="tit" href="<?php echo U('Cart/index');?>">购物车</a>
                      <div class="subnav cart-b">
                          <div class="catr-no">暂时没有商品</div>
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
            <a href="<?php echo U('Index/index');?>" class="logo"><img src="/vmallshop/Public/Home/images/logo.png"></a>
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
                <div class="category-list block">
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



</script>
 <!--  header end -->
  <div class="inx-content-bd">
      <div class="company-main clearfix">
          <div class="left-con">
              <h3>平台资讯</h3>
			  
              <ul class="side-nav">
				<?php if(is_array($info_list)): foreach($info_list as $k=>$v): ?><li <?php if($vo["info_id"] == $v["info_id"] ): ?>class="side-li"<?php endif; ?>   ><a href="<?php echo U('Info/index',array('info_id'=>$v['info_id']));?>"><?php echo ($v["info_name"]); ?></a></li><?php endforeach; endif; ?> 
              </ul>
          </div>
          <div class="right-con">
              <div class="top-head">
                  <h3><?php echo ($vo["info_name"]); ?></h3>
                  <div class="r-nav">
					<?php if(is_array($info_list)): foreach($info_list as $k=>$v): if($vo["info_id"] != $v["info_id"] ): ?><a href="<?php echo U('Info/index',array('info_id'=>$v['info_id']));?>"><?php echo ($v["info_name"]); ?></a>
							<span>/</span><?php endif; endforeach; endif; ?>       
                  </div>
              </div>
              <div class="text">
                  <?php echo ($vo["info_content"]); ?>
              </div>
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
                      <h3>400-107-1007</h3>
                      <a href="" class="kf">联系客服</a>
                  </div>
                  <div class="f-weixin">
                      <p class="tit">微信公众号</p>
                      <p class="weix"><img src="/vmallshop/Public/Home/images/weixin.jpg"></p>
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
                  <p>技术支持：*****</p>
              </div>
          </div>
      </div>
  </div>
  <!-- footer end-->
  <!-- footer end-->
<script type="text/javascript" src="/vmallshop/Public/home/js/common.js"></script>
<script>
    $(document).ready(function(){
	
	  $('.category-list').attr('class','category-list none');
	
	
      $(".nav-all").hover(function(){
        $(".category-list").removeClass("none");
        $(".category-list").addClass("block");
      });
      $(".nav-all").mouseleave(function(){
        $(".category-list").removeClass("block");
        $(".category-list").addClass("none");
      });
    });
</script>

  <!-- <script>
      $(".mod_cate_hd").click(function(){
      $(".category-list").toggleClass("block");
    });
  </script> -->
</body>
</html>