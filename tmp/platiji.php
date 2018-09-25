<?php
	$result = '<div class = "pays">';
	$preWords=DB::query("SELECT * FROM `new_tarif`");
	$check = DB::num_rows($preWords);

	if ($check > 0) {
		$shopId = $configs['shopId'];
		$scId = $configs['scId'];
		$id_user = $_SESSION['market_'.$market]['id_user'];
		$freeaccess = $_SESSION['market_'.$market]['freeaccess'];
		while ($row = DB::fetch_array($preWords)) {
			$id = $row[id];
		 	$value = $row[value];
		 	$img = $row[img];
		 	$textButton = $row[alt];

		 	if ($row[cost] == 0) {
		 		if ($freeaccess == 1) {
					$cost = "Бесплатно";
			 		$costvalue = 0;
			 		$result .= '<div class = "payblock shadow round">';
						$result .= '<div class = "Zag">'.$value.'</div>';
						$result .= '<div class = ""><img class ="promoImg" src="img/'.$img.'" alt="'.$value.'"></div>';
						$result .= '<div class = "cost blue">'.$cost.'</div>';
						$result .= '<div class = "videoKnopka">
								<button class="Knopka w100 mt10 mb10 round shadow" name="freeaccess">'.$textButton.'</button>
						</div>';
					$result .= '</div>';
		 		}
		 	} else {
		 		$cost = "Цена: ".$row[cost];
		 		$costvalue = $row[cost];
		 		$result .= '<div class = "payblock shadow round">';
					$result .= '<div class = "Zag">'.$value.'</div>';
					$result .= '<div class = ""><img class ="promoImg" src="img/'.$img.'" alt="'.$value.'"></div>';
					$result .= '<div class = "cost blue">'.$cost.'</div>';
					$result .= '<div class = "videoKnopka">
						<form action="https://demomoney.yandex.ru/eshop.xml" method="POST">
							<input name="shopId" value="'.$shopId.'" type="hidden">
							<input name="scid" value="'.$scId.'" type="hidden">
							<input name="customerNumber" value="'.$id_user.'" type="hidden">
							<input name="sum" value="'.$costvalue.'.00" type="hidden">
							<input class="Knopka w100 mt10 mb10 colorbutton round shadow" type="submit" value="'.$textButton.'">
						</form>
					</div>';
				$result .= '</div>';
		 	}
		} 	
	}
	echo $result;					
?>