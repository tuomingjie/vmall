<?php
return array(
	 //'配置项'=>'配置值'


	  // "TMPL_L_DELIM"=>"<{",//左侧定界符
      // "TMPL_R_DELIM"=>"}>",//右侧定界符  

	  'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	  "DB_TYPE"=>'PDO',
	  'DB_PREFIX' =>'vmall_',//数据库表前缀
	   "DB_USER"=>"root",
	   "DB_PWD"=>'root',//密码
    'DB_PORT' => 3306, // 端口
	   'DB_DSN' => 'mysql:host=127.0.0.1;dbname=ceshi',//dsn方式连接数据库
//    'DB_NAME' => 'ceshi', // 数据库名
//    'DB_HOST' => '127.0.0.1', // 服务器地址

	  'TMPL_TEMPLATE_SUFFIX'=>'.html',//更改模板文件后缀名
      'URL_HTML_SUFFIX'=>'html|shtml',//限制伪静态的后缀
	  'TMPL_PARSE_STRING'  =>array(  
             //JQuery的引入快捷方式	  
			 '__JQUERY__'=>__ROOT__."/Public/Jquery/jquery-1.7.2.js",
			 '__UPLOAD__'=>__ROOT__."/Upload",
	   ),
	   
	   
	  
);