<?php
     
	 // 检测PHP环境 如果低于5.3.0;直接死掉
     if(version_compare(PHP_VERSION,'5.3.0','<'))  die('需要PHP版本大于 5.3.0 !');
	 
	 //定义项目入口
	 define("APP_PATH","./Home/");

	 //开启调试模式
	 define("APP_DEBUG",true);
	 
	 
	 
	 //引入ThinkPHP文件
	 require "./ThinkPHP/ThinkPHP.php";
	 















?>