<?php
    session_start();
    require "../vendor/autoload.php";
    require_once "../models/Clientsdb.php";
    include_once '../mail.php';

    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['cpassword'])){
        if($_POST['password'] !== $_POST['cpassword']){
            echo "<div class='alert alert-danger'>Le mot de passe ne correspond pas</div>";
        }
        else {
            $clients = new Clientsdb();
            $newPass = $clients->defaultPass($_POST['email'],$_POST['password']);

            if($newPass){
                echo "<div class='alert alert-success'>Mot de passe mis à jour</div>";
            }
            else{
                echo "<div class='alert alert-danger'>Oops, veuillez réessayer plus tard</div>";
            }
        }
    }
    else{
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs</div>";
    }