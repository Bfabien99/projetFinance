<?php
    require_once "../models/Clientsdb.php";

    if(!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['email'])){
        $client = new Clientsdb();
        $verify = $client->verifyClient($_POST['nom'],$_POST['prenoms'],$_POST['email'],$_POST['contact']);

        if($verify){
            $password = "12345678";
            $newPass = $client->defaultPass($_POST['email'],$password);

            if($newPass){
                echo "ok";
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
    