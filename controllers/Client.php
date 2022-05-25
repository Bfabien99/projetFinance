<?php

    class Client{

        // Pour rendre le controller avec la vue qui convient
        private function render(string $fichier, array $data = [], string $message = null){
            extract($data);

            // On démarre le buffer
            ob_start();
            require_once(ROOT.'views/'.strtolower('Client').'/'.$fichier.'.php');
            $content = ob_get_clean();

            require_once(ROOT.'views/layout/clientpage.php');
        }

        // Page Index
        public function index($id){
            $client = new Clientsdb();
            $datas = $client->getClient($id);
            $historiques = $client->getHistorical($id,3);

            // On récupère tous les éléments
            $depotTotal = $client->depotTotal($id);
            $depots = 0;

            if ($depotTotal) {
                // On fait la somme des éléments récupérés
                foreach ($depotTotal as $depot) {
                    $depots+= $depot["somme"];
                }
            }
            

            $retraitTotal = $client->retraitTotal($id);
            $retraits = 0;

            if($retraitTotal){
                foreach ($retraitTotal as $retrait) {
                    $retraits+= $retrait["somme"];
                }
            }
            
            if ($datas) {
                    $this->render('index',compact("datas","historiques","depots","retraits"));
                }
            
        }

        public function confirmMail($email, $hash){
            $client = new Clientsdb();
            $mailget = $client->confirmMailClient($email);
            if($mailget){
                if(password_verify($email, $hash)){
                    $client->enableClient($email);
                    return true;
                }
                else {
                   return false;
                }
            }
            else{
                if ($client->getClientbyEmail($email)) {
                    if(password_verify($email, $hash)){
                        die('<div><h1 style="text-align:center;">VOUS ETES DEJA INSCRIT<h1></div>');
                    }
                }
            }
            
        }

        // Page Compte
        public function account($id){
            $client = new Clientsdb();
            $depotLength = $client->depotTotal($id) ?? 0;
            $retraitLength = $client->retraitTotal($id) ?? 0;

            $this->render('compte',compact("depotLength","retraitLength"));
        }


        // Page Historique
        public function historical($id,$limit){
            $client = new Clientsdb();
            $historiques = $client->getHistorical($id,$limit);
            $message = "RECENTES ACTIVITES";
            if ($historiques) {
                    $this->render('historique',compact("historiques"),$message);
                }
        }

        // Page Depot
        public static function pageDepot(){
            return self::render('depot');
        }

        // Page Retrait
        public static function pageRetrait(){
            return self::render('retrait');
        }
    }