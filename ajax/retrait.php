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

            if($montant >= 1000){

                if(($montant % 100) == 0){
                    $client = new Clientsdb();
                    $customer = $client->getClient($_SESSION['xbank_client_id']);
                    
                    $solde = $client->getSolde($_SESSION['xbank_client_id']);
                    $solde = (int)$solde['solde'];

                    if($montant <= $solde){
                        $depot = $client->withdraw($_SESSION['xbank_client_id'], $montant);
                        if ($depot) {
                            echo "<div class='alert alert-success'>Retrait effectué avec succès</div>";
                            echo "<div class='alert alert-info'>Nouveau solde: ".($solde - ($montant))." fcfa</div>";

                            $message = "Vous venez de faire un retrait de <strong>$montant fcfa</strong> sur votre compte.";

                            if(sendMail('XBANK - Transaction éffectuée',$message,$customer['email'])){
                                echo "<div class='alert alert-warning'> Un mail vous a été adressé</div>";
                            }
                            else {
                                echo "<div class='alert alert-warning'> Un mail vous sera adressé</div>";
                            }
                            
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger'>Solde insuffisant</div>";
                        echo "<div class='alert alert-info'>Solde actuel: $solde</div>";
                    }
                    
                }
                else {
                    echo "<div class='alert alert-danger'>Montant invalide</div>";
                }

            }
            else{
                echo "<div class='alert alert-danger'>Montant insuffisant</div>";
                echo "<div class='alert alert-danger'>Montant minimum 1000 fcfa</div>";
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