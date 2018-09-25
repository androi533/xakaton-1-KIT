<?php
	if ($market == 'directologplus') {
		$table = 'users';		
	} else {
		$table = 'clients';
	}

	$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE `id_project`='$id_project' ORDER BY `status` LIMIT 30"); //Релевантные
	$check = DB::num_rows($zayavkiGet);
	if ($check > 0 ) {

		$result .= '<div class = "mark promo">
						<div class = "videoZag">
							<div class="obolochka">
								<div class="centredv lh26 fs3">'.$zag.'</div>
							</div>
						</div>';
			$result .= '<div class="video">
							<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
						</div>';
			$result .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
			$result .= '
						<div class = "promoIn">';		
			while ($row = DB::fetch_object($zayavkiGet)) {
				//$phrase = $row->changephrase;
				$zayavka_id_user = $row->id_user;
				$zayavka_id = $row->id;
				$zayavka_id_project = $row->id_project;
				$zayavka_status = $row->status;
				$zayavka_vremaddition = $row->vremaddition;

				if ($zayavka_id_project == '1') {
					$table = 'users';
				} else {
					$table = 'clients';
				}

				$userGet = DB::query("SELECT * FROM `new_$table` WHERE `id`='$zayavka_id_user'");
				$objUser = DB::fetch_object($userGet);
				$zayavka_regdate = $objUser->regdate;
				$zayavka_id_phone = $objUser->id_phone;
				$zayavka_email = $objUser->email;
				$zayavka_id_user_info = $objUser->id_user_info;
				$zayavka_refid = $objUser->refid; //Позже

				$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `id`='$zayavka_id_phone'");
				$objPhones = DB::fetch_object($resultPhones);
				$idPhonesCountry = $objPhones->id_country;
				$idPhonesCode = $objPhones->id_city;
				$PhonesNumb = $objPhones->numb;

				$resultPhonesCode = DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$idPhonesCode'");
				$objPhonesCode = DB::fetch_object($resultPhonesCode);
				$PhonesCode = $objPhonesCode->value;

				$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$idPhonesCountry'");
				$objPhonesountry = DB::fetch_object($resultPhonesCountry);
				$PhonesCountry = $objPhonesountry->value;

				$phoneN = substr_replace($PhonesNumb, "-", 3, 0);
				$phoneN = substr_replace($phoneN, "-", 6, 0);
				$phoneG = '+'.$PhonesCountry.' ('.$PhonesCode.') '.$phoneN;

				$callback = "";
				if ($zayavka_status == 1) { //Исправить конечно же либо схему статусов на 1 - тоже первичный, но без callback (заказа обратного звонка)
					$callback = ' biphone pointer';
				}

				$resultZayavkiStatus = DB::query("SELECT * FROM `new_zayavki_status`");
				$statuss = '<select class="select_status vac pointer">';
				while ($objZayavkiStatus = DB::fetch_object($resultZayavkiStatus)) {
					$id_jZayavkiStatus = $objZayavkiStatus->id;
					$value_jZayavkiStatus = $objZayavkiStatus->value;
					$selected = "";
					if ($id_jZayavkiStatus == $zayavka_status) {
						$selected = " selected";
					}
					$statuss .= '<option value="'.$id_jZayavkiStatus.'"'.$selected.'>'.$value_jZayavkiStatus.'</option>';
				}
				$statuss .= '</select>';

				$result .= '
				<div class="pb6 lh26 h64 pt6 phraseline mw700">
					<div class="wh100">
						<div class="w26 h100 inline vat tac">
									<div class="vac callback_status'.$callback.'"></div>
						</div>
						<div class="w180 h100 inline vat">
									<div class="vac tac"><a href="tel:+'.$PhonesCountry.$PhonesCode.$PhonesNumb.'">'.$phoneG.'</a></div>
						</div>
						<div class="w162 h100 inline vat tac">
									'.$statuss.'
						</div>
						<div class="w26 h100 inline vat tac pb10">
									<div class=" callback_status biem vac pointer"></div>
						</div>
						<div class="w26 h100 inline vat tac pb10 cacc">
							<div class="hidden value">calendar</div>
							<div class="hidden id_zayavki">'.$zayavka_id.'</div>
									<div class=" callback_status bicalendar vac pointer"></div>
						</div>
						<div class="w26 h100 inline vat tac pb10 cacc">
							<div class="hidden value">card</div>
							<div class="hidden id_zayavki">'.$zayavka_id.'</div>
									<div class=" callback_status bicard vac pointer"></div>
						</div>
						<div class="w162 h100 inline vat tar fr mr9 ">
									<textarea class="vac h100 comment textfield box" placeholder = "Комментарий">'.$zayavka_vremaddition.'</textarea>
									<div class="hidden id_zayavki">'.$zayavka_id.'</div>
						</div>
					</div>
				</div>';
			}
		$result .= '</div></div>';
	} else {
		$result .= '<div class = "mark promo">';
	
		$result .= '	<div class = "videoZag">
							<div class="obolochka">
								<div class="centredv lh26">Нет заявок</div>
							</div>
						</div>';
		$result .= '</div>';
	}
?>