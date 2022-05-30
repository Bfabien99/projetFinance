<?php
    session_start();
    require_once "../models/Clientsdb.php";
    require_once "../vendor/autoload.php";
    include_once '../mail.php';

    if(!empty($_POST['montant'])){
        $montant = $_POST['montant'];

        if(is_numeric($montant)) {
            $montant = (int) $montant;
            
            if ($montant > 500000) {
                echo "<div class='alert alert-danger'>Montant élevé</div>";
                echo "<div class='alert alert-danger'>Montant maximum 500.000 fcfa</div>";
                die();
            }

            if($montant >= 500){

                if(($montant % 100) == 0){
                    $client = new Clientsdb();
                    $customer = $client->getClient($_SESSION['xbank_client_id']);

                    $depot = $client->deposite($_SESSION['xbank_client_id'], $montant);
                    $solde = $client->getSolde($_SESSION['xbank_client_id']);
                    $solde = (int)$solde['solde'];
                    
                    if ($depot) {
                        echo "<div class='alert alert-success'>Dépôt effectué avec succès</div>";
                        echo "<div class='alert alert-info'>Nouveau solde: ".($solde)." fcfa</div>";

                        $message = "Vous venez de faire un dépôt de <strong>$montant fcfa</strong> sur votre compte. Votre solde actuel est de <strong> $solde fcfa </strong>. <br> <h3>XBANK vous remercie!</h3>";
                        
                        if(sendMail('XBANK - Transaction éffectuée',$message,$customer['email'])){
                            echo "<div class='alert alert-warning'> Un mail vous a été adressé</div>";
                        }
                        else {
                            echo "<div class='alert alert-warning'> Un mail vous sera adressé</div>";
                        }
                    }
                }
                else {
                    echo "<div class='alert alert-danger'>Montant invalide</div>";
                }

            }
            else{
                echo "<div class='alert alert-danger'>Montant insuffisant</div>";
                echo "<div class='alert alert-danger'>Montant minimum 500 fcfa</div>";
            }

        }
        else{
            echo "<div class='alert alert-danger'>Veuillez entrer une valeur numérique</div>";
        }
       
    }
    else {
        echo "<div class='alert alert-warning'>Veuillez renseigner le montant</div>";
    }
?>