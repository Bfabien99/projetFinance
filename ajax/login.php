<?php
    require_once "../models/Clientsdb.php";
    require_once "../models/Admindb.php";
    include_once "../functions/encryptpass.php";
    include_once "../functions/inputClean.php";

    if(!empty($_POST['identifiant']) && !empty($_POST['password'])){

        $client = new Clientsdb();
        $isclient = $client->login(inputClean($_POST['identifiant']),encryptpass($_POST['password']));

        $admin = new Admindb();
        $isadmin = $admin->login(inputClean($_POST['identifiant']),encryptpass($_POST['password']));

        if($isclient){
            $_SESSION['xbank_client_id'] = $isclient['id'];
            echo "client";
        }
        elseif($isadmin){
            $_SESSION['xbank_id'] = $isadmin['id'];
            echo "admin";
        }
        else{
            echo "<div class='alert alert-danger'>Email/Pseudo ou mot de passe incorrect!</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs</div>";
    }