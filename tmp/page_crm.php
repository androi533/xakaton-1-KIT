<?php 
	function hexToRgb($color) {
		// проверяем наличие # в начале, если есть, то отрезаем ее
		if ($color[0] == '#') {
			$color = substr($color, 1);
		}
	   
		// разбираем строку на массив
		if (strlen($color) == 6) { // если hex цвет в полной форме - 6 символов
			list($red, $green, $blue) = array(
				$color[0] . $color[1],
				$color[2] . $color[3],
				$color[4] . $color[5]
			);
		} elseif (strlen($cvet) == 3) { // если hex цвет в сокращенной форме - 3 символа
			list($red, $green, $blue) = array(
				$color[0]. $color[0],
				$color[1]. $color[1],
				$color[2]. $color[2]
			);
		}else{
			return false; 
		}
	 
		// переводим шестнадцатиричные числа в десятичные
		$red = hexdec($red); 
		$green = hexdec($green);
		$blue = hexdec($blue);
		 
		// вернем результат
		return "$red, $green, $blue";
	}
	//получить название страницы
	$errorload = false;
	if (!isset($namepagesite) OR ($namepagesite == '')) {
		if (!isset($_SESSION['market_'.$market]['namepage'])) {
			$namepagesite = $_SESSION['market_'.$market]['namepage'];
		} else {
			$namepagesite = 'index';
		}
	}

	if (!isset($id_project)) {
		if (!isset($_SESSION['market_'.$market]['id_project'])) {
			$id_project = $_SESSION['market_'.$market]['id_project'];
		} else {
			$errorload = true;
		}
	}
	if ($errorload) {
		//echo $_SESSION['market_'.$market]['namepage'];
		echo 'Ошибка загрузки страницы. Попробуйте снова.'; //Оформить
	} else {
		//echo "ИМЯ СТРАНИЦЫ $namepagesite PROJECT $id_project!!!";

		$resultProjData = DB::query("SELECT * FROM `new_project_data` WHERE `id_project`='$id_project' AND `page`='$namepagesite'");
		$objData=DB::fetch_object($resultProjData);
		$id_project_data = $objData->id;
		$id_phone = $objData->id_phone;
		$sendemail = $objData->email;
		$idoffer = $objData->id_offer;
		$idoffer2 = $objData->id_offer2;
		$iddesc = $objData->id_desc;
		$idform = $objData->id_form;
		$link_name = $objData->link_name;
		$logo = $objData->logo;
		$logo_hover = $objData->logo_hover;
		$link_logo = $objData->link_logo;
		$addition = $objData->addition;
		$link_addition = $objData->link_addition;

		$resultOffer = DB::query("SELECT * FROM `new_offers_main` WHERE `id`='$idoffer'");
		$objOffer=DB::fetch_object($resultOffer);
		$offerdashed = '';
		if ($idoffer == '1') {
			$offerdashed = ' dashed';
		}

		$resultOffer2 = DB::query("SELECT * FROM `new_offers_add` WHERE `id`='$idoffer2'");
		$objOffer2=DB::fetch_object($resultOffer2);
		$offer2dashed = '';
		if ($idoffer2 == '1') {
			$offer2dashed = ' dashed';
		}

		$resultDesc = DB::query("SELECT * FROM `new_descs` WHERE `id`='$iddesc'");
		$objDesc=DB::fetch_object($resultDesc);
		$descdashed = '';
		if ($iddesc == '1') {
			$descdashed = ' dashed';
		}
		$desc = $objDesc->value;

		$resultDesc = DB::query("SELECT * FROM `new_forms` WHERE `id`='$idform'");
		$objForm=DB::fetch_object($resultDesc);
		$id_form = $objForm->id;
		$formdashed = '';
		if ($idform == '1') {
			$formdashed = ' dashed';
			$formbuttondashed = ' dashed';
		}

		$resultPhones = DB::query("SELECT * FROM `new_phones` WHERE `id`='$id_phone'");
		$objPhones = DB::fetch_object($resultPhones);
		$idPhonesCountry = $objPhones->id_country;
		$idPhonesCode = $objPhones->id_city;
		$PhonesNumb = $objPhones->numb;
		$phonedashed = '';
		if ($id_phone == '1') {
			$phonedashed = ' dashed';
		}

		$resultPhonesCode = DB::query("SELECT * FROM `new_phones_code` WHERE `id`='$idPhonesCode'");
		$objPhonesCode = DB::fetch_object($resultPhonesCode);
		$PhonesCode = $objPhonesCode->value;

		$resultPhonesCountry = DB::query("SELECT * FROM `new_phones_country` WHERE `id`='$idPhonesCountry'");
		$objPhonesountry = DB::fetch_object($resultPhonesCountry);
		$PhonesCountry = $objPhonesountry->value;

		$phoneN = substr_replace($PhonesNumb, "-", 3, 0);
		$phoneN = substr_replace($phoneN, "-", 6, 0);
		$phoneG = '+'.$PhonesCountry.' ('.$PhonesCode.') '.$phoneN;
		$phone = $PhonesCountry.$PhonesCode.$PhonesNumb;

		if ($objData->backimg <> '') {
			$img = $objData->backimg;
			$transparent = $objData->transparent;
			$colorFont = $objData->colorFont;
			$colorBG = $objData->colorBG;
			$colorF = hexToRgb($colorFont);
			$colorB = hexToRgb($colorBG);
			$backimagedashed = '';
		} else {
			$backimagedashed = ' dashed';
		}

		$video = $CONSTS['video_pagecrm'];
		$video_volume = $CONSTS['video_volume'];
		$result .='
		<div>
			<div class="video">
				<iframe id="videoR" src="https://www.youtube.com/embed/'.$video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
			</div>
			<script>var vid = document.getElementById("videoR");vid.volume = '.$video_volume.';</script>
		</div>
		<div>
			<div class="pr w224 h84 dib btbb mr6 vat mb10 mt10">
				<label>Цвет фона</label><input class="w100 mt10 h58" type="color" id="icolorb" name="color" value="'.$colorBG.'" "/>
            </div>
            <div class="pr w224 h84 dib btbb mr6 vat mb10 mt10">
				<label>Цвет текста</label><input class="w100 mt10 h58" type="color" id="icolort" name="color" value="'.$colorFont.'" "/>
            </div>
            <form class="dib" enctype="multipart/form-data" method="post" action="../tmpl/upload.php" >
								<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <div class="pr w224 h84 dib btbb mr6 vat mb10 mt10 '.$backimagedashed.'">
				<label>Фон</label><input id ="ifile" type="file" name="imagefon">
				<input class="Knopka w100 mt10" type="submit" value="Изменить">
            </div>
            </form>
            </form>
            <div class="pr dib w224 h84 btbb mr6 vat mb10 mt10 '.$backimagedashed.'">
				<div class="dragfile2"><div class="vac">Или перетащите изображение для фона сюда</div></div>
            </div>

		</div>
<style>
a{color: rgb('.$colorF.');}a:active, a:visited{color: rgb('.$colorF.');} </style>
<div class="html '.$height.'" style="
    background-image: url(img/'.$img.');
    background-repeat: no-repeat;
    background-size: contain;
    background-position: top;
">
	<div class="body '.$height.'" style="color: rgb('.$colorF.');
    background: rgba('.$colorB.','.$transparent.');">
		<div id="wrapper_Main" class="pr wh100">
			<div class="wrap_Main pa wh100">
				<header class="header tac w100">
					<div class="name_Main db tal w100 fl mw31 cacc pointer '.$descdashed.'">
						<div class="value hidden">id_desc</div>
						<p><a id="cname" href="'.$link_name.'/"> '.$desc.'</a>
						</p>
					</div>
					<div class="phone_Main fr tar w100 mw31 cacc pointer '.$phonedashed.'">
						<div class="value hidden">id_phone</div>
						<span><a class="fs15" href="tel:+'.$phone.'">'.$phoneG.'</a></span>
						<a id="clb" class="callback biphone" href="#callback">Заказать звонок
						<span ></span>
						</a>
						
					</div>
					<div class="logo_Main mw31 w100 dib bsc bpc cacc pointer '.$logodashed.'" onmouseover="$(this).find(\'a\').find(\'img\').attr(\'src\', \'img/'.$logo_hover.'\')" onmouseout="$(this).find(\'a\').find(\'img\').attr(\'src\', \'img/'.$logo.'\')">
						<div class="value hidden">logo</div>
						<a href="'.$link_logo.'/"><img src="img/'.$logo.'" alt="logo"></a>
					</div>
			    </header>';

			$result .= '<div class="cont" id="cont_Main">
				<h1 class="offer tac fw400 cacc pointer '.$offerdashed.'"><div class="value hidden">id_offer</div>'.$objOffer->value.'</h1>
				<div class="toform cacc '.$formbuttondashed.'">';
						$platevalue = $objForm->value_button;
						$result .= "<div class=\"\">
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
			$result .= '
				</div>
				<h2 class="offer2 tac fw400 cacc pointer '.$offer2dashed.'"><div class="value hidden">id_offer2</div>'.$objOffer2->value.'</h2>';

			$result .= '<div class="middle_Main">';
					
					if (!empty($objData->video)) { 
						$video_volume = $CONSTS['video_volume'];
						$result .= '<div class="video_Main whitesh19 alfablack4bg tal border3rad fl h100 red cacc pointer"><div class="value hidden">video</div><iframe id="videoR_Main" src="https://www.youtube.com/embed/'.$objData->video.'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
						$result .= '<script>var vid = document.getElementById("videoR_Main");vid.volume = '.$video_volume.';</script>';
					} else {
						$result .= '<div class="video_Main whitesh19 alfablack4bg tac border3rad fl h100 red cacc pointer dashed fs2"><div class="value hidden">video</div><img src="../img/add.png" class="ma h80p"><div>Добавить видео</div></div>';
						$result .= '<style> .middle_Main {width: 100%;} @media only screen and (max-device-width: 666px), only screen and (max-width: 666px) {min-height: 388px;}  .wrapper_Main {min-height: 480px;}</style>';
					}
					
						$result .= '<div id="after_Main" class="forma_Main fr border3rad alfablack4bg whitesh19 h100">

						<div class="formtext cacc pointer '.$formdashed.'"><div class="value hidden">formtext</div><div class="id_form hidden">'.$id_form.'</div><div class="centredv p22"><p id="kol_Main" class="formaaaa tac fs15 yellow">'.$objForm->value_text.' </p></div></div>
							<div class="formbot">';
							
								$resInputsForms = DB::query("SELECT * FROM `new_inputs_form` WHERE `id_form` = '$idform'");
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
										if ($inputname == 'address') {
											require ("address.php");
										} else {
											require ("button_crm.php");
										}
									}
								}
							
							 //Добавление кнопок изменить? 
							unset($labelafter); $animate = "anibtn_Main"; $value = $objForm->value_button; $centred = "yes"; $margin = "marginh"; $typebutton = "submit"; $classname = "buton biYellow border3rad white fw400 fs15 db pointer";  $objname = "buton"; $id = "buton"; $obj = "input"; unset($style); unset($onclick); unset($placeholder); include("button_crm2.php");
							if ( ($link_addition <> '') AND ($addition <> '') ) {
								$result .= '<div class="cacc pointer"><div class="hidden value">additionlink</div>'.$addition.'</div>';
							} else {
								$result .= '<div class="cacc dashed pointer"><div class="hidden value">additionlink</div>Дополнительная ссылка</div>';
							}
							
						$result .= '</div>
					</div>
				</div>';

				$result .= '<div class="planki">';
				//echo "$id_project_data";
					$resPlatesUser = DB::query("SELECT * FROM `new_plates_user` WHERE `id_project_data` = '$id_project_data'");
					$check=DB::num_rows($resPlatesUser);

					if ($check >= 1) {
						while ($arnew = mysql_fetch_array($resPlatesUser)) {
							$idplate[]= $arnew['id_plates'];
						}
						$sqladdtext = '';
						for ($i=0; $i < count($idplate); $i++) {
							$input = $idplate[$i];
							if ($sqladdtext == '') {
								$sqladdtext .= "`id` = '$input'";
							} else {
								$sqladdtext .= " OR `id` = '$input'";
							}
						}
						$sqlplates = "SELECT * FROM `new_plates` WHERE $sqladdtext";
						$resplates = DB::query($sqlplates);
						while ($plates = mysql_fetch_object($resplates)) {
							$platelink = $plates->link;
							$platevalue = $plates->value;
							$plateimg = $plates->img;
							$plateid = $plates->id;
							$result .= "
					<div class=\"plashka1 pointer cacc\">
						<div class=\"id_plate hidden\">$plateid</div>
						<div class=\"value hidden\">plates</div>
						<img src=\"img/$plateimg\" class=\"imgplashka\">
						<div class=\"h50\">
							<div class=\"obolochka marginh\">
								<div class=\"centredv\">
									<div style=\"display: block\">
										<div class=\"centredh\">
											<div style=\"display: inline-block;\">
												<label class=\"anibtn\">
													<a href=\"$platelink\" class=\"knopki pointer white biRed db lh50 border3rad\">$platevalue</a>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>";
						}
					}
					//Контурная
					$result .= "
					<div class=\"plashka1 pointer dashed cacc\">
						<div class=\"value hidden\">addplate</div>
						<img src=\"../img/add.png\" class=\"imgplashka\">
						<div class=\"h50\">
							<div class=\"obolochka marginh\">
								<div class=\"centredv\">
									<div style=\"display: block\">
										<div class=\"centredh\">
											<div style=\"display: inline-block;\">
												<label class=\"anibtn\">
													<div class=\"knopki pointer white biRed db lh50 border3rad\">Добавить</div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>";
				$result .= '</div>
			</div>';

		$result .= '<div class="iconlink" '.$unsetpos.'>
					<div class="dib iconsblock">';
						 
							$resultSocialLink = DB::query("SELECT * FROM `new_social_links` WHERE `id_project`='$id_project'");
							$check=DB::num_rows($resultSocialLink);
							if ($check>0) {
								$resultSocialNetwork = DB::query("SELECT * FROM `new_social_network` WHERE 1");
								while ($objSocialNetwork= DB::fetch_object($resultSocialNetwork)) {
									$idSocialNetwork = $objSocialNetwork->id;
									$social_network[$idSocialNetwork]['class'] = $objSocialNetwork->class;
									$social_network[$idSocialNetwork]['social_network'] = $objSocialNetwork->social_network;
								}

								while ($objSocialLink = DB::fetch_object($resultSocialLink)) {
									$social_link = $objSocialLink->link;
									$idSocialNetworkLink = $objSocialLink->id_social_network;
									$social_class = $social_network[$idSocialNetworkLink]['class'];
									$social_network_value = $social_network[$idSocialNetworkLink]['social_network'];

									$result .= "<div class=\"iconsoc imgo $social_class pointer\"></div>";
								}
							}

						
					$result .= '</div>
					<div class="dib linksblock">
						<div class="pointer dib footp link" href="#contact">Контакты<span class="anilink"></span></div>
						<div class="pointer dib footp link" href="#conf">Политика конфиденциальности<span class="anilink"></span></div>
						<div class="pointer dib footp link" href="#sogl">Пользовательское соглашение<span class="anilink"></span></div>
						<div class="footp dib hoversquard">
							<pre class="yellow dib">✉</pre><a class="footp cacc pointer" href="mailto:'.$objData->email.'"><div class="value hidden">email</div>'.$objData->email.'</a>
						</div>
					</div>
				</div>
			</div>
		</div>';

		$result .= "
		<script>
			$('.dragfile2').on('dragover', function(){
				$(this).addClass('dragfileover');
				return false;
			});

			$('.dragfile2').on('dragleave', function(){
				$(this).removeClass('dragfileover');
				return false;
			});

			$('.dragfile2').on('drop', function(e){
				e.preventDefault();

				$(this).removeClass('dragfileover');
				var formdata = new FormData();
				var multiple = e.originalEvent.dataTransfer.files;
				for (var i=0;i<multiple.length; i++) {
					formdata.append('file[]', multiple[i]);
				}
				formdata.append('type[]', 'back');
				formdata.append('type[]', '$id_project_data');
				formdata.append('type[]', '$id_project');
				formdata.append('type[]', '$namepagesite');
				$.ajax({
					url: '../tmpl/upload.php',
					method:'post',
					data: formdata,
					contentType: false,
					cache: false,
					processData: false,
					success:function(loader){
						$('.site_view').html(loader);
					}
				});
			});
		</script>";
	}
?>