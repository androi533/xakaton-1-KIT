<?php
$title = 'Директолог+';
$description = 'Увеличьте прибыль до 400%, уделяя всего 8 минут в день уже сейчас! Перейдите по ссылке и получите 3-х дневный бесплатный доступ!';
$url = 'http://directolog-plus.ru/directologplus/index.php?ref='.$user_ref;
$image_url = 'http://directolog-plus.ru/img/logo2.png';

			$result .= '<div class = "mark promo">';
			$result .= '<div class = "fs3 promoZag"><div class="obolochka">
							<div class="centredv">'.$zag.'</div>
							</div></div>';
			$result .= '<div class="video">
							<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
						</div>';
			
			$result .= '<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
				$result .= '<div class = "videoZag">
								<div class="obolochka">
									<div class="centredv lh26">
										<a class="bonus" href="http://vk.com/share.php?url='.urlencode($url).'&title='.urlencode($title).'&text='.urlencode($description).'&image='.urlencode($image_url).'&noparse=true" onclick="window.open(this.href, this.title, \'toolbar=0, status=0, width=548, height=325\'); return false" title="Сделать репост в Вконтакте" target="_parent">Сделать репост</a>
									</div>
								</div>
							</div>';
			$result .= '</div>';
?>