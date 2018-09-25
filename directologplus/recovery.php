<?php
include("../conf/start.php");
include("../conf/session.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1);


//print_r($_SESSION);
		$resultProd=DB::query("SELECT * FROM `new_project` WHERE `durl`='$market'");
		$objProd=DB::fetch_object($resultProd);
		$id_project=$objProd->id;
		$resultUser=DB::query("SELECT * FROM `new_project_user` WHERE `id_project`='$id_project'");
		$objUser=DB::fetch_object($resultUser);

	//$resultZayavki=DB::query("SELECT * FROM `zayavki` WHERE `id_user`='$userid' and `podpiska`='1'");

	//setcookie("prod", $objProd->durl, 0);
	/*$phoneG = '+'.$objData->phone;
	$phoneG = substr_replace($phoneG, " (", 2, 0);
	$phoneG = substr_replace($phoneG, ") ", 7, 0);
	$phoneG = substr_replace($phoneG, "-", 12, 0);
	$phoneG = substr_replace($phoneG, "-", 15, 0);*/

	$pg = "index";


	$title = "Директолог+ | CRM";	
	//echo $objUser->soname;
	include("../tmp/head_crm.php");
	include("../tmp/recovery.php");
	include("../tmp/nofooter3.php");

?>