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
	include("../conf/start.php");
	include("../conf/session.php");
	
	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1); //Имя проекта
	$_SESSION['market'] = $market;

	if (isset($_SESSION[$market]['SID'])) {
		//загрузка констант
		$resultConsts=DB::query("SELECT * FROM `new_consts` WHERE 1");	
		$check=DB::num_rows($resultConsts);
		if ($check > 0) {
			while ($objConsts = DB::fetch_object($resultConsts)) {
				$Cfield = $objConsts->field;
				$Cvalue = $objConsts->value;
				$Consts[$Cfield] = $Cvalue;
			}
		}

		//получаю название страницы
		if (strrpos($url, '.')>0) {
			$namepage = substr($url,strrpos($url, '/')+1,strrpos($url, '.')-strrpos($url, '/')-1);
		} else {
			$namepage = 'index';
		}

		//ОБРАБАТЫВАТЬ UTM можно здесь
		if (isset($_GET['ref'])) {
			$ref = $_GET['ref'];
			$_SESSION[$market]['ref'] = $ref;
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

		$resultProjData = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='index'");
		$objData=DB::fetch_object($resultProjData);
		$id_project_data = $objData->id;
		$sendemail = $objData->email;
		$id_desc = $objData->id_desc;
		$id_phone = $objData->id_phone;

		$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `id`='$id_phone'");
		$objPhones = DB::fetch_object($resultPhones);
		$idPhonesCountry = $objPhones->id_country;
		$idPhonesCode = $objPhones->id_city;
		$PhonesNumb = $objPhones->numb;

		$resultPhonesCode = DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$idPhonesCode'");
		$objPhonesCode = DB::fetch_object($resultPhonesCode);
		$PhonesCode = $objPhonesCode->value;

		$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$idPhonesCountry'");
		$objPhonesountry = DB::fetch_object($resultPhonesCountry);
		$PhonesCountry = $objPhonesountry->value;


		$resultDesc = DB::query("SELECT * FROM `new_descs` WHERE `id`='$id_desc'");
		$objDesc=DB::fetch_object($resultDesc);

		$resultProjUser = DB::query("SELECT * FROM `new_project_user` WHERE `id_project`='$id_project'");
		$objProjUser=DB::fetch_object($resultProjUser);
		$id_vladelec = $objProjUser->id_user;

		$resultUser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_vladelec'");
		$objUser=DB::fetch_object($resultUser);
		$podpiska = $objUser->podpiska;
		$id_user_info = $objUser->id_user_info;

		$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
		$objUserInfo=DB::fetch_object($resultUserInfo);
		$inn = $objUserInfo->inn;

		//Подключаем стили
		$id_style = $objData->id_style;
		$resultStyle = DB::query("SELECT * FROM `new_styles` WHERE `id`='$id_style'");
		$objStyle = DB::fetch_object($resultStyle);
		$style = $objStyle->name;

		$phoneN = substr_replace($PhonesNumb, "-", 3, 0);
		$phoneN = substr_replace($phoneN, "-", 6, 0);
		$phoneG = '+'.$PhonesCountry.' ('.$PhonesCode.') '.$phoneN;

		$pg = "$namepage";
		$title = "Благодарим за проявленый интерес"; //Магнит на вкладку
		$keywords = ''; //Понадобится для SEO
		$description = ''; //Понадобится для SEO
		$filename = "tmp/$namepage.php";

		include("../tmp/head_main.php");
		include("../tmp/header_main.php");
		include($filename);
		include("../tmp/footer_main.php");
	} else {
		header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/');
	}
?>