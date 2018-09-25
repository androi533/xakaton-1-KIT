<?php

	$result .= '<div class="salescriptanswer wh100 pr">';
		$result .= '<span class="closemenu pointer closeanswer">✖</span>';
		$result .= '<div class="hidden" id="step">'.$step.'</div>';
		$result .= '<div class="hidden" id="zayavka">'.$id_zayavka.'</div>';

		$resultSalescriptAnswer = DB::query("SELECT * FROM `new_salescripts_answer` WHERE 1");
		while ($objSalescriptAnswer = DB::fetch_object($resultSalescriptAnswer)) {
			$val = $objSalescriptAnswer->val;
			$step = $objSalescriptAnswer->id;
			
			$result .= '
				<div class = "h42 mt6 tac br pointer scc">
					<div class="hidden type">answer</div>
					<div class="hidden val">'.$step.'</div>
					<div class="obolochka">
						<div class="centredv lh26">'.$val.'</div>
					</div>
				</div>';
		}
	$result .= '</div>';
?>