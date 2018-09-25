<?php
	include("../conf/start.php");
	include("../conf/session2.php");

	$sitemain = $_SERVER['HTTP_HOST'];
	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	$fst1 = strpos($url, '/', 1)+1;

	$market = substr($url,1,$fst1-2);
	$_SESSION['market'] = $market;

	$resultProj=DB::query("SELECT * FROM `new_project` WHERE `durl`='$market'");
	$objProj=DB::fetch_object($resultProj);
	$id_project=$objProj->id;
	$title = "Директолог+ | CRM";
	include("../tmp/head_crm.php");

	if (isset($_SESSION['market_'.$market]['SID'])) {
		if (isset($_GET["exit"])) {
			include("../tmp/CRM3.php");
			include("../tmp/nofooter_crm.php");
		} else {
			$resultProjData = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='index'");
			$objData=DB::fetch_object($resultProjData);
			//Подключаем стили
			$id_style = $objData->id_style;
			$resultStyle = DB::query("SELECT * FROM `new_styles` WHERE `id`='$id_style'");
			$objStyle = DB::fetch_object($resultStyle);
			$style = $objStyle->name;

			include("../tmp/header_crm.php");
			include("../tmp/CRM3.php");
			include("../tmp/footer_crm.php");
		}
	} else {
		include("../tmp/CRM3.php");
		include("../tmp/nofooter_crm.php");
	}
?>