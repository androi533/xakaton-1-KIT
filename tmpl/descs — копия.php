<?php
	include("../conf/start.php");
	include("../conf/session.php");
	include("../conf/consts.php");
	include("../conf/phpQuery-onefile.php");

	$c_zag2 = $CONSTS['ads_split_zag'];
	$c_zag2_2 = $CONSTS['ads_split_zag_2'];
	$c_not_zag2 = $CONSTS['ads_split_zag_2'];
	$codirovka = $CONSTS['ads_codirovka'];
	$Ngramm_count = $CONSTS['NGramm_count'];
	$descs_group = $CONSTS['descs_group'];
	$api = 'api';
	$token = 'AQAAAAABrN4OAAQw4BgjCogndUVSl7NGPZN6jVw';
	$login = 'vinhunter';

	if (!function_exists('mb_ucfirst') && extension_loaded('mbstring')) {
		function mb_ucfirst($str, $encoding='UTF-8') {
			$str = mb_ereg_replace('^[\ ]+', '', $str);
			$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
				   mb_substr($str, 1, mb_strlen($str), $encoding);
			return $str;
		}
	}

	function Words($string) {
		$vr = trim($string);
		$vr = preg_replace('/[^a-zA-Zа-яА-Я0-9 ]/ui', ' ', $vr);
		$vr = preg_replace('/\s/', ' ', $vr);
		$vr = trim($vr);
		$words = explode(' ', $vr);
		return $words;
	}

	function NGramm($string, $NGramm_count, $codirovka)
	{
		$vr_el = '  '.$string.'  ';

		for ($i=0; $i < mb_strlen($string, $codirovka) + 2 ; $i++) { 
			$vr = '';
			for ($j=0; $j < $NGramm_count; $j++) { 
				$vr .= mb_substr($vr_el, $j+$i, 1, $codirovka);
			}
			$Ngramm_Zag[$string][$i] = $vr;
		}

		return $Ngramm_Zag;
	}

	function translitIt($str)
    {
        $tr = array(
                "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
                "Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
                "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
                "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
                "У"=>"u","Ф"=>"f","Х"=>"x","Ц"=>"ts","Ч"=>"ch",
                "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
                "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
                "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
                "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
                "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
                "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
                "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
                "ы"=>"yi","ь"=>"'","э"=>"e","ю"=>"yu","я"=>"ya"
            );
            return strtr($str,$tr);
    }

	function DateFrmt($id_worktime) {
		$getprephrase =  DB::query("SELECT * FROM `new_worktime` WHERE `id` = '$id_worktime'");
	}

	$newphrase = 'настроить директ';
	$urlphrase = urlencode($newphrase);
	$urldirect = "https://yandex.ru/search/ads?text=".$urlphrase;

	$curl = curl_init($urldirect);
	curl_setopt($curl, CURLOPT_HEADER, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1); //следование 302 redirect 
	$html = curl_exec($curl);
	$document = phpQuery::newDocument($html); 
	$hentry = $document->find('.serp-meta__line');

	$len_descs = 0;
	foreach ($hentry as $el) {
		$elem_pq = pq($el);
		
		$textstr = trim($elem_pq->html());
		if (mb_strpos($textstr, 'Контактная информация')) {
			continue;
		}

		$textstrpq = phpQuery::newDocument($textstr);
		$hentryt = $textstrpq->find('.serp-meta__item');
		//$getprephrase =  DB::query("SELECT * FROM `new_phrases` WHERE `status` = '1'");
		//$getAdsDescs = DB::query("SELECT `new_consts`");
		foreach ($hentryt as $el2) {
			$elem_pq2 = pq($el2);
			$text = trim($elem_pq2->text());
			echo "DESC: $text<br>";
			$getAdsDescs = DB::query("SELECT * FROM `new_ads_descs` WHERE `value`= '$text'");
			$check = DB::num_rows($getAdsDescs);
			//where char_length(cc_type) = 15 //Для добора в описания подбирать только фразы до установленной длины
			if ($check == 0) {
				$insAdsDescs = DB::query("INSERT `new_ads_descs` SET `value`='$text'");
				$id_desc_vr = DB::insert_id();
				$id_descs_vr[] = $id_desc_vr;
				$text_descs_vr[$id_desc_vr] = $text;
			} else {
				$objAdsDescs = DB::fetch_object($getAdsDescs);
				$id_desc_vr = $objAdsDescs->id;
				$id_descs_vr[] = $id_desc_vr;
				$text_descs_vr[$id_desc_vr] = $objAdsDescs->value;
			}
			$len_descs += mb_strlen($text);
			if ($len_descs <= $CONSTS['yandex_len_descs_text']) {
				$used_descs[] = $id_desc_vr;
			}
		}
	}

	//adextensions
	$sqldescsfield = '';
	$sqlfastkinkval = '';
	$sqlfastlinkhref = '';
	$sqlfastkink = '';
	$del = '';
	$del_and = '';

	$typefunc = 'adextensions';
	$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
	$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
							 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
							 'Content-Type: application/json; charset=utf-8',
							 'Client-Login: '.$login,
							 'Accept-Language: ru',
							 'Host: '.$api.'.direct.yandex.com',
							 'Authorization: Bearer '.$token,
							 '');
	
	for ($h=0; $h < count($id_descs_vr); $h++) {
		if ($h == $CONSTS['yandex_len_descs_massive']) {
			echo "EXIT";
			break;
		}
		$l = $h + 1;
		$id_desc_vr = $id_descs_vr[$h];
		$text_desc_vr = $text_descs_vr[$id_desc_vr];

		$json = '{ "method": "add", "params": { "AdExtensions": [';
		$json .= '{ "Callout": { "CalloutText": "'.$text_desc_vr.'"} }';
		$json .= '] } }';


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
						//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
						//sleep(5);
						//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
						exit();
					}
					if ($jsonresult->error_code == '93') {
						//$updatestatus = DB::query("UPDATE `new_phrases` SET `status`='1' WHERE  `phrase` =  '$parent'");
						//$deletereport = DB::query("DELETE FROM `new_phrases_report` WHERE  `parent` =  '$parent'");
					}
				} else {
					/*if (empty($jsonresult->data)) {
						//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
						//sleep(5);
						//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
						echo "T";
						exit();
					}*/
					if (count($jsonresult->result) > 0) {
						$desc_id = $jsonresult->result->AddResults[0]->Id;
						//echo "ID: $desc_id $id_desc_vr $descs_group<br>";
						$insDescsGroup = DB::query("INSERT `new_ads_descs_group` SET `id_desc`='$id_desc_vr', `group`='$descs_group', `numb`='$desc_id'");
						/*$_SESSION[$market]['camp_id'] = $camp_id;

						$addwhit = DB::query("INSERT INTO `new_camps`(`value`, `budget`, `metrika`, `id_camp`) VALUES ('$campname', '$budget', '$counters', '$camp_id')");

						if ($checkyandexcamps>0) {
							$countmarketingcamps = DB::query("UPDATE `new_marketing_yandex_camps` SET `count`='$countmarketingcampsnew' WHERE `id_marketing`='$id_marketing'");
						} else {
							$countmarketingcamps = DB::query("INSERT INTO `new_marketing_yandex_camps`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
						}*/
					}
				}

			}
			
			
		}

		curl_close($ch);

		$sqldescsfield .= "$del`id_des$l`";
		$sqldescsval .= "$del'$id_desc_vr'";
		$sqldescssel .= "$del_and`id_des$l`='$id_desc_vr'";

		$del = ', ';
		$del_and = 'AND ';
	}

	//exit();
	//Здесь надо выбрать несколько десков объединить их в группу. И/Или менять код получения идентификаторов Дополнительных описаний на верху.
	/*$id_descs_group = $CONSTS['desc_group'];
	for ($h=0; $h < count($used_descs); $h++) {
		$id_desc = $used_descs[$h];
		$insDescsGroup = DB::query("INSERT `new_ads_descs_group` SET `id_desc`='$id_desc' AND `group`='$id_descs_group'");

		$sqldescsfield = '';
		$sqlfastkinkval = '';
		$sqlfastlinkhref = '';
		$sqlfastkink = '';
		$del = '';
		$del_and = '';
		$json = '{ "method": "add", "params": { "AdExtensions": [';
		for ($h=0; $h < count($id_descs_vr); $h++) {

			if ($h == $CONSTS['yandex_len_descs_massive']) {
				break;
			}

			$l = $h + 1;
			$id_desc_vr = $id_descs_vr[$h];
			$text_desc_vr = $text_descs_vr[$id_desc_vr];

			$sqldescsfield .= "$del`id_des$l`";
			$sqldescsval .= "$del'$id_desc_vr'";
			$sqldescssel .= "$del_and`id_des$l`='$id_desc_vr'";

			$json .= $del.'{ "Callout": { "CalloutText": "'.$text_desc_vr.'"} }';

			$del = ', ';
			$del_and = 'AND ';
		}
		$json .= '] } }';
	}*/

	
	

	//
	$getAdsDescsMarketing = DB::query("SELECT `new_ads_descs_marketing` WHERE `id_marketing`='$id_marketing' AND `group`='$id_descs_group'");
	$check = DB::num_rows($getAdsDescsMarketing);
	if ($check == 0) {
		$insAdsDescsMarketing = DB::query("INSERT `new_ads_descs_marketing` SET `id_marketing`='$id_marketing', `group`='$id_descs_group'");
		$id_desc = DB::insert_id();
	} else {
		$objAdsDescsMarketing = DB::fetch_object($getAdsDescsMarketing);
		$id_desc = $objAdsDescsMarketing->id;
	}

	$descs_group = $descs_group + 1;
	$CONSTS['descs_group'] = $descs_group;
	$insDescsGroup = DB::query("UPDATE `new_consts` SET `value`='$descs_group' WHERE  `field`='descs_group' ");

	echo "$id_desc";
?>