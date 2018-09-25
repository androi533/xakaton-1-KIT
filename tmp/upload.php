<?php
	include("../conf/start.php");
	include("../conf/session.php");
	//include('../../yakassa/config.php');
	include("../conf/consts.php");

	$sitemain = $_SERVER['HTTP_HOST'];

	$protocol = 'http';
	if (isset($_SERVER['HTTPS']))
	    $protocol = 'https';

	$url = $_SERVER['REQUEST_URI'];
	//$market = substr($url,1,strpos($url, '/', 1)-1);
	$market = $_SESSION['market'];
	$id_user = $_SESSION['market_'.$market]['id_user'];
	$id_project_data = $_SESSION['market_'.$market]['id_project_data'];

	//echo "$protocol://$sitemain/$market/CRM3.php $id_project_data";
	$fomats = array("jpg", "jpeg", "gif", "png");
	//print_r($_POST);
	//print_r($_FILES);

	//exit();

	if (isset($_POST) AND ($_SERVER['REQUEST_METHOD'] == "POST")) {
		$result = '';
		if ($_POST['type'][0] == 'back') {
			if (isset($_FILES['file']['name'][0])) {
				$format = @end(explode(".", $_FILES['file']['name'][0]));
				if (in_array(strtolower($format), $fomats)) {
					foreach ($_FILES['file']['name'] as $key => $value) {
						$SourcePath = $_FILES['file']['tmp_name'][$key];
						$TargetPath = rand(0,999999)."_".time()."_".$value;
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						if (is_uploaded_file($SourcePath)) {
							if(move_uploaded_file($SourcePath, $TargetPath)) {
								$id_user = $_SESSION['market_'.$market]['id_user'];
								$id_project = $_SESSION['market_'.$market]['id_project'];
								$id_project_data = $_SESSION['market_'.$market]['id_project_data'];

								if (isset($_POST['numproj'])) {
									$id_project = $_POST['numproj'];
								}
								$result .= '<img class="img" src="img/'.$TargetPath.'">';
								$result .= "$id_user $id_project $id_project_data";
								$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `backimg`='$TargetPath' WHERE `id` = '$id_project_data'");
								include('../tmp/page_crm.php');
							} else {
								echo "<font color='red'>Файд не загрузился. ".$_FILES['file']['error']."</font>";
							}
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}

		if ($_POST['type'][0] == 'plate') {
			$id_plate = $_POST['type'][1];
			if (isset($_FILES['file']['name'][0])) {
				$format = @end(explode(".", $_FILES['file']['name'][0]));
				if (in_array(strtolower($format), $fomats)) {
					foreach ($_FILES['file']['name'] as $key => $value) {
						$SourcePath = $_FILES['file']['tmp_name'][$key];
						$TargetPath = rand(0,999999)."_".time()."_".$value;
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						if (is_uploaded_file($SourcePath)) {
							if(move_uploaded_file($SourcePath, $TargetPath)) {
								$result .= '<img class="img" src="img/'.$TargetPath.'">';
								$usedWordUpdate=DB::query("UPDATE `new_plates`  SET `img`='$TargetPath' WHERE `id` = '$id_plate'");
							} else {
								echo "<font color='red'>Файд не загрузился. ".$_FILES['file']['error']."</font>";
							}
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}

		if ($_POST['type'][0] == 'plateadd') {
			$id_project_data = $_POST['type'][1];
			if (isset($_FILES['file']['name'][0])) {
				$format = @end(explode(".", $_FILES['file']['name'][0]));
				if (in_array(strtolower($format), $fomats)) {
					foreach ($_FILES['file']['name'] as $key => $value) {
						$SourcePath = $_FILES['file']['tmp_name'][$key];
						$TargetPath = rand(0,999999)."_".time()."_".$value;
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						if (is_uploaded_file($SourcePath)) {
							if(move_uploaded_file($SourcePath, $TargetPath)) {
								$result .= '<img class="img" src="img/'.$TargetPath.'">';
								//$resDesc = DB::query("INSERT INTO `new_plates`  (`img`, `value`, `link`)  VALUES ('$TargetPath', '$value', '$link')");
								$resDesc = DB::query("INSERT INTO `new_plates`  (`img`)  VALUES ('$TargetPath')");
								$id_plate = DB::insert_id();
								$resDesc = DB::query("INSERT INTO `new_plates_user`  (`id_project_data`, `id_plate`)  VALUES ('$id_project_data', '$id_plate')");
								//$usedWordUpdate=DB::query("UPDATE `new_plates`  SET `img`='$TargetPath' WHERE `id` = '$id_plate'");
							} else {
								echo "<font color='red'>Файд не загрузился. ".$_FILES['file']['error']."</font>";
							}
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}

		if ($_POST['type'][0] == 'logo') {
			if (isset($_FILES['file']['name'][0])) {
				$format = @end(explode(".", $_FILES['file']['name'][0]));
				if (in_array(strtolower($format), $fomats)) {
					foreach ($_FILES['file']['name'] as $key => $value) {
						$SourcePath = $_FILES['file']['tmp_name'][$key];
						$TargetPath = rand(0,999999)."_".time()."_".$value;
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						if (is_uploaded_file($SourcePath)) {
							if(move_uploaded_file($SourcePath, $TargetPath)) {
								$result .= '<img class="img" src="img/'.$TargetPath.'">';
								$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `logo`='$TargetPath', `logo_hover`='$TargetPath' WHERE `id` = '$id_project_data'");
							} else {
								echo "<font color='red'>Файд не загрузился. ".$_FILES['file']['error']."</font>";
							}
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}

		if ($_POST['type'][0] == 'avatar') {
			if (isset($_FILES['file']['name'][0])) {
				$format = @end(explode(".", $_FILES['file']['name'][0]));
				if (in_array(strtolower($format), $fomats)) {
					foreach ($_FILES['file']['name'] as $key => $value) {
						$SourcePath = $_FILES['file']['tmp_name'][$key];
						$TargetPath = rand(0,999999)."_".time()."_".$value;
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						if (is_uploaded_file($SourcePath)) {
							if(move_uploaded_file($SourcePath, $TargetPath)) {
								$result .= '<img class="img" src="img/'.$TargetPath.'">';
								$usedWordUpdate=DB::query("UPDATE `new_users`  SET `avatar`='$TargetPath' WHERE `id` = '$id_user'");
							} else {
								echo "<font color='red'>Файд не загрузился. ".$_FILES['file']['error']."</font>";
							}
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}
		}

		if (isset($_FILES['image']['name'])) {
			$format = @end(explode(".", $_FILES['image']['name']));
			echo "$format ASD";
			if (in_array(strtolower($format), $fomats)) {
				if (is_uploaded_file($_FILES['image']['tmp_name'])) {
					$strpath = $_SERVER['DOCUMENT_ROOT'];
					$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
					chdir($truepath);
					$dir = rand(0,999999)."_".time()."_".$_FILES['image']['name'];
					if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
						echo '<img class="img" src="img/'.$TargetPath.'">';
						$usedWordUpdate=DB::query("UPDATE `new_users`  SET `avatar`='$dir' WHERE `id` = '$id_user'");
						header("Location: $protocol://$sitemain/$market/CRM3.php");
						exit();
					} else {
						echo "<font color='red'>Файд не загрузился. ".$_FILES['image']['error']."</font>";
					}
				}
			} else {
				echo "<font color='red'>Выберите правильный формат!</font>";
			}
		}

		if (isset($_FILES['imagelogo']['name'])) {
			$linklogosql = '';
			if (isset($_POST['linklogo'])) {
				$linklogo = $_POST['linklogo'];
				$linklogosql = ", `link_logo`='$linklogo'";
			}
			
			$format = @end(explode(".", $_FILES['imagelogo']['name']));
			echo "$format ASD";
			if (in_array(strtolower($format), $fomats)) {
				if (is_uploaded_file($_FILES['imagelogo']['tmp_name'])) {
					$strpath = $_SERVER['DOCUMENT_ROOT'];
					$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
					chdir($truepath);
					$dir = rand(0,999999)."_".time()."_".$_FILES['imagelogo']['name'];
					if (move_uploaded_file($_FILES['imagelogo']['tmp_name'], $dir)) {
						echo '<img class="img" src="img/'.$TargetPath.'">';
						$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `logo`='$dir', `logo_hover`='$dir'$linklogosql WHERE `id` = '$id_project_data'");
						header("Location: $protocol://$sitemain/$market/CRM3.php");
						exit();
					} else {
						echo "<font color='red'>Файд не загрузился. ".$_FILES['imagelogo']['error']."</font>";
					}
				}
			} else {
				echo "<font color='red'>Выберите правильный формат!</font>";
			}
		}

		if (isset($_FILES['imagefon']['name'])) {
			$format = @end(explode(".", $_FILES['imagefon']['name']));
			echo "$format ASD";
			if (in_array(strtolower($format), $fomats)) {
				if (is_uploaded_file($_FILES['imagefon']['tmp_name'])) {
					$strpath = $_SERVER['DOCUMENT_ROOT'];
					$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
					chdir($truepath);
					$dir = rand(0,999999)."_".time()."_".$_FILES['imagefon']['name'];
					if (move_uploaded_file($_FILES['imagefon']['tmp_name'], $dir)) {
						echo '<img class="img" src="img/'.$TargetPath.'">';
						$usedWordUpdate=DB::query("UPDATE `new_project_data`  SET `backimg`='$dir' WHERE `id` = '$id_project_data'");
						header("Location: $protocol://$sitemain/$market/CRM3.php");
						exit();
					} else {
						echo "<font color='red'>Файд не загрузился. ".$_FILES['imagefon']['error']."</font>";
					}
				}
			} else {
				echo "<font color='red'>Выберите правильный формат!</font>";
			}
		}

		if (isset($_POST['idplate'])) {
			$id_plate = $_POST['idplate'];

			if (isset($_POST['valplate'])) {
				$value = $_POST['valplate'];
				$usedWordUpdate=DB::query("UPDATE `new_plates`  SET `value`='$value' WHERE `id` = '$id_plate'");
			}

			if (isset($_POST['linkplate'])) {
				$linkplate = $_POST['linkplate'];
				$usedWordUpdate=DB::query("UPDATE `new_plates`  SET `link`='$linkplate' WHERE `id` = '$id_plate'");
			}

			if (isset($_FILES['imageplate']['name'])) {
				$format = @end(explode(".", $_FILES['imageplate']['name']));
				echo "$format ASD";
				if (in_array(strtolower($format), $fomats)) {
					if (is_uploaded_file($_FILES['imageplate']['tmp_name'])) {
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						$dir = rand(0,999999)."_".time()."_".$_FILES['imageplate']['name'];
						if (move_uploaded_file($_FILES['imageplate']['tmp_name'], $dir)) {
							echo '<img class="img" src="img/'.$TargetPath.'">';
							$usedWordUpdate=DB::query("UPDATE `new_plates`  SET `img`='$dir' WHERE `id` = '$id_plate'");
						} else {
							echo "<font color='red'>Файд не загрузился. ".$_FILES['imageplate']['error']."</font>";
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}

			header("Location: $protocol://$sitemain/$market/CRM3.php");
			exit();
		}

		if (isset($_POST['addplate'])) {
			$platesql = '';
			$plateval = '';

			if (isset($_POST['valplate'])) {
				$value = $_POST['valplate'];
				if ($platesql == '') {
					$platesql = '`value`';
				} else {
					$platesql .= ', `value`';
				}
				if ($plateval == '') {
					$plateval = "'$value'";
				} else {
					$plateval .= ", '$value'";
				}
			}

			if (isset($_POST['linkplate'])) {
				$linkplate = $_POST['linkplate'];
				if ($platesql == '') {
					$platesql = '`link`';
				} else {
					$platesql .= ', `link`';
				}
				if ($plateval == '') {
					$plateval = "'$linkplate'";
				} else {
					$plateval .= ", '$linkplate'";
				}
			}

			if (isset($_FILES['imageplateadd']['name'])) {
				$format = @end(explode(".", $_FILES['imageplateadd']['name']));
				echo "$format ASD";
				if (in_array(strtolower($format), $fomats)) {
					if (is_uploaded_file($_FILES['imageplateadd']['tmp_name'])) {
						$strpath = $_SERVER['DOCUMENT_ROOT'];
						$truepath = substr($strpath, 0, strrpos($strpath, '/')).'/'.$sitemain.'/'.$market.'/img/';
						chdir($truepath);
						$dir = rand(0,999999)."_".time()."_".$_FILES['imageplateadd']['name'];
						if (move_uploaded_file($_FILES['imageplateadd']['tmp_name'], $dir)) {
							if ($platesql == '') {
								$platesql = '`img`';
							} else {
								$platesql .= ', `img`';
							}
							if ($plateval == '') {
								$plateval = "'$dir'";
							} else {
								$plateval .= ", '$dir'";
							}
						} else {
							echo "<font color='red'>Файд не загрузился. ".$_FILES['imageplateadd']['error']."</font>";
						}
					}
				} else {
					echo "<font color='red'>Выберите правильный формат!</font>";
				}
			}

			$resDesc = DB::query("INSERT INTO `new_plates`  ($platesql)  VALUES ($plateval)");
			$id_plate = DB::insert_id();
			$resDesc = DB::query("INSERT INTO `new_plates_user`  (`id_project_data`, `id_plates`)  VALUES ('$id_project_data', '$id_plate')");

			header("Location: $protocol://$sitemain/$market/CRM3.php");
			exit();
		}

		echo $result;
		//header("Location: $protocol://$sitemain/$market/CRM3.php");
	}
?>