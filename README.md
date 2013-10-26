###说明

基于PHP的长微博生成工具，用于将文本内容或网址生成图片，文本内容支持富文本。

###具体原理

见：[http://loosky.net/2816.html][1]

###演示效果

见：[http://loosky.cn/][2]

###安装步骤：

####Linux平台

1. 按照[http://loosky.net/2816.html#article_index-7][3] 文中所提，推荐在Ubuntu平台下安装`cutycapt` 和 `imagick`，选用apache作为Web服务器。

> 注：

> imagick并非必须，cutycapt已经完全可以实现截图功能。可以选择不安装，并删除`result.php`中相应的代码，详见注释。

> imagick仅是对图片进一步进行调整，如可以缩小图片体积等，并方便更多的处理。

2. 分别给文件夹 `content`、`html2png`、`pic`、`upload` 写入权限。

3. 安装雅黑、宋体、楷体、黑体等常用中文字体。


####Windows平台

Windows平台下使用，请自行到 [http://cutycapt.sourceforge.net/][4] 下载CutyCapt，并将程序放入 `CutyCapt` 目录下即可。


  [1]: http://loosky.net/2816.html
  [2]: http://loosky.cn/
  [3]: http://loosky.net/2816.html#article_index-7
  [4]: http://cutycapt.sourceforge.net/