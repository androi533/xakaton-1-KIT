<?php 
	include("../conf/start.php");
	include("../conf/session.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];

	$result = '';

	if(!empty($_POST)) {		
		if (isset($_POST['sizes'])) {
			$w = $_POST['w'];
			$h = $_POST['h'];
			//$result = '<canvas class="pa corner" width="'.$w.'" height="'.$h.'" id="tablet" ></canvas>'; // onmousedown="StartFigure(this)" onmouseup="EndFigure(this)" onmousemove="Draw(event, this)"
			$result = '{"width":"'.$w.'", "height":"'.$h.'"}';
			//$result = "'width', '$w'";
		}

		if (isset($result)) {
   			echo $result;
		}
	}



?>