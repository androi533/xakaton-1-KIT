<?php 
	include("../conf/start.php");
	include("../conf/session.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];

	$result = '';

	if(!empty($_POST)) {		
		if (isset($_SESSION['id_user'])) { 
			$id_user = $_SESSION['id_user']; 
		}

		if (isset($_POST['timezone'])) {
			if ($_POST['timezone'] <> '') {
				$timezone = $_POST['timezone'];
				$_SESSION['timezone'] = $timezone;
				$datetime_now = date("m.d.Y H:i", strtotime("now") + $timezone * 60 * 60 - 3*60*60);
				$result = $datetime_now;
			}
		}

		if (isset($_POST['helpenter'])) {
			if ($_POST['helpenter'] == 'enter') {

				$val = $_POST['val'];
				$name = $_POST['name'];
				$result = '<div class="helpenterfield bgc1">';
				$res = DB::query("SELECT * FROM `".$name."s` WHERE `$name` LIKE '%$val%' OR `$name` LIKE '%$val' OR `$name` LIKE '$val%' LIMIT 8");
				$check = DB::num_rows($res);
				if ($check > 0) {
					while ($obj = DB::fetch_array($res)) {
						$value = $obj[$name];
						$id = $obj['id'];
						$result .= '<div class="helpenterchoise p4 pointer"><div class="hidden val">'.$id.'</div><div class="hidden name">'.$name.'</div>'.$value.'</div>';
					}
				} else {
					exit();
				}
				$result .= '</div>';
			}

			if ($_POST['helpenter'] == 'choise') {
				$val = $_POST['val'];
				$name = $_POST['name'];
				$res = DB::query("SELECT * FROM `".$name."s` WHERE `id`='$val'");
				$obj = DB::fetch_array($res);
				$result = $obj[$name];
			}
		}

		if (isset($_POST['show'])) {
			$type = $_POST['show'];
			if ($type == 'mission') {
				$headline = 'Мои цели';
				$button = 'цель';
				$placeholder = 'Чего я хочу достичь?';
				$resMissions = DB::query("SELECT * FROM `missions` WHERE `id_user`='$id_user'");
				$check = DB::num_rows($resMissions);
				$text = '';
				if ($check > 0) { 
					while ($objMissions = DB::fetch_object($resMissions)) {
						$id_mission = $objMissions->id;
						$mission = $objMissions->mission;
						$text .= '
						<div class="db w100 lh52 btbb mt10">
							<div class="vac good goodbg">
								<form method="post" class="db">
									<p class="dib mw31">'.$mission.'</p>
									<input type="hidden" name="id_mission" value="'.$id_mission.'">
									<button class="dib fr mt8 pointer w224 button p10 bgca border3rad mr10" name="change_'.$type.'">Изменить</button>
								</form>
							</div>
						</div>
						';
					}
				}
			}
			if ($type == 'event') {
				$headline = 'Мои события';
				$button = 'событие';
				$placeholder = 'Что я хочу делать?';

				$text = '';
				$resLinkEventDescriptions = DB::query("SELECT * FROM `link_event_descriptions` WHERE `id_user`='$id_user'");
				$check = DB::num_rows($resLinkEventDescriptions);
				if ($check > 0) {
					$events = array();
					while ($objLinkEventDescriptions = DB::fetch_object($resLinkEventDescriptions)) {
						$id_event = $objLinkEventDescriptions->id_event;
						if (!in_array($id_event, $events)) {
							$events[] = $id_event;
						}
					}

					$or = '';
					$sql = '';
					for ($i=0; $i < count($events); $i++) { 
						$sql .= "$or`id`='$events[$i]'";
						$or = ' OR ';
					}

					if ($sql <> '') {
						$resEvents = DB::query("SELECT * FROM `events` WHERE $sql");
						while ($objEvent = DB::fetch_object($resEvents)) {
							$id_event = $objEvent->id;
							$event = $objEvent->event;
							$text .= '
							<div class="db w100 lh52 btbb mt10">
								<div class="vac good goodbg">
									<form method="post" class="db">
										<p class="dib mw31">'.$event.'</p>
										<input type="hidden" name="id_event" value="'.$id_event.'">
										<button class="dib fr mt8 pointer w224 button p10 bgca border3rad mr10" name="change_'.$type.'">Изменить</button>
									</form>
								</div>
							</div>
							';
						}
					}
				}
			}
			$result = 
			'<div class="pf corner0 zi3 tac bgc1">
				<div class="wh100 ofo">
					<div class="">
						<div class="header h112 bgc2">
							<div class="vac">
								<p>'.$headline.'</p>
							</div>
						</div>
						<form method="post" class="db pr">
							<div class="db w100 lh52 btbb mt10">
								<div class="vac">
									<input type="text" name="'.$type.'" class="w100 p10 bgc1 helpenter" placeholder="'.$placeholder.'">
								</div>
							</div>
							<div class="db w100 lh52 btbb mt10">
								<div class="vac">
									<button class="w100 p10 button bgca border3rad h36" name="add'.$type.'" type="submit">Добавить '.$button.'</button>
								</div>
							</div>
						</form>
						<div class="lh52 w100 btbb mt10 db bgc2">
							<div class="vac">
								<p>Список<p>
							</div>
						</div>
						<div class="w100 btbb mt10 db h320 ofo">
							'.$text.'
						</div>
					</div>
				</div>
			</div>';
		}

		//Ниже не писать
		if (isset($result)) {
   			echo $result;
		}
	}
?>