<?php

    class Admin{

        private function render(string $fichier, array $data = [], string $message = null){
            extract($data);

            // On démarre le buffer
            ob_start();
            require_once(ROOT.'views/'.strtolower('Admin').'/'.$fichier.'.php');
            $content = ob_get_clean();

            require_once(ROOT.'views/layout/adminpage.php');
        }

        public function index(){
            $model = new Admindb;
            $soldes = $model->AllSolde();
            $sTotal = 0;
            foreach ($soldes as $solde) {
                $sTotal += $solde['solde'];
            }
            $clients = $model->AllClient();
            $historique = $model->Allhistorical();
            $depot = $model->AllDeposite();
            $dTotal = 0;
            foreach ($depot as $solde) {
                $dTotal += $solde['somme'];
            }
            $retrait = $model->AllWithdraw();
            $rTotal = 0;
            foreach ($retrait as $solde) {
                $rTotal += $solde['somme'];
            }
            $this->render('index',compact("clients","historique","dTotal","rTotal","sTotal"));
        }
        
        public function getClients(){
            $model = new Admindb;
            $clients = $model->allClient();
            
            if ($clients) {
                //var_dump($clients);
                $this->render('liste',compact("clients"));
            }
            else {
                $message = "Aucun inscrit pour l'instant";
                $this->render('liste',[],$message);
            }
        }

        public function getHistoric(){
            $model = new Admindb;
            $historique = $model->Allhistorical();
            
            if ($historique) {
                //var_dump($historique);
                $this->render('historique',compact("historique"));
            }
            else {
                $message = "Aucune transaction effectuée";
                $this->render('historique',[],$message);
            }
        }

    }