<?php

		$result = '<div class = "pointer menu_link lh22" id = "welcome"><img src = "../img/privet.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Приветствие</div></div>';

		if ($_SESSION['market_'.$market][first] == 1) { //Ну типа SESSION не должна работать тогда тут надо получать //СТРАННО РАБОТАЕТ А ПОЧЕМУ У НЕГО С КОРЗИНОЙ НЕ РАБОТАЛО? ПОХ ПОКА КРЧ
			$result .= '<div class = "pointer menu_link lh22" id = "start"><img src = "../img/start.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Начать</div></div>';
		} else {
			if ($_SESSION['market_'.$market][podpiska] == 0) {
				$result .= '<div class = "pointer menu_link lh22" id = "pay"><img src = "../img/opl.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Оплата</div></div>';
			}
			if ( ($_SESSION['market_'.$market][podpiska] <> 0) OR ($_SESSION['market_'.$market][freeaccess] <> 0) ) {
				if ($_SESSION['market_'.$market][laststep] == 1) {
					$result .= '<div class = "pointer menu_link lh22" id = "start"><img src = "../img/start.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Начать</div></div>';
				} else {
					if ($_SESSION['market_'.$market][laststep] < $myac) {
						$result .= '<div class = "pointer menu_link lh22" id = "next"><img src = "../img/start.png" class="mr6 w22"><div id = "next" class="mr6 inline overhid nospace">Продолжить</div></div>';
					} else {
						$result .= '<div class = "pointer menu_link lh22" id = "acc"><img src = "../img/akkaunt.png" class="mr6 w22"><div id = "acc" class="mr6 inline overhid nospace">Личный кабинет</div></div>';
						if ($_SESSION['market_'.$market][laststep] < $myre) {
							$result .= '<div class = "pointer menu_link lh22" id = "next"><img src = "../img/start.png" class="mr6 w22"><div id = "next" class="mr6 inline overhid nospace">Продолжить</div></div>';
						} else {
							$result .= '<div class = "pointer menu_link lh22" id = "mark"><img src = "../img/reklama.png" class="mr6 w22"><div id = "mark" class="mr6 inline overhid nospace">Улучшить рекламу</div></div>';
							$result .= '<div class = "pointer menu_link lh22" id = "otchet"><img src = "../img/otchet.png" class="mr6 w22"><div id = "otchet" class="mr6 inline overhid nospace">Отчет</div></div>';
							$result .= '<div class = "pointer menu_link lh22" id = "delegirovanie"><img src = "../img/del.png" class="mr6 w22"><div id = "delegirovanie" class="mr6 inline overhid nospace">Делегирование</div></div>';
							if ($_SESSION['market_'.$market][laststep] < $mysi) {
								$result .= '<div class = "pointer menu_link lh22" id = "next"><img src = "../img/start.png" class="mr6 w22"><div id = "next" class="mr6 inline overhid nospace">Продолжить</div></div>';
							} else {
								$result .= '<div class = "pointer menu_link lh22" id = "zayavki"><img src = "../img/zayavki.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Заявки</div></div>';
								$result .= '<div class = "pointer menu_link lh22" id = "sait"><img src = "../img/cait.png" class="mr6 w22"><div class="mr6 inline overhid nospace">Мои сайты</div></div>';
							}
						}
					}
				}
			}
		}
		$result .= '<div class = "pointer menu_link lh22"><img src = "../img/special.png" class="mr6 w22"><div id = "bonus" class="mr6 inline overhid nospace">Бонусная программа</div></div>';
		$result .= '<div class = "pointer menu_link lh22"><img src = "../img/exit.png" class="mr6 w22"><div id = "exitB" class="mr6 inline overhid nospace">Выйти</div></div>';
?>