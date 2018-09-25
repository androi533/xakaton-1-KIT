<?php
$error = '';

if (isset($_SESSION['id_user'])) {
	$id_user = $_SESSION['id_user'];
}

if(isset($_POST['add_group'])) {
	if (isset($_POST['vk_link'])) {
		$vk_link = $_POST['vk_link']; //79316217 211743328
		if (strrpos($vk_link, '/')>0) {
			$vk_link = substr($vk_link, strrpos($vk_link, '/')+1, strlen($vk_link)-strrpos($vk_link, '/')-1);
		} else {
			if (is_numeric($vk_link)) {
				$vk_link = 'id'.$vk_link;
			}
		}

		$fields = 'contacts';
		$link = 'https://api.vk.com/method/groups.getById?group_ids='.$vk_link.'&fields='.$fields.'&v='.$CONSTS['VK_V'].'&access_token='.$CONSTS["SERVISE_DP"];
		$resp = file_get_contents($link);
		$data = json_decode($resp, true);
		print_r($data);

		if (isset($data[response][0][id])) {
			$vk_id = $data[response][0][id];
			echo "<br>$vk_id";
			$resVK_users = DB::query("SELECT * FROM `vk_users` WHERE `vk_id`='$vk_id' AND `type`='1'");
			$checkUser = DB::num_rows($resVK_users);
			if ($checkUser === 0) {
				echo " NO";
			}
		}
	}
}

