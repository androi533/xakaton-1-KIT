<?php
	include("conf/start.php");
	include("conf/session.php");
	include("conf/phpQuery-onefile.php");

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1);

	$user_id = $_SESSION[$market]['user_id']; //Необходим
	$idproject = $_SESSION[$market]['id_project']; //Необходим

		$sqlmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user` = '$user_id' AND `id_project`='$id_project'");
		$check = DB::num_rows($sqlmarketing); //здесь все
		if ($check>0) {
			$objmarketing = DB::fetch_object($sqlmarketing);
			$id_marketing = $objmarketing->id;
			$login = $objmarketing->yandex;
			$token = $objmarketing->token_yandex; //Оверважные выводим ошибки ( предлагаем заполнить для продолжения )
		} else {
			//Если нет записи маркетинг, тут надо создавать и на получение токена отправлять
			$login = 'vinhunter@ya.ru';
			$token = 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
			$id_marketing = '2';
		}

		//$camp_id = $_SESSION[$market]['camp_id'];
		$camp_id = '35503679'; //Необходим
		
		$sqlcountmarketinggroups = DB::query("SELECT * FROM `new_marketing_yandex_groups` WHERE `id_camp` = '$camp_id'");
		$checkyandexgroups = DB::num_rows($sqlcountmarketinggroups); //здесь все
		if ($checkyandexgroups>0) {
			$objcountmarketingcamps = DB::fetch_object($sqlcountmarketinggroups);
			$countmarketinggroupsold = $objcountmarketingcamps->count;
			$countmarketinggroupsnew = $countmarketinggroupsold + 1; //Тут проверка на ограничение 1000 кампаний на один Акк
			$groupname = $durl.'_'.$countmarketinggroupsnew;
		} else {
			$groupname = $durl.'_1';
		}

		$api = 'api';
		$typefunc = 'ads';
		$method = 'add';

  		$title = 'Заголовок 1';
  		$title2 = 'Заголовок 2';
  		$Text = 'Текст'.'Дедлайн'.'КолТуЭкшен';
  		$Href  = 'Не понял какая ссылка?'; //Основная
  		$Mobile = 'NO';
  		$DisplayUrlPath = 'доп урл';
  		$vcard_id = '';
  		$SitelinkSetId = '';
  		$AdExtensionIds = '';
  		$AdGroupId = '';

		$json = '{"method": "'.$method.'","params": { "Ads": [ { "TextAd": {  "Title": "'.$title.'", "Title2": "'.$title2.'", "Text" : "'.$Text.'", "Href" : "'.$Href.'", "Mobile" : "'.$Mobile.'", "DisplayUrlPath" : "'.$DisplayUrlPath.'", "VCardId" : '.$vcard_id.', "SitelinkSetId": "'.$SitelinkSetId.'", "AdExtensionIds": [ "'.$AdExtensionIds.'" ] }, "AdGroupId": '.$AdGroupId.' }] }}';

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
				//echo $body; //проверяю отчеты вообще есть?
				$jsonresult = json_decode($body);

				if (isset($jsonresult->error_code)) {
					if ($jsonresult->error_code == '91') {
						exit();
					}
					if ($jsonresult->error_code == '93') {

					}
				} else {
					if (empty($jsonresult->data)) {
						exit();
					}
				}
			}

			//print_r($jsonresult);

			if (count($jsonresult->result) > 0) {
				$group_id = $jsonresult->result->AddResults[0]->Id;
				echo "$vcard_id";

				$addwhit = DB::query("INSERT INTO `new_groups`(`value`, `id_camp`, `id_group`) VALUES ('$groupname', '$camp_id', '$counters', '$group_id')");

				if ($checkyandexgroups>0) {
					$countmarketinggroups = DB::query("UPDATE `new_marketing_yandex_groups` SET `count`='$countmarketinggroupsnew' WHERE `id_marketing`='$id_marketing'");
				} else {
					$countmarketinggroups = DB::query("INSERT INTO `new_marketing_yandex_groups`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
				}
			}
		}

	//result = 35503679
?>