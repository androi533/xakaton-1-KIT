<?php
	$result .= '<div class = "videos promo">';
		if(isset($error)) {
			$result .= '<div class = "error">'.$error.'</div>';
		}
		$result .= '<div class = "videoZag"><div class="obolochka"><div class="centredv lh26">'.$zag.'</div></div></div>';
			$result .= '<div class="video"><iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
			$result .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
			if ($typehtml == 'input') {
				$result .='<div class = "videoVvod"><'.$typehtml.' class ="promo_'.$typehtml.' tac w100 mt10 mb10" '.$addfield.' id="sendvalue" name="'.$field.'" placeholder="'.$placeholder.'" value="'.$value.'"></div>';
			}

			if ($typehtml == 'select') {
				$result .='<div class = "videoVvod"><'.$typehtml.' class ="promo_'.$typehtml.' tac w100 mt10 mb10 pointer" '.$addfield.' id="sendvalue" name="'.$field.'" placeholder="'.$placeholder.'">'.$innerselect.'</'.$typehtml.'></div>';
			}

			$result .= '<div class = "videoKnopka">
					<button class="Knopka w100 mt10 mb10 biYellow sendstep" name="send" id="'.$field.'">'.$textButton.'</button>
				</div>';
	$result .= '</div>';
	$result .= $script;
?>