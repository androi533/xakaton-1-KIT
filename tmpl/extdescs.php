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
	$id_user = '1';
	$id_phrase = '1';

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

	$hentry = $document->find('.organic__path a');

	foreach ($hentry as $el) {
		$elem_pq = pq($el);
		$url = $elem_pq->attr('href'); //Ссылки на конкурентов Яндексовская
		
		$url_text = explode('/', trim($elem_pq->text()))[1]; //Описание ссылки текст
		$texturl = explode('/', trim($elem_pq->text()))[0]; //Ссылка понятная

		$getreportcount = DB::query("SELECT * FROM `new_conk` WHERE `text`='$texturl'");
		$check = DB::num_rows($getreportcount);
		if ($check === 0) {
			$sendreport = DB::query("INSERT INTO `new_conk`(`id_user`, `id_phrase`, `href`, `text`) VALUES ('$id_user', '$id_phrase', '$url', '$texturl')");
		}
	}
?>