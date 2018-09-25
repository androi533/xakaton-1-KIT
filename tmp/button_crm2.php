<?php
if (isset($js)) {$result .= ' <script type="text/javascript" charset="utf-8" src="../js/'.$js.'.js"></script>"';} 
if (isset($style)) {$result .= '<div class="obolochka hidden">';} else {$result .= '<div class="obolochka'.$formdashed.'">';}
if (isset($centred)) { $result .= '<div class="centredv">'; }
if (isset($centred)) { $result .= '<div style="display: block">'; }
if (isset($centred)) { $result .= '<div class="centredh">'; }
if (isset($centred)) { $result .= '<div style="display: inline-block;">'; }
if (isset($animate)) {$result .= '<label class="'.$animate.' '.$margin.' cacc pointer"><div class="value hidden">button</div><div class="id_form hidden">'.$id_form.'</div>';}
if (isset($obj)) {
	$result .= '<'.$obj;
		 if (isset($typebutton)) {$result .= ' type="'.$typebutton.'"';} 
		 if (isset($id)) { $result .= ' id="'.$id.'"';} 
		 if (isset($objname)) {$result .= ' name="'.$objname.'"'; } 
		 if (isset($style)) {$result .= ' style="'.$style.'"'; } 
		 if (isset($classname)) {$result .= ' class="'.$classname.'"'; } 
		 if (isset($value)) {$result .= ' value="'.$value.'"'; }
		 if (isset($placeholder)) {$result .= ' placeholder="'.$placeholder.'"'; } 
		 if (isset($onclick)) {$result .= ' onclick="'.$onclick.'"'; }  
	$result .= '/>';
}
if (isset($labelafter)) {
	$result .= '<label class="label" for="'.$typebutton.'"';
	if ($typebutton == 'email') {$result .= 'data-fon="✉">&nbsp;</label>';}
	if ($typebutton == 'tel') {$result .= 'data-fon="☎">&nbsp;</label>';}	
}
if (isset($animate)) {$result .= '</label>';} 
if (isset($centred)) {$result .= '</div>';}
if (isset($centred)) {$result .= '</div>';} 
if (isset($centred)) {$result .= '</div>';} 
if (isset($centred)) {$result .= '</div>';} 
$result .= '</div>';
?>