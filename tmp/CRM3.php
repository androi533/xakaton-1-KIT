<?php
	setlocale(LC_ALL, 'ru_RU.cp1251'); 
	date_default_timezone_set('Asia/Ekaterinburg'); 

	//include('const.php'); // Сделать запрос к БД, и записать значения в сессию? )
	$CONST_ZAG1 = 35;
	$CONST_ZAG2 = 30;
// Идентификатор приложения
$client_id = '25794db0eea84b5d87cf20c1d5b583f4'; 
// Пароль приложения
$client_secret = 'e481999475064139a7f000d6937c8f3d';

	function can_upload($file){
	// если имя пустое, значит файл не выбран
		if($file['name'] == '')
			return 'Вы не выбрали файл.';
		
		/* если размер файла 0, значит его не пропустили настройки 
		сервера из-за того, что он слишком большой */
		if($file['size'] == 0)
			return 'Файл слишком большой.';
		
		// разбиваем имя файла по точке и получаем массив
		$getMime = explode('.', $file['name']);
		// нас интересует последний элемент массива - расширение
		$mime = strtolower(end($getMime));
		// объявим массив допустимых расширений
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
		
		// если расширение не входит в список допустимых - return
		if(!in_array($mime, $types))
			return 'Недопустимый тип файла.';
		
		return true;
	}
  
	function make_upload($file, $prod){	
		// формируем уникальное имя картинки: случайное число и name
		//$name = mt_rand(0, 10000) . $file['name'];
		copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/'.$prod.'/img/' . $file['name']);
		//echo $prod.'/img/' . $file['name'];

		return $file['name'];
	}  

	function copy_folder($d1, $d2, $upd = true, $force = true) { 
		if ( is_dir( $d1 ) ) { 
			$d2 = mkdir_safe( $d2, $force ); 
			if (!$d2) {fs_log("!!fail $d2"); return;} 
			$d = dir( $d1 ); 
			while ( false !== ( $entry = $d->read() ) ) { 
				if ( $entry != '.' && $entry != '..' )  
					copy_folder( "$d1/$entry", "$d2/$entry", $upd, $force ); 
			} 
			$d->close(); 
		} 
		else { 
			$ok = copy_safe( $d1, $d2, $upd ); 
			$ok = ($ok) ? "ok-- " : " -- "; 
			fs_log("{$ok}$d1");  
		} 
	} //function copy_folder 

	function mkdir_safe( $dir, $force ) { 
		if (file_exists($dir)) { 
			if (is_dir($dir)) return $dir; 
			else if (!$force) return false; 
			unlink($dir); 
		} 
		return (mkdir($dir, 0777, true)) ? $dir : false; 
	} //function mkdir_safe 

	function copy_safe ($f1, $f2, $upd) { 
		$time1 = filemtime($f1); 
		if (file_exists($f2)) { 
			$time2 = filemtime($f2); 
			if ($time2 >= $time1 && $upd) return false; 
		} 
		$ok = copy($f1, $f2); 
		if ($ok) touch($f2, $time1); 
		return $ok; 
	} //function copy_safe  

	function fs_log($str) {
		$log = fopen("./fs_log.txt", "a");
		$time = date("Y-m-d H:i:s");
		fwrite($log, "$str ($time)\n");
		fclose($log);
	}

	if(isset($_POST['buton'])) {
		if ((!empty($_POST['login'])) && (!empty($_POST['passwrd']))) {
			$login = trim($_POST['login']);
			$password = trim($_POST['passwrd']);

			$exists = "SELECT * FROM `new_users` WHERE `email` = '$login' OR `phone` = '$login' AND `password`='$password'"; //тут надо добавить durl проверку
			$ql = DB::query($exists);
			$check=DB::num_rows($ql);
			if ($check>0) {
				$objUserSes=DB::fetch_object($ql);
				$id_user = $objUserSes->id;
				

				$resProjUser = DB::query("SELECT * FROM `new_project_user` WHERE `id_user` = '$id_user'"); //тут надо добавить durl проверку
				$objProjUser = DB::fetch_object($resProjUser);
				$id_project = $objProjUser->id_project;

				$resProj = DB::query("SELECT * FROM `new_project` WHERE `id` = '$id_project'"); //тут надо добавить durl проверку
				$check = DB::num_rows($resProj);
				$objProj = DB::fetch_object($resProj);
				$durl = $objProj->durl;

				if ($durl <> $market ) {
					header('location: '.$protocol.'://'.$sitemain.'/'.$durl.'/CRM3.php?login='.$login.'&password='.$password);
					exit();
				} else {
					$_SESSION['market_'.$market]['id_user'] = $id_user;
					$_SESSION['market_'.$market]['id_project'] = $id_project;
					$_SESSION['market_'.$market]['errorentry'] = '0';
					
					$_SESSION['market_'.$market]['podpiska'] = $objUserSes->podpiska;
					$_SESSION['market_'.$market]['laststep'] = $objUserSes->laststep;
					$laststep = $objUserSes->laststep;
					$_SESSION['market_'.$market]['first'] = $objUserSes->first;
					
					if ($_SESSION['market_'.$market]['first'] == 1) {
						$usedFirstUpdate = DB::query("UPDATE `new_users` SET `first`='0' WHERE `id` = '$id'");
					}
					$_SESSION['market_'.$market]['user_phone'] = $objUserSes->phone;
					$_SESSION['market_'.$market]['freeaccess'] = $objUserSes->freeaccess;
					if ($_SESSION['market_'.$market]['freeaccess'] == 2) {
						$startaccess = $objUserSes->startaccess;
						$_SESSION['market_'.$market]['startaccess'] = $startaccess;
						$endtime = date("Y-m-d", (strtotime($startaccess)+3600*24*3));
						$today = date('Y-m-d');
						if ($today > $endtime) {
							$userAccess = DB::query("UPDATE `new_users` SET `freeaccess`='0' WHERE `id` = '$id_user'");
						}
					}
					$_SESSION['market_'.$market]['SID'] = md5(crypt($objUserSes->id,$objUserSes->phone));
					$_SESSION['market_'.$market]['lastactivity'] = time();

					//МОЖЕТ НЕ БЫТЬ ВОРОНКИ???
					$novoronka = FALSE;
					$nextvoronkaproj = NULL;
					$resultVoronka = DB::query("SELECT * FROM `new_voronka` WHERE `id_project` = '$id_project' AND `step` = '$laststep'");
					$objVoronka=DB::fetch_object($resultVoronka);
					$id_project_data = $objVoronka->id_project_data;
					$_SESSION['market_'.$market]['id_project_data'] = $id_project_data;
					
					if ($objUserSes->name <> '') {
						$_SESSION['market_'.$market]['name'] = $objUserSes->name;
					}
					
					$sqlmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_user`='$id_user' AND `id_project`='$id_project'");
					$check = DB::num_rows($sqlmarketing); //здесь все
					if ($check == 0) {
						$sqlmarketingadd = DB::query("INSERT INTO `new_marketing`(`id_user`, `id_project`) VALUES ('$id_user', '$id_project')");
						$id_marketing = DB::insert_id();
					} else {
						$objMarketing = DB::fetch_object($sqlmarketing);
						$id_marketing = $objMarketing->id;
						$direct_reg = $objMarketing->direct_reg;
						$_SESSION['market_'.$market]['direct_reg'] = $direct_reg;
						if (isset($objMarketing->token_yandex)) {
							$token_yandex = $objMarketing->token_yandex;
							$_SESSION['market_'.$market]['token_yandex'] = $token_yandex;
						}
						if (isset($objMarketing->token_google)) {
							$token_google = $objMarketing->token_google;
							$_SESSION['market_'.$market]['token_google'] = $token_google;
						}
					}
					$_SESSION['market_'.$market]['id_marketing'] = $id_marketing;
					
					if (!isset($token_yandex)) {
						header('location: https://oauth.yandex.ru/authorize?response_type=code&client_id='.$client_id.'&state='.$market);
						exit(); //Токен получается, остается проверка на Директ
					}
					if ($direct_reg == 0) { //Полная херня - можно оставить для показа сообщения - А вы зареганы в Директ? В окошке выдавать ссылку на директ и галочка - не показывать поменяет директ_рег
						$restoken = DB::query("UPDATE `new_marketing` SET `direct_reg`='1' WHERE `id_user`='$id_user' AND `id_project`='$id_project'");
						
						/*$urldirect = "https://direct.yandex.ru";

						$curl = curl_init($urldirect);
						curl_setopt($curl, CURLOPT_HEADER, 1);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1); //следование 302 redirect 
						$html = curl_exec($curl);

						$document = phpQuery::newDocument($html); //Загружаем полученную страницу в phpQuery
						$hentry = $document->find('.sitelinks__item a'); //Находим все элементы с классом "organic__url-text" (селектор .organic__url-text)*/

						//header('location: https://direct.yandex.ru'); //через curl получить страницу и узнать зареган или нет, если да, то изменить в базе данных
						//exit();
					}
				}

					//exit();
				
				//header('location: '.$protocol.'://'.$sitemain.'/'.$market.'/CRM3.php');
			} else {
				$_SESSION['market_'.$market]['errorentry'] = '1';
				echo 'Логин или пароль введены неверно!';
			}
		}
	}

	if ( ((isset($_SESSION['market_'.$market]['id_user'])) && (isset($_SESSION['market_'.$market]['user_phone']))) && (md5(crypt($_SESSION['market_'.$market]['id_user'],$_SESSION['market_'.$market]['user_phone'])) == $_SESSION['market_'.$market]['SID']) ) {		
		$id_user = $_SESSION['market_'.$market]['id_user'];
		//ТУТ ПРИ ЗАГРУЗКЕ ЛОГО ИЗМЕНИТЬ НАЗВАНИЕ ФАЙЛА НА - ВЗЯТЬ ИЗ БД
		//$logo = $objData->logo;
		echo '<script>$.cookie("id_user", "'.$id_user.'", {expires: 1, path: "/"}); $.cookie("market", "'.$market.'", {expires: 1, path: "/"}); $.cookie("id_project", "'.$id_project.'", {expires: 1, path: "/"});</script><div class="wrap2">';
		//$logo = $objData->logo;
	//	echo $logo;
			echo "<div id=\"wrapper\">";
				
				if ($_SESSION['market_'.$market][freeaccess] == 0) {
					if ($_SESSION['market_'.$market][podpiska] == 0) {
						//include('platiji.php');
					} else { 
						if ($_SESSION['market_'.$market][first] == 1) {
							//include('hello.php');
						} else {
							//отчет 

						}
					}
				} else {
					if ($_SESSION['market_'.$market][first] == 1) {
						//include('hello.php');
					} else {
						//отчет 

					}
				}
 				
			echo '</div>';

			
			$logo = 'menu.png'; // ТЕСТ ФИКС КНОПКА МЕНЮ
			echo "</div>
				<div class=\"loginicon\">
					<div>
						<img width=\"128\" onmousedown=\" if ($('#loginzone').hasClass('hidden')) { $('#loginzone').removeClass('hidden');} else { $('#loginzone').addClass('hidden');} \" id=\"logob\" src=\"../img/$logo\" alt=\"logo\">
					</div>
				</div>
				<div class=\"window hidden\" id=\"loginzone\" onmouseup=\"$(this).find('.move').removeClass('move');\">
					<div class = \"menu_link highlight movable menu_head\" onmousedown=\"$(this).addClass('move');\" onmouseup=\"$(this).removeClass('move');\" id = \"menu_head\">Меню
						<span class=\"closemenu\">✖</span>
					</div>
					<div class=\"overflow menuheight\">
					</div>
				</div>
				<div class=\"window hidden fs2 z10 screen0f\" id=\"statusForm\" onmouseup=\"$(this).find('.move').removeClass('move');\">
				</div>
				<div class=\"window hidden fs2 wh100 pr z10 screen0f\" id=\"windowToForm\">
					<span class=\"fs2 closemenuf pointer closemenu\">✖</span>
					<div class=\"obolochka\">
						<div class=\"centredv lh100\">
						</div>
					</div>
				</div>
				<div class=\"hidden z100 screen0f window\" id=\"windowForm\" onmouseup=\"$(this).find('.move').removeClass('move');\">
					<div class=\"innerform\">
						<div class = \"menu_link highlight movable menu_head\" onmousedown=\"$(this).addClass('move');\" onmouseup=\"$(this).removeClass('move');\" id = \"form_head\">Окно
							<span class=\"closemenu\">✖</span>
						</div>
						<div class=\"overflow menuheight\">
						</div>
					</div>
				</div>";
		echo '</div>';
	} else {
		$loginget = '';
		if (isset($_GET['login'])) {
			$loginget = $_GET['login'];
		}
		$passwordget = '';
		if (isset($_GET['password'])) {
			$passwordget = $_GET['password'];
		}
		echo '<form method="post" class="forma">
			<input name="login" type="text" placeholder="Логин для доступа к CRM" value="'.$loginget.'" required>
			<input name="passwrd" type="password" placeholder="Пароль для доступа к CRM" value="'.$passwordget.'" required>
			<button type="submit" name="buton">Войти</button>  
			<a class="recovery" href="'.$protocol.'://'.$sitemain.'/'.$market.'/recovery.php">Забыли пароль? Восстановить</a>';
			if (isset ($_SESSION['market_'.$market]['errorentry'])){

				if  ($_SESSION['market_'.$market]['errorentry'] == '1'){

					echo '<p class = "forma_oshibka"> Логин или пароль введены неверно! </p>';
					destroySession();
				} 
			}
			echo '</form>';

	}

?>