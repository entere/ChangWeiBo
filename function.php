<?php
error_reporting(1);  //屏蔽出错信息
@header("Content-type: text/html;charset=utf-8");
//设置时区
function_exists('date_default_timezone_set') && date_default_timezone_set('Asia/Shanghai');

//全局变量
define('Loosky_ROOT', dirname(__file__));                        //当前路径
define('Loosky_URL', dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]));            //当前访问网址

function getIP(){
	$onlineip=''; 
	if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
		$onlineip=getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
		$onlineip=getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
		$onlineip=getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
		$onlineip=$_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}
?>