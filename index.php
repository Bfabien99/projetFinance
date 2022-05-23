<?php
// On génère une constante qui contiendra le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
# Relier le vendor
require ROOT.'vendor/autoload.php';
# Relier le Controller
require ROOT.'models/Admindb.php';
require ROOT.'controllers/Admin.php';

$router = new AltoRouter();

$router->map('GET',"/projetFinance/",function()
{   
    //include 'views/home.php';
    include 'views/login.php';
});


$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) 
{
    call_user_func_array( $match['target'], $match['params'] ); 
} 
else 
{
// no route was matched
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}