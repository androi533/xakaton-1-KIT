<?php
if (isset($js)) {echo ' <script type="text/javascript" charset="utf-8" src="../js/'.$js.'.js"></script>"';} 
echo '<div class="obolochka">';
if (isset($centred)) { echo '<div class="centredv">'; }
if (isset($centred)) { echo '<div style="display: block">'; }
if (isset($centred)) { echo '<div class="centredh">'; }
if (isset($centred)) { echo '<div style="display: inline-block;">'; }
if (isset($animate)) {echo '<label class="'.$animate.' '.$margin.'">';}
if (isset($obj)) {
	echo '<'.$obj;
		 if (isset($typebutton)) {echo ' type="'.$typebutton.'"';} 
		 if (isset($id)) { echo ' id="'.$id.'"';} 
		 if (isset($objname)) {echo ' name="'.$objname.'"'; } 
		 if (isset($classname)) {echo ' class="'.$classname.'"'; } 
		 if (isset($value)) {echo ' value="'.$value.'"'; }
		 if (isset($placeholder)) {echo ' placeholder="'.$placeholder.'"'; } 
		 if (isset($onclick)) {echo ' onclick="'.$onclick.'"'; }  
	echo '/>';
}
if (isset($labelafter)) {
	echo '<label class="label" for="'.$typebutton.'"';
	if ($typebutton == 'email') {echo 'data-fon="✉">&nbsp;</label>';}
	if ($typebutton == 'tel') {echo 'data-fon="☎">&nbsp;</label>';}	
}
if (isset($animate)) {echo '</label>';} 
if (isset($centred)) {echo '</div>';}
if (isset($centred)) {echo '</div>';} 
if (isset($centred)) {echo '</div>';} 
if (isset($centred)) {echo '</div>';} 
echo '</div>';
?>