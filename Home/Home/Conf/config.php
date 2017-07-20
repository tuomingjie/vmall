<?php
return array(
	//'配置项'=>'配置值'
	
	//用户登录后需要保存的信息的变量
	"USER_ID"=>'user_id', //保存用户id
	"USER_INFO"=>'user_info',//保存用户信息
	
	// 保存用户的浏览过商品的常量
	"USER_SCAN_GOODS"=>'user_scan_goods',
	
	
	//保存购物车信息
	
	"USER_CAT_INFO"=>'user_cat_info',
	
	//保存订单信息
	"USER_ORDER_ID"=>'order_id',
	
	//支付宝配置参数
	'alipay_config'=>array(
	    'partner' =>'',   //这里是你在成功申请支付宝接口后获取到的PID；
	    'key'=>'',//这里是你在成功申请支付宝接口后获取到的Key
	    'sign_type'=>strtoupper('MD5'),
	    'input_charset'=> strtolower('utf-8'),
	    'cacert'=> getcwd().'\\cacert.pem',
	    'transport'=> 'http',
	),
	    
	'alipay'   =>array(
		//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		'seller_email'=>'',
		//这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		'notify_url'=>'http://localhost/index.php/index/pay/notifyurl', 
		//这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		'return_url'=>'http://localhost/index.php/index/pay/returnurl',
		//支付成功跳转到的页面，我这里跳转到项目的Users控制器
		'successpage'=>'/index/pay/successinf',
		//支付失败跳转到的页面，我这里跳转到项目的User控制器
		'errorpage'=>'/index/pay/errorinf',
		
	),
	
	'view_filter' => array('Behavior\TokenBuild'),

    
	
);