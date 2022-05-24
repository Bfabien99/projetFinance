<?php
    require "../vendor/autoload.php";
    require_once "../models/Clientsdb.php";

    if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['password']) && !empty($_POST['email'])) {

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<div class='alert alert-danger'>Votre email n'est pas valide</div>";
            die();
        }

        $client = new Clientsdb();

        // On verifie si le client n'existe pas
        $exist = $client->doubleUser($_POST['email']);

        if (!$exist) 
        {
            $result = $client->insertClient($_POST['nom'],$_POST['prenoms'],$_POST['contact'],$_POST['email'],$_POST['password']);
            if($result){
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
                        ->setUsername('fabienbrou99@gmail.com')
                        ->setPassword('#FabienBrou99');
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $message = (new Swift_Message('Wonderful Subject'))// Objet
                  ->setFrom(['john@doe.com' => 'X-BANK'])// Le nom
                  ->setTo(['fabienbrou99@gmail.com', 'other@domain.org' => 'A name'])
                  ->setBody('Here is the message itself')
                  ;
                
                // Send the message
                $result = $mailer->send($message);
                if ($result) {
                    echo "ok"; 
                }
                else {
                    echo "<div class='alert alert-warning'>Erreur de confirmation...</div>";
                }
                
            }
            else {
                echo "<div class='alert alert-warning'>Une erreur s'est produite lors de l'enregistrement...</div>";
            }
        }
        else {
            echo "<div class='alert alert-warning'>L'utilisateur existe déja!</div>";
        }
        
    }
    else {
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs (*)</div>";
    }