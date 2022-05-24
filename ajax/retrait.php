<?php
    session_start();
    require_once "../models/Clientsdb.php";
    require_once "../vendor/autoload.php";

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
                    $solde = $client->getSolde($_SESSION['xbank_client_id']);
                    $solde = (int)$solde['solde'];

                    if($montant <= $solde){
                        $depot = $client->withdraw($_SESSION['xbank_client_id'], $montant);
                        if ($depot) {
                            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
                            ->setUsername('fabienbrou99@gmail.com')
                            ->setPassword('#FabienBrou99');
                            $mailer = new Swift_Mailer($transport);

                            // Create a message
                            $message = (new Swift_Message('Action effectué sur X-BANK'))// Objet
                                ->setFrom(['john@doe.com' => 'X-BANK'])// Le nom
                                ->setTo(['fabienbrou99@gmail.com', 'other@domain.org' => 'A name'])
                                ->setBody('Vous venez d\'éffectuer un retrait de <strong>'.$montant.'</strong> fcfa')
                                ->setContentType("text/html");

                            // Send the message
                            $mailer->send($message);

                            
                            echo "<div class='alert alert-success'>Retrait effectué avec succès</div>";
                            echo "<div class='alert alert-info'>Nouveau solde: ".($solde - ($montant))." fcfa</div>";
                            
                            
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