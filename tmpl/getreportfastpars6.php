<?php
include("../conf/start.php");
include("../conf/session.php");
$sitemain = $_SERVER['HTTP_HOST'];

$url = $_SERVER['REQUEST_URI'];
$str = substr($url,1,strpos($url, '/', 1)-1);

$getreport =  DB::query("SELECT * FROM `new_phrases_report` WHERE `status` = '1'");
$check = DB::num_rows($getreport);
if ($check>0) {
	while ($report = DB::fetch_object($getreport)) {
		$idproject = $report->id_project;
		$reportnumb = $report->report;
		$parent = $report->parent;

		$getmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_project` = '$idproject' LIMIT 1");
		$marketing = DB::fetch_object($getmarketing);
		$userid = $marketing->id_user;
		$yandex = $marketing->yandex;
		$token = $marketing->token_yandex;

		$api = 'api';
		$json = '{"method": "GetWordstatReport","param": '.$reportnumb.',"locale": "ru","token": "'.$token.'"}';
		$serv_addr = 'https://'.$api.'.direct.yandex.ru/v4/json/';
		$post_headers = array('POST /json-api/v4 HTTP/1.1',
								 'Referer: https://'.$api.'.direct.yandex.com/v4/json/',
								 'Content-Type: application/json; charset=utf-8',
								 'Client-Login: '.$yandex,
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
				echo $body; //проверяю отчеты вообще есть?
				$jsonresult = json_decode($body);

				if (isset($jsonresult->error_code)) {
					if ($jsonresult->error_code == '91') {
						$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
						sleep(5);
						header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
						exit();
					}
					if ($jsonresult->error_code == '93') {
						$updatestatus = DB::query("UPDATE `new_phrases` SET `status`='1' WHERE  `phrase` =  '$parent'");
						$deletereport = DB::query("DELETE FROM `new_phrases_report` WHERE  `parent` =  '$parent'");
					}
				} else {
					if (empty($jsonresult->data)) {
						$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
						sleep(5);
						header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
						exit();
					}
				}
			}
				
			//родитель
			//echo "ПЕРВЫЙ ПОШЁЛ<BR><BR>";
			//Обнуляем то что не должно иметь в себе значений при обходе по отчетам //Вообще со словами возможно можно оптимизировать WORDS
			if (count($jsonresult->data) > 0) {
				$sqlstrwordsinf = '';
				$wordboll = false;
				$idparents = NULL;
				$maxparents = NULL;
				$phraseparents = NULL;
				$words = NULL;
				$phrases = NULL;
				$parents = NULL;
				$err = '';
				for ($i=0; $i < count($jsonresult->data); $i++) {
					//оптимизация может быть если к примеру по детям проходишь, и ребенок начинает возвращать < 150 ключей, тогда можно начинать формировать отчёты в 2 ключа, потому как каждый из них вернет меньше 150, а всего возвращается 300. 
					//но это явно не сейчас, но в таком случае, надо определять по самой фразе - фраза она или слово
					$phrasepipl = $jsonresult->data[$i]->Phrase; //фраза в форме введенной пользователем

					if (count($jsonresult->data) > 1) { //слова
						//echo count($jsonresult->data);
						//$parents = NULL;
						//$words = NULL;
						/*$wordboll = true;

						if (!in_array($words, $phrasepipl)) { //общий список слов словами пользователя
							$words[] = $phrasepipl;
						}
						if (!in_array($parents, $phrasepipl)) { //собираю родителей слов
							$parents[] = $phrasepipl;
						}
						//$inf = '';
						for ($k=0; $k < count($jsonresult->data[$i]->SearchedWith); $k++) { //получаю списки по словам из 1 слова и общий список слов
							//$phrasewith = $jsonresult->data[$i]->SearchedWith[$k]->Phrase;
							$showswith = $jsonresult->data[$i]->SearchedWith[$k]->Shows;
							$newphrase = $jsonresult->data[$i]->SearchedWith[$k]->Phrase;
							if ((stristr($newphrase, ' ') === FALSE)) {
								if (!in_array($wordlistone[$phrasepipl], $newphrase)) {
									$wordlistonestat[$phrasepipl][] = $showswith;
									$wordlistone[$phrasepipl][] = $newphrase;
								}
								if (!in_array($words, $newphrase)) {
									$words[] = $newphrase;
								}
							}
						}*/
					
					} else { //фразы
						$max = 0;
						for ($k=0; $k < count($jsonresult->data[$i]->SearchedWith); $k++) {
							$showswith = $jsonresult->data[$i]->SearchedWith[$k]->Shows;
							if ($max < $showswith) {
								$newphrase = $jsonresult->data[$i]->SearchedWith[$k]->Phrase;
								$max = $showswith; 
								$parent = $newphrase; //не правильная мысль искать родителя по максимуму показов //пусть на фразах пока останется // но надо явно изменить
							}
						}

						if ($max <> 0) { 
							$sqlidparentold = DB::query("SELECT * FROM `new_phrases` WHERE `phrase` = '$phrasepipl'");
							$objidparentold = DB::fetch_object($sqlidparentold);
							$idparentold = $objidparentold->id;
							//echo "UPDATE `new_phrases` SET `status`='2' WHERE `id`='$idparentold'";
							$updateparent = DB::query("UPDATE `new_phrases` SET `status`='3' WHERE `id`='$idparentold'"); //раскомментить

							$idparents[] = $idparentold;
							$maxparents[] = $max;
							$phraseparents[] = $phrasepipl;
						}
					}
				}

				if ($wordboll) { //Если слова
					/*$sqlstrwords = '';
					for ($i=0; $i < count($words); $i++) {
						$word = $words[$i];
						if ($sqlstrwords == '') {
							$sqlstrwords = "`word` = '$word'";
						} else {
							$sqlstrwords .= " OR `word` = '$word'";
						}
					}

					$words2 = NULL; //придумать надо чтобы не дублировать, хотя там же новые будут добавляться...
					if ($sqlstrwords <> '') {
						//echo "1) SELECT * FROM `new_words` WHERE $sqlstrwords<br>";
						$sqlidparentold = DB::query("SELECT * FROM `new_words` WHERE $sqlstrwords");
						$check = DB::num_rows($sqlidparentold); //здесь все
						if ($check>0) {
							while ($word = DB::fetch_object($sqlidparentold)) { //получаю id слов.
								$wordstr = $word->word;
								$data2[$wordstr] = $word->id;
								$words2[] = $wordstr; //список существующих
								echo $wordstr.' '.$word->id.'<br>';
							}
						}
					}

					//Ситуацию с "пример" "примереть" здесь обработать
					$addinfword = '';
					$idword = NULL;
					$idparent = NULL;
					$strwordchange = '';
					for ($i=0; $i < count($parents); $i++) {
						$parent = $parents[$i];
						$countlist = count($wordlistone[$parent]);
						//echo "$countlist";
						$idparent = $data2[$parent];
						if ($countlist === 1) {
							//нашел инфинитивную форму и че делать как добавлять? )))
							$word = $wordlistone[$parent][0];
							$stat = $wordlistonestat[$parent][0];
							$changewords[] = $word;							
							if ($word === $parent) { //родитель и есть инф форма
								if ($strwordchange == '') {
									$strwordchange = "('$idparent', '$idparent')";
								} else {
									$strwordchange .= ", ('$idparent', '$idparent')";
								}
							}
						} else {
							for ($k=0; $k < $countlist; $k++) { 
								$word = $wordlistone[$parent][$k];
								if (!in_array($word, $words2)) {
									$stat = $wordlistonestat[$parent][$k];
									if ($addinfword == '') {
										$addinfword = "('$word', '$userid', '$stat', '$idparent')";
									} else {
										$addinfword .= ", ('$word', '$userid', '$stat', '$idparent')";
									}
								} else {

								}
							}
						}
					}
					//echo "<br>CLOVA<br>";
					//print_r($words);
					//echo "<br>ДАТА2<br>";
					//print_r($data2);
					//echo "<br>ОДИН<br>";
					//print_r($wordlistonestat);
					//echo "<br>";
					if ($strwordchange <> '') { //ТУТ IGNORE ВРОДЕ НЕ ОБРАБОТАН
						echo "CHANGE INSERT IGNORE INTO `new_words_change`(`id_infinitive`, `id_word`) VALUES $strwordchange<br>";
						$addwhit = DB::query("INSERT IGNORE INTO `new_words_change`(`id_infinitive`, `id_word`) VALUES $strwordchange");
					}
					if ($addinfword <> '') {
						echo "WORD INSERT IGNORE INTO `new_words`(`word`, `id_user`, `stats`, `id_parent`) VALUES $addinfword<br>";
						$addnewword = DB::query("INSERT IGNORE INTO `new_words`(`word`, `id_user`, `stats`, `id_parent`) VALUES $addinfword");
					}	*/			
				} else { //Если фраза
					//Если придумать что статус меняется у тех фраз в которых уже получили слова //вместо статуса можно делать проверку по id_parent если заполнен, значит слова получены, если нет, значит фраза введена пользователем и слова не получены, с другой стороны можно в момент ввода фразы пользователем получать слова.
					echo "N1?<br>";
					for ($i=0; $i < count($idparents); $i++) { //вообще сейчас он тут один должен быть. //Если затем будет оптимизировано под несколько фраз в одном отчёте, то тут нужно будет переписывать код для большей оптимизации.
						$idparent = $idparents[$i];
						$max = $maxparents[$i];
						$parent = $phraseparents[$i];
						$phraseexp = explode(' ', $parent);
						$phrasevr1 = array_unique($phraseexp, SORT_STRING);
						$stripwords[$parent] = $phrasevr1;
						
						$getphrasestr = '';
						$showswith = 0;
						UnSet($phrases);
						UnSet($changephrases);
						//дети
						echo "DETI<br>";
						for ($k=0; $k < count($jsonresult->data[$i]->SearchedWith); $k++) {
							$phrasewith = $jsonresult->data[$i]->SearchedWith[$k]->Phrase;
							$showswith = $jsonresult->data[$i]->SearchedWith[$k]->Shows;
							$phrases[] = $phrasewith;
							$phrasevr = explode(' ', $phrasewith);
							sort($phrasevr);
							//print_r($phrasevr);
							$phrasechange = '';
							for ($l=0; $l < count($phrasevr); $l++) { 
								if ($phrasechange == '') {
									$phrasechange = $phrasevr[$l];
								} else {
									$phrasechange .= ' '.$phrasevr[$l];
								}				
							}
							$changephrases[] = $phrasechange;
							$shows[] = $showswith;

							//сформировать запрос на поиск существующих фраз по совпадению с добавляемыми
							if ($getphrasestr == '') {
								$getphrasestr = "`phrase_change` = CONVERT('$phrasechange' USING cp1251)";
							} else {
								$getphrasestr .= " OR `phrase_change` = CONVERT('$phrasechange' USING cp1251)";
							}

							//получаю слова
							$phrasevr = explode(' ', $phrasewith);
							for ($jj=0; $jj < count($phrasevr); $jj++) {
								if (!in_array($phrasevr[$jj], $words)) {
									$words[] = $phrasevr[$jj];
								}
							}
						}

						//убрать дубли
						echo "Dubli 1<br>";
						if ($getphrasestr <> '') {
							echo "GET 1 SELECT * FROM `new_phrases` WHERE $getphrasestr<br>";
							$getphrases = DB::query("SELECT * FROM `new_phrases` WHERE $getphrasestr");
							$check = DB::num_rows($getphrases);
							//echo "$check";
							if ($check > 0 ) { 
								//echo "NEN2";
								while ($phrase = DB::fetch_object($getphrases)) {
									/*$vrphrase = $phrase->phrase;									
									if (in_array($vrphrase, $phrases)) {
										$ind = array_search($vrphrase, $phrases);
										//$indchange = array_search($vrchangephrase, $changephrases);
										unset($phrases[$ind]);
										//echo "$vrphrase ggg<BR>";
									}*/
									$vrchangephrase = $phrase->phrase_change;
									while (in_array($vrchangephrase, $changephrases)) {
										$indchange = array_search($vrchangephrase, $changephrases);
										//echo "$vrchangephrase ggg<BR>";
										unset($changephrases[$indchange]);										
									}
								}
							}
						}

						//сформировать запрос на добавление только уникальных фраз
						echo "Zapros 1<br>";
						$strwith = '';
						for ($k=0; $k < count($changephrases); $k++) {
							if (isset($changephrases[$k])) {
								$phrasewithchange = $changephrases[$k];
								$showswith = $shows[$k];
								$phrasewith = $phrases[$k];
								//echo "$phrasewithchange rrr<BR>";
								
								if ($strwith == '') {
									//if ($showswith < 51) { //вообще ограничивать так не верно в силу сбора Сестёр, поэтому пока уберу, позже ещё подумаю
										$strwith = "('$phrasewith', '$userid', '$showswith', '$idparent', '$idproject', '1', '$phrasewithchange')"; //тут было 2
										$sqlstrwith = "`phrase_change` = CONVERT('$phrasewithchange' USING cp1251)";
									//} else {
									//	$strwith = "('$phrasewith', '$userid', '$showswith', '$idparent', '$idproject', '1', '$phrasewithchange')";
									//	$sqlstrwith = "`phrase_change` = '$phrasewithchange'";
									//}
									//$getword = "`word` = '$word'";
								} else {
									//if ($showswith < 51) {
									$vrstr = "('$phrasewith',";
									if (strpos($strwith, $vrstr) === false) {
										$strwith .= ", ('$phrasewith', '$userid', '$showswith', '$idparent', '$idproject', '1', '$phrasewithchange')";
										$sqlstrwith .= " OR `phrase_change` = CONVERT('$phrasewithchange' USING cp1251)";
									}
									//} else {
									//	$strwith .= ", ('$phrasewith', '$userid', '$showswith', '$idparent', '$idproject', '1', '$phrasewithchange')";
									//	$sqlstrwith .= " OR `phrase_change` = '$phrasewithchange'";
									//}
								}
							}
						}
						
						//добавить только уникальные фразы
						echo "Unic 1<br>";
						if ($strwith <> '') {
							//echo "<br>БЛЯТЬ<br>";
							//echo "INS 1 INSERT INTO `new_phrases`(`phrase`, `id_user_add`, `stats`, `id_parent`, `id_project`, `status`, `phrase_change`) VALUES $strwith<br>";
							$addwhit = DB::query("INSERT INTO `new_phrases`(`phrase`, `id_user_add`, `stats`, `id_parent`, `id_project`, `status`, `phrase_change`) VALUES $strwith");
							$getwith = DB::query("SELECT * FROM `new_phrases` WHERE $sqlstrwith");
							$check = DB::num_rows($getwith);
							$addusedstr = '';
							if ($check > 0 ) {
								while ($row = DB::fetch_object($getwith)) {
									$id = $row->id;
									$phrasechange = $row->phrase_change;
									if ($addusedstr == '') {
										$addusedstr = "('$id', '$userid', '$idproject', '$phrasechange')";
									} else {
										$addusedstr .= ", ('$id', '$userid', '$idproject', '$phrasechange')";
									}
								}
							}
							//echo "addusedstr $addusedstr";
							if ($addusedstr <> '') { //тут в общем если прям с начала делать то ок, но если в середину подружаться, то не добавит те фразы которых нет в самом used
								//echo "ERRO?<br>";
								$addused = DB::query("INSERT INTO `new_phrases_used`(`id_phrase`, `id_user`, `id_project`, `phrase`) VALUES $addusedstr");
							}
						}

						//Сёстер получаю
						echo "Sestry<br>";
						$getphrasealsostr = '';
						UnSet($phrasesalso);
						for ($k=0; $k < count($jsonresult->data[$i]->SearchedAlso); $k++) {
							$phrasealso = $jsonresult->data[$i]->SearchedAlso[$k]->Phrase;
							$showsalso = $jsonresult->data[$i]->SearchedAlso[$k]->Shows;
							$phrasesalso[] = $phrasealso;
							//echo "$phrasealso $k<br>";
							//сформировать запрос на поиск существующих фраз по совпадению с добавляемыми
							if ($getphrasealsostr == '') {
								$getphrasealsostr = "`phrase` = CONVERT('$phrasealso' USING cp1251)";
							} else {
								$getphrasealsostr .= " OR `phrase` = CONVERT('$phrasealso' USING cp1251)";
							}

							//получаю слова
							$phrasevr = explode(' ', $phrasealso);

							for ($jj=0; $jj < count($phrasevr); $jj++) {
								if (!in_array($phrasevr[$jj], $words)) {
									$words[] = $phrasevr[$jj];
								}
							}
						}

						//убрать дубли
						echo "Dubli Sestry<br>";
						if ($getphrasealsostr <> '') {
							echo "SELECT * FROM `new_phrases_pre` WHERE $getphrasealsostr<br>";
							$getphrasesalso = DB::query("SELECT * FROM `new_phrases_pre` WHERE $getphrasealsostr");
							$check = DB::num_rows($getphrasesalso);
							//echo "$check";
							if ($check > 0 ) { 
								//echo "NEN2";
								while ($phrase = DB::fetch_object($getphrasesalso)) {
									$vrphrase = $phrase->phrase;
									while (in_array($vrphrase, $phrasesalso)) {
										$ind = array_search($vrphrase, $phrasesalso);
										unset($phrasesalso[$ind]);
										echo "$vrphrase $ind ggg<BR>";
									}
								}
							}
						}						

						//сформировать запрос на добавление только уникальных фраз
						echo "Zapros Sestry<br>";
						$stralso = '';
						for ($k=0; $k < count($phrasesalso); $k++) {
							if (isset($phrasesalso[$k])) {
								$phrasealso = $phrasesalso[$k];
								//echo "$phrasealso $k<br>";
								$showswith = $shows[$k];
								$phrasevr = explode(' ', $phrasealso);
								if ($stralso == '') {
									$stralso = "('$phrasealso', '$userid', '$showswith', '$idparent', '$idproject')";
								} else {
									$vrstr = "('$phrasealso',";
									if (strpos($stralso, $vrstr) === false) {
										$stralso .= ", ('$phrasealso', '$userid', '$showswith', '$idparent', '$idproject')";
									}									
								}
							}
						}

						//добавить только уникальные фразы
						echo "Unic Sestry<br>";
						if ($stralso <> '') {
							echo "1 INSERT INTO `new_phrases_pre`(`phrase`, `user_id`, `stats`, `parent_id`, `project_id`) VALUES $stralso<br>";
							$addalso = DB::query("INSERT INTO `new_phrases_pre`(`phrase`, `user_id`, `stats`, `parent_id`, `project_id`) VALUES $stralso");	
							echo "1 OK";
						}

						echo "Word<br>";
						$getword = '';
						for ($k=0; $k < count($words); $k++) {
							if (isset($words[$k])) {
								$word = $words[$k];
								if ($getword == '') {
									$getword = "`word` = CONVERT('$word' USING cp1251)";
								} else {
									$getword .= " OR `word` = CONVERT('$word' USING cp1251)";
								}
							}
						}

						//из массива убрать те которые уже записаны,
						echo "Dubli Word<br>";
						if ($getword <> '') {
							echo "0 SELECT * FROM `new_words` WHERE $getword<br>";
							$getwords = DB::query("SELECT * FROM `new_words` WHERE $getword");
							echo "0 OK<br>";
							$check = DB::num_rows($getwords);
							if ( $check > 0 ) {
								while ($word = DB::fetch_object($getwords)) {
									$vrword = $word->word;
									while (in_array($vrword, $words)) {
										$ind = array_search($vrword, $words);
										unset($words[$ind]);
									}
								}
							}
						}

						//Сформировать запрос на добавление только новых,
						echo "Zapros Word<br>";
						$addword = '';
						$getword2 = '';
						for ($k=0; $k < count($words); $k++) {
							if (isset($words[$k])) {
								$word = $words[$k];
								if ($addword == '') {
									if(stristr($word, '+') === FALSE) {
										$addword = "('$word', '$userid', '$idproject', '0')";
									} else {
										$addword = "('$word', '$userid', '$idproject', '1')";
									}
								} else {
									if(stristr($word, '+') === FALSE) {
										$addword .= ", ('$word', '$userid', '$idproject', '0')";
									} else {
										$addword .= ", ('$word', '$userid', '$idproject', '1')";
									}
								}
								if(stristr($word, '+') === FALSE) { 
									if ($getword2 == '') {
										$getword2 = "`word` = CONVERT('$word' USING cp1251)";
									} else {
										$getword2 .= " OR `word` = CONVERT('$word' USING cp1251)";
									}
								}
								
							}
						}

						//добавить только новые.
						echo "Unic Word<br>";
						if ($addword <> '') {
							echo "INSERT INTO `new_words`(`word`, `id_user`, `id_project`, `stopword`) VALUES $addword <br>";
							$putword = DB::query("INSERT INTO `new_words`(`word`, `id_user`, `id_project`, `stopword`) VALUES $addword");
							echo "1 OK ";
							$getwordsql = DB::query("SELECT * FROM `new_words` WHERE $getword2");
							$check = DB::num_rows($getwordsql);
							echo "$check<br>";
							if ($check > 0 ) {

								$addusedword = '';
								while ($row = DB::fetch_object($getwordsql)) {
									$id = $row->id;
									$phrasechange = $row->phrase_change;
									if ($addusedword == '') {
										$addusedword = "('$id', '$userid', '$idproject')";
									} else {
										$vrstr = "('$id',";
										if (strpos($addusedword, $vrstr) === false) {
											$addusedword .= ", ('$id', '$userid', '$idproject')";
										}
									}
								}
								if ($addusedword <> '') { //и тут менять
									echo "$addusedword OK<br>";
									$addwordused = DB::query("INSERT INTO `new_words_used` (`id_word`, `id_user`, `id_project`) VALUES $addusedword");
									echo "2 OK<br>";
								}
							}
						} //ты можешь уйти от этого, откинь голову, закрой глаза и окажись у реки
					}
				}
				$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='2' WHERE `report`='$reportnumb'");
			}
		}
		curl_close($ch);
	}
}

//идея такая что если $wordboll то перейти на changephrase иначе на delreport, а с changephrase переход на delreport.

//Добавить условия перехода
//удалить пройденные отчёты на Яндексе
//sleep(10);
//header('location: http://directolog-plus.ru/hotelmayorka/tmpl/delreportfastpars.php');
?>