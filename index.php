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
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
            ->setUsername('fabienbrou99@gmail.com')
            ->setPassword('#FabienBrou99');
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Wonderful Subject'))
      ->setFrom(['john@doe.com' => 'John Doe'])
      ->setTo(['maredo6101@doerma.com', 'other@domain.org' => 'A name'])
      ->setBody('Here is the message itself')
      ;
    
    // Send the message
    $result = $mailer->send($message);

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