<?php 
session_start();
clearstatcache();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/routes.php';
$settings = require __DIR__ . '/../src/settings.php';

$templateFolder = $settings['template'];

if(isset($_GET['r'])){
    $view = $_GET['r'];
    var_dump($view);
}else{
    return $templateFolder.'notfound.phtml';
}