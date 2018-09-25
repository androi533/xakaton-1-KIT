<?php
include("conf/start.php");
include("conf/session.php");
include("conf/phpQuery-onefile.php");

  $sitemain = $_SERVER['HTTP_HOST'];
  $protocol = 'http';
  if (isset($_SERVER['HTTPS']))
      $protocol = 'https';

  /*$url = $_SERVER['REQUEST_URI'];
  $fst1 = strpos($url, '/', 1)+1;

  $market = substr($url,1,$fst1-2);*/
  $market = $_SESSION['market'];

// Идентификатор приложения
$client_id = '25794db0eea84b5d87cf20c1d5b583f4'; 
// Пароль приложения
$client_secret = 'e481999475064139a7f000d6937c8f3d';

// Если скрипт был вызван с указанием параметра "code" в URL,
// то выполняется запрос на получение токена
if (isset($_GET['code']))
  {
    // Формирование параметров (тела) POST-запроса с указанием кода подтверждения
    $query = array(
      'grant_type' => 'authorization_code',
      'code' => $_GET['code'],
      'client_id' => $client_id,
      'client_secret' => $client_secret
    );
    $query = http_build_query($query);

    // Формирование заголовков POST-запроса
    $header = "Content-type: application/x-www-form-urlencoded";

    // Выполнение POST-запроса и вывод результата
    $opts = array('http' =>
      array(
      'method'  => 'POST',
      'header'  => $header,
      'content' => $query
      ) 
    );
    $context = stream_context_create($opts);
    $result = file_get_contents('https://oauth.yandex.ru/token', false, $context);
    $result = json_decode($result);

    // Токен необходимо сохранить для использования в запросах к API Директа
    $token_yandex = $result->access_token;

    if (isset($_GET['state'])) {
      $market = $_GET['state'];
    }

    $id_user = $_SESSION[$market]['id_user'];
    $id_project = $_SESSION[$market]['id_project'];

  	$restoken = DB::query("UPDATE `new_marketing` SET `token_yandex`='$token_yandex' WHERE `id_user`='$id_user' AND `id_project`='$id_project'");
   // exit();
    header('location: '.$protocol.'://'.$sitemain.'/'.$market.'/CRM3.php');
  } else {
    header('location: https://oauth.yandex.ru/authorize?response_type=code&client_id='.$client_id);
  }
// Если скрипт был вызван без указания параметра "code",
// пользователю отображается ссылка на страницу запроса доступа
?>