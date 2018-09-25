<?php
	require("conf/start.php");
	require("conf/session.php");
	require("conf/consts.php");
	setlocale(LC_ALL, 'ru_RU.cp1251'); 
	date_default_timezone_set('Asia/Ekaterinburg'); 

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	include("tmp/head_main_draw.php");
	include("tmp/draw.php");
	include("tmp/footer_main_pen.php");
?>