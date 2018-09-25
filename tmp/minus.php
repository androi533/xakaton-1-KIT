<?php
//Сделать таблицу с Пользовательскими константами - Не показывать больше это окно или в проекте
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
				$result .= '<div class = "menubutton pointer ckc">
								<div class = "hidden value">'.$id_phrase.'</div>
								<div class = "hidden type">minus</div>
								<div class = "videoZag">
									<div class="obolochka">
										<div class="centredv lh26">Отправить в Минус фразы</div>
									</div>
								</div>
							</div>';
			$result .= '</div>';
?>