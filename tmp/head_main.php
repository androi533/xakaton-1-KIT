<?php
	function hexToRgb($color) {
		// проверяем наличие # в начале, если есть, то отрезаем ее
		if ($color[0] == '#') {
			$color = substr($color, 1);
		}
	   
		// разбираем строку на массив
		if (strlen($color) == 6) { // если hex цвет в полной форме - 6 символов
			list($red, $green, $blue) = array(
				$color[0] . $color[1],
				$color[2] . $color[3],
				$color[4] . $color[5]
			);
		} elseif (strlen($cvet) == 3) { // если hex цвет в сокращенной форме - 3 символа
			list($red, $green, $blue) = array(
				$color[0]. $color[0],
				$color[1]. $color[1],
				$color[2]. $color[2]
			);
		}else{
			return false; 
		}
	 
		// переводим шестнадцатиричные числа в десятичные
		$red = hexdec($red); 
		$green = hexdec($green);
		$blue = hexdec($blue);
		 
		// вернем результат
		return "$red, $green, $blue";
	}
	
	function rgbToHex($color) {
		$red = dechex($color[0]); 
		$green = dechex($color[1]);
		$blue = dechex($color[2]);
		return "#" . $red . $green . $blue;
	}  

	//Для SEO добавить META теги те которые нашел в hotelmayorka
?><html class="html">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>

	<meta name="description" content="<?php echo $description ?>"/>
	<meta name="keywords" content="<?php echo $keywords ?>"/>
	<meta name="author" content="<? echo date(Y);?>, Стерлитамак, Климахин Виктор Ахатович, vinhunter@ya.ru">
	<meta name="GENERATOR" content="Текстовый редактор">

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<script src="../js/jquery-3.1.1.js"></script>
	<link rel="icon" href="favicon.ico" />
	<link rel="shortcut icon" href="favicon.ico" />


	<link href="../css/<?php echo $style;?>.css" rel="stylesheet">
	<link href="../css/height.css" rel="stylesheet">
	<link href="../css/1024.css" rel="stylesheet">
	<link href="../css/666.css" rel="stylesheet">

	<script src="../js/jquery.maskedinput.js"></script>
	<script type="text/javascript" charset="utf-8" src="../js/jquery.tubular.1.0.js"></script>
					<script type="text/javascript">
						jQuery(function($){
						   $('input[type="phone"]').mask("+7 (999) 999-9999");
						});
					</script>
	<?
		if ($objProj->google <> '') {
			echo "<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', '$objProj->google', 'auto');
			  ga('send', 'pageview');
			</script>";
		}

		if ($objProj->yandex <> '') {
		 echo '<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter'.$objProj->yandex.' = new Ya.Metrika({ id:'.$objProj->yandex.', clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->';
		}
	?>				
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<?php 
	if (!empty($objData->backvideo)) {		
		echo "<script>$('document').ready(function() {	var options = { videoId: '";echo $objProd->back; echo "', mute:false };	$('#wrapper').tubular(options);});</script>";
	} else {
		if ($objData->backimg <> '') {
			$img = $objData->backimg;
			$transparent = $objData->transparent;
			$colorFont = $objData->colorFont;
			$colorBG = $objData->colorBG;
			$colorF = hexToRgb($colorFont);
			$colorB = hexToRgb($colorBG);
			echo "<style>html{background-image: url(img/";echo $img; echo "); background-repeat: no-repeat; background-size: contain; background-position: bottom;} body{color: rgb("; echo $colorF; echo ");background:rgba("; echo $colorB; echo ","; echo $transparent; echo ");} a{color: rgb("; echo $colorF;  echo ");}a:active, a:visited{color: rgb("; echo $colorF;  echo ");} </style>";
		}
		else {
			echo "<style>html{background-color: rgb(23, 23, 23); background-size: cover;} </style>";
		}
	}?>

	<script type="text/javascript" src="https://vk.com/js/api/openapi.js?154"></script>
</head>

<body class="body">
	<!-- VK Widget -->
	<?
	if ($objProj->vk <> '') {
		$vk = $objProj->vk;
		if ($objProj->vk_id <> '') {
			$vk_id = $objProj->vk_id;
		} else {
			$vk_v = $Consts['vk_v'];
			$vk_token = $Consts['vk_token'];
			$resp = file_get_contents('https://api.vk.com/method/groups.getById?group_ids='.$vk.'&v='.$vk_v.'&access_token='.$vk_token);
			$data = json_decode($resp, true);
			$vk_id = $data['response'][0]['id'];
			$sql = DB::query("UPDATE `new_project` SET `vk_id`='$vk_id' WHERE `durl`='$market'");
		}
		
		echo '<div id="vk_community_messages"></div>
		<script type="text/javascript">
			var widget = VK.Widgets.CommunityMessages("vk_community_messages", '.$vk_id.', {expanded: "0",disableExpandChatSound: "1",disableButtonTooltip: "1"});
			widget.stopTitleAnimation();
		</script>';
	}
	
	?>