<?php
require_once('function.php');

$hreferr=false;
$errinfo='已成功生成图片!';

if(isset($_POST['submit-btn'])){
	$Transform= stripslashes($_POST['Transform']);         //转换形式
	
	$html = stripslashes($_POST['myEditor']);              //内容
	
	$wbName = stripslashes($_POST['wbName']);              //文章来源
	
	$addtag = stripslashes($_POST['addtag']);			   //是否添加标记
	$wbTag = stripslashes($_POST['wbTag']); 			   //标记内容
	$wbtag_default="福建工程学院(www.fjut.edu.cn)";		   //默认标记内容
	$tag=(empty($wbTag)?$wbtag_default:$wbTag);			   //生成标记内容
	
	$picsize = stripslashes($_POST['picsize']);			   //图片大小	

//进行内容转换	
  if($Transform==1){
	if (!empty($wbName)) $html .="<span>该内容由".$wbName."发布</span>";
	$wrapper= ($picsize==1?'wrapper1':'wrapper2');
	ob_start(); 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>福建工程学院内容生成工具</title>
<link type="text/css" rel="stylesheet" href="../style2.css"/>
</head>
<body>
<div class="<?php echo $wrapper;?>">
<div id="wb_content">
<?php
	echo $html;
?>
</div>

<?php if($addtag==1){?>
<div class="wbtag">
<?php
	echo $tag;
?>
</div>
<?php
}
?>
</div>
</body>
</html>
<?php 
	$content = ob_get_clean(); 
	ob_clean ();
}

//进行网址截图
else{
	$content=$href=strip_tags($html);
	
	//判断网址是否合法，仅支持http://类型的
	if (!preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$href)){
		$errinfo='网址格式错误，目前仅支持http类型的网站!为您生成默认网站的测试图片。';
		$hreferr=true;
	}
	//判断目标网址是否可以正常访问	
	else{	
	  $array = get_headers($href,1);
	  if(!preg_match('/200/',$array[0])){ 
		  $errinfo= "您输入的网址有误！请重新检查!为您生成默认网站的测试图片。"; 
		  $hreferr=true;
	  }
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容生成工具</title>
<meta name="keywords" content="内容生成工具,长微博工具,长微博,长微博转换器"> 
<meta name="description" content="内容生成工具,长微博工具,长微博,长微博转换器" />
<link type="text/css" rel="stylesheet" href="./style.css"/>
</head>
<body>
<div id='loading'>正在加载...</div>
<?php
//正常情况下，生成图片
if(!$hreferr){
	//生成内容文件
	$e = './content/'.getIP().'_'.date("YmdHis").'.htm';
	file_put_contents($e, $content);
	$img_name = 'pic/'.getIP().'_'.date("YmdHis").'.png';
	
	//如果是通过内容，则返回生成的内容文件的地址；通过网址截图则直接返回网址。
	if($Transform==1) $site_url=Loosky_URL.$e;
	else $site_url=$href;
	
	//判断操作系统平台，使用不同的CutyCapt语句
	if(eregi("WIN",PHP_OS)){	
	//Windows平台
	  $wbshell1=Loosky_ROOT.'\CutyCapt\CutyCapt.exe --min-width=460 --url='.$site_url.' --out='.$img_name;
	  $wbshell2=Loosky_ROOT.'\CutyCapt\CutyCapt.exe --min-width=1024 --url='.$site_url.' --out='.$img_name;
	}
	else if(PHP_OS=='Linux'){	
	//Linux平台
	  $wbshell1="xvfb-run --server-args=\"-screen 0, 1024x768x24\" cutycapt --min-width=460 --url=".$site_url." --out=".$img_name;
	  $wbshell2="xvfb-run --server-args=\"-screen 0, 1024x768x24\" cutycapt --min-width=1024 --url=".$site_url." --out=".$img_name;
	}
	//根据生成图片的大小调用语句
	$wbshell= ($picsize==1?$wbshell1:$wbshell2);

	//执行截图语句
	system($wbshell);
	//exec($wbshell);	
	
	//注：下面的操作仅是对图片进一步进行调整，可以缩小图片体积等，并方便更多的处理，并非必须。
	$im = new imagick($img_name);		
	//if($picsize==1) $im->resizeImage(490,0,Imagick::FILTER_LANCZOS,1);  
	$im->setImageFormat( "png" );
	$im->setCompressionQuality(90);
	$img_name2 = 'html2png/'.time().'.png';
	$im->writeImage($img_name2);		
	$im->clear();
	$im->destroy(); 
	
	//输出图片连接
	$url_this =  dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]).'/'.$img_name2;
}
//否则，返回默认图片	
else
	$url_this =  dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]).'/google.png';
?>
<div class="wrapper" >
<h1>内容生成工具</h1>
<ul>
    <li><?php echo $errinfo;?></li>
    <li>查看该图片地址：<a href="<?php echo $url_this;?>" target="_blank"><?php echo $url_this;?></a></li>
    <li><a href="./index.php">返回上一页</a></li>
</ul>
<div class="foot">
	<div class="copy">Copyright <?php echo date('Y');?> Powered by <a href="http://loosky.cn/">Loosky</a></div>   
</div>
</div>
<script>document.write('<style>#loading{display:none}<\/style>');</script>
</body>
</html>
<?php
}
else die('非法访问！请与管理员联系!');
?>