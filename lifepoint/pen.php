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

	$resLifepoints = DB::query("SELECT * FROM `lifepoints` WHERE `id_user`='1'");
	while ($objLifepoint = DB::fetch_object($resLifepoints)) {

		$id_lifepoint = $objLifepoint->id;
		$id_event = $objLifepoint->id_event;
		echo "$id_lifepoint $id_event<br>";

		$resEvents = DB::query("SELECT * FROM `events` WHERE `id`='$id_event'");
		$objEvent = DB::fetch_object($resEvents);
		$id_impact = $objEvent->id_impact;
		$id_type = $objEvent->id_type;

		$updLifepoints = DB::query("UPDATE `lifepoints` SET `id_impact`='$id_impact', `id_type`='$id_type' WHERE `id`='$id_lifepoint' AND `id_user`='1'");
	}
		//$resDescriptions = DB::query("SELECT * FROM `descriptions` WHERE `id`='$id_description'");

		//$resImpacts = DB::query("SELECT * FROM `impacts` WHERE `id`='$id_impact'");
		//$resTypes = DB::query("SELECT * FROM `types`  WHERE `id`='$id_type'");


?>