if(isset($_POST['add_user'])) {
	if (isset($_POST['vk_link'])) {
		$vk_link = $_POST['vk_link']; //79316217 211743328
		if (strrpos($vk_link, '/')>0) {
			$vk_link = substr($vk_link, strrpos($vk_link, '/')+1, strlen($vk_link)-strrpos($vk_link, '/')-1);
		} else {
			if (is_numeric($vk_link)) {
				$vk_link = 'id'.$vk_link;
			}
		}

		$fields = 'status';
		$link = 'https://api.vk.com/method/users.get?user_ids='.$vk_link.'&fields='.$fields.'&v='.$CONSTS['VK_V'].'&access_token='.$CONSTS["SERVISE_DP"];
		$resp = file_get_contents($link);
		$data = json_decode($resp, true);
		//print_r($data);
		
		if (isset($data[response][0][id])) {
			$vk_id = $data[response][0][id];

			$status = '';
			$audio = '';
			$resVK_users = DB::query("SELECT * FROM `vk_users` WHERE `vk_id`='$vk_id' AND `type`='0'");
			$checkUser = DB::num_rows($resVK_users);
			if ($checkUser === 0) {
				$sql = "`vk_id`='$vk_id'";
				if (isset($data[response][0][first_name])) {
					$first_name = $data[response][0][first_name];
					$sql .= ", `first_name`='$first_name'";
				}

				if (isset($data[response][0][last_name])) {
					$last_name = $data[response][0][last_name];
					$sql .= ", `last_name`='$last_name'";
				}

				if (isset($data[response][0][status])) {
					$status = $data[response][0][status];
					$status_new = mb_convert_encoding($status, 'utf-8', 'cp1251');
					$resVK_status = DB::query("SELECT * FROM `vk_statuss` WHERE `value`='$status_new'");
					$check = DB::num_rows($resVK_status);
					if ($check === 0) {
						$insVK_status = DB::query("INSERT INTO `vk_statuss` SET `value`='$status_new'");
						$id_vk_status = DB::insert_id();
					} else {
						$objVK_status = DB::fetch_object($resVK_status);
						$id_vk_status = $objVK_status->id;
						$value = $objVK_status->value;
						$status = mb_convert_encoding($value, 'cp1251', 'utf-8');
					}
					//echo " SU $status B <br>";
					//$sql .= ", `id_vk_status`='$id_vk_status'";
				}

				if (isset($data[response][0][status_audio])) {
					//echo "AUDIO";
					$audio = $data[response][0][status_audio][artist].' - '.$data[response][0][status_audio][title];
					$audio_new = mb_convert_encoding($audio, 'utf-8', 'cp1251');
					$resVK_statuss_audio = DB::query("SELECT * FROM `vk_statuss_audio` WHERE `value`='$audio_new'");
					$check = DB::num_rows($resVK_statuss_audio);
					if ($check === 0) {
						$insVK_statuss_audio = DB::query("INSERT INTO `vk_statuss_audio` SET `value`='$audio_new'");
						$id_vk_status_audio = DB::insert_id();
						//echo "A $audio";
					} else {
						$objVK_statuss_audio = DB::fetch_object($resVK_statuss_audio);
						$id_vk_status_audio = $objVK_statuss_audio->id;
						$value = $objVK_statuss_audio->value;
						$audio = mb_convert_encoding($value, 'cp1251', 'utf-8');
						//echo "V $value";
					}
				}

				$insVK_users = DB::query("INSERT INTO `vk_users` SET $sql");
				$id_vk_user = DB::insert_id();
			}

			if ($audio <> '') {
				$sql = "SELECT * FROM `vk_statuss_audio_user` WHERE `id_vk_status_audio`='$id_vk_status_audio' AND `id_vk_user`='$id_vk_user'";
				$resVK_statuss_audio_user = DB::query($sql);
				$check = DB::num_rows($resVK_statuss_audio_user);
				if ($check === 0) {
					$insVK_statuss_audio_user = DB::query("INSERT INTO `vk_statuss_audio_user` SET `id_vk_status_audio`='$id_vk_status_audio', `id_vk_user`='$id_vk_user', `datetime`=NOW(), `count`='1'");
				} else {
					$objVK_statuss_audio_user = DB::fetch_object($resVK_statuss_audio_user);
					$datetime = $objVK_statuss_audio_user->datetime;
					$sql2 = "SELECT * FROM `vk_statuss_audio_user` WHERE `id_vk_user`='$id_vk_user' ORDER BY `datetime` DESC LIMIT 1";
					$resVK_statuss_audio_user_all = DB::query($sql2);
					$objVK_statuss_audio_user_all = DB::fetch_object($resVK_statuss_audio_user_all);
					$id_vk_status_audio_all = $objVK_statuss_audio_user_all->id_vk_status_audio;
					//echo "I $id_vk_status_audio_all $id_vk_status_audio<br>";
					if ($id_vk_status_audio_all <> $id_vk_status_audio) {
						$count = $objVK_statuss_audio_user->count + 1;
						$updVK_statuss_audio_user = DB::query("UPDATE `vk_statuss_audio_user`  SET `count`='$count', `datetime`=NOW() WHERE `id_vk_status_audio`='$id_vk_status_audio' AND `id_vk_user`='$id_vk_user'");
					}
				}
			}

			if ($status <> '') {
				$sql = "SELECT * FROM `vk_statuss_user` WHERE `datetime` IN (SELECT MAX(`datetime`) as `time` FROM `vk_statuss_user` WHERE `id_vk_status`='$id_vk_status' GROUP BY `id_vk_user`)";
				$sql2 = "SELECT * FROM `vk_statuss_user` WHERE `datetime` IN (SELECT MAX(`datetime`) as `time` FROM `vk_statuss_user` GROUP BY `id_vk_user`)";
				$resVK_statuss_user = DB::query($sql);
				$check = DB::num_rows($resVK_statuss_user);
				if ($check === 0) {
					$insVK_statuss_user = DB::query("INSERT INTO `vk_statuss_user` SET `id_vk_status`='$id_vk_status', `id_vk_user`='$id_vk_user', `datetime`=NOW()");
				} else {
					$resVK_statuss_user_all = DB::query($sql2);
					while ($objVK_statuss_user_all = DB::fetch_object($resVK_statuss_user_all)) {
						
						$id_vk_user_vr = $objVK_statuss_user_all->id_vk_user;
						$id_vk_status_alls[$id_vk_user_vr]['status'] = $objVK_statuss_user_all->id_vk_status;
						$datetimes[$id_vk_user_vr]['datetime'] = $objVK_statuss_user_all->datetime;
						//echo " U $id_vk_user S ".$id_vk_status_alls[$id_vk_user]['status']." DA ".$datetimes[$id_vk_user]['datetime']."<br>";
						//$descriptions[] = $id_description;
					}
					while ($objVK_statuss_user = DB::fetch_object($resVK_statuss_user)) {
						$id_vk_status = $objVK_statuss_user->id_vk_status;
						$id_vk_user_vr2 = $objVK_statuss_user->id_vk_user;
						$datetime = $objVK_statuss_user->datetime;
						//echo " U2 $id_vk_user S $id_vk_status D $datetime<br>";
						//$descriptions[] = $id_description;
						if ($id_vk_status_alls[$id_vk_user_vr2]['status'] <> $id_vk_status) {
							$insVK_statuss_user = DB::query("INSERT INTO `vk_statuss_user` SET `id_vk_status`='$id_vk_status', `id_vk_user`='$id_vk_user', `datetime`=NOW()");
						}
					}

				}
			}
		}

		if ($checkUser === 0) {
			$link = 'https://api.vk.com/method/friends.get?user_id='.$vk_id.'&v='.$CONSTS['VK_V'].'&access_token='.$CONSTS["SERVISE_DP"]; //'&fields='.$fields.
			$resp = file_get_contents($link);
			$data = json_decode($resp, true);
			//print_r($data);
			$count_friends = $data[response][count];
			$sqlfindvalues = '';
			$split = '';
			for ($i=0; $i < $count_friends; $i++) { 
				$id_vk_friend = $data[response][items][$i];
				$sql = "SELECT * FROM `vk_friends` WHERE `id_vk_friend`='$id_vk_friend' AND `id_vk_user`='$id_vk_user'";
				$resVK_friends = DB::query($sql);
				$check = DB::num_rows($resVK_friends);
				if ($check === 0) {
					$sqlfindvalues .= $split."('$id_vk_friend', '$id_vk_user', NOW())";
					$split = ', ';
				}
			}
			$insVK_friends = DB::query("INSERT INTO `vk_friends` (`id_vk_friend`, `id_vk_user`, `datetime`) VALUES $sqlfindvalues");
		}
	}
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/vk.php');
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
						<p>Анализ завершенного события<p>
					</div>
				</div>
				<div class="db w100 lh52 btbb bgc2">
					<div class="vac">
						<p>'.$event.'<p>
					</div>
				</div>
				<form method="post" class="db pr">
					<div class="db w100 lh52 mt10">
						<div class="vac">
							<textarea name="description" class="w100 p10 btbb bgc1" placeholder="Подробное описание: что именно, какие мысли, какое личное отношение, какое настроение">'.$description.'</textarea>
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
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/vk.php');
}

