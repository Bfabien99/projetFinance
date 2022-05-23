<?php
    require_once "../models/Clientsdb.php";
    include_once "../functions/encryptpass.php";
    include_once "../functions/inputClean.php";

if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['password']) && !empty($_POST['email'])) {

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo "<div class='alert alert-danger'>Votre email n'est pas valide</div>";
        die();
    }

    $client = new Clientsdb();
    $contact = preg_replace('/[^0-9]/', '', $_POST['contact']);

    $exist = $client->doubleUser(inputClean($_POST['email']));

    if (!$exist) 
    {
        $result = $client->insertClient(inputClean($_POST['nom']),inputClean($_POST['prenoms']),inputClean($contact),inputClean($_POST['email']),encryptpass($_POST['password']));
        if($result){
           echo "ok"; 
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