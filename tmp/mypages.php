<?php
$result .= '<div class="pointer dib w100 headsitemenu loadsite">СТРАНИЦЫ</div>';
if ($error_page <> '') {
	$result .= 		'<div class="error">'.$error_page.'</div>';	
}
$result .= 			'<div class="sites_block">
						<div class="sites">
							<div class="site_line">';

			$id_project = $sites[$id_user][0];
			$projectsDataGet = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' GROUP BY `page`");
			while ($row = DB::fetch_object($projectsDataGet)) {
				$page = $row->page;
				$durl = $durls[$id_project];
				if ($page == $namepagesite) {
					$namepagesite = $page;
					$_SESSION['market_'.$market]['namepage'] = $namepagesite;
					$result .= '		<div class="site_block tac pointer dashed pagebutton"><img class="site_img"  src="../img/str11.png"><p class="pagename">'.$page.'</p><p class="hidden market">'.$durl.'</p><p class="hidden value">showpage</p><p class="hidden numproj">'.$id_project.'</p></div>';
				} else {
					$result .= '		<div class="site_block tac pointer pagebutton"><img class="site_img"  src="../img/str11.png"><p class="pagename">'.$page.'</p><p class="hidden market">'.$durl.'</p><p class="hidden numproj">'.$id_project.'</p></div>';
				}
			}

			$result .= '
							</div>
						</div>
						<div class="sites_add">
							<div class="cacc tac pointer"><img class="site_img"  src="../img/str11.png"><p class="mt4">Новая</p><p class="hidden value">addpage</p></div>
						</div>
					</div>';
?>