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

        // Page Historique
        public function historical($id,$limit){
            $client = new Clientsdb();
            $historiques = $client->getHistorical($id,$limit);
            $message = "$limit RECENTES ACTIVITES";
            if ($historiques) {
                    $this->render('historique',compact("historiques"),$message);
                }
        }

        public static function pageDepot(){
            return self::render('depot');
        }

        public static function pageRetrait(){
            return self::render('retrait');
        }
    }