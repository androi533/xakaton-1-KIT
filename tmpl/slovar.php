<?php
	include("../conf/start.php");
	include("../conf/session.php");
	include("../conf/consts.php");
	include("../conf/phpQuery-onefile.php");

	$id_project = '1';
	$id_user = '1';

	if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
	{
		/**
		 * mb_ucfirst - преобразует первый символ в верхний регистр
		 * @param string $str - строка
		 * @param string $encoding - кодировка, по-умолчанию UTF-8
		 * @return string
		 */
		function mb_ucfirst($str, $encoding='UTF-8')
		{
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

	$getWords =  DB::query("SELECT * FROM `new_words`");
	while ($objWord = DB::fetch_object($getWords)) {
		$id_word = $objWord->id;
		$word = $objWord->word;
		$oldwords[$id_word] = $word;
		$oldwordsid[$word] = $id_word;
	}
	print_r($oldwords);

	$phrasestrs = 'лампа asd';
	$phrase_words = Words($phrasestrs);
	$apikey = $CONSTS['slovar_token'];

	for ($i=0; $i < count($phrase_words); $i++) { 
		$wordvr = $phrase_words[$i];
		$serv_addr = file_get_contents('https://dictionary.yandex.net/api/v1/dicservice.json/lookup?key='.$apikey.'&lang=ru-ru&text='.htmlspecialchars($wordvr));
		$sq = json_decode($serv_addr);
		$infform = $sq->def[0]->text;
		echo "inf: $infform $wordvr<br>";
		print_r($sq);
		if (!in_array($wordvr, $oldwords)) {
			$insWords =  DB::query("INSERT `new_words` SET `word` = '$wordvr', `id_project`='$id_project', `id_user`='$id_user'");
			$id_word = DB::insert_id();
			$NewWords[$id_word] = $wordvr;
			$oldwords[$id_word] = $wordvr;
			$oldwordsid[$wordvr] = $id_word;
			$sql = '';
			//ПОЛУЧАЮ ИНФИНИТИВНУЮ
			$serv_addr = file_get_contents('https://dictionary.yandex.net/api/v1/dicservice.json/lookup?key='.$apikey.'&lang=ru-ru&text='.htmlspecialchars($wordvr));
			$sq = json_decode($serv_addr);
			$infform = $sq->def[0]->text;
			echo "inf: $infform $wordvr<br>";
			print_r($sq);
			if ($infform == '') {
				$infform = $wordvr;
			}
			if (!in_array($infform, $oldwords)) {
				$insWord =  DB::query("INSERT `new_words` SET `word` = '$infform', `id_project`='$id_project', `id_user`='$id_user'");
				$id_infinitive = DB::insert_id();
				$oldwords[$id_infinitive] = $infform;
				$oldwordsid[$infform] = $id_infinitive;
			} else {
				$id_infinitive = $oldwordsid[$infform];
			}
			//ДОБАВЛЯЮ ИЛИ NULL
			$insWords =  DB::query("INSERT `new_words_change` SET `id_word` = '$id_word', `id_infinitive`='$id_infinitive'");
		} else {
			$id_word = $oldwordsid[$wordvr];
			$NewWords[$id_word] = $wordvr;
		}

		$getWordsChange =  DB::query("SELECT * FROM `new_words_change` WHERE `id_word`='$id_word'");
		$check = DB::num_rows($getWordsChange);
		if ($check>0) {
			$objWordsChange = DB::fetch_object($getWordsChange);
			if (isset($objWordsChange->id_infinitive)) {
				$id_infinitive = $objWordsChange->id_infinitive;
				$changeWords[$id_word] = $id_infinitive;
			} else {
				$changeWords[$id_word] = $id_word;
			}
		}
		
	}
	//print_r($NewWords);
	foreach ($NewWords as $id_word => $word) {
		echo "<br>$id_word $word";
	}
	echo "<br><br>";
	print_r($changeWords);

	

	foreach ($changeWords as $id_word => $id_new) {
		$word = $oldwords[$id_new];
		$newphrasewords[] = $word;
		echo "<br>$id_word $word";
	}

	sort($newphrasewords);
	$newphrase = '';
	$del = '';	
	for ($i=0; $i < count($newphrasewords); $i++) { 
		$word = $newphrasewords[$i];
		$newphrase .= $del . $word;
		if ($del === '') $del = ' ';
	}
	echo "<br>$newphrase<br>";
?>