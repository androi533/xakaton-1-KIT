<?php 

	$result .= '
	<div class="wh100">';
	if (isset($error)) {
		$result .= '<div class="error">'.$error.'</div>';
	}
		$result .= '<div class="pa voronkaleft">
			<div class="wh100">';
	$voronkaGet = DB::query("SELECT * FROM `new_voronka` WHERE `id_project`='$id_project'");
	$check = DB::num_rows($voronkaGet);
	if ($check > 0 ) {
		while ($row = DB::fetch_array($voronkaGet)) {
			$voronkamas['pd'][] = $row['id_project_data'];
			$voronkamas['pd2'][] = $row['id_project_data2'];
			$voronkamas['step'][] = $row['step'];
		}
	}
	$pageGet = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' ORDER BY `page`");
	$check = DB::num_rows($pageGet);
	if ($check > 0 ) {
		while ($row = DB::fetch_array($pageGet)) {
			$pagename = $row['page'];
			$pageid = $row['id'];
			$pagenames[$pageid] = $pagename;
			if (  (!in_array($pageid, $voronkamas['pd'])) AND  (!in_array($pageid, $voronkamas['pd2']))  ) {
				
				$result .= '
					<div class="site_block_line pagebtn">
						<div class="wh100 blockpage pointer">
							<div class="imgline bipage"></div>
							<div class="text mt4 pagename">'.$pagename.'</div>
							<div class="hidden text mt4 pageid">'.$pageid.'</div>
						</div>
					</div>';
			}
		}
	}	

	$result .= '	
			</div>
		</div>
		<div class="pa voronkaright">
			<div class="wh100">
				';

	$voronkaGet = DB::query("SELECT * FROM `new_voronka` WHERE `id_project`='$id_project' GROUP BY `id_project_data`");
	$check = DB::num_rows($voronkaGet);
	if ($check > 0 ) {
		while ($row = DB::fetch_array($voronkaGet)) {
			$stepvoronka = $row['step'];
			$voronkaarr[$stepvoronka]['pro'][] = $row['id_project'];
			$voronkaarr[$stepvoronka]['from'][] = $row['id_project_data'];
			$voronkaarr[$stepvoronka]['to'][] = $row['id_project_data2'];
		}
		
		for ($i=1; $i <= count($voronkaarr); $i++) { 
			$result .= '
				<div class="site_block_line_right">
					<div class="wh100">
						<div class="text voronka_head">ШАГ '.$i.'</div>
						<div class="voronka_line w100">
				';
			foreach ($voronkaarr[$i]['from'] as $key => $value) {
				$namepage = $pagenames[$value];
				$numproj = $voronkaarr[$i]['pro'][$key];
				$result .= '
							<div class="step pointer dashed">
								<div class="imgline bipage"></div>
								<div class="text mt4 namepage">'.$namepage.'</div>
								<div class="text mt4 hidden pagename">'.$namepage.'</div>
								<div class="text mt4 hidden stepnumb">'.$i.'</div>
								<div class="text mt4 hidden pageid">'.$value.'</div>
								<div class="text mt4 hidden delvoronka">X</div>
							</div>
				';
			}
			$result .= '
						<div class="step pointer dashed emptyfield">
								<div class="imgline"></div>
								<div class="text mt4 namepage"></div>
								<div class="text mt4 hidden stepnumb">'.$i.'</div>
								<div class="text mt4 hidden pageid"></div>
							</div>
						</div>
					</div>
				</div>
				';
		}

$result .= '
				<div class="site_block_line_right">
					<div class="wh100">
						<div class="text voronka_head" id="laststepscroll">ШАГ '.$i.'</div>
						<div class="voronka_line w100">
							<div class="step pointer dashed emptyfield">
								<div class="imgline"></div>
								<div class="text mt4"></div>
								<div class="text mt4 hidden stepnumb">'.$i.'</div>
							</div>
						</div>
					</div>
				</div>
				';
	}			

	$result .= '
			</div>
		</div>
	</div>';
?>