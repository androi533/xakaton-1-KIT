<?php
	if (!isset($CONSTS)) {
		$resultConsts = DB::query("SELECT * FROM `CONSTS` WHERE 1");
		$check = DB::num_rows($resultConsts);
		if ($check > 0 ) {
			while ($row = DB::fetch_object($resultConsts)) {
				$field = $row->field;
				$value = $row->value;
				$CONSTS[$field] = $value;
			}
		}
	}
?>