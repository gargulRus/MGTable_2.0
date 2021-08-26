<?php
// error_reporting(0); //Протокол ошибок выключен
//ini_set('display_errors',1); //Включаем ошибки в конфигурации PHP
//error_reporting(-1); //Вывод всех ошибок

//подключаем необходимости
define('DIR', realpath(dirname(__FILE__)));
include(__DIR__.'/core/autoload.php');

//Запрашиваем в базе необходимые массивы данных

$yearArrays = getYears();
$objects = getAllObjects();
$selectYear = yearSelect();
$selectCom = comSelect();
$selectVak = vakSelect();
$selectKgs = kgsSelect();

if (!isset($_COOKIE['login'])) {
    include(__DIR__.'/getsingin.php');
} else if (isset($_GET['trysignin'])) {
    include(__DIR__.'/getsingin.php');
} else {
    if (isset($_GET['exit'])) {
        include(__DIR__.'/getsingout.php');
        exit;
    } elseif (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if(isset($_GET['type'])) {
            include(__DIR__.'/pages/content/'.$_GET['type'].'.php');
        } else if (isset($_GET['changes'])) {
            include(__DIR__.'/ajax/changes/'.$_GET['changes'].'.php');
        } else if (isset($_GET['base'])) {
            include(__DIR__.'/ajax/base/'.$_GET['base'].'.php');
        } else if (isset($_GET['objectcontent'])) {
            include(__DIR__.'/ajax/objectcontent/'.$_GET['objectcontent'].'.php');
        }
    } else {
      include(__DIR__.'/pages/index.php');
    }
}

?>