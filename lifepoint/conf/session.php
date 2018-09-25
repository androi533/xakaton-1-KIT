<?php
$isUserActivity = false;
if (isset($_SESSION['id_user'])) {
	$isUserActivity = true;
}

function startSession($isUserActivity=false) {
	// Если сессия уже была запущена, прекращаем выполнение и возвращаем TRUE
	// (параметр session.auto_start в файле настроек php.ini должен быть выключен - значение по умолчанию)

	if ( isset($_SESSION['exit']) )
	{
		destroySession();
		return session_start();
	}

	if ($isUserActivity) {
		return true;
	} else {
		return session_start();
	}

	//$sessionLifetime = 300; //5 минут

	

	/*if ( session_id() ) return true;
	
	ini_set('session.cookie_lifetime', $sessionLifetime);
	
	if ( $sessionLifetime ) ini_set('session.gc_maxlifetime', $sessionLifetime);
	
	$t = time();
	
	if ( $sessionLifetime ) {
		// Если таймаут отсутствия активности пользователя задан,
		// проверяем время, прошедшее с момента последней активности пользователя
		// (время последнего запроса, когда была обновлена сессионная переменная lastactivity)
		if ( isset($_SESSION['lastactivity']) && $t-$_SESSION['lastactivity'] >= $sessionLifetime ) {
			// Если время, прошедшее с момента последней активности пользователя,
			// больше таймаута отсутствия активности, значит сессия истекла, и нужно завершить сеанс
			destroySession();
			return session_start();
		}
		else {
			// Если таймаут еще не наступил,
			// и если запрос пришел как результат активности пользователя,
			// обновляем переменную lastactivity значением текущего времени,
			// продлевая тем самым время сеанса еще на sessionLifetime секунд
			$_SESSION['lastactivity'] = $t;
		}
	} else {
		return session_start();
	}*/
}

function destroySession() {
	if ( session_id() ) {
		// Если есть активная сессия, удаляем куки сессии,
		/*setcookie(session_name(), session_id(), time()-$sessionLifetime);
		setcookie("prod", '', time()-$sessionLifetime);*/

		// и уничтожаем сессию
		unset($_SESSION['user_id']);
		unset($_SESSION['SID']);
		unset($_SESSION['exit']);
		unset($_SESSION['lastactivity']);
	}
		session_unset();
		session_destroy();
		
}

startSession();

?>