<?php?>
<div id="wrapper_Main" class="pr wh100">
	<div class="wrap_Main pa wh100">
		<header class="header tac w100">
			<div class="name_Main db tal w100 fl mw31">
				<p><a href="<?echo $objData->link_name?>"><?echo $objDesc->value ?></a>
				</p>
			</div>
			<div class="phone_Main fr tar w100 mw31">
				<span class="fs15"><a href="tel:+<?echo $PhonesCountry.$PhonesCode.$PhonesNumb ?>"><?echo $phoneG ?></a></span>
				<a id="clb" class="callback biphone" href="#callback">Заказать звонок
				<span ></span>
				</a>
				
			</div>
			<div class="logo_Main mw31 w100 dib bsc bpc" onmouseover="$(this).find('a').find('img').attr('src', 'img/<? echo $objData->logo_hover ?>')" onmouseout="$(this).find('a').find('img').attr('src', 'img/<? echo $objData->logo ?>')">
				<a href="<?echo $objData->link_logo?>"><img src="img/<? echo $objData->logo ?>" alt="logo"></a>
			</div>
	    </header>