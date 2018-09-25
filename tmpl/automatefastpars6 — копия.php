<?php
	require("../conf/start.php");
	require("../conf/session.php");
	require("../conf/consts.php");
	require("../conf/phpQuery-onefile.php");

	$c_zag2 = $CONSTS['ads_split_zag'];
	$c_zag2_2 = $CONSTS['ads_split_zag_2'];
	$c_not_zag2 = $CONSTS['ads_split_zag_2'];
	$codirovka = $CONSTS['ads_codirovka'];
	$Ngramm_count = $CONSTS['NGramm_count'];
	$api = 'api';
	$method = 'add';

	//$kirillica = 'cp1251';

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
		$resultWorktime =  DB::query("SELECT * FROM `new_worktime` WHERE `id` = '$id_worktime'");
		$objWorktime = DB::fetch_object($resultWorktime);

		$idWorktimeDays_s = $objWorktime->id_from_day - 1;
		$idWorktimeDays_po = $objWorktime->id_to_day - 1;
		$idWorktimeHours_s = $objWorktime->id_from_hour;
		$idWorktimeHours_po = $objWorktime->id_to_hour;
		
		if ($objWorktime->id_from_min <= 15) {
			$idWorktimeMin_s = '15';
		} elseif ( ($objWorktime->id_from_min > 15) AND ($objWorktime->id_from_min <= 30) ) {
			$idWorktimeMin_s = '30';
		} elseif ( ($objWorktime->id_from_min > 30) AND ($objWorktime->id_from_min <= 45) ) {
			$idWorktimeMin_s = '45';
		} else {
			$idWorktimeMin_s = '00';
		}
		
		if ($objWorktime->id_to_min <= 15) {
			$idWorktimeMin_po = '15';
		} elseif ( ($objWorktime->id_to_min > 15) AND ($objWorktime->id_to_min <= 30) ) {
			$idWorktimeMin_po = '30';
		} elseif ( ($objWorktime->id_to_min > 30) AND ($objWorktime->id_to_min <= 45) ) {
			$idWorktimeMin_po = '45';
		} else {
			$idWorktimeMin_po = '00';
		}

		return $idWorktimeDays_s.';'.$idWorktimeDays_po.';'.$idWorktimeHours_s.';'.$idWorktimeMin_s.';'.$idWorktimeHours_po.';'.$idWorktimeMin_po;
	}

	//Над задача, при записи фраз в префразы сразу готовить фразу по таблице замен... //Так решается проблема повторных запросов в ЯД... Но это не основная задача, поэтому может быть решена позже?

	//Тут еще отчёты формируются не по регионам, но это конечно тоже позже.

	//Вообще строки надо заменять на хешстроку и осуществлять поиск по этим хешам... Я конечно хз почему, вроде хешстрока та же строка...

	//Вроде должно работать

	//Вообще когда получаю фразы из префраз, их нужно приводить к типу по таблице замен, затем искать приведенную фразу в "пройденных фразах" которые уже искались, и, возможно, если искалась фраза очень давно, то повторить поиск.
	$getprephrase =  DB::query("SELECT * FROM `new_phrases` WHERE `status` = '1'");
	$check = DB::num_rows($getprephrase);
	if ($check>0) {
		$getWords =  DB::query("SELECT * FROM `new_words`");
		while ($objWord = DB::fetch_object($getWords)) {
			$id_word = $objWord->id;
			$word = $objWord->word;
			$oldwords[$id_word] = $word;
			$oldwordsid[$word] = $id_word;
		}
		//Получаю массив пользователей, которые вводили префразы, получаю id префраз, id проектов и сами фразы распределяя по двумерному массиву по пользователям
		//Тут вообще надо id префраз и сами фразы вкладывать в массив проектов
		while ($phrase = DB::fetch_object($getprephrase)) {
			$id_user = $phrase->id_user_add;
			$id_project = $phrase->id_project; //не должна быть NULL ? //не будет
			if (!in_array($id_user, $idusers)) {
				$idusers[] = $id_user;
			}
			if (!in_array($id_project, $idprojects[$id_user])) {
				$idprojects[$id_user][] = $id_project;
			}
			$idphrases[$id_user][$id_project][] = $phrase->id;
			$phrasestrs[$id_user][$id_project][] = $phrase->phrase;
		}

		//Прохожу по уникальным пользователям
		for ($i=0; $i < count($idusers); $i++) {
			$id_user = $idusers[$i];

			//Вот тут вот та самая задача, в разных проектах пользователь может иметь один и тот же логин, из за этого появляется сложность регулирования количества отчетов ведь максимум 5
			
			$yaloginsword = NULL; //Проверить надо занулять или нет?
			//так как тут выборка только по пользователю, то вполне правильные массивы получаются по логинам и прочее.
			$getmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user` = '$id_user'"); 
			while ($marketing = DB::fetch_object($getmarketing)) {
				$id_project = $marketing->id_project; //не используется
				$yandex = $marketing->yandex;
				if (!in_array($yandex, $yalogins)) {
					$yalogins[] = $yandex;
				}
				$idprojectslogin[$id_user][$yandex][] = $id_project;
				$idmarketings[$id_user][$id_project] = $marketing->id; //у одной почты может быть несколько рекламных проектов //тут тоже in_array //так то массив будет уникальным
				$tokens[$id_user][$yandex] = $marketing->token_yandex; //у одной почты всегда один токен
			}
			//че тут добавляю еще один обход по логинам ya почты, где то тут надо получить количество использованых отчетов по логину почты?
			for ($l=0; $l < count($yalogins); $l++) {
				$yandex = $yalogins[$l];
				$token_yandex = $tokens[$id_user][$yandex];

				$sqlreportstr = '';
				for ($p=0; $p < count($idprojectslogin[$id_user][$yandex]); $p++) {
					$id_project = $idprojectslogin[$id_user][$yandex][$p];
					//ну а собирать отчеты по id marketing только для начала сформировать сам запрос, запросить, и если 5 отчетов уже есть, значит едем дальше.
					if ($sqlreportstr == '') {
						$sqlreportstr = "`id_project`='$id_project' AND `status`<>'3'"; //3 ?
					} else {
						$sqlreportstr .= " OR `id_project`='$id_project' AND `status`<>'3'";
					}
				}
				//поэтому тут запрос //и пустое конечно обработать
				//echo "$sqlreportstr";
				if ( $sqlreportstr <> '' ) {
					$getreportcount = DB::query("SELECT * FROM `new_phrases_report` WHERE $sqlreportstr LIMIT $CONSTS['yandex_max_reports']"); //id_marketing тут нет есть id_project
					$reportcounts[$id_user][$token_yandex] = DB::num_rows($getreportcount);
					//если отчетов 5, идем по следующей почте
					if ($reportcounts[$id_user][$token_yandex] == $CONSTS['yandex_max_reports']) {
						echo "5";
						continue;
					} else {
						echo "MAX REP";
						//пройти по массиву проектов пользователя
						/*for ($j=0; $j < count($idprojects[$id_user]); $j++) {
							$id_project = $idprojects[$id_user][$j];

							//отправлять запросы на получение отчета надо по проектам/id marketing ?
							//по каждой фразе отдельно чтобы получать до 300 ключевиков
							for ($k=0; $k < count($phrasestrs[$id_user][$id_project]); $k++) {
								$phrasestr = $phrasestrs[$id_user][$id_project][$k];
								$id_phrase = $idphrases[$id_user][$id_project][$k];
								$id_marketing = $idmarketings[$id_user][$id_project];

								//Формировать массив, и проверять есть ли в массиве уже это значение
								if (!isset($logins[$id_marketing])) {
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
										$keywordslimits[$id_marketing] =  $objmarketing->keywordslimit_yandex;
										$budget = $objmarketing->budget;
										$budgets[$id_marketing]  = $budget;
									} else {
										//Если нет записи маркетинг, тут надо создавать и на получение токена отправлять
										$login_yandex = 'vinhunter';
										$token_yandex = 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
										$budget = '300';
									}
								} else {
									$login_yandex = $logins[$id_marketing];
									$token_yandex = $tokens_inner[$id_marketing];
									$budget  = $budgets[$id_marketing];
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
									$costclicks[$id_project] = $objProject->costclick;

									$href = $objProject->site;
									$sites[$id_project] = $href;
									$regions[$id_project] = $objProject->region;
									$utm = $objProject->utm;
									$utms[$id_project] = $utm;
								} else {
									$href = $sites[$id_project];
									$utm = $utms[$id_project];
								}

								//Получаю уникальную фразу
									//Получаю слова
									include('words.php');

									$getPhrasesUnic = DB::query("SELECT * FROM `new_phrases_unic` WHERE `changephrase`='$newphrase'");
									$check = DB::num_rows($getPhrasesUnic);
									if ($check>0) {
										$objPhrasesUnic = DB::fetch_object($getPhrasesUnic);
										$id_phrase_unic = $objPhrasesUnic->id;
									} else {
										$getPhrasesUnic = DB::query("INSERT `new_phrases_unic` SET `changephrase`='$newphrase'");
										$id_phrase_unic = DB::insert_id();
										$updPhrases =  DB::query("UPDATE `new_phrases` SET `id_phrase_unic`='$id_phrase_unic' WHERE `id` = '$id_phrase'");
									}

									//Добавляю в использующиеся и получаю её id
									$getPhrasesUsed = DB::query("SELECT * FROM `new_phrases_used` WHERE `id_phrase_unic`='$id_phrase_unic' AND `id_marketing`='$id_marketing'");
									$check = DB::num_rows($getPhrasesUsed);
									if ($check == 0) {
										//6 usual
										$type_phrase = 'usual';
										$id_type_phrase = 6;
										$insPhrasesUsed = DB::query("INSERT `new_phrases_used` SET `id_marketing`='$id_marketing', `id_phrase_unic`='$id_phrase_unic', `id_type_phrase`='$id_type_phrase'");
										$id_phrase_used = DB::insert_id();
									} else {
										//Если фраза уже есть, то надо валить отсюда
										continue;
									}
									//Полученный id использую в добавлении элементов ADS группы таблиц


									//Получаю Объявление
									$urlphrase = urlencode($newphrase);
									$urldirect = "https://yandex.ru/search/ads?text=".$urlphrase;

									$curl = curl_init($urldirect);
									curl_setopt($curl, CURLOPT_HEADER, 1);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
									curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1); //следование 302 redirect 
									$html = curl_exec($curl);

									$document = phpQuery::newDocument($html); //Загружаем полученную страницу в phpQuery
										//Заголовки
										$hentry = $document->find('.organic__url-text'); //Находим все элементы с классом "organic__url-text" (селектор .organic__url-text)

										$addphraseszag = '';

										foreach ($hentry as $el) {
											$elem_pq = pq($el); //pq - аналог $ в jQuery
											$url = $elem_pq->attr('href');
											$text = trim($elem_pq->text());
											
											$zag2 = '';
											if (mb_strpos($text, $c_zag2, 3, $codirovka) > 0) { //Здесь косяк с разделителями исправить на если много разделителей то на хер заголовок целиком
												$zags = explode($c_zag2, $text);
												$zag2 = trim($zags[1]);
												$zags2[] = $zag2;
											} elseif (mb_strpos($text, $c_not_zag2, 3, $codirovka) > 0) {
												$zags = explode($c_not_zag2, $text);
											} elseif (mb_strpos($text, $c_zag2_2, 3, $codirovka) > 0) {
												$zags = explode($c_zag2_2, $text);
												$zag2 = trim($zags[1]);
												$zags2[] = $zag2;
											}

											$zag1 = trim($zags[0])

											$zags1[] = mb_strtolower($zag1, $codirovka);
											$zags1_big[] = $zag1;

											if ($zag2 <> '') {
												$zags2[] = mb_strtolower($zag2, $codirovka);
												$zags2_big[] = $zag2;

												$getAdsZag2 = DB::query("SELECT * FROM `new_ads_zag2` WHERE `value`='$zag2'");
												$check = DB::num_rows($getAdsZag2);
												if ($check == 0) {
													$resaddphrasezag = DB::query("INSERT INTO `new_ads_zag2`(`id_user_add`, `id_phrase`, `value`) VALUES ('$id_user', '$id_phrase_unic' '$zag2')");
													$id_phrases_zag2[$zag2] = DB::insert_id();
												} else {
													$objAdsZag2 = DB::fetch_object($getAdsZag2);
													$id_phrases_zag2[$zag2] = $objAdsZag2->id;
													unset($zags2[count($zags2)-1]);
													unset($zags2_big[count($zags2_big)-1]);
												}
												$zagzag[$zag1] = $zag2;
											}

											$getAdsZag = DB::query("SELECT * FROM `new_ads_zag` WHERE `value`='$zag1'");
											$check = DB::num_rows($getAdsZag);
											if ($check == 0) {
												$resaddphrasezag = DB::query("INSERT INTO `new_ads_zag`(`id_user_add`, `id_phrase`, `value`) VALUES ('$id_user', '$id_phrase_unic' '$zag1')");
												$id_phrases_zag[$zag1] = DB::insert_id();
											} else {
												$objAdsZag = DB::fetch_object($getAdsZag);
												$id_phrases_zag[$zag1] = $objAdsZag->id;
												unset($zags1[count($zags1)-1]);
												unset($zags1_big[count($zags1_big)-1]);
											}

											
										}

										$phrase_words = Words($phrase);
										foreach ($phrase_words as $phrase_word) {
											$phrase_NGramm[$phrase][] = NGramm($phrase_word, $Ngramm_count, $codirovka);
										}

										$count_word_phrase = count($phrase_words);


										$max_len_zag = 0;
										$best_phrase = mb_ucfirst($phrase);

										foreach ($zags1 as $key => $value) {

											$phrase2 = $value;
											$phrase2_words = Words($phrase2);

											foreach ($phrase2_words as $phrase2_word) {
												$phrase2_NGramm[$phrase2][] = NGramm($phrase2_word,3, $codirovka);
											}

											$count_word_phrase2 = 0;

											foreach ($phrase_NGramm[$phrase] as $key3 => $phrase_word) { //прохожу по словам первой фразы 

												$wo1_arr = array_keys ($phrase_word);
												$wo1_val = $wo1_arr[0];
												$min_lev = 999;
												$max_sim = 0;
												$max_ngr = 0;
												$best_word = '';

												foreach ($phrase2_NGramm[$phrase2] as $key2 => $phrase2_word) { //по словам из заголовков ads
													$wo2_arr = array_keys ($phrase2_word);
													$wo2_val = $wo2_arr[0];
													//echo count($phrase2_word[$wo2_val]);
													if (count($phrase_word[$wo1_val]) < count($phrase2_word[$wo2_val])) {
														$ves_k = count($phrase_word[$wo1_val]); //количество NGramm
													} else {
														$ves_k =count($phrase2_word[$wo2_val]); //количество NGramm
													}
													
													if (!isset($ves[$ves_k])) {
														$ves_i = 1; //Переменная для ряда 1 2 3 5 8 13 //можно было конечно и ряд 1 2 3 4 5 6...
														$ves_s = 0; //Сумма весов
														$ves_pre = 1; //предыдущее значение веса
														for ($i=0; $i < $ves_k; $i++) {
															$ves_t = $ves_i * $ves_k;
															$ves[$ves_k][$ves_k - $i - 1] = $ves_t;
															$ves_s += $ves[$ves_k][$ves_k - $i - 1];
															$vr = $ves_i + $ves_pre;
															$ves_pre = $ves_i;
															$ves_i = $vr;
														}	

														for ($i=0; $i < $ves_k; $i++) {
															$ves_t = $ves[$ves_k][$i] / $ves_s;
															$ves[$ves_k][$i] = $ves_t;
														}

														ksort($ves[$ves_k]);
													}
													
													$count_NGramm = 0;
													$procent = 0;
													for ($i=0; $i < $ves_k ; $i++) {
														if (mb_strstr($phrase_word[$wo1_val][$i], $phrase2_word[$wo2_val][$i], $codirovka) !== false) {
															$count_NGramm += 1;
															$procent += $ves[$ves_k][$i];
														}
													}
													$procent = round($procent * 100);
													similar_text($wo1_val, $wo2_val, $procent_sim);
													$procent_sim = round($procent_sim);
													$procent_lev = levenshtein($wo1_val, $wo2_val);

													if ( ($min_lev > $procent_lev) AND ($max_sim < $procent_sim) AND ($max_ngr < $procent) ) {
														$max_ngr = $procent;
														$max_sim = $procent_sim;
														$min_lev = $procent_lev;
														$best_word = $wo2_val;
													}

													/*if ( ($min_lev < 4) AND ($max_sim > 60) AND ($max_ngr > 60) ) {
														echo "<br>СЛОВО ХОРОШЕЕ: $wo2_val<br>";
													}*/
												} //Прошел по всем словам ads

												$step = ($min_lev + 1) * (100 - $max_sim + 1) * (100 - $max_ngr + 1); //самое время понять на сколько хорошо слово из ключевой фразы в заголовке ads
												if ($step < 40000) {
													$count_word_phrase2 += 1;
												}
											}

											if ($count_word_phrase == $count_word_phrase2) { //А вот тут уже проверяем фразу целиком //Ну и надо подобрать самую длинную фразу
												if (mb_strlen($phrase2) > $max_len_zag) {
													$best_phrase = $zags1_big[$key];
													$max_len_zag = mb_strlen($phrase2);
												}
											}
										}

										$zag_val = $best_phrase;
										$id_zag = $id_phrases_zag[$zag_val];
										$getAdsZagMarketing = DB::query("SELECT `new_ads_zag_marketing` WHERE `id_marketing`='$id_marketing' AND `id_zag`='$id_zag')");
										$check = DB::num_rows($getAdsZagMarketing);
										$id_zag2toads = '';
										if ($check == 0) {
											$sendreport = DB::query("INSERT INTO `new_ads_zag_marketing`(`id_marketing`, `id_zag`) VALUES ('$id_marketing', '$id_zag')");
											$id_zagtoads = DB::insert_id();
											if (isset($zagzag[$zag_val])) {
												$zag2_val = $zagzag[$zag_val];
												$id_zag2 = $id_phrases_zag2[$zag2_val];
												$getAdsZag2Marketing = DB::query("SELECT `new_ads_zag2_marketing` WHERE `id_marketing`='$id_marketing' AND `id_zag2`='$id_zag2')");
												$check = DB::num_rows($getAdsZag2Marketing);
												if ($check == 0) {
													$sendreport = DB::query("INSERT INTO `new_ads_zag2_marketing`(`id_marketing`, `id_zag2`) VALUES ('$id_marketing', '$id_zag2')");
													$id_zag2toads = DB::insert_id();
												} else {
													$objAdsZag2Marketing = DB::fetch_object($getAdsZag2Marketing);
													$id_zag2toads = $objAdsZag2Marketing->id;
												}
											} else {
												//Здесь надо как то получить второй заголовок
											}
										} else {
											$objAdsZagMarketing = DB::fetch_object($getAdsZagMarketing);
											$id_zagtoads = $objAdsZagMarketing->id;
											$id_zag_val = $objAdsZagMarketing->id_zag;
											$getAdsZag = DB::query("SELECT `new_ads_zag` WHERE `id`='$id_zag_val')");
											$objAdsZag = DB::fetch_object($getAdsZag);
											$zag_val = $objAdsZag->value;
											if (mb_strlen($zag_val, $codirovka) <= $CONSTS['ads_len_zag2']) {
												$zag2_val = $zag_val;
											} else {
												//Здесь надо как то получить второй заголовок
											}
										}
										//Конец Заголовки


										//Текст объявления (короткий)
										/*$hentry = $document->find('.organic__text');
										$addphraseszag = '';
										foreach ($hentry as $el) {
											$elem_pq = pq($el); //pq - аналог $ в jQuery
											$text = trim($elem_pq->text());


											
											echo "$text<br>";
											if ($addphraseszag == '') {
												$addphraseszag = "('$id_user', '$id_phrase', '$text')";
											} else {
												$addphraseszag .= ", ('$id_user', '$id_phrase', '$text')";
											}
										}
										$sendreport = DB::query("INSERT INTO `new_ads_short`(`id_user`, `id_phrase`, `short`) VALUES $addphraseszag");*/
										$textAd = $zag_val;
										$getAdsShort = DB::query("SELECT `new_ads_short`(`value`) VALUES ('$textAd')");
										$check = DB::num_rows($getAdsShort);
										if ($check == 0) {
											$insAdsShort = DB::query("INSERT INTO `new_ads_short`(`id_user_add`, `id_phrase`, `short`) VALUES ('$id_user', '$id_phrase_unic', '$textAd')");
											$id_short_vr = DB::insert_id();
										} else {
											$objAdsShort = DB::fetch_object($getAdsShort);
											$id_short_vr = $objAdsShort->id;
										}
										
										$getAdsShortMarketing = DB::query("SELECT `new_ads_short_marketing` WHERE `id_marketing`='$id_marketing' AND `id_short`='$id_short_vr'");
										$check = DB::num_rows($getAdsShortMarketing);
										if ($check == 0) {
											$insAdsShortMarketing = DB::query("INSERT INTO `new_ads_short_marketing`(`id_marketing`, `id_short`) VALUES ('$id_marketing', '$id_short_vr')");
											$id_short = DB::insert_id();
										} else {
											$objAdsShortMarketing = DB::fetch_object($getAdsShortMarketing);
											$id_short = $objAdsShortMarketing->id;
										}
										//Конец Текст объявления


										//Быстрые ссылки
										$hentry = $document->find('.sitelinks__item a');
										$id_fastlink = NULL;
										$len_fastlinks = 0;
										foreach ($hentry as $el) {
											$elem_pq = pq($el);
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
																	 'Client-Login: '.$login_yandex,
																	 'Accept-Language: ru',
																	 'Host: '.$api.'.direct.yandex.com',
																	 'Authorization: Bearer '.$token_yandex
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
																//exit();
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
															$fastlink_id = $jsonresult->result->AddResults[0]->Id;
															//echo "$fastlink_id";

															$insAdsFastlinksMarketing = DB::query("INSERT INTO `new_ads_fastlinks_marketing` SET `id_marketing`='$id_marketing', `id_fastlink_group`='$id_fastlink_group', `id_fastlink_href`='$id_fastlink_href', `id_fastlink`='$fastlink_id'");
															$id_fastlink = DB::insert_id();
														}
													}
												}
												curl_close($ch);
											}
										} else {
											$objAdsFastlinksMarketingNull = DB::fetch_object($getAdsFastlinksMarketingNull);
											$id_fastlink = $objAdsFastlinksMarketingNull->id;
											$fastlink_id = $objAdsFastlinksMarketingNull->id_fastlink;

										}
									//Конец Быстрые ссылки

									//Дополнительные описания
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

											foreach ($hentryt as $el2) {
												$elem_pq2 = pq($el2);
												$text = trim($elem_pq2->text());
												//echo "DESC: $text<br>";
												$getAdsDescs = DB::query("SELECT * FROM `new_ads_descs` WHERE `value`='$text'");
												$check = DB::num_rows($getAdsDescs);
												//where char_length(cc_type) = 15 //Для добора в описания подбирать только фразы до установленной длины
												if ($check == 0) {
													$insAdsDescs = DB::query("INSERT INTO `new_ads_descs` SET `value`='$text'");
													$id_desc_vr = DB::insert_id();
													$id_descs_vr[] = $id_desc_vr;
													$text_descs_vr[$id_desc_vr] = $text;
												} else {
													$objAdsDescs = DB::fetch_object($getAdsDescs);
													$id_desc_vr = $objAdsDescs->id;
													$id_descs_vr[] = $id_desc_vr;
													$text_descs_vr[$id_desc_vr] = $objAdsDescs->value;
												}
												
												if ($len_descs + mb_strlen($text) <= $CONSTS['yandex_len_descs_text']) {
													$len_descs += mb_strlen($text);
													$used_descs[] = $id_desc_vr;
												}
											}
										}

										$id_desc = NULL;
										$hor = '';
										$AdExtensionIds = '';
										$getAdsDescsMarketingNull = DB::query("SELECT * FROM `new_ads_descs_marketing` WHERE `id_marketing`='$id_marketing'");
										$check = DB::num_rows($getAdsDescsMarketingNull);
										if ($check === 0) {
											$typefunc = 'adextensions';
											$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
											$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
																	 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
																	 'Content-Type: application/json; charset=utf-8',
																	 'Client-Login: '.$login_yandex,
																	 'Accept-Language: ru',
																	 'Host: '.$api.'.direct.yandex.com',
																	 'Authorization: Bearer '.$token_yandex
																	 '');
											
											for ($h=0; $h < count($used_descs); $h++) {
												$l = $h + 1;
												$id_desc_vr = $used_descs[$h];
												$text_desc_vr = $text_descs_vr[$id_desc_vr];

												$json = '{ "method": "add", "params": { "AdExtensions": [';
												$json .= '{ "Callout": { "CalloutText": "'.$text_desc_vr.'"} }';
												$json .= '] } }';

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
														$jsonresult = json_decode($body);

														if (isset($jsonresult->error_code)) {
															if ($jsonresult->error_code == '91') {

															}
															if ($jsonresult->error_code == '93') {

															}
														} else {
															if (count($jsonresult->result) > 0) {
																$desc_id = $jsonresult->result->AddResults[0]->Id;
																//echo "H $h D $desc_id<br>";

																$AdExtensionIds .= $hor.$desc_id;
																$hor = ', ';
																$insDescsGroup = DB::query("INSERT `new_ads_descs_group` SET `id_desc`='$id_desc_vr', `group`='$descs_group', `numb`='$desc_id'");
															}
														}
													}
												}

												curl_close($ch);
											}

											$getAdsDescsMarketing = DB::query("SELECT * FROM `new_ads_descs_marketing` WHERE `id_marketing`='$id_marketing' AND `group`='$descs_group'");
											$check = DB::num_rows($getAdsDescsMarketing);
											if ($check === 0) {
												$insAdsDescsMarketing = DB::query("INSERT INTO `new_ads_descs_marketing` SET `id_marketing`='$id_marketing', `group`='$descs_group'");
												$id_desc = DB::insert_id();
												$descs_group = $descs_group + 1;
												$CONSTS['descs_group'] = $descs_group;
												$insDescsGroup = DB::query("UPDATE `new_consts` SET `value`='$descs_group' WHERE  `field`='descs_group' ");
											}
										} else {
											$objAdsDescsMarketingNull = DB::fetch_object($getAdsDescsMarketingNull);
											$id_desc = $objAdsDescsMarketingNull->id;
										}
									//Конец Дополнительные описания


									//Описание ссылки и Ссылки на конкурентов
									$hentry = $document->find('.organic__path a');
									$url_desc = '';
									foreach ($hentry as $el) {
										$elem_pq = pq($el);
										$url = $elem_pq->attr('href'); //Ссылки на конкурентов Яндексовская
										
										$url_text = explode('/', trim($elem_pq->text()))[1]; //Описание ссылки текст
										if ($url_desc == '') {
											$url_desc = $url_text;
										}
										$texturl = explode('/', trim($elem_pq->text()))[0]; //Ссылка понятная

										$getreportcount = DB::query("SELECT * FROM `new_conk` WHERE `text`='$texturl'");
										$check = DB::num_rows($getreportcount);
										if ($check === 0) {
											$sendreport = DB::query("INSERT INTO `new_conk`(`id_user`, `id_phrase`, `href`, `text`, `url_text`) VALUES ('$id_user', '$id_phrase', '$url', '$texturl', '$url_text')");
										}
									}
									//Конец Описание ссылки и Ссылки на конкурентов

								//Конец обработки объявления

								//Создание кампаний API Direct и Получение id у полученых элементов: быстрые ссылки, описания //UTP и DEADLINE че как куда?
									//Добавить кампанию
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
										break;
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

												$json .= '{"method": "add","params": { "Campaigns": [ { "Name":"'.$campname.'", "StartDate":"'.$startdate.'", "DailyBudget": { "Amount" : "'.$budget.'000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" : { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"}, {"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}]'.$addcounters[$id_project].' }  } ]}, "locale": "ru","token": "'.$token_yandex.'"}';
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

														if (isset($jsonresult->error_code)) { //ДОДЕЛАТЬ Обработка ощибок везде в API
															if ($jsonresult->error_code == '91') {
																//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
																//sleep(5);
																//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
																break;
															}
															if ($jsonresult->error_code == '93') {
																//$updatestatus = DB::query("UPDATE `new_phrases` SET `status`='1' WHERE  `phrase` =  '$parent'");
																//$deletereport = DB::query("DELETE FROM `new_phrases_report` WHERE  `parent` =  '$parent'");
																break;
															}
														} else {
															if (empty($jsonresult->data)) {
																//$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
																//sleep(5);
																//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
																//exit();

															}

															if (count($jsonresult->result) > 0) {
																$camp_id = $jsonresult->result->AddResults[0]->Id; //ТОЖЕ НУЖЕН ДЛЯ КАРТОЧКИ // ВОЗМОЖНО ЕСЛИ УЖЕ ЕСТЬ ЗНАЧИТ КАРТОЧКА ТОЖЕ, НО ЕСЛИ НЕ ДОБАВЛЯЛИ ДАННЫЕ, А ЕСЛИ ДОБАВИЛИ И ЕСТЬ ВОЗМОЖНО ДОБАВИТЬ КАРТОЧКУ, ДУМАТЬ...
																//echo "C $camp_id";
																//$_SESSION[$id_marketing]['camp_id'] = $camp_id;
																
																$addwhit = DB::query("INSERT INTO `new_camps`(`id_marketing`, `value`, `budget`, `metrika`, `id_camp`) VALUES ('$id_marketing', '$campname', '$budget', '".$addcounters[$id_project]."', '$camp_id')");
																$id_camp = DB::insert_id();

																if ( ($checkYandexCamps>0) AND ($checkYandexGroups < $groupslimits[$id_marketing]) ) {
																	$countmarketingcamps = DB::query("UPDATE `new_marketing_yandex_camps` SET `count`='$countmarketingcampsnew' WHERE `id_marketing`='$id_marketing'");
																} else {
																	$countmarketingcamps = DB::query("INSERT INTO `new_marketing_yandex_camps`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
																}
															}
														}
													}
												}
											} else {
												$objCamps = DB::fetch_object($sqlCamps);
												$id_camp = $objCamps->id;
												$camp_id = $objCamps->id_camp;
											}
										}
									}
									//Конец Добавить кампанию

									//Добавить группу объявлений
									$groupname = '';
									if ($campname <> '') {
										$countMarketingGroupsNew = 1;
										$sqlcountmarketinggroups = DB::query("SELECT * FROM `new_marketing_yandex_groups` WHERE `id_camp` = '$id_camp'");
										$checkYandexGroups = DB::num_rows($sqlcountmarketinggroups); //здесь все
										if ($checkYandexGroups>0) {
											$objCountMarketingGroups = DB::fetch_object($sqlcountmarketinggroups);
											$countMarketingGroupsOld = $objCountMarketingGroups->count;
											$id_marketing_yandex_groups =$objCountMarketingGroups->id;
											$countMarketingGroupsNew = $countMarketingGroupsOld + 1; //Тут проверка на ограничение 1000 кампаний на один Акк
										}

										if ($countMarketingGroupsNew === $groupslimits[$id_marketing]) {
											//Достигли предела по количеству групп: на самом деле этот вопрос решается в коде добавления кампании, но оставляю для полной логики.
											break;
										} else {
											if ($countMarketingGroupsNew === 1) {
												$groupname = $durls[$id_project].'_'.$countMarketingGroupsNew;
											} else {
												$sqlCountMarketingKeywords = DB::query("SELECT * FROM `new_marketing_yandex_keywords` WHERE `id_group` = '$id_marketing_yandex_groups'");
												$checkYandexKeywords = DB::num_rows($sqlCountMarketingKeywords); //здесь все
												if ($checkYandexKeywords < $keywordslimits[$id_marketing]) {
													$groupname = $durls[$id_project].'_'.$countMarketingGroupsOld;
												} else {
													$groupname = $durls[$id_project].'_'.$countMarketingGroupsNew;
												}
											}

											if ($groupname <> '') {
												$sqlGroups = DB::query("SELECT * FROM `new_groups` WHERE `value` = '$groupname' AND `id_camp`='$id_camp'");
												$check = DB::num_rows($sqlGroups); //здесь все
												if ($check === 0) {
													$typefunc = 'adgroups';
													
													if ($NegativeKeywords == '') {
														$json = '{"method": "add","params": { "AdGroups": [ { "Name":"'.$groupname.'", "CampaignId":"'.$camp_id.'", "RegionIds": ['.$regions[$id_project].'] }] }}'; //, "NegativeKeywords": { "Items" : ['.$NegativeKeywords.'] }  //Слова через запятую в " "
													} else {
														$json = '{"method": "add","params": { "AdGroups": [ { "Name":"'.$groupname.'", "CampaignId":"'.$camp_id.'", "RegionIds": ['.$regions[$id_project].'], "NegativeKeywords": { "Items" : ['.$NegativeKeywords.'] } }] }}'; //  //Слова через запятую в " "
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
																	$id_group = DB::insert_id();

																	if ( ($checkYandexGroups>0) AND ($checkYandexKeywords < $keywordslimits[$id_marketing]) ) {
																		$updCountMarketingGroups = DB::query("UPDATE `new_marketing_yandex_groups` SET `count`='$countMarketingGroupsNew' WHERE `id_camp`='$id_marketing_yandex_camps'");
																	} else {
																		$insCountMarketingGroups = DB::query("INSERT INTO `new_marketing_yandex_groups`(`id_camp`, `count`) VALUES ('$id_marketing_yandex_camps', '1')");
																		$id_marketing_yandex_groups = DB::insert_id();
																	}
																}
															}
														}
													}
												} else {
													$objGroups = DB::fetch_object($sqlGroups);
													$id_group = $objGroups->id;
													$group_id = $objGroups->id_group;
												}
											}
										}
									}
									//Конец Добавить группу объявлений
									
									//Добавить ключевой запрос
									if ($group_id <> '') {
										$countMarketingKeywordsNew = 1;
										$sqlCountMarketingKeywords = DB::query("SELECT * FROM `new_marketing_yandex_keywords` WHERE `id_group` = '$id_group'");
										$checkYandexKeywords = DB::num_rows($sqlCountMarketingKeywords); //здесь все
										if ($checkYandexKeywords>0) {
											$objCountMarketingKeywords = DB::fetch_object($sqlCountMarketingKeywords);
											$countMarketingKeywordsOld = $objCountMarketingKeywords->count;
											$id_marketing_yandex_keywords =$objCountMarketingKeywords->id;
											$countMarketingKeywordsNew = $countMarketingKeywordsOld + 1; //Тут проверка на ограничение 1000 кампаний на один Акк //В ключевиках не надо доп проверки это крайний элемент, проверяется уже в группах, счетчик нужен для счетчика групп.
										}

										if ($countMarketingKeywordsNew === $keywordslimits[$id_marketing]) { //Ни когда не произойдет
											//Достигли предела по количеству групп: на самом деле этот вопрос решается в коде добавления кампании, но оставляю для полной логики.
											break;
										} else {
											$sqlKeywords = DB::query("SELECT * FROM `new_keywords` WHERE `id_phrase` = '$id_phrase_used' AND `id_group`='$id_group'");
											$check = DB::num_rows($sqlKeywords); //здесь все
											if ($check === 0) {

												$typefunc = 'keywords';
												$Bid = '';
												$ContextBid = '';
												$Bidsql = '';
												if (isset($costclicks[$id_project])) {
													$bid_vr = $costclicks[$id_project] * 1000000;
													$Bidsql = ", `bid`='$bid_vr', `bid_context`='$bid_vr'";
													$Bid = ', "Bid": '.$bid_vr;
													$ContextBid = ''; //По формуле или как то рассчитывать
												}

												$StrategyPrioritySQL = '';

												$StrategyPriority = 'HIGH';
												$StrategyPriorityText = ', "StrategyPriority": "'.$StrategyPriority.'"';
												$StrategyPrioritySQL = ", `priority`='$StrategyPriority'";
												$json = '{"method": "add","params": { "Keywords": [{"Keyword": "'.$phrasestr.'", "AdGroupId": '.$group_id.$Bid.$ContextBid.$StrategyPriorityText.'}] }}';

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
																//В использующиеся попадает только сейчас, тогда что там было выше???

																$insKeywords = DB::query("INSERT `new_keywords` SET `id_phrase`='$id_phrase_unic', `id_group`='$id_group', `id_keyword`='$keyword_id'$Bidsql $StrategyPrioritySQL");
																$id_keyword = DB::insert_id();

																if ( ($checkYandexKeywords>0) AND ($checkYandexKeywords < $keywordslimits[$id_marketing]) ) {
																	$updCountMarketingKeywords = DB::query("UPDATE `new_marketing_yandex_keywords` SET `count`='$countMarketingKeywordsNew' WHERE `id_group`='$id_group'");
																} else {
																	$insCountMarketingKeywords = DB::query("INSERT INTO `new_marketing_yandex_keywords`(`id_group`, `count`) VALUES ('$id_group', '1')");
																	$id_marketing_yandex_keywords = DB::insert_id();
																}
															}
														}
													}
												}
											} else {
												$objKeywords = DB::fetch_object($sqlKeywords);
												$id_keyword = $objKeywords->id;
												$keyword_id = $objKeywords->id_keyword;
											}
										}
									}
									//Конец Добавить ключевой запрос

									//Добавить карточку
									if ($id_camp <> '') {
										$sqlVcards = DB::query("SELECT * FROM `new_vcards` WHERE `id_camp` = '$id_camp'");
										$check = DB::num_rows($sqlVcards); //здесь все
										if ($check === 0) {
											$typefunc = 'vcards';
											$method = 'add';

											$Country = '';
											$City = '';
											$CompanyName = '';
											$WorkTime = '';
											$CountryCode = '';
											$CityCode = '';
											$PhoneNumber = '';
											$Extended = '';
											$Street = '';
											$House = '';
											$Building = '';
											$Apartment = '';
											$ExtraMessage = '';
											$ContactEmail = '';
											$Ogrn = '';
											$ContactPerson = '';
											$MetroStationId = '';
											//$MetroStationId = ', "MetroStationId":"'.$Metro.'"';

											$sqlAddressProject = DB::query("SELECT * FROM `new_address_project` WHERE `id_project` = '$id_project' AND `main`='1'");
											$checkAdressProject = DB::num_rows($sqlAddressProject);
											if ($checkAdressProject>0) {
												$objAddressProject = DB::fetch_object($sqlAddressProject);
												$id_address_proj = $objAddressProject->id_address;

												$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
												$objAddress = DB::fetch_object($resultAddress);
												$id_country_proj = $objAddress->id_country;
												$id_regions_proj = $objAddress->id_regions;
												$id_city_proj = $objAddress->id_city;
												if (isset($objAddress->home)) {
													if ($objAddress->home <> '') {
														$House = ', "House": "'.$objAddress->home.'"';
													}
												}
												if (isset($objAddress->corpus)) {
													if ($objAddress->corpus <> '') {
														$Building = ', "Building": "'.$objAddress->corpus.'"';
													}
												}
												if (isset($objAddress->flat)) {
													if ($objAddress->flat <> '') {
														$Apartment = ', "Apartment": "'.$objAddress->flat.'"';
													}
												}

												$resultAddressStreet = DB::query("SELECT * FROM `new_adress_street` WHERE `id`='$id_city_proj' LIMIT 1");
												$check = DB::num_rows($resultAddressStreet);
												if ($check>0) {
													$objAddressStreet = DB::fetch_object($resultAddressStreet);
													$Street = ', "Street": "'.$objAddressStreet->street.'"';
												}

												$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_regions_proj' LIMIT 1");
												$check = DB::num_rows($resultAddressRegion);
												if ($check>0) {
													$objAddressRegion = DB::fetch_object($resultAddressRegion);
													$Region = $objAddressRegion->region;
												}

												$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id`='$id_city_proj' LIMIT 1");
												$check = DB::num_rows($resultAddressCity);
												if ($check>0) {
													$objAddressCity = DB::fetch_object($resultAddressCity);
													$City = $objAddressCity->city;
												}

												$resultAddressCounty = DB::query("SELECT * FROM `new_adress_country` WHERE `id`='$id_country_proj' LIMIT 1");
												$check = DB::num_rows($resultAddressCounty);
												if ($check>0) {
													$objAddressCounty = DB::fetch_object($resultAddressCounty);
													$Country = $objAddressCounty->country;
													$CountryCode = $objAddressCounty->numb;
												}
											}

											$resultUser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' LIMIT 1");
											$check = DB::num_rows($resultUser);
											if ($check>0) {
												$objUser = DB::fetch_object($resultUser);
												if (isset($objUser->id_phone)) {
													$id_phone = $objUser->id_phone;
												}
												if (isset($objUser->id_user_info)) {
													$id_user_info = $objUser->id_user_info;
													$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info' LIMIT 1");
													$objUserInfo = DB::fetch_object($resultUserInfo);
													$ContactPerson = '';
													$space = '';
													if (isset($objUserInfo->name)) {
														if ($objUserInfo->name <> '') {
															$ContactPerson .= ', "ContactPerson" : "'.$space.$objUserInfo->name;
															$space = ' ';
														}
													}
													if (isset($objUserInfo->soname)) {
														if ($objUserInfo->soname <> '') {
															$ContactPerson .= $space.$objUserInfo->soname;
														}
													}
													if ($ContactPerson <> '') {
														$ContactPerson .= '"';
													}
												}
											}

											$resultProject = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project' LIMIT 1");
											$check = DB::num_rows($resultProject);
											if ($check>0) {
												$objProject = DB::fetch_object($resultProject);
												if (isset($objProject->ogrn)) {
													if ($objProject->ogrn <> '') {
														$Ogrn = ', "Ogrn": "'.$objProject->ogrn.'"';
													}
												}
												if (isset($objProject->about)) {
													if ($objProject->about <> '') {
														$ExtraMessage = ', "ExtraMessage":"'.$objProject->about.'"';
													}
												}
												if (isset($objProject->company_name)) {
													if ($objProject->company_name <> '') {
														$CompanyName = $objProject->company_name;
													}
												}
											}

											$resultProjectData = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='index' LIMIT 1");
											$check = DB::num_rows($resultProjectData);
											if ($check>0) {
												$objProjectData = DB::fetch_object($resultProjectData);
												if (isset($objProjectData->email)) {
													if ($objProjectData->email <> '') {
														$ContactEmail = ', "ContactEmail":"'.$objProjectData->email.'"';
													}
												}
												if (isset($objProjectData->id_phone)) {
													$id_phone = $objProjectData->id_phone;
												}
											}

											if (isset($id_phone)) {
												$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `id`='$id_phone' LIMIT 1");
												$check = DB::num_rows($resultPhones);
												if ($check>0) {
													$objPhones = DB::fetch_object($resultPhones);
													$id_phone_country = $objPhones->id_country;
													$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$id_phone_country' LIMIT 1");
													$check = DB::num_rows($resultPhonesCountry);
													if ($check>0) {
														$objPhonesCountry = DB::fetch_object($resultPhonesCountry);
														$CountryCode = $objPhonesCountry->value;
													}
													$id_phone_city = $objPhones->id_city;
													$resultPhonesCity = DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$id_phone_city' LIMIT 1");
													$check = DB::num_rows($resultPhonesCity);
													if ($check>0) {
														$objPhonesCity = DB::fetch_object($resultPhonesCity);
														$CityCode = $objPhonesCity->value;
													}
													if (isset($objPhones->numb)) {
														$PhoneNumber = $objPhones->numb;
													}
													if (isset($objPhones->ext)) {
														if ($objPhones->ext <> '') {
															$Extension = ' "Extension": "'.$objPhones->ext.'"';
														}
													}
												}
											}

											$sqlWorktimeUser =  DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project` = '$id_project'");
											$checkWorktime = DB::num_rows($sqlWorktimeUser);
											if ($checkWorktime>0) {
												$objWorktimeUser = DB::fetch_object($sqlWorktimeUser);
												$id_worktime = $objWorktimeUser->id_worktime;
												$WorkTime = DateFrmt($id_worktime);
											}

											if ( ($camp_id <> '') AND ($Country <> '') AND ($City <> '') AND ($CompanyName <> '') AND ($WorkTime <> '') AND ($PhoneNumber <> '') ) {
												$json = '{"method": "'.$method.'","params": { "VCards": [ { "CampaignId":"'.$camp_id.'", "Country": "'.$Country.'", "City" : "'.$City.'", "CompanyName" : "'.$CompanyName.'", "WorkTime" : "'.$WorkTime.'", "Phone" : { "CountryCode": "+'.$CountryCode.'", "CityCode" : "'.$CityCode.'", "PhoneNumber": "'.$PhoneNumber.'"'.$Extension.'}'.$Street.$House.$Building.$Apartment.$ExtraMessage.$ContactEmail.$Ogrn.$MetroStationId.$ContactPerson.'  }] }}';

												$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
												$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
																		 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
																		 'Content-Type: application/json; charset=utf-8',
																		 'Client-Login: '.$login_yandex,
																		 'Accept-Language: ru',
																		 'Host: '.$api.'.direct.yandex.com',
																		 'Authorization: Bearer '.$token_yandex
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
																//exit();
															}
															if ($jsonresult->error_code == '93') {

															}
														} else {
															if (empty($jsonresult->data)) {

															}
															if (count($jsonresult->result) > 0) {
																$vcard_id = $jsonresult->result->AddResults[0]->Id;

																$insVcards = DB::query("INSERT INTO `new_vcards`( `id_camp`, `id_vcard`) VALUES ('$id_camp', '$vcard_id')");
																$id_vcard = DB::insert_id();
															}
														}
													}
												}
											}
										} else {
											$objVcard = DB::fetch_object($sqlVcards);
											$id_vcard = $objVcard->id;
											$vcard_id = $objVcard->id_vcard;
										}
									}
									//Конец Добавить карточку

									//Добавить объявление //Объявление то может и одно, но затем ключевики будут совмещаться под одно объявление. Не понятно как делать ключ = объявление в одной группе.
									$url = $href.$utm;
									if ($group_id <> '') {
										$countMarketingKeywordsNew = 1;
										$sqlCountMarketingAds = DB::query("SELECT * FROM `new_marketing_yandex_ads` WHERE `id_group` = '$id_group'");
										$checkYandexAds = DB::num_rows($sqlCountMarketingAds); //здесь все
										if ($checkYandexAds>0) {
											$objCountMarketingAds = DB::fetch_object($sqlCountMarketingAds);
											$countMarketingKAdsOld = $objCountMarketingAds->count;
											$id_marketing_yandex_keywords =$objCountMarketingAds->id;
											$countMarketingAdsNew = $countMarketingKAdsOld + 1; //Тут проверка на ограничение 1000 кампаний на один Акк //В ключевиках не надо доп проверки это крайний элемент, проверяется уже в группах, счетчик нужен для счетчика групп.
										}

										if ($countMarketingAdsNew === $adslimits[$id_marketing]) { //Ни когда не произойдет //На уровне групп не решена задача
											//Достигли предела по количеству групп: на самом деле этот вопрос решается в коде добавления кампании, но оставляю для полной логики.
											break;
										} else {
											$sqlAds = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase` = '$id_phrase_used' AND `id_group`='$id_group'");
											$check = DB::num_rows($sqlAds); //здесь все
											if ($check === 0) {

												$typefunc = 'ads';

												//Тут надо проверку на тип объявления РСЯ ( TextImageAd ) или ПОИСК ( TextAd )
												$sqlZag2 = '';
												if ($zag2_val <> '') {
													$sqlZag2 = ', "Title2": "'.$zag2_val.'"';
												}

												$mobile = 'NO'; //Отключим признак того что объявление является Мобильным. //Надо найти инфу

												$json = '{"method": "'.$method.'","params": { "Ads": [ { "TextAd": {  "Title": "'.$$zag_val.'"'.$sqlZag2.', "Text" : "'.$textAd.'", "Href" : "'.$Href.'", "Mobile" : "'.$Mobile.'", "DisplayUrlPath" : "'.$url_desc.'", "VCardId" : '.$vcard_id.', "SitelinkSetId": "'.$fastlink_id.'", "AdExtensionIds": [ "'.$AdExtensionIds.'" ] }, "AdGroupId": '.$group_id.' }] }}';

												$StrategyPrioritySQL = '';

												$StrategyPriority = 'HIGH';
												$StrategyPriorityText = ', "StrategyPriority": "'.$StrategyPriority.'"';
												$StrategyPrioritySQL = ", `priority`='$StrategyPriority'";
												$json = '{"method": "add","params": { "Keywords": [{"Keyword": "'.$phrasestr.'", "AdGroupId": '.$group_id.$Bid.$ContextBid.$StrategyPriorityText.'}] }}';

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
																$ad_id = $jsonresult->result->AddResults[0]->Id;
																echo "$ad_id";
																//В использующиеся попадает только сейчас, тогда что там было выше???
																$sendreport = DB::query("INSERT INTO `new_ads`(`id_group`, `id_phrase`, `id_zag`, `id_zag2`, `id_short`, `id_deadline`, `id_cta`, `id_fastlink`, `id_desc`, `id_vcard`, `url_desc`, `url`, `id_ad`) VALUES ('$id_group', '$id_phrase_used', '$id_zag', '$id_zag2', '$id_short', '$id_deadline', '$id_cta', '$id_fastlink', '$id_desc', '$id_vcard', '$url_desc', '$url', '$ad_id')");
																$id_ad = DB::insert_id();

																if ( ($checkYandexAds>0) AND ($checkYandexAds < $adslimits[$id_marketing]) ) {
																	$updCountMarketingAds = DB::query("UPDATE `new_marketing_yandex_ads` SET `count`='$countMarketingAdsNew' WHERE `id_group`='$id_group'");
																} else {
																	$insCountMarketingAds = DB::query("INSERT INTO `new_marketing_yandex_ads`(`id_group`, `count`) VALUES ('$id_group', '1')");
																	
																}
															}
														}
													}
												}
											} else {
												$objAds = DB::fetch_object($sqlAds);
												$id_ad = $objAds->id;
												$ad_id = $objAds->id_ad;
											}
										}
									}
									//Конец Добавить объявление

									//Отправка на модерацию
									 /* b := '';
									  JSON := '{  "method": "moderate",  "params": { "SelectionCriteria": { "Ids": [ ';
									  for i := Row_s to Row_e do
									  begin
									    if (SG.Cells[5, i] = '1') and (SG.Cells[26, i] <> '') and
									      (SG.Cells[18, i] <> '0') then
									    begin
									      JSON := JSON + b + SG.Cells[26, i];
									      b := ',';
									    end;
									  end;
									  JSON := JSON + ' ]} } }';*/
									//Конец Отправка на модерацию

								//Конец Создание кампаний API Direct

								$api = 'api';
								$json = '{"method": "CreateNewWordstatReport","param": { "Phrases": ["'.$phrasestr.'"]  },"locale": "ru","token": "'.$token_yandex.'"}';
								$serv_addr = 'https://'.$api.'.direct.yandex.ru/v4/json/';
								$post_headers = array('POST /json-api/v4 HTTP/1.1',
														 'Referer: https://'.$api.'.direct.yandex.com/v4/json/',
														 'Content-Type: application/json; charset=utf-8',
														 'Client-Login: '.$login_yandex,
														 'Accept-Language: ru',
														 'Host: '.$api.'.direct.yandex.com',
														 'Authorization: Bearer '.$token_yandex
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
								//echo "$json <br>";

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
										$jsonresult = json_decode($body);

										$report = $jsonresult->data;

										$sendreport = DB::query("INSERT IGNORE INTO `new_phrases_report`(`id_project`, `report`, `parent`) VALUES ('$id_project', '$report', '$phrasestr')");
										if ($sendreport) {
											$reportcounts[$id_user][$token_yandex]++;
											$updatestatus =  DB::query("UPDATE `new_phrases` SET `status`='2' WHERE `id`='$id_phrase'"); //Статус изменить??? с 1 на 2 у префраз
										}
										if ($reportcounts[$id_user][$token_yandex] == 5) {
											break; //выход из внутреннего цикла прохода по фразам, но надо перейти к следующей почте.
										}
									}
								}
								curl_close($ch);
							}
							if ($reportcounts[$id_user][$token_yandex] == 5) {
								break; //выход из внутреннего цикла прохода по проектам
							}
						}/**/
					}
				}
			}
		}
	}

	//Добавить условия перехода http://directolog-plus.ru/hotelmayorka/tmpl/getreportfastpars3.php http://directolog-plus.ru/hotelmayorka/tmpl/automatefastpars.php
	///usr/bin/wget -q -O /dev/null "http://directolog-plus.ru/hotelmayorka/tmpl/automatefastpars.php"
	//sleep(10);
	//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/getreportfastpars.php');
