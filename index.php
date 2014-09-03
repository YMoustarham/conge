<?php
session_start();

require_once('modules/smarty_config.php');
require_once('controlers/facebook.php');


$smarty = new Smarty();
if(isset($loginString))
{
    $smarty->assign('login',$loginString);
}
if(isset($eventsArray))
{
    $smarty->assign('events',$eventsArray);
}
$smarty->display('views/home.tpl');


