<?php
        require "../vendor/autoload.php";
        require_once "../models/Clientsdb.php";
        include_once '../mail.php';

    if(!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['email'])){
        $client = new Clientsdb();
        $verify = $client->verifyClient($_POST['nom'],$_POST['prenoms'],$_POST['email'],$_POST['contact']);

        if($verify){
            $password = "12345678";
            $newPass = $client->defaultPass($_POST['email'],$password);

            if($newPass){
                echo "<div class='alert alert-success'>Mot de passe réinitialiser... Consultez votre boîte mail</div>";
                $message = "Votre nouveau mot de passe est <strong>$password</strong>, veuillez modifier votre mot de passe le plus tôt pour une meilleur sécurité";
                sendMail("XBANK - Mot de passe Mis à jour",$message,$_POST['email']);
            }
            else {
                echo "<div class='alert alert-warning'>Oops, veuillez réessayer plus tard</div>";
            }
        }
        else {
            echo "<div class='alert alert-danger'>Utilisateur inconnu... Veuillez renseigner les informations tels qu'à l'ouverture du compte</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs</div>";
    }
    