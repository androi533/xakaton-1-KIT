<?php
include("conf/start.php");
include("conf/session.php");
include("conf/phpQuery-onefile.php");
$sitemain = $_SERVER['HTTP_HOST'];

$url = $_SERVER['REQUEST_URI'];
$market = substr($url,1,strpos($url, '/', 1)-1); //это не нужно - все проекты в одном файле

$phrase = 'настроить директ';


$id_phrase = 1; //Временно  //Здесь на самом деле ищем фразу по таблице, если находим берем id, если нет то добавляем //Просто пока не понятно где оно все встанет


if (isset($_GET['phrase'])) {
	$phrase = $_GET['phrase'];
}

$urlphrase = urlencode($phrase);
$urldirect = "https://yandex.ru/search/ads?text=".$urlphrase;

$curl = curl_init($urldirect);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1); //следование 302 redirect 
$html = curl_exec($curl);

$document = phpQuery::newDocument($html); //Загружаем полученную страницу в phpQuery
$hentry = $document->find('.organic__url_type_multiline'); //Находим все элементы с классом "organic__url-text" (селектор .organic__url-text)

$c_zag2 = '–';
$c_zag2_2 = '-';
$c_not_zag2 = '/';
$codirovka = 'UTF-8';
$kirillica = 'cp1251';

$addphraseszag = '';
print_r($hentry);
foreach ($hentry as $el) {
	$elem_pq = pq($el); //pq - аналог $ в jQuery
	$text = trim($elem_pq->contents()->filter(function($i, $el) { return $el.nodeType == 3); })->text());
	
	echo "$text<br>";
	if ($addphraseszag == '') {
		$addphraseszag = "('$id_phrase', '$text')";
	} else {
		$addphraseszag .= ", ('$id_phrase', '$text')";
	}

	//$resaddphrasezag = DB::query("INSERT INTO `new_phrases_zag`(`id_phrase`, `value`) VALUES $addphraseszag");
}


if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
	/**
	 * mb_ucfirst - преобразует первый символ в верхний регистр
	 * @param string $str - строка
	 * @param string $encoding - кодировка, по-умолчанию UTF-8
	 * @return string
	 */
	function mb_ucfirst($str, $encoding='UTF-8')
	{
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
}


function Words($string) {
	$vr = trim($string);
	$vr = preg_replace('/[^a-zA-Zа-яА-Я0-9 ]/ui', ' ', $vr);
	$vr = preg_replace('/\s/', ' ', $vr);
	$vr = trim($vr);
	$words = explode(' ', $vr);
	return $words;
}

function NGramm($string, $NGramm_count, $codirovka)
{
	$vr_el = '  '.$string.'  ';

	for ($i=0; $i < mb_strlen($string, $codirovka) + 2 ; $i++) { 
		$vr = '';
		for ($j=0; $j < $NGramm_count; $j++) { 
			$vr .= mb_substr($vr_el, $j+$i, 1, $codirovka);
		}
		$Ngramm_Zag[$string][$i] = $vr;
	}

	return $Ngramm_Zag;
}

$result = $best_phrase;
echo "$result";

?>