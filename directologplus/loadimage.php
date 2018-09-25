<?php

	ini_set('output_buffering', 4096); //Буферизация чтобы работал header перенаправление Location
	ob_start();
	include("../conf/start.php");
	include("../conf/session.php");
	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1); //Имя проекта
	$_SESSION['market'] = $market;
?><html class="html">
	<head>
		<meta charset="utf-8">
		<title>Загрузка</title>

		<meta name="GENERATOR" content="Текстовый редактор">

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<script src="../js/jquery-3.1.1.js"></script>
		<link rel="icon" href="favicon.ico" />
		<link rel="shortcut icon" href="favicon.ico" />
		<script src="../js/upload.js"></script>


		<link href="../css/st_main.css" rel="stylesheet">
		<link href="../css/crm10.css" rel="stylesheet">
		<link href="../css/height.css" rel="stylesheet">
		<link href="../css/1024.css" rel="stylesheet">
		<link href="../css/666.css" rel="stylesheet">
	</head>

	<body class="body white">
		<div id="fototoload"></div>
		<div class="dragfile">Кинь фотку сюда</div>
	</body>
	<script src="../js/upload.js"></script>
</html>