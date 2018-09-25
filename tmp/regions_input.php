<?php

	include("../conf/start.php");
	include("../conf/session.php");
	$sqlregions = DB::query("SELECT * FROM `new_regions`");

	while ($region = DB::fetch_object($sqlregions)) {
		$parent_id = $region->id_parent;
		$region_id = $region->region_id;
		$type_id = $region->type_id;
		$name = $region->name;
		$regions[$parent_id]['type_id'][] = $type_id;
		$regions[$parent_id]['region_id'][] = $region_id;
		$regions[$parent_id]['name'][] = $name;
	}

	function build_tree($regions, $parent_id, $lvl){
		for ($i=0; $i < count($regions[$parent_id]['name']); $i++) { 
			$name = $regions[$parent_id]['name'][$i];
			$type_id = $regions[$parent_id]['type_id'][$i];
			$region_id = $regions[$parent_id]['region_id'][$i];
			$cou = count($regions[$parent_id]['region_id'])-1;
			echo '<input class="checkbox__control" type="checkbox" autocomplete="off" id="region-'.$region_id.'" aria-labelledby="labelregion-'.$region_id.'">';
			echo '<label class="checkbox__label" aria-hidden="true" id="labelregion-'.$region_id.'" for="region-'.$region_id.'">'.$name.'</label><br>';
			if ($i == count($regions[$parent_id]['region_id'])-1 ) {
				$lvl--;
			}
			if (count($regions[$region_id]['region_id']) > 0 ) {
				$lvl++;
				$margin = 20*$lvl;
				echo "<div class=\"tree\">⊕</div>";
				echo "<div class=\"parentregion-$region_id hidden\" style=\"margin-left:$margin\">";
				build_tree($regions, $region_id, $lvl);
				echo "</div>";
				$lvl--;
			}
		}
	}

	echo '
				<script>
					$(document).on("click", ".checkbox__control", function(e){
						if (e.which == 1) { if (this.checked) {console.log($(this).attr("id")); } }
					});
					$(document).on("click", ".tree", function(e){
						if (e.which == 1) { if ($(this).next().hasClass("hidden")) {$(this).next().removeClass("hidden");} else {$(this).next().addClass("hidden");} }
					});
				</script>';
	/*$result .= '
				<script>
					$(document).on("click", ".checkbox__control", function(e){
						if (e.which == 1) { if (this.checked) {console.log($(this).attr("id")); } }
					});
					$(document).on("click", ".tree", function(e){
						if (e.which == 1) { if ($(this).next().hasClass("hidden")) {$(this).next().removeClass("hidden");} else {$(this).next().addClass("hidden");} }
					});
				</script>
				';*/
	echo "<div class=\"treehead\">";
	echo '<input class="checkbox__control" type="checkbox" autocomplete="off" id="region-0" aria-labelledby="labelregion-0">';
	echo '<label class="checkbox__label b-regions-tree__region-name" aria-hidden="true" id="labelregion-0" for="region-0">Все</label><br>';
	build_tree($regions, 0, 0);
	echo "</div>";
?>