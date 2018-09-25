<?php
include("../conf/start.php");
include("../conf/session.php");
$sitemain = $_SERVER['HTTP_HOST'];

$url = $_SERVER['REQUEST_URI'];
$str = substr($url,1,strpos($url, '/', 1)-1);

$getreport =  DB::query("SELECT * FROM `new_phrases_report` WHERE `status` = '2'");
$check = DB::num_rows($getreport);
if ($check>0) {
	while ($report = DB::fetch_object($getreport)) {
		$idproject = $report->id_project;
		$reportnumb = $report->report;
		$parent = $report->parent;

		$getmarketing = DB::query("SELECT * FROM `new_marketing` WHERE `id_project` = '$idproject' LIMIT 1");
		$marketing = DB::fetch_object($getmarketing);
		$userid = $marketing->id_user;
		$yandex = $marketing->yandex;
		$token = $marketing->token_yandex;

		$api = 'api';
		$json = '{"method": "DeleteWordstatReport", "param":'.$reportnumb.',"locale": "ru","token": "'.$token.'"}';
		$serv_addr = 'https://'.$api.'.direct.yandex.ru/v4/json/';
		$post_headers = array('POST /json-api/v4 HTTP/1.1',
								 'Referer: https://'.$api.'.direct.yandex.com/v4/json/',
								 'Content-Type: application/json; charset=utf-8',
								 'Client-Login: '.$yandex,
								 'Accept-Language: ru',
								 'Host: '.$api.'.direct.yandex.com',
								 'Authorization: Bearer '.$token,
								 '');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$serv_addr);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $post_headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

		try{
		    $result = curl_exec($ch);
		}
		catch(Exception $e){
		    print_r($e);
		}

		if($result === false)
		{
			print_r(curl_error($ch));
		}
		else
		{
			$info = curl_getinfo($ch);
			$pagecode = $info['http_code'];
			if ($pagecode == '200') {
				$header_size = $info['header_size'];
				$header = substr($result, 0, $header_size);
				$body = substr($result, $header_size);
				//echo $body;
				$jsonresult = json_decode($body);
				if (isset($jsonresult->error_code)) {
					$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='3' WHERE `report`='$reportnumb'");
				} else {
					if ($jsonresult->data == '1') {
						$updatereport = DB::query("UPDATE `new_phrases_report` SET `status`='3' WHERE `report`='$reportnumb'");
					}
				}
			}
		}
		curl_close($ch);
	}
}
//Добавить условия перехода	//Здесь условие не открываем, чтобы не было цикличности переходов, а automatefastpars запускается через задачи каждую минуту.  // тут надо формировать слова и прочую ерунду
//sleep(3); 
//header('location: http://directolog-plus.ru/directologplus/tmpl/automatefastpars.php');	
?>