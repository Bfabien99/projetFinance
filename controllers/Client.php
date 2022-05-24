<?php

    class Client{

        private function render(string $fichier, array $data = [], string $message = null){
            extract($data);

            // On démarre le buffer
            ob_start();
            require_once(ROOT.'views/'.strtolower('Client').'/'.$fichier.'.php');
            $content = ob_get_clean();

            require_once(ROOT.'views/layout/clientpage.php');
        }

        public function index($id){
            $client = new Clientsdb();
            $datas = $client->getClient($id);
            $historiques = $client->getHistorical($id,3);
            if ($datas) {
                    $this->render('index',compact("datas","historiques"));
                }
            
        }

        public static function pageDepot(){
            return self::render('depot');
        }

        public static function pageRetrait(){
            return self::render('retrait');
        }
    }