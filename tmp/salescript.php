<?php

	$result2 .= '<div class="salescriptanswer wh100 pr">';
	$result2 .= '
				<div class = "h42 mt6 tac br pointer pa r0 l0 scca"><div class="obolochka">
						<div class="centredv lh26">Скрипты продаж СКОРО</div>
					</div></div>';
		$result2 .= '<div class="hidden" id="step">'.$step.'</div>';
		$result2 .= '<div class="hidden" id="zayavka">'.$id_zayavka.'</div>';
		$result2 .= '<div class="hidden" id="id_project">'.$id_project.'</div>';
		$result2 .= '<div class="hidden" id="typeanswer">'.$typeanswer.'</div>';
		$resultSalescript = DB::query("SELECT * FROM `new_salescripts` WHERE `id_project`='$id_project' AND `type`='$type'");
		while ($objSalescriptAnswer = DB::fetch_object($resultSalescript)) {
			$val = $objSalescriptAnswer->val;
			$step = $objSalescriptAnswer->id;
			
			$result2 .= '
				<div class = "h42 mt6 tac br pointer scc">
					<div class="hidden type">answer</div>
					<div class="hidden val">'.$step.'</div>
					<div class="obolochka">
						<div class="centredv lh26">'.$val.'</div>
					</div>
				</div>';
		}
			$result2 .= '
				<div class = "h42 mt6 tac br pointer pa bot6 r0 l0 scca">
					<div class="hidden type">answer</div>
					<div class="hidden val">'.$step.'</div>
					<div class="obolochka">
						<div class="centredv lh26">Добавить</div>
					</div>
				</div>';
	$result2 .= '</div>';
?>