if(isset($_POST['exit'])) {
	unset($_SESSION['id_user']);
	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/vk.php');
}

if (isset($_GET['vk_user'])) {
	$id_event = $_GET['vk_user'];

	$insLifepoints = DB::query("INSERT INTO `lifepoints`(`id_user`, `id_event`, `start`) VALUES ('$id_user', '$id_event', NOW())");

	header('Location: '.$protocol.'://'.$sitemain.'/lifepoint/vk.php');
}
?>
<? if (isset($_SESSION['id_user'])) { $id_user = $_SESSION['id_user'];?>
<div class="cont tac">
	<div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p>Добавьте пользователя для отслеживания</p>
		</div>
	</div>
	
	<form method="post" class="db pr">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<input type="text" name="vk_link" class="w100 p10 bgc1" placeholder="Ссылка на пользователя вконтакте">
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="add_user" type="submit">Добавить</button>
			</div>
		</div>
	</form>

	<div class="db w100 lh52 btbb mt10 bgc2">
		<div class="vac">
			<p>Добавьте группу для отслеживания</p>
		</div>
	</div>
	
	<form method="post" class="db pr">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<input type="text" name="vk_link" class="w100 p10 bgc1" placeholder="Ссылка на группу вконтакте">
			</div>
		</div>
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="add_group" type="submit">Добавить</button>
			</div>
		</div>
	</form>

	<form method="post" class="db">
		<div class="db w100 lh52 btbb mt10">
			<div class="vac">
				<button class="w100 p10 button bgca border3rad h36" name="exit" type="submit">Выйти</button>
			</div>
		</div>
	</form>
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