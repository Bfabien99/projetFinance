<?php
session_start();
// On génère une constante qui contiendra le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
# Relier le vendor
require ROOT.'vendor/autoload.php';
# Relier le Controller
require ROOT.'models/Admindb.php';
require ROOT.'controllers/Admin.php';
require ROOT.'models/Clientsdb.php';
require ROOT.'controllers/Client.php';

$router = new AltoRouter();

// HOMEPAGE
$router->map('GET',"/projetFinance/",function()
{   
    include 'views/home.php';
});

// LOGIN PAGE
$router->map('GET',"/projetFinance/login",function()
{   
    include 'views/login.php';
});

// FORGET PAGE
$router->map('GET',"/projetFinance/forget",function()
{   
    include 'views/forget.php';
});

//SIGNUP PAGE
$router->map('GET',"/projetFinance/inscription",function()
{   
    include 'views/inscription.php';
});

### INDEX PAGE
$router->map('GET',"/projetFinance/customer",function()
{   
    if (!empty($_SESSION['xbank_client_id'])) {
        $client = new Client();
        $client->index($_SESSION['xbank_client_id']);
    }
    else {
        header('location:/projetFinance/login');
    }
});

$router->map('GET',"/projetFinance/admin",function()
{   
    if (!empty($_SESSION['xbank__id'])) {
        $admin = new Admin();
        $admin->index();
    }
    else {
        header('location:/projetFinance/login');
    }
    
});

### CUSTOMER PAGE ###
    ### GET METHOD
// $router->map('GET',"/projetFinance/customer",function(){});
# LOG OUT (déconnexion client)
$router->map('GET',"/projetFinance/customer/logout",function(){
    unset($_SESSION['xbank_client_id']);
    header('location:/projetFinance/login');
});

$router->map('GET',"/projetFinance/customer/deposite",function(){
    Client::pageDepot();
});

$router->map('GET',"/projetFinance/customer/withdraw",function(){
    Client::pageRetrait();
});

### ADMIN PAGE ###
    ### GET METHOD
# LOG OUT (déconnexion admin)
$router->map('GET',"/projetFinance/admin/logout",function(){
    unset($_SESSION['xbank_id']);
    header('location:/projetFinance/login');
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