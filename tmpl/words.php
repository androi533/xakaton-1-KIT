<?php
	/*include("../conf/start.php");
	include("../conf/session.php");
	include("../conf/consts.php");
	include("../conf/phpQuery-onefile.php");

	$id_project = '1';
	$id_user = '1';*/

	

	/*if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
	{
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
	}*/

	/*$getWords =  DB::query("SELECT * FROM `new_words`");
	while ($objWord = DB::fetch_object($getWords)) {
		$id_word = $objWord->id;
		$word = $objWord->word;
		$oldwords[$id_word] = $word;
		$oldwordsid[$word] = $id_word;
	}*/
	//print_r($oldwords);

	/*$phrasestrs = 'лампа asd';
	if (isset($_GET['phrase'])) {
		$phrasestrs = $_GET['phrase'];
	}*/

	$phrase_words = Words($phrasestr);
	//$apikey = $CONSTS['slovar_token'];
	//$codirovka = 'UTF-8';
	//echo "$phrasestrs";
	for ($i=0; $i < count($phrase_words); $i++) { 
		$wordvr = $phrase_words[$i];
		//echo "WO: $wordvr<br>";
		if (!in_array($wordvr, $oldwords)) {
			$insWords =  DB::query("INSERT `new_words` SET `word` = '$wordvr', `id_project`='$id_project', `id_user`='$id_user'");
			$id_word = DB::insert_id();
			echo "<br>ID WORD $id_word";
			//$NewWords[$id_word] = $wordvr;
			$oldwords[$id_word] = $wordvr;
			$oldwordsid[$wordvr] = $id_word;
			$sql = '';
			//ПОЛУЧАЮ ИНФИНИТИВНУЮ
			//echo mb_strlen($wordvr, $codirovka);
			if (mb_strlen($wordvr, $codirovka) < 4) {
				//echo "МЕНЬШЕ 4<br>";
				$infform = $wordvr;
			} else {
				//echo "БОЛЬШЕ 3<br>";
				$max_sim = 0;
				$min_lev = 100;
				$tr_wordvr = translitIt($wordvr);
				foreach ($oldwords as $id_word => $word) {
					if ($word <> $wordvr) {
						$tr_word = translitIt($word);
						similar_text($tr_word, $tr_wordvr, $procent_sim);
						$procent_sim = round($procent_sim);
						$procent_lev = levenshtein($tr_word, $tr_wordvr);
						//$procent_lev = $len_lev/mb_strlen($wordvr, $codirovka)*100;
						echo "SIM: $word $procent_sim<br>";
						echo "LEV: $len_lev $procent_lev<br>";
						if ($max_sim < $procent_sim) {
							$max_sim = $procent_sim;
						}
						if ($min_lev > $procent_lev) {
							$min_lev = $procent_lev;
						}
						if ( ($procent_sim >= 80) AND ($procent_lev < 5) ) {
							if ( ($procent_lev < $min_lev + 2) AND ($procent_sim > $max_sim - mb_strlen($word, $codirovka)- mb_strlen($wordvr, $codirovka)) ){
								$vrwords[] = $word;
							}
							
						}
					}
				}
				if (count($vrwords) > 0) {
					$min_len = mb_strlen($vrwords[0], $codirovka);
					$infform = $vrwords[0];
					for ($k=0; $k < count($vrwords); $k++) { 
						if ($min_len > mb_strlen($vrwords[$k], $codirovka)) {
							$min_len = mb_strlen($vrwords[$k], $codirovka);
							$infform = $vrwords[$k];
						}
					}
					//print_r($vrwords);
				} else {
					$infform = $wordvr;
				}
				//echo "INF: $infform<br>";
				
				//$ngram = NGramm($wordvr, 3, $codirovka);
				
			}
			
			if (!in_array($infform, $oldwords)) {
				$insWord =  DB::query("INSERT `new_words` SET `word` = '$infform', `id_project`='$id_project', `id_user`='$id_user'");
				$id_infinitive = DB::insert_id();
				$oldwords[$id_infinitive] = $infform;
				$oldwordsid[$infform] = $id_infinitive;
			} else {
				$id_infinitive = $oldwordsid[$infform];
			}
			$NewWords[$id_infinitive] = $infform;
			//ДОБАВЛЯЮ ИЛИ NULL
			$insWords =  DB::query("INSERT `new_words_change` SET `id_word` = '$id_word', `id_infinitive`='$id_infinitive'");
			for ($k=0; $k < count($vrwords); $k++) { 
				if ($infform <> $vrwords[$k]) {
					$id_word_vr = $oldwordsid[$vrwords[$k]];
					$insWords =  DB::query("UPDATE `new_words_change` SET `id_infinitive`='$id_infinitive' WHERE `id_word` = '$id_word_vr'");
				}
			}
		} else {
			$id_word = $oldwordsid[$wordvr];
			$NewWords[$id_word] = $wordvr;
			//echo "W $wordvr $id_word<br>";
		}
		//print_r($NewWords);

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
		} /*else {
			$getWordsChange =  DB::query("SELECT * FROM `new_words_change` WHERE `id_word`='$id_infinitive'");
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
		}*/
		
	}
	/*print_r($NewWords);
	foreach ($NewWords as $id_word => $word) {
		echo "<br>$id_word $word";
	}
	echo "<br><br>";
	print_r($changeWords);*/

	foreach ($changeWords as $id_word => $id_new) {
		$word = $oldwords[$id_new];
		$newphrasewords[] = $word;
		//echo "<br>$id_word $word";
	}

	sort($newphrasewords);
	$newphrase = '';
	$del = '';	
	for ($i=0; $i < count($newphrasewords); $i++) { 
		$word = $newphrasewords[$i];
		$newphrase .= $del . $word;
		if ($del === '') $del = ' ';
	}
	//echo "<br>$newphrase<br>";
?>