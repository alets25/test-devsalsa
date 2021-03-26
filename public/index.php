<?php 
session_start();
clearstatcache();
$settings = require __DIR__ . '/../settings.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/routes.php';

$template = new \classes\Template($settings['template']);
try {
    
    if(isset($_GET['r'])){
        $view = $_GET['r'];
        if($view == ""){
            $view = $template->getHome();
            $template->redirectHome();
        }else{
            $view = $template->loadPage($view);
        }
    }else{
        $view = $template->getHome();
        $template->redirectHome();
    }
    
    if(file_exists($view)){
        echo file_get_contents($view);
    }else{
        echo file_get_contents($template->getNotFound());
    }
} catch (\Throwable $th) {
    //throw $th;
    echo file_get_contents($template->getError());
}

