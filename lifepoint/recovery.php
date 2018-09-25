<?php
	include("../conf/start.php");
	include("../conf/session.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	include("tmp/head_main.php");
	include("tmp/header_main.php");
	include("tmp/recovery.php");
	include("tmp/footer_main.php");
?>