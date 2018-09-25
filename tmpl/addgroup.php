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
	$camp_id = '36773535';
	$id_camp = '6';
	$campname = 'directologplus_usual_1';
	$id_marketing_yandex_camps = '1';

	$sqlmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user` = '$id_user' AND `id_project`='$id_project'");
	$check = DB::num_rows($sqlmarketing); //здесь все
	if ($check>0) {
		$objmarketing = DB::fetch_object($sqlmarketing);
		$id_marketing = $objmarketing->id;
		$login_yandex = explode('@', $objmarketing->yandex)[0];
		$logins[$id_marketing] = $login_yandex;
		$token_yandex = $objmarketing->token_yandex; //Оверважные выводим ошибки ( предлагаем заполнить для продолжения )
		$tokens_inner[$id_marketing] = $token_yandex;
		$campslimits[$id_marketing] =  $objmarketing->campslimit_yandex;
		$groupslimits[$id_marketing] =  $objmarketing->groupslimit_yandex;
		$adslimits[$id_marketing] =  $objmarketing->adslimit_yandex;
		$budget = $objmarketing->budget;
		$budgets[$id_marketing]  = $budget;
	} else {
		//Если нет записи маркетинг, тут надо создавать и на получение токена отправлять
		$login_yandex = 'vinhunter';
		$token_yandex = 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
		$budget = '300';
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
		if (isset($objProject->region)) {
			$regions[$id_project] = $objProject->region;
		} else {
			$regions[$id_project] = "225";
		}
		$utm = $objProject->utm;
		$utms[$id_project] = $utm;
	} else {
		$href = $sites[$id_project];
		$utm = $utms[$id_project];
	}

	$NegativeKeywords = ''; //Список минус слов
	$sqlWords = DB::query("SELECT * FROM `new_words` WHERE `stopword` = '1'");
	$check=DB::num_rows($sqlWords);
	if ($check>0) {
		while ($word = DB::fetch_object($sqlWords)) {
			if ($NegativeKeywords == '') {
				$NegativeKeywords .= $word;
			} else {
				$NegativeKeywords .= ', '.$word;
			}
			
		}
	}
	
	//$camp_id = $_SESSION[$market]['camp_id'];
	//$camp_id = '35503679';
	$sqlCamps = DB::query("SELECT * FROM `new_camps` WHERE `id_marketing` = '$id_marketing' AND `value`='$campname'");
	$check = DB::num_rows($sqlCamps); //здесь все
	if ($check>0) {
		while ($objCamp = DB::fetch_object($sqlCamps)) {
			$camp_id = $objCamp->id_camp; //Как выбирать кампанию??? по имени
			$id_camp = $objCamp->id;
			$campname = $objCamp->value;
		}
	}

	$countMarketingGroupsNew = 1;
	$groupname = '';
	$sqlcountmarketinggroups = DB::query("SELECT * FROM `new_marketing_yandex_groups` WHERE `id_camp` = '$id_camp'");
	$checkYandexGroups = DB::num_rows($sqlcountmarketinggroups); //здесь все
	if ($checkYandexGroups>0) {
		$objCountMarketingGroups = DB::fetch_object($sqlcountmarketinggroups);
		$countMarketingGroupsOld = $objCountMarketingGroups->count;
		$id_marketing_yandex_groups =$objCountMarketingGroups->id;
		$countMarketingGroupsNew = $countMarketingGroupsOld + 1; //Тут проверка на ограничение 1000 кампаний на один Акк
	}

	if ($countMarketingGroupsNew === $groupslimits[$id_marketing]) {
		break;
	} else {
		if ($countMarketingGroupsNew === 1) {
			$groupname = $durls[$id_project].'_'.$countMarketingGroupsNew;
		} else {
			$sqlCountMarketingKeywords = DB::query("SELECT * FROM `new_marketing_yandex_keywords` WHERE `id_group` = '$id_marketing_yandex_groups'");
			$checkYandexKeywords = DB::num_rows($sqlCountMarketingKeywords); //здесь все
			if ($checkYandexKeywords < $adslimits[$id_marketing]) {
				$groupname = $durls[$id_project].'_'.$countMarketingGroupsOld;
			} else {
				$groupname = $durls[$id_project].'_'.$countMarketingGroupsNew;
			}
		}

		if ($groupname <> '') {
			$sqlCamps = DB::query("SELECT * FROM `new_groups` WHERE `value` = '$groupname' AND `id_camp`='$id_camp'");
			$check = DB::num_rows($sqlCamps); //здесь все
			if ($check === 0) {
				$typefunc = 'adgroups';
				
				if ($NegativeKeywords == '') {
					$json = '{"method": "add","params": { "AdGroups": [ { "Name":"'.$groupname.'", "CampaignId":"'.$camp_id.'", "RegionIds": ['.$regions[$id_project].'] }] }}'; //, "NegativeKeywords": { "Items" : ['.$NegativeKeywords.'] }  //Слова через запятую в " "
				} else {
					$json = '{"method": "add","params": { "AdGroups": [ { "Name":"'.$groupname.'", "CampaignId":"'.$camp_id.'", "RegionIds": ['.$regions[$id_project].'], "NegativeKeywords": { "Items" : ['.$NegativeKeywords.'] } }] }}'; //  //Слова через запятую в " "
				}
			}
		}
	}
	//echo "$json<br>";
	$api = 'api';
	$typefunc = 'adgroups';
	$method = 'add';

	$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
	$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
							 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
							 'Content-Type: application/json; charset=utf-8',
							 'Client-Login: '.$login_yandex,
							 'Accept-Language: ru',
							 'Host: '.$api.'.direct.yandex.com',
							 'Authorization: Bearer '.$token_yandex,
							 '');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$serv_addr); // set url to post to
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 3); // times out after 4s
	curl_setopt($ch, CURLOPT_POST, 1); // set POST method
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $post_headers); // set POST method
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json); // add POST fields

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
					//break;
				}
				if ($jsonresult->error_code == '93') {
					//break;
				}
			} else {
				if (empty($jsonresult->data)) {
					
				}
				if (count($jsonresult->result) > 0) {
					$group_id = $jsonresult->result->AddResults[0]->Id;
					//echo "$group_id";

					$insGroup = DB::query("INSERT INTO `new_groups`(`value`, `id_camp`, `id_group`, `regions`) VALUES ('$groupname', '$id_camp', '$group_id', '".$regions[$id_project]."')");

					if ( ($checkYandexGroups>0) AND ($checkYandexKeywords < $adslimits[$id_marketing]) ) {
						$updCountMarketingGroups = DB::query("UPDATE `new_marketing_yandex_groups` SET `count`='$countMarketingGroupsNew' WHERE `id_camp`='$id_marketing_yandex_camps'");
					} else {
						$insCountMarketingGroups = DB::query("INSERT INTO `new_marketing_yandex_groups`(`id_camp`, `count`) VALUES ('$id_marketing_yandex_camps', '1')");
						$id_marketing_yandex_groups = DB::insert_id();
					}
				}
			}
		}
	}

	//result = 35503679
?>