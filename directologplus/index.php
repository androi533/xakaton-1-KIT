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
	include("../conf/consts.php");
	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

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

	//ВОТ ТУТ ПЕРЕД ЗАГРУЗКОЙ ВО ВРЕМЯ ПАРСИНГА ВОРОНКИ ОПРЕДЕЛЯТЬ КАКОЙ ПРОЕКТ ГРУЗИТЬ В А/Б ТЕСТИРОВАНИИ

	$resultProjData = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$namepage'");
	$objData=DB::fetch_object($resultProjData);
	$id_project_data = $objData->id;
	$sendemail = $objData->email;
	$id_offer = $objData->id_offer;
	$id_offer2 = $objData->id_offer2;
	$id_desc = $objData->id_desc;
	$id_form = $objData->id_form;
	$id_phone = $objData->id_phone;
	$addition = $objData->addition;
	$link_addition = $objData->link_addition;

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

	//Здесь может быть А/Б тестирование
	$resultOffer = DB::query("SELECT * FROM `new_offers_main` WHERE `id`='$id_offer'");
	$objOffer=DB::fetch_object($resultOffer);

	$resultOffer2 = DB::query("SELECT * FROM `new_offers_add` WHERE `id`='$id_offer2'");
	$objOffer2=DB::fetch_object($resultOffer2);

	$resultDesc = DB::query("SELECT * FROM `new_descs` WHERE `id`='$id_desc'");
	$objDesc=DB::fetch_object($resultDesc);

	$resultDesc = DB::query("SELECT * FROM `new_forms` WHERE `id`='$id_form'");
	$objForm=DB::fetch_object($resultDesc);

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

	//Вот тут воронка следующего шага //Если я уже в воронке
	$step = 0; //Если воронки нет, то и шагов 0
	if (($nextvoronkaproj != 0) && (!$novoronka) ) {
		for ($i=0; $i < count($voronka['from']); $i++) {
			if ($voronka['from'][$i] == $id_project_data) {
				$nextvoronkaproj = $voronka['to'][$i];
				$step = $voronka['step'][$i];
			}
		}
	}

	//Подключаем стили
	$id_style = $objData->id_style;
	$resultStyle = DB::query("SELECT * FROM `new_styles` WHERE `id`='$id_style'");
	$objStyle = DB::fetch_object($resultStyle);
	$style = $objStyle->name;

	//Преобразуем номер телефона //Пока работа только с российскими номерами //может как то можно исправить???
	/*$phoneG = '+'.$objData->phone;
	$phoneG = substr_replace($phoneG, " (", 2, 0);
	$phoneG = substr_replace($phoneG, ") ", 7, 0);
	$phoneG = substr_replace($phoneG, "-", 12, 0);
	$phoneG = substr_replace($phoneG, "-", 15, 0);*/
	$phoneN = substr_replace($PhonesNumb, "-", 3, 0);
	$phoneN = substr_replace($phoneN, "-", 6, 0);
	$phoneG = '+'.$PhonesCountry.' ('.$PhonesCode.') '.$phoneN;

	$pg = "$namepage";
	$title = "(1) Новое сообщение"; //Магнит на вкладку
	$keywords = ''; //Понадобится для SEO
	$description = ''; //Понадобится для SEO
	$filename = "tmp/$namepage.php";

	if ($step > 1){ //страницу thankyou что произойдет? //НА СТРАНИЦЫ THANKYOU НЕТ НИ КАКОГО ВЗАИМОДЕЙСТВИЯ, но туда можно подкрутить скрипты для рекламы в фейсбук к примеру
		//Тут проверку надо адекватную сделать, пока убогая
		//Даже в проекте с одной странице (без воронки) могут храниться SID и т.п. Поэтому в коде ниже учесть $novoronka
		if (isset($_SESSION['market_'.$market]['SID'])) {
			if ((isset($_SESSION['market_'.$market]['phone'])) or (isset($_SESSION['market_'.$market]['email']))) {
				if (isset($_SESSION['market_'.$market]['email'])) {
					$login = $_SESSION['market_'.$market]['email'];
					$loginfield = 'email';
				}
				if (isset($_SESSION['market_'.$market]['phone'])) {
					$login = $_SESSION['market_'.$market]['phone'];
					$loginfield = 'phone';
				}


				$sqlthisuser = "SELECT * FROM `new_users` WHERE `$loginfield` = '$login' LIMIT 1";
				$resthisuser = DB::query($sqlthisuser);
				$check=DB::num_rows($resthisuser);
				if ($check > 0) {
					
					$thisuser = DB::fetch_object($resthisuser);

					$laststep = $thisuser->laststep;
					$sqlthisvoronka = "SELECT * FROM `new_voronka` WHERE `id_project` = '$id_project' AND `step` = '$laststep'";
					$resvoronka = DB::query($sqlthisvoronka);
					$thisvoronka = DB::fetch_object($resvoronka);
					$nextvoronka=$thisvoronka->id_project_data;

					if ($step < $laststep) {
						$sqlthisvoronkavext = "SELECT * FROM `new_project_data` WHERE `id` = '$nextvoronka' LIMIT 1"; //
						$resvoronka2=DB::query($sqlthisvoronkavext);
						$thisvoronka2=DB::fetch_object($resvoronka2);
						$voronka=$thisvoronka2->page;
						header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/'.$voronka.'.php');
						exit();
					}

					/*$laststep = $thisuser->laststep;
					for ($i=0; $i < count($voronka['from']); $i++) {
						if ($voronka['from'][$i] == $idprojectdata) {
							if ($voronka['step'][$i] <> $laststep) {
								$sqlthisvoronkavext = "SELECT * FROM `new_project_data` WHERE `id` = '$nextvoronkaproj' LIMIT 1"; //
								$resvoronka2=DB::query($sqlthisvoronkavext);
								$thisvoronka2=DB::fetch_object($resvoronka2);
								$voronka=$thisvoronka2->page;
								header ('location: '.$protocol.'://'.$sitemain.'/'.$str.'/'.$voronka.'.php');
								exit();
							} else {
								$nextvoronka = $voronka['to'][$i];
								//Если не главная страница, то вытащить все возможные данные по пользователю, и записать в SESSION !!! ВОТ ТУТ НАДО СДЕЛАТЬ
								//типа получить данные из new_user_info new_user_info_passport adress и тп...

								//Добавить проверки получаемых данных, если пустые - не запрашивать. И в $data и в SESSION добавить.  //ЗАЧЕМ?????????
								$idUserInfo = $thisuser->id_user_info;
								$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$idUserInfo'");
								$check=DB::num_rows($resultUserInfo);
								if ($check > 0) {
									$stradress = '';
									$objUserInfo=DB::fetch_object($resultUserInfo);
									$idUserInfoAdress = $objUserInfo->id_adress;
									$idUserInfoPassport = $objUserInfo->id_passport;
									if (!is_null($idUserInfoAdress)) {
										if ($stradress == '') {
											$stradress = "`id`='$idUserInfoAdress'";
										} else {
											$stradress = "`id`='$idUserInfoAdress'";
										}
									}

									$resultUserInfoPassport = DB::query("SELECT * FROM `new_user_info_passport` WHERE `id`='$idUserInfoPassport'");
									$check=DB::num_rows($resultUserInfoPassport);
									if ($check > 0) {
										$objUserInfoPassport=DB::fetch_object($resultUserInfoPassport);
										$idUserInfoAdressPropiska = $objUserInfoPassport->id_adress_propiska;
										$idUserInfoAdressBirth = $objUserInfoPassport->id_adress_birth;
										if (!is_null($idUserInfoAdressPropiska)) {
											if ($stradress == '') {
												$stradress = "`id`='$idUserInfoAdressPropiska'";
											} else {
												$stradress .= "OR `id`='$idUserInfoAdressPropiska'";
											}
										}
										if (!is_null($idUserInfoAdressBirth)) {
											if ($stradress == '') {
												$stradress = "`id`='$idUserInfoAdressBirth'";
											} else {
												$stradress .= "OR `id`='$idUserInfoAdressBirth'";
											}
										}
									}
									//В адресах пока что можно упростить и сделать просто строку в которой будет весь адрес, без деления на город и т.п.
									//А так конечно надо получать все данные, город, область и т.п.
									$resultUserInfoPassport = DB::query("SELECT * FROM `new_adress` WHERE `id`='$idUserInfoAdressPropiska' OR `id`='$idUserInfoAdressBirth' OR `id`='$idUserInfoAdress'");
									$check=DB::num_rows($resultUserInfoPassport);
									if ($check > 0) {
										while ($thisvoronka = DB::fetch_array($resvoronka)) {
											$objUserInfoPassport=DB::fetch_object($resultUserInfoPassport);
										}
										//Здесь пройти по массиву, со сравнение по id из idUserInfoAdressPropiska и других, для правильного сохранения в $data.
									}
								}								
							}
						}
					}*/
				} else { //ПОЛЬЗОВАТЕЛЬ С ТАКИМИ ТЕЛЕФОНОМ или EMAIL не зарегестрирован идем на главную
					header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/');
					exit();
				}

			} else { //В СЕССИИ нет ТЕЛЕФОНА или EMAIL идем на главную
				header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/');
				exit();
			}
		} else { //НЕТ АКТИВНОЙ СЕССИИ идем на главную
			header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/');
			exit();
		}
	} else {
		//Если мы пришли на главную, то введенные данные обнуляются
		destroySession();
	}
	//print_r($_SESSION['market_'.$market]);
	include("../tmp/head_main.php");
	include("../tmp/header_main.php");
	include($filename);
	include("../tmp/footer_main.php");
?>