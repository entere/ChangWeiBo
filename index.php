<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>内容生成工具</title>
<meta name="keywords" content="内容生成工具,长微博工具,长微博,长微博转换器"> 
<meta name="description" content="内容生成工具,长微博工具,长微博,长微博转换器" />
<link type="text/css" rel="stylesheet" href="./style.css"/>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.all.js"></script>
</head>
<body>
<div class="wrapper">
<h1>内容生成工具</h1>
<form method="POST" id="form" action="result.php" target="_blank" style="margin-bottom:100px;">
  <div class="more_selcet">
    <dl>
      <dt class="b">转换形式：</dt>
      <dd>
        <label><input type="radio" name="Transform" value="1" class="m_rad" checked onClick="return wbclick('more_selcet','block')">内容转换（将内容生成图片）</label>
        <label><input type="radio" name="Transform" value="2" class="m_rad" onClick="return wbclick('more_selcet','none')">网址转换（直接将网址截图，请输入完整网址，仅支持http://）</label>
      </dd>
  	</dl>
  </div>
  <script type="text/plain" id="myEditor" name="myEditor"> 
      <p>请在这里输入您的内容...</p>
  </script>
  <div class="more_selcet" id="more_selcet">
    <dl>
      <dt>文章来源：</dt><dd><input type="text" maxlength="50" id="wbName" name="wbName" value="" class="m_txt text-input"> (可选填)</dd>
      <dt class="b">加上标记：</dt>
      <dd>
      	<label><input type="radio" name="addtag" value="0" class="m_rad" checked onClick="return wbclick('more_selcet1','none')">否</label>
        <label><input type="radio" name="addtag" value="1" class="m_rad" onClick="return wbclick('more_selcet1','block')">是</label>              
      </dd>         
      </dl>
  </div>  
  <div class="more_selcet" id="more_selcet1" style="display:none"> 
    <dl>
    <dt>标记内容：</dt><dd> <input type="text" maxlength="50" id="wbTag" name="wbTag" value="" class="m_txt text-input"> (可选填) </dd> 
    </dl>
  </div>
  <div class="more_selcet" id="more_selcet2"> 
  <dl>
      <dt class="b">图片大小：</dt>
      <dd>
        <label><input type="radio" name="picsize" value="1" class="m_rad" checked>适用于微博（宽度为450px）</label>
        <label><input type="radio" name="picsize" value="2" class="m_rad">正常（宽度为1024px）</label>
      </dd>
  </dl>
  </div>
  <div style="text-align:right;"><input id="submit-btn" name="submit-btn" type="submit" value="点击开始转换"></div>
</form>
<script type="text/javascript"> 
var editor = new UE.ui.Editor();
UE.getEditor('myEditor', {
	autoClearinitialContent:true, //focus时自动清空初始化时的内容
	wordCount:false, //关闭字数统计
	elementPathEnabled:false,//关闭elementPath
	initialFrameHeight: 450
});
function wbclick(divDisplay,divStyle)
{
	if(document.getElementById(divDisplay).style.display != divStyle)
	{
		document.getElementById(divDisplay).style.display = divStyle;
	}
}
</script>
<div style="width:420px; float:right"><span style=" text-decoration:overline; padding-top:3px"></span></div>
<div class="foot">
	<div class="copy">Copyright <?php echo date('Y');?> Powered by <a href="http://loosky.cn/">Loosky</a></div>   
</div>
</body>
</html>