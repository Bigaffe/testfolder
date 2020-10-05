<?php



spl_autoload_register(function($className){
    require_once("classes/".$className.".php");
});

$test = new App\Ogga();