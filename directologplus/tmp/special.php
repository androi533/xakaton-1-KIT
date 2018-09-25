<?php 
//Шаблон внутреннего кода страницы вывода данных
	function generate_password($number)
	{
	    $arr = array('a','b','c','d','e','f',
	                 'g','h','i','j','k','l',
	                 'm','n','o','p','r','s',
	                 't','u','v','x','y','z',
	                 'A','B','C','D','E','F',
	                 'G','H','I','J','K','L',
	                 'M','N','O','P','R','S',
	                 'T','U','V','X','Y','Z',
	                 '1','2','3','4','5','6',
	                 '7','8','9','0','.',',',
	                 '(',')','[',']','!','?',
	                 );
	    // Генерируем пароль
	    $pass = "";
	    for($i = 0; $i < $number; $i++)
	    {
	      // Вычисляем случайный индекс массива
	      $index = rand(0, count($arr) - 1);
	      $pass .= $arr[$index];
	    }
	    return $pass;
	}

	function my_copy_all($from, $to) {
		if (is_dir($from)) {
			@mkdir($to);
			$d = dir($from);
			while (false !== ($entry = $d->read())) {
				if ($entry == "." || $entry == "..") continue;
				my_copy_all("$from/$entry", "$to/$entry");
			}
			$d->close();
		}
		else copy($from, $to);
	}

	if(isset($_POST['buton'])) {
		//ПЕРЕПРОВЕРИТЬ ТУТ ВСЁ до перехода с index на вторую страницу name, после попробовать перейти на третью, затем вернуться к главному файлу index и проверить работку  исключений воронки.
		//print_r($_POST);
		
		if ( (isset($_SESSION[$market]['email'])) or (isset($_SESSION[$market]['phone'])) ){
			$firststep = false;
			if (isset($_SESSION[$market]['email'])) {
				$login = $_SESSION[$market]['email'];
				$loginfield = 'email';
			}
			if (isset($_SESSION[$market]['phone'])) {
				$login = $_SESSION[$market]['phone'];
				$loginfield = 'phone';
			}
		} else {
			$firststep = true;
		}

		if ($firststep) {
			if ($step == 1) {
				$passwrd = generate_password(intval(rand(8,10)));
			}
		}

		foreach ($_POST as $field => $value) {
			if (isset($value)) {
				if ($field == 'phone') { // if ( ($field == 'phone') OR ($field == 'email') ) { //НЕТ ПОТОМУЧТО СЛЕДУЮЩАЯ СТРОКА ОТЛИЧИЕ
					$value = preg_replace("/[^0-9]/", '', $value);
					$strvr = trim($value);
					$strvr = mysql_real_escape_string($strvr);

					$phoneCountry = substr($strvr, 0, 1);
					$phoneCode = substr($strvr, 1, 3);
					$phoneNumb = substr($strvr, 4);

					$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `value`='$phoneCountry'");
					$checkPhonesCountry=DB::num_rows($resultPhonesCountry);
					if ($checkPhonesCountry == 0) {
						$sql = DB::query("INSERT INTO `new_phones_country` (`value`) VALUES ('$phoneCountry')");
						$idPhonesCountry = DB::insert_id();
					} else {
						$objPhonesCountry = DB::fetch_object($resultPhonesCountry);
						$idPhonesCountry = $objPhonesCountry->id;
					}

					$resultPhonesCode = DB::query("SELECT * FROM `new_phones_code` WHERE `value`='$phoneCode' AND `id_country`='$idPhonesCountry'");
					$checkPhonesCode = DB::num_rows($resultPhonesCode);
					if ($checkPhonesCode == 0) {
						$sql = DB::query("INSERT INTO `new_phones_code` (`value`, `id_country`) VALUES ('$phoneCode', '$idPhonesCountry')");
						$idPhonesCode = DB::insert_id();
					} else {
						$objPhonesCode = DB::fetch_object($resultPhonesCode);
						$idPhonesCode = $objPhonesCode->id;
					}

					$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `value`='$phoneNumb' AND `id_country`='$idPhonesCountry' AND `id_city`='$idPhonesCode'");
					$checkPhones=DB::num_rows($resultPhones);
					if ($checkPhones == 0) {
						$sql = DB::query("INSERT INTO `new_phones` (`value`, `id_country`, `id_city`) VALUES ('$phoneCode', '$idPhonesCountry', '$idPhonesCode')");
						$idPhones = DB::insert_id();
					} else {
						$objPhones = DB::fetch_object($resultPhones);
						$idPhones = $objPhones->id;
					}

					$_SESSION[$market][$field] = $strvr;
					$strsqlwhere = "`$field` = '$strvr'";
					$nowfield = $field;
					$nowvalue = $strvr;
					if ($firststep) {
						$loginfield = $field;
						$login = $strvr;
						if (isset($ref)) {
							$sql = "INSERT INTO `new_users`(`$field`, `password`, `regdate`, `id_phone`, `refid`) VALUES ('$strvr', '$passwrd', NOW(), '$idPhones', '$ref')";
						} else {
							$sql = "INSERT INTO `new_users`(`$field`, `password`, `regdate`, `id_phone`) VALUES ('$strvr', '$passwrd', NOW(), '$idPhones')";
						}
					} else {
						$sql = "UPDATE `new_users` SET `$field`='$strvr', `id_phone`='$idPhones' WHERE `$loginfield` = '$login'";
					}
				}

				if ($field == 'email') {
					$strvr = trim($value);
					$strvr = mysql_real_escape_string($strvr);
					$_SESSION[$market][$field] = $strvr;
					$strsqlwhere = "`$field` = '$strvr'";
					$nowfield = $field;
					$nowvalue = $strvr;
					if ($firststep) {
						$loginfield = $field;
						$login = $strvr;
						if (isset($ref)) { //для поощрения клиентов //Надо обработку делать - если ref не цифровой и вообще такого ползователя (клиента) не существует
							$sql = "INSERT INTO `new_users`(`$field`, `password`, `regdate`, `refid`) VALUES ('$strvr', '$passwrd', NOW(), '$ref')";
						} else {
							$sql = "INSERT INTO `new_users`(`$field`, `password`, `regdate`) VALUES ('$strvr', '$passwrd', NOW())";
						}
					} else {
						$sql = "UPDATE `new_users` SET `$field`='$strvr' WHERE `$loginfield` = '$login'";
					}
				}

				if ($field == 'name') {
					$strvr = trim($value);
					$strvr = mysql_real_escape_string($strvr);
					$_SESSION[$market][$field] = $strvr;
					$strsqlwhere = "`$field` = '$strvr'";
					$nowfield = $field;
					$nowvalue = $strvr;
					$sqlthisuser = "SELECT * FROM `new_users` WHERE `$loginfield` = '$login' LIMIT 1";
					$resthisuser = DB::query($sqlthisuser);
					$thisuser = DB::fetch_object($resthisuser);
					$id_user_info = $thisuser->id_user_info;
					if ($id_user_info == NULL) {
						$sql = "INSERT INTO `new_user_info`(`$field`) VALUES ('$strvr')";
						$exqsql = DB::query($sql);
						$id_user_info = DB::insert_id();
						$sql = "UPDATE `new_users` SET `id_user_info`='$id_user_info' WHERE `$loginfield` = '$login'";
					} else {
						$sql = "UPDATE `new_user_info` SET `$field`='$strvr' WHERE `id` = '$id_user_info'";
					}
				}

				if ($field == 'keyword') {
					$strvr = trim($value);
					$strvr = mysql_real_escape_string($strvr);
					$_SESSION[$market][$field] = $strvr;
					$strsqlwhere = "`$field` = '$strvr'";
					$nowfield = $field;
					$nowvalue = $strvr;
					if (isset($_SESSION[$market]['id_user'])) {
						$id_user = $_SESSION[$market]['id_user'];
					} else {
						$sqlthisuser = "SELECT * FROM `new_users` WHERE `$loginfield` = '$login' LIMIT 1";
						$resthisuser = DB::query($sqlthisuser);
						$thisuser = DB::fetch_object($resthisuser);
						$id_user = $thisuser->id;
					}
					$getprephrase =  DB::query("SELECT * FROM `new_phrases` WHERE `phrase` = '$strvr'");
					if ($count > 0) {
						$objPhrase = DB::fetch_object($getprephrase);
						$id_phrase = $objPhrase->id;
						//$id_user_add = $objPhrase->id_user_add; //для начисления баллов
						$sql = "INSERT INTO `new_phrases_used`(`id_user`, `id_project`, `id_phrase`) VALUES ('$id_user', '$id_project', '$id_phrase')";
						//Вот тут вот я хз конечно, но
						//Надо весь хвост в used передать и начислить баллы id_user_add, и добавить в выбор фраз релевантные фразы по родителю id_phrase для id_user, и возможно тут должно происходить что то ещё, возможно всё это будет в каком то php файле и и нужно будет его просто сюда добавить, а перед этим определить необходимые переменные типа id_user_add
					} else {
						$sql = "INSERT INTO `new_phrases`(`id_user_add`, `phrase`) VALUES ('$id_user', '$strvr')";
					}
				}
				//ДАЛЕЕ  ДРУГИЕ ПОЛЯ //Добавить ключевой запрос вместо name //Воронка на 3 шага
			}
		}

		if ($firststep) {
			//Проверяем вводил ли ранее номер, если сейчас вводили номер. //Тут может быть ошибка если после ввода телефона в воронке вводить email - вроде решено
			$sqlthisuser = "SELECT * FROM `new_users` WHERE `$loginfield` = '$login' LIMIT 1"; 
			$resthisuser = DB::query($sqlthisuser);
			$check=DB::num_rows($resthisuser);
			$_SESSION[$market]['SID'] = '1'; //тут поменять конечно же; Смотри выше или перенеси сюда //Я ХЗ ВОЗМОЖНО НУЖНО СОБИРАТЬ СЕССИЮ ПО ПОЛЬЗОВАТЕЛЯМ $_SESSION[$market][$login]['SID'] ???
			$_SESSION[$market]['lastactivity'] = time();
			if ($check > 0) {
				$thisusernew = DB::fetch_object($resthisuser);
				$laststep = $thisusernew->laststep;
				if ( ($nextvoronkaproj>0) and ($laststep <= count($voronka['from'])) ) {
					$sqlthisvoronka = "SELECT * FROM `new_voronka` WHERE `id_project` = '$id_project' AND `step` = '$laststep'";
					$resvoronka = DB::query($sqlthisvoronka);
					$thisvoronka = DB::fetch_object($resvoronka);
					$nextvoronkaproj=$thisvoronka->id_project_data;
				} else {
					$voronka = 'thankyou';
				}
				$laststep = $thisusernew->laststep - 1;
			} else {
				$adduser=DB::query($sql);
				$id_user = DB::insert_id();
				$_SESSION[$market]['id_user'] = $id_user;
				$laststep = 1;
			}
		} else {
			$laststep = $_SESSION[$market]['laststep'];
			$addinfo=DB::query($sql); //вот тут выполнится sql поля ввода
		}
		//exit();

		if ( ($laststep == 1) AND ($firststep) ) { //НЕ ОТНОСИТСЯ К ОБЩЕМУ ШАБЛОНУ
			//СОЗДАТЬ ПРОЕКТНУЮ ПАПКУ //ДОЛЖНО РАБОТАТЬ НЕ ПРОВЕРЯЛ //нет проверки если повторно на первой странице
			if ($namepage == 'index') {
				chdir($_SERVER['DOCUMENT_ROOT']); //Вообще эта часть есть только в моем проекте в шаблоне убрать.
				$shablon = "shablon";
				my_copy_all($shablon,$login); //Вообще эта часть есть только в моем проекте в шаблоне убрать.

				$sql = "INSERT INTO `new_project`(`durl`) VALUES ('$login')";
				$res=DB::query($sql);
				$idproj = DB::insert_id();

				$sql = "INSERT INTO `new_project_user`(`id_user`,`id_project`) VALUES ('$id_user','$idproj')";
				$res=DB::query($sql);

				$sql = "INSERT INTO `new_project_data`(`phone`,`id_project`) VALUES ('$login','$idproj')";
				$res=DB::query($sql);
				$idprojdata = DB::insert_id();

				$sql = "INSERT INTO `new_inputs_user`(`id_project_data`) VALUES ('$idprojdata')";
				$res=DB::query($sql);
			}
		}

		//ОТПРАВИТЬ МНЕ УВЕДОМЛЕНИЕ О ЛИДЕ //ДОЛЖНО РАБОТАТЬ НЕ ПРОВЕРЯЛ
		if ($podpiska >= '1') {
			$subject2 = 'Directolog-Plus.ru - директолог+';
			$d = date("l dS of F Y h:I:s A");
			$text2 = $nowfield.' '.$nowvalue.' '.$d;
			$text22 = '<html><head><title>Directolog-Plus.ru | Директолог+</title></head><body><p>'.$text2.'</p></body></html>';
			$to2 = 'directolog-plus@ya.ru';
			$headers2  = "Content-type: text/html; charset=utf8 \r\n";
			$headers2 .= "From: Directolog-Plus.ru <Directolog-Plus@ya.ru>\r\n";
			$headers2 .= "Bcc: Directolog-Plus@ya.ru\r\n";
			$ma =mail($to2, $subject2, $text22, $headers2);
		}

		//Сделать запись в CRM //ДОЛЖНО РАБОТАТЬ НЕ ПРОВЕРЯЛ
		if ( ($namepage == 'index') AND (isset($id_user)) ) {
			$sqlzayavka = "INSERT INTO `new_zayavki`(`$loginfield`, `regdate`, `id_project`, `id_user`) VALUES ('$login', NOW(), '$id_project', '$id_user')";
			$res=DB::query($sqlzayavka);
		}
		
		

		//ОБРАТНАЯ СВЯЗЬ SMS или EMAIL //ДОЛЖНО РАБОТАТЬ НЕ ПРОВЕРЯЛ
			if ($nowfield == 'email') {
				//Оправить email зареганому пользователю
					$to = $nowvalue;
					$subject = 'Лид! Directolog-Plus.ru';
					$text = "Добро пожаловать! Вот ваш логин, Вот ваш пароль"; //Если первичная отправка была на телефон, то получить пароль, тоже самое с смс
					$link = "<a href=\"http://directolog-plus.ru/directologplus/CRM3.php?login=$login&password=$passwrd\" target=\"_blank\">Войти</a>";
					$text2 = '<html><head><title>Лид Directolog-Plus.ru</title></head><body><p>'.$text.'</p></body></html>';
					$headers  = "Content-type: text/html; charset=utf8 \r\n";
					$headers .= "From: Directolog-Plus.ru <Directolog-Plus@ya.ru>\r\n";
					$headers .= "Bcc: Directolog-Plus@ya.ru\r\n";
					$ma = mail($to, $subject, $text2, $headers);

					//ПОСЛЕ ОТПРАВКИ сделать UPDAtE lastemail в ZAYAVKI
			}
			if ($nowfield == 'phone') {
				//Оправить sms зареганому пользователю //НУ ТУТ ЛЕВАЯ ШЛЯПА
				$subject2 = 'Directolog-Plus.ru - директолог+';
				$d = date("l dS of F Y h:I:s A");
				$text2 = $nowfield.' '.$nowvalue.' СМС '.$d;
				$text22 = '<html><head><title>Directolog-Plus.ru | Директолог+</title></head><body><p>'.$text2.'</p></body></html>';
				$to2 = 'directolog-plus@ya.ru';
				$headers2  = "Content-type: text/html; charset=utf8 \r\n";
				$headers2 .= "From: Directolog-Plus.ru <Directolog-Plus@ya.ru>\r\n";
				$headers2 .= "Bcc: Directolog-Plus@ya.ru\r\n";
				$ma =mail($to2, $subject2, $text22, $headers2);
			}

		//УВЕЛИЧИТЬ laststep
		$laststep = $laststep + 1;
		$_SESSION[$market]['laststep'] = $laststep;
		if ($laststep <= count($voronka['from'])) { //УБРАТЬ ОШИБКУ УВЕЛИЧЕНИЯ laststep при зависании на одной странице ( если сейчас на индекс возвращает то шаг увеличивается хз конечно)
			$sql = "UPDATE `new_users` SET `laststep`='$laststep' WHERE `$loginfield`='$login'";
			$res = DB::query($sql);
		}

		//ПЕРЕЙТИ ПО ВОРОНКЕ
		if ( ($nextvoronkaproj>0) and ($laststep <= count($voronka['from'])) ) {
			$sqlthisvoronkavext = "SELECT * FROM `new_project_data` WHERE `id` = '$nextvoronkaproj' LIMIT 1"; //
			$resvoronka2=DB::query($sqlthisvoronkavext);
			$thisvoronka2=DB::fetch_object($resvoronka2);
			$voronka=$thisvoronka2->page;
		} else {
			$voronka = 'thankyou';
		}
		header ('location: '.$protocol.'://'.$sitemain.'/'.$market.'/'.$voronka.'.php');
		exit();
	}

	require_once('../tmp/page.php');
?>