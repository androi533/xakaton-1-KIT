<?php
$result .= '
	<div class = "promo fs14">';
	$resultUser = DB::query("SELECT * FROM `new_conk` WHERE `id_phrase`='$id_phrase'");
	while ($objSocialNetwork= DB::fetch_object($resultUser)) {
		$text = $objSocialNetwork->text;
		$href = $objSocialNetwork->href;
		$result .=  '<div class="pointer lh24"><a href="'.$href.'" target="_blank">'.$text.'</a></div>';
	}
$result .= '
	</div>';

?>