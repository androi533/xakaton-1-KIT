<?php
	//Стандартизация вида главной страницы в виде шаблона для последующего создания файла по введенному имени страницы пользователя.
	//Шаблонизировать Внутреннюю часть кода отображения данных (tmp/filename.php)
	//Где то тут ошибка в обработке запросов, получается с пустыми данными, необходим обход.
	//Да ко мне пришло осознание того что тут можно обойтись одним файлом index... Вопрос лишь в том как? И хотелось бы проверить на нескольких, саму воронку и прочее...
	//ini_set('error_reporting', E_ALL);
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//ВЫКЛЮЧИТЬ ПРОВЕРКУ ОШИБОК
	ini_set('output_buffering', 4096); //Буферизация чтобы работал header перенаправление Location
	ob_start();
	include("conf/start.php");
	include("conf/session.php");
	require("conf/consts.php");
	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';
/*
	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1); //Имя проекта
	$_SESSION['market'] = $market;

	//получаю название страницы
	if (strrpos($url, '.')>0) {
		$namepage = substr($url,strrpos($url, '/')+1,strrpos($url, '.')-strrpos($url, '/')-1);
	} else {
		$namepage = 'index';
	}

	//ОБРАБАТЫВАТЬ UTM можно здесь
	if (isset($_GET['ref'])) {
		$ref = $_GET['ref'];
		$_SESSION['market_'.$market]['ref'] = $ref;
	}

	$resultProd=DB::query("SELECT * FROM `new_project` WHERE `durl`='$market'");
	$objProj=DB::fetch_object($resultProd);
	$id_project = $objProj->id;
	$company_name = $objProj->company_name;
	$ogrn = $objProj->ogrn;

	//Тут массив воронки //Вообще в проекте воронка есть?
	$novoronka = FALSE;
	$nextvoronkaproj = NULL;
	$sqlthisvoronka = "SELECT * FROM `new_voronka` WHERE `id_project` = '$id_project'";
	$resvoronka = DB::query($sqlthisvoronka);
	$check=DB::num_rows($resvoronka);
	if ($check>0) {
		while ($thisvoronka = DB::fetch_array($resvoronka)) {
			$voronka['from'][]= $thisvoronka['id_project_data'];
			$voronka['to'][]= $thisvoronka['id_project_data2'];
			$voronka['step'][]= $thisvoronka['step'];
			$nextvoronkaproj = 1;
		}
	} else {
		$novoronka = TRUE;
		$nextvoronkaproj = 0;
	}
	//Пройти по всей воронке и узнать какие поля нужно собрать. Узнать какие уже получены записать в сессию. Это на главной. //ХЗ ХЗ
*/
	include("tmp/head_main.php");
	include("tmp/header_main.php");
	include("tmp/content.php");
	include("tmp/footer_main.php");
?>