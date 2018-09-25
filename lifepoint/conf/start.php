<?php
header("http/1.0 200 Ok");
//header('Content-Type: text/html; charset=utf-8');
require 'class.db.php';
$conf = parse_ini_file('config.ini');
define('HOST', $conf['mysql_host']); //сервер
define('USER', $conf['mysql_user']); //пользователь
define('PASSWORD', $conf['mysql_password']); //пароль
define('NAME_BD', $conf['mysql_database']);//база  

// id приложения
define("CLIENT_ID", "6669486");
// защищенный ключ
define("SECRET", "JlFZXnA7bzL6fPXCLvTC");
define('SERVISE_GROUP', 'cdafa2fc9f78833c35ddc827df60006f77f39a3e64f41df2f3a1aeefa5310a7ea79f7d1889b2f9ce6be9a');
define("SERVISE_DP", "623a6479623a6479623a6479f2625fa0d76623a623a647939472fb8627fabdd9062a920");
define("SINGLE_TOKEN", "186beabe15e0bd12e0822d3ed1e3a116f476a75cc46a3d9e93c0820fda594a1c82170fa0ee0e60ceef228"); //заливать в БД
// куда перенаправим пользователя после авторизации
define("OAUTH_CALLBACK", "tmpl/apivkautorize.php");
define("AUTH", "https://oauth.vk.com/authorize");
define("ACCESS_TOKEN", "https://oauth.vk.com/access_token");
// настройки доступа
define("SCOPE", "market,groups,messages,notify,friends,photos,audio,video,docs,notes,pages,status,wall,email,notifications,stats,offline");
define("SCOPEAUTH", "offline,photos,groups,market");
// путь к папке со скриптами
define("PATH", "https://directolog-plus.ru/mo/");

DB::getInstance();
?>