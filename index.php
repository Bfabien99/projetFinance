<?php
// On génère une constante qui contiendra le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
# Relier le vendor
require ROOT.'vendor/autoload.php';
# Relier le Controller
require ROOT.'models/Admindb.php';
require ROOT.'controllers/Admin.php';

$router = new AltoRouter();


// HOMEPAGE
$router->map('GET',"/projetFinance/",function()
{   
    include 'views/home.php';
});

$router->map('GET',"/projetFinance/login",function()
{   
    include 'views/login.php';
});

$router->map('GET',"/projetFinance/forget",function()
{   
    echo phpinfo();
    include 'views/forget.php';
});

$router->map('GET',"/projetFinance/inscription",function()
{   
    include 'views/inscription.php';
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
    echo "PAGE NOT FOUND";
}