<?php
	include("../conf/start.php");
	include("../conf/session.php");
	include("../conf/phpQuery-onefile.php");

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1);

	$id_user = 1; //Необходим
	$id_project = 1; //Необходим
	$api = 'api';
	$type_phrase = 'usual';
	$id_type_phrase = '6';
	$durls[$id_project] = 'directologplus';

	$sqlmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user` = '$id_user' AND `id_project`='$id_project'");
	$check = DB::num_rows($sqlmarketing); //здесь все
	if ($check>0) {
		$objmarketing = DB::fetch_object($sqlmarketing);
		$id_marketing = $objmarketing->id;
		$login = explode('@', $objmarketing->yandex)[0];
		$logins[$id_marketing] = $login;
		$token = $objmarketing->token_yandex; //Оверважные выводим ошибки ( предлагаем заполнить для продолжения )
		$tokens[$id_marketing] = $token;
		$campslimits[$id_marketing] =  $objmarketing->campslimit_yandex;
		$groupslimits[$id_marketing] =  $objmarketing->groupslimit_yandex;
		$adslimits[$id_marketing] =  $objmarketing->adslimit_yandex;
		$budget = $objmarketing->budget;
		$budgets[$id_marketing]  = $budget;
	} else {
		//Если нет записи маркетинг, тут надо создавать и на получение токена отправлять
		$login = 'vinhunter';
		$token = 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
		$id_marketing = '2';
		$budge = '300';
	}

	if (!isset($sites[$id_project])) {
		$getProject = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");

		$objProject = DB::fetch_object($getProject);
		$addcounter = '';
		if ($objProject->yandex <> '') { //Не овер важные проверяем на пустоту Счётчик
			$counters = $objProject->yandex; //Не более 5 //По дефу делать один пока что...
			$addcounter = ',  "CounterIds": { "Items": ['.$counters.']}';
		}
		$addcounters[$id_project] = $addcounter;
		$durls[$id_project] = $objProject->durl;

		$href = $objProject->site;
		$sites[$id_project] = $href;
		$utm = $objProject->utm;
		$utms[$id_project] = $utm;
	} else {
		$href = $sites[$id_project];
		$utm = $utms[$id_project];
	}

	//$camp_id = $_SESSION[$market]['camp_id'];
	//$camp_id = '36256047'; //Необходим //43661335 43661335
	
	$countmarketingcampsnew = 1;
	$campname = '';
	$sqlCountMarketingCamps = DB::query("SELECT * FROM `new_marketing_yandex_camps` WHERE `id_marketing` = '$id_marketing'"); //ЭТО ПРОСТО СЧЕТЧИК!!!
	$checkYandexCamps = DB::num_rows($sqlCountMarketingCamps); //здесь все
	if ($checkYandexCamps > 0) {
		$objCountMarketingCamps = DB::fetch_object($sqlCountMarketingCamps);
		$countmarketingcampsold = $objCountMarketingCamps->count;
		$id_marketing_yandex_camps = $objCountMarketingCamps->id;
		$countmarketingcampsnew = $countmarketingcampsold + 1; //Тут проверка на ограничение 1000 кампаний на один Акк
	}

	if ($countmarketingcampsnew === $campslimits[$id_marketing]) {
		//Достигли предела по количеству кампаний
		//break;
	} else {
		if ($countmarketingcampsnew === 1) {
			//Значит группы нет
			$campname = $durls[$id_project].'_'.$type_phrase.'_'.$countmarketingcampsnew; //+ $type_phrase //RSY, HOT, COLD, HEAT, USUAL //sell, geo
		} else {

			$sqlCountMarketingGroups = DB::query("SELECT * FROM `new_marketing_yandex_groups` WHERE `id_camp` = '$id_marketing_yandex_camps'");
			$checkYandexGroups = DB::num_rows($sqlCountMarketingGroups); //здесь все
			if ($checkYandexGroups < $groupslimits[$id_marketing]) {
				//Значит группа есть, работаем в существующей кампании
				$campname = $durls[$id_project].'_'.$type_phrase.'_'.$countmarketingcampsold;
			} else {
				//Значит группа заполнена, и надо создать новую кампанию
				$campname = $durls[$id_project].'_'.$type_phrase.'_'.$countmarketingcampsnew;
			}
		}

		if ($campname <> '') {
			$sqlCamps = DB::query("SELECT * FROM `new_camps` WHERE `value` = '$campname' AND `id_marketing`='$id_marketing'");
			$check = DB::num_rows($sqlCamps); //здесь все
			if ($check === 0) {
				$typefunc = 'campaigns';
				$startdate = date('Y-m-d');

				$json .= '{"method": "add","params": { "Campaigns": [ { "Name":"'.$campname.'", "StartDate":"'.$startdate.'", "DailyBudget": { "Amount" : "'.$budget.'000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" : { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"}, {"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}]'.$addcounters[$id_project].' }  } ]}, "locale": "ru","token": "'.$token.'"}';
				$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
				$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
										 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
										 'Content-Type: application/json; charset=utf-8',
										 'Client-Login: '.$login,
										 'Accept-Language: ru',
										 'Host: '.$api.'.direct.yandex.com',
										 'Authorization: Bearer '.$token,
										 '');
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$serv_addr);
				curl_setopt($ch, CURLOPT_FAILONERROR, 1);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 3);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $post_headers);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

				try{
				    $result = curl_exec($ch);
				}
				catch(Exception $e){
				    print_r($e);
				}

				if($result === false)
				{
					print_r(curl_error($ch));
				}
				else
				{
					$info = curl_getinfo($ch);
					$pagecode = $info['http_code'];
					if ($pagecode == '200') {
						$header_size = $info['header_size'];
						$header = substr($result, 0, $header_size);
						$body = substr($result, $header_size);
						echo $body; //проверяю отчеты вообще есть?
						$jsonresult = json_decode($body);

						if (isset($jsonresult->error_code)) {
							if ($jsonresult->error_code == '91') {
								//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
								//sleep(5);
								//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
								//break;
							}
							if ($jsonresult->error_code == '93') {
								//$updatestatus = DB::query("UPDATE `new_phrases` SET `status`='1' WHERE  `phrase` =  '$parent'");
								//$deletereport = DB::query("DELETE FROM `new_phrases_report` WHERE  `parent` =  '$parent'");
								//break;
							}
						} else {
							if (empty($jsonresult->data)) {
								//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
								//sleep(5);
								//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
								//exit();

							}

							if (count($jsonresult->result) > 0) {
								$camp_id = $jsonresult->result->AddResults[0]->Id;
								echo "C $camp_id";
								//$_SESSION[$id_marketing]['camp_id'] = $camp_id;
								
								$addwhit = DB::query("INSERT INTO `new_camps`(`id_marketing`, `value`, `budget`, `metrika`, `id_camp`) VALUES ('$id_marketing', '$campname', '$budget', '".$addcounters[$id_project]."', '$camp_id')");
								$id_camp = DB::insert_id();

								if ( ($checkYandexCamps>0) AND ($checkYandexGroups < $groupslimits[$id_marketing]) ) {
									$countmarketingcamps = DB::query("UPDATE `new_marketing_yandex_camps` SET `count`='$countmarketingcampsnew' WHERE `id_marketing`='$id_marketing'");
								} else {
									$countmarketingcamps = DB::query("INSERT INTO `new_marketing_yandex_camps`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
									$id_marketing_yandex_camps = DB::insert_id();
								}
							}
						}
					}
				}
			} else {
				$objCamps = DB::fetch_object($sqlCamps);
				$id_camp = $objCamps->id;
			}
		}
	}
		
	echo " I $id_camp";
	//result = 35503679
?>