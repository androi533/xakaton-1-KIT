<?php
$video = $CONSTS['video_sites'];
$video_volume = $CONSTS['video_volume'];
$result .= '
				<div class = "site">
					<div>
						<div class="video">
							<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
						</div>
						<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>
					</div>
					<div class="pointer dib w100 headsitemenu loadsite">МОИ САЙТЫ</div>';
if ($error_site <> '') {
	$result .= 		'<div class="error">'.$error_site.'</div>';	
}					
$result .= 			'<div class="sites_block">
						<div class="sites">
							<div class="site_line">';

			$sitesGet = DB::query("SELECT * FROM `new_project_user` WHERE `id_user`='$id_user'");
			$check = DB::num_rows($sitesGet);
			if ($check > 0 ) {
				while ($row = DB::fetch_object($sitesGet)) {
					$id_project = $row->id_project;
					$sites[$id_user][] = $id_project;
				}

				for ($i=0; $i < count($sites[$id_user]); $i++) { 
					$id_project = $sites[$id_user][$i];
					$projectsGet = DB::query("SELECT * FROM `new_project` WHERE `id`='$id_project'");
					$objProj = DB::fetch_object($projectsGet);
					$durl = $objProj->durl;
					$durls[$id_project] = $durl;
					if ($durl == $market) {
						$result .= 			'<div class="site_block tac pointer projbutton dashed"><img class="site_img"  src="../img/catalog.png"><p class="market">'.$durl.'</p><p class="hidden numproj">'.$id_project.'</p></div>';
					} else {
						$result .= 			'<div class="site_block tac pointer projbutton"><img class="site_img"  src="../img/catalog.png"><p class="market">'.$durl.'</p><p class="hidden numproj">'.$id_project.'</p></div>';
					}
					
				}
			}
			

			$result .= '	</div>
						</div>
						<div class="sites_add">
							<div class="cacc pointer tac"><img class="site_img"  src="../img/catalog.png"><p class="mt4">Новый</p><p class="hidden value">addsite</p></div>
						</div>
					</div>';
?>