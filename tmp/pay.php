<?php
$result = '<div class = "pays">';
 				$preWords=DB::query("SELECT * FROM `new_tarif`");
 				$check = DB::num_rows($preWords);

				if ($check > 0) {
					$shopId = $configs['shopId'];
					$scId = $configs['scId'];
					while ($row = DB::fetch_array($preWords)) {
						$id = $row[id];
					 	$value = $row[value];
					 	$img = $row[img];
					 	$textButton = $row[alt];
					 	$idprod = $row[id_product];

					 	if ($row[cost] == 0) {
					 		if ($freeaccess == 1) {
								$cost = "Бесплатно";
						 		$costvalue = 0;
						 		$result .= '<div class = "payblock shadow round">';
									$result .= '<div class = "Zag">'.$value.'</div>';
									$result .= '<div class = ""><img class ="promoImg" src="../img/'.$img.'" alt="'.$value.'"></div>';
									$result .= '<div class = "cost red">'.$cost.'</div>';
									$result .= '<div class = "videoKnopka">
											<button class="Knopka w100 mt10 mb10" name="freeaccess">'.$textButton.'</button>
									</div>';
								$result .= '</div>';
								$result .= '<script>
									$(function() {
										"use strict";
										$(document).on("click", "button[name=freeaccess]", function(e){
											e.preventDefault();
											window.location = "'.$protocol.'://'.$sitemain.'/pay.php?product='.$id.'&user='.$id_user.'&market='.$idprod.'";
										});
									});
								</script>';
					 		}
					 	} else {
					 		$cost = "Цена: ".$row[cost];
					 		$costvalue = $row[cost];
					 		$result .= '<div class = "payblock shadow round">';
								$result .= '<div class = "Zag">'.$value.'</div>';
								$result .= '<div class = ""><img class ="promoImg" src="../img/'.$img.'" alt="'.htmlspecialchars($value).'"></div>';
								$result .= '<div class = "cost red">'.$cost.'</div>';
								$result .= '<div class = "videoKnopka">
										<input class="Knopka w100 mt10 mb10 colorbutton round shadow" name="pay_'.$id.'" value="'.$textButton.'">
								</div>';
							$result .= '</div>';
							$result .= '<script>
									$(function() {
										"use strict";
										$(document).on("click", "input[name=pay_'.$id.']", function(e){
											e.preventDefault();
											window.location = "'.$protocol.'://'.$sitemain.'/pay.php?product='.$id.'&user='.$id_user.'&market='.$idprod.'";
										});
									});
								</script>';
					 	}
					 	
						
					}
				}
 				
			$result .= '</div>';
			
?>