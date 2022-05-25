<?php
    session_start();
    require "../vendor/autoload.php";
    require_once "../models/Clientsdb.php";
    include_once '../mail.php';

    if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['password']) && !empty($_POST['email'])) {

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<div class='alert alert-danger'>Votre email n'est pas valide</div>";
            die();
        }

        $client = new Clientsdb();

        // On verifie si le client n'existe pas
        $exist = $client->doubleUser($client->inputClean($_POST['email']));

        if (!$exist) 
        {
            $result = $client->insertClient($_POST['nom'],$_POST['prenoms'],$_POST['contact'],$_POST['email'],$_POST['password']);
            if($result){
                $email = $client->inputClean($_POST['email']);
                $_SESSION['xbank_confirm_mail'] = $email;
                $code = crypt($email,'md5');
                $message = "<a target='_blank' href='http://localhost/projetFinance/confirm/$code'>confirmation</a>";
                if (sendMail("Inscription X-BANK","Veuillez confirmer vorte inscription en cliquant ici $message",$_POST['email'])) {
                    echo "ok"; 
                }
                else {
                    echo "<div class='alert alert-warning'>Oops une erreur c'est produite, veuillez patienter...</div>";
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