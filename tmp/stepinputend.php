<?php
	$result .= '<div class = "videos promo">
					<div class = "videoZag"><div class="obolochka"><div class="centredv lh26">'.$zag.'</div></div></div>';
			$result .= '<div class="video"><iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
			$result .='<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>';
			$result .='
				<div class = "videoKnopka">
					<button class="Knopka w100 mt10 mb10 biYellow" id="mark">'.$textButton.'</button>
				</div>';
	$result .= '</div>';
	$result .= $script;
?>