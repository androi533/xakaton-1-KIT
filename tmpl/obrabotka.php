<?php 
	include("../conf/start.php");
	include("../conf/session2.php");
	//include('../../yakassa/config.php');
	include("../conf/consts.php");
	
	include("../conf/SuggestClient.php");
	use Dadata\SuggestClient as SuggestClient;

	include('../yakassatest/config.php');

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	//$market = substr($url,1,strpos($url, '/', 1)-1);
	$market = $_SESSION['market'];

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

	//Фикция
	$myac = $CONSTS['myac'];
	$myre = $CONSTS['myre']; 
	$mysi = $CONSTS['mysi'];

	if(!empty($_POST)) {		
		if (isset($_POST['exit'])) {
			$_SESSION['exit'] = true;
			destroySession();
			return session_start();
		}

/////////////////////////////// < Меню
	if (isset($_POST['freeaccess'])) {
		$id_user = $_POST['freeaccess'];
		$prePhraseGet=DB::query("UPDATE `new_users`  SET `freeaccess`='2', `startaccess` = NOW() WHERE `id` = '$id_user'");
		$result = 'Доступ открыт на 3 дня. Всё что вы сделаете останется на Вашем аккаунте в Яндекс.Директ';
	}

	if (isset($_POST['loginc'])) {
		include ('../tmp/menu.php');
	}

	if (isset($_POST['yad'])) {
		if ($_POST['yad'] == 'addkey') {
			if (!$_POST['val'] === 'empty') {
				$zapros = $_POST['val'];
				$id_user = $_SESSION['market_'.$market]['id_user'];
				$id_project = $_SESSION['market_'.$market]['id_project'];
				/*$phrasevr = explode(' ', $zapros);
				sort($phrasevr);

				$phrasechange = '';
				for ($l=0; $l < count($phrasevr); $l++) { 
					if ($phrasechange == '') {
						$phrasechange = $phrasevr[$l];
					} else {
						$phrasechange .= ' '.$phrasevr[$l];
					}				
				}*/
				$sql = "INSERT INTO `new_phrases`(`phrase` `id_user_add`, `id_project`) VALUES ('$zapros', '$phrasechange', '$id_user', '$id_project')";
				$res=DB::query($sql);

				$zag = 'Дополнить семантическое ядро';
			 	$video = $CONSTS['video_addkey'];
			 	$video_volume = $CONSTS['video_volume'];
			 	$value = 'addkey';
			 	$placeholder = 'Купить iPhone';
			 	$textButton = 'Дополнить';
			 	$buttonid = "addkey";
			 	include('../tmp/markmenu.php');
	 			include('../tmp/addkey.php');
			}
		}
	}

	if (isset($_POST['sendcomment'])) {
		$id_project = $_SESSION['market_'.$market]['id_project'];
		$val = $_POST['sendcomment'];
		$id = $_POST['id'];
		$zayavkiGet = DB::query("UPDATE `new_zayavki` SET `vremaddition`='$val' WHERE `id_project`='$id_project' AND `id_user`='$id'");
	}

	if (isset($_POST['popup'])) {
		if ($_POST['popup'] == 'ads'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			//echo "$id_project ID";
			include('../tmp/previewads.php');
		}

		if ($_POST['popup'] == 'www'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_project_data = $_SESSION['market_'.$market]['id_project_data']; // $_POST['id_project_data']; //
			$namepagesite = 'index'; //ИСПРАВИТЬ  $_SESSION['market_'.$market]['namepagesite']; //
			echo "$id_phrase $id_project $id_project_data $namepagesite ";
			$unsetpos = 'style="position: unset;"';
			$height = "h440px";
			$result = '<div class="promo tac"><div class="h900px">';
			include('../tmp/page_crm.php');
			$result .= '</div></div>';
		}

		if ($_POST['popup'] == 'add'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$video = $CONSTS['video_add'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_add'];
			include('../tmp/add.php');
		}

		if ($_POST['popup'] == 'konk'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$video = $CONSTS['video_konk'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_konk'];
			include('../tmp/konk.php');
		}
		
		if ($_POST['popup'] == 'minus'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$video = $CONSTS['video_minus'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_minus'];
			include('../tmp/minus.php');
		}

		if ($_POST['popup'] == 'edit'){
			$id_phrase = $_POST['id_phrase'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$video = $CONSTS['video_edit'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_edit'];

			$resultData=DB::query("SELECT * FROM `new_phrases_used` WHERE `id_phrase`='$id_phrase'");
			$objData=DB::fetch_object($resultData);
			$phrase = $objData->phrase;

			include('../tmp/edit.php');
		}
	}

	if (isset($_POST['keywordchange'])) {
		$type = $_POST['keywordchange'];
		$val =  $_POST['val'];

		$resultData=DB::query("SELECT * FROM `new_phrases_used` WHERE `id_phrase`='$val'");
		$objData=DB::fetch_object($resultData);
		$phrase = $objData->phrase;

		//Изменить перемещение или статус у фразы в USED ???

		if ($type == 'context') {
			echo "Теперь ключевой запрос '$phrase' будет показывать на поиске";
		}

		if ($type == 'contextrsy') {
			echo "Теперь ключевой запрос '$phrase' будет показывать на поиске и в РСЯ";
		}

		if ($type == 'rsy') {
			echo "Теперь ключевой запрос '$phrase' будет показывать в РСЯ";
		}

		if ($type == 'minus') {
			echo "Ключевой запрос '$phrase' помещен в Минус фразы";
		}

		if ($type == 'minus_word') {
			echo "Слово '$phrase' помещено в Минус слова";
		}
		
	}

	if (isset($_POST['sendname'])) {
		$id_user = $_SESSION['market_'.$market]['id_user'];
		$id_project = $_SESSION['market_'.$market]['id_project'];

		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
		$objUser = DB::fetch_object($resultUsers);
		$laststep = $objUser->laststep;

		$value = $_POST['sendvalue'];
		$value = trim($value);
		$value = mysql_real_escape_string($value);
		//echo " V $value";

		$addfield = 'type="text"';
	 	$script = '';
		$typehtml = 'input';

		if ($_POST['sendname'] == 'name') {
			if ($value <> 'empty') {
				$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					$resultProjectUpdate = DB::query("UPDATE `new_user_info` SET `name`='$value' WHERE `id`='$id_user_info'");
				} else {
					$resultUserInfo = DB::query("INSERT INTO `new_user_info`(`name`) VALUES ('$value')");
					$id_user_info = DB::insert_id();
					$resultUsersUpdate = DB::query("UPDATE `new_users` SET `id_user_info`='$id_user_info' WHERE `id`='$id_user'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'family') {
			if ($value <> 'empty') {
				$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					$resultProjectUpdate = DB::query("UPDATE `new_user_info` SET `family`='$value' WHERE `id`='$id_user_info'");
				} else {
					$resultUserInfo = DB::query("INSERT INTO `new_user_info`(`family`) VALUES ('$value')");
					$id_user_info = DB::insert_id();
					$resultUsersUpdate = DB::query("UPDATE `new_users` SET `id_user_info`='$id_user_info' WHERE `id`='$id_user'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'soname') {
			if ($value <> 'empty') {
				$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					$resultProjectUpdate = DB::query("UPDATE `new_user_info` SET `soname`='$value' WHERE `id`='$id_user_info'");
				} else {
					$resultUserInfo = DB::query("INSERT INTO `new_user_info`(`soname`) VALUES ('$value')");
					$id_user_info = DB::insert_id();
					$resultUsersUpdate = DB::query("UPDATE `new_users` SET `id_user_info`='$id_user_info' WHERE `id`='$id_user'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'site') {
			if ($value <> 'empty') {
				$resultProjectUpdate = DB::query("UPDATE `new_project` SET `site`='$value' WHERE `id`='$id_project'");

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'keyword') {
			if ($value <> 'empty') {
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
				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'inn') {
			$token = $CONSTS['dadata_token'];
			//echo "T $token V $value K";
			$dadata = new SuggestClient($token);
			$query = $value;
			$data = array(
			    'query' => $query
			);
			$resp = $dadata->suggest("party", $data);
			//print_r($resp);
			foreach ($resp->suggestions as $suggestion) {
				$company_name = $suggestion->unrestricted_value;
				$company_name_type = $suggestion->data->opf->short;
			    /*print $organizacia . "\n";
			    print $organizacia_type . "\n";*/

			    $inn = $suggestion->data->inn; //этот inn
			    $ogrn = $suggestion->data->ogrn;
			    $okved = $suggestion->data->okved;
			    /*print $inn . "\n";
			    print $ogrn . "\n";
			    print $okved . "\n";*/
			    
			    $fio = $suggestion->data->name->full;
			    $fioparts = explode(' ', $fio);
			    $family = $fioparts[0];
			    $name = $fioparts[1];
			    $soname = $fioparts[2];
			    /*print $family . "\n";
			    print $name . "\n";
			    print $soname . "\n";*/

			    $region_type = $suggestion->data->address->data->region_type_full;
			    $region = $suggestion->data->address->data->region;
			    $city_type = $suggestion->data->address->data->city_type_full;
			    $city = $suggestion->data->address->data->city;

			    $resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$id_country_proj = $objAddress->id_country;
					$id_regions_proj = $objAddress->id_regions;
					$id_city_proj = $objAddress->id_city;

					$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id_country`='$id_country_proj' AND `region`='$region'");
					$check = DB::num_rows($resultAddressRegion);
					if ($check>0) {
						$objAddressRegion = DB::fetch_object($resultAddressRegion);
						$id_regions_proj = $objAddressRegion->id;
					} else {
						$resAdressRegion = DB::query("INSERT INTO `new_adress_region`(`id_country`, `region`) VALUES ('$id_country_proj', '$region')");
						$id_regions_proj = DB::insert_id();
					}
					

					$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id_region`='$id_regions_proj' AND `city`='$city'");
					$check = DB::num_rows($resultAddressCity);
					if ($check>0) {
						$objAddressRegion = DB::fetch_object($resultAddressCity);
						$id_city_proj = $objAddressRegion->id;
					} else {
						$resAdressRegion = DB::query("INSERT INTO `new_adress_city`(`id_region`, `city`) VALUES ('$id_regions_proj', '$city')");
						$id_city_proj = DB::insert_id();
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id_country`='$id_country_proj' AND `id_regions`='$id_regions_proj' AND `id_city`='$id_city_proj' LIMIT 1");
					$check = DB::num_rows($resultAddress);
					if ($check>0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
						//$street = $objAddress->id_street;
					} else {
						$resAdress = DB::query("INSERT INTO `new_adress`(`id_country`, `id_regions`, `id_city`) VALUES ('$id_country_proj', '$id_regions_proj', '$id_city_proj')");
						$id_address = DB::insert_id();
					}

					$resultProj = DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project`='$id_project'");
				} else {
					$id_country_proj = 1;

					$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id_country`='$id_country_proj' AND `region`='$region'");
					$check = DB::num_rows($resultAddressRegion);
					if ($check>0) {
						$objAddressRegion = DB::fetch_object($resultAddressRegion);
						$id_regions_proj = $objAddressRegion->id;
					} else {
						$resAdressRegion = DB::query("INSERT INTO `new_adress_region`(`id_country`, `region`) VALUES ('$id_country_proj', '$region')");
						$id_regions_proj = DB::insert_id();
					}

					$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id_region`='$id_regions_proj' AND `city`='$city'");
					$check = DB::num_rows($resultAddressCity);
					if ($check>0) {
						$objAddressRegion = DB::fetch_object($resultAddressCity);
						$id_city_proj = $objAddressRegion->id;
					} else {
						$resAdressRegion = DB::query("INSERT INTO `new_adress_city`(`id_region`, `city`) VALUES ('$id_regions_proj', '$city')");
						$id_city_proj = DB::insert_id();
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id_country`='$id_country_proj' AND `id_regions`='$id_regions_proj' AND `id_city`='$id_city_proj' LIMIT 1");
					$check = DB::num_rows($resultAddress);
					if ($check>0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
						//$street = $objAddress->id_street;
					} else {
						$resAdress = DB::query("INSERT INTO `new_adress`(`id_country`, `id_regions`, `id_city`) VALUES ('$id_country_proj', '$id_regions_proj', '$id_city_proj')");
						$id_address = DB::insert_id();
					}

					$resAdress = DB::query("INSERT INTO `new_address_project`(`id_address`, `id_project`) VALUES ('$id_address', '$id_project')");
				}

			    /*print $region_type . "\n";
			    print $region . "\n";
			    print $city_type . "\n";
			    print $city . "\n";*/

			    $resultProjectUpdate = DB::query("UPDATE `new_project` SET `company_name`='$company_name' WHERE `id`='$id_project'");
			    $resultProjectUpdate = DB::query("UPDATE `new_project` SET `ogrn`='$ogrn' WHERE `id`='$id_project'");
			    $resultProjectUpdate = DB::query("UPDATE `new_project` SET `okved`='$okved' WHERE `id`='$id_project'");

			    $resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					//echo "II $id_user_info";
					$resultProjectUpdate = DB::query("UPDATE `new_user_info` SET `family`='$family', `name`='$name', `soname`='$soname', `inn`='$inn'  WHERE `id`='$id_user_info'");
				} else {
					//здесь обработку на уникальность inn сначала Select потом insert или берем существующего

					//Здесь адресс сначала добавляем, но пока нет - вопрос как добавлять адрес без улицы и далее

					$sql = DB::query("INSERT INTO `new_user_info`(`family`, `name`, `soname`, `inn`) VALUES ('$family', '$name', '$soname', '$inn')");
					$id_user_info = DB::insert_id();
					$resultProjectUpdate = DB::query("UPDATE `new_users` SET `id_user_info`='$id_user_info' WHERE `id`='$id_user'");
				}
				
			}

			//Тут можно переход если был введен корректный инн тоесть suggest вернул inn
			if (isset($inn)) {
				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'country') {
			if ($value <> 'empty') {
				$id_city = 'NULL';
				$id_street = 'NULL';
				$id_regions = 'NULL';
				$home = '1';
				$corpus = '';
				$flat = '1';
				$index = '400000';
				$id_country_proj = 0;

				$resultAddressCountry = DB::query("SELECT * FROM `new_adress_country` WHERE `country`='$value'");
				$check = DB::num_rows($resultAddressCountry);
				if ($check > 0) {
					$objAddressCountry = DB::fetch_object($resultAddressCountry);
					$id_country = $objAddressCountry->id;
				} else {
					$resAddressProjInsert = DB::query("INSERT INTO `new_adress_country`(`country`) VALUES ('$value')");
					$id_country = DB::insert_id();
				}

				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$checkAP = DB::num_rows($resultProj);
				if ($checkAP > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);

					if (isset($objAddress->id_country)) {
						$id_country_proj = $objAddress->id_country;
					} else {
						$id_country_proj = 'NULL';
					}

					if (isset($objAddress->id_regions)) {
						$id_regions = $objAddress->id_regions;
					} else {
						$id_regions = 'NULL';
					}

					if (isset($objAddress->id_city)) {
						$id_city = $objAddress->id_city;
					} else {
						$id_city = 'NULL';
					}

					if (isset($objAddress->id_street)) {
						$id_street = $objAddress->id_street;
					} else {
						$id_street = 'NULL';
					}

					$home = $objAddress->home;
					$corpus = $objAddress->corpus;
					$flat = $objAddress->flat;
					$index = $objAddress->index;
				} else {
					$sql = '';
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}
					$resAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql"); //Тест на NULL в SELECT WHERE
					$check = DB::num_rows($resAddress);
					if ($check > 0) {
						$objAddress = DB::fetch_object($resAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}
				}

				if ($id_country <> $id_country_proj) {
					if ($checkAP > 0) {
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country` is $id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= " AND `id_regions`='$id_regions'";
						} else {
							$sql .= " AND `id_regions` is $id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= " AND `id_city`='$id_city'";
						} else {
							$sql .= " AND `id_city` is $id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= " AND `id_street`='$id_street'";
						} else {
							$sql .= " AND `id_street` is $id_street";
						}
						if ($home <> 'NULL') {
							$sql .= " AND `home`='$home'";
						} else {
							$sql .= " AND `home` is $home";
						}
						if ($flat <> 'NULL') {
							$sql .= " AND `flat`='$flat'";
						} else {
							$sql .= " AND `flat` is $flat";
						}
						if ($corpus <> 'NULL') {
							$sql .= " AND `corpus`='$corpus'";
						} else {
							$sql .= " AND `corpus` is $corpus";
						}
						if ($index <> 'NULL') {
							$sql .= " AND `index`='$index'";
						} else {
							$sql .= " AND `index` is $index";
						}
						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
						$check = DB::num_rows($resultAddress);
						if ($check > 0) {
							$objAddress = DB::fetch_object($resultAddress);
							$id_address = $objAddress->id;
						} else {
							$sql = '';
							if ($id_country <> 'NULL') {
								$sql = " `id_country`='$id_country'";
							} else {
								$sql = " `id_country`=$id_country";
							}
							if ($id_regions <> 'NULL') {
								$sql .= ", `id_regions`='$id_regions'";
							} else {
								$sql .= ", `id_regions`=$id_regions";
							}
							if ($id_city <> 'NULL') {
								$sql .= ", `id_city`='$id_city'";
							} else {
								$sql .= ", `id_city`=$id_city";
							}
							if ($id_street <> 'NULL') {
								$sql .= ", `id_street`='$id_street'";
							} else {
								$sql .= ", `id_street`=$id_street";
							}
							if ($home <> 'NULL') {
								$sql .= ", `home`='$home'";
							} else {
								$sql .= ", `home`=$home";
							}
							if ($corpus <> 'NULL') {
								$sql .= ", `corpus`='$corpus'";
							} else {
								$sql .= ", `corpus`=$corpus";
							}
							if ($flat <> 'NULL') {
								$sql .= ", `flat`='$flat'";
							} else {
								$sql .= ", `flat`=$flat";
							}
							if ($index <> 'NULL') {
								$sql .= ", `index`='$index'";
							} else {
								$sql .= ", `index`=$index";
							}
							echo "<br>$sql";
							$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
							$id_address = DB::insert_id();
						}
						$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
					} else {
						$resAddressProjInsert = DB::query("INSERT INTO `new_address_project`(`id_address`, `id_project`, `main`) VALUES ('$id_address', '$id_project', '1')");
					}
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'region') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions_proj = $objAddress->id_regions;
				} else {
					$id_regions_proj = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index = $objAddress->index;

				$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `region`='$value'");
				$check = DB::num_rows($resultAddressRegion);
				
				if ($check > 0) {
					$objAddressRegion = DB::fetch_object($resultAddressRegion);
					$id_regions = $objAddressRegion->id;
				} else {
					$resAddressProjInsert = DB::query("INSERT INTO `new_adress_region`(`region`, `id_country`) VALUES ('$value', '$id_country')");
					$id_regions = DB::insert_id();
				}

				if ($id_regions <> $id_regions_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}
					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'city') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city_proj = $objAddress->id_city;
				} else {
					$id_city_proj = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index = $objAddress->index;
				
				$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `city`='$value' AND `id_region`='$id_regions'");
				$check = DB::num_rows($resultAddressCity);

				if ($check > 0) {
					$objAddressCity = DB::fetch_object($resultAddressCity);
					$id_city = $objAddressCity->id;
				} else {
					$resAddressProjInsert = DB::query("INSERT INTO `new_adress_city` (`city`, `id_region`) VALUES ('$value' '$id_regions')");
					$id_city = DB::insert_id();
				}

				if ($id_city <> $id_city_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'street') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street_proj = $objAddress->id_street;
				} else {
					$id_street_proj = 'NULL';
				}
				$home = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index = $objAddress->index;
				
				$resultAddressStreet = DB::query("SELECT * FROM `new_adress_street` WHERE `street`='$value' AND `id_city`='$id_city'");
				$check = DB::num_rows($resultAddressStreet);

				if ($check > 0) {
					$objAddressStreet = DB::fetch_object($resultAddressStreet);
					$id_street = $objAddressStreet->id;
				} else {
					$resAddressProjInsert = DB::query("INSERT INTO `new_adress_city` (`street`, `id_city`) VALUES ('$value' '$id_city')");
					$id_street = DB::insert_id();
				}

				if ($id_street <> $id_street_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'home') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home_proj = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index = $objAddress->index;
				$home = $value;
				
				if ($home <> $home_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'corpus') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home = $objAddress->home;
				$corpus_proj = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index = $objAddress->index;
				$corpus = $value;
				
				if ($corpus <> $corpus_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'flat') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat_proj = $objAddress->flat;
				$index = $objAddress->index;
				$flat = $value;
				
				if ($flat <> $flat_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'index') {
			if ($value <> 'empty') {
				$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
				$objProject = DB::fetch_object($resultProj);
				$id_address_proj = $objProject->id_address;

				$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
				$objAddress = DB::fetch_object($resultAddress);
				if (isset($objAddress->id_country)) {
					$id_country = $objAddress->id_country;
				} else {
					$id_country = 'NULL';
				}

				if (isset($objAddress->id_regions)) {
					$id_regions = $objAddress->id_regions;
				} else {
					$id_regions = 'NULL';
				}

				if (isset($objAddress->id_city)) {
					$id_city = $objAddress->id_city;
				} else {
					$id_city = 'NULL';
				}

				if (isset($objAddress->id_street)) {
					$id_street = $objAddress->id_street;
				} else {
					$id_street = 'NULL';
				}
				$home = $objAddress->home;
				$corpus = $objAddress->corpus;
				$flat = $objAddress->flat;
				$index_proj = $objAddress->index;
				$index = $value;
				
				if ($index <> $index_proj) {
					if ($id_country <> 'NULL') {
						$sql = " `id_country`='$id_country'";
					} else {
						$sql = " `id_country` is $id_country";
					}
					if ($id_regions <> 'NULL') {
						$sql .= " AND `id_regions`='$id_regions'";
					} else {
						$sql .= " AND `id_regions` is $id_regions";
					}
					if ($id_city <> 'NULL') {
						$sql .= " AND `id_city`='$id_city'";
					} else {
						$sql .= " AND `id_city` is $id_city";
					}
					if ($id_street <> 'NULL') {
						$sql .= " AND `id_street`='$id_street'";
					} else {
						$sql .= " AND `id_street` is $id_street";
					}
					if ($home <> 'NULL') {
						$sql .= " AND `home`='$home'";
					} else {
						$sql .= " AND `home` is $home";
					}
					if ($flat <> 'NULL') {
						$sql .= " AND `flat`='$flat'";
					} else {
						$sql .= " AND `flat` is $flat";
					}
					if ($corpus <> 'NULL') {
						$sql .= " AND `corpus`='$corpus'";
					} else {
						$sql .= " AND `corpus` is $corpus";
					}
					if ($index <> 'NULL') {
						$sql .= " AND `index`='$index'";
					} else {
						$sql .= " AND `index` is $index";
					}

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE $sql");
					$check = DB::num_rows($resultAddress);

					if ($check > 0) {
						$objAddress = DB::fetch_object($resultAddress);
						$id_address = $objAddress->id;
					} else {
						$sql = '';
						if ($id_country <> 'NULL') {
							$sql = " `id_country`='$id_country'";
						} else {
							$sql = " `id_country`=$id_country";
						}
						if ($id_regions <> 'NULL') {
							$sql .= ", `id_regions`='$id_regions'";
						} else {
							$sql .= ", `id_regions`=$id_regions";
						}
						if ($id_city <> 'NULL') {
							$sql .= ", `id_city`='$id_city'";
						} else {
							$sql .= ", `id_city`=$id_city";
						}
						if ($id_street <> 'NULL') {
							$sql .= ", `id_street`='$id_street'";
						} else {
							$sql .= ", `id_street`=$id_street";
						}
						if ($home <> 'NULL') {
							$sql .= ", `home`='$home'";
						} else {
							$sql .= ", `home`=$home";
						}
						if ($corpus <> 'NULL') {
							$sql .= ", `corpus`='$corpus'";
						} else {
							$sql .= ", `corpus`=$corpus";
						}
						if ($flat <> 'NULL') {
							$sql .= ", `flat`='$flat'";
						} else {
							$sql .= ", `flat`=$flat";
						}
						if ($index <> 'NULL') {
							$sql .= ", `index`='$index'";
						} else {
							$sql .= ", `index`=$index";
						}

						$resAddressProjInsert = DB::query("INSERT INTO `new_adress` SET $sql");
						$id_address = DB::insert_id();
					}

					$resAddressProjUpdate=DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project` = '$id_project'");
				}

				$laststep++;
				$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
			}
		}

		if ($_POST['sendname'] == 'ogrn') {
			if ($value <> 'empty') {
				$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `ogrn`='$value' WHERE `id` = '$id_project'");
			} else {
				$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `ogrn`='' WHERE `id` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'companyname') {
			if ($value <> 'empty') {
				$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `company_name`='$value' WHERE `id` = '$id_project'");
			} else {
				$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `company_name`='' WHERE `id` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'projectname') {
			if ($value <> 'empty') {
				if ($value <> $market) {
					$resultProj = DB::query("SELECT * FROM `new_project` WHERE `durl`='$value'");
					$check = DB::num_rows($resultProj);
					if ($check == 0) {
						$objProject = DB::fetch_object($resultProj);
						$site = $objProject->site;
						$oldsite = $protocol.'://'.$sitemain.'/'.$market.'/';


						chdir($_SERVER['DOCUMENT_ROOT']);
						rename("$market", "$value");
						//Ссылку изменить ещё надо
						$sql = '';
						if ($site == $oldsite) {
							$newsite = $protocol.'://'.$sitemain.'/'.$value.'/';
							$sql = "`site`='$newsite'";
						}
						$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `durl`='$value' $sql WHERE `id` = '$id_project'");

						$laststep++;
						$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
						//header('location: '.$protocol.'://'.$sitemain.'/'.$value.'/CRM3.php');
						$result = $protocol.'://'.$sitemain.'/'.$value.'/CRM3.php';
						echo "$result";
						exit();
					}  else {
						$error = 'Данное имя уже занято. Придумайте другое имя.';
					}
				} else {
					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				}
			}
		}

		if ($_POST['sendname'] == 'srcheck') {
			if (is_numeric($value)) {
				if ($value > 0) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `srcheck`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'marzha') {
			if (is_numeric($value)) {
				if ( ($value > 0) AND ($value < 1) ) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `marja`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'koefreklama') {
			if (is_numeric($value)) {
				if ( ($value > 0) AND ($value < 1) ) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `rekbut`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'k1') {
			if (is_numeric($value)) {
				if ( ($value > 0) AND ($value < 1) ) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `con1`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'k2') {
			if (is_numeric($value)) {
				if ( ($value > 0) AND ($value < 1) ) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `con2`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'costclick') {
			if (is_numeric($value)) {
				if ($value > 0) {
					$resAddressProjUpdate=DB::query("UPDATE `new_project` SET `costclick`='$value' WHERE `id` = '$id_project'");

					$laststep++;
					$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
				} else {
					$error = 'Введите число большее 0';
				}
			} else {
				$error = 'Введите число';
			}
		}

		if ($_POST['sendname'] == 'day_from') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeDays_s) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$value' AND `id_to_day`='$idWorktimeDays_po' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$idWorktimeMin_po'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$value', `id_to_day`='$idWorktimeDays_po', `id_from_hour`='$idWorktimeHours_s', `id_to_hour`='$idWorktimeHours_po', `id_from_min`='$idWorktimeMin_s', `id_to_min`='$idWorktimeMin_po'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'day_to') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeDays_po) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$idWorktimeDays_s' AND `id_to_day`='$value' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$idWorktimeMin_po'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$idWorktimeDays_s', `id_to_day`='$value', `id_from_hour`='$idWorktimeHours_s', `id_to_hour`='$idWorktimeHours_po', `id_from_min`='$idWorktimeMin_s', `id_to_min`='$idWorktimeMin_po'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'hour_from') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeHours_s) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$idWorktimeDays_s' AND `id_to_day`='$idWorktimeDays_po' AND `id_from_hour`='$value' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$idWorktimeMin_po'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$idWorktimeDays_s', `id_to_day`='$idWorktimeDays_po', `id_from_hour`='$value', `id_to_hour`='$idWorktimeHours_po', `id_from_min`='$idWorktimeMin_s', `id_to_min`='$idWorktimeMin_po'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'hour_to') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeHours_po) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$idWorktimeDays_s' AND `id_to_day`='$idWorktimeDays_po' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$value' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$idWorktimeMin_po'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$idWorktimeDays_s', `id_to_day`='$idWorktimeDays_po', `id_from_hour`='$idWorktimeHours_s', `id_to_hour`='$value', `id_from_min`='$idWorktimeMin_s', `id_to_min`='$idWorktimeMin_po'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'min_from') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeMin_s) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$idWorktimeDays_s' AND `id_to_day`='$idWorktimeDays_po' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$value' AND `id_to_min`='$idWorktimeMin_po'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$idWorktimeDays_s', `id_to_day`='$idWorktimeDays_po', `id_from_hour`='$idWorktimeHours_s', `id_to_hour`='$idWorktimeHours_po', `id_from_min`='$value', `id_to_min`='$idWorktimeMin_po'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'min_to') {
			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 	$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
			$id_worktime = $objWorktimeUser->id_worktime;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
			$objWorktime = DB::fetch_object($resultWorktime);
			$idWorktimeDays_s = $objWorktime->id_from_day;
			$idWorktimeDays_po = $objWorktime->id_to_day;
			$idWorktimeHours_s = $objWorktime->id_from_hour;
			$idWorktimeHours_po = $objWorktime->id_to_hour;
			$idWorktimeMin_s = $objWorktime->id_from_min;
			$idWorktimeMin_po = $objWorktime->id_to_min;

			if ($value <> $idWorktimeMin_po) {
				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$idWorktimeDays_s' AND `id_to_day`='$idWorktimeDays_po' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$value'");
				$check = DB::num_rows($resultWorktime);
				if ($check > 0) {
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_worktime = $objWorktime->id;
				} else {
					$resultWorktime=DB::query("INSERT `new_worktime` SET `id_from_day`='$idWorktimeDays_s', `id_to_day`='$idWorktimeDays_po', `id_from_hour`='$idWorktimeHours_s', `id_to_hour`='$idWorktimeHours_po', `id_from_min`='$idWorktimeMin_s', `id_to_min`='$value'");
					$id_worktime = DB::insert_id();
				}

				$FastlinkUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`= '$id_worktime' WHERE `id_project` = '$id_project'");
			}

			$laststep++;
			$resultUsers = DB::query("UPDATE `new_users` SET `laststep`='$laststep' WHERE `id`='$id_user'");
		}

		if ($_POST['sendname'] == 'zagolovok1') {
			
		}

		$resultVoronka = DB::query("SELECT * FROM `new_voronka` WHERE `id_project`='1' AND `step`='$laststep'");
		$check = DB::num_rows($resultVoronka);
		if ($check > 0) {
			$objVoronka = DB::fetch_object($resultVoronka);
			$now_step_proj_data = $objVoronka->id_project_data;

			$resultData=DB::query("SELECT * FROM `new_project_data` WHERE `id`='$now_step_proj_data'");
			$objData=DB::fetch_object($resultData);
			$idform = $objData->id_form;

			$resultForm = DB::query("SELECT * FROM `new_forms` WHERE `id`='$idform'"); //ТУТ МАССИВ //УПРОЩАЕМ ПО ОДНОМУ ПОЛЮ? //ПОКА НА ОДНО ПОЛЕ
			$objForm = DB::fetch_object($resultForm);

			$resultInputsForm = DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form`='$idform'"); //ТУТ МАССИВ //УПРОЩАЕМ ПО ОДНОМУ ПОЛЮ? //ПОКА НА ОДНО ПОЛЕ
			$objInputsForm = DB::fetch_object($resultInputsForm);
			$idinputs = $objInputsForm->id_inputs;

			$resultInputs = DB::query("SELECT * FROM `new_inputs` WHERE `id`='$idinputs'");
			$objInputs = DB::fetch_object($resultInputs);

			$zag = $objForm->value_text;
		 	$video = $objData->video;
		 	$video_volume = $CONSTS['video_volume'];
		 	$field = $objInputs->name;

		 	if ($field == 'site') {
		 		$value = $protocol.'://'.$sitemain.'/'.$market.'/';
		 	}

		 	if ($field == 'name') {
		 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					
					$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check = DB::num_rows($resultUserInfo);
					if ($check > 0) {
						$objUserInfo = DB::fetch_object($resultUserInfo);
						$value = $objUserInfo->name;
					}
				}
		 	}

		 	if ($field == 'family') {
		 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					
					$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check = DB::num_rows($resultUserInfo);
					if ($check > 0) {
						$objUserInfo = DB::fetch_object($resultUserInfo);
						$value = $objUserInfo->family;
					}
				}
		 	}

		 	if ($field == 'soname') {
		 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resultUsers);
				if (isset($objUser->id_user_info)) {
					$id_user_info = $objUser->id_user_info;
					
					$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check = DB::num_rows($resultUserInfo);
					if ($check > 0) {
						$objUserInfo = DB::fetch_object($resultUserInfo);
						$value = $objUserInfo->soname;
					}
				}
		 	}

		 	if ($field == 'country') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$id_country_proj = $objAddress->id_country;

					$resultAddressCountry = DB::query("SELECT * FROM `new_adress_country` WHERE `id`='$id_country_proj'");
					$objAddressCountry = DB::fetch_object($resultAddressCountry);
					$value = $objAddressCountry->country;
				}
		 	}

		 	if ($field == 'region') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$id_regions_proj = $objAddress->id_regions;

					$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_regions_proj'");
					$objAddressRegion = DB::fetch_object($resultAddressRegion);
					$value = $objAddressRegion->region;
				}
		 	}

		 	if ($field == 'city') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$id_city_proj = $objAddress->id_city;

					$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id`='$id_city_proj'");
					$objAddressCity = DB::fetch_object($resultAddressCity);
					$value = $objAddressCity->city;
				}
		 	}

		 	if ($field == 'street') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$id_street_proj = $objAddress->id_regions;

					$resultAddressStreet = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_street_proj'");
					$objAddressStreet = DB::fetch_object($resultAddressStreet);
					$value = $objAddressStreet->street;
				}
		 	}

		 	if ($field == 'home') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$value = $objAddress->home;
				}
		 	}

		 	if ($field == 'corpus') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$value = $objAddress->corpus;
				}
		 	}

		 	if ($field == 'flat') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$value = $objAddress->flat;
				}
		 	}

		 	if ($field == 'index') {
		 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$id_address_proj = $objProject->id_address;

					$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
					$objAddress = DB::fetch_object($resultAddress);
					$value = $objAddress->index;
				}
		 	}

		 	if ($field == 'ogrn') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$value = $objProject->ogrn;
				}
		 	}

		 	if ($field == 'companyname') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$value = $objProject->company_name;
				}
		 	}

		 	if ($field == 'projectname') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$value = $objProject->durl;
				}
		 	}

		 	if ($field == 'srcheck') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					if (isset($objProject->srcheck)) {
						$value = $objProject->srcheck;
					} else {
						$value = '';
					}
				}
				$addfield = 'min="0" type="number" required';
		 	}

		 	if ($field == 'marzha') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					if (isset($objProject->marja)) {
						$value = $objProject->marja;
					} else {
						$value = '0.5';
					}
				}
				$addfield = 'min="0" max="1" step="0.01" type="number" required';
		 	}

		 	if ($field == 'koefreklama') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					if (isset($objProject->rekbut)) {
						$value = $objProject->rekbut;
					} else {
						$value = '0.2';
					}
				}
				$addfield = 'min="0" max="1" step="0.01" type="number" required';
		 	}

		 	if ($field == 'k1') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					if (isset($objProject->con1)) {
						$value = $objProject->con1;
					} else {
						$value = '0.01';
					}
				}
				$addfield = 'min="0" max="1" step="0.01" type="number" required';
		 	}

		 	if ($field == 'k2') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					if (isset($objProject->con2)) {
						$value = $objProject->con2;
					} else {
						$value = '0.2';
					}
				}
				$addfield = 'min="0" max="1" step="0.01" type="number" required';
		 	}

		 	if ($field == 'costclick') {
		 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		 		$check = DB::num_rows($resultProj);
				if ($check > 0) {
					$objProject = DB::fetch_object($resultProj);
					$srcheck = $objProject->srcheck;
					$marja = $objProject->marja;
					$koefreklama = $objProject->rekbut;
					$con1 = $objProject->con1;
					$con2 = $objProject->con2;
					$value = $srcheck*$marja*$koefreklama*$con1*$con2;
				}
				$addfield = 'min="0" type="number" step="0.01" required';
		 	}

		 	if ($field == 'day_from') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_from_day = $objWorktime->id_from_day;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_from_day = '1';
				}

				$innerselect = '';
		 		$resultWorktimeDays = DB::query("SELECT * FROM `new_worktime_days`");
				while ($objWorktimeDays = DB::fetch_object($resultWorktimeDays)) {
					$id_WorktimeDays = $objWorktimeDays->id;
					$value_WorktimeDays = $objWorktimeDays->value_long;
					$selected = '';
					if ($id_from_day == $id_WorktimeDays) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeDays.'"'.$selected.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
				}
		 	}

		 	if ($field == 'day_to') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_to_day = $objWorktime->id_to_day;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_to_day = '1';
				}

				$innerselect = '';
		 		$resultWorktimeDays = DB::query("SELECT * FROM `new_worktime_days`");
				while ($objWorktimeDays = DB::fetch_object($resultWorktimeDays)) {
					$id_WorktimeDays = $objWorktimeDays->id;
					$value_WorktimeDays = $objWorktimeDays->value_long;
					$selected = '';
					if ($id_to_day == $id_WorktimeDays) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeDays.'"'.$selected.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
				}
		 	}
		 	
		 	if ($field == 'hour_from') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_from_hour = $objWorktime->id_from_hour;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_from_hour = '1';
				}

				$innerselect = '';
		 		$resultWorktimeHours = DB::query("SELECT * FROM `new_worktime_hours`");
				while ($objWorktimeHours = DB::fetch_object($resultWorktimeHours)) {
					$id_WorktimeHours = $objWorktimeHours->id;
					$value_WorktimeHours = $objWorktimeHours->hour;
					$selected = '';
					if ($id_from_hour == $id_WorktimeHours) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeHours.'"'.$selected.'>'.htmlspecialchars($value_WorktimeHours).'</option>';
				}
		 	}

		 	if ($field == 'hour_to') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_to_hour = $objWorktime->id_to_hour;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_to_hour = '1';
				}

				$innerselect = '';
		 		$resultWorktimeHours = DB::query("SELECT * FROM `new_worktime_hours`");
				while ($objWorktimeHours = DB::fetch_object($resultWorktimeHours)) {
					$id_WorktimeHours = $objWorktimeHours->id;
					$value_WorktimeHours = $objWorktimeHours->hour;
					$selected = '';
					if ($id_to_hour == $id_WorktimeHours) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeHours.'"'.$selected.'>'.htmlspecialchars($value_WorktimeHours).'</option>';
				}
		 	}

		 	if ($field == 'min_from') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_from_min = $objWorktime->id_from_min;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_from_min = '1';
				}

				$innerselect = '';
		 		$resultWorktimeMin = DB::query("SELECT * FROM `new_worktime_min`");
				while ($objWorktimeMin = DB::fetch_object($resultWorktimeMin)) {
					$id_WorktimeMin = $objWorktimeMin->id;
					$value_WorktimeMin = $objWorktimeMin->min;
					$selected = '';
					if ($id_from_min == $id_WorktimeMin) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeMin.'"'.$selected.'>'.htmlspecialchars($value_WorktimeMin).'</option>';
				}
		 	}

		 	if ($field == 'min_to') {
		 		$typehtml = 'select';
		 		$addfield = '';

		 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
		 		$check = DB::num_rows($resultWorktimeUser);
				if ($check > 0) {
					$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
					$id_worktime = $objWorktimeUser->id_worktime;

					$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
					$objWorktime = DB::fetch_object($resultWorktime);
					$id_to_min = $objWorktime->id_to_min;
				} else {
					$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
					$id_to_min = '1';
				}

				$innerselect = '';
		 		$resultWorktimeMin = DB::query("SELECT * FROM `new_worktime_min`");
				while ($objWorktimeMin = DB::fetch_object($resultWorktimeMin)) {
					$id_WorktimeMin = $objWorktimeMin->id;
					$value_WorktimeMin = $objWorktimeMin->min;
					$selected = '';
					if ($id_to_min == $id_WorktimeMin) {
						$selected = ' selected';
					}
					$innerselect .= '<option value="'.$id_WorktimeMin.'"'.$selected.'>'.htmlspecialchars($value_WorktimeMin).'</option>';
				}
		 	}

		 	if ($field == 'zagolovok1') {
		 		$id_project = '1';
		 		$resultPhrasesUsed = DB::query("SELECT * FROM `new_phrases_used` WHERE `id_project`='$id_project' LIMIT 1");
				$check = DB::num_rows($resultPhrasesUsed);
				if ($check > 0) {
					$objPhrasesUsed = DB::fetch_object($resultPhrasesUsed);
					$id_phrase = $objPhrasesUsed->id_phrase;

					$resultPhrasesZag = DB::query("SELECT * FROM `new_phrases_zag` WHERE `id_phrase`='$id_phrase' LIMIT 1");
					$check = DB::num_rows($resultPhrasesZag);
					if ($check > 0) {
						$objPhrasesZag = DB::fetch_object($resultPhrasesZag);
						$value = $objPhrasesZag->value;
					}
				}

				//ELSE ВЕРНИТЕСЬ ПОЗЖЕ???
		 	}

		 	/*if ($field == 'inn') {
		 		$script = '
		 		<script type="text/javascript">
		 			$("input[name=inn]").suggestions({
				        token: "'.$CONSTS['dadata_token'].'",
				        type: "ADDRESS",
				        count: 5,
				        
				        onSelect: function(suggestion) {
				            //console.log(suggestion);
				            var address = suggestion.data;
				            alert(address.postal_code);
				        }	        
				    });
				</script>';
		 	}*/
		 	$placeholder = $objInputs->placeholder;
		 	$textButton = $objForm->value_button;

			include ('../tmp/stepinput.php');
		} else {
			$zag = 'Конечная';
		 	$video = $CONSTS['video_laststep'];
		 	$video_volume = $CONSTS['video_volume'];
		 	$textButton = 'Перейти';
			include ('../tmp/stepinputend.php');
		}

		//if ($_SESSION['market_'.$market]['laststep'] == 1) {
			//$id_project_data = $_SESSION['market_'.$market]['id_project_data']; //Чтобы все получить нужен id_project_data //А значит все следующее можно переместить в файл steps.php  и выполнять include('../tmp/steps.php');
			//print_r($_SESSION);
	}

	if (isset($_POST['menu_link'])) {

		if ($_POST['menu_link'] == 'welcome'){
			$video = $CONSTS['video_welcome'];
			$video_volume = $CONSTS['video_volume'];
 			include('../tmp/welcome.php');
		}

		if ($_POST['menu_link'] == 'id_zayavki'){
			if (isset($_POST['id_zayavki'])) {
				$id_zayavki = $_POST['id_zayavki'];
				$id_project = $_SESSION['market_'.$market]['id_project'];
				$video = $CONSTS['video_zayavki'];
				$video_volume = $CONSTS['video_volume'];
				echo '<div class="promo">';
	 			include('../tmp/card.php');
	 			echo $result2;
	 			echo "</div>";
	 			exit();
			}
		}

		if ($_POST['menu_link'] == 'zayavki'){
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$video = $CONSTS['video_zayavki'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_zayavki'];
			$zag = 'Входящие заявки';
 			include('../tmp/zayavki.php');
		}

		if ($_POST['menu_link'] == 'bonus'){
			$video = $CONSTS['video_bonus'];
			$video_volume = $CONSTS['video_volume'];
			$zag = $CONSTS['zag_bonus'];
			$user_ref = $_SESSION['market_'.$market]['id_user'];
 			include('../tmp/bonus.php');
		}

		if ( ($_POST['menu_link'] == 'start') || ($_POST['menu_link'] == 'next') ) { // if ($_POST['menu_link'] == 'next'){ совпадает со старт сделать через "или"?
			//Здесь выводим по LASTSTEP условию //Мог первый раз зайти, но на лендинге пройти несколько шагов а так обычно ластстеп = 2
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$script = '';

			$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
			$objUser = DB::fetch_object($resultUsers);
			$laststep = $objUser->laststep;

			$resultVoronka = DB::query("SELECT * FROM `new_voronka` WHERE `id_project`='1' AND `step`='$laststep'");
			$check = DB::num_rows($resultVoronka);
			if ($check > 0) {
				$objVoronka = DB::fetch_object($resultVoronka);
				$now_step_proj_data = $objVoronka->id_project_data;

				$resultData=DB::query("SELECT * FROM `new_project_data` WHERE `id`='$now_step_proj_data'");
				$objData=DB::fetch_object($resultData);
				$idform = $objData->id_form;

				$resultForm = DB::query("SELECT * FROM `new_forms` WHERE `id`='$idform'"); //ТУТ МАССИВ //УПРОЩАЕМ ПО ОДНОМУ ПОЛЮ? //ПОКА НА ОДНО ПОЛЕ
				$objForm = DB::fetch_object($resultForm);

				$resultInputsForm = DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form`='$idform'"); //ТУТ МАССИВ //УПРОЩАЕМ ПО ОДНОМУ ПОЛЮ? //ПОКА НА ОДНО ПОЛЕ
				$objInputsForm = DB::fetch_object($resultInputsForm);
				$idinputs = $objInputsForm->id_inputs;

				$resultInputs = DB::query("SELECT * FROM `new_inputs` WHERE `id`='$idinputs'");
				$objInputs = DB::fetch_object($resultInputs);

				$zag = $objForm->value_text;
			 	$video = $objData->video;
			 	$video_volume = $CONSTS['video_volume'];
			 	$field = $objInputs->name;
			 	
			 	$addfield = 'type="text"';
			 	$script = '';
				$typehtml = 'input';

			 	if ($field == 'site') {
			 		$value = $protocol.'://'.$sitemain.'/'.$market.'/';
			 	}

			 	if ($field == 'name') {
			 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
					$objUser = DB::fetch_object($resultUsers);
					if (isset($objUser->id_user_info)) {
						$id_user_info = $objUser->id_user_info;
						
						$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
						$check = DB::num_rows($resultUserInfo);
						if ($check > 0) {
							$objUserInfo = DB::fetch_object($resultUserInfo);
							$value = $objUserInfo->name;
						}
					}
			 	}

			 	if ($field == 'family') {
			 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
					$objUser = DB::fetch_object($resultUsers);
					if (isset($objUser->id_user_info)) {
						$id_user_info = $objUser->id_user_info;
						
						$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
						$check = DB::num_rows($resultUserInfo);
						if ($check > 0) {
							$objUserInfo = DB::fetch_object($resultUserInfo);
							$value = $objUserInfo->family;
						}
					}
			 	}

			 	if ($field == 'soname') {
			 		$resultUsers = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
					$objUser = DB::fetch_object($resultUsers);
					if (isset($objUser->id_user_info)) {
						$id_user_info = $objUser->id_user_info;
						
						$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
						$check = DB::num_rows($resultUserInfo);
						if ($check > 0) {
							$objUserInfo = DB::fetch_object($resultUserInfo);
							$value = $objUserInfo->soname;
						}
					}
			 	}

			 	if ($field == 'country') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$id_country_proj = $objAddress->id_country;

						$resultAddressCountry = DB::query("SELECT * FROM `new_adress_country` WHERE `id`='$id_country_proj'");
						$objAddressCountry = DB::fetch_object($resultAddressCountry);
						$value = $objAddressCountry->country;
					}
			 	}

			 	if ($field == 'region') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$id_regions_proj = $objAddress->id_regions;

						$resultAddressRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_regions_proj'");
						$objAddressRegion = DB::fetch_object($resultAddressRegion);
						$value = $objAddressRegion->region;
					}
			 	}

			 	if ($field == 'city') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$id_city_proj = $objAddress->id_city;

						$resultAddressCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id`='$id_city_proj'");
						$objAddressCity = DB::fetch_object($resultAddressCity);
						$value = $objAddressCity->city;
					}
			 	}

			 	if ($field == 'street') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$id_street_proj = $objAddress->id_regions;

						$resultAddressStreet = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_street_proj'");
						$objAddressStreet = DB::fetch_object($resultAddressStreet);
						$value = $objAddressStreet->street;
					}
			 	}

			 	if ($field == 'home') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$value = $objAddress->home;
					}
			 	}

			 	if ($field == 'corpus') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$value = $objAddress->corpus;
					}
			 	}

			 	if ($field == 'flat') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$value = $objAddress->flat;
					}
			 	}

			 	if ($field == 'index') {
			 		$resultProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$id_address_proj = $objProject->id_address;

						$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address_proj'");
						$objAddress = DB::fetch_object($resultAddress);
						$value = $objAddress->index;
					}
			 	}

			 	if ($field == 'ogrn') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$value = $objProject->ogrn;
					}
			 	}

			 	if ($field == 'companyname') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$value = $objProject->company_name;
					}
			 	}

			 	if ($field == 'projectname') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$value = $objProject->durl;
					}
			 	}

			 	if ($field == 'srcheck') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						if (isset($objProject->srcheck)) {
							$value = $objProject->srcheck;
						} else {
							$value = '';
						}
					}
					$addfield = 'min="0" type="number" required';
			 	}

			 	if ($field == 'marzha') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						if (isset($objProject->marja)) {
							$value = $objProject->marja;
						} else {
							$value = '0.5';
						}
					}
					$addfield = 'min="0" max="1" step="0.01" type="number" required';
			 	}

			 	if ($field == 'koefreklama') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						if (isset($objProject->rekbut)) {
							$value = $objProject->rekbut;
						} else {
							$value = '0.2';
						}
					}
					$addfield = 'min="0" max="1" step="0.01" type="number" required';
			 	}

			 	if ($field == 'k1') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						if (isset($objProject->con1)) {
							$value = $objProject->con1;
						} else {
							$value = '0.01';
						}
					}
					$addfield = 'min="0" max="1" step="0.01" type="number" required';
			 	}

			 	if ($field == 'k2') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						if (isset($objProject->con2)) {
							$value = $objProject->con2;
						} else {
							$value = '0.2';
						}
					}
					$addfield = 'min="0" max="1" step="0.01" type="number" required';
			 	}

			 	if ($field == 'costclick') {
			 		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			 		$check = DB::num_rows($resultProj);
					if ($check > 0) {
						$objProject = DB::fetch_object($resultProj);
						$srcheck = $objProject->srcheck;
						$marja = $objProject->marja;
						$koefreklama = $objProject->rekbut;
						$con1 = $objProject->con1;
						$con2 = $objProject->con2;
						$value = $srcheck*$marja*$koefreklama*$con1*$con2;
					}
					$addfield = 'min="0" type="number" step="0.01" required';
			 	}

			 	if ($field == 'day_from') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_from_day = $objWorktime->id_from_day;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_from_day = '1';
					}

					$innerselect = '';
			 		$resultWorktimeDays = DB::query("SELECT * FROM `new_worktime_days`");
					while ($objWorktimeDays = DB::fetch_object($resultWorktimeDays)) {
						$id_WorktimeDays = $objWorktimeDays->id;
						$value_WorktimeDays = $objWorktimeDays->value_long;
						$selected = '';
						if ($id_from_day == $id_WorktimeDays) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeDays.'"'.$selected.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
					}
			 	}

			 	if ($field == 'day_to') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_to_day = $objWorktime->id_to_day;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_to_day = '1';
					}

					$innerselect = '';
			 		$resultWorktimeDays = DB::query("SELECT * FROM `new_worktime_days`");
					while ($objWorktimeDays = DB::fetch_object($resultWorktimeDays)) {
						$id_WorktimeDays = $objWorktimeDays->id;
						$value_WorktimeDays = $objWorktimeDays->value_long;
						$selected = '';
						if ($id_to_day == $id_WorktimeDays) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeDays.'"'.$selected.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
					}
			 	}

			 	if ($field == 'hour_from') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_from_hour = $objWorktime->id_from_hour;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_from_hour = '1';
					}

					$innerselect = '';
			 		$resultWorktimeHours = DB::query("SELECT * FROM `new_worktime_hours`");
					while ($objWorktimeHours = DB::fetch_object($resultWorktimeHours)) {
						$id_WorktimeHours = $objWorktimeHours->id;
						$value_WorktimeHours = $objWorktimeHours->hour;
						$selected = '';
						if ($id_from_hour == $id_WorktimeHours) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeHours.'"'.$selected.'>'.htmlspecialchars($value_WorktimeHours).'</option>';
					}
			 	}

			 	if ($field == 'hour_to') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_to_hour = $objWorktime->id_to_hour;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_to_hour = '1';
					}

					$innerselect = '';
			 		$resultWorktimeHours = DB::query("SELECT * FROM `new_worktime_hours`");
					while ($objWorktimeHours = DB::fetch_object($resultWorktimeHours)) {
						$id_WorktimeHours = $objWorktimeHours->id;
						$value_WorktimeHours = $objWorktimeHours->hour;
						$selected = '';
						if ($id_to_hour == $id_WorktimeHours) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeHours.'"'.$selected.'>'.htmlspecialchars($value_WorktimeHours).'</option>';
					}
			 	}

			 	if ($field == 'min_from') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_from_min = $objWorktime->id_from_min;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_from_min = '1';
					}

					$innerselect = '';
			 		$resultWorktimeMin = DB::query("SELECT * FROM `new_worktime_min`");
					while ($objWorktimeMin = DB::fetch_object($resultWorktimeMin)) {
						$id_WorktimeMin = $objWorktimeMin->id;
						$value_WorktimeMin = $objWorktimeMin->min;
						$selected = '';
						if ($id_from_min == $id_WorktimeMin) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeMin.'"'.$selected.'>'.htmlspecialchars($value_WorktimeMin).'</option>';
					}
			 	}

			 	if ($field == 'min_to') {
			 		$typehtml = 'select';
			 		$addfield = '';

			 		$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			 		$check = DB::num_rows($resultWorktimeUser);
					if ($check > 0) {
						$objWorktimeUser = DB::fetch_object($resultWorktimeUser);
						$id_worktime = $objWorktimeUser->id_worktime;

						$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
						$objWorktime = DB::fetch_object($resultWorktime);
						$id_to_min = $objWorktime->id_to_min;
					} else {
						$sql = DB::query("INSERT INTO `new_worktime_user`(`id_project`, `id_worktime`) VALUES ('$id_project', '1')");
						$id_to_min = '1';
					}

					$innerselect = '';
			 		$resultWorktimeMin = DB::query("SELECT * FROM `new_worktime_min`");
					while ($objWorktimeMin = DB::fetch_object($resultWorktimeMin)) {
						$id_WorktimeMin = $objWorktimeMin->id;
						$value_WorktimeMin = $objWorktimeMin->min;
						$selected = '';
						if ($id_to_min == $id_WorktimeMin) {
							$selected = ' selected';
						}
						$innerselect .= '<option value="'.$id_WorktimeMin.'"'.$selected.'>'.htmlspecialchars($value_WorktimeMin).'</option>';
					}
			 	}

			 	if ($field == 'zagolovok1') {
			 		$id_project = '1';
			 		$resultPhrasesUsed = DB::query("SELECT * FROM `new_phrases_used` WHERE `id_project`='$id_project' LIMIT 1");
					$check = DB::num_rows($resultPhrasesUsed);
					if ($check > 0) {
						$objPhrasesUsed = DB::fetch_object($resultPhrasesUsed);
						$id_phrase = $objPhrasesUsed->id_phrase;

						$resultPhrasesZag = DB::query("SELECT * FROM `new_phrases_zag` WHERE `id_phrase`='$id_phrase' LIMIT 1");
						$check = DB::num_rows($resultPhrasesZag);
						if ($check > 0) {
							$objPhrasesZag = DB::fetch_object($resultPhrasesZag);
							$value = $objPhrasesZag->value;
						}
					}

					//ELSE ВЕРНИТЕСЬ ПОЗЖЕ???
			 	}

			 	/*if ($field == 'inn') {
			 		$script = '
			 		<script type="text/javascript">
			 			$("input[name=inn]").suggestions({
					        token: "'.$CONSTS['dadata_token'].'",
					        type: "ADDRESS",
					        count: 5,
					        
					        onSelect: function(suggestion) {
					            //console.log(suggestion);
					            var address = suggestion.data;
					            alert(address.postal_code);
					        }	        
					    });
					</script>';
			 	}*/
			 	$placeholder = $objInputs->placeholder;
			 	$textButton = $objForm->value_button;

				include ('../tmp/stepinput.php');
			} else {
				$zag = 'Конечная';
			 	$video = $CONSTS['video_laststep'];
			 	$video_volume = $CONSTS['video_volume'];
			 	$textButton = 'Перейти';
				include ('../tmp/stepinputend.php');
			}
		}

		if ($_POST['menu_link'] == 'acc'){
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$id_project_data = $_SESSION['market_'.$market]['id_project_data'];
			$id_project = $_SESSION['market_'.$market]['id_project'];

			include ('../tmp/login.php');
		}

		if ($_POST['menu_link'] == 'showkey'){
			$namepageshow = $_POST['menu_link'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
 			$zag = 'Ключевые запросы';
		 	$video = $CONSTS['video_showkey'];
		 	$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showrelkey.php');
		}

		if ($_POST['menu_link'] == 'showasskey'){
			$namepageshow = $_POST['menu_link'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showasskey'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showasskey.php');
		}

		if ($_POST['menu_link'] == 'showrelkey'){
			$namepageshow = $_POST['menu_link'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showasskey'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showrelkey.php');
		}

		if ($_POST['menu_link'] == 'showword'){
			$namepageshow = $_POST['menu_link'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showword'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showword.php');
		}

		if ($_POST['menu_link'] == 'addkey'){
			$zag = 'Дополнить семантическое ядро';
		 	$video = $CONSTS['video_addkey'];
		 	$video_volume = $CONSTS['video_volume'];
		 	$value = 'addkey';
		 	$placeholder = 'Купить iPhone';
		 	$textButton = 'Дополнить';
		 	$buttonid = "addkey";
		 	include('../tmp/markmenu.php');
 			include('../tmp/addkey.php');
		}

		if ($_POST['menu_link'] == 'matrix'){
			//$namepageshow = $_POST['menu_link'];
			//$idproject = $_SESSION['market_'.$market]['id_project'];
			$zag = 'Скоро';
		 	include('../tmp/markmenu.php');
 			include('../tmp/matrix.php');
		}

		if ($_POST['menu_link'] == 'delegirovanie'){
			$zag = 'Скоро';
			include '../tmp/delegirovanie.php';
		}

		if ($_POST['menu_link'] == 'otchet'){
			$zag = 'Скоро';
			include '../tmp/otchet.php';
		}

		if ($_POST['menu_link'] == 'card'){
			$zag = 'Скоро';
			$id_user = $_POST['id_card'];
			$id_project = $_POST['numproj'];
			include '../tmp/card.php';
		}

		if ($_POST['menu_link'] == '.voronkaview'){
			$id_project = $_SESSION['market_'.$market]['id_project'];
			//$namepagesite = $_POST['durl'];
			//$idproject = $_POST['proj'];
			//$nameprojsite = $_POST['market'];
			//echo "DURL $namepagesite D $idproject E $nameprojsite!!!";
			include('../tmp/voronka.php');
		}

		if ($_POST['menu_link'] == '.site_view'){
			$namepagesite = $_POST['pagename'];
			$id_project = $_POST['numproj'];
			//$idproject = $_SESSION['market_'.$market]['id_project'];
			$nameprojsite = $_POST['market'];
			//echo "DURL $namepagesite D $idproject D $nameprojsite!!!";
			//print_r($_POST);
			include('../tmp/page_crm.php');
		}

		if ($_POST['menu_link'] == 'sait'){
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$namepagesite = $_POST['pagename'];
			//$idproject = $_POST['numproj'];
			//$market = $_POST['market'];
			//echo "ID $idproject USER $id_user MARK $market PAGE $namepagesite PROJ";

			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['menu_link'] == 'pay'){
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$freeaccess = $_SESSION['market_'.$market]['freeaccess'];
			include ('../tmp/pay.php');
		}

	}
