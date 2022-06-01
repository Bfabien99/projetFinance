<?php

    class Admindb{

        // Méthode pour sécuriser les entrées
        private function inputClean($post){
            $post = trim($post);
            $post = stripslashes($post);
            $post = strip_tags($post);
            $post = mb_strtolower($post);
            $post = ucwords($post);
            return $post;
        }

        private function encryptpass($pass){
            $pass = sha1($pass);
            $pass = md5($pass);
            return $pass;
        }

        private function contactFormat($contact){
            $new_contact = preg_replace('/[^0-9]/', '', $contact);
            return $this->inputClean($new_contact);
        }

        public function getConnexion(){

            try{
                $dsn="mysql:dbname=xbank;host=localhost";
                $password = "";
                $user = "root";

                $connect = new PDO($dsn,$user,$password,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

                return $connect;
            }
            
            catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function login($identifiant, $password){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM admin WHERE (contact = :identifiant OR email= :identifiant) AND password= :password";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "identifiant" => $this->inputClean($identifiant),
                "password" => $this->encryptpass($password)
            ]);
            $admin = $stmt->fetch();
            if ($admin) {
                return $admin;
            }
            else{
                return false;
            }
        }

        public function AllClient(){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $clients = $stmt->fetchAll();
            if ($clients) {
                return $clients;
            }
            else{
                return false;
            }
        }

        public function removeClient($id){
            $connect = $this->getConnexion();
            $query = "DELETE FROM clients WHERE id = $id";
            $stmt = $connect->prepare($query);
            $delete = $stmt->execute();
            
            if ($delete) {
                return true;
            }
            else{
                return false;
            }
        }

        public function searchclient($text){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE nom LIKE '".'%'.$this->inputClean($text).'%'."' OR prenoms LIKE '".'%'.$this->inputClean($text).'%'."'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $search = $stmt->fetchAll();
            if ($search) {
                return $search;
            }
            else{
                return false;
            }
        }

        public function AllSolde(){
            $connect = $this->getConnexion();
            $query = "SELECT solde FROM clients WHERE enable = 1";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $solde = $stmt->fetchAll();
            if ($solde) {
                return $solde;
            }
            else{
                return false;
            }
        }

        public function ClientInfo($id){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE id = $id";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $client = $stmt->fetch();
            if ($client) {
                return $client;
            }
            else{
                return false;
            }
        }

        public function AllDeposite(){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM depot";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $solde = $stmt->fetchAll();
            if ($solde) {
                return $solde;
            }
            else{
                return false;
            }
        }

        public function ClientDepot($id){
            $connect = $this->getConnexion();
            $query = "SELECT somme FROM depot WHERE client_id = $id";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $depot = $stmt->fetchAll();
            if ($depot) {
                return $depot;
            }
            else{
                return false;
            }
        }

        public function AllWithdraw(){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM retrait";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $solde = $stmt->fetchAll();
            if ($solde) {
                return $solde;
            }
            else{
                return false;
            }
        }

        // Pour obtenir le retrait toal du client
        public function ClientWithdraw($id){
            $connect = $this->getConnexion();
            $query = "SELECT somme FROM retrait WHERE client_id = $id";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $retrait = $stmt->fetchAll();
            if ($retrait) {
                return $retrait;
            }
            else{
                return false;
            }
        }


        public function Allhistorical(){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients INNER JOIN historiques ON historiques.client_id = clients.id ORDER BY historiques.date";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $historical = $stmt->fetchAll();

            if ($historical) {
                return $historical;
            }
            else{
                return false;
            }
        }

        public function ClientHistorical($id,$limit){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients INNER JOIN historiques ON historiques.client_id = clients.id WHERE historiques.client_id = $id  ORDER BY historiques.date DESC LIMIT  $limit";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $historical = $stmt->fetchAll();
            
            if ($historical) {
                return $historical;
            }
            else{
                return false;
            }
        }
        
    }