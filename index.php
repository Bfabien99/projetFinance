<?php
session_start();
// On génère une constante qui contiendra le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

# Relier le vendor
require ROOT.'vendor/autoload.php';

# Relier les Models
require ROOT.'models/Admindb.php';
require ROOT.'models/Clientsdb.php';

# Relier les Controllers
require ROOT.'controllers/Admin.php';
require ROOT.'controllers/Client.php';

# Initialisation du router
$router = new AltoRouter();

### HOMEPAGE
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

### AFTER LOGIN INDEX PAGE
# Route for customer
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

# Confirmation email
$router->map('GET',"/projetFinance/confirm/[*:slug]",function($slug){
    $client = new Client();
    if($client->confirmMail($_SESSION['xbank_confirm_mail'],$slug)){
        include 'views/confirmation.php';
    }
    else {
        die('<div><h1 style="text-align:center;">ERREUR LORS DE LA CONFIRMATION<h1></div>');
    }
});

# Route for admin
$router->map('GET',"/projetFinance/admin",function()
{   
    if (!empty($_SESSION['xbank_id'])) {
        $admin = new Admin();
        $admin->index();
    }
    else {
        header('location:/projetFinance/login');
    }
    
});

#####################
### CUSTOMER PAGE ##################
####################

### GET METHOD
// $router->map('GET',"/projetFinance/customer",function(){});
# VOIR L'HISTORIQUE
$router->map('GET',"/projetFinance/customer/historical",function(){
    if (!($_SESSION['xbank_client_id'])) {
        header('location:/projetFinance/login');
    }

    $client = new Client();
    $client->historical($_SESSION['xbank_client_id'],100);
});

# VOIR LE COMPTE
$router->map('GET',"/projetFinance/customer/account",function(){
    if (!($_SESSION['xbank_client_id'])) {
        header('location:/projetFinance/login');
    }

    $client = new Client();
    $client->account($_SESSION['xbank_client_id']);
});

# LOG OUT (déconnexion client)
$router->map('GET',"/projetFinance/customer/logout",function(){
    unset($_SESSION['xbank_client_id']);
    header('location:/projetFinance/login');
});

# FAIRE UN DEPOT (POST en ajax)
$router->map('GET',"/projetFinance/customer/deposite",function(){
    if (!($_SESSION['xbank_client_id'])) {
        header('location:/projetFinance/login');
    }

    Client::pageDepot();
});

# FAIRE UN RETRAIT (POST en ajax)
$router->map('GET',"/projetFinance/customer/withdraw",function(){
    if (!($_SESSION['xbank_client_id'])) {
        header('location:/projetFinance/login');
    }

    Client::pageRetrait();
});

# VOIR LES PARAMETRES
$router->map('GET',"/projetFinance/customer/settings",function(){
    if (!($_SESSION['xbank_client_id'])) {
        header('location:/projetFinance/login');
    }

    $client = new Client();
    $client->params($_SESSION['xbank_client_id']);
});

##################
### ADMIN PAGE ###################
################

## GET METHOD ##

# LOG OUT (déconnexion admin)
$router->map('GET',"/projetFinance/admin/logout",function(){
    unset($_SESSION['xbank_id']);
    header('location:/projetFinance/login');
});

$router->map('GET',"/projetFinance/admin/liste",function(){
    if (!empty($_SESSION['xbank_id'])) {
        $admin = new Admin();
        $admin->getClients();
    }
    else {
        header('location:/projetFinance/login');
    }
});

$router->map('GET',"/projetFinance/admin/liste/[i:id]",function($id){
    if (!empty($_SESSION['xbank_id'])) {
        $admin = new Admin();
        $admin->getClientsInfo($id);
    }
    else {
        header('location:/projetFinance/login');
    }
});

$router->map('GET',"/projetFinance/admin/historique",function(){
    if (!empty($_SESSION['xbank_id'])) {
        $admin = new Admin();
        $admin->getHistoric();
    }
    else {
        header('location:/projetFinance/login');
    }
});



$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) 
{
    call_user_func_array( $match['target'], $match['params'] ); 
} 
else 
{
// no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "PAGE NOT FOUND";
}