/////////////////////////////// Меню >
	
	if (isset($_POST['markmenu'])) {
		if ($_POST['markmenu'] == 'addkey') {
			$zag = 'Дополнить семантическое ядро';
		 	$video = $CONSTS['video_addkey'];
		 	$video_volume = $CONSTS['video_volume'];
		 	$value = 'addkey';
		 	$placeholder = 'Купить iPhone';
		 	$textButton = 'Дополнить';
		 	$buttonid = "addkey";
		 	include('../tmp/markmenu.php');
 			include('../tmp/addkey.php');
		}

		if ($_POST['markmenu'] == 'showkey') {
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
		 	$video = $CONSTS['video_showkey'];
		 	$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showrelkey.php');
		}

		if ($_POST['markmenu'] == 'showasskey'){
			$namepageshow = $_POST['markmenu'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showasskey'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showasskey.php');
		}

		if ($_POST['markmenu'] == 'showrelkey'){
			$namepageshow = $_POST['markmenu'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showasskey'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showrelkey.php');
		}

		if ($_POST['markmenu'] == 'showword'){
			$namepageshow = $_POST['markmenu'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$video = $CONSTS['video_showword'];
			$video_volume = $CONSTS['video_volume'];
		 	include('../tmp/markmenu.php');
		 	include('../tmp/legenda.php');
		 	include('../tmp/menukey.php');
 			include('../tmp/showword.php');
		}

		if ($_POST['markmenu'] == 'matrix') {
			$zag = 'Скоро';
		 	include('../tmp/markmenu.php');
 			include('../tmp/matrix.php');
		}
	}

/////////////////////////////// Автоматика

	if (isset($_POST['changeword'])) {
		$id_word = $_POST['id'];
		$word = $_POST['changeword'];
		$resultZayavki=DB::query("SELECT * FROM `new_words` WHERE `word`='$word' LIMIT 1");
		$check=DB::num_rows($resultZayavki);
		if ($check>0) {
			$row = DB::fetch_array($resultZayavki);
			$id_infinitive = $row['id'];
			$resultZayavki2=DB::query("SELECT * FROM `new_words_change` WHERE `id_word`='$id_word' LIMIT 1");
			$check=DB::num_rows($resultZayavki2);
			if ($check>0) {
				$row = DB::fetch_array($resultZayavki2);
				$usedWordUpdate=DB::query("UPDATE `new_words_change` SET `id_infinitive`='$id_infinitive' WHERE `id_word` = '$id_word'");
			} else {
				$addwhit = DB::query("INSERT IGNORE INTO `new_words_change`(`id_infinitive`, `id_word`) VALUES ('$id_infinitive', '$id_word')");
			}
		}
		echo "$id_infinitive $id_word";
	}

	/*if (isset($_POST['newobj'])) {
		if ($_POST['newobj'] == 'addpage') {

			$result = "Страница успешно добавлена";
		}

		if ($_POST['newobj'] == 'addsite') {
			$durl = $_POST['val'];
			$id_user = $_SESSION['market_'.$market]['id_user']; //user id может стоит брать по другому

			//Здесь проверку на уникальность имени

			$sql = "INSERT INTO `new_project`(`durl`) VALUES ('$durl')";
			$res=DB::query($sql);
			$idproj = DB::insert_id();
			$sql = "INSERT INTO `new_project_user`(`id_project`, `id_user`) VALUES ('$idproj', '$id_user')";
			$res=DB::query($sql);
			$sql = "INSERT INTO `new_project_data`(`id_project`) VALUES ('$idproj')";
			$res=DB::query($sql);

			chdir($_SERVER['DOCUMENT_ROOT']);
			$shablon = "shablon";
			my_copy_all($shablon,$durl);

			$result = "Сайт успешно добавлен";
		}
	}*/

	/*if (isset($_POST['closecard'])) {
		$id_project = $_SESSION['market_'.$market]['id_project'];
		$potreb = $_POST['potreb'];
		$id_client = $_POST['id_user'];
		$dataclient = $_POST['dataclient'];
		//$list=explode("\r\n",$_POST['potreb']); 
		$list = preg_replace('/\n/i','<br />',$potreb);
		print_r($id_client);

		$ProjectDataUpdate=DB::query("UPDATE `new_zayavki` SET `potreb`='$potreb', `dataclient`='$dataclient' WHERE `id_user`='$id_client' AND `id_project`='$id_project'");
		if ( ($potreb == '') || ($dataclient == '') ){
			echo "error";
		} else {
			echo "$potreb $dataclient";
		}
	}*/

	if (isset($_POST['tree'])) {
		$id_project = $_SESSION['market_'.$market]['id_project'];
		$region = $_POST['tree'];
		$minus = false;
		if ($region[0] <> '-') {
			$numbregion = substr($region, 7, strlen($region)-7);
		} else {
			$minus = true;
			$numbregion = substr($region, 8, strlen($region)-8);
		}
		//echo "$numbregion\r\n";
		$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
		$check=DB::num_rows($resultProj);
		if ($check > 0) {
			$objProj = DB::fetch_object($resultProj);

			$sqlregions = DB::query("SELECT * FROM `new_regions`");
			while ($region = DB::fetch_object($sqlregions)) {
				$parent_id = $region->id_parent;
				$region_id = $region->region_id;
				$type_id = $region->type_id;
				$name = $region->name;
				$regions[$parent_id]['type_id'][] = $type_id;
				$regions[$parent_id]['region_id'][] = $region_id;
				$regions[$parent_id]['name'][] = $name;
			}
			
			$numb_region_inner = $objProj->region;
			//echo "$numb_region_inner\r\n";

			if (strrpos($numb_region_inner, ',') > 0) {
				$region_once = explode(',', $numb_region_inner);
			} else {
				$region_once[0] = $numb_region_inner;
			}
			//print_r($region_once);

			if ($numb_region_inner <> '') {
				if (strrpos($numb_region_inner, ',') > 0) {
					$region_once = explode(',', $numb_region_inner);
				} else {
					$region_once[0] = $numb_region_inner;
				}

				if ($minus) {
					if (in_array($numbregion, $region_once)) {
						$numbregionmin = '';

						foreach ($region_once as $key => $region_id) {
							//echo "$region_id MINUSANULO\r\n"; //Здесь нужна ещё обработка на убирание -region`ов если выключили регион в котором убирали часть регионов
							if ($region_id === $numbregion) {
								unset($region_once[$key]);
							} else {
								if ( $numbregionmin == '') {
									$numbregionmin = $region_id;
								} else {
									$numbregionmin .= ','.$region_id;
								}
							}
						}
					} else {
						$numbregionmin = $numb_region_inner.',-'.$numbregion;
					}

					$usedWordUpdate=DB::query("UPDATE `new_project`  SET `region`='$numbregionmin' WHERE `id` = '$id_project'");
				} else {
					if (in_array('-'.$numbregion, $region_once)) {
						$numbregionmin = '';
						foreach ($region_once as $key => $region_id) {
							if ($value === '-'.$numbregion) {
								unset($region_once[$key]);
							} else {
								if ( $numbregionmin == '') {
									$numbregionmin = $region_id;
								} else {
									$numbregionmin .= ','.$region_id;
								}
							}
						}
					} else {
						$numbregionadd = $numb_region_inner.','.$numbregion;
					}

					$usedWordUpdate=DB::query("UPDATE `new_project`  SET `region`='$numbregionadd' WHERE `id` = '$id_project'");
				}
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `region`='$numbregion' WHERE `id` = '$id_project'");
			}
		} else {
			echo "Нет созданного проекта";
		}
	}

	if (isset($_POST['unlock'])) { //Обрабортка открытия заявок
		//Меняем статус и возвращаем //Открытые в заявках не отображаем //Открытую пользователем отображаем только ее //Добавить момент открытия и момент закрытия = время обработки заявки
		//Добавить цена открытия - экономику придумать рассчитать
		//В БД не только статус открытия, но и кем открыт можно 0 или больше нуля по id
		$id_user = $_SESSION['market_'.$market]['id_user'];
		$id_project = $_SESSION['market_'.$market]['id_project'];
		$id_zayavki = $_POST['id_zayavki'];
		$zag = 'Входящие заявки';
		$video = $CONSTS['video_zayavki'];
		$video_volume = $CONSTS['video_volume'];

		if ($_POST['unlock'] == 'close') {
			
			$comment = $_POST['comment']; //Тут можно добавить проверку на то что Комментарий вообще изменился
			$select_status = $_POST['select_status']; //А тут на то что статус тоже изменен // Ну и соответственно ошибку обрабатывать в JS если вернул к примеру "Текст ошибки"
			$resZayavkiUpdate=DB::query("UPDATE `new_zayavki` SET `open`='0', `vremaddition`='$comment', `status`='$select_status', `lastcontact`=NOW() WHERE `id` = '$id_zayavki'");
			include ('../tmp/zayavki.php');
		}

		if ($_POST['unlock'] == 'lock') {
			$potreb = $_POST['potreb'];
			$dataclient = $_POST['dataclient'];
			$resZayavkiUpdate=DB::query("UPDATE `new_zayavki` SET `potreb`='$potreb', `dataclient`='$dataclient' WHERE `id` = '$id_zayavki'");

			$unlock = 2;
			include ('../tmp/zayavki.php');
		}

		if ($_POST['unlock'] == 'unlock') {
			//Оплата за взятие заявки //Ну это в делегировании
			$resZayavkiUpdate=DB::query("UPDATE `new_zayavki` SET `open`='$id_user' WHERE `id` = '$id_zayavki'");
			$unlock = 1;
			include ('../tmp/zayavki.php');
		}		
	}	

	if (isset($_POST['openwindow'])) { //Шаблонизировать всплывающее окно 
		$field = $_POST['openwindow'];

		if (isset($_POST['val'])) {
			$val = $_POST['val'];
			$vals = json_decode($val, true);
			if (isset($vals[$field])) {
				$val = $vals[$field];
			}
		}

		$cooki = $_POST['cooki'];
		$cookis = json_decode($cooki, true);
		if (isset($cookis['pagename'])) {
			$pagename = $cookis['pagename'];
		} elseif (isset($_SESSION['market_'.$market]['pagename'])) {
			$pagename = $_SESSION['market_'.$market]['pagename'];
		} else {
			$pagename = 'index';
		}

		if (isset($cookis['id_project'])) {
			$id_project = $cookis['id_project'];
		} else {
			$id_project = $_SESSION['market_'.$market]['id_project'];
		}

		if (isset($cookis['id_user'])) {
			$id_user = $cookis['id_user'];
		} else {
			$id_user = $_SESSION['market_'.$market]['id_user'];
		}

		$ProjectDataSelect=DB::query("SELECT * FROM `new_project_data`  WHERE `id_project` = '$id_project' AND `page`='$pagename'");
		$objProjectDataSelect = DB::fetch_object($ProjectDataSelect);
		$id_project_data = $objProjectDataSelect->id;

		$classbutton = "senddata";
		$button_field = true;
		$buttonname = '';
		$buttonactionname = 'Изменить';
		$value = '';
		$hidden = '';
		$formstart = '';
		$formend = '';
		$script = '';
		$phonefield = '';
		$part_zagolovok = '';
		$promo = "<div class = \"promo z10\">";
		$formfieldstart = '<div class="overflow menuheight z10 data">';
		$formfieldend = '</div>';
		$zagolovok = $buttonactionname.' ';
		$zagolovok_field = true;
		
		
		$hiddenpost = $_POST['hidden'];
		$hiddens = json_decode($hiddenpost, true);
		if (isset($hiddens['id_form'])) {
			$id_form = $hiddens['id_form'];
		}
		if (isset($hiddens['id_plate'])) {
			$id_plate = $hiddens['id_plate'];
		}
		if (isset($hiddens['id_phrase'])) {
			$id_phrase = $hiddens['id_phrase'];
		}
		if (isset($hiddens['id_zag'])) {
			$id_zag = $hiddens['id_zag'];
		}
		if (isset($hiddens['value'])) {
			$field = $hiddens['value'];
		}
		if (isset($hiddens['id_zayavki'])) {
			$id_zayavki = $hiddens['id_zayavki'];
		}
		if (isset($hiddens['id_user'])) {
			$id_user = $hiddens['id_user'];
			$hidden = '<div class="hidden id_user">'.$id_user.'</div>';
		}
		if (isset($hiddens['id_ads'])) {
			$id_ads = $hiddens['id_ads'];
		}
		$buttonid = $field;

		/*$script = "<script>
		$(function() {
			var focus2 = document.getElementById('iname').focus();
			$('#iname').focus();
		});
		</script>";*/

		if ($field == 'zagolovok1') {
			$part_zagolovok = 'текст заголовка объявления'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
			while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$zagGet = DB::query("SELECT * FROM `new_ads_zag` WHERE `id`='$id_zag'");
				$objZag = DB::fetch_object($zagGet);
				$value = $objZag->zag;
				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="'.$field.'" class="dib promo_textarea" name="linkplate" placeholder="Введите '.$part_zagolovok.'">'.$value.'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'zagolovok2') {
			$part_zagolovok = 'текст второго заголовка объявления'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
			while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$zag2Get = DB::query("SELECT * FROM `new_ads_zag2` WHERE `id`='$id_zag'");
				$objZag2 = DB::fetch_object($zag2Get);
				$value = $objZag2->zag;
				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="'.$field.'" class="dib promo_textarea" name="linkplate" placeholder="Введите '.$part_zagolovok.'">'.$value.'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'fastlink') {
			$part_zagolovok = 'текст быстрой ссылки'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			$id_fastlink = $hiddens['id_fastlink'];
			$n_fastlink = $hiddens['n_fastlink'];
			$gr_fastlink = $hiddens['gr_fastlink'];
			
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
			while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$fastlinkGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fastlink'");
				$objFastlink = DB::fetch_object($fastlinkGet);
				$value = $objFastlink->fastlink;
				$href = $objFastlink->href;
				$desc = $objFastlink->desc;
				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden n_fastlink">'.$n_fastlink.'</div><div class="hidden gr_fastlink">'.$gr_fastlink.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="textfastlink" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.$value.'</textarea>'.$hidden;
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="hreffastlink" class="dib promo_textarea" placeholder="Введите ссылку по которой будет переход">'.$href.'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="descfastlink" class="dib promo_textarea" placeholder="Введите описание ссылки">'.$desc.'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '<input id ="add_newads" class="dib promo_checkbox vat mr6" placeholder="Добавить как новое объявление" type="checkbox"><label class="vat dib ml6" for="add_newads">Добавить как новое объявление</label>';
			$promo_field .= '</div>';
		}

		if ($field == 'desc') {
			$part_zagolovok = 'дополнительное описание ссылки'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
			while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_zag`='$id_zag' AND `id_phrase`='$id_phrase'");
				$objAds = DB::fetch_object($adsGet);
				$value = $objAds->url_desc;
				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_ads">'.$id_ads.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="'.$field.'" class="dib promo_textarea" name="linkplate" placeholder="Введите '.$part_zagolovok.'">'.$value.'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'textads') {
			$part_zagolovok = 'текст объявления'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
			while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$id_short = $hiddens['id_short'];
				/*$shortUserGet = DB::query("SELECT * FROM `new_ads_short_user` WHERE `id`='$id_short'");
				$objUserShort = DB::fetch_object($shortUserGet);
				$id_short_value = $objUserShort->id_short;
				$shortGet = DB::query("SELECT * FROM `new_ads_short` WHERE `id`='$id_short_value'");*/
				$shortGet = DB::query("SELECT * FROM `new_ads_short` WHERE `id`='$id_short'");
				$objShort = DB::fetch_object($shortGet);
				$short = $objShort->short;

				$id_cta = $hiddens['id_cta'];
				/*$ctaUserGet = DB::query("SELECT * FROM `new_ads_cta_user` WHERE `id`='$id_cta'");
				$objUserCta = DB::fetch_object($ctaUserGet);
				$id_cta_value = $objUserCta->id_cta;
				$ctaGet = DB::query("SELECT * FROM `new_ads_cta` WHERE `id`='$id_cta_value'");*/
				$ctaGet = DB::query("SELECT * FROM `new_ads_cta` WHERE `id`='$id_cta'");
				$objCta = DB::fetch_object($ctaGet);
				$cta = $objCta->value;

				$id_deadline = $hiddens['id_deadline'];
				/*$deadlineUserGet = DB::query("SELECT * FROM `new_ads_deadline_user` WHERE `id`='$id_deadline'");
				$objUserDeadline = DB::fetch_object($deadlineUserGet);
				$id_deadline_value = $objUserDeadline->id_deadline;
				$deadlineGet = DB::query("SELECT * FROM `new_ads_deadline` WHERE `id`='$id_deadline_value'");*/
				$deadlineGet = DB::query("SELECT * FROM `new_ads_deadline` WHERE `id`='$id_deadline'");
				$objDeadline = DB::fetch_object($deadlineGet);
				$deadline = $objDeadline->value;

				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="short" class="dib promo_textarea" name="linkplate" placeholder="Введите короткий '.$part_zagolovok.'">'.$short.'</textarea>'.$hidden;
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="deadline" class="dib promo_textarea" name="linkplate" placeholder="Введите деадлайн">'.$deadline.'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="cta" class="dib promo_textarea" name="linkplate" placeholder="Введите призыв к действию">'.$cta.'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'descs') {
			$part_zagolovok = 'дополнительное описание'; 
			if ($cookis['page'] == 'showkey') {
				$promo = '';
				$classbutton = "senddatac";
			}
			$id_desc = $hiddens['id_desc'];
			/*$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_ads`='$id_ads'");
			//while ($objAds = DB::fetch_object($adsGet)) { //Типа несколько объявлений на 1 ключевик // пока одно
				$id_zag = $objAds->id_zag;*/
				$adsDescsGet = DB::query("SELECT * FROM `new_ads_descs` WHERE `id`='$id_desc'");
				$objAdsDescs = DB::fetch_object($adsDescsGet);
				$value = $objAdsDescs->desc;
				$hidden = '<div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_desc">'.$id_desc.'</div>';
			//}
			$promo_field = '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="'.$field.'" class="dib promo_textarea" name="linkplate" placeholder="Введите '.$part_zagolovok.'">'.$value.'</textarea>'.$hidden;
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '<input id ="add_newads" class="dib promo_checkbox vat mr6" placeholder="Добавить как новое объявление" type="checkbox"><label class="vat dib ml6" for="add_newads">Добавить как новое объявление</label>';
			$promo_field .= '</div>';
		}

		if ($field == 'addplate') {
			$classbutton = "";
			$part_zagolovok = 'плитку';
			$buttonactionname = 'Добавить';
			$buttonname = ' name="addplate" ';
			$formstart = '<form enctype="multipart/form-data" method="post" action="../tmpl/upload.php" ><input type="hidden" name="MAX_FILE_SIZE" value="10485760" />';
			$formsend = 'type="submit"';
			$formend = '</form>';

				$promo_field = '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '	<textarea id ="iLinkPlate" class="dib promo_textarea" name="linkplate" placeholder="Ссылка на страницу">index.php</textarea>';
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '	<textarea id ="iValPlate" class="dib promo_textarea" name="valplate" placeholder="Текст кнопки">Текст кнопки</textarea>';
				$promo_field .= '</div>';
				$promo_field .= '<div id="fototoload"></div>
							<div class = "menu_link lh32 tac">';
				$promo_field .= '	<input id ="ifile" type="file" class="nospace dib promo_input" name="imageplateadd">';
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= "	<div class=\"dragfile z1\"><div class=\"vac\">Кинь фотку сюда</div></div>";
				$promo_field .= '</div>';

				$script = "
		
				<script>
					$('.dragfile').on('dragover', function(){
						$(this).addClass('dragfileover');
						return false;
					});

					$('.dragfile').on('dragleave', function(){
						$(this).removeClass('dragfileover');
						return false;
					});

					$('.dragfile').on('drop', function(e){
						e.preventDefault();

						$(this).removeClass('dragfileover');
						var formdata = new FormData();
						var multiple = e.originalEvent.dataTransfer.files;
						for (var i=0;i<multiple.length; i++) {
							formdata.append('file[]', multiple[i]);
						}
						formdata.append('type[]', 'plateadd');
						formdata.append('type[]', '$id_project_data');
						formdata.append('type[]', $('#iValPlate').val());
						formdata.append('type[]', $('#iLinkPlate').val());
							$.ajax({
								url: '../tmpl/upload.php',
								method:'post',
								data: formdata,
								contentType: false,
								cache: false,
								processData: false,
								success:function(loader){
									$('#windowToForm').addClass('hidden');
									$('#wrapper').html(loader);
								}
							});
					});
				</script>";
		}

		if ($field == 'additionlink') {
			$part_zagolovok = 'дополнительную ссылку';

			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$addition = $objProjData->addition;
			$link_addition = $objProjData->link_addition;

			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="addition" class="dib promo_textarea" placeholder="Текст дополнительной ссылки">'.htmlspecialchars($addition).'</textarea>';
			$promo_field .= '</div>';
			$promo_field .= '<div class = "menu_link lh32 pr tac">';
			$promo_field .= '	<textarea id ="link_addition" class="dib promo_textarea" placeholder="Ссылка">'.htmlspecialchars($link_addition).'</textarea>';
			$promo_field .= '</div>'; //Внутренняя Списком, или внешняя в поле
		}

		if ($field == 'plates') {
			$part_zagolovok = 'плитку';
			$classbutton = "";
			$resProjData=DB::query("SELECT * FROM `new_plates` WHERE `id`='$id_plate'");
			$objProjData = DB::fetch_object($resProjData);
			$plates_value = $objProjData->value;
			$plates_link = $objProjData->link;
			$plates_img = $objProjData->img;

			$formstart = '<form enctype="multipart/form-data" method="post" action="../tmpl/upload.php" ><input type="hidden" name="MAX_FILE_SIZE" value="10485760" />';
			$formsend = 'type="submit"';
			$formend = '</form>';


				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '	<textarea id ="iLinkPlate" class="dib promo_textarea" name="linkplate">'.htmlspecialchars($plates_link).'</textarea>';
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '	<textarea id ="iValPlate" class="dib promo_textarea" name="valplate">'.htmlspecialchars($plates_value).'</textarea>';
				$promo_field .= '</div>';
				$promo_field .= '		<input class="hidden" name="idplate" value="'.htmlspecialchars($id_plate).'">';
				$promo_field .= '<div id="fototoload"></div>
							<div class = "menu_link lh32">';
				$promo_field .= '	<input id ="ifile" type="file" class="nospace dib promo_input tac" name="imageplate">';
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= "	<div class=\"dragfile z1\"><div class=\"vac\">Кинь фотку сюда</div></div>";
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link pr tac"><button class="promo_knopka pointer white biRed db lh50 border3rad tac" id="delplate"><div class="hidden id_plate">'.htmlspecialchars($id_plate).'</div>Удалить</button></div>';
				$script = "
		
				<script>
					$('.dragfile').on('dragover', function(){
						$(this).addClass('dragfileover');
						return false;
					});

					$('.dragfile').on('dragleave', function(){
						$(this).removeClass('dragfileover');
						return false;
					});

					$('.dragfile').on('drop', function(e){
						e.preventDefault();

						$(this).removeClass('dragfileover');
						var formdata = new FormData();
						var multiple = e.originalEvent.dataTransfer.files;
						for (var i=0;i<multiple.length; i++) {
							formdata.append('file[]', multiple[i]);
						}
						formdata.append('type[]', 'plate');
						formdata.append('type[]', '$id_plate');
						formdata.append('type[]', $('#iValPlate').val());
						formdata.append('type[]', $('#iLinkPlate').val());
							$.ajax({
								url: '../tmpl/upload.php',
								method:'post',
								data: formdata,
								contentType: false,
								cache: false,
								processData: false,
								success:function(loader){
									$('#windowToForm').addClass('hidden');
									$('#wrapper').html(loader);
								}
							});
					});
				</script>";
		}

		if ($field == 'logo') {
			$part_zagolovok = 'логотип';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$link_logo = $objProjData->link_logo;
			$value = $link_logo;
			$classbutton = '';

			$formstart = '<form enctype="multipart/form-data" method="post" action="../tmpl/upload.php" ><input type="hidden" name="MAX_FILE_SIZE" value="10485760" />';
			$formsend = 'type="submit"';
			$formend = '</form>';


				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea">'.htmlspecialchars($value).'</textarea>';
				$promo_field .= '</div>';
				
				$promo_field .= '<div id="fototoload"></div>
							<div class = "menu_link lh32 tac">';
				$promo_field .= '	<input id ="ifile" type="file" class="nospace dib promo_input" name="imagelogo">';
				$promo_field .= '</div>';
				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= "	<div class=\"dragfile z1\"><div class=\"vac\">Кинь фотку сюда</div></div>";
				$promo_field .= '</div>';

				$promo_field .= '<div class = "menu_link lh32 pr tac">';
				$promo_field .= '<input id ="changeall" name="changeall" class="dib promo_checkbox vat mr6" placeholder="Изменить у всех" type="checkbox"><label class="vat dib ml6" for="changeall">Изменить у всех</label>';
				$promo_field .= '</div>';

				$script = "
		
				<script>
					$('.dragfile').on('dragover', function(){
						$(this).addClass('dragfileover');
						return false;
					});

					$('.dragfile').on('dragleave', function(){
						$(this).removeClass('dragfileover');
						return false;
					});

					$('.dragfile').on('drop', function(e){
						e.preventDefault();

						$(this).removeClass('dragfileover');
						var formdata = new FormData();
						var multiple = e.originalEvent.dataTransfer.files;
						for (var i=0;i<multiple.length; i++) {
							formdata.append('file[]', multiple[i]);
						}
						formdata.append('type[]', 'logo');
						if ($('#changeall').is(':checked')){
							formdata.append('type[]', '1');
						} else {
						    formdata.append('type[]', '0');
						}
							$.ajax({
								url: '../tmpl/upload.php',
								method:'post',
								data: formdata,
								contentType: false,
								cache: false,
								processData: false,
								success:function(loader){
									$('#windowToForm').addClass('hidden');
									$('#wrapper').html(loader);
								}
							});
					});
				</script>";
		}
		
		if ($field == 'addpage') {
			$buttonactionname = 'Добавить';
			$part_zagolovok = 'новую страницу';

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите название страницы (EN)">'.htmlspecialchars($val).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'addsite') {
			$buttonactionname = 'Добавить';
			$part_zagolovok = 'новый проект/сайт';
			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите название сайта (EN)">'.htmlspecialchars($val).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'calendar') {
			$part_zagolovok = 'дату следующего действия';

			$promo_field = '	<div class = "menu_link lh32">';
			$promo_field .= '		<input type="text" class="promo_input fs15 dib tac round pointer" id="date" name="date" placeholder="Дата" onClick="showdate(this)" onchange="changedate(this)">';
			$promo_field .= '		<div class="hidden valcalendar" id="valcalendar"></div>';
			$promo_field .= '		<div class="hidden id_zayavki">'.$id_zayavki.'</div>';
			$promo_field .= '	</div>';

			/*$script = '
				<script>
					$(function(){
						$("#date").on("change", function () {
						    var myDate = new Date($(this).val());
						    console.log(myDate, myDate.getTime());
						    $("#valcalendar").text(myDate.getTime());
						});

						$("#date").daterangepicker({
							singleDatePicker: true,
							timePicker: true,
							timePickerIncrement: 30,
							timePicker24Hour: true,
							showDropdowns: true,
							autoApply: true,
							locale: {
								format: "MM.DD.YYYY hh:mm",
						        separator: " - ",
						        applyLabel: "Применить",
						        cancelLabel: "Отмена",
						        fromLabel: "От",
						        toLabel: "До",
						        customRangeLabel: "Свой",
						        daysOfWeek: [
						            "Вс",
						            "Пн",
						            "Вт",
						            "Ср",
						            "Чт",
						            "Пт",
						            "Сб"
						        ],
						        monthNames: [
						            "Январь",
						            "Февраль",
						            "Март",
						            "Апрель",
						            "Май",
						            "Июнь",
						            "Июль",
						            "Август",
						            "Сентябрь",
						            "Октябрь",
						            "Ноябрь",
						            "Декабрь"
						        ],
						        firstDay: 1
							}
						});
					});
				</script>
			';*/
		}

		if ($field == 'avatar') {
			$classbutton = "";
			$part_zagolovok = 'аватарку';
			$formstart .= '<form enctype="multipart/form-data" method="post" action="../tmpl/upload.php" >';
			$formsend = 'type="submit"';
			$formend = '</form>';

			$promo_field =	'<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />';
			$promo_field .= '<div id="fototoload"></div>
							<div class = "menu_link lh32">';
			$promo_field .= '	<input id ="iname" type="file" class="nospace dib promo_input" name="image">';
			$promo_field .= '</div>';
			$promo_field .= '<div class = "menu_link lh32 pr">';
			$promo_field .= '	<div class="lh32"><div class="vac tac">ИЛИ</div></div>';
			$promo_field .= '</div>';
			$promo_field .= '<div class = "menu_link lh32 pr">';
			$promo_field .= '	<div class="dragfile z1"><div class="vac tac">Кинь фотку сюда</div></div>';
			$promo_field .= '</div>';
			$script = "
		
			<script>
			$('.dragfile').on('dragover', function(){
				$(this).addClass('dragfileover');
				return false;
			});

			$('.dragfile').on('dragleave', function(){
				$(this).removeClass('dragfileover');
				return false;
			});

			$('.dragfile').on('drop', function(e){
				e.preventDefault();

				$(this).removeClass('dragfileover');
				var formdata = new FormData();
				var multiple = e.originalEvent.dataTransfer.files;
				for (var i=0;i<multiple.length; i++) {
					formdata.append('file[]', multiple[i]);
				}
				formdata.append('type[]', 'avatar');
				formdata.append('type[]', '$id_user');
				formdata.append('type[]', '$id_project');
					$.ajax({
						url: '../tmpl/upload.php',
						method:'post',
						data: formdata,
						contentType: false,
						cache: false,
						processData: false,
						success:function(loader){
							$('#wrapper').html(loader);
							$('#windowToForm').addClass('hidden');
						}
					});
			});</script>";
		}

		if ($field == 'worktime') {
			$part_zagolovok = 'режим работы';
			$resultUserWorktime = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			$check = DB::num_rows($resultUserWorktime);
			if ($check > 0) {
				$objWorktime = DB::fetch_object($resultUserWorktime);
				$id_worktime = $objWorktime->id_worktime;

				$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id`='$id_worktime'");
				$objWorktime = DB::fetch_object($resultWorktime);
				$idWorktimeDays_s = $objWorktime->id_from_day;
				$idWorktimeDays_po = $objWorktime->id_to_day;
				$idWorktimeHours_s = $objWorktime->id_from_hour;
				$idWorktimeHours_po = $objWorktime->id_to_hour;
				$idWorktimeMin_s = $objWorktime->id_from_min;
				$idWorktimeMin_po = $objWorktime->id_to_min;

				$resultWorktimeDays_s = DB::query("SELECT * FROM `new_worktime_days` WHERE `id`='$idWorktimeDays_s'");
				$objWorktimeDays_s = DB::fetch_object($resultWorktimeDays_s);
				$valWorktimeDays_s = $objWorktimeDays_s->value_long;

				$resultWorktimeDays_po = DB::query("SELECT * FROM `new_worktime_days` WHERE `id`='$idWorktimeDays_po'");
				$objWorktimeDays_po = DB::fetch_object($resultWorktimeDays_po);
				$valWorktimeDays_po = $objWorktimeDays_po->value_long;

				$resultWorktimeHours_s = DB::query("SELECT * FROM `new_worktime_hours` WHERE `id`='$idWorktimeHours_s'");
				$objWorktimeHours_s = DB::fetch_object($resultWorktimeHours_s);
				$valWorktimeHours_s = $objWorktimeHours_s->hour;

				$resultWorktimeHours_po = DB::query("SELECT * FROM `new_worktime_hours` WHERE `id`='$idWorktimeHours_po'");
				$objWorktimeHours_po = DB::fetch_object($resultWorktimeHours_po);
				$valWorktimeHours_po = $objWorktimeHours_po->hour;

				$resultWorktimeMin_s = DB::query("SELECT * FROM `new_worktime_min` WHERE `id`='$idWorktimeMin_s'");
				$objWorktimeMin_s = DB::fetch_object($resultWorktimeMin_s);
				$valWorktimeMin_s = $objWorktimeMin_s->min;

				$resultWorktimeMin_po = DB::query("SELECT * FROM `new_worktime_min` WHERE `id`='$idWorktimeMin_po'");
				$objWorktimeMin_po = DB::fetch_object($resultWorktimeMin_po);
				$valWorktimeMin_po = $objWorktimeMin_po->min;
			} else {
				$valWorktimeDays_s = 'Понедельник';
				$valWorktimeDays_po = 'Пятница';
				$valWorktimeHours_s = '09';
				$valWorktimeHours_po = '19';
				$valWorktimeMin_s = '00';
				$valWorktimeMin_po = '00';
			}

			$resultWorktimeDays = DB::query("SELECT * FROM `new_worktime_days`");
			$statuss_s = '<select id="worktime_s" class="promo_select tac pointer">';
			$statuss_po = '<select id="worktime_po" class="promo_select tac pointer">';
			while ($objWorktimeDays = DB::fetch_object($resultWorktimeDays)) {
				$id_WorktimeDays = $objWorktimeDays->id;
				$value_WorktimeDays = $objWorktimeDays->value_long;
				$selected_s = '';
				$selected_po = '';
				if (strcasecmp($value_WorktimeDays, $valWorktimeDays_s) == 0) {
					$selected_s = ' selected';
				}
				if (strcasecmp($value_WorktimeDays, $valWorktimeDays_po) == 0) {
					$selected_po = ' selected';
				}
				$statuss_s .= '<option value="'.$id_WorktimeDays.'"'.$selected_s.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
				$statuss_po .= '<option value="'.$id_WorktimeDays.'"'.$selected_po.'>'.htmlspecialchars($value_WorktimeDays).'</option>';
			}
			$statuss_s .= '</select>';
			$statuss_po .= '</select>';

			$promo_field = '<div class = "tac pr">';
			$promo_field .= '<div class = "menu_link lh32 ">';
			$promo_field .= '	<div class="dib prefield pa z10">C</div>
								<div class="dib postfield pa">
									<input id ="time_s" name="time" class="tac nospace dib promo_input" value="'.htmlspecialchars($valWorktimeHours_s).':'.htmlspecialchars($valWorktimeMin_s).'">';
			$promo_field .= '	</div>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 ">';
			$promo_field .= '<div class="dib prefield pa z10">До</div><div class="dib postfield pa">	<input id ="time_do" name ="time" class="tac nospace dib promo_input"  value="'.htmlspecialchars($valWorktimeHours_po).':'.htmlspecialchars($valWorktimeMin_po).'">';
			$promo_field .= '	</div>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 day_s">';
			$promo_field .= '<div class="dib prefield pa z10">С</div><div class="dib postfield pa">'.$statuss_s;
			$promo_field .= '	</div>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 day_po">';
			$promo_field .= '<div class="dib prefield pa z10">По</div><div class="dib postfield pa">'.$statuss_po;
			$promo_field .= '	</div>';
			$promo_field .= '</div>';
			$promo_field .= '</div>';
		}

		if ($field == 'card') {
			$button_field = false;
			$zagolovok = 'Карточка клиента';
			$zagolovok_field = false;
			include ("../tmp/card.php");
		}

		if ($field == 'economic') {
			$zagolovok_field = false;
			$resultProject = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$objProject = DB::fetch_object($resultProject);
			$srcheck = $objProject->srcheck; 
			$marja = $objProject->marja;
			$rekbut = $objProject->rekbut;
			$con1 = $objProject->con1;
			$con2 = $objProject->con2;
			$costclick = $objProject->costclick;

			$zag = $CONSTS['zag_economic'];
			$video = $CONSTS['video_economic'];
			$video_volume = $CONSTS['video_volume'];

		$promo_field .= '
						<div class = "videoZag">
							<div class="obolochka">
								<div class="centredv lh26">'.$zag.'</div>
							</div>
						</div>';
			$promo_field .= '<div class="video tac">
								<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
						</div>';
			$promo_field .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
			$promo_field .= '
						<div class = "promoIn tac fs15 pr">';

			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">Средний чек</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/srcheck_115.png" alt="Средний чек" title="Средний чек"></div>';
			$promo_field .= 	'<input id ="srcheck" min="0" class="vat tac nospace dib promo_input lh32" type="number" value="'.htmlspecialchars($srcheck).'" required>';
			$promo_field .= '</div>';

			$help = 'Чистая прибыль';
			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">'.$help.'</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/marzha_115.png" alt="'.$help.'" title="'.$help.'"></div>';
			$promo_field .= 	'<input id ="marja" min="0" max="1" step="0.01" class="vat tac nospace dib promo_input lh32" type="number" value="'.htmlspecialchars($marja).'" required>';
			$promo_field .= '</div>';

			$help = 'Процент чистой прибыли в рекламный бюджет';
			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">'.$help.'</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/prmarzhi_115.png" alt="'.$help.'" title="'.$help.'"></div>';
			$promo_field .= 	'<input id ="rekbut" min="0" max="1" step="0.01" class="vat tac nospace dib promo_input lh32" type="number" value="'.htmlspecialchars($rekbut).'" required>';
			$promo_field .= '</div>';

			$help = 'Конверсия сайта';
			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">'.$help.'</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/k1_115.png" alt="'.$help.'" title="'.$help.'"></div>';
			$promo_field .= 	'<input id ="con1" min="0" max="1" step="0.01" class="vat tac nospace dib promo_input lh32" type="number" value="'.htmlspecialchars($con1).'" required>';
			$promo_field .= '</div>';

			$help = 'Конверсия отдела продаж';
			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">'.$help.'</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/k2_115.png" alt="'.$help.'" title="'.$help.'"></div>';
			$promo_field .= 	'<input id ="con2" min="0" max="1" step="0.01" class="vat tac nospace dib promo_input lh32" type="number" value="'.htmlspecialchars($con2).'" required>';
			$promo_field .= '</div>';

			$help = 'Цена за клик';
			$promo_field .= '<div class = "menu_link bb">';
			$promo_field .= 	'<div class = "lh32">'.$help.'</div>';
			$promo_field .= 	'<div class="prefield pa"><img class="dib w22"  src="../img/stavka_115.png" alt="'.$help.'" title="'.$help.'"></div>';
			$promo_field .= 	'<div class="vat tac nospace dib promo_input lh32 costclick">'.htmlspecialchars($costclick).'</div>';
			$promo_field .= '</div>';
			$promo_field .= '</div>';
			$script = '
			<script>
				$("#srcheck").on("input", function() { 
					var costclick;
					//console.log(document.getElementById("srcheck").value);
					if ( (document.getElementById("srcheck").value != "") 
						|| (document.getElementById("marja").value != "")
						|| (document.getElementById("rekbut").value != "")
						|| (document.getElementById("con1").value != "")
						|| (document.getElementById("con2").value != "") ) {
						costclick = document.getElementById("srcheck").value * 
									document.getElementById("marja").value *
									document.getElementById("rekbut").value *
									document.getElementById("con1").value *
									document.getElementById("con2").value ;
						costclick = costclick.toFixed(2);
						$(".costclick").text(costclick);
					}
				});
				$("#marja").on("input", function() { 
					var costclick;
					//console.log(document.getElementById("srcheck").value);
					if ( (document.getElementById("srcheck").value != "") 
						|| (document.getElementById("marja").value != "")
						|| (document.getElementById("rekbut").value != "")
						|| (document.getElementById("con1").value != "")
						|| (document.getElementById("con2").value != "") ) {
						costclick = document.getElementById("srcheck").value * 
									document.getElementById("marja").value *
									document.getElementById("rekbut").value *
									document.getElementById("con1").value *
									document.getElementById("con2").value ;
						costclick = costclick.toFixed(2);
						$(".costclick").text(costclick);
					}
				});
				$("#rekbut").on("input", function() { 
					var costclick;
					//console.log(document.getElementById("srcheck").value);
					if ( (document.getElementById("srcheck").value != "") 
						|| (document.getElementById("marja").value != "")
						|| (document.getElementById("rekbut").value != "")
						|| (document.getElementById("con1").value != "")
						|| (document.getElementById("con2").value != "") ) {
						costclick = document.getElementById("srcheck").value * 
									document.getElementById("marja").value *
									document.getElementById("rekbut").value *
									document.getElementById("con1").value *
									document.getElementById("con2").value ;
						costclick = costclick.toFixed(2);
						$(".costclick").text(costclick);
					}
				});
				$("#con1").on("input", function() { 
					var costclick;
					//console.log(document.getElementById("srcheck").value);
					if ( (document.getElementById("srcheck").value != "") 
						|| (document.getElementById("marja").value != "")
						|| (document.getElementById("rekbut").value != "")
						|| (document.getElementById("con1").value != "")
						|| (document.getElementById("con2").value != "") ) {
						costclick = document.getElementById("srcheck").value * 
									document.getElementById("marja").value *
									document.getElementById("rekbut").value *
									document.getElementById("con1").value *
									document.getElementById("con2").value ;
						costclick = costclick.toFixed(2);
						$(".costclick").text(costclick);
					}
				});
				$("#con2").on("input", function() { 
					var costclick;
					//console.log(document.getElementById("srcheck").value);
					if ( (document.getElementById("srcheck").value != "") 
						|| (document.getElementById("marja").value != "")
						|| (document.getElementById("rekbut").value != "")
						|| (document.getElementById("con1").value != "")
						|| (document.getElementById("con2").value != "") ) {
						costclick = document.getElementById("srcheck").value * 
									document.getElementById("marja").value *
									document.getElementById("rekbut").value *
									document.getElementById("con1").value *
									document.getElementById("con2").value ;
						costclick = costclick.toFixed(2);
						$(".costclick").text(costclick);
					}
				});
			</script>';
		}	

		if ($field == 'id_desc') {
			$part_zagolovok = 'дескриптор';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$id_desc = $objProjData->id_desc;

			$resdescs=DB::query("SELECT * FROM `new_descs` WHERE `id`='$id_desc' ");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$value = $objDescs['value'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'id_phone') {
			$part_zagolovok = 'телефон';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$id_phone = $objProjData->id_phone;

			$phonefield = ' name="phone"';
			$resdescs=DB::query("SELECT * FROM `new_phones` WHERE `id`='$id_phone' ");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$id_phone_country = $objDescs['id_country'];
				$id_phone_city = $objDescs['id_city'];
				$val_phone_numb = $objDescs['numb'];

				$resdescs=DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$id_phone_country' ");
				$objDescs =	DB::fetch_array($resdescs);
				$val_phone_country = $objDescs['value'];

				$resdescs=DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$id_phone_city'");
				$objDescs =	DB::fetch_array($resdescs);
				$val_phone_city = $objDescs['value'];

				$value = $val_phone_country.$val_phone_city.$val_phone_numb;
			}
			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '<input id="'.htmlspecialchars($field).'" type="phone" name="phone" class="dib promo_input" placeholder="Введите телефон" value="'.htmlspecialchars($value).'">';
			$promo_field .= '</div>';
		}

		if ($field == 'id_offer') {
			$part_zagolovok = 'оффер';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$id_offer = $objProjData->id_offer;

			$resdescs=DB::query("SELECT * FROM `new_offers_main` WHERE `id`='$id_offer' ");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$value = $objDescs['value'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'id_offer2') {
			$part_zagolovok = 'оффер преимущества';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$id_offer2 = $objProjData->id_offer2;

			$resdescs=DB::query("SELECT * FROM `new_offers_add` WHERE `id`='$id_offer2' ");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$value = $objDescs['value'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'video') {
			$part_zagolovok = 'видео';
			$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$pagename'");
			$objProjData = DB::fetch_object($resProjData);
			$video = $objProjData->video;
			$value = $video;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'formtext') {
			$part_zagolovok = 'текст формы захвата';
			$resdescs=DB::query("SELECT * FROM `new_forms` WHERE `id`='$id_form'");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$value = $objDescs['value_text'];
				$hidden = '<div class="id_form hidden">'.$id_form.'</div>';
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'input') {
			$part_zagolovok = 'поле ввода формы захвата';
			$resdescs=DB::query("SELECT * FROM `new_forms` WHERE `id`='$id_form'");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$hidden = '<div class="id_form hidden">'.$id_form.'</div>';
			}

			$resdescs=DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form`='$id_form'");
			$objDescs =	DB::fetch_array($resdescs);
			$id_inputs = $objDescs['id_inputs'];

			$resdescs=DB::query("SELECT * FROM `new_inputs`");
			$select = '<select id ="iinput" class="w100 select_status pointer">';
			while ($objDescs =	DB::fetch_array($resdescs)) {
				$selected = "";
				if ($id_inputs == $objDescs['id']) {
					$selected = " selected";
					$enname = $objDescs['name'];
					$runame = $objDescs['ru_name'];
				}
				$select .= '<option value="'.$objDescs['id'].'"'.$selected.'>'.$objDescs['ru_name'].'/'.$objDescs['name'].'</option>';
			}
			$select .= '</select>';


			$promo_field .= '	<div class = "menu_link lh32">';
			$promo_field .= 			$select;
			$promo_field .= '	</div>';
			$promo_field .= '	<div class = "menu_link lh32">';
			$promo_field .= 	'		<input id ="inameru" class="nospace dib promo_input" placeholder="Например: '.$runame.'">';
			$promo_field .= '	</div>';
			$promo_field .= '	<div class = "menu_link lh32">';
			$promo_field .= 	'		<input id ="inameen" class="nospace dib promo_input" placeholder="Например: '.$enname.'">'.$hidden;
			$promo_field .= '	</div>';
		}

		if ($field == 'button') {
			$part_zagolovok = 'текст кнопки формы захвата';
			$resdescs=DB::query("SELECT * FROM `new_forms` WHERE `id`='$id_form'");
			$check=DB::num_rows($resdescs);
			if ($check > 0) {
				$objDescs =	DB::fetch_array($resdescs);
				$value = $objDescs['value_button'];
				$hidden = '<div class="hidden id_form">'.$id_form.'</div>';
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

 		if ($field == 'name') {
 			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
			}

 			$part_zagolovok = 'имя';
			$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
			$objUser = DB::fetch_object($resUser);
			$id_user_info = $objUser->id_user_info;

			$resuserinfo=DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
			$check=DB::num_rows($resuserinfo);
			if ($check > 0) {
				$objUserInfo =	DB::fetch_array($resuserinfo);
				$value = $objUserInfo['name'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'soname') {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
			}

			$part_zagolovok = 'отчество';
			$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
			$objUser = DB::fetch_object($resUser);
			$id_user_info = $objUser->id_user_info;

			$resuserinfo=DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info' ");
			$check=DB::num_rows($resuserinfo);
			if ($check > 0) {
				$objUserInfo =	DB::fetch_array($resuserinfo);
				$value = $objUserInfo['soname'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'family') {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
			}

			$part_zagolovok = 'фамилию';
			$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
			$objUser = DB::fetch_object($resUser);
			$id_user_info = $objUser->id_user_info;

			$resuserinfo=DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info' ");
			$check=DB::num_rows($resuserinfo);
			if ($check > 0) {
				$objUserInfo =	DB::fetch_array($resuserinfo);
				$value = $objUserInfo['family'];
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'phone') {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
			}
			$part_zagolovok = 'телефон';

			$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
			$objUser = DB::fetch_object($resUser);
			$id_phone = $objUser->id_phone;

			$resPhones=DB::query("SELECT * FROM `new_phones` WHERE `id`='$id_phone' ");

			$check=DB::num_rows($resPhones);
			if ($check > 0) {
				$objPhones = DB::fetch_array($resPhones);
				$id_phone_country = $objPhones['id_country'];
				$id_phone_city = $objPhones['id_city'];
				$val_phone_numb = $objPhones['numb'];

				$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$id_phone_country' ");
				$objPhonesCountry =	DB::fetch_array($resultPhonesCountry);
				$val_phone_country = $objPhonesCountry['value'];

				$resultPhonesCode = DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$id_phone_city'");
				$objPhonesCode =	DB::fetch_array($resultPhonesCode);
				$val_phone_city = $objPhonesCode['value'];

				$value = $val_phone_country.$val_phone_city.$val_phone_numb;
			} else {
				$value = '79876543210';
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<input id ="'.htmlspecialchars($field).'" type="phone" name="phone" class="dib promo_input" placeholder="Введите '.$part_zagolovok.'" value="'.htmlspecialchars($value).'">'.$hidden;
			$promo_field .= '</div>';
		}		

		if ($field == 'email') {
			$part_zagolovok = 'электронный почтовый адрес';
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resUser);
				$value = $objUser->email;
			}

			if ($cookis['page'] == 'sait') {
				$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project` = '$id_project' AND `page`='$pagename'");
				$objProjData = DB::fetch_object($resProjData);
				$value = $objProjData->email;
				$part_zagolovok = 'контактный электронный почтовый адрес';
			}

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<input id ="'.htmlspecialchars($field).'" name="email" type="email" class="dib promo_input" placeholder="Введите '.$part_zagolovok.'" value="'.htmlspecialchars($value).'">'.$hidden;
			$promo_field .= '</div>';
		}		

		if ( ($field == 'bivk') OR ($field == 'bivk2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
				
			$part_zagolovok = 'адрес вконтакте';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bivk'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}	

		if ( ($field == 'biyt') OR ($field == 'biyt2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'адрес Ютуб';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biyt'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			//echo "$id_social_network $id_project_data";

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}	

		if ( ($field == 'biok') OR ($field == 'biok2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'адрес Одноклассники';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biok'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ( ($field == 'bifb') OR ($field == 'bifb2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'адрес Фейсбук';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bifb'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ( ($field == 'bisk') OR ($field == 'bisk2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'аккаунт в Скайп';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bisk'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ( ($field == 'bitm') OR ($field == 'bitm2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'аккаунт в Телеграмм';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bitm'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ( ($field == 'biws') OR ($field == 'biws2') ) {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}
			
			$part_zagolovok = 'аккаунт в Ватсап';
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biws'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			$resSocialLink=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$objSocialLink = DB::fetch_object($resSocialLink);
			$value = $objSocialLink->link;
			
			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'company_name') {
			$part_zagolovok = 'наименование компании';
			$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$objProj = DB::fetch_object($projectsGet);
			$value = $objProj->company_name;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'motto') {
			$part_zagolovok = 'девиз компании';
			$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$objProj = DB::fetch_object($projectsGet);
			$value = $objProj->motto;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'about') {
			$part_zagolovok = 'описание компании';
			$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$objProj = DB::fetch_object($projectsGet);
			$value = $objProj->about;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'site') {
			$part_zagolovok = 'ссылку на сайт компании';
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
				$resUser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resUser);
				$id_user_info = $objUser->id_user_info;

				$resUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
				$objUserInfo = DB::fetch_object($resUserInfo);
				$value = $objUserInfo->site;
			} else {

				$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
				$objProj = DB::fetch_object($projectsGet);
				$value = $objProj->site;
			}


			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'ogrn') {
			$part_zagolovok = 'ОГРН или ОГРНИП компании';
			$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$objProj = DB::fetch_object($projectsGet);
			$value = $objProj->ogrn;

			$promo_field = '<div class = "menu_link lh32">';
			$promo_field .= '	<textarea id ="'.htmlspecialchars($field).'" class="dib promo_textarea" placeholder="Введите '.$part_zagolovok.'">'.htmlspecialchars($value).'</textarea>';
			$promo_field .= '</div>';
		}

		if ($field == 'address') {
			if ($cookis['page'] == 'zayavki') {
				$promo = '';
				$classbutton = "senddatac";
			}
			$part_zagolovok = 'адрес компании';

			$noaddress = false;

			if ($cookis['page'] == 'zayavki') {
				$resuser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' ");
				$objUser = DB::fetch_array($resuser);
				if (!isset($objUser['id_user_info'])) {
					$resUserInfo = DB::query("INSERT INTO `new_user_info` (`name`)  VALUES ('')");
					$id_user_info = DB::insert_id();
					$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$id_user_info' WHERE `id` = '$id_user'");
					$noaddress = true;
				} else {
					$id_user_info =	$objUser['id_user_info'];
				}

				if (!$noaddress) {
					$resUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info' ");
					$objUserInfo = DB::fetch_array($resUserInfo);
					if (!isset($objUserInfo['id_adress'])) {
						$noaddress = true;
					} else {
						$id_address = $objUserInfo['id_adress'];
					}
				}
			} else { //PROJECT
				$resultAddressProjProject = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'  AND `main`='1'");
				$check = DB::num_rows($resultAddressProjProject);
				if ($check > 0 ) { 
					$objAddressProj = DB::fetch_array($resultAddressProjProject);
					$id_address = $objAddressProj['id_address'];
				} else {
					$noaddress = true;
				}	
			}	

			if ($noaddress) {
				$id_address = 2;
			}

			$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address'");
			$objAddress = DB::fetch_object($resultAddress);
			$id_country = $objAddress->id_country;
			$id_regions = $objAddress->id_regions;
			$id_city = $objAddress->id_city;
			$id_street = $objAddress->id_street;
			$home = $objAddress->home;
			$corpus = $objAddress->corpus;
			$flat = $objAddress->flat;
            $id_index = $objAddress->id_index;

			$resCountry = DB::query("SELECT * FROM `new_adress_country` WHERE `id`='$id_country'");
			$objCountry = DB::fetch_object($resCountry);
			$country = $objCountry->country;

			$resultRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `id`='$id_regions'");
			$objRegion = DB::fetch_object($resultRegion);
			$region = $objRegion->region;

			$resultCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id`='$id_city'");
			$objCity = DB::fetch_object($resultCity);
			$city = $objCity->city;

			$resultStreet = DB::query("SELECT * FROM `new_adress_street` WHERE `id`='$id_street'");
			$objStreet = DB::fetch_object($resultStreet);
			$street = $objStreet->street;

			$resultIndex = DB::query("SELECT * FROM `new_adress_index` WHERE `id_address`='$id_address'");
			$objIndex = DB::fetch_object($resultIndex);
			$index = $objIndex->index;

			

			$promo_field = '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Страна</div>';
			$promo_field .= '	<textarea id ="icountry" class="dib promo_textarea" placeholder="пример: Россия">'.htmlspecialchars($country).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Регион</div>';
			$promo_field .= '	<textarea id ="iregion" class="dib promo_textarea" placeholder="пример: Башкортостан">'.htmlspecialchars($region).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Город</div>';
			$promo_field .= '	<textarea id ="icity" class="dib promo_textarea" placeholder="пример: Стерлитамак">'.htmlspecialchars($city).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Улица</div>';
			$promo_field .= '	<textarea id ="istreet" class="dib promo_textarea" placeholder="пример: Нагуманова">'.htmlspecialchars($street).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Дом</div>';
			$promo_field .= '	<textarea id ="ihome" class="dib promo_textarea" placeholder="пример: 18">'.htmlspecialchars($home).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Подъезд</div>';
			$promo_field .= '	<textarea id ="icorpus" class="dib promo_textarea" placeholder="пример: 1">'.htmlspecialchars($corpus).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Квартира</div>';
			$promo_field .= '	<textarea id ="iflat" class="dib promo_textarea" placeholder="пример: 2">'.htmlspecialchars($flat).'</textarea>';
			$promo_field .= '</div>';

			$promo_field .= '<div class = "menu_link lh32 bb pr tac">';
			$promo_field .= '	<div class="dib prefield pa z10">Индекс</div>';
			$promo_field .= '	<textarea id ="iindex" class="dib promo_textarea" placeholder="пример: 453124">'.htmlspecialchars($index).'</textarea>'.$hidden;
			$promo_field .= '</div>';
		}

		if ($field == 'region') {
			$sqlregions = DB::query("SELECT * FROM `new_regions`");

			while ($region = DB::fetch_object($sqlregions)) {
				$parent_id = $region->id_parent;
				$region_id = $region->region_id;
				$type_id = $region->type_id;
				$name = $region->name;
				$regions[$parent_id]['type_id'][] = $type_id;
				$regions[$parent_id]['region_id'][] = $region_id;
				$regions[$parent_id]['name'][] = $name;
			}

			$resultProj = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
			$check=DB::num_rows($resultProj);
			if ($check > 0) {
				$objProj = DB::fetch_object($resultProj);
				$numb_region_inner = $objProj->region;
				if (strrpos($numb_region_inner, ',') > 0) {
					$region_once = explode(',', $numb_region_inner);
					for ($i=0; $i < count($region_once); $i++) {
							if ($region_once[$i][0] == '-') {
								$region_once[$i] = substr($region_once[$i], 1, strlen($region_once[$i])-1);
							}
						}
				} else {
					$region_once[0] = $numb_region_inner;
				}
				//echo "REGION";
				//print_r($region_once);
			}

			function build_tree($regions, $parent_id, $lvl, $regions_on, $checked){
				for ($i=0; $i < count($regions[$parent_id]['name']); $i++) { 
					$name = $regions[$parent_id]['name'][$i];
					$type_id = $regions[$parent_id]['type_id'][$i];
					$region_id = $regions[$parent_id]['region_id'][$i];
					
					$count_r = count($regions_on);
					//echo "<p>$count_r</p>";

					if ($checked === 1) {
						$checked_in = 'checked';
					} else {
						$checked_in = '';
					}
					$checked_vr = $checked;

					//echo "<p>1 C $checked I $checked_in V $checked_vr R $region_id O</p>";
					//print_r($regions_on);
					if (in_array($region_id, $regions_on)) {
						if ($checked_vr === 0) {
							$checked_in = 'checked';
							$checked_vr = 1;
						} else {
							$checked_in = '';
							$checked_vr = 0;
						}

						foreach ($regions_on as $key => $value) {
							if ($region_id === $value) {
								//echo "<p>R $region_id K $key V $value</p>";
								unset($regions_on[$key]);
							}
						}
					} else {
						if ($checked_vr === 1) {
							$checked_in = 'checked';
							$checked_vr = 1;
						} else {
							$checked_in = '';
							$checked_vr = 0;
						}
					}
					//echo "<p>2 C $checked I $checked_in V $checked_vr R $region_id O</p>";
					/*if ( (strlen($checked_in) > 0) && ($checked == 1) ){
						$checked_in = '';
						$checked_vr = 0;
					}
					echo "<p>3 C $checked I $checked_in V $checked_vr R $region_id O $regions_on</p>";*/

					echo '<input class="checkbox__control" type="checkbox" autocomplete="off" id="region-'.$region_id.'" aria-labelledby="labelregion-'.$region_id.'" '.$checked_in.'>';
					echo '<label class="checkbox__label" aria-hidden="true" id="labelregion-'.$region_id.'" for="region-'.$region_id.'">'.$name.'</label><br>';

					if ($i == count($regions[$parent_id]['region_id'])-1 ) {
						$lvl--;
					}
					if (count($regions[$region_id]['region_id']) > 0 ) {
						$lvl++;
						$margin = 20*$lvl;
						echo "<div class=\"tree\">⊕</div>";
						echo '<div class="parentregion-'.$region_id.' hidden" style="margin-left:'.$margin.'px">';
						build_tree($regions, $region_id, $lvl, $regions_on, $checked_vr);
						echo "</div>";
						$lvl--;
					}
				}
			}

			$zag = $CONSTS['zag_region'];
			$video = $CONSTS['video_region'];
			$video_volume = $CONSTS['video_volume'];

		echo '<div class="promo fs2">
						<div class = "videoZag">
							<div class="obolochka">
								<div class="centredv lh26">'.$zag.'</div>
							</div>
						</div>';
			echo '<div class="video tac">
							<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
						</div>';
			echo '<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
			echo '<div class = "promoIn tal fs15">';
				echo "<div class=\"treehead\">";
				echo '<input class="checkbox__control" type="checkbox" autocomplete="off" id="region-0" aria-labelledby="labelregion-0">';
				echo '<label class="checkbox__label b-regions-tree__region-name" aria-hidden="true" id="labelregion-0" for="region-0">Все</label><br>';
					echo "<div class=\"tree\">⊕</div>";
						echo '<div class="parentregion-'.$region_id.' hidden" style="margin-left:'.$margin.'px">';
				

						build_tree($regions, 0, 0, $region_once, 0);
					echo '</div>';
				echo "</div>";
			echo '</div>';
			echo '
			</div>';
			echo '
			<script>
			
				$(document).on("click", ".checkbox__control", function(e){
					if (e.which == 1) { 
						if (this.checked) {
							$(this).siblings("[class^=parentregion]").find(".checkbox__control").each(function(){
								$(this).prop("checked", true);
							});
							$.ajax({
								url: "../tmpl/obrabotka.php",
								type:"post",
								data: {tree: $(this).attr("id"), numproj: $.cookie("numproj")},
								success:function(loader){
									console.log(loader); 
								}
							});
						} else {
							$(this).siblings("[class^=parentregion]").find(".checkbox__control").each(function(){
								$(this).prop("checked", false);
							});
							$.ajax({
								url: "../tmpl/obrabotka.php",
								type:"post",
								data: {tree: "-"+$(this).attr("id"), numproj: $.cookie("numproj")},
								success:function(loader){
									console.log(loader); 
								}
							});
						}
					}
				});
				$(document).on("click", ".tree", function(e){
					if (e.which == 1) { 
						if ($(this).next().hasClass("hidden")) {
							$(this).next().removeClass("hidden");
						} else {
							$(this).next().addClass("hidden");
						} 
					}
				});
			</script>';
			$zagolovok_field = false;
			$button_field = false;
			$formfieldstart = '';
			$formfieldend = '';
		}

		if ($zagolovok_field <> false) {
			$zagolovok_field = '<div class = "menu_link tac lh32">';
			$zagolovok_field .= $buttonactionname.' '.$part_zagolovok;
			$zagolovok_field .= '</div>';
		}

		if ($button_field <> false) {
			$button_field = '<div class = "menu_link window_button">
								<button class="promo_knopka w100 tac pointer white biRed db lh50 border3rad '.$classbutton.'" '.$buttonname.' '.$formsend.' id="'.$buttonid.'">'.$buttonactionname.'</button>
							</div>';
		}
		
		///ВЫВОД
				$result .= $promo;
				$result .= $result2;
				$result .= $formfieldstart;
				$result .= $formstart;

				$result .= $zagolovok_field;
				$result .= $promo_field;
				$result .= $button_field;
				$result .= $formend;
				$result .= $formfieldend;
				$result .= $script;
	}

	/* Все изображения из папки
		<div id="galleria">
			<? 
				$strpath = $_SERVER['DOCUMENT_ROOT'];
				$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/';
				chdir($truepath);
				$files1 = scandir($refid);

				$formats = array("jpg", "jpeg", "gif", "png");

				for ($i=0; $i < count($files1); $i++) { 
					$format = @end(explode(".", strtolower($files1[$i])));
					if (in_array($format, $formats)) {
						echo '
						<a href="'.$files1[$i].'">
			                <img 
			                    src="'.$files1[$i].'",
			                    data-big="'.$files1[$i].'"
			                    data-title=""
			                    data-description=""
			                >
			            </a>
						';
					}
				}
			?>
	        </div>
	*/

	/* Копирование файла
	$strpath = $_SERVER['DOCUMENT_ROOT'];
		$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/'; //.$name.'/'
		chdir($truepath);
		$txtload = false;

	if ($txtload) {
			$filefrom = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/shablon/index.php'; //.$name.'/'
			$fileto = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/'.$proname.'/index.php'; //.$name.'/'
			$filefrom2 = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/shablon/galleria.classic.min.js'; //.$name.'/'
			$fileto2 = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/sales/'.$proname.'/galleria.classic.min.js'; //.$name.'/'
			echo "$proname";
			if (! file_exists($fileto)) {
				if (!copy($filefrom, $fileto)) {
					echo "Не удалось скопировать файл";
				}
			}
			if (! file_exists($fileto2)) {
				if (!copy($filefrom2, $fileto2)) {
					echo "Не удалось скопировать файл";
				}
			}
	}
	*/

	if (isset($_POST['color'])) {
		if (isset($_POST['numproj'])) {
			$id_project = $_POST['numproj'];
		}

		if (isset($_POST['pagename'])) {
			$pagename = $_POST['pagename'];
		}

		if ($_POST['color'] == 'icolorb') {
			$val = $_POST['val'];
			//$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `colorBG`='$val' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `colorBG`='$val' WHERE `id_project` = '$id_project'");
			include('../tmp/page_crm.php');
		}

		if ($_POST['color'] == 'icolort') {
			$val = $_POST['val'];
			//$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `colorFont`='$val' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `colorFont`='$val' WHERE `id_project` = '$id_project'");
			include('../tmp/page_crm.php');
		}

		if ($_POST['color'] == 'ifile') {
			$val = $_POST['val'];
			
			$resvoronka=DB::query("SELECT * FROM `new_project_data` WHERE `id_project` = '$id_project' AND `page`='$pagename' LIMIT 1");
			$row = DB::fetch_array($resvoronka);
			$_SESSION['market_'.$market]['id_project_data'] = $row['id'];
			echo "$id_project $pagename";
			//$ProjectDataUpdate=DB::query("SELECT `new_project_data`  SET `colorFont`='$val' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			//include('../tmp/page_crm.php');
		}
	}

	if (isset($_POST['crmchange'])) {
		$field = $_POST['crmchange'];
		if (isset($_POST['val'])) {
			$value = $_POST['val'];
			$vals = json_decode($value, true);
			if (isset($vals[$field])) {
				$val = $vals[$field];
			}
		}
		//print_r($_POST);

		$cooki = $_POST['cooki'];
		$cookis = json_decode($cooki, true);
		if (isset($cookis['pagename'])) {
			$pagename = $cookis['pagename'];
		} elseif (isset($_SESSION['market_'.$market]['pagename'])) {
			$pagename = $_SESSION['market_'.$market]['pagename'];
		} else {
			$pagename = 'index';
		}
		$namepagesite = $pagename;

		if (isset($cookis['id_project'])) {
			$id_project = $cookis['id_project'];
		} else {
			$id_project = $_SESSION['market_'.$market]['id_project'];
		}

		if (isset($cookis['id_user'])) {
			$id_user = $cookis['id_user'];
		} else {
			$id_user = $_SESSION['market_'.$market]['id_user'];
		}

		if (isset($cookis['market'])) {
			$market = $cookis['market'];
		}

		$hiddenpost = $_POST['hidden'];
		$hiddens = json_decode($hiddenpost, true);
		if (isset($hiddens['id_form'])) {
			$id_form = $hiddens['id_form'];
		}
		if (isset($hiddens['id_phrase'])) {
			$id_phrase = $hiddens['id_phrase'];
		}
		if (isset($hiddens['id_zag'])) {
			$id_zag = $hiddens['id_zag'];
		}
		if (isset($hiddens['value'])) {
			$field = $hiddens['value'];
		}
		if (isset($hiddens['id_zayavki'])) {
			$id_zayavki = $hiddens['id_zayavki'];
		}
		if (isset($hiddens['id_user'])) {
			$id_user = $hiddens['id_user'];
		}
		if (isset($hiddens['id_ads'])) {
			$id_ads = $hiddens['id_ads'];
		}
		

		if ($_POST['crmchange'] == 'zagolovok1') {
			if ($val == 'empty') {

			} else {
				$Zagolovok1Update=DB::query("UPDATE `new_ads_zag`  SET `zag`= '$val' WHERE `id` = '$id_zag'");
			}

			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'zagolovok2') {
			if ($val == 'empty') {

			} else {
				$Zagolovok1Update=DB::query("UPDATE `new_ads_zag2`  SET `zag`= '$val' WHERE `id` = '$id_zag'");
			}

			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'fastlink') {
			$textfastlink = $vals['textfastlink'];
			$hreffastlink = $vals['hreffastlink'];
			$descfastlink = $vals['descfastlink'];
			$id_ads = $hiddens['id_ads'];
			$n_fastlink = $hiddens['n_fastlink'];
			$gr_fastlink = $hiddens['gr_fastlink'];
			$add_newads = $vals['add_newads'];
			/*echo "GR $gr_fastlink N $n_fastlink N $textfastlink N $hreffastlink N $descfastlink A $add_fastlink";
			print_r($_POST);
			exit();/**/

			if ( ($textfastlink == 'empty') OR ($hreffastlink == 'empty') ) {
				if (!$gr_fastlink == 'empty') {
					$fieldfastlink = '';
					$valfastlink = '';
					$fastlinkGroupGet = DB::query("SELECT * FROM `new_ads_fastlinks_group` WHERE `id`='$gr_fastlink'");
					$objFastlinkGroup = DB::fetch_object($fastlinkGroupGet);
					$k = '1';
					if ($n_fastlink == '1') {

					} else {
						$id_fastlink1 = $objFastlinkGroup->id_fastlink1;
						$fieldfastlink = '`id_fastlink'.$k.'`';
						$valfastlink = "'$id_fastlink$k";
						$k++;
					}

					if ($n_fastlink == '2') {

					} else {
						if ($objFastlinkGroup->id_fastlink2 <> '') {
							$id_fastlink2 = $objFastlinkGroup->id_fastlink2;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink'.$k.'`';
								$valfastlink = "'$id_fastlink$k'";
							} else {
								$fieldfastlink .= ', `id_fastlink'.$k.'`';
								$valfastlink .= ", '$id_fastlink$k'";
							}
							$k++;
						}
					}

					if ($n_fastlink == '3') {

					} else {
						if ($objFastlinkGroup->id_fastlink3 <> '') {
							$id_fastlink3 = $objFastlinkGroup->id_fastlink3;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink'.$k.'`';
								$valfastlink = "'$id_fastlink$k'";
							} else {
								$fieldfastlink .= ', `id_fastlink'.$k.'`';
								$valfastlink .= ", '$id_fastlink$k'";
							}
							$k++;
						}
					}

					if ($n_fastlink == '4') {

					} else {
						if ($objFastlinkGroup->id_fastlink4 <> '') {
							$id_fastlink4 = $objFastlinkGroup->id_fastlink4;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink'.$k.'`';
								$valfastlink = "'$id_fastlink$k";
							} else {
								$fieldfastlink .= ', `id_fastlink'.$k.'`';
								$valfastlink .= ", '$id_fastlink$k'";
							}
						}
					}

					$sql = DB::query("INSERT INTO `new_ads_fastlinks_group`($fieldfastlink) VALUES ($valfastlink)");
					$id_fastlink_group = DB::insert_id();

					//$FastlinkUpdate=DB::query("UPDATE `new_ads_fastlinks_user`  SET `id_fastlink_group`= '$id_fastlink_group' WHERE `id_user` = '$id_user'");
				} else {
					include('../tmp/previewads.php');
					exit();
				}
			} else {
				$fastlinkGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `fastlink`='$textfastlink' AND `href`='$hreffastlink'");
				$check = DB::num_rows($fastlinkGet);
				if ($check > 0) {
					$objFastlink = DB::fetch_object($fastlinkGet);
					$id_fastlink_value = $objFastlink->id;
					if ($descfastlink <> 'empty') {
						if ($objFastlink->desc == '') {
							$Zagolovok1Update=DB::query("UPDATE `new_ads_fastlinks`  SET `desc`= '$descfastlink' WHERE `id` = '$id_fastlink_value'");
						}
					}
				} else {
					if ($descfastlink <> 'empty') {
						$fielddescfastlink = ', `desc`';
						$valdescfastlink = ", '$descfastlink'";
					}
					$sql = DB::query("INSERT INTO `new_ads_fastlinks`(`id_user`, `fastlink`, `href`$fielddescfastlink) VALUES ('$id_user', '$textfastlink', '$hreffastlink'$valdescfastlink)");
					$id_fastlink_value = DB::insert_id();
				}

				$fieldfastlink = '';
				$valfastlink = '';

				if ($gr_fastlink == 'empty') {
					$fieldfastlink = '`id_fastlink1`';
					$valfastlink = "'$id_fastlink_value'";
				} else {

					$fastlinkGroupGet = DB::query("SELECT * FROM `new_ads_fastlinks_group` WHERE `id`='$gr_fastlink'");
					$objFastlinkGroup = DB::fetch_object($fastlinkGroupGet);

					if ($n_fastlink == '1') {
						if ($fieldfastlink == '') {
							$fieldfastlink = '`id_fastlink1`';
							$valfastlink = "'$id_fastlink_value'";
						} else {
							$fieldfastlink .= ', `id_fastlink1`';
							$valfastlink .= ", '$id_fastlink_value'";
						}
						$id_fastlinks[] = $id_fastlink_value;
					} else {
						if ($objFastlinkGroup->id_fastlink1 <> '') {
							$id_fastlink1 = $objFastlinkGroup->id_fastlink1;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink1`';
								$valfastlink = "'$id_fastlink1'";
							} else {
								$fieldfastlink .= ', `id_fastlink1`';
								$valfastlink .= ", '$id_fastlink1'";
							}
							$id_fastlinks[] = $id_fastlink1;
						}
					}

					if ($n_fastlink == '2') {
						if ($fieldfastlink == '') {
							$fieldfastlink = '`id_fastlink2`';
							$valfastlink = "'$id_fastlink_value'";
						} else {
							$fieldfastlink .= ', `id_fastlink2`';
							$valfastlink .= ", '$id_fastlink_value'";
						}
						$id_fastlinks[] = $id_fastlink_value;
					} else {
						if ($objFastlinkGroup->id_fastlink2 <> '') {
							$id_fastlink2 = $objFastlinkGroup->id_fastlink2;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink2`';
								$valfastlink = "'$id_fastlink2'";
							} else {
								$fieldfastlink .= ', `id_fastlink2`';
								$valfastlink .= ", '$id_fastlink2'";
							}
							$id_fastlinks[] = $id_fastlink2;
						}
					}

					if ($n_fastlink == '3') {
						if ($fieldfastlink == '') {
							$fieldfastlink = '`id_fastlink3`';
							$valfastlink = "'$id_fastlink_value'";
						} else {
							$fieldfastlink .= ', `id_fastlink3`';
							$valfastlink .= ", '$id_fastlink_value'";
						}
						$id_fastlinks[] = $id_fastlink_value;
					} else {
						if ($objFastlinkGroup->id_fastlink3 <> '') {
							$id_fastlink3 = $objFastlinkGroup->id_fastlink3;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink3`';
								$valfastlink = "'$id_fastlink3'";
							} else {
								$fieldfastlink .= ', `id_fastlink3`';
								$valfastlink .= ", '$id_fastlink3'";
							}
							$id_fastlinks[] = $id_fastlink3;
						}
					}

					if ($n_fastlink == '4') {
						if ($fieldfastlink == '') {
							$fieldfastlink = '`id_fastlink4`';
							$valfastlink = "'$id_fastlink_value'";
						} else {
							$fieldfastlink .= ', `id_fastlink4`';
							$valfastlink .= ", '$id_fastlink_value'";
						}
						$id_fastlinks[] = $id_fastlink_value;
					} else {
						if ($objFastlinkGroup->id_fastlink4 <> '') {
							$id_fastlink4 = $objFastlinkGroup->id_fastlink4;
							if ($fieldfastlink == '') {
								$fieldfastlink = '`id_fastlink4`';
								$valfastlink = "'$id_fastlink4'";
							} else {
								$fieldfastlink .= ', `id_fastlink4`';
								$valfastlink .= ", '$id_fastlink4'";
							}
							$id_fastlinks[] = $id_fastlink4;
						}
					}
				}

				$sql = DB::query("INSERT INTO `new_ads_fastlinks_group`($fieldfastlink) VALUES ($valfastlink)");
				$id_fastlink_group = DB::insert_id();
			}

			for ($i=0; $i < count($id_fastlinks) ; $i++) {
				$id_fast = $id_fastlinks[$i];
				$fastlinkGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fast'");
				$objFastlink = DB::fetch_object($fastlinkGet);
				$arrfast['fastlink'][$i] = $objFastlink->fastlink;
				$arrfast['href'][$i] = $objFastlink->href;
				$arrfast['desc'][$i] = $objFastlink->desc;
			}

			$method = 'add';
			$JSON = '{"method":"'.$method.'","params":{"SitelinksSets": [{ "Sitelinks": [';
			for ($i = 0; $i < count($id_fastlinks); $i++) {
				if (strpos($JSON, $arrfast['href'][$i]) > 0) { //формирование быстрой ссылки с помощью добавления якорей
					$arrfast['href'][$i] = $arrfast['href'][$i].'#'.$i;
				}
				if ($i == 0) {
				 	$JSON .= '{"Title" : "' . $arrfast['fastlink'][$i] . '", "Href" : "'. $arrfast['href'][$i] .'"';
				} else {
				 	$JSON .= ', {"Title" : "' . $arrfast['fastlink'][$i] . '", "Href" : "'. $arrfast['href'][$i] .'"';
				}
				if ($arrfast['desc'][$i] <> '') {
					$JSON .= ', "Description" : "'. $arrfast['desc'][$i] .'"';
				}
				$JSON .= '}';
			}
			$JSON .= ']}]}}';

			$marketingGet = DB::query("SELECT * FROM `new_marketing` WHERE `id_user`='$id_user' AND `id_project`='$id_project'");
			$objMarketing = DB::fetch_object($marketingGet);
			$yandex_acc = $objMarketing->yandex;
			$yandex = explode('@', $yandex_acc)[0];
			$token_yandex = $objMarketing->token_yandex;

			//echo "$yandex $token_yandex $json";

			//exit();
			//'Client-Login: '.$yandex,

			//$json = '{"method":"add","params":{"SitelinksSets": [{ "Sitelinks": [{"Title" : "Быстрая ссылка", "Href" : "http://ya.ru", "Description" : "Быстрая ссылка 1"}, {"Title" : "Быстроссылка", "Href" : "http://ya.ru#1"}, {"Title" : "Быстрая ссылка 3", "Href" : "http://ya.ru#2", "Description" : "Быстрая ссылка 3"}, {"Title" : "Быстрая ссылка 4", "Href" : "http://ya.ru#3", "Description" : "Быстрая ссылка 4"}]}]}}';
			$api = 'api';
			$typefunc = 'sitelinks';
			$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
			$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
									 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
									 'Content-Type: application/json; charset=utf-8',
									 'Client-Login: '.$yandex,
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON); // add POST fields

			try {
			    $result = curl_exec($ch);
			}
			catch(Exception $e) {
			    print_r($e);
			    echo "string2";
			}

			if($result === false) {
				print_r(curl_error($ch));
				echo "string1";
			} else {
				$info = curl_getinfo($ch);
				$pagecode = $info['http_code'];
				if ($pagecode == '200') {
					$header_size = $info['header_size'];
					$header = substr($result, 0, $header_size);
					$body = substr($result, $header_size);
					//echo $body; //проверяю отчеты вообще есть?
					$jsonresult = json_decode($body);
					$numb_fastlink = $jsonresult->result->AddResults['0']->Id;
					//echo "$numb_fastlink";
					if ($add_newads == '1') {
						$sql = DB::query("INSERT INTO `new_ads_fastlinks_user`(`id_user`, `id_fastlink_group`, `numb`) VALUES ('$id_user', '$id_fastlink_group', '$numb_fastlink')");
						$id_fastlink = DB::insert_id();
						//INSERT ADS
						$resAds = DB::query("SELECT * FROM `new_ads` WHERE `id`='$id_ads'");
						$objAds = DB::fetch_array($resAds);
						$sqlAdsField = '';
						$sqlAdsValue = '';
						$z = '';
						foreach ($objAds as $key => $value) {
							if ($key == 'id_fastlink') {
								$sqlAdsField = "$z`$key`";
								$sqlAdsValue = "$z'$id_fastlink'";
							} else {
								$sqlAdsField = "$z`$key`";
								$sqlAdsValue = "$z'$value'";
							}
							if ($z == '') {
								$z = ', ';
							}
						}
						$sql = DB::query("INSERT INTO `new_ads`($sqlAdsField) VALUES ($sqlAdsValue)");
						$id_ads = DB::insert_id();
					} else {
						$FastlinkUpdate=DB::query("UPDATE `new_ads_fastlinks_user`  SET `id_fastlink_group`= '$id_fastlink_group', `numb`= '$numb_fastlink' WHERE `id_user` = '$id_user' AND `id_fastlink_group` = '$gr_fastlink'");
					}

					//Заменить само объявление в Я.Д. //Ну это должно происходить при любом изменении в объявлении //После серверной части добавить $id_ads
				}
			}

			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'desc') {
			if ($val == 'empty') {

			} else {
				$Zagolovok1Update=DB::query("UPDATE `new_ads`  SET `url_desc`= '$val' WHERE `id_zag` = '$id_zag' AND `id_phrase`='$id_phrase'");
			}

			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'textads') {
				$short = $vals['short'];
				$shortGet = DB::query("SELECT * FROM `new_ads_short` WHERE `short`='$short'");
				$check = DB::num_rows($shortGet);
				if ($check > 0) {
					$objShort = DB::fetch_object($shortGet);
					$id_short_value = $objShort->id;
				} else {
					$sql = DB::query("INSERT INTO `new_ads_short`(`id_user`, `short`) VALUES ('$id_user', '$short')");
					$id_short_value = DB::insert_id();
				}
				$shortUserUpdate=DB::query("UPDATE `new_ads_short_user`  SET `id_short`= '$id_short_value' WHERE `id_user` = '$id_user'");
				$shortUserGet = DB::query("SELECT * FROM `new_ads_short_user` WHERE `id_short`='$id_short_value' AND `id_user` = '$id_user'");
				$objShortUser = DB::fetch_object($shortUserGet);
				$id_short = $objShortUser->id;
				
//deadline_USER переделывать БД
				$deadline = $vals['deadline'];
				$deadlineGet = DB::query("SELECT * FROM `new_ads_deadline` WHERE `value`='$deadline'");
				$check = DB::num_rows($deadlineGet);
				if ($check > 0) {
					$objDeadline = DB::fetch_object($deadlineGet);
					$id_deadline_value = $objDeadline->id;
				} else {
					$sql = DB::query("INSERT INTO `new_ads_deadline`(`id_user`, `value`) VALUES ('$id_user', '$deadline')");
					$id_deadline_value = DB::insert_id();
				}
				$deadlineUserUpdate=DB::query("UPDATE `new_ads_deadline_user`  SET `id_deadline`= '$id_deadline_value' WHERE `id_user` = '$id_user'");
				$deadlineUserGet = DB::query("SELECT * FROM `new_ads_deadline_user` WHERE `id_deadline`='$id_deadline_value' AND `id_user` = '$id_user'");
				$objDeadlineUser = DB::fetch_object($deadlineUserGet);
				$id_deadline = $objDeadlineUser->id;

				$cta = $vals['cta'];
				$ctaGet = DB::query("SELECT * FROM `new_ads_cta` WHERE `value`='$cta'");
				$check = DB::num_rows($ctaGet);
				if ($check > 0) {
					$objCta = DB::fetch_object($ctaGet);
					$id_cta_value = $objCta->id;
				} else {
					$sql = DB::query("INSERT INTO `new_ads_cta`(`id_user`, `value`) VALUES ('$id_user', '$cta')");
					$id_cta_value = DB::insert_id();
				}
				$ctaUserUpdate=DB::query("UPDATE `new_ads_cta_user`  SET `id_cta`= '$id_cta_value' WHERE `id_user` = '$id_user'");
				$ctaUserGet = DB::query("SELECT * FROM `new_ads_cta_user` WHERE `id_cta`='$id_cta_value' AND `id_user` = '$id_user'");
				$objCtaUser = DB::fetch_object($ctaUserGet);
				$id_cta = $objCtaUser->id;

				$TextAdsUpdate=DB::query("UPDATE `new_ads`  SET `id_short`= '$id_short', `id_deadline`= '$id_deadline', `id_cta`= '$id_cta' WHERE `id_zag` = '$id_zag' AND `id_phrase`='$id_phrase'");
			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'descs') {
			$descs = $vals['descs'];
			$id_desc = $hiddens['id_desc'];
			if ($descs == 'empty') {
				$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id`='$id_ads'");
				$objAds = DB::fetch_object($adsGet);
				if (isset($objAds->id_desc)) {
					$id_desc_ads = $objAds->id_desc;
					$adsDescsUserGet = DB::query("SELECT * FROM `new_ads_descs_user` WHERE `id`='$id_desc_ads'");
					$objAdsDescsUser = DB::fetch_object($adsDescsUserGet);
					$group_desc_ads = $objAdsDescsUser->group;

					$adsDescsUserGet = DB::query("DELETE FROM `new_ads_descs_group` WHERE `group`='$group_desc_ads' AND `id_desc`='$id_desc'");
				}
			} else {
				$descsGet = DB::query("SELECT * FROM `new_ads_descs` WHERE `desc`='$desc'");
				$check = DB::num_rows($descsGet);
				if ($check > 0) {
					$objDescs = DB::fetch_object($descsGet);
					$id_descs_value = $objDescs->id;
				} else {
					$sql = DB::query("INSERT INTO `new_ads_descs`(`id_user`, `desc`) VALUES ('$id_user', '$descs')");
					$id_descs_value = DB::insert_id();
				}

				$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id`='$id_ads'");
				$objAds = DB::fetch_object($adsGet);
				if (isset($objAds->id_desc)) {
					$id_desc_ads = $objAds->id_desc;
					$adsDescsUserGet = DB::query("SELECT * FROM `new_ads_descs_user` WHERE `id`='$id_desc_ads'");
					$objAdsDescsUser = DB::fetch_object($adsDescsUserGet);
					$group_desc_ads = $objAdsDescsUser->group;

					$Zagolovok1Update=DB::query("UPDATE `new_ads_descs_group`  SET `id_desc`= '$id_descs_value' WHERE `group` = '$group_desc_ads' AND `id_desc`='$id_desc'");

					$JSON = '{ "method": "add", "params": { "AdExtensions": [ { "Callout": { "CalloutText": "' . $descs .'" } } ] } }';

					$marketingGet = DB::query("SELECT * FROM `new_marketing` WHERE `id_user`='$id_user' AND `id_project`='$id_project'");
					$objMarketing = DB::fetch_object($marketingGet);
					$yandex_acc = $objMarketing->yandex;
					$yandex = explode('@', $yandex_acc)[0];
					$token_yandex = $objMarketing->token_yandex;

					$api = 'api';
					$typefunc = 'adextensions';
					$serv_addr = 'https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc;
					$post_headers = array('POST /json/v5/'.$typefunc.'/ HTTP/1.1',
											 'Referer: https://'.$api.'.direct.yandex.com/json/v5/'.$typefunc,
											 'Content-Type: application/json; charset=utf-8',
											 'Client-Login: '.$yandex,
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
					curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON); // add POST fields

					try {
					    $result = curl_exec($ch);
					}
					catch(Exception $e) {
					    print_r($e);
					    echo "string2";
					}

					if($result === false) {
						print_r(curl_error($ch));
						echo "string1";
					} else {
						$info = curl_getinfo($ch);
						$pagecode = $info['http_code'];
						if ($pagecode == '200') {
							$header_size = $info['header_size'];
							$header = substr($result, 0, $header_size);
							$body = substr($result, $header_size);
							//echo $body; //проверяю отчеты вообще есть?
							$jsonresult = json_decode($body);
							$numb = $jsonresult->result->AddResults['0']->Id;
							echo "$numb";
							if ($add_newads == '1') {
								$sql = DB::query("INSERT INTO `new_ads_descs_group`(`id_desc`, `group`, `numb`) VALUES ('$id_descs_value', '$group_desc_ads', '$numb')");
								$id_desc = DB::insert_id();
								//INSERT ADS
								$resAds = DB::query("SELECT * FROM `new_ads` WHERE `id`='$id_ads'");
								$objAds = DB::fetch_array($resAds);
								$sqlAdsField = '';
								$sqlAdsValue = '';
								$z = '';
								foreach ($objAds as $key => $value) {
									if ($key == 'id_desc') {
										$sqlAdsField = "$z`$key`";
										$sqlAdsValue = "$z'$id_desc'";
									} else {
										$sqlAdsField = "$z`$key`";
										$sqlAdsValue = "$z'$value'";
									}
									if ($z == '') {
										$z = ', ';
									}
								}
								$sql = DB::query("INSERT INTO `new_ads`($sqlAdsField) VALUES ($sqlAdsValue)");
								$id_ads = DB::insert_id();
							} else {
								$FastlinkUpdate=DB::query("UPDATE `new_ads_descs_group`  SET `numb`= '$numb' WHERE `id_desc` = '$id_descs_value' AND `group` = '$group_desc_ads'");
							}

							//Заменить само объявление в Я.Д. //Ну это должно происходить при любом изменении в объявлении //После серверной части добавить $id_ads
						}
					}
				}
			}

			include('../tmp/previewads.php');
		}

		if ($_POST['crmchange'] == 'addpage') {
			$hidesite = '';
			$hidevoronka = 'hidden';
			$nameheader = 'АВТОВОРОНКА ПРОДАЖ';
			if ($cookis['inpage'] == '.voronkaview') {
				$hidevoronka = '';
				$hidesite = 'hidden';
				$nameheader = 'СТРАНИЦА САЙТА';
			}
			$namepagesite = $cookis['pagename'];

			$strpath = $_SERVER['DOCUMENT_ROOT'];
			$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/'; //.$name.'/'
			
			$filefrom = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/index.php'; //.$name.'/'
			$fileto = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/'.$val.'.php'; //.$name.'/'
			$filefrom2 = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/tmp/index.php'; //.$name.'/'
			$fileto2 = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/tmp/'.$val.'.php'; //.$name.'/'
			$error_page = '';
			if ( (! file_exists($fileto)) AND (! file_exists($fileto2)) ) {
				chdir($truepath);

				if (!copy($filefrom, $fileto)) {
					echo "Не удалось скопировать файл";
				}
			
				if (!copy($filefrom2, $fileto2)) {
					echo "Не удалось скопировать файл";
				}


				$resProjData=DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='index'");
				$objProjData = DB::fetch_array($resProjData);
				$sqlfield = '';
				$sqlvalue = '';

				foreach ($objProjData as $key => $value) {
					if (!is_numeric($key)) {
						if ($key === 'id') {
						
						} else {
							if ($key === 'page') {
								if ($sqlfield === '') {
									$sqlfield = "`$key`";
									$sqlvalue = "'$val'";
								} else {
									$sqlfield .= ", `$key`";
									$sqlvalue .= ", '$val'";
								}
							} else {
								if ($sqlfield === '') {
									$sqlfield = "`$key`";
									$sqlvalue = "'$value'";
								} else {
									$sqlfield .= ", `$key`";
									$sqlvalue .= ", '$value'";
								}
							}
						}
					}
				}

				$sql = DB::query("INSERT INTO `new_project_data`($sqlfield) VALUES ($sqlvalue)");
				$namepagesite = $val; //Сами куки то не юзнет?
			} else {
				$error_page = "ERROR: Страница '$val' уже существует, попробуйте придумать другое имя!";
			}

			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">'.$nameheader.'</div>
					<div class="voronkaview '.$hidevoronka.'">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view '.$hidesite.'">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'addsite') {
			$strpath = $_SERVER['DOCUMENT_ROOT'];
			$durl = $val;

			//$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'; //.$name.'/'
			$truepage = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$durl.'/'; //.$name.'/'
			//chdir($truepath);
			$error_site = '';
			if (is_dir($truepage)) {
				$error_site = "ERROR: Имя '$durl' уже занято, попробуйте придумать другое имя!";
			} else {
				
				exit();
				
				//Получить durl
				//Здесь проверку на уникальность имени

				$sql = "INSERT INTO `new_project`(`durl`) VALUES ('$durl')";
				$res=DB::query($sql);
				$idproj = DB::insert_id();
				$sql = "INSERT INTO `new_project_user`(`id_project`, `id_user`) VALUES ('$id_project', '$id_user')";
				$res=DB::query($sql);
				$sql = "INSERT INTO `new_project_data`(`id_project`) VALUES ('$id_project')";
				$res=DB::query($sql);

				chdir($_SERVER['DOCUMENT_ROOT']);
				$shablon = "shablon";
				my_copy_all($shablon,$durl);

				//$result = "Сайт успешно добавлен";
				include('../tmp/mysites.php');
				include('../tmp/mypages.php');
				$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
						<div class="voronkaview hidden">';
							include('../tmp/voronka.php');
						$result .= '</div>
						<div class="site_view">';
							include('../tmp/page_crm.php');
						$result .= '</div>
					</div>';
			}				
		}

		if ($_POST['crmchange'] == 'additionlink') {
			if ( ($vals['addition'] == 'empty') or ($vals['link_addition'] == 'empty') ) {
				$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `addition`= NULL, `link_addition` = NULL WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			} else {
				$addition = $vals['addition'];
				$link_addition = $vals['link_addition'];
				$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `addition`='$addition', `link_addition`='$link_addition' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			}

			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'calendar') {
			$date = $hiddens['valcalendar'];
			$date = $date/1000;
			$date_mas = getdate($date);
			$datestr = date('Y-m-d H:i:s', $date);

			$ProjectDataUpdate=DB::query("UPDATE `new_zayavki` SET `lastcontact`=NOW(), `nextcontact`='$datestr' WHERE `id`='$id_zayavki'");

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$video = $CONSTS['video_zayavki'];
				$video_volume = $CONSTS['video_volume'];
				$unlock = 2;
				$zag = 'Входящие заявки';
				include ('../tmp/zayavki.php');
			} else {
				//include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'input') {
			if ( ($vals['inameru'] <> 'empty') AND ($vals['inameen'] <> 'empty') ) {
				$valru = $vals['inameru'];
				$valen = $vals['inameen'];
				$resDesc = DB::query("INSERT INTO `new_inputs`  (`name`, `ru_name`, `placeholder`)  VALUES ('$valen', '$valru', '$valru')");
				$id_inputs = DB::insert_id();
			} else {
				$id_inputs = $vals['iinput'];
			}
			
			$ProjectDataUpdate=DB::query("UPDATE `new_inputs_form`  SET `id_inputs`='$id_inputs' WHERE `id_form` = '$id_form'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'delplate') {
			$id_plate = $_POST['id'];
			$usedWordUpdate=DB::query("DELETE FROM `new_plates_user` WHERE `id_plates` = '$id_plate'");
			$usedWordUpdate=DB::query("DELETE FROM `new_plates` WHERE `id` = '$id_plate'");

			include('../tmp/page_crm.php');
		}

		if ($_POST['crmchange'] == 'csite') {
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'cpage') {
			$id_user = $_SESSION['market_'.$market]['id_user'];
			//$id_project = $_SESSION['market_'.$market]['id_project'];
			$namepagesite = $_POST['pagename'];
			$id_project = $_POST['numproj'];
			$market = $_POST['market'];
			//echo "$idproject $id_user $nameprojsite $namepagesite PROJ";
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';	
		}

		if ($_POST['crmchange'] == 'avoronka') {
			$pageid = $_POST['pageid'];
			$step = $_POST['stepnumb'];
			$prevstep = $step - 1;
			$nextstep = $step + 1;

			$was = array('');

			if ($step == 1) {
				$resvoronka=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$nextstep'");
				$check=DB::num_rows($resvoronka);
				if ($check==0) {
					$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `step`)  VALUES ('$id_project', '$pageid', '$step')");
				} else {
					while ($row = DB::fetch_array($resvoronka) ) {
						$nextproj = $row['id_project_data'];
						if (!in_array($nextproj, $was)) {
							$was[] = $nextproj;
							$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `id_project_data2`, `step`)  VALUES ('$id_project', '$pageid', '$nextproj', '$step')");
						}
					}
				}
			} else {
				$resvoronka=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$nextstep'");
				$check = DB::num_rows($resvoronka);
				if ($check == 0) {
					$resvoronka3=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$step'");
					$check=DB::num_rows($resvoronka3);
					if ($check == 0) {
						$resvoronka2=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$prevstep'");
						while ($row = DB::fetch_array($resvoronka2)) {
							$prevproj = $row['id_project_data'];
							$ProjectDataUpdate=DB::query("UPDATE `new_voronka`  SET `id_project_data2`='$pageid' WHERE `id_project` = '$id_project' AND `step`='$prevstep'");
						}
					} else {
						$resvoronka2=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$prevstep'");
						while ($row = DB::fetch_array($resvoronka2)) {
							$prevproj = $row['id_project_data'];
							if (!in_array($prevproj, $was)) {
								$was[] = $prevproj;
								$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `id_project_data2`, `step`)  VALUES ('$id_project', '$prevproj', '$pageid', '$prevstep')");
							}
						}
					}
					$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `step`)  VALUES ('$id_project', '$pageid', '$step')");
				} else {
					$resvoronka2=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$prevstep'");
					while ($row = DB::fetch_array($resvoronka2)) {
						$prevproj = $row['id_project_data'];
						if (!in_array($prevproj, $was)) {
							$was[] = $prevproj;
							$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `id_project_data2`, `step`)  VALUES ('$id_project', '$prevproj', '$pageid', '$prevstep')");
						}
					}

					unset($was);
					$was = array ('');

					$resvoronka3=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$step'");
					$check=DB::num_rows($resvoronka3);
					while ($row = DB::fetch_array($resvoronka3) ) {
						$nextproj = $row['id_project_data2'];
						if (!in_array($nextproj, $was)) {
							$was[] = $nextproj;
							$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `id_project_data2`, `step`)  VALUES ('$id_project', '$pageid', '$nextproj', '$step')");
						}
					}
				}
			}
			include('../tmp/voronka.php');
		}

		if ($_POST['crmchange'] == 'cvoronka') {
			$pageid = $_POST['pageid'];
			$step = $_POST['step'];
			$id_project = $_POST['siteproj'];
			$nextstep = $step + 1;
			$resvoronka=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$nextstep' LIMIT 1");
			$check=DB::num_rows($resvoronka);
			if ($check==0) {
				$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `step`)  VALUES ('$id_project', '$pageid', '$step')");
			} else {
				$row = DB::fetch_array($resvoronka);
				$nextproj = $row['id_project_data'];
				$resDesc = DB::query("INSERT INTO `new_voronka`  (`id_project`, `id_project_data`, `id_project_data2`, `step`)  VALUES ('$id_project', '$pageid', '$nextproj', '$step')");
			}

			include('../tmp/voronka.php');
		}

		if ($_POST['crmchange'] == 'dvoronka') {
			$pageid = $_POST['pageid'];
			$step = $_POST['stepnumb'];
			$prevstep = $step - 1;
			$nextstep = $step + 1;

			$resvoronka=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$nextstep'");
			$check=DB::num_rows($resvoronka);
			if ($check == 0) {
				$ProjectDataUpdate=DB::query("UPDATE `new_voronka`  SET `id_project_data2` = NULL WHERE `id_project_data2` = '$pageid' AND `step`='$prevstep'");
				//$resvoronka=DB::query("DELETE FROM `new_voronka` WHERE `step`='$prevstep' AND `id_project_data2`='$pageid'");
				$resvoronka=DB::query("DELETE FROM `new_voronka` WHERE `step`='$step' AND `id_project_data`='$pageid'");
			} else {
				$resvoronka=DB::query("SELECT * FROM `new_voronka` WHERE `step`='$step' GROUP BY `id_project_data`");
				$check=DB::num_rows($resvoronka);
				if ($check > 1) {
					//$ProjectDataUpdate=DB::query("UPDATE `new_voronka`  SET `id_project_data2` = NULL WHERE `id_project_data2` = '$pageid' AND `step`='$prevstep'");
					$resvoronka=DB::query("DELETE FROM `new_voronka` WHERE `step`='$prevstep' AND `id_project_data2`='$pageid'");
					$resvoronka=DB::query("DELETE FROM `new_voronka` WHERE `step`='$step' AND `id_project_data`='$pageid'");
				} else {
					$error = "Нельзя удалить единственный сайт в воронке на шаге: $step";
				}
			}
			include('../tmp/voronka.php');
		}

		if ($_POST['crmchange'] == 'id_desc') {
			//$id_project_data = $_SESSION['market_'.$market]['id_project_data'];
			
			if ($val == '') {
				$id_desc = '1';
			} else {
				$resDescs=DB::query("SELECT * FROM `new_descs` WHERE `value`='$val' ");
				$check=DB::num_rows($resDescs);
				if ($check==0) {
					$resDesc = DB::query("INSERT INTO `new_descs`  (`value`, `id_user`)  VALUES ('$val', '$id_user')");
					$id_desc=DB::insert_id();
				} else {
					$objDescs = DB::fetch_object($resDescs);
					$id_desc = $objDescs->id;
				}
			}
			
			$ProjectDataUpdate=DB::query("UPDATE `new_project_data`  SET `id_desc`='$id_desc' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'id_offer') {
			if ($val == '') {
				$id_offer = '1';
			} else {
				$resOffersMain=DB::query("SELECT * FROM `new_offers_main` WHERE BINARY `value`='$val' ");
				$check=DB::num_rows($resOffersMain);
				if ($check==0) {
					$resOffersInsert = DB::query("INSERT INTO `new_offers_main`  (`value`, `id_user`)  VALUES ('$val', '$id_user')");
					$id_offer=DB::insert_id();
				} else {
					$objOfferMain = DB::fetch_object($resOffersMain);
					$id_offer = $objOfferMain->id;
				}
			}
			$resOffersUpdate=DB::query("UPDATE `new_project_data`  SET `id_offer`='$id_offer' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'id_offer2') {
			if ($val == '') {
				$id_offer2 = '1';
			} else {
				$resOffersAdd=DB::query("SELECT * FROM `new_offers_add` WHERE `value`='$val' ");
				$check=DB::num_rows($resOffersAdd);
				if ($check==0) {
					$resOffersAddInsert = DB::query("INSERT INTO `new_offers_add`  (`value`, `id_user`)  VALUES ('$val', '$id_user')");
					$id_offer2 =DB::insert_id();
				} else {
					$objOffersAdd = DB::fetch_object($resOffersAdd);
					$id_offer2 = $objOffersAdd->id;
				}
			}
			$resOffersAddUpdate=DB::query("UPDATE `new_project_data`  SET `id_offer2`='$id_offer2' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'formtext') {
			if ($val == 'empty') {
				$id_form = '1';
			} else {
				$value_text = $val;
				$resForms=DB::query("SELECT * FROM `new_forms` WHERE `id`='".$id_form."'");
				$objForms = DB::fetch_object($resForms);
				$value_button = $objForms->value_button;

				$resInputsForm=DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form`='".$id_form."'");
				$objInputsForm = DB::fetch_object($resInputsForm);
				$id_inputs = $objInputsForm->id_inputs;				

				$resForms2=DB::query("SELECT * FROM `new_forms` WHERE `value_button`='$value_button' AND `value_text`='$value_text'");
				$check=DB::num_rows($resForms2);
				if ($check==0) {
					$resFormsInsert = DB::query("INSERT INTO `new_forms`  (`value_text`, `id_user`, `value_button`)  VALUES ('$value_text', '$id_user', '$value_button')");
					$id_form_ins =DB::insert_id();
					$resFormsInsert = DB::query("INSERT INTO `new_inputs_form`  (`id_form`, `id_inputs`)  VALUES ('$id_form_ins', '$id_inputs')");
				} else {
					$objForms = DB::fetch_object($resForms2);
					$id_form_ins = $objForms->id;
				}
			}
			$resForms2Update=DB::query("UPDATE `new_project_data`  SET `id_form`='$id_form_ins' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'button') {
			if ($val == 'empty') {
				$id_form = '1';
			} else {
				$value_button = $val;
				$resForms=DB::query("SELECT * FROM `new_forms` WHERE `id`='$id_form'");
				$objForms = DB::fetch_object($resForms);
				$value_text = $objForms->value_text;

				$resInputsForm=DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form`='$id_form'");
				$objInputsForm = DB::fetch_object($resInputsForm);
				$id_inputs = $objInputsForm->id_inputs;

				$resForms=DB::query("SELECT * FROM `new_forms` WHERE `value_button`='$val' AND `value_text`='$value_text'");
				$check=DB::num_rows($resForms);
				if ($check==0) {
					//$objDescs = DB::fetch_object($resdescs);
					$resDesc = DB::query("INSERT INTO `new_forms`  (`value_text`, `id_user`, `value_button`)  VALUES ('$value_text', '$id_user', '$value_button')");
					$id_form_ins =DB::insert_id();
					$resFormsInsert = DB::query("INSERT INTO `new_inputs_form`  (`id_form`, `id_inputs`)  VALUES ('$id_form_ins', '$id_inputs')");
				} else {
					$objForms = DB::fetch_object($resForms);
					$id_form_ins = $objForms->id;
				}
			}
			$resForms2Update=DB::query("UPDATE `new_project_data`  SET `id_form`='$id_form_ins' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'video') {
			if ($val == 'empty') {
				$val = NULL;
			}
			$resVideoUpdate=DB::query("UPDATE `new_project_data`  SET `video`='$val' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '
					<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ($_POST['crmchange'] == 'id_phone') {			
			if ($val == 'empty') { 
			} else {
				$strvr = $val;
				if (strrpos($strvr, ')')) {
					$strvr = preg_replace("/[^,.0-9]/", '', $strvr);
				}

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

				$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `numb`='$phoneNumb' AND `id_country`='$idPhonesCountry' AND `id_city`='$idPhonesCode'");
				$checkPhones=DB::num_rows($resultPhones);
				if ($checkPhones == 0) {
					$sql = DB::query("INSERT INTO `new_phones` (`numb`, `id_country`, `id_city`) VALUES ('$phoneNumb', '$idPhonesCountry', '$idPhonesCode')");
					$idPhones = DB::insert_id();
				} else {
					$objPhones = DB::fetch_object($resultPhones);
					$idPhones = $objPhones->id;
				}
			
				$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `id_phone`='$idPhones' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
			}

			include('../tmp/mysites.php');
			include('../tmp/mypages.php');
			$result .= '<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
					<div class="voronkaview hidden">';
						include('../tmp/voronka.php');
					$result .= '</div>
					<div class="site_view">';
						include('../tmp/page_crm.php');
					$result .= '</div>
				</div>';
		}

		if ( ($_POST['crmchange'] == 'bivk') OR ($_POST['crmchange'] == 'bivk2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bivk'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'address'){
			$val_country = $vals['icountry'];
			$val_region = $vals['iregion'];
			$val_city = $vals['icity'];
			$val_street = $vals['istreet'];
			$val_home = $vals['ihome'];
			$val_corpus = $vals['icorpus'];

			if ( ($val_country == 'empty') OR ($val_region == 'empty') OR ($val_city == 'empty') OR ($val_street == 'empty') OR ($val_home == 'empty') ) {
				$error = 'Поле не может быть пустым';
				if ($cookis['page'] == 'zayavki') { //WOTTAK
					$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
					$objZayavki = DB::fetch_object($zayavkiGet);
					$id_zayavki = $objZayavki->id;
					include ('../tmp/card.php');
					echo "<div class = \"promo z10\">";
					echo $result2;
					echo "</div>";
					exit();
				} else {
					include ('../tmp/login.php');
					exit();
				}
			}

			$noaddress = false;

			if ($val_corpus == 'empty') {
				$val_corpus = '';
			}
		
			$val_flat = $vals['iflat'];
			if ($val_flat == 'empty') {
				$val_flat = '';
			}

			$val_index = $vals['iindex'];
			if ($val_index == 'empty') {
				$val_index = '';
			}

			$resCountry = DB::query("SELECT * FROM `new_adress_country` WHERE `country`='$val_country'");
			$check = DB::num_rows($resCountry);
			if ($check > 0 ) {
				$objCountry = DB::fetch_object($resCountry);
				$id_country = $objCountry->id;
			} else { 
				$resDesc = DB::query("INSERT INTO `new_adress_country`  (`country`)  VALUES ('$val_country')");
				$id_country = DB::insert_id();
				$noaddress = true;
			}
			
			$resultRegion = DB::query("SELECT * FROM `new_adress_region` WHERE `region`='$val_region' AND `id_country` = '$id_country'" );
			$check = DB::num_rows($resultRegion); 
			if ($check > 0 ) {
				$objRegion = DB::fetch_object($resultRegion);
				$id_region = $objRegion->id;
			} else { 
				$resDesc = DB::query("INSERT INTO `new_adress_region`  (`region`,`id_country`)  VALUES ('$val_region','$id_country')");
				$id_region = DB::insert_id();
				$noaddress = true;
			}

			$resultCity = DB::query("SELECT * FROM `new_adress_city` WHERE `city`='$val_city' AND `id_region` = '$id_region'" );
			$check = DB::num_rows($resultCity); 
			if ($check > 0 ) {
				$objCity = DB::fetch_object($resultCity);
				$id_city = $objCity->id;
			} else { 
				$resDesc = DB::query("INSERT INTO `new_adress_city`  (`city`,`id_region`)  VALUES ('$val_city','$id_region')");
				$id_city = DB::insert_id();
				$noaddress = true;
			}

			$resultStreet = DB::query("SELECT * FROM `new_adress_street` WHERE `street`='$val_street' AND `id_city` = '$id_city'" );
			$check = DB::num_rows($resultStreet); 
			if ($check > 0 ) {
				$objStreet = DB::fetch_object($resultStreet);
				$id_street = $objStreet->id;
			} else { 
				$resDesc = DB::query("INSERT INTO `new_adress_street`  (`street`,`id_city`)  VALUES ('$val_street','$id_city')");
				$id_street = DB::insert_id();
				$noaddress = true;
			}

   			$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id_country`='$id_country' AND `id_regions` = '$id_region' AND `id_city` = '$id_city' AND `id_street` = '$id_street' AND `home` = '$val_home' AND `corpus` = '$val_corpus' AND `flat` = '$val_flat'");
			$check = DB::num_rows($resultAddress); 
			if ($check > 0 ) { 
				$objAddress = DB::fetch_object($resultAddress);
				$id_address = $objAddress->id;
			}  else {
				$noaddress = true;
			}

			if ($noaddress) {
				$resDesc = DB::query("INSERT INTO `new_adress`  (`id_country`,`id_regions`,`id_city`,`id_street`,`home`,`corpus`,`flat`, `index`)  VALUES ('$id_country','$id_region','$id_city','$id_street','$val_home','$val_corpus','$val_flat','$val_index')");
				$id_address = DB::insert_id();
			}

			/*echo "AD $id_address CO $val_country $val_region $val_city $val_street $val_home $val_corpus $val_flat $val_index";
			print_r($_POST);
			print_r($vals);
			print_r($hiddens);
			/**/

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$resuser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' ");
				$objUser = DB::fetch_array($resuser);
				if (!isset($objUser['id_user_info'])) {
					$resUserInfo = DB::query("INSERT INTO `new_user_info` (`id_adress`)  VALUES ('$id_address')");
					$id_user_info = DB::insert_id();
					$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$id_user_info' WHERE `id` = '$id_user'");
				} else {
					$id_user_info =	$objUser['id_user_info'];
					$updiduserinfo = DB::query("UPDATE `new_user_info`  SET `id_adress`='$id_address' WHERE `id` = '$id_user_info'");
				}
			} else { //PROJECT
				$resProject = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project'  AND `main`='1'");
				$check = DB::num_rows($resProject);
				if ($check > 0 ) { 
					$resultAddressProj = DB::query("UPDATE `new_address_project` SET `id_address`='$id_address' WHERE `id_project`='$id_project' AND `main`='1'");
				} else {
					$resultAddressProj = DB::query("INSERT INTO `new_address_project`  (`id_address`, `id_project`, `main`)  VALUES ('$id_address', '$id_project', '1')");
				}	
			}	

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'biyt') OR ($_POST['crmchange'] == 'biyt2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biyt'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'biok') OR ($_POST['crmchange'] == 'biok2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biok'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'bifb') OR ($_POST['crmchange'] == 'bifb2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bifb'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'bisk') OR ($_POST['crmchange'] == 'bisk2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bisk'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'bitm') OR ($_POST['crmchange'] == 'bitm2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='bitm'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;
			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ( ($_POST['crmchange'] == 'biws') OR ($_POST['crmchange'] == 'biws2') ) {
			$resSocialNet=DB::query("SELECT * FROM `new_social_network` WHERE `class`='biws'");
			$objSocialNet = DB::fetch_object($resSocialNet);
			$id_social_network = $objSocialNet->id;

			if ($cookis['page'] == 'zayavki') {
				$sqlSocLink = "AND `id_user`='$id_user'";
			} else {
				$sqlSocLink = "AND `id_project`='$id_project'";
			}

			$resSocialNet=DB::query("SELECT * FROM `new_social_links` WHERE `id_social_network`='$id_social_network' $sqlSocLink");
			$check = DB::num_rows($resSocialNet);
			if ($check > 0 ) { 
				if ($val == 'empty') { 
					$resSocialLink=DB::query("DELETE FROM `new_social_links`WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				} else {
					$resSocialLink=DB::query("UPDATE `new_social_links` SET `link`='$val' WHERE `id_social_network`='$id_social_network' $sqlSocLink");
				}
			} else { 
				if ($val == 'empty') { 
				
				} else {
					if ($cookis['page'] == 'zayavki') {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_user`)  VALUES ('$val', '$id_social_network', '$id_user')");
					} else {
						$resSocialLink = DB::query("INSERT INTO `new_social_links`  (`link`, `id_social_network`, `id_project`)  VALUES ('$val', '$id_social_network', '$id_project')");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'name') {
			$resuser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' ");
			$objUser = DB::fetch_array($resuser);
			$id_user_info = $objUser['id_user_info'];
			if (!isset($objUser['id_user_info'])) {
				if ($val == 'empty') {
				} else {
					$resDesc = DB::query("INSERT INTO `new_user_info`  (`name`)  VALUES ('$val')");
					$iduserinfo = DB::insert_id();
					$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
				}
			} else {
				if ($val == 'empty') { 
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `name`='' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`name`)  VALUES ('')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				} else {
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `name`='$val' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`name`)  VALUES ('$val')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'soname') {
			$resuser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' ");
			$objUser = DB::fetch_array($resuser);

			if (!isset($objUser['id_user_info'])) {
				if ($val == 'empty') {
				} else {
					$resDesc = DB::query("INSERT INTO `new_user_info`  (`soname`)  VALUES ('$val')");
					$iduserinfo = DB::insert_id();
					$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
				}
			} else {
				$id_user_info = $objUser['id_user_info'];
				
				if ($val == 'empty') { 
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `soname`='' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`soname`)  VALUES ('')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				} else {
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `soname`='$val' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`soname`)  VALUES ('$val')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				}
			}
			
			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'family') {
			$resuser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user' ");
			$objUser = DB::fetch_array($resuser);
			//echo "ID $id_user VAL $val"; 
			if (!isset($objUser['id_user_info'])) {
				if ($val == 'empty') {
				} else {
					$resDesc = DB::query("INSERT INTO `new_user_info`  (`family`)  VALUES ('$val')");
					$iduserinfo = DB::insert_id();
					$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
				}
			} else {
				$id_user_info = $objUser['id_user_info'];
				
				if ($val == 'empty') { 
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `family`='' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`family`)  VALUES ('')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				} else {
					$resUserInfo =DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
					$check=DB::num_rows($resUserInfo);
					if ($check>0) {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `family`='$val' WHERE `id` = '$id_user_info'");
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info`  (`family`)  VALUES ('$val')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users`  SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				}
			}

			if ($cookis['page'] == 'zayavki') { //WOTTAK
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'phone') { //ТУТ ПО ХОРОШЕМУ НАДО ЧЕРЕЗ ВВОД КОДА ВЕРИФИЦИРОВАТЬ ТЕЛЕФОН //Убрал Дублирование записей
			
			if ($val == 'empty') { 
			} else {
				if (strrpos($val, ')')) {
					$strvr = preg_replace("/[^,.0-9]/", '', $val);
				} else {
					$strvr = $val;
				}

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

				$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `numb`='$phoneNumb' AND `id_country`='$idPhonesCountry' AND `id_city`='$idPhonesCode'");
				$checkPhones=DB::num_rows($resultPhones);
				if ($checkPhones == 0) {
					$sql = DB::query("INSERT INTO `new_phones` (`numb`, `id_country`, `id_city`) VALUES ('$phoneNumb', '$idPhonesCountry', '$idPhonesCode')");
					$idPhones = DB::insert_id();
				} else {
					$objPhones = DB::fetch_object($resultPhones);
					$idPhones = $objPhones->id;
				}

				$usedWordUpdate=DB::query("UPDATE `new_users`  SET `phone`='$strvr', `id_phone`='$idPhones' WHERE `id`='$id_user'");
			}

			if ($cookis['page'] == 'zayavki') {
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'email') {
			if ($val == 'empty') { 
			} else {
				if ($cookis['page'] == 'sait') {
					$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `email`='$val' WHERE `id_project` = '$id_project' AND `page`='$pagename'");
				} else {
					$usedWordUpdate=DB::query("UPDATE `new_users`  SET `email`='$val' WHERE `id`='$id_user'");
				}
			}

			if ($cookis['page'] == 'zayavki') {
				//print_r($_POST);
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} elseif ($cookis['page'] == 'sait') {
				include('../tmp/mysites.php');
				include('../tmp/mypages.php');
				$result .= '
						<div class="pointer dib w100 headsitemenu voronka">АВТОВОРОНКА ПРОДАЖ</div>
						<div class="voronkaview hidden">';
							include('../tmp/voronka.php');
						$result .= '</div>
						<div class="site_view">';
							include('../tmp/page_crm.php');
						$result .= '</div>
					</div>';
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'company_name') {
			if ($val == 'empty') { 
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `company_name`='' WHERE `id`='$id_project'");
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `company_name`='$val' WHERE `id`='$id_project'");
			}
			include ('../tmp/login.php');
		}

		if ($_POST['crmchange'] == 'motto') {
			if ($val == 'empty') { 
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `motto`='' WHERE `id`='$id_project'");
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `motto`='$val' WHERE `id`='$id_project'");
			}
			include ('../tmp/login.php');
		}

		if ($_POST['crmchange'] == 'ogrn') {
			if ($val == 'empty') { 
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `ogrn`='' WHERE `id`='$id_project'");
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `ogrn`='$val' WHERE `id`='$id_project'");
			}
			include ('../tmp/login.php');
		}

		if ($_POST['crmchange'] == 'site') {
			if ($cookis['page'] == 'zayavki') {
				
				$resUser=DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
				$objUser = DB::fetch_object($resUser);

				if (!isset($objUser->id_user_info)) {
					if ($val == 'empty') {
					} else {
						$resDesc = DB::query("INSERT INTO `new_user_info` (`site`)  VALUES ('$val')");
						$iduserinfo = DB::insert_id();
						$updiduserinfo = DB::query("UPDATE `new_users` SET `id_user_info`='$iduserinfo' WHERE `id` = '$id_user'");
					}
				} else {
					$id_user_info = $objUser->id_user_info;
					if ($val == 'empty') { 
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `site`='' WHERE `id`='$id_user_info'");
					} else {
						$usedWordUpdate=DB::query("UPDATE `new_user_info`  SET `site`='$val' WHERE `id`='$id_user_info'");
					}
				}
			} else {
				if ($val == 'empty') { 
					$usedWordUpdate=DB::query("UPDATE `new_project`  SET `site`='' WHERE `id`='$id_project'");
				} else {
					$usedWordUpdate=DB::query("UPDATE `new_project`  SET `site`='$val' WHERE `id`='$id_project'");
				}
			}
			

			if ($cookis['page'] == 'zayavki') {
				$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' AND `id_user`='$id_user'"); //Релевантные
				$objZayavki = DB::fetch_object($zayavkiGet);
				$id_zayavki = $objZayavki->id;
				include ('../tmp/card.php');
				echo "<div class = \"promo z10\">";
				echo $result2;
				echo "</div>";
				exit();
			} else {
				include ('../tmp/login.php');
			}
		}

		if ($_POST['crmchange'] == 'about') {
			if ($val == 'empty') { 
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `about`='' WHERE `id`='$id_project'");
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_project`  SET `about`='$val' WHERE `id`='$id_project'");
			}
			include ('../tmp/login.php');
		}

		if ($_POST['crmchange'] == 'economic') {
			$srcheck = $vals['srcheck'];
			$marja = $vals['marja'];
			$rekbut = $vals['rekbut'];
			$con1 = $vals['con1'];
			$con2 = $vals['con2'];
			$costclick = round($srcheck*$marja*$rekbut*$con1*$con2, 2);
			//echo "$srcheck $marja $rekbut $con1 $con2 $costclick";
			$usedWordUpdate=DB::query("UPDATE `new_project`  SET `costclick`='$costclick', `srcheck`='$srcheck', `marja`='$marja', `rekbut`='$rekbut', `con1`='$con1', `con2`='$con2' WHERE `id`='$id_project'");
			include ('../tmp/login.php');	
		}

		if ($_POST['crmchange'] == 'worktime') { //СЛОЖНО, ВОЗМОЖНО В ДРУГОМ ВИДЕ??? КАК И ЭКОНОМИКА
			$time_s = explode(':', $vals['time_s']);
			$hour_s = $time_s[0];
			$minute_s = $time_s[1];
			$time_do = explode(':', $vals['time_do']);
			$hour_do = $time_do[0];
			$minute_do = $time_do[1];
			$day_s = $vals['worktime_s'];
			$day_po = $vals['worktime_po'];

			$resultWorktimeHours_s = DB::query("SELECT * FROM `new_worktime_hours` WHERE `hour`='$hour_s'");
			$objWorktimeHours_s = DB::fetch_object($resultWorktimeHours_s);
			$idWorktimeHours_s = $objWorktimeHours_s->id;

			$resultWorktimeHours_po = DB::query("SELECT * FROM `new_worktime_hours` WHERE `hour`='$hour_do'");
			$objWorktimeHours_po = DB::fetch_object($resultWorktimeHours_po);
			$idWorktimeHours_po = $objWorktimeHours_po->id;

			$resultWorktimeMin_s = DB::query("SELECT * FROM `new_worktime_min` WHERE `min`='$minute_s'");
			$objWorktimeMin_s = DB::fetch_object($resultWorktimeMin_s);
			$idWorktimeMin_s = $objWorktimeMin_s->id;			

			$resultWorktimeMin_po = DB::query("SELECT * FROM `new_worktime_min` WHERE `min`='$minute_do'");
			$objWorktimeMin_po = DB::fetch_object($resultWorktimeMin_po);
			$idWorktimeMin_po = $objWorktimeMin_po->id;

			$resultWorktime=DB::query("SELECT * FROM  `new_worktime`  WHERE `id_from_day`='$day_s' AND `id_to_day`='$day_po' AND `id_from_hour`='$idWorktimeHours_s' AND `id_to_hour`='$idWorktimeHours_po' AND `id_from_min`='$idWorktimeMin_s' AND `id_to_min`='$idWorktimeMin_po'");
			$check = DB::num_rows($resultWorktime);
			if ($check > 0) {
				$objWorktime = DB::fetch_object($resultWorktime);
				$id_worktime = $objWorktime->id;
			} else {
				$usedPhraseChange = DB::query("INSERT INTO `new_worktime`  (`id_from_day`, `id_to_day`, `id_from_hour`, `id_to_hour`, `id_from_min`, `id_to_min`) VALUES ('$day_s', '$day_po', '$idWorktimeHours_s', '$idWorktimeHours_po', '$idWorktimeMin_s', '$idWorktimeMin_po')");
				$id_worktime = DB::insert_id();
			}

			$resultWorktimeUser = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
			$check=DB::num_rows($resultWorktimeUser);
			if ($check == 0) {
				$usedWordUpdate = DB::query("INSERT INTO `new_worktime_user`  (`id_project`) VALUES ('$id_project')");
			} else {
				$usedWordUpdate=DB::query("UPDATE `new_worktime_user`  SET `id_worktime`='$id_worktime' WHERE `id_project`='$id_project'");
			}
			
			include ('../tmp/login.php');
		}

		/*if ($_POST['crmchange'] == 'avatar') {
			$id_project_data = $_SESSION['market_'.$market]['id_project_data'];
			$namepagesite = $_POST['pagename'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$id_project = $_POST['numproj'];
			$newval = $_POST['val'];
			$val = $_POST['val'];

			echo "TYTOT";
			include ('../tmp/login.php');
		

			if ($_FILES['file']['error'] == 0) {
				$fomats = array("jpg", "jpeg", "gif", "png");

				$format = @end(explode(".", strtolower($_FILES['file']['name'][0])));
				echo "$format";

				if (in_array($format, $fomats)) {
					
				} else {
					$result .= "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}*/
	}

	if (isset($_POST['word'])) {
		if ($_POST['word'] == 'minus'){
			$id = $_POST['id'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$usedWordGet=DB::query("SELECT * FROM `new_words_pre` WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			$check = DB::num_rows($usedWordGet);
			if ($check > 0) {
				$usedWordUpdate=DB::query("UPDATE `new_words_pre`  SET `status`='2' WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			}
		} elseif ($_POST['word'] == 'del'){
			$id = $_POST['id'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$usedWordGet=DB::query("SELECT * FROM `new_words_pre` WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			$check = DB::num_rows($usedWordGet);
			if ($check > 0) {
				$usedWordUpdate=DB::query("UPDATE `new_words_pre`  SET `status`='4' WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			}
		} elseif ($_POST['word'] == 'group'){
			$id = $_POST['id'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$usedWordGet=DB::query("SELECT * FROM `new_words_pre` WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			$check = DB::num_rows($usedWordGet);
			if ($check > 0) {
				$usedWordUpdate=DB::query("UPDATE `new_words_pre`  SET `status`='3' WHERE `id` = '$id' AND `id_project` = '$id_project' AND `id_user` = '$id_user'");
			}
		} else {
			$id = $_POST['word'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];
			$one = '';
			for ($i=0; $i < count($id); $i++) {
				$str = $id[$i];
				if ($one == '') {
					$one = "`phrase` LIKE '%$str%'";
				} else {
					$one .= "OR `phrase` LIKE '%$str%'";
				}
			}
			$prePhraseGet=DB::query("SELECT * FROM `new_phrases_pre` WHERE $one");
			$check = DB::num_rows($prePhraseGet);
			$result = $one;
			while ($row = DB::fetch_object($prePhraseGet)) {
				$result .= '<br>'.$row->phrase;
			}
		}
	}



	if (isset($_POST['phraseu'])) {
		$id = $_POST['id'];
		if ($_POST['phraseu'] == 'add'){
			
			$prePhraseGet=DB::query("SELECT * FROM `new_phrases` WHERE `id` = '$id' LIMIT 1");
			$check = DB::num_rows($prePhraseGet);
			if ($check > 0) {
				$objPre = DB::fetch_array($prePhraseGet);
				$id_user_add = $objPre['id_user_add'];
				$id_project = $objPre['id_project'];
				$phrase = $objPre['phrase_change'];
				$usedWordUpdate=DB::query("UPDATE `new_phrases_unic`  SET `status`='2' WHERE `id_phrase` = '$id'");

				$usedPhraseChange = DB::query("INSERT INTO `new_phrases_used`  (`id_user`, `id_project`, `id_phrase`, `phrase`)  VALUES ('$id_user_add', '$id_project', '$id', '$phrase')");
			}
			
		}
		if ($_POST['phraseu'] == 'del'){
			$usedWordUpdate=DB::query("UPDATE `new_phrases_unic`  SET `status`='3' WHERE `id_phrase` = '$id'");
		}

		if ($_POST['phraseu'] == 'fdel'){
			$usedWordUpdate=DB::query("UPDATE `new_phrases_unic`  SET `status`='4' WHERE `id_phrase` = '$id'");
		}

			$phrasesGet = DB::query("SELECT * FROM `new_phrases_unic` WHERE `status`='1' LIMIT 30");
			$check = DB::num_rows($phrasesGet);
			if ($check > 0 ) {

				$result = '<div class = "promo">
					<div class = "promoZag">Выберите подходящие фразы</div>
					<div class = "promoText">';		
				while ($row = DB::fetch_object($phrasesGet)) {
					$phrase = $row->changephrase;
					$id = $row->id_phrase;
					$result .= '<div style="display: block; padding-bottom: 5px;"><p style="display: inline-block; width: 320px; line-height: 30px; font-size: 1.2em;     color: gold;">'.$phrase.'</p><button style="display: inline-block; margin-left: 12px; width: 100px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="addphrase" id="addphrase_'.$id.'">Выбрать</button><button style="display: inline-block; margin-left: 12px; width: 100px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="delphrase" id="delphrase_'.$id.'">Удалить</button><button style="display: inline-block; margin-left: 12px; width: 100px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="fdelphrase" id="fdelphrase_'.$id.'">Не в тему</button></div>';
					$result .= '
			<script>
			$(function(){
				$("#addphrase_'.$id.'").one("click", function(e){
					e.preventDefault();
					$.ajax({
						url: "tmpl/obrabotka.php",
						type:"post",
						data: {phraseu: "add", id: "'.$id.'" },
						success:function(loader){
							$(this).unbind( "click" );
							$("#wrapper").html(loader);
						}
					});
					return false;
				});
				$("#delphrase_'.$id.'").one("click", function(e){
					e.preventDefault();
					$.ajax({
						url: "tmpl/obrabotka.php",
						type:"post",
						data: {phraseu: "del", id: "'.$id.'" },
						success:function(loader){
							$(this).unbind( "click" );
							$("#wrapper").html(loader);
						}
					});
					return false;
				});
				$("#fdelphrase_'.$id.'").one("click", function(e){
					e.preventDefault();
					$.ajax({
						url: "tmpl/obrabotka.php",
						type:"post",
						data: {phraseu: "fdel", id: "'.$id.'" },
						success:function(loader){
							$(this).unbind( "click" );
							$("#wrapper").html(loader);
						}
					});
					return false;
				});
			});
			</script>';
				}
				$result .=  "</div></div>";
				
			}
	}

	if (isset($_POST['phrase'])) {
		if ($_POST['phrase'] == 'add'){
			$id = $_POST['id'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];

			$prePhraseGet=DB::query("SELECT * FROM `new_phrases_pre` WHERE `id` = '$id' AND `project_id` = '$id_project'");
			$check = DB::num_rows($prePhraseGet);
			if ($check > 0) {
				$objPre = DB::fetch_object($prePhraseGet);
				$showswith = $objPre->stats;
				$phrasewith = $objPre->phrase;
				$idparent = $objPre->parent_id;

					$phrasevr = explode(' ', $phrasewith);
					sort($phrasevr);
					print_r($phrasevr);
					$phrasechange = '';
					for ($l=0; $l < count($phrasevr); $l++) { 
						if ($phrasechange == '') {
							$phrasechange = $phrasevr[$l];
						} else {
							$phrasechange .= ' '.$phrasevr[$l];
						}				
					}

				$PhraseGet=DB::query("SELECT * FROM `new_phrases` WHERE `phrase_change` = '$phrasechange'");
				$check = DB::num_rows($PhraseGet);
				if ($check == 0) {
					$strwith = "('$phrasewith', '$id_user', '$showswith', '$idparent', '$id_project', '$phrasechange')";
					
					$addwhit = DB::query("INSERT INTO `new_phrases`(`phrase`, `id_user_add`, `stats`, `id_parent`, `id_project`,  `phrase_change`) VALUES $strwith");
				}
				
				$prePhraseGet=DB::query("UPDATE `new_phrases_pre`  SET `status`='2' WHERE `id` = '$id' AND `project_id` = '$id_project'");
			}
 			$result .= '<div class = "promo">
				<div class = "promoZag">Выберите подходящие фразы</div>
				<div class = "promoText">';
			$prePhrase=DB::query("SELECT * FROM `new_phrases_pre` WHERE `status` = '1' LIMIT 30");
			$check = DB::num_rows($prePhrase);
			if ($check > 0) {
				while ($row = DB::fetch_object($prePhrase)) {
					$phrase = $row->phrase;
					$id = $row->id;
					$link = urldecode("https://wordstat.yandex.ru/#!/?words=$phrase");
					$result .= '<div style="display: block; padding-bottom: 5px;"><p style="display: inline-block; width: 320px; line-height: 30px; font-size: 1.2em;     color: gold;"><a style="color: gold;" href="'.$link.'" target="_blank">'.$phrase.'</a></p><button style="display: inline-block; margin-left: 12px; width: 150px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="send" id="phrase_'.$id.'">Выбрать</button><button style="display: inline-block; margin-left: 12px; width: 150px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="del" id="del_'.$id.'">Удалить</button></div>';
					$result .= '
	<script>
	$(function(){
		$("#phrase_'.$id.'").one("click", function(e){
			e.preventDefault();
			$.ajax({
				url: "tmpl/obrabotka.php",
				type:"post",
				data: {phrase: "add", id: "'.$id.'" },
				success:function(loader){
					$(this).unbind( "click" );
					$("#wrapper").html(loader);
				}
			});
			return false;
		});
		$("#del_'.$id.'").one("click", function(e){
			e.preventDefault();
			$.ajax({
				url: "tmpl/obrabotka.php",
				type:"post",
				data: {phrase: "del", id: "'.$id.'" },
				success:function(loader){
					$(this).unbind( "click" );
					$("#wrapper").html(loader);
				}
			});
			return false;
		});	
	});
	</script>';
				}
			} else {
				$result .= "<p>Пусто</p>";
			}
			$result .= '</div>
 			</div>';
		}

		if ($_POST['phrase'] == 'del'){
			$id = $_POST['id'];
			$id_project = $_SESSION['market_'.$market]['id_project'];
			$id_user = $_SESSION['market_'.$market]['id_user'];

			$prePhraseGet=DB::query("SELECT * FROM `new_phrases_pre` WHERE `id` = '$id' AND `project_id` = '$id_project'");
			$check = DB::num_rows($prePhraseGet);
			if ($check > 0) {
				$prePhraseGet=DB::query("UPDATE `new_phrases_pre`  SET `status`='3' WHERE `id` = '$id' AND `project_id` = '$id_project'");
			}
 			$result .= '<div class = "promo">
				<div class = "promoZag">Выберите подходящие фразы</div>
				<div class = "promoText">';
			$prePhrase=DB::query("SELECT * FROM `new_phrases_pre` WHERE `status` = '1' LIMIT 30");
			$check = DB::num_rows($prePhrase);
			if ($check > 0) {
				while ($row = DB::fetch_object($prePhrase)) {
					$phrase = $row->phrase;
					$id = $row->id;
					$link = urldecode("https://wordstat.yandex.ru/#!/?words=$phrase");
					$result .= '<div style="display: block; padding-bottom: 5px;"><p style="display: inline-block; width: 320px; line-height: 30px; font-size: 1.2em;     color: gold;"><a style="color: gold;" href="'.$link.'" target="_blank">'.$phrase.'</a></p><button style="display: inline-block; margin-left: 12px; width: 150px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="send" id="phrase_'.$id.'">Выбрать</button><button style="display: inline-block; margin-left: 12px; width: 150px; float: right; height: 30px; font-size: 1em;     background-color: gold;" name="del" id="del_'.$id.'">Удалить</button></div>';
					$result .= '
	<script>
	$(function(){
		$("#phrase_'.$id.'").one("click", function(e){
			e.preventDefault();
			$.ajax({
				url: "tmpl/obrabotka.php",
				type:"post",
				data: {phrase: "add", id: "'.$id.'" },
				success:function(loader){
					$(this).unbind( "click" );
					$("#wrapper").html(loader);
				}
			});
			return false;
		});
		$("#del_'.$id.'").one("click", function(e){
			e.preventDefault();
			$.ajax({
				url: "tmpl/obrabotka.php",
				type:"post",
				data: {phrase: "del", id: "'.$id.'" },
				success:function(loader){
					$(this).unbind( "click" );
					$("#wrapper").html(loader);
				}
			});
			return false;
		});	
	});
	</script>';
				}
			} else {
				$result .= "<p>Пусто</p>";
			}
			$result .= '</div>
 			</div>';
		}		
	}


	if (isset($result)) {
   		echo $result;
	}
}
?>