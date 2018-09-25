<?php
$resultUser = DB::query("SELECT * FROM `new_users` WHERE `id`='$id_user'");
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
if (isset($objUser->id_user_info)) {
	$id_user_info = $objUser->id_user_info;
	$resultUserInfo = DB::query("SELECT * FROM `new_user_info` WHERE `id`='$id_user_info'");
	$objUserInfo = DB::fetch_object($resultUserInfo);
	if ( (isset($objUserInfo->family)) && ($objUserInfo->family<>'') ) {
		$family = $objUserInfo->family;
		$gray["family"] = '';
	}
	if (isset($objUserInfo->name)) {
		$name = $objUserInfo->name;
		$gray["name"] = '';
	}
	if (isset($objUserInfo->soname)) {
		$soname = $objUserInfo->soname;
		$gray["soname"] = '';
	}
}

if (isset($objUser->avatar)) {
	$avatar = $objUser->avatar;
} else {
	$avatar = 'ava01.png';
	$backavatar = '../';
}


$result .= '
	<div class = "promo">
		<div class = "account fs3">
			<div class="accFirst">
				<div class="accFirstIn">
					<div class="accAva cacc">
						<span class="hidden value">avatar</span><img class="pointer accAvaImg" src="'.$backavatar.'img/'.$avatar.'">
					</div>
					<div class="accFio">
						<p class="accP pointer cacc '.$gray["family"].'"><span class="hidden value">family</span>'.$family.'</p>
						<p class="accP pointer cacc '.$gray["name"].'"><span class="hidden value">name</span>'.$name.'</p>
						<p class="accP pointer cacc '.$gray["soname"].'"><span class="hidden value">soname</span>'.$soname.'</p>
					</div>
					<div class="socBlock">';

					if ( (isset($phone)) AND ($phone <> '') ) {
						$result .= '<div class="socImg bicl pointer cacc"><span class="hidden value">phone</span></div>';
					} else {
						$result .= '<div class="socImg bicl2 pointer cacc"><span class="hidden value">phone</span></div>';
					}	

					if ( (isset($email)) AND ($email <> '') ) {
						$result .= '<div class="socImg biem pointer cacc"><span class="hidden value">email</span></div>';
					} else {
						$result .= '<div class="socImg biem2 pointer cacc"><span class="hidden value">email</span></div>';
					}
						

	$resultSocialLink = DB::query("SELECT * FROM `new_social_links` WHERE `id_project`='$id_project'");
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
				$result .=  '<div class="socImg '.$social_class.' pointer cacc"><span class="hidden value">'.$social_class.'</span></div>';
			} else {
				$result .=  '<div class="socImg '.$social_class.'2 pointer cacc"><span class="hidden value">'.$social_class.'</span></div>';
			}
		}

	$result .= '
					</div>
				</div>
			</div>';

	$resultProject = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
	$objProj = DB::fetch_object($resultProject);

	$motto = $objProj->motto;
	if ($motto <> '') {
		$gray['motto'] = '';
	} else {
		$gray['motto'] = ' gray';
		$motto = 'Здесь мог быть Ваш девиз';
	}
	
	$company_name = $objProj->company_name;
	if ($company_name <> '') {
		$gray['company_name'] = '';
	} else {
		$gray['company_name'] = ' gray';
		$company_name = 'Здесь могло быть Ваше название компании';
	}

	$site = $objProj->site;
	if ($site <> '') {
		$gray['site'] = '';
	} else {
		$gray['site'] = ' gray';
		$site = 'Здесь могла быть Ваша ссылка на сайт';
	}

	$ogrn = $objProj->ogrn;
	if ($ogrn <> '') {
		$gray['ogrn'] = '';
	} else {
		$gray['ogrn'] = ' gray';
		$ogrn = 'Здесь мог быть Ваш ОГРН/ОГРНИП';
	}

	$about = $objProj->about;
	if ($about <> '') {
		$gray['about'] = '';
	} else {
		$gray['about'] = ' gray';
		$about = 'Здесь могло быть описание Вашей компании';
	}

	$resultAddressProj = DB::query("SELECT * FROM `new_address_project` WHERE `id_project`='$id_project' AND `main`='1'");
	$objAddressProj = DB::fetch_object($resultAddressProj);
	$id_address = $objAddressProj->id_address;

	$resultAddress = DB::query("SELECT * FROM `new_adress` WHERE `id`='$id_address'");
	$objAddress = DB::fetch_object($resultAddress);
	$id_city = $objAddress->id_city;
	$id_street = $objAddress->id_street;
	$home = $objAddress->home;
	$corpus = $objAddress->corpus;
	$flat = $objAddress->flat;

	$resultCity = DB::query("SELECT * FROM `new_adress_city` WHERE `id`='$id_city'");
	$objCity = DB::fetch_object($resultCity);
	$city = $objCity->city;

	$resultStreet = DB::query("SELECT * FROM `new_adress_street` WHERE `id`='$id_street'");
	$objStreet = DB::fetch_object($resultStreet);
	$street = $objStreet->street;

	$address = "$city, $street, $home $corpus $flat";

	$worktime = 'Режим работы';
				
	$result .= '
			<div class="accSecond">
				<div class="accSecondIn">
					<div class="pointer cacc"><div class="hidden value">company_name</div><p class="text4 fs15 '.$gray["company_name"].'">'.$company_name.'</p></div>
					<div class="pointer cacc"><div class="hidden value">motto</div><p class="text4 '.$gray["motto"].'">'.$motto.'</p></div>
					<div class="pointer cacc"><div class="hidden value">address</div><p class="text4 '.$gray["address"].'">'.$address.'</p></div>
					<div class="pointer cacc"><div class="hidden value">site</div><p class="text4 '.$gray["site"].'">'.$site.'</p></div>
					<div class="pointer cacc"><div class="hidden value">ogrn</div><p class="text4 '.$gray["ogrn"].'">'.$ogrn.'</p></div>
					<div class="pointer cacc"><div class="hidden value">about</div><p class="text4 '.$gray["about"].'">'.$about.'</p></div>
					<div class="pointer cacc"><div class="hidden value">worktime</div><p class="text4">'.$worktime.'</p></div>
					<div class="pointer cacc"><div class="hidden value">economic</div><p class="text4">Ставка за клик</p></div>
					<div class="pointer cacc"><div class="hidden value">region</div><p class="text4">Регион показа объявлений</p></div>
				</div>
			</div>
		</div>
	</div>';
?>