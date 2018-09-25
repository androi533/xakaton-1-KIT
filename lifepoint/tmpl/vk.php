<?php 
	include("../conf/start.php");
	include("../conf/session.php");
	require("../conf/consts.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];

	$result = '';

	$resVK_users = DB::query("SELECT * FROM `vk_users`");
	$check = DB::num_rows($resVK_users);
	if ($check > 0) {
		//echo "C $check<br>";
		while ($objVK_users = DB::fetch_object($resVK_users)) {
			$vk_id = $objVK_users->vk_id;
			$id_vk_user = $objVK_users->id;
			$vk_link = 'id'.$vk_id;

			//echo "$vk_link";
			$fields = 'status';
			$link = 'https://api.vk.com/method/users.get?user_ids='.$vk_link.'&fields='.$fields.'&v='.$CONSTS['VK_V'].'&access_token='.$CONSTS["SERVISE_DP"];
			$resp = file_get_contents($link);
			$data = json_decode($resp, true);
			
			if (isset($data[response][0][id])) {
				$status = '';
				if (isset($data[response][0][status])) {
					$status = $data[response][0][status];
					$status_new = mb_convert_encoding($status, 'utf-8', 'cp1251');
					$resVK_status = DB::query("SELECT * FROM `vk_statuss` WHERE `value`='$status_new'");
					$check = DB::num_rows($resVK_status);
					if ($check === 0) {
						$insMissions = DB::query("INSERT INTO `vk_statuss` SET `value`='$status_new'");
						$id_vk_status = DB::insert_id();
					} else {
						$objVK_status = DB::fetch_object($resVK_status);
						$id_vk_status = $objVK_status->id;
						$value = $objVK_status->value;
						$status = mb_convert_encoding($value, 'cp1251', 'utf-8');
					}
					//echo "I2 $vk_id SU $status A";
				}

				$audio = '';
				if (isset($data[response][0][status_audio])) {
					//echo "AUDIO";
					$audio = $data[response][0][status_audio][artist].' - '.$data[response][0][status_audio][title];
					$resVK_statuss_audio = DB::query("SELECT * FROM `vk_statuss_audio` WHERE `value`='$audio'");
					$check = DB::num_rows($resVK_statuss_audio);
					if ($check === 0) {
						$insVK_statuss_audio = DB::query("INSERT INTO `vk_statuss_audio` SET `value`='$audio'");
						$id_vk_status_audio = DB::insert_id();
						//echo "A $audio";
					} else {
						$objVK_statuss_audio = DB::fetch_object($resVK_statuss_audio);
						$id_vk_status_audio = $objVK_statuss_audio->id;
						$value = $objVK_statuss_audio->value;
						//$status = mb_convert_encoding($value, 'cp1251', 'utf-8');
						//echo "V $value";
					}
				}

				if ($audio <> '') {
					$sql = "SELECT * FROM `vk_statuss_audio_user` WHERE `id_vk_status_audio`='$id_vk_status_audio' AND `id_vk_user`='$id_vk_user'";
					$resVK_statuss_audio_user = DB::query($sql);
					$check = DB::num_rows($resVK_statuss_audio_user);
					if ($check === 0) {
						$insMissions = DB::query("INSERT INTO `vk_statuss_audio_user` SET `id_vk_status_audio`='$id_vk_status_audio', `id_vk_user`='$id_vk_user', `datetime`=NOW(), `count`='1'");
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
					//echo " C $check <br>";
					if ($check === 0) {
						$insMissions = DB::query("INSERT INTO `vk_statuss_user` SET `id_vk_status`='$id_vk_status', `id_vk_user`='$id_vk_user', `datetime`=NOW()");
					} else {
						if (!isset($id_vk_status_alls)) {
							$resVK_statuss_user_all = DB::query($sql2);
							while ($objVK_statuss_user_all = DB::fetch_object($resVK_statuss_user_all)) {
								
								$id_vk_user = $objVK_statuss_user_all->id_vk_user;
								$id_vk_status_alls[$id_vk_user]['status'] = $objVK_statuss_user_all->id_vk_status;
								$datetimes[$id_vk_user]['datetime'] = $objVK_statuss_user_all->datetime;
								//echo " U $id_vk_user S ".$id_vk_status_alls[$id_vk_user]['status']." DA ".$datetimes[$id_vk_user]['datetime']."<br>";
								//$descriptions[] = $id_description;
							}
						}
						while ($objVK_statuss_user = DB::fetch_object($resVK_statuss_user)) {
							$id_vk_status = $objVK_statuss_user->id_vk_status;
							$id_vk_user = $objVK_statuss_user->id_vk_user;
							$datetime = $objVK_statuss_user->datetime;
							//echo " U2 $id_vk_user S $id_vk_status D $datetime ";
							//$descriptions[] = $id_description;
							if ($id_vk_status_alls[$id_vk_user]['status'] <> $id_vk_status) {
								//echo " NO <br>";
								$insMissions = DB::query("INSERT INTO `vk_statuss_user` SET `id_vk_status`='$id_vk_status', `id_vk_user`='$id_vk_user', `datetime`=NOW()");
							} /*else {
								//echo " YES <br>";
							}*/
						}
					}
				}
			}

			$sql = "SELECT * FROM `vk_friends`";
			$resVK_friends_all = DB::query($sql);
			$check = DB::num_rows($resVK_friends_all);
			if ($check > 0) {
				while ($objVK_friends_all = DB::fetch_object($resVK_friends_all)) {
					$id_vk_user_vr3 = $objVK_friends_all->id_vk_user;
					$id_vk_friend_vr = $objVK_friends_all->id_vk_friend;
					$vk_friends_all[$id_vk_user_vr3][] = $id_vk_friend_vr;
					$vk_friends[$id_vk_user_vr3][$id_vk_friend_vr]['datetime'] = $objVK_friends_all->datetime;
					$vk_friends[$id_vk_user_vr3][$id_vk_friend_vr]['status'] = $objVK_friends_all->status;
				}
			}

			$link = 'https://api.vk.com/method/friends.get?user_id='.$vk_id.'&v='.$CONSTS['VK_V'].'&access_token='.$CONSTS["SERVISE_DP"]; //'&fields='.$fields.
			$resp = file_get_contents($link);
			$data = json_decode($resp, true);
			//print_r($data);
			$count_friends = $data[response][count];
			$sqlfindvalues = '';
			$split = '';
			for ($i=0; $i < $count_friends; $i++) { 
				$id_vk_friend = $data[response][items][$i];
				if (isset($vk_friends[$id_vk_user][$id_vk_friend]['datetime'])) {
					if ($vk_friends[$id_vk_user][$id_vk_friend]['status'] == 3) { //3 удален //1 Добавлен //0 Начальный //2 старый
						$updVK_friends = DB::query("UPDATE `vk_friends` SET `status`='1', `datetime`=NOW() WHERE `id_vk_user`='$id_vk_user' AND `id_vk_friend`='$id_vk_friend'");
					}
					$adds[$id_vk_user][] = $id_vk_friend;
				} else {
					$sqlfindvalues .= $split."('$id_vk_friend', '$id_vk_user', NOW(), '1')";
					$split = ', ';
				}
			}
			if ($sqlfindvalues <> '') {
				$insVK_friends = DB::query("INSERT INTO `vk_friends` (`id_vk_friend`, `id_vk_user`, `datetime`, `status`) VALUES $sqlfindvalues");
			}
			//echo "ALL<br>";
			//print_r($vk_friends_all[$id_vk_user]);
			//echo "<br>ADD<br>";
			//print_r($adds[$id_vk_user]);
			//echo "<br>SUB<br>";
			$dels[$id_vk_user] = array_diff($vk_friends_all[$id_vk_user], $adds[$id_vk_user]);
			//print_r($dels[$id_vk_user]);
			foreach ($dels[$id_vk_user] as $key => $id_vk_friend) {
				$updVK_friends = DB::query("UPDATE `vk_friends` SET `status`='3', `datetime`=NOW() WHERE `id_vk_user`='$id_vk_user' AND `id_vk_friend`='$id_vk_friend'");
			}
		}
	}
?>