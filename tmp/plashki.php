<?php

	$resPlatesUser = DB::query("SELECT * FROM `new_plates_user` WHERE `id_project_data` = '$id_project_data'");
	$check=DB::num_rows($resPlatesUser);
	$result="";
	if ($check >= 1) {
		while ($arnew = mysql_fetch_array($resPlatesUser)) {
			$idplate[]= $arnew['id_plates'];
		}

		$sqladdtext = '';
		for ($i=0; $i < count($idplate); $i++) {
			$input = $idplate[$i];
			if ($sqladdtext == '') {
				$sqladdtext .= "`id` = '$input'";
			} else {
				$sqladdtext .= " OR `id` = '$input'";
			}
		}

		$sqlplates = "SELECT * FROM `new_plates` WHERE $sqladdtext";
		$resplates = DB::query($sqlplates);
		while ($plates = mysql_fetch_object($resplates)) {
			$platelink = $plates->link;
			$platevalue = $plates->value;
			$plateimg = $plates->img;
			$result .= "
	<div class=\"plashka1\">
		<img src=\"img/$plateimg\" class=\"imgplashka\">
		<div class=\"h50\">
			<div class=\"obolochka marginh\">
				<div class=\"centredv\">
					<div style=\"display: block\">
						<div class=\"centredh\">
							<div style=\"display: inline-block;\">
								<label class=\"anibtn_Main\">
									<a href=\"$platelink\" class=\"knopki pointer white biRed db lh50 border3rad\">$platevalue</a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
				";
		}
	}
	echo "$result";
?>