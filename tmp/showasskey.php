<?php
	//Предпросмотр объявления для РСЯ
			$phrasesGet = DB::query("SELECT * FROM `new_phrases_used` WHERE `status`='2' AND `id_project`='$id_project' AND `id_user`='$id_user' LIMIT 30"); //Ассоциативные
			$check = DB::num_rows($phrasesGet);

			if ($check > 0 ) {
				$result .= '<div class = "fs3 promo">';
				
				$result .= '	<div class = "videoZag">
									<div class="obolochka">
										<div class="centredv lh32">Список ассоциативных ключевых запросов</div>
									</div>
								</div>';
					$result .= '<div class="video">
									<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
								</div>';
					$result .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
					
				
					$result .= '
							<div class = "promoIn">';		
				while ($row = DB::fetch_object($phrasesGet)) {
					//$phrase = $row->changephrase;
					$phrase = $row->phrase;
					$id = $row->id_phrase;
					$urlphraseya = urlencode($phrase);
					$result .= '
					<div class="pb6 lh32 h64 pt6 phraseline">
						<div class="phrase inline fl">
							<div class="obolochka">
								<div class="centredv lh32">
									<a href="https://yandex.ru/search/?text='.$urlphraseya.'" target="_blank">'.$phrase.'</a>
								</div>
							</div>
						</div>
						<div class="inline fr mmk tac">
							<div class="fkz fkzc inline vac">
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">add</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/add.png" class="ma w22 block">
										</div>
									</div>
								</div>
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">edit</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/edit.png" class="ma w22 block">
										</div>
									</div>
								</div>
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">minus</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/minus.png" class="ma w22 block">
										</div>
									</div>
								</div>
							</div>
							<div class="fpv fpvc inline vac">
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">konk</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/konk.png" class="ma w22 block">
										</div>
									</div>
								</div>
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">ads</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/ads.png" class="ma w22 block">
										</div>
									</div>
								</div>
								<div class="pointer cmmk inline">
									<div class="obolochka">
										<div class="centredv lh32">
											<div class="hidden value">www</div>
											<div class="hidden id">'.$id.'</div>
											<img src = "../img/www.png" class="w22 ma block">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>';
				}
				$result .=  "
						</div>
					</div>";
				
			} else {
				$result .= '<div class = "mark promo">';
			
				$result .= '	<div class = "videoZag">
									<div class="obolochka">
										<div class="centredv lh32">Нет используемых ассоциативных ключевых запросов</div>
									</div>
								</div>';
				$result .= '</div>';
			}
?>