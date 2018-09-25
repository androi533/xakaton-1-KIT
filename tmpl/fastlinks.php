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
	$id_marketing = '2';
	$id_project = '1';
	$id_phrase = '1';
	$id_user = '1';

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
	curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1);
	$html = curl_exec($curl);
	$document = phpQuery::newDocument($html);
	$hentry = $document->find('.sitelinks__item a'); //Находим все элементы с классом "organic__url-text" (селектор .organic__url-text)
	

	if (!isset($sites[$id_project])) {
		$getProject = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		$objProject = DB::fetch_object($getProject);
		$href = $objProject->site;
		$sites[$id_project] = $href;
		$utm = $objProject->utm;
		$utms[$id_project] = $utm;
	} else {
		$href = $sites[$id_project];
		$utm = $utms[$id_project];
	}

	$id_fastlink = NULL;
	$len_fastlinks = 0;
	foreach ($hentry as $el) {
		$elem_pq = pq($el); //pq - аналог $ в jQuery
		$url = $elem_pq->attr('href');
		$text = trim($elem_pq->text());
		
		$getAdsFastlinks = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `value`= '$text'");
		$check = DB::num_rows($getAdsFastlinks);
		if ($check === 0) {
			$insAdsFastlinks = DB::query("INSERT INTO `new_ads_fastlinks` SET `id_user_add`='$id_user', `id_phrase`='$id_phrase', `value`='$text'");
			$id_fastlink_vr = DB::insert_id();
			$id_fastlinks_vr[] = $id_fastlink_vr;
			$text_fastlinks_vr[$id_fastlink_vr] = $text;
		} else {
			$objAdsFastlinks = DB::fetch_object($getAdsFastlinks);
			$id_fastlink_vr = $objAdsFastlinks->id;
			$id_fastlinks_vr[] = $id_fastlink_vr;
			$text_fastlinks_vr[$id_fastlink_vr] = $objAdsFastlinks->value;
		}
		
		if ($len_fastlinks + mb_strlen($text, $codirovka) <= $CONSTS['yandex_len_sitelinks_text']) {
			$len_fastlinks += mb_strlen($text, $codirovka);
			$used_fastlinks[] = $id_fastlink_vr;
		}
	}

	$getAdsFastlinksMarketingNull = DB::query("SELECT * FROM `new_ads_fastlinks_marketing` WHERE `id_marketing`='$id_marketing'");
	$check = DB::num_rows($getAdsFastlinksMarketingNull);
	if ($check === 0) {
		$typefunc = 'sitelinks';
		$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
		$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
								 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
								 'Content-Type: application/json; charset=utf-8',
								 'Client-Login: '.$login,
								 'Accept-Language: ru',
								 'Host: '.$api.'.direct.yandex.com',
								 'Authorization: Bearer '.$token,
								 '');

		if (count($used_fastlinks) > 0) {

			$json = '{"method":"add","params":{"SitelinksSets": [{ "Sitelinks": [';
			for ($h=0; $h < count($used_fastlinks); $h++) {
				if ($h == $CONSTS['yandex_len_sitelinks_maxcount']) {
					break;
				}
				$l = $h + 1;
				$id_fastlink_vr = $used_fastlinks[$h];
				$val_fastlink_vr = $text_fastlinks_vr[$id_fastlink_vr];

				$sqlfastkinkfield .= "$del`id_fastlink$l`";
				$sqlfastkinkval .= "$del'$id_fastlink_vr'";
				$sqlfastkinksel .= "$del_and`id_fastlink$l`='$id_fastlink_vr'";

				$href_vr = $href.'#fast'.$l.$utm;
				$sqlfastlinkhref .= "$del_and`href$l`='$href_vr'";
				$sqlfastlinkhrefins .= "$del`href$l`='$href_vr'";

				$json .= $del.'{"Title" : "'.$val_fastlink_vr.'", "Href" : "'.$href_vr.'"}';

				$del = ', ';
				$del_and = ' AND ';
			}
			$json .= ']}]}}';

			$getAdsFastlinksHref = DB::query("SELECT * FROM `new_ads_fastlinks_href` WHERE $sqlfastlinkhref");
			$check = DB::num_rows($getAdsFastlinksHref);
			if ($check == 0) {
				$insAdsFastlinksHref = DB::query("INSERT INTO `new_ads_fastlinks_href` SET $sqlfastlinkhrefins");
				$id_fastlink_href = DB::insert_id();
			} else {
				$objAdsFastlinksHref = DB::fetch_object($getAdsFastlinksHref);
				$id_fastlink_href = $objAdsFastlinksHref->id;
			}

			$getAdsFastlinksGroup = DB::query("SELECT * FROM `new_ads_fastlinks_group` WHERE $sqlfastkinksel");
			$check = DB::num_rows($getAdsFastlinksGroup);
			if ($check == 0) {
				$insAdsFastlinksGroup = DB::query("INSERT INTO `new_ads_fastlinks_group` ($sqlfastkinkfield) VALUES ($sqlfastkinkval)");
				$id_fastlink_group = DB::insert_id();
			} else {
				$objAdsFastlinksGroup = DB::fetch_object($getAdsFastlinksGroup);
				$id_fastlink_group = $objAdsFastlinksGroup->id;
			}

			echo "H $id_fastlink_href G $id_fastlink_group<br>";

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
			echo "R $result";

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
					//echo "FASTLINK<br>";
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
						if (empty($jsonresult->data)) {

							//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
							//sleep(5);
							//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
							//exit();
						}
					}

					if (count($jsonresult->result) > 0) {
						$numb_fastlink = $jsonresult->result->AddResults[0]->Id;
						//echo "$numb_fastlink";

						$insAdsFastlinksMarketing = DB::query("INSERT INTO `new_ads_fastlinks_marketing` SET `id_marketing`='$id_marketing', `id_fastlink_group`='$id_fastlink_group', `id_fastlink_href`='$id_fastlink_href', `numb`='$numb_fastlink'");
						$id_fastlink = DB::insert_id();
					}
				}
			}
			curl_close($ch);
		}
	} else {
		$objAdsFastlinksMarketingNull = DB::fetch_object($getAdsFastlinksMarketingNull);
		$id_fastlink = $objAdsFastlinksMarketingNull->id;
	}

	echo $id_fastlink;
?>