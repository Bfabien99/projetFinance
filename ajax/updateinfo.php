<?php
    session_start();
    require "../vendor/autoload.php";
    require_once "../models/Clientsdb.php";
    include_once '../mail.php';

    if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['email'])){


        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<div class='alert alert-danger'>Votre email n'est pas valide</div>";
            die();
        }

        $img = "";

        //Chargement de l'image
        if(!empty($_FILES['file'])){
            $fileInfo = pathinfo($_FILES['file']['name']);
            $extension = $fileInfo['extension'];
            $allowedExtensions = array('jpg', 'jpeg', 'png');

            //Verifie si l'extension est valide
            if(in_array($extension, $allowedExtensions))
            {
                //On stocke le fichier
                $img = str_replace("/","",md5($_SESSION['xbank_client_id'])."_". basename($_FILES['file']['name']));
                $img = str_replace(" ","",$img);
            }
            
        }

        $clients = new Clientsdb();
        $update = $clients->updateInfoClient($_SESSION['xbank_client_id'],$_POST['nom'],$_POST['prenoms'],$_POST['contact'],$_POST['email'],$img);

        if($update){
            move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/user/' . $img);
            echo "<div class='alert alert-success'>Informations mis à jour</div>";
        }
        else{
            echo "<div class='alert alert-danger'>Oops, veuillez réessayer plus tard</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs</div>";
    }