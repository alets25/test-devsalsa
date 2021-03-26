<?php 
session_start();
clearstatcache();
$settings = require __DIR__ . '/../settings.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/routes.php';
$template = new \classes\Template($settings['template']);
try {
    if(isset($_GET['c'])){
        $params = explode("/",$_GET['c']);
        $clase = ucfirst($params[0]);
        $clase = '\\classes\\'.$clase;
        $function = $params[1];

        $f = new $clase();
        if(isset($_SESSION['initDb'])){
            if($_SESSION['initDb'] == true){
                $database = new \classes\Database(); 
            }
        }
        $f->$function($_POST);
    }

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
    echo file_get_contents($template->getError());
}

