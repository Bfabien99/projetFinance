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
            // $model = new Admindb;
            // $clients = $model->allClient();
            
            // if ($clients) {
            //     //var_dump($clients);
            //     $this->render('liste',compact("clients"));
            // }
            // else {
            //     $message = "Aucun inscrit pour l'instant";
            //     $this->render('liste',[],$message);
            // }
            $this->render('index');
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

    }