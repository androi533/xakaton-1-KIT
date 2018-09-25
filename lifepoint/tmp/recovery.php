<?php
	setlocale(LC_ALL, 'ru_RU.cp1251'); 
	date_default_timezone_set('Asia/Ekaterinburg'); 

	if (isset($_POST['buton'])) {
		//print_r($_POST);
		if (!empty($_POST['email'])) {
			//print_r($_SESSION);
			$email = trim($_POST['email']); 
			$exists = "SELECT * FROM `new_users` WHERE `email` = '$email'"; //тут надо добавить durl проверку  $emailtext
			$ql = DB::query($exists);
			$check = DB::num_rows($ql);
			$_SESSION['error_recovery'] = '0';
			if ($check==1) {
				$objUserSes=DB::fetch_object($ql);
				$_SESSION['recovery_email'] = $objUserSes->email; 
				$_SESSION['recovery_login'] = $objUserSes->phone;
				//header('Location: http://directolog-plus.ru/directologplus/recovery.php');
				//exit;
			} elseif ($check==0) {
				$_SESSION['error_recovery'] = '1';
				 //header('Location: http://directolog-plus.ru/directologplus/recovery.php');
				//echo 'Такого пользователя нет!';
			} else {
				$_SESSION['error_recovery'] = '2';
				// header('Location: http://directolog-plus.ru/directologplus/recovery.php');
				//echo 'Несколько пользователей!';
			}
		} else {
			if (!empty($_POST['login'])) {
				$login = trim($_POST['login']);
				
				$exists = "SELECT * FROM `new_users` WHERE `phone` = '$login'"; //тут надо добавить durl проверку  $emailtext
				$ql = DB::query($exists);
				$check = DB::num_rows($ql);
				$_SESSION['error_recovery'] = '0';
				if ($check==1) {
					$objUserSes=DB::fetch_object($ql);
					$_SESSION['recovery_email'] = $objUserSes->email; 
					$_SESSION['recovery_login'] = $objUserSes->phone;
					//header('Location: http://directolog-plus.ru/directologplus/recovery.php');
					//exit;
				} elseif ($check==0) {
					$_SESSION['error_recovery'] = '1';
					 //header('Location: http://directolog-plus.ru/directologplus/recovery.php');
					//echo 'Такого пользователя нет!';
				} else {
					$_SESSION['error_recovery'] = '2';
					// header('Location: http://directolog-plus.ru/directologplus/recovery.php');
					//echo 'Несколько пользователей!';
				}
			}
		}
	}

	
	if (isset($_POST['change'])) {
		if ((!empty($_POST['password1'])) && (!empty($_POST['password2']))) {
			$password1 = trim($_POST['password1']);
			$password2 = trim($_POST['password2']);
			if ((strlen($password1)>=8) && (strlen($password1)>=8)) {
				if ($password1===$password2) {				
					$email = $_SESSION['recovery_email'];
					$phone = $_SESSION['recovery_login'];	
					$subject2 = 'Directolog-Plus.ru - Директолог Плюс';
					$text2 = 'Пароль восстановлен.';
					$text23 = 'Ваш логин:'.$phone.' или '.$email;
					$text24 = 'Ваш пароль '.$password1;
					$text22 = '<html><head><title>Directolog-Plus.ru | Директолог Плюс</title></head><body><p>'.$text2.'</p><p>'.$text23.'</p><p>'.$text24.'</p>
					</body></html>';
					$to2 = $email;
					$headers2  = "Content-type: text/html; charset=utf8 \r\n";
					$headers2 .= "From: Directolog-Plus.ru <vinhunter@ya.ru>\r\n";
					$headers2 .= "Bcc: vinhunter@ya.ru\r\n";
					$ma =mail($to2, $subject2, $text22, $headers2);/**/
					$exists = "UPDATE `new_users` SET `password`='$password1' WHERE `email` = '$email'";
					$ql = DB::query($exists);
					session_unset('recovery_email');
					header('Location: http://directolog-plus.ru/directologplus/CRM3.php');
				} else {
					$_SESSION['error_recovery'] = '4';
					echo 'Пароли не совпадают';	
				}
			} else {
				$_SESSION['error_recovery'] = '3';
				echo 'Минимальная длина пароля 8 символов!';
			}
		}
	}

	if ( (isset($_SESSION['recovery_email'])) || (isset($_SESSION['recovery_login']))  ) {		

		$email = $_SESSION['recovery_email'];
		$login = $_SESSION['recovery_login'];
				echo '<form method="post" class="forma">';
		if (isset ($_SESSION['error_recovery'])){

			if  ($_SESSION['error_recovery'] == '1'){

				echo '<p class = "forma_oshibka"> Такого пользователя нет! </p>';
			}
			if  ($_SESSION['error_recovery'] == '2'){

				echo '<p class = "forma_oshibka"> Несколько пользователей! </p>';
			}
			if ($_SESSION['error_recovery'] == '3'){

				echo '<p class = "forma_oshibka"> Минимальная длина пароля 8 символов! </p>';
			}
			if ($_SESSION['error_recovery'] == '4'){

				echo '<p class = "forma_oshibka"> Пароли не совпадают </p>';
			}
		}
		echo ' 
			<input name="password1" type="text" placeholder="Новый пароль" required>
			<input name="password2" type="text" placeholder="Подтвердите пароль" required>
			<button class="nibud" type="submit" name="change">Изменить</button>
			 </form>
			'; 
	} else {
		echo '<form method="post" class="forma">';
		if (isset ($_SESSION['error_recovery'])){

			if  ($_SESSION['error_recovery'] == '1'){

				echo '<p class = "forma_oshibka"> Такого пользователя нет! </p>';
			}
			if  ($_SESSION['error_recovery'] == '2'){

				echo '<p class = "forma_oshibka"> Несколько пользователей! </p>';
			}
			if ($_SESSION['error_recovery'] == '3'){

				echo '<p class = "forma_oshibka"> Минимальная длина пароля 8 символов! </p>';
			}
			if ($_SESSION['error_recovery'] == '4'){

				echo '<p class = "forma_oshibka"> Пароли не совпадают </p>';
			}
		}
			echo '<input name="login" type="phone" placeholder="Телефон для доступа к CRM">
			<input name="email" type="email" placeholder="E-mail для доступа к CRM">
			<button class="nibud" type="submit" name="buton">Напомнить</button>  
			 </form>
			';

	}

?>