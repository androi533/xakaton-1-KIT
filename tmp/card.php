<?php
	$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id`='$id_zayavki'");
	$objZayavki = DB::fetch_object($zayavkiGet);
	$id_user = $objZayavki->id_user;
	$potreb = $objZayavki->potreb;
	$dataclient = $objZayavki->dataclient;

	if ($id_project == '1') {
		$table = 'users';
	} else {
		$table = 'clients';
	}
	$resultUser = DB::query("SELECT * FROM `new_$table` WHERE `id`='$id_user'");
	$objUser = DB::fetch_object($resultUser);

	if (isset($objUser->phone)) {
		$phone = $objUser->phone;
	}

	if (isset($objUser->email)) {
		$email = $objUser->email;
	}

	$name = 'Имя';
	$gray["name"] = ' gray';
	$family = 'Фамилия';
	$gray["family"] = ' gray';
	$soname = 'Отчество';
	$gray["soname"] = ' gray';
	$gray["site"] = 'bisite2';
	$gray["address"] = 'biaddress2';

	if (isset($objUser->id_user_info)) {
		$id_user_info = $objUser->id_user_info;
		$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
		$objUserInfo = DB::fetch_object($resultUserInfo);
		if (isset($objUserInfo->family)) {
			if ($objUserInfo->family <> '') {
				$family = $objUserInfo->family;
				$gray["family"] = '';
			}
		}
		if (isset($objUserInfo->name)) {
			if ($objUserInfo->name <> '') {
				$name = $objUserInfo->name;
				$gray["name"] = '';
			}
			
		}
		if (isset($objUserInfo->soname)) {
			if ($objUserInfo->soname <> '') {
				$soname = $objUserInfo->soname;
				$gray["soname"] = '';
			}
		}
		if (isset($objUserInfo->site)) {
			$gray["site"] = 'bisite';
		}
		if (isset($objUserInfo->id_adress)) {
			$gray["address"] = 'biaddress';
		}
	}

	if (isset($objUser->avatar)) {
		$avatar = $objUser->avatar;
	} else {
		$avatar = 'ava01.png';
		$backavatar = '../';
	}


$result2 .= '
		<div class = "menu_link tac lh22 fs15">'.$zagolovok.'</div>
		<div class="hidden" id="id_user">'.$id_user.'</div>
		<div class = "card">
			<div class="accFirst">
				<div class="accFirstIn">
					<div class="accAva casl">
						<div class="hidden value">avatar</div><img class="pointer accAvaImg" src="'.$backavatar.'img/'.$avatar.'">
					</div>
					<div class="accFio fs15">
						<div class="accP pointer ccacc db"><p class="'.$gray["family"].'">'.$family.'</p><div class="hidden value">family</div><div class="hidden id_user">'.$id_user.'</div></div>
						<div class="accP pointer ccacc db"><p class="'.$gray["name"].'">'.$name.'</p><div class="hidden value">name</div><div class="hidden id_user">'.$id_user.'</div></div>
						<div class="accP pointer ccacc db"><p class="'.$gray["soname"].'">'.$soname.'</p><div class="hidden value">soname</div><div class="hidden id_user">'.$id_user.'</div></div>
					</div>
					<div class="socBlock">';

					if ( (isset($phone)) AND ($phone <> '') ) {
						$result2 .= '<div class="socImg bicl pointer ccacc"><div class="hidden value">phone</div><div class="hidden id_user">'.$id_user.'</div></div>';
					} else {
						$result2 .= '<div class="socImg bicl2 pointer ccacc"><div class="hidden value">phone</div><div class="hidden id_user">'.$id_user.'</div></div>';
					}	

					if ( (isset($email)) AND ($email <> '') ) {
						$result2 .= '<div class="socImg biem pointer ccacc"><div class="hidden value">email</div><div class="hidden id_user">'.$id_user.'</div></div>';
					} else {
						$result2 .= '<div class="socImg biem2 pointer ccacc"><div class="hidden value">email</div><div class="hidden id_user">'.$id_user.'</div></div>';
					}
						
		$resultSocialLink = DB::query("SELECT * FROM `new_social_links` WHERE `id_user`='$id_user'");
		
			while ($objSocialLink = DB::fetch_object($resultSocialLink)) {
				$social_link = $objSocialLink->link;
				$idSocialNetworkLink = $objSocialLink->id_social_network;
				$social_links[$idSocialNetworkLink]['link'] = $social_link;
			}

			$resultSocialNetwork = DB::query("SELECT * FROM `new_social_network` WHERE 1");
			while ($objSocialNetwork= DB::fetch_object($resultSocialNetwork)) {
				$idSocialNetwork = $objSocialNetwork->id;
				$social_class = $objSocialNetwork->class;
				if (isset($social_links[$idSocialNetwork]['link'])) {
					$result2 .=  '<div class="socImg '.$social_class.' pointer ccacc"><div class="hidden value">'.$social_class.'</div><div class="hidden id_user">'.$id_user.'</div></div>';
				} else {
					$result2 .=  '<div class="socImg '.$social_class.'2 pointer ccacc"><div class="hidden value">'.$social_class.'</div><div class="hidden id_user">'.$id_user.'</div></div>';
				}
			}

	
			$result2 .=  '<div class="socImg '.$gray["address"].' pointer ccacc"><div class="hidden value">address</div><div class="hidden id_user">'.$id_user.'</div></div>';

			$result2 .=  '<div class="socImg '.$gray["site"].' pointer ccacc"><div class="hidden value">site</div><div class="hidden id_user">'.$id_user.'</div></div>';
	$result2 .= '
						<div class="m6">
							<textarea class="dib w100 h75 textfield box" id="potreb" placeholder="Потребность клиента">'.$potreb.'</textarea>
						</div>
						<div class="m6">
							<textarea class="dib w100 h75 textfield box" id="dataclient" placeholder="Полученные данные">'.$dataclient.'</textarea>
						</div>
					</div>
				</div>
			</div>
	';
	


	$result2 .= '
			<div class="accSecond">
				<div class="accSecondIn">
					<div class="mlr10 h100">
					
						<div class="salescript wh100 btbb">';
					
							$step = 1;
							include ("../tmp/salescript.php");
		$result2 .= '
						</div>
					</div>					
				</div>
			</div>
		</div>
	';
?>