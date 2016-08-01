<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        *{font-family: droidsans;}
        body{font-family: droidsans;}
        p{width: 100px;}
    </style>
</head>
<body>

<div class="content">


    <div style="font-family: droidsans, DejaVu Sans, sans-serif;"> 利用 Dompdf 将 html（包含中文）转 pdf</div>


    <hr>

    <div class="article-body">
        <p style="width:100px;">将静态Html页面转pdf，找了三四个方案，最终还是选择了Dompdf，具体原因在此略过，<br />下面开始记录如何上手Dompdf：</p>
        <p>1.首先下载Dompdf源码：</p><p><a href="https://github.com/dompdf/dompdf">https://github.com/dompdf/dompdf</a></p><pre>git clone https://github.com/dompdf/dompdf.git .
git submodule init
git submodule update
</pre><p>2.源码部署到一个站点，然后就可以访问这个站点，会自动跳转到www目录下，是Dompdf的介绍和demo页面，操作列表：</p><ul><li><a href="http://dompdf.aishan.com/www/index.php">Overview</a></li><li><a href="http://dompdf.aishan.com/www/examples.php">Examples</a></li><li><a href="http://dompdf.aishan.com/www/demo.php">Demo</a></li><li><a href="http://dompdf.aishan.com/www/setup.php">Setup / Config</a></li><li><a href="http://dompdf.aishan.com/www/fonts.php">Fonts</a>&nbsp;&nbsp;</li></ul><p>其中通过Setup/Config 可以查看System Configuration和Dompdf Configuration两个状态表格，然后是消灭红色标记的配置，比如目录写入权限和修改默认用户名和密码，其中修改用户名和密码是在dompdf_config.inc.php中：</p><pre>/**
 * Username and password used by the configuration utility in www/
 */
def("DOMPDF_ADMIN_USERNAME", "xxxxxx");
def("DOMPDF_ADMIN_PASSWORD", "xxxxxx");</pre><p>所有红色标记消灭完成之后，开始下一步：导入中文字体</p><p>由于默认是没有支持中文的，所以需要自行导入中文字体，在这里推荐</p><p>droidsans字体，大概是3M，然后在<br></p><p>菜单列表Fonts中进行install，这里会有</p><p>Name：<br>Normal：<br>Bold：<br>Bold italic：<br>Italic：<br></p><p>几个空，我在这里name为droidsans，下面的字体类型一次只选一个，但是每次选的都是droidsans这个字体进行install，全部安装完成后就可以开始测试demo。</p><p>当然，在Demo中已经可以看到很多例子了，这里主要是阐述将包含中文html文件转成pdf：</p><p>首先在www/test/ 下面新增一个html文件：</p><p>test.html</p><p></p><pre><span style="color:#e8bf6a;"><span style="color:#bababa;"></span>&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;style&gt;
    *{font-family:droidsans}//这里是将本页面的字体设置为上一步设置的中文字体
&lt;/style&gt;
&lt;head&gt;

&lt;/head&gt;
&lt;body&gt;
&lt;p&gt;光合联萌&lt;/p&gt;
&lt;/body&gt;&lt;/html&gt;<span style="color:#e8bf6a;"><br></span><span style="color:#e8bf6a;"></span></span></pre><p><br></p><p>然后直接访问：</p>
        <pre>http://<span>站点域名</span>/dompdf.php?base_path=www%2Ftest%2F&amp;options[Attachment]=0&amp;input_file=test.html&amp;options[f]=test.pdf</pre><p>其中参数说明：</p><ul><li>base_path 文件路径</li><li>options 会有很多参数&nbsp;<ul><li>比如 Attachment 为0时只显示pdf不下载，为1时下载生成的pdf</li><li>f则表示生成的pdf文件的名称</li></ul></li><li>input_file 要进行转换的html文件名&nbsp;</li></ul><p>最后访问这个链接就可以得到显示中文“光合联萌”的test.pdf文件了。</p><p>最后说明：</p><ul><li>如果要生成带有图片的pdf，那么html文件中引入的图片必须在同一个站点，不能是超链接, 默认设置是这样，不过可以通过DOMPDF_ENABLE_REMOTE配置</li><li>如果是中文一定要指定中文字体，否则是乱码</li><li>配置文件要熟读dompdf_config.inc.php</li><li>当然还有分页等一系列技巧，自行参照项目提供的demo尝试吧</li></ul>
    </div>


</div>


</body>
</html>