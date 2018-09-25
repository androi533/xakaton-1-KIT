<?php
$error = '';

if (isset($_SESSION['id_user'])) {
	$id_user = $_SESSION['id_user'];
}

if (isset($_SESSION['timezone'])) {
	$timezone = $_SESSION['timezone'];
}

if(isset($_POST['addmission'])) {
	if (isset($_POST['mission'])) {
		$mission = $_POST['mission'];

		$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$mission' AND `id_user`='$id_user'");
		$check = DB::num_rows($resMissions);
		if ($check === 0) {
			$insMissions = DB::query("INSERT INTO `missions` SET `mission`='$mission', `id_user`='$id_user'");
		}
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['addpoint'])) {
	if (isset($_POST['event'])) {
		$event = $_POST['event'];
		if ($event <> '') {
			$datetime_inp = $_POST['datetime'];
			if (isset($_POST['datetimenumb'])) {
				if ($_POST['datetimenumb'] <> '') {
					$datetimenumb = $_POST['datetimenumb'];
				}
			}
			if (isset($_POST['datetimezone'])) {
				if ($_POST['datetimezone'] <> '') {
					$datetimezone = $_POST['datetimezone'];
				} else {
					$datetimezone = 3;
				}
			}
			$datetimenumb_my = $datetimenumb + $datetimezone * 60 * 60 - 3*60*60; //
			
			$date_future = strtotime("now") + (60 * 10); //-2*60*60


			/*$tzd = date_default_timezone_get();
			$tz = timezone_open( $tzd );
			$trs = timezone_transitions_get($tz);*/

			$datetime = date("Y-m-d H:i:s", $datetimenumb_my);
			$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
			//$dtc = date_create($datetime, $tz);
			//echo $dtc->getTimezone()->getName();
			//echo "<br>$date_future $datetimenumb $datetimenumb_my $datetimezone $datetime $datetime_inp $datetime_now<br>";
			//print_r($dtc);
			//exit();
			
			$resEvents = DB::query("SELECT * FROM `events` WHERE `event`='$event'");
			$check = DB::num_rows($resEvents);
			if ($check > 0) {
				$objEvent = DB::fetch_object($resEvents);
				$id_event = $objEvent->id;
			} else {
				$insEvents = DB::query("INSERT INTO `events`(`event`) VALUES ('$event')");
				$id_event = DB::insert_id();
			}

			$sqlDesc = '';
			if (isset($_POST['description'])) {
				$description = $_POST['description'];
				if ($description <> '') {
					//echo "$description";
					$resDescriptions= DB::query("SELECT * FROM `descriptions` WHERE `description`='$description'");
					$check = DB::num_rows($resDescriptions);
					if ($check > 0) {
						$objDescription = DB::fetch_object($resDescriptions);
						$id_description = $objDescription->id;
					} else {
						$insDescription = DB::query("INSERT INTO `descriptions`(`description`) VALUES ('$description')");
						$id_description = DB::insert_id();
					}

					if (isset($id_event) AND isset($id_description)) {
						$sqlDesc = ", `id_description`='$id_description'";
						/*$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_event`='$id_event' AND `id_description`='$id_description' AND `id_user`='$id_user'");
						$check = DB::num_rows($resLinkEventDescriptions);
						if ($check === 0) {
							$insLinkEventDescriptions = DB::query("INSERT INTO `link_event_descriptions` SET `id_event`='$id_event', `id_description`='$id_description', `id_user`='$id_user'");
						}*/

					}
				}
			}

			if ($date_future  > $datetimenumb) {
				//echo "now";
				$sql = "INSERT INTO `lifepoints` SET `id_user`='$id_user', `id_event`='$id_event'$sqlDesc, `start`='$datetime_now'";
				//echo "$sql";
				$insLifepoints = DB::query($sql);
			} else {
				//echo "future";
				$sql = "INSERT INTO `lifepoints` SET `id_user`='$id_user', `id_event`='$id_event'$sqlDesc, `start_plan`='$datetime'";
				//echo "$sql";
				$insLifepoints = DB::query($sql);
			}
		}
	}
	//exit();
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['change_mission'])) {
	if (isset( $_POST['id_mission'] )) {
		$id_mission = $_POST['id_mission'];
		if (is_numeric($id_mission)) {
			$resMissions = DB::query("SELECT * FROM `missions` WHERE `id`='$id_mission' AND `id_user`='$id_user'");
			$check = DB::num_rows($resMissions);
			if ($check > 0) {
				$date = date("Y-m-d",time());
				$objMission = DB::fetch_object($resMissions);
				$mission = $objMission->mission;

				$headline = 'Изменяемая цель';
				$button = 'цель';
				$placeholder = 'Изменить цель';
				$type = 'mission';

				echo '
				<div class="pf corner0 zi3 tac bgc1">
					<div class="wh100 ofo">
						<div class="">
							<div class="header h112 bgc2">
								<div class="vac">
									<p>'.$headline.'</p>
								</div>
							</div>
							<div class="db w100 lh52 btbb bgc2">
								<div class="vac">
									<p>'.$mission.'</p>
								</div>
							</div>
							<form method="post" class="db pr">
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<input type="text" name="'.$type.'" class="w100 p10 bgc1 helpenter" placeholder="'.$placeholder.'">
										<input type="hidden" name="old_mission" value="'.$mission.'">
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<button class="w100 p10 button bgca border3rad h36" name="update_'.$type.'" type="submit">Изменить '.$button.'</button>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10 bgc2">
									<div class="vac">
										<p>Установите дедлайн и начните двигаться к цели</p>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<input type="date" name="date" class="w100 p10 bgc1" placeholder="Дедлайн" value="'.$date.'">
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<button class="w100 p10 button bgca border3rad h36" name="now_'.$type.'" type="submit">Начать движение к цели</button>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10 bgc2">
									<div class="vac">
										<p>Ура! Я выполнил эту цель.</p>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<button class="w100 p10 button bgca border3rad h36" name="close_'.$type.'" type="submit">Завершить '.$button.'</button>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10 bgc2">
									<div class="vac">
										<p>Откладывать цель не лучшая идея</p>
									</div>
								</div>
								<div class="db w100 lh52 btbb mt10">
									<div class="vac">
										<button class="w100 p10 button bgca border3rad h36" name="tomorrow_'.$type.'" type="submit">Отложить '.$button.'</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				';
			}
		}
	}
}

if(isset($_POST['now_mission'])) {
	$mission = $_POST['old_mission'];
	$date = $_POST['date'];
	$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$mission' AND `id_user`='$id_user'");
	$check = DB::num_rows($resMissions);
	if ($check > 0) {
		if (isset($_SESSION['timezone'])) {
			if ($_SESSION['timezone'] <> '') {
				$datetimezone = $_SESSION['timezone'];
			} else {
				$datetimezone = 3;
			}
		}
		
		$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
		$updMissions = DB::query("UPDATE `missions` SET `status`='1', `date_start`= '$datetime_now', `date_deadline`= '$date' WHERE `mission`='$mission' AND `id_user`='$id_user'");
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['close_mission'])) {
	$mission = $_POST['old_mission'];
	$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$mission' AND `id_user`='$id_user' AND `datetime` IS NULL");
	$check = DB::num_rows($resMissions);
	if ($check > 0) {
		if (isset($_SESSION['timezone'])) {
			if ($_SESSION['timezone'] <> '') {
				$datetimezone = $_SESSION['timezone'];
			} else {
				$datetimezone = 3;
			}
		}

		$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
		$updMissions = DB::query("UPDATE `missions` SET `status`='2', `datetime`= '$datetime_now' WHERE `mission`='$mission' AND `id_user`='$id_user'");
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['tomorrow_mission'])) {
	$mission = $_POST['old_mission'];
	$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$mission' AND `status`='1' AND `id_user`='$id_user' AND `datetime` IS NULL");
	$check = DB::num_rows($resMissions);
	if ($check > 0) {
		if (isset($_SESSION['timezone'])) {
			if ($_SESSION['timezone'] <> '') {
				$datetimezone = $_SESSION['timezone'];
			} else {
				$datetimezone = 3;
			}
		}
		$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
		$updMissions = DB::query("UPDATE `missions` SET `status`='0', `datetime`= '$datetime_now' WHERE `mission`='$mission' AND `id_user`='$id_user'");
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['update_mission'])) {
	if (isset($_POST['mission'])) {
		if ($_POST['mission'] <> '') {
			$mission = $_POST['mission'];
			if (isset($_POST['old_mission'])) {
				if ($_POST['old_mission'] <> '') {
					$old_mission = $_POST['old_mission'];
					echo " M $mission $old_mission";
					$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$old_mission' AND `id_user`='$id_user'");
					$check = DB::num_rows($resMissions);
					if ($check > 0) {
						$objMission = DB::fetch_object($resMissions);
						$id_old_mission = $objMission->id;

						$resMissions = DB::query("SELECT * FROM `missions` WHERE `mission`='$mission' AND `id_user`='$id_user'");
						$check = DB::num_rows($resMissions);
						if ($check > 0) {
							$objMission = DB::fetch_object($resMissions);
							if (isset($_SESSION['timezone'])) {
								if ($_SESSION['timezone'] <> '') {
									$datetimezone = $_SESSION['timezone'];
								} else {
									$datetimezone = 3;
								}
							}
							$id_mission = $objMission->id;
							$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
							$updMissions = DB::query("UPDATE `missions` SET `status`='0', `datetime`= '$datetime_now' WHERE `id`='$id_old_mission' AND `id_user`='$id_user'");
						} else {
							$updMissions = DB::query("UPDATE `missions` SET `mission`='$mission' WHERE `id`='$id_old_mission' AND `id_user`='$id_user'");
						}
					}
				}
			}
		}
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['change_event'])) {
	if (isset($_POST['id_event'])) {
		if ($_POST['id_event'] <> '') {
			$id_event = $_POST['id_event'];
			$resEvents = DB::query("SELECT * FROM `events` WHERE `id`='$id_event'");
			$objEvent = DB::fetch_object($resEvents);
			$event = $objEvent->event;

			$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_user`='$id_user' AND `id_event`='$id_event'");
			$check = DB::num_rows($resLinkEventDescriptions);
			if ($check > 0) {
				$descs = array();
				while ($objLinkEventDescriptions = DB::fetch_object($resLinkEventDescriptions)) {
					$descs[] = $objLinkEventDescriptions->id_description;
				}
				$sqldescs = '';
				$or = '';
				echo "C ";

				for ($i=0; $i < count($descs); $i++) { 
					$id_description = $descs[$i];
					$sqldescs .= "$or`id`='$id_description'";
					$or = ' OR ';
				}
				echo $sqldescs;
				$textdesc = '';
				$resDescriptions= DB::query("SELECT * FROM `descriptions` WHERE $sqldescs");
				$check = DB::num_rows($resDescriptions);
				if ($check > 0) {
					while ($objDescription = DB::fetch_object($resDescriptions)) {
						$desc = $objDescription->description;
						$textdesc .= '
							<div class="db w100 lh52 btbb mt10">
								<div class="vac">
									<p>'.$desc.'</p>
								</div>
							</div>
							';
					}
				}
			}

			$headline = 'Изменяемое событие';
			$button = 'событие';
			$placeholder = 'Изменить событие';
			$type = 'event';

			echo '
			<div class="pf corner0 zi3 tac bgc1">
				<div class="wh100 ofo">
					<div class="">
						<div class="header h112 bgc2">
							<div class="vac">
								<p>'.$headline.'</p>
							</div>
						</div>
						<div class="db w100 lh52 btbb bgc2">
							<div class="vac">
								<p>'.$event.'</p>
							</div>
						</div>
						<form method="post" class="db pr">
							<div class="db w100 lh52 btbb mt10">
								<div class="vac">
									<input type="text" name="'.$type.'" class="w100 p10 bgc1 helpenter" placeholder="'.$placeholder.'">
									<input type="hidden" name="old_event" value="'.$event.'">
								</div>
							</div>
							<div class="db w100 lh52 btbb mt10">
								<div class="vac">
									<button class="w100 p10 button bgca border3rad h36" name="update_'.$type.'" type="submit">Изменить '.$button.'</button>
								</div>
							</div>
						</form>
						<div class="db w100 lh52 btbb bgc2">
							<div class="vac">
								<p>Список описаний</p>
							</div>
						</div>'.$textdesc.'
					</div>
				</div>
			</div>
			';
		}
	}
}

if(isset($_POST['update_event'])) {
	if (isset($_POST['old_event'])) {
		if ($_POST['old_event'] <> '') {
			$old_event = $_POST['old_event'];
			$resEvents = DB::query("SELECT * FROM `events` WHERE `event`='$old_event'");
			$checkOld = DB::num_rows($resEvents);
			if ($checkOld > 0) {
				$objEvent = DB::fetch_object($resEvents);
				$id_old_event = $objEvent->id;
				$id_impact = $objEvent->id_impact;
				$id_type = $objEvent->id_type;
			}

			if (isset($_POST['event'])) {
				if ($_POST['event'] <> '') {
					$event = $_POST['event'];
					if ($checkOld > 0) {
						$resEvents = DB::query("SELECT * FROM `events` WHERE `event`='$event'");
						$check = DB::num_rows($resEvents);
						if ($check > 0) {
							$objEvent = DB::fetch_object($resEvents);
							$id_event = $objEvent->id;
						} else {
							$insEvents = DB::query("INSERT INTO `events`(`event`, `id_impact`, `id_type`) VALUES ('$event', '$id_impact', '$id_type')");
							$id_event = DB::insert_id();
						}
						$resLinkEventDescriptions = DB::query("UPDATE `link_event_descriptions` SET `id_event`='$id_event' WHERE `id_event`='$id_old_event' AND `id_user`='$id_user'");
						$resLinkEventDescriptions = DB::query("UPDATE `lifepoints` SET `id_event`='$id_event' WHERE `id_event`='$id_old_event' AND `id_user`='$id_user'");
					}
				}
			}
		}
	}
	
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['closepointwindow'])) {
	$id_lifepoint = $_POST['id_lifepoint'];

	$resLifepoints = DB::query("SELECT * FROM `lifepoints` WHERE `id_user`='$id_user' AND `id`='$id_lifepoint'");
	$objLifepoint = DB::fetch_object($resLifepoints);
	$id_event = $objLifepoint->id_event;

	$resEvents = DB::query("SELECT * FROM `events` WHERE `id`='$id_event'");
	$objEvent = DB::fetch_object($resEvents);
	$event = $objEvent->event;
	$id_impact_event = '1';
	$id_type_event = '1';
	if (isset($objEvent->id_impact)) {
		$id_impact_event = $objEvent->id_impact;
	}
	if (isset($objEvent->id_type)) {
		$id_type_event = $objEvent->id_type;
	}

	$description = '';
	$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
	$check = DB::num_rows($resLinkEventDescriptions);
	if ($check > 0) {
		while ($objLinkEventDescriptions = DB::fetch_object($resLinkEventDescriptions)) {
			$id_description = $objLinkEventDescriptions->id_description;
			$descriptions[] = $id_description;
		}

		$resDescriptions = DB::query("SELECT * FROM `descriptions` WHERE `id`='$id_description'");
		$objDescriptions = DB::fetch_object($resDescriptions);
		$description = $objDescriptions->description;
	}

	$resImpacts = DB::query("SELECT * FROM `impacts`");
	$textImpact = 	'<div class="db w100 lh52 mt10 btbb p10_0">
						<div class="vac">';
	$checked = 'checked="checked"';
	while ($objImpacts = DB::fetch_object($resImpacts)) {
		$impact = $objImpacts->impact;
		$id_impact = $objImpacts->id;
		if ($id_impact_event == $id_impact) {
			$textImpact .= '<div class="w224 dib mlr10"><label><input class="border3rad p10 dib" name="impact" type="radio" value="'.$id_impact.'" '.$checked.'><p>'.$impact.'</p></label></div>';
		} else {
			$textImpact .= '<div class="w224 dib mlr10"><label><input class="border3rad p10 dib" name="impact" type="radio" value="'.$id_impact.'"><p>'.$impact.'</p></label></div>';
		}
	}
	$textImpact .= 		'</div>
					</div>';

	$resTypes = DB::query("SELECT * FROM `types`");
	$textType = 	'<div class="db w100 lh52 mt10 btbb p10_0">
						<div class="vac">';
	while ($objTypes = DB::fetch_object($resTypes)) {
		$type = $objTypes->type;
		$id_type = $objTypes->id;
		if ($id_type_event == $id_type) {
			$textType .= '<div class="w224 dib mlr10"><label><input class="border3rad p10 dib" name="type" type="radio" value="'.$id_type.'" '.$checked.'><p>'.$type.'</p></label></div>';
		} else {
			$textType .= '<div class="w224 dib mlr10"><label><input class="border3rad p10 dib" name="type" type="radio" value="'.$id_type.'"><p>'.$type.'</p></label></div>';
		}
	}
	$textType .= 		'</div>
					</div>';

	$mission = '';
	$textMission = 	'<div class="db w100 lh52 mt10 btbb">
						<div class="vac">';
	$select = '<select name="missions" class="promo_select bgc1 tac pointer">';
	$selected = 'selected="selected"';
	$id_mission_event = '0';
	$resLinkMissionEvents = DB::query("SELECT * FROM `link_mission_events` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
	$check = DB::num_rows($resLinkMissionEvents);
	if ($check > 0) {
		$objLinkMissionEvents = DB::fetch_object($resLinkMissionEvents);
		$id_mission_event = $objLinkMissionEvents->id_mission;
	}
	if ($id_mission_event === '0') {
		$select .= '<option value="0" class="bgca" '.$selected.'>Нет цели</option>';
	} else {
		$select .= '<option value="0">Нет цели</option>';
	}
	
	$resMissions = DB::query("SELECT * FROM `missions` WHERE `id_user`='$id_user'");
	$check = DB::num_rows($resMissions);
	if ($check > 0) {
		while ($objMission = DB::fetch_object($resMissions)) {
			$id_mission = $objMission->id;
			$mission = $objMission->mission;
			if ($id_mission_event == $id_mission) {
				$select .= '<option value="'.$id_mission.'" class="bgca" '.$selected.'>'.$mission.'</option>';
			} else {
				$select .= '<option value="'.$id_mission.'">'.$mission.'</option>';
			}
		}
	} else {
		$select = '';
		$textMission .= '<div class="w100 dib mlr10"><p>У меня нет цели... Я не знаю чего я хочу... Разве это правда?</p></div>';
	}
	$select .= '</select>';
	$textMission .= 	$select.'</div>
					</div>';

	echo 
	'<div class="pf corner zi3 tac bgc1">
		<div class="wh100">
			<div class="vac">
				<div class="header h112 bgc2">
					<div class="vac">
						<p>Анализ завершенного события</p>
					</div>
				</div>
				<div class="db w100 lh52 btbb bgc2">
					<div class="vac">
						<p>'.$event.'</p>
					</div>
				</div>
				<form method="post" class="db pr">
					<div class="db w100 lh52 mt10">
						<div class="vac">
							<textarea name="description" class="w100 p10 btbb bgc1 helpenter" placeholder="Подробное описание: что именно, какие мысли, какое личное отношение, какое настроение">'.$description.'</textarea>
						</div>
					</div>'.$textImpact.$textType.$textMission.'
					<input type="hidden" name="id_lifepoint" value="'.$id_lifepoint.'">
					<div class="db w100 lh52 mt10">
						<div class="vac">
							<button class="w100 p10 button bgca border3rad" name="closepoint" type="submit">Завершить</button>
						</div>
					</div>
					<div class="db w100 lh52 mt10">
						<div class="vac">
							<button class="w100 p10 button bgca border3rad" name="updatepoint" type="submit">Ой, ещё не завершил</button>
							
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>';
}
//<a class="w100 border3rad p10 button bgca" href="'.$protocol.'://'.$sitemain.'/lifepoint/">Ой, ещё не завершил</a>
if(isset($_POST['updatepoint'])) {
	$id_lifepoint = $_POST['id_lifepoint'];
	$id_impact = $_POST['impact'];
	$id_type = $_POST['type'];
	if (isset($_POST['missions'])) {
		$id_mission = $_POST['missions'];
	} else {
		$id_mission = 0;
	}

	if (isset($_POST['description'])) {
		$description = $_POST['description'];

		$resDescriptions = DB::query("SELECT * FROM `descriptions` WHERE `description`='$description'");
		$check = DB::num_rows($resDescriptions);
		if ($check > 0) {
			$objDescriptions = DB::fetch_object($resDescriptions);
			$id_description = $objDescriptions->id;
		} else {
			$resDescriptions = DB::query("INSERT INTO `descriptions` SET `description`='$description'");
			$id_description = DB::insert_id();
		}
	}

	$resLifepoints = DB::query("SELECT * FROM `lifepoints` WHERE `id`='$id_lifepoint' AND `id_user`='$id_user'");
	$objLifepoint = DB::fetch_object($resLifepoints);
	$id_event = $objLifepoint->id_event;
	$resEvents = DB::query("UPDATE `events` SET `id_impact`='$id_impact', `id_type`='$id_type' WHERE `id`='$id_event'");

	if ($id_mission <> 0) {
		$resLinkMissionEvents = DB::query("SELECT * FROM `link_mission_events` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
		$check = DB::num_rows($resLinkMissionEvents);
		if ($check === 0) {
			$insLinkMissionEvents = DB::query("INSERT INTO `link_mission_events` SET `id_event`='$id_event', `id_mission`='$id_mission', `id_user`='$id_user'");
		} else {
			$objLinkMissionEvents = DB::fetch_object($resLinkMissionEvents);
			$id_mission_event = $objLinkMissionEvents->id_mission;
			if ($id_mission <> $id_mission_event) {
				$insLinkMissionEvents = DB::query("UPDATE `link_mission_events` SET `id_mission`='$id_mission' WHERE `id_event`='$id_event', `id_user`='$id_user'");
			}
		}
	}

	$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_event`='$id_event' AND `id_description`='$id_description' AND `id_user`='$id_user'");
	$check = DB::num_rows($resLinkEventDescriptions);
	if ($check === 0) {
		$resLinkEventDescriptions = DB::query("INSERT INTO `link_event_descriptions` SET `id_event`='$id_event', `id_description`='$id_description', `id_user`='$id_user'");
	}
	
	//$updLifepoints = DB::query("UPDATE `lifepoints` SET `end`='$datetimezone' WHERE `id`='$id_lifepoint' AND `id_user`='$id_user'");

	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['closepoint'])) {
	$id_lifepoint = $_POST['id_lifepoint'];
	$id_impact = $_POST['impact'];
	$id_type = $_POST['type'];
	if (isset($_POST['missions'])) {
		$id_mission = $_POST['missions'];
	} else {
		$id_mission = 0;
	}

	if (isset($_POST['description'])) {
		$description = $_POST['description'];

		$resDescriptions = DB::query("SELECT * FROM `descriptions` WHERE `description`='$description'");
		$check = DB::num_rows($resDescriptions);
		if ($check > 0) {
			$objDescriptions = DB::fetch_object($resDescriptions);
			$id_description = $objDescriptions->id;
		} else {
			$resDescriptions = DB::query("INSERT INTO `descriptions` SET `description`='$description'");
			$id_description = DB::insert_id();
		}
	}

	$resLifepoints = DB::query("SELECT * FROM `lifepoints` WHERE `id`='$id_lifepoint' AND `id_user`='$id_user'");
	$objLifepoint = DB::fetch_object($resLifepoints);
	$id_event = $objLifepoint->id_event;
	$resEvents = DB::query("UPDATE `events` SET `id_impact`='$id_impact', `id_type`='$id_type' WHERE `id`='$id_event'");

	if ($id_mission <> 0) {
		$resLinkMissionEvents = DB::query("SELECT * FROM `link_mission_events` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
		$check = DB::num_rows($resLinkMissionEvents);
		if ($check === 0) {
			$insLinkMissionEvents = DB::query("INSERT INTO `link_mission_events` SET `id_event`='$id_event', `id_mission`='$id_mission', `id_user`='$id_user'");
		} else {
			$objLinkMissionEvents = DB::fetch_object($resLinkMissionEvents);
			$id_mission_event = $objLinkMissionEvents->id_mission;
			if ($id_mission <> $id_mission_event) {
				$insLinkMissionEvents = DB::query("UPDATE `link_mission_events` SET `id_mission`='$id_mission' WHERE `id_event`='$id_event', `id_user`='$id_user'");
			}
		}
	}

	$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_event`='$id_event' AND `id_description`='$id_description' AND `id_user`='$id_user'");
	$check = DB::num_rows($resLinkEventDescriptions);
	if ($check === 0) {
		$resLinkEventDescriptions = DB::query("INSERT INTO `link_event_descriptions` SET `id_event`='$id_event', `id_description`='$id_description', `id_user`='$id_user'");
	}

	if (isset($_SESSION['timezone'])) {
		if ($_SESSION['timezone'] <> '') {
			$datetimezone = $_SESSION['timezone'];
		} else {
			$datetimezone = 3;
		}
	}

	$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
	$updLifepoints = DB::query("UPDATE `lifepoints` SET `end`='$datetime_now' WHERE `id`='$id_lifepoint' AND `id_user`='$id_user'");

	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['autorize'])) {
	if ( (isset($_POST['login'])) AND (isset($_POST['password'])) ) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		$resUsers = DB::query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");
		$check = DB::num_rows($resUsers);
		if ($check > 0) {
			$objUsers = DB::fetch_object($resUsers);
			$_SESSION['id_user'] = $objUsers->id;
			print_r($_SESSION);
		} else {
			$error = 'Такого пользователя нет, либо не верный пароль!';
		}
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if(isset($_POST['exit'])) {
	unset($_SESSION['id_user']);
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if (isset($_GET['lifepoint'])) {
	$id_lifepoint = $_GET['lifepoint'];
	if ($id_lifepoint <> '') {
		if (isset($_SESSION['timezone'])) {
			if ($_SESSION['timezone'] <> '') {
				$datetimezone = $_SESSION['timezone'];
			} else {
				$datetimezone = 3;
			}
		}
		$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
		$updLifepoints = DB::query("UPDATE  `lifepoints` SET `start`='$datetime_now' WHERE `id`='$id_lifepoint'");
	}

	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}

if (isset($_GET['event'])) {
	$id_event = $_GET['event'];
	if ($id_event <> '') {
		if (isset($_SESSION['timezone'])) {
			if ($_SESSION['timezone'] <> '') {
				$datetimezone = $_SESSION['timezone'];
			} else {
				$datetimezone = 3;
			}
		}

		$datetime_now = date("Y-m-d H:i:s", strtotime("now") + $datetimezone * 60 * 60 - 3*60*60);
		
		$insLifepoints = DB::query("INSERT INTO `lifepoints`(`id_user`, `id_event`, `start`) VALUES ('$id_user', '$id_event', '$datetime_now')");
	}

	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/');
}
?>
<!--label for="super-happy">
	<input type="radio" name="rating" class="super-happy" id="super-happy" value="super-happy" />
	<svg viewBox="0 0 24 24"><path d="M12,17.5C14.33,17.5 16.3,16.04 17.11,14H6.89C7.69,16.04 9.67,17.5 12,17.5M8.5,11A1.5,1.5 0 0,0 10,9.5A1.5,1.5 0 0,0 8.5,8A1.5,1.5 0 0,0 7,9.5A1.5,1.5 0 0,0 8.5,11M15.5,11A1.5,1.5 0 0,0 17,9.5A1.5,1.5 0 0,0 15.5,8A1.5,1.5 0 0,0 14,9.5A1.5,1.5 0 0,0 15.5,11M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" /></svg>
</label-->
<? if (isset($_SESSION['id_user'])) { $id_user = $_SESSION['id_user'];?>
<div class="cont tac">
	<script type="text/javascript" src="<? echo $protocol.'://'.$sitemain.'/lifepoint/tagcloud/swfobject.js';?>"></script>
	<? 
		$resMissions = DB::query("SELECT * FROM `missions` WHERE `id_user`='$id_user' AND `status`='1'");
		$check = DB::num_rows($resMissions);
		if ($check > 0) { 
	?>
			<div class="db w100 lh52 btbb mt10 bgc2 showwindow pointer">
				<div class="hidden">mission</div>
				<div class="vac">
					<p>Мои цели</p>
				</div>
			</div>
			<?php
				$minFontSize = 12;
				$maxFontSize = 28;
				$dFontSize = $maxFontSize - $minFontSize + 1;
				$fontsize = 16;
				$tags = '<tags>';
				$lis = '<ul>';
					//$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_user`='$id_user'");
				while ($objMissions = DB::fetch_object($resMissions)) {
					$mission = $objMissions->mission;
					$tags .= '<a style="font-size: '.$fontsize.'pt">'.$mission.'</a>';
					$lis .= '<li><a class="tc2" onclick="return false" style="font-size: '.$fontsize.'pt; pointer-events: none;">'.$mission.'</a></li>';
				}
				$tags .= '</tags>';
				$lis .= '</ul>';
				?>
				<div id="tagcloudmission" class="tagcloud">
					<script type="text/javascript">
						var rnumber = Math.floor(Math.random()*99);
						var widget_so = new SWFObject("<? echo $protocol.'://'.$sitemain.'/lifepoint/tagcloud/tagcloud.swf?r=';?>"+rnumber,"tagcloudflash", "978", "150", "9");
						widget_so.addParam("wmode", "transparent");
						widget_so.addParam("allowScriptAccess", "always");
						widget_so.addVariable("tcolor", "0xFF141C");
						widget_so.addVariable("tcolor2", "0x4659FF");
						widget_so.addVariable("hicolor", "0x000000");
						widget_so.addVariable("tspeed", "100");
						widget_so.addVariable("distr", "true");
						widget_so.addVariable("mode", "tags");
						widget_so.addVariable("tagcloud", "<?php echo urlencode($tags);?>");
						widget_so.write("tagcloudmission");
					</script>
				</div>
				<canvas width="978" height="150" id="myCanvasMission">
					<p>Все браузеры, которые поддерживают элемент canvas проигнорируют текст внутри этого абзаца</p>
					<? echo $lis;?>
				</canvas>

				<script type="text/javascript">
					$(document).ready(function() {
						if ($('*').is('embed')) {
							$('#myCanvasMission').hide();
						} else {
							$('#tagcloudmission').hide();
							if( ! $('#myCanvasMission').tagcanvas({
								textFont : 'Impact,"Arial Black",sans-serif',
								textColour : '#8986e7',
								outlineColour : '#f4a5ff',
								outlineOffset : 3,
								outlineMethod : 'outline',
								minBrightness : 0.2,
								pulsateTo : 0.2,
								pulsateTime : 0.75,
								decel : 0.9,
								reverse : true,
								shadow : '#3ad8ff',
								shadowBlur : 3,
								shadowOffset : [1,1],
								wheelZoom : false,
								textHeight : 16,
								outlineThickness : 3,
								maxSpeed : 0.03,
								depth : 0.75
							})) {
								// TagCanvas failed to load
								$('#myCanvasMission').hide();
							}
						}
						// your other jQuery stuff here...
					});
				</script>
	<?
		} 
	?>
	<div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p>Какова моя цель?</p>
		</div>
	</div>
	<form method="post" class="db pr">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<input type="text" name="mission" class="w100 p10 bgc1 helpenter" placeholder="Чего я хочу достичь?">
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="addmission" type="submit">Добавить цель</button>
			</div>
		</div>
	</form>
	<div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p>Если у меня нет цели - игра закончена, можно выйти</p>
		</div>
	</div>
	<form method="post" class="db">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="exit" type="submit">Выйти</button>
			</div>
		</div>
	</form>
	<div class="db w100 lh52 btbb mt10 bgc2 showwindow pointer">
		<div class="hidden">event</div>
		<div class="vac">
			<p>Что я хочу делать сейчас?</p>
		</div>
	</div>
	<?php
		$tags = '<tags>';
		$lis = '<ul>';
			$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_user`='$id_user'");
			$check = DB::num_rows($resLinkEventDescriptions);
			if ($check > 0) {
				$events = array();
				$highs = array();
				while ($objLinkEventDescriptions = DB::fetch_object($resLinkEventDescriptions)) {
					$id_event = $objLinkEventDescriptions->id_event;
					if (!in_array($id_event, $events)) {
						$events[] = $id_event;
					}
					if (isset($highs[$id_event])) {
						$highs[$id_event] += 1;
					} else {
						$highs[$id_event] = 1;
					}
				}
				$highs2 = array_unique($highs);
				asort($highs2);
				foreach ($highs2 as $key => $value) {
					$highsval[] = $value;
				}
				$stepFontSize = floor($dFontSize / count($highsval));
				$or = '';
				$sql = '';
				$count_event = count($events);
				for ($i=0; $i < $count_event; $i++) { 
					$high = array_search($highs[$events[$i]], $highsval);
					$fontsizes[$events[$i]] = $minFontSize + $stepFontSize * $high;
					$sql .= "$or`id`='$events[$i]'";
					$or = ' OR ';
				}
			}
			if ($sql <> '') {
				$resEvents = DB::query("SELECT * FROM `events` WHERE $sql");
				while ($objEvent = DB::fetch_object($resEvents)) {
					$id = $objEvent->id;
					$event = $objEvent->event;
					if (isset($objEvent->id_impact)) {
						$id_impact = $objEvent->id_impact;
					} else {
						$id_impact = '2';
					}
					if (isset($objEvent->id_type)) {
						$id_type = $objEvent->id_type;
					} else {
						$id_type = '1';
					}
					$fontsize = $fontsizes[$id];
					$style = '';
					if ($id_impact == 1) {
						//$style = 'color="0xcd5d5d"  hicolor="0xcd5d5d"';
						$style = 'color="0xFFFFFF"  hicolor="0xFF0000"';
						$color = '0xcd5d5d';
					}
					if ($id_impact == 2) {
						$style = 'color="0xFF0000"  hicolor="0xFFFFFF"';
						$color = '0x0e0e0e';
					}
					if ($id_impact == 3) {
						$style = 'color="0x00FF00" hicolor="0x0000FF"';
						$color = '0x76e89a'; //color="0xff0000" hicolor="0xffcc00"
					}
					$lis .= '<li><a href="'.$protocol.'://'.$sitemain.'/lifepoint/index.php?event='.$id.'" style="font-size: '.$fontsize.'pt">'.$event.'</a></li>';
					$tags .= '<a href="'.$protocol.'://'.$sitemain.'/lifepoint/index.php?event='.$id.'" '.$style.' style="font-size: '.$fontsize.'pt">'.$event.'</a>';
					//$tags .= '<tag><href>'.$protocol.'://'.$sitemain.'/lifepoint/index.php?event='.$id.'</href><size>'.$fontsize.'</size><color>'.$color.'</color><hicolor>'.$color.'</hicolor><text>'.$event.'</text></tag>';
				}
			}
		$tags .= '</tags>';
		$lis .= '</ul>';
	?>
	<div id="tagcloud" class="tagcloud">
		<script type="text/javascript">
			var rnumber = Math.floor(Math.random()*99);
			var widget_so = new SWFObject("<? echo $protocol.'://'.$sitemain.'/lifepoint/tagcloud/tagcloud.swf?r=';?>"+rnumber,"tagcloudflash", "380", "150", "9");
			widget_so.addParam("wmode", "transparent");
			widget_so.addParam("allowScriptAccess", "always");
			widget_so.addVariable("tcolor", "0xFF141C");
			widget_so.addVariable("tcolor2", "0x4659FF");
			widget_so.addVariable("hicolor", "0x000000");
			widget_so.addVariable("tspeed", "100");
			widget_so.addVariable("distr", "true");
			widget_so.addVariable("mode", "tags");
			widget_so.addVariable("tagcloud", "<?php echo urlencode($tags);?>");
			widget_so.write("tagcloud");
		</script>
	</div>
	<canvas width="978" height="150" id="myCanvas">
		<p>Все браузеры, которые поддерживают элемент canvas проигнорируют текст внутри этого абзаца</p>
		<? echo $lis;?>
	</canvas>

	<script type="text/javascript">
		$(document).ready(function() {
			if ($('*').is('embed')) {
				$('#myCanvas').hide();
			} else {
				$('#tagcloud').hide();
				if( ! $('#myCanvas').tagcanvas({
					textFont : 'Impact,"Arial Black",sans-serif',
					textColour : '#8986e7',
					outlineColour : '#f4a5ff',
					outlineOffset : 3,
					outlineMethod : 'outline',
					minBrightness : 0.2,
					pulsateTo : 0.2,
					pulsateTime : 0.75,
					decel : 0.9,
					reverse : true,
					shadow : '#3ad8ff',
					shadowBlur : 3,
					shadowOffset : [1,1],
					wheelZoom : false,
					textHeight : 16,
					outlineThickness : 3,
					maxSpeed : 0.03,
					depth : 0.75
				})) {
					// TagCanvas failed to load
					$('#myCanvas').hide();
				}
			}
			// your other jQuery stuff here...
		});
	</script>
	<!--div class="tagcloud">
		<object classid="clsid:-D27CDB6E-AE6D-11cf-96B8-444553540000"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"
          param name="wmode" value="transparent"width="200" height="200">
          <param name="movie" value="tagcloud.swf">
          <param name="quality" value="high"> 
          <embed src="tagcloud.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="150"
         
        height="150"wmode="transparent"></embed>
          </object>
	</div-->
	<?php $date_now = date("m.d.Y H:i",time());?>

	<form method="post" class="db pr">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<input type="text" name="event" class="w100 p10 bgc1 helpenter" placeholder="Что я буду делать сейчас?">
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<textarea name="description" class="w100 bn p10 bgc1 helpenter" placeholder="Подробное описание: что именно"></textarea>
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<input type="text" id="date_plan" name="datetime" class="w100 p10 bgc1" placeholder="Запланировать" value="">
				<input type="hidden" name="datetimenumb" id="valcalendar" >
				<input type="hidden" name="datetimezone" id="timezone" >
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="addpoint" type="submit">Начать или запланировать</button>
			</div>
		</div>
	</form>
	<!--div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p>События</p>
		</div>
	</div-->

	<script>
		$(function(){
			$("#date_plan").on("change", function () {
			    var myDate = new Date($(this).val());
			    var d = new Date($(this).val());
			    var loc = Date.UTC(d.getFullYear(), d.getMonth(), d.getDate(), d.getHours(), d.getMinutes(), d.getSeconds());
			    var offDate = new Date().getTimezoneOffset()/60*(-1);
			    console.log(myDate, myDate.getTime()/1000, loc, offDate);
			    
			    //$("#valcalendar").val(loc - offDate + 14400000);
			    $("#valcalendar").val(myDate.getTime()/1000);
			    $("#timezone").val(offDate);
			});

			$("#date_plan").daterangepicker({
				singleDatePicker: true,
				timePicker: true,
				timePickerIncrement: 10,
				timePicker24Hour: true,
				showDropdowns: true,
				autoApply: true,
				locale: {
					format: "MM.DD.YYYY HH:mm",
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

	<div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p class="dib w224">Начало</p>
			<p class="dib w224">Конец</p>
			<p class="dib w224">Событие</p>
			<p class="dib w224">Цель</p>
			<p class="dib w224"></p>
		</div>		
	</div>
	<?
	$dates = array();
	$descriptions = array();
	$resLifepoints = DB::query("SELECT * FROM `lifepoints` WHERE `start` >= CURDATE() OR `end` IS NULL AND `id_user`='$id_user'");
	$check = DB::num_rows($resLifepoints);
	if ($check > 0) {
		while ($objLifepoint = DB::fetch_object($resLifepoints)) {
			$id_lifepoint = $objLifepoint->id;
			$id_event = $objLifepoint->id_event;

			if ($objLifepoint->start <> null) {
				$start = $objLifepoint->start;
				$time_end = '<p class="dib w224">Не завершено</p>';
				if (isset($objLifepoint->end)) {
					$end = $objLifepoint->end;
					$end_slice = explode(' ', $end);
					$date_end = $end_slice[0];
					$time_end = '<p class="dib w224">'.$end_slice[1].'</p>';
				}
			} else {
				$start = $objLifepoint->start_plan;
				//$time_end = '<button class="dib pointer w224 button p10 bgca border3rad mr10" name="closepointwindow">Начать</button>';
				$time_end = '<div class="dib w224"><a class="pointer w224 button p10 bgca border3rad mr10" href="'.$protocol.'://'.$sitemain.'/lifepoint/index.php?lifepoint='.$id_lifepoint.'" style="font-size: '.$fontsize.'pt; padding: 10px 48px;">Начать</a></div>';
			}
			$start_slice = explode(' ', $start);
			$date_start = $start_slice[0];
			$time_start = $start_slice[1];

			$mission = '';
			$resLinkMissionEvents = DB::query("SELECT * FROM `link_mission_events` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
			$check = DB::num_rows($resLinkMissionEvents);
			if ($check > 0) {
				$objLinkMissionEvents = DB::fetch_object($resLinkMissionEvents);
				$id_mission = $objLinkMissionEvents->id_mission;
				$resMissions = DB::query("SELECT * FROM `missions` WHERE `id`='$id_mission'");
				$objMissions = DB::fetch_object($resMissions);
				$mission = $objMissions->mission;
			}

			$resEvents = DB::query("SELECT * FROM `events` WHERE `id`='$id_event'");
			$objEvent = DB::fetch_object($resEvents);
			$event = $objEvent->event;
			//$description = $objEvent->description;
			if (isset($objEvent->id_impact)) {
				$id_impact = $objEvent->id_impact;
			} else {
				$id_impact = '2';
			}
			if (isset($objEvent->id_type)) {
				$id_type = $objEvent->id_type;
			}

			if(!in_array($date_start, $dates)) {
				$dates[] = $date_start;
				echo 
				'<div class="db w100 lh52 btbb mt10">
					<div class="vac">
						<p>'.$date_start.'</p>
					</div>
				</div>';
			}
			
			//Классом передавать результирующее действие ( круг,эволюция,деградация ) в виде цвета
			$style = 'bgc1';
			if ($id_impact == 1) {
				$style = 'badbg';
			}
			if ($id_impact == 2) {
				$style = 'bgc1';
			}
			if ($id_impact == 3) {
				$style = 'goodbg';
			}
			echo 
			'<div class="db w100 lh52 btbb mt10">
				<div class="vac '.$style.'">
					<form method="post" class="db">
						<p class="dib w224">'.$time_start.'</p>
						'.$time_end.'
						<p class="dib w224">'.$event.'</p>
						<p class="dib w224">'.$mission.'</p>
						<input type="hidden" name="id_lifepoint" value="'.$id_lifepoint.'">';
			if ($time_end === '<p class="dib w224">Не завершено</p>') {
				echo			'<button class="dib fr mt8 pointer w224 button p10 bgca border3rad mr10" name="closepointwindow">Завершить</button>';
			} else {
				$description = '';
				$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_event`='$id_event' AND `id_user`='$id_user'");
				$check = DB::num_rows($resLinkEventDescriptions);
				if ($check > 0) {
					while ($objLinkEventDescriptions = DB::fetch_object($resLinkEventDescriptions)) {
						$id_description = $objLinkEventDescriptions->id_description;
						$descriptions[] = $id_description;
					}

					$resDescriptions = DB::query("SELECT * FROM `descriptions` WHERE `id`='$id_description'");
					$objDescriptions = DB::fetch_object($resDescriptions);
					$description = $objDescriptions->description;
				}
				//echo			'<button class="dib pointer w224 button p10 bgca" name="closepointwindow">Завершить</button>';
				echo 			'<p class="pr dib fr w224 h100"><textarea class="pa corner0 wh100 bn '.$style.'" disabled="disabled">'.$description.'</textarea></p>';
			}
			echo
					'</form>
				</div>
			</div>';
		}			
	}
	?>
	<?php //if (!isset($_SESSION['timezone'])) { ?>
		<script>
			$(function(){
				$.ajax({
					url: "tmpl/obrabotka.php",
					type:"post",
					data: {
						timezone: new Date().getTimezoneOffset()/60*(-1)
					},
					success:function(loader){
						$('#date_plan').attr('value',loader);
						$('#date_plan').val(loader);
						$('button[name=closepoint]').val(loader);
						console.log(loader);
					}
				});
			});
		</script>
	<?php //} ?>
</div>
<? } else { ?>
	<div class="db w100 pr">
		<p class="error tac"><? echo "$error"; ?></p>
		<form method="post" class="forma">
			<input class="db bgc1 bb mt10 w100" name="login" type="text" placeholder="Логин" required>
			<input class="db bgc1 bb mt10 w100" name="password" type="password" placeholder="Пароль" required>
			<button class="db mt10 pointer w100 button p10 bgca border3rad" type="submit" name="autorize">Войти</button>  
			<a class="recovery" href="<? echo $protocol.'://'.$sitemain.'/lifepoint/recovery.php';?>">Забыли пароль? Восстановить</a>
		</form>
	</div>
<? } ?>