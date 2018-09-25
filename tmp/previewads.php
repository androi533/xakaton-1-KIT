<?php
	$phraseGet2 = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='index'");
	$row2 = DB::fetch_object($phraseGet2);
	$phoneG = $row2->phone;
	$phone = '+'.$phoneG;
	$phone = substr_replace($phone, " (", 2, 0);
	$phone = substr_replace($phone, ") ", 7, 0);
	$phone = substr_replace($phone, "-", 12, 0);
	$phone = substr_replace($phone, "-", 15, 0);

	$phraseGet31 = DB::query("SELECT * FROM `new_worktime_user` WHERE `id_project`='$id_project'");
	$row31 = DB::fetch_object($phraseGet31);
	$worktime_id_worktime = $row31->id_worktime;

	$phraseGet3 = DB::query("SELECT * FROM `new_worktime` WHERE `id`='$worktime_id_worktime'");
	$row3 = DB::fetch_object($phraseGet3);
	
	$worktime_id_from_day = $row3->id_from_day;
	$worktime_id_to_day = $row3->id_to_day;
	$worktime_id_from_hour = $row3->id_from_hour;
	$worktime_id_to_hour = $row3->id_to_hour;
	$worktime_id_from_min = $row3->id_from_min;
	$worktime_id_to_min = $row3->id_to_min;

	$phraseGet4 = DB::query("SELECT * FROM `new_worktime_days` WHERE `id`='$worktime_id_from_day'");
	$row4 = DB::fetch_object($phraseGet4);
	$worktime_from_day = $row4->value;

	$phraseGet5 = DB::query("SELECT * FROM `new_worktime_days` WHERE `id`='$worktime_id_to_day'");
	$row5 = DB::fetch_object($phraseGet5);
	$worktime_to_day = $row5->value;

	$phraseGet6 = DB::query("SELECT * FROM `new_worktime_hours` WHERE `id`='$worktime_id_from_hour'");
	$row6 = DB::fetch_object($phraseGet6);
	$worktime_from_hour = $row6->hour;

	$phraseGet7 = DB::query("SELECT * FROM `new_worktime_hours` WHERE `id`='$worktime_id_to_hour'");
	$row7 = DB::fetch_object($phraseGet7);
	$worktime_to_hour = $row7->hour;

	$phraseGet8 = DB::query("SELECT * FROM `new_worktime_min` WHERE `id`='$worktime_id_from_min'");
	$row8 = DB::fetch_object($phraseGet8);
	$worktime_from_min = $row8->min;

	$phraseGet9 = DB::query("SELECT * FROM `new_worktime_min` WHERE `id`='$worktime_id_to_min'");
	$row9 = DB::fetch_object($phraseGet9);
	$worktime_to_min = $row9->min;

	$worktime = $worktime_from_day.'-'.$worktime_to_day.' '.$worktime_from_hour.':'.$worktime_from_min.'-'.$worktime_to_hour.':'.$worktime_to_min;

	$phraseGet = DB::query("SELECT * FROM `new_phrases` WHERE `id`='$id_phrase'");
	$row = DB::fetch_object($phraseGet);
	$kz = $row->phrase;

	$result .= '<div class = "ads promo">
							<div class="poisk">
								<div class="forpoisk">
									<input class="poiskstr" type="search" name="query" placeholder="Поиск" value="'.$kz.'" disabled="disabled">
								</div>
								<div class="forbutton">
									<button class ="button_find pointer" type="submit">Найти</button>
									<img src="../img/strel.png" class ="button_find_arrow pointer">
								</div>
							</div>';

	$adsGet = DB::query("SELECT * FROM `new_ads` WHERE `id_phrase`='$id_phrase'");
	$check = DB::num_rows($adsGet);
	if ($check > 0 ) {
		while ($objAds = DB::fetch_object($adsGet)) {
			$id_ads = $objAds->id;
				$id_zag = $objAds->id_zag;
				$zagGet = DB::query("SELECT * FROM `new_ads_zag` WHERE `id`='$id_zag'");
				$objZag = DB::fetch_object($zagGet);
				$zagolovok1 = $objZag->zag;

				$id_zag2 = $objAds->id_zag2;
				$zag2Get = DB::query("SELECT * FROM `new_ads_zag2` WHERE `id`='$id_zag2'");
				$objZag2 = DB::fetch_object($zag2Get);
				$zagolovok2 = $objZag2->zag;

				$id_short = $objAds->id_short;
				$shortGet = DB::query("SELECT * FROM `new_ads_short_user` WHERE `id_user`='$id_user'");
				$objShort = DB::fetch_object($shortGet);
				$id_short = $objShort->id_short;
				$shortGet2 = DB::query("SELECT * FROM `new_ads_short` WHERE `id`='$id_short'");
				$objShort2 = DB::fetch_object($shortGet2);
				$shorttext = $objShort2->short;

				$id_cta = $objAds->id_cta;
				$ctaGet = DB::query("SELECT * FROM `new_ads_cta_user` WHERE `id_user`='$id_user'");
				$objCta = DB::fetch_object($ctaGet);
				$id_cta = $objCta->id_cta;
				$ctaGet = DB::query("SELECT * FROM `new_ads_cta` WHERE `id`='$id_cta'");
				$objCta = DB::fetch_object($ctaGet);
				$calltoaction = $objCta->value;

				//$id_utp = $objAds->id_utp;

				$id_deadline = $objAds->id_deadline;
				$deadlineGet = DB::query("SELECT * FROM `new_ads_deadline_user` WHERE `id_user`='$id_user'");
				$objDeadline = DB::fetch_object($deadlineGet);
				$id_deadline = $objDeadline->id_deadline;
				$deadlineGet = DB::query("SELECT * FROM `new_ads_deadline` WHERE `id`='$id_deadline'");
				$objDeadline = DB::fetch_object($deadlineGet);
				$deadline = $objDeadline->value;

				$id_fastlink = $objAds->id_fastlink;
				$descsUserGet = DB::query("SELECT * FROM `new_ads_fastlinks_user` WHERE `id_user`='$id_user'"); //Нет А/Б теста
				$objDescsUser = DB::fetch_object($descsUserGet);
				$groupDescsUser = $objDescsUser->id_fastlink_group;
				$descsGroupGet = DB::query("SELECT * FROM `new_ads_fastlinks_group` WHERE `id`='$groupDescsUser'");
				$objDescsGroup = DB::fetch_object($descsGroupGet);
				$strFastL = '';

				$id_fastlink1 = $objDescsGroup->id_fastlink1;
				if (isset($id_fastlink1)) {
					$descsGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fastlink1'");
					$objDescs = DB::fetch_object($descsGet);
					if ($strFastL == '') {
						$strFastL = '<div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink1.'</div><div class="hidden n_fastlink">1</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					} else {
						$strFastL .= '<div class="dib ml6 mr6">·</div><div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink1.'</div><div class="hidden n_fastlink">1</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					}
				} else {
					$strFastL .= '<div class="inline pointer ccacc dashed"><div class="hidden value">addfastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden n_fastlink">1</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>Добавить ссылку</div>';
				}

				$id_fastlink2 = $objDescsGroup->id_fastlink2;
				if (isset($id_fastlink2)) {
					$descsGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fastlink2'");
					$objDescs = DB::fetch_object($descsGet);
					if ($strFastL == '') {
						$strFastL = '<div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink2.'</div><div class="hidden n_fastlink">2</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					} else {
						$strFastL .= '<div class="dib ml6 mr6">·</div><div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink2.'</div><div class="hidden n_fastlink">2</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					}
				}

				$id_fastlink3 = $objDescsGroup->id_fastlink3;
				if (isset($id_fastlink3)) {
					$descsGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fastlink3'");
					$objDescs = DB::fetch_object($descsGet);
					if ($strFastL == '') {
						$strFastL = '<div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink3.'</div><div class="hidden n_fastlink">3</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					} else {
						$strFastL .= '<div class="dib ml6 mr6">·</div><div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink3.'</div><div class="hidden n_fastlink">3</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					}
				} else {
					$strFastL .= '<div class="inline pointer ccacc dashed"><div class="hidden value">addfastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden n_fastlink">1</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>Добавить ссылку</div>';
				}

				$id_fastlink4 = $objDescsGroup->id_fastlink4;
				if (isset($id_fastlink4)) {
					$descsGet = DB::query("SELECT * FROM `new_ads_fastlinks` WHERE `id`='$id_fastlink4'");
					$objDescs = DB::fetch_object($descsGet);
					if ($strFastL == '') {
						$strFastL = '<div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink4.'</div><div class="hidden n_fastlink">4</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					} else {
						$strFastL .= '<div class="dib ml6 mr6">·</div><div class="inline pointer ccacc"><div class="hidden value">fastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_fastlink">'.$id_fastlink4.'</div><div class="hidden n_fastlink">4</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>'.$objDescs->fastlink.'</div>';
					}
				} else {
					$strFastL .= '<div class="inline pointer ccacc dashed"><div class="hidden value">addfastlink</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden n_fastlink">1</div><div class="hidden gr_fastlink">'.$groupDescsUser.'</div>Добавить ссылку</div>';
				}

				$id_desc = $objAds->id_desc;
				$descsUserGet = DB::query("SELECT * FROM `new_ads_descs_user` WHERE `id_user`='$id_user'"); //Нет А/Б теста
				$objDescsUser = DB::fetch_object($descsUserGet);
				$groupDescsUser = $objDescsUser->group;
				$descsGroupGet = DB::query("SELECT * FROM `new_ads_descs_group` WHERE `group`='$groupDescsUser'");
				$strDescs = '';
				while ($objDescsGroup = DB::fetch_object($descsGroupGet)) {
					$id_desc_gr = $objDescsGroup->id_desc;
					$descsGet = DB::query("SELECT * FROM `new_ads_descs` WHERE `id`='$id_desc_gr'");
					$objDescs = DB::fetch_object($descsGet);
					$id_desc_value = $objDescs->id;
					if ($strDescs == '') {
						$strDescs = '<div class="inline pointer ccacc"><div class="hidden value">descs</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_desc">'.$id_desc_value.'</div>'.$objDescs->desc.'</div>';
					} else {
						$strDescs .= '<div class="dib ml6 mr6">·</div><div class="inline pointer ccacc"><div class="hidden value">descs</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_ads">'.$id_ads.'</div><div class="hidden id_desc">'.$id_desc_value.'</div>'.$objDescs->desc.'</div>';
					}
				}
				


				$id_vcard = $objAds->id_vcard;
				/*$shortGet = DB::query("SELECT * FROM `new_ads_short` WHERE `id`='$id_short'");
				$objShort = DB::fetch_object($shortGet);
				$shorttext = $objZag2->short;*/

				$siteurladd = $objAds->url_desc;
				$siteurl = $objAds->url;

				$icon = $protocol.'://'.$sitemain.'/'.$market.'/favicon.ico';

					$result .= '
							<div class="adscontent tal">
								 <div class="stroka1">
									<img border="0" src="'.$icon.'" width="16" height="16">
									 <div class="zagolovok1 inline pointer ccacc"><div class="hidden value">zagolovok1</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div>'.$zagolovok1.'</div>
									 <div class="inline">-</div>
									 <div class="zagolovok2 inline pointer ccacc"><div class="hidden value">zagolovok2</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag2.'</div>'.$zagolovok2.'</div>
								</div>
								<div class="stroka2">
									'.$strFastL.'
								</div>
								<div class="stroka3">
									<div class="inline stroka_3">'.$siteurl.'</div>
									<div class="inline">/</div>
									<div class="inline pointer ccacc"><div class="hidden value">desc</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div>'.$siteurladd.'</div>
								</div>
								<div class="stroka4">
									<div class="inline pointer ccacc"><div class="hidden value">textads</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div><div class="hidden id_short">'.$id_short.'</div><div class="hidden id_deadline">'.$id_deadline.'</div><div class="hidden id_cta">'.$id_cta.'</div>'.$shorttext.' '.$deadline.' '.$calltoaction.'</div>
								</div>
								<div class="stroka5">
									'.$strDescs.'
								</div>
								<div class="stroka6 ccacc"><div class="hidden value">id_vcard</div><div class="hidden id_phrase">'.$id_phrase.'</div><div class="hidden id_zag">'.$id_zag.'</div><div class="hidden id_vcard">'.$id_vcard.'</div>
									<div class="inline pointer">Контактная информация</div>·
									<div class="inline pointer">'.$phone.'</div>·
									<div class="inline pointer">'.$worktime.'</div>
								</div>
							</div>
						</div>';
		}
	}

	$result .= '</div>';
?>