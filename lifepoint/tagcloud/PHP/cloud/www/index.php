<?php 
    header("Content-Type: text/html; charset=utf-8");   //Ставим кодировку страницы

    include 'config.php';                               //Параметры отображения облака
?>




<title>Облако тегов</title>
<h2 align="center">Поисковые машины</h2>
<script type="text/javascript" src="/cloud/swfobject.js"></script>

<?php
$tags = '<tags> 
<a href="http://www.google.ru" style="font-size: 15px">Google</a> 
<a href="http://www.yandex.ru" style="font-size: 15px">Яндекс</a> 
<a href="http://ru.yahoo.com" style="font-size: 15px">Yahoo</a> 
<a href="http://www.rambler.ru" style="font-size: 15px">Rambler</a> 
<a href="http://www.amazon.com" style="font-size: 15px">Amazon</a> 
<a href="http://price.ru/" style="font-size: 15px">Price</a> 
<a href="http://ru.wikipedia.org/" style="font-size: 15px">Wiki</a> 
<a href="http://www.icq.com/" style="font-size: 15px">ICQ</a> 
</tags>';
?>
<div id="tags" align="center">
Для корректного отображения этого элемента вам необходимо установить FlashPlayer и включить в браузере Java Script.
<script type="text/javascript">
var rand = Math.floor(Math.random()*9999999);
var tag = new SWFObject(   
                           "/cloud/tagcloud.swf?r="+rand, 
                           "tagcloudflash", 
                           "<?php echo IRB_WIDTH           ?>", 
                           "<?php echo IRB_HEIGHT          ?>", 
                           "<?php echo IRB_VERSION_FLASH   ?>",
                           "<?php echo IRB_BACKGROUND      ?>"
						   );
    tag.addVariable("tcolor",   "<?php echo IRB_T_COLOR         ?>");
    tag.addVariable("tspeed",   "<?php echo IRB_T_SPEED         ?>");
    tag.addVariable("distr",    "<?php echo IRB_DISTR           ?>");
    tag.addVariable("mode",     "<?php echo IRB_MODE            ?>");
    tag.addVariable("tagcloud", "<?php echo urlencode($tags);   ?>");
    tag.write("<?php echo IRB_TAGS ?>");
</script> 
 

</div>































