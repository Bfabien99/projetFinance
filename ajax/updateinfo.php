<?php
    session_start();
    require "../vendor/autoload.php";
    require_once "../models/Clientsdb.php";
    include_once '../mail.php';

    if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['email'])){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<div class='alert alert-danger'>Votre email n'est pas valide</div>";
        }
        else {
            $clients = new Clientsdb();
            $update = $clients->updateInfoClient($_SESSION['xbank_client_id'],$_POST['nom'],$_POST['prenoms'],$_POST['contact'],$_POST['email']);

            if($update){
                echo "<div class='alert alert-success'>Informations mis à jour</div>";
            }
            else{
                echo "<div class='alert alert-danger'>Oops, veuillez réessayer plus tard</div>";
            }
        }
    }
    else{
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs</div>";
    }