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
            $historiques = $client->getHistorical($id,4);

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

        public function params($id){
            $client = new Clientsdb();
            $datas = $client->getClient($id);

            if($datas){
                $this->render('parametres',compact("datas"));
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
            $customer = $client->getClient($id);
            $depotLength = $client->depotTotal($id) ?? 0;
            $retraitLength = $client->retraitTotal($id) ?? 0;

           // Pour avoir le dépot total
            $depotTotal = 0;
            if(!empty($depotLength)){
                if ($depotLength) {
                    foreach ($depotLength as $depot) {
                        $depotTotal+= $depot["somme"];
                    }
                }
            }
            
            
            // Pour avoir le retrait total
            $retraitTotal = 0;
            if(!empty($retraitLength)){
                if($retraitLength){
                    foreach ($retraitLength as $retrait) {
                        $retraitTotal+= $retrait["somme"];
                    }
                }
            }
            

            // Pour avoir l'historique
            $historiques = $client->getHistorical($id,10);
            $bilans = [];

            if ($historiques) {
                foreach ($historiques as $value) {
                    $bilans [] = ["somme" => $value['somme'],"date" => date("d-m-Y G:i",strtotime($value['date'])),"type" => $value["type"]] ;
                }
            }
            

            $this->render('compte',compact("depotLength","retraitLength","bilans","depotTotal","retraitTotal","customer"));
        }


        // Page Historique
        public function historical($id,$limit){
            $client = new Clientsdb();
            $historiques = $client->getHistorical($id,$limit);
            $message = "RECENTES ACTIVITES";
            if ($historiques) {
                    $this->render('historique',compact("historiques"),$message);
                }
            else{
                $this->render('historique');
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