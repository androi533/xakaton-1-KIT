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
	$group_id = '2147483647';
	$phrasestr = 'лампы';
	$id_camp = '6';
	$campname = 'directologplus_usual_1';
	$id_marketing_yandex_camps = '1';
	$id_marketing_yandex_groups = '3';

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

		if (isset($objProject->costclick)) {
			$costclicks[$id_project] = $objProject->costclick;
		}

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

		$typefunc = 'keywords';
		$Bid = '';
		$ContextBid = '';
		if (isset($costclicks[$id_project])) {
			$bid_vr = $costclicks[$id_project] * 1000000;
			$Bid = ', "Bid": '.$bid_vr;
			$ContextBid = '';
		}

		$StrategyPriority = 'HIGH';
		$StrategyPriorityText = ', "StrategyPriority": "'.$StrategyPriority.'"';
		$json = '{"method": "add","params": { "Keywords": [{"Keyword": "'.$phrasestr.'", "AdGroupId": '.$group_id.$Bid.$ContextBid.$StrategyPriorityText.'}] }}';

		echo $json;

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
						//exit();
					}
					if ($jsonresult->error_code == '93') {

					}
				} else {
					if (empty($jsonresult->data)) {
						//exit();
					}

					if (count($jsonresult->result) > 0) {
						$keyword_id = $jsonresult->result->AddResults[0]->Id;
						echo "$keyword_id";

						//Добавляю в использующиеся и получаю её id
						$getPhrasesUsed = DB::query("SELECT * FROM `new_phrases_used` WHERE `id_phrase_unic`='$id_phrase_unic' AND `id_marketing`='$id_marketing'");
						$check = DB::num_rows($getPhrasesUsed);
						if ($check === 0) {
							//6 usual
							$type_phrase = 'usual';
							$id_type_phrase = 6;
							$insPhrasesUsed = DB::query("INSERT `new_phrases_used` SET `id_marketing`='$id_marketing', `id_phrase_unic`='$id_phrase_unic', `id_type_phrase`='$id_type_phrase', `numb`='$keyword_id'");
							$id_phrase_used = DB::insert_id();
						} else {
							$objPhrasesUsed = DB::fetch_object($getPhrasesUsed);
							$id_phrase_used = $objPhrasesUsed->id;
						}

						if ($checkyandexgroups>0) {
							$countmarketinggroups = DB::query("UPDATE `new_marketing_yandex_keywords` SET `count`='$countmarketinggroupsnew' WHERE `id_marketing`='$id_marketing'");
						} else {
							$countmarketinggroups = DB::query("INSERT INTO `new_marketing_yandex_keywords`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
						}
					}
				}
			}
		}

	//result = 35503679 14180138580
?>