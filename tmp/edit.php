<?php
//Сделать таблицу с Пользовательскими константами - Не показывать больше это окно или в проекте
$words = explode(' ', $phrase);
			$result .= '<div class = "mark promo tac">
							<div class = "videoZag">
								<div class="obolochka">
									<div class="centredv lh26">'.$zag.'</div>
								</div>
							</div>';
				$result .= '<div class="video">
								<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
							</div>';
				$result .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
				for ($i=0; $i < count($words); $i++) {
					//Тут надо получить id word
					$id_word = '1';
					$word = $words[$i];
					$result .= '<div class = "menubutton pointer ckc">
								<div class = "hidden value">'.$id_word.'</div>
								<div class = "hidden type">minus_word</div>
								<div class = "videoZag">
									<div class="obolochka">
										<div class="centredv lh26">'.$word.'</div>
									</div>
								</div>
							</div>';
				}
				
			$result .= '</div>';
?>