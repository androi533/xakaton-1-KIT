<?php 
?>
<div class="cont" id="cont_Main">
	<h1 class="offer tac fw400">

			<? echo  $objOffer->value; ?>

	</h1>
	<div class="toform">
		<? 	$platevalue = $objForm->value_button;
			echo "<div class=\"h50\">
					<div class=\"obolochka marginh\">
						<div class=\"centredv\">
							<div style=\"display: block\">
								<div class=\"centredh\">
									<div style=\"display: inline-block;\">
										<label class=\"anibtn\">
											<a href=\"#videoR_Main\" class=\"knopki pointer white biRed db lh50 border3rad\">$platevalue</a>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
		?>
	</div>
	<h2 class="offer2 tac fw400">
		<? echo  $objOffer2->value ?>
	</h2>	
	<div class="middle_Main tac">
		<?

		if (!empty($objData->video)) { 
			echo '<div class="video_Main whitesh19 alfablack4bg tal border3rad fl h100 red"><iframe id="videoR_Main" src="https://www.youtube.com/embed/'.$objData->video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
			echo '<script>var vid = document.getElementById("videoR_Main");vid.volume = 0.4;</script>';
		} else {
			echo '<style> .middle_Main {width: 100%;} @media only screen and (max-device-width: 666px), only screen and (max-width: 666px) {min-height: 388px;}  .wrapper_Main {min-height: 480px;}</style>';
		}
		?>
		<form id="after_Main" method="post" class="forma_Main fr border3rad alfablack4bg whitesh19 h100">

			<div class="formtext"><div class="centredv p22"><p id="kol_Main" class="formaaaa tac fs15 yellow"><? echo $objForm->value_text;?> </p></div></div>
			<div class="formbot">
				<? 



					$resInputsForms = DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form` = '$id_form'");
					$check=DB::num_rows($resInputsForms);
					if ($check >= 1) {
						while ($arnew = mysql_fetch_array($resInputsForms)) {
							$idinput[]= $arnew['id_inputs'];
						}
						$sqladdtext = '';
						for ($i=0; $i < count($idinput); $i++) {
							$input = $idinput[$i];
							if ($sqladdtext == '') {
								$sqladdtext .= "`id` = '$input'";
							} else {
								$sqladdtext .= " OR `id` = '$input'";
							}
						}

						$sqlinputs = "SELECT * FROM `new_inputs` WHERE $sqladdtext";
						$resinputs = DB::query($sqlinputs);
						while ($inputs = mysql_fetch_object($resinputs)) {
							$inputtypeid = $inputs->id_type;

							$sqlinputstype = "SELECT * FROM `new_inputs_type` WHERE `id` = '$inputtypeid'";
							$resinputstype = DB::query($sqlinputstype);
							$inputstype = mysql_fetch_object($resinputstype);
							$typebutton = $inputstype->type;
							//echo "$typebutton";
							$inputname = $inputs->name;
							$inputplaceholder = $inputs->placeholder;
							if ($inputs->required == 1) {
								$required = 'required';
							} else {
								$required = '';
							}
							
							if ($inputname == 'address') {
								require ("address.php");
							} else {
								require ("input.php");
							}
						}
					}
				?>
				<?  //Добавление кнопок изменить? 
				unset($labelafter); $animate = "anibtn_Main"; $value = $objForm->value_button; $centred = "yes"; $margin = "marginh"; $typebutton = "submit"; $classname = "buton biYellow border3rad white fw400 fs15 db pointer";  $objname = "buton"; $id = "buton"; $obj = "input"; unset($onclick); unset($placeholder); include("button.php");
				if (isset($link_addition)) {
					if ($addition <> '') {
						if ($namepage == 'keyword') {
							if ( (isset($_SESSION['market_'.$market]['email'])) or (isset($_SESSION['market_'.$market]['phone'])) ){
								if (isset($_SESSION['market_'.$market]['email'])) {
									$login = $_SESSION['market_'.$market]['email'];
								}
								if (isset($_SESSION['market_'.$market]['phone'])) {
									$login = $_SESSION['market_'.$market]['phone'];
								}
							}
							echo "<a href=\"$link_addition?login=$login\" target=\"_self\">$addition</a>";
						} else {
							echo "<a href=\"$link_addition\" target=\"_blank\">$addition</a>";
						}
					}
				}
				 ?>
				
			</div>
		</form>
	</div>
	<div class="planki">
		<? include ('plashki.php') ?>
	</div>
</div>