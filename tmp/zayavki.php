<?php
	if ($market == 'directologplus') {
		$table = 'users';		
	} else {
		$table = 'clients';
	}
	$date = date("Y-m-d",time());
	$sql_zayavki = "`id_project`='$id_project' AND `nextcontact` IS NULL OR DATE_FORMAT(`nextcontact`, '%Y-%m-%d') BETWEEN '2018-01-01' AND '$date' ORDER BY `status` LIMIT 30";
	$disabled = 'disabled';
	$disabled2 = 'disabled="disabled"';
	$unlocktxt = 'unlock';

	if (isset($unlock)) {
		if ($unlock == 1) {
			$sql_zayavki = "`id`='$id_zayavki'";
			$disabled = '';
			$disabled2 = '';
			$unlocktxt = '';
		}
		if ($unlock == 2) {
			$sql_zayavki = "`id`='$id_zayavki'";
			$disabled = '';
			$disabled2 = '';
			$unlocktxt = '';
		}
	}

	$zayavkiGet = DB::query("SELECT * FROM `new_zayavki` WHERE $sql_zayavki"); //Релевантные
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
				$zayavka_email = $objUser->email;
				$zayavka_id_user_info = $objUser->id_user_info;
				$zayavka_refid = $objUser->refid; //Позже

				$callback = "";
				if ($zayavka_status == 1) { //Исправить конечно же либо схему статусов на 1 - тоже первичный, но без callback (заказа обратного звонка)
					$callback = ' biphone';
				}

				$resultZayavkiStatus = DB::query("SELECT * FROM `new_zayavki_status`");
				$statuss = '<select class="select_status vac pointer" '.$disabled2.'>';
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
						';
						if (isset($unlock)) {
							if ($unlock == 2) {
				$result .= '<div class="w128 h100 inline vat tac">
								<div class="vac bround pointer closecard">
									<div class="hidden value">closecard</div>
									<div class="hidden id_zayavki">'.$zayavka_id.'</div>
									<div class="dib lh40 fs2 mr14">
										<div class="vac">Завершить</div>
									</div>
									<div class="dib vat lh40">
										<div class="vac callback_status biphone"></div>
									</div>
								</div>
							</div>';
							}
						} else {
				$result .= '<div class="w26 h100 inline vat tac pb10">
								<div class="vac callback_status'.$callback.'"></div>
							</div>';
						}
				
				$result .= '
						<div class="w162 h100 inline vat tac">
							'.$statuss.'
						</div>
						<div class="w26 h100 inline vat tac pb10 cacc '.$disabled.'">
							<div class="hidden value">calendar</div>
							<div class="hidden id_zayavki">'.$zayavka_id.'</div>
							<div class=" callback_status bicalendar vac pointer"></div>
						</div>
						<div class="w26 h100 inline vat tac pb10 cacc '.$unlocktxt.'">
							<div class="hidden value">card</div>
							<div class="hidden id_zayavki">'.$zayavka_id.'</div>
							<div class=" callback_status bicard vac pointer"></div>
						</div>
						<div class="w300 h100 inline vat tar fr">
							<textarea class="vac wh100 comment textfield box" placeholder = "Комментарий" '.$disabled2.'">'.$zayavka_vremaddition.'</textarea>
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