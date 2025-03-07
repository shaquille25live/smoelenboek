<?php
//versie 1.0 Team ao 13-9-2016
include "nl/yc/ict/ao/smoelenboek/config.php";

function __autoload($className)
{
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$className);
    $file = "$class.php";
    @include_once $file;
}

$control = filter_input(INPUT_GET,'control');

if($control===NULL)
{
    $control='bezoeker';
}

$action = filter_input(INPUT_GET, 'action');

if($action===NULL)
{
    $action = 'default';
} 

$controllerName = 'nl\yc\ict\ao\smoelenboek\controls'.'\\'.ucfirst($control).'Controller';

if(class_exists($controllerName))
{
    $myControl = new $controllerName($control, $action);
    $myControl->execute();
}
else 
{
    $myControl=new nl\yc\ict\ao\smoelenboek\controls\BezoekerController('bezoeker','default','er is iets mis gegegaan, de door jou gebruikte url wordt niet begrepen');
    $myControl->execute();
}