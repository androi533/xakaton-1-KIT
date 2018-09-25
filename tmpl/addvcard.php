<?php
	include("../conf/start.php");
	include("../conf/session.php");
	include("../conf/phpQuery-onefile.php");

	$url = $_SERVER['REQUEST_URI'];
	$market = substr($url,1,strpos($url, '/', 1)-1);

	$user_id = $_SESSION[$market]['user_id']; //Необходим
	$idproject = $_SESSION[$market]['id_project']; //Необходим

	$id_user = 1; //Необходим
	$id_project = 1; //Необходим

		$sqlmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user` = '$id_user' AND `id_project`='$id_project'");
		$check = DB::num_rows($sqlmarketing); //здесь все
		if ($check>0) {
			$objmarketing = DB::fetch_object($sqlmarketing);
			$id_marketing = $objmarketing->id;
			$login = explode('@', $objmarketing->yandex)[0];
			$logins[$id_marketing] = $login;
			$token = $objmarketing->token_yandex; //Оверважные выводим ошибки ( предлагаем заполнить для продолжения )
		} else {
			//Если нет записи маркетинг, тут надо создавать и на получение токена отправлять
			$login = 'vinhunter';
			$token = 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
			$id_marketing = '2';
		}
		echo "$login";
		//$camp_id = $_SESSION[$market]['camp_id'];
		$camp_id = '36256047'; //Необходим //43661335 43661335
		
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
		$typefunc = 'vcards';
		$method = 'add';

		/*$Country = 'Россия'; //+
		$City = 'Стерлитамак'; //+
		$CompanyName = 'Директолог Плюс'; //company_name в new_project //+
		$WorkTime = '0202020202'; //worktime_user //через id_project вроде
		$CountryCode = '7'; //+
		$CityCode = '967'; //+
		$PhoneNumber = '7426171'; //добавочный добавить в телефонах? Extended //+
		$Extended = ''; //n //+
		$Street = 'Нагуманова'; //n //+
		$House = '18'; //n //+
		$Building = ''; //n //+
		$Apartment = '2'; //n //+
		$ExtraMessage = 'О компании'; //about в new_project //n //+
		$ContactEmail = 'vinhunter@ya.ru'; //email в new_project_data //n //+
		$Ogrn = '09202030123123'; //n //+
		$ContactPerson = 'Виктор Ахатович'; //Из user_info  //n //+*/

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

		//Адрес в new_address_project
		//Телефон в new_project_data //Изменить строку на new_phones id
		$sqlAddressProject = DB::query("SELECT * FROM `new_address_project` WHERE `id_project` = '$id_project' AND `main`='1'");
		$checkAdressProject = DB::num_rows($sqlAddressProject); //здесь все
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
				$ContactEmail = ', "ContactEmail":"'.$objProjectData->email.'"';
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

		$sqlWorktimeUser =  DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project` = '$id_project'");
		$checkWorktime = DB::num_rows($sqlWorktimeUser);
		if ($checkWorktime>0) {
			$objWorktimeUser = DB::fetch_object($sqlWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;
			$WorkTime = DateFrmt($id_worktime);
		}	

		$json = '{"method": "'.$method.'","params": { "VCards": [ { "CampaignId":"'.$camp_id.'", "Country": "'.$Country.'", "City" : "'.$City.'", "CompanyName" : "'.$CompanyName.'", "WorkTime" : "'.$WorkTime.'", "Phone" : { "CountryCode": "+'.$CountryCode.'", "CityCode" : "'.$CityCode.'", "PhoneNumber": "'.$PhoneNumber.'"'.$Extension.'}'.$Street.$House.$Building.$Apartment.$ExtraMessage.$ContactEmail.$Ogrn.$MetroStationId.$ContactPerson.'  }] }}';

		echo "<br>$json";

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

					}
					if (count($jsonresult->result) > 0) {
						$vcard_id = $jsonresult->result->AddResults[0]->Id;
						print_r($jsonresult);
						echo "V $vcard_id";

						//$addwhit = DB::query("INSERT INTO `new_vcards`( `id_camp`, `id_vcard`) VALUES ('$camp_id', '$vcard_id')");

						/*if ($checkyandexgroups>0) { //Если есть ограничение на количество карточек
							$countmarketinggroups = DB::query("UPDATE `new_marketing_yandex_groups` SET `count`='$countmarketinggroupsnew' WHERE `id_marketing`='$id_marketing'");
						} else {
							$countmarketinggroups = DB::query("INSERT INTO `new_marketing_yandex_groups`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
						}*/
					}
				}
			}

			//print_r($jsonresult);

			if (count($jsonresult->result) > 0) {
				$group_id = $jsonresult->result->AddResults[0]->Id;
				echo "$vcard_id";

				//$addwhit = DB::query("INSERT INTO `new_vcards`( `id_camp`, `id_vcard`) VALUES ('$camp_id', '$vcard_id')");

				/*if ($checkyandexgroups>0) { //Если есть ограничение на количество карточек
					$countmarketinggroups = DB::query("UPDATE `new_marketing_yandex_groups` SET `count`='$countmarketinggroupsnew' WHERE `id_marketing`='$id_marketing'");
				} else {
					$countmarketinggroups = DB::query("INSERT INTO `new_marketing_yandex_groups`(`id_marketing`, `count`) VALUES ('$id_marketing', '1')");
				}*/
			}
		}

	//result = 35503679
?>