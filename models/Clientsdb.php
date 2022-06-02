<?php

    class Clientsdb{
        
        // Méthode pour sécuriser les entrées
        public function inputClean($post){
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


        // Méthode de la class

        // Se connecter à la base de donnée
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

        // Pour se connecter à son espace client
        public function login($identifiant, $password){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE (contact = :identifiant OR email= :identifiant) AND password= :password AND enable = 1";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "identifiant" => $this->inputClean($identifiant),
                "password" => $this->encryptpass($password)
            ]);
            $client = $stmt->fetch();
            if ($client) {
                return $client;
            }
            else{
                return false;
            }
        }

        // Pour s'inscrire sur la plateforme
        public function insertClient($nom,$prenoms,$contact,$email,$password){
            $connect = $this->getConnexion();
            $query = "INSERT INTO clients(nom,prenoms,contact,email,password) VALUES(:nom,:prenoms,:contact,:email,:password)";
            $stmt = $connect->prepare($query);
            $insert = $stmt->execute([
                "nom" => $this->inputClean($nom),
                "prenoms" => $this->inputClean($prenoms),
                "contact" => $this->contactFormat($contact),
                "email" => $this->inputClean($email),
                "password" => $this->encryptpass($password)
            ]);
            
            if ($insert) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour vérifier si le client n'existe pas
        public function doubleUser($email){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE email= :email";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "email" => $this->inputClean($email)
            ]);
            
            $client = $stmt->fetch();
            if ($client) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour récuper les informations d'un client à partir de l'id
        public function getClient($id){
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

        // Pour vérifier qu'une email existe dans la bdd
        public function getClientbyEmail($email){
            $connect = $this->getConnexion();
            $query = 'SELECT email FROM clients WHERE email = '.'"'.$email.'"';
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $client = $stmt->fetch();
            if ($client) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour vérifier les infos du client (mot de passe oublié)
        public function verifyClient($nom,$prenoms,$email,$contact){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE nom = :nom AND prenoms= :prenoms AND email= :email AND contact= :contact AND enable = 1";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "nom" => $this->inputClean($nom),
                "prenoms" => $this->inputClean($prenoms),
                "email" => $this->inputClean($email),
                "contact" => $this->contactFormat($contact)
            ]);
            $client = $stmt->fetch();
            if ($client) {
                return $client;
            }
            else{
                return false;
            }
        }

        // Modifier information client
        public function updateInfoClient($id,$nom, $prenoms, $contact, $email, $picture)
        {
            $connect = $this->getConnexion();

            $query = $connect->prepare("UPDATE clients SET nom=:nom, prenoms=:prenoms, contact=:contact, email=:email, profil_pic=:profil_pic WHERE id=$id");

            $insert = $query->execute(
                [
                    "nom" => $this->inputClean($nom),
                    "prenoms" => $this->inputClean($prenoms),
                    "contact" => $this->contactFormat($contact),
                    "email" => $this->inputClean($email),
                    "profil_pic" => strip_tags($picture)
                ]
            );

            if($insert)
            {
                return true;
            }
            else
            {
                return false;
            } 
            
        }

        // Reinitialiser le mot de passe
        public function defaultPass($email, $password)
        {
            $connect = $this->getConnexion();

            $query = $connect->prepare("UPDATE clients SET password=:password WHERE email=:email");

            $insert = $query->execute(
                [
                    "password" => $this->encryptpass($password),
                    "email" => $this->inputClean($email)
                ]
            );
            
            if($insert)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Pour confirmer l'email
        public function confirmMailClient($email){
            $connect = $this->getConnexion();
            $query = "SELECT email FROM clients WHERE email = :email and enable = 0";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "email" => $this->inputClean($email),
            ]);
            $client = $stmt->fetch();
            if ($client) {
                return $client['email'];
            }
            else{
                return false;
            }
        }

        // Pour activer le compte
        public function enableClient($email){
            $connect = $this->getConnexion();
            $query = "UPDATE clients SET enable = 1 WHERE email = :email";
            $stmt = $connect->prepare($query);
            $enable = $stmt->execute([
                "email" => $this->inputClean($email),
            ]);
            if ($enable) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour supprimer un client
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

        // Pour obtenir le solde d'un client
        public function getSolde($id){
            $connect = $this->getConnexion();
            $query = "SELECT solde FROM clients WHERE id = $id AND enable = 1";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $solde = $stmt->fetch();
            if ($solde) {
                return $solde;
            }
            else{
                return false;
            }
        }

        // Pour augmenter le solde
        private function plusSolde($id,$somme){
            $connect = $this->getConnexion();
            $query = "UPDATE clients SET solde = solde + $somme WHERE id = $id AND enable = 1";
            $stmt = $connect->prepare($query);
            $plus = $stmt->execute();
            if ($plus) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour diminuer le solde
        private function moinSolde($id,$somme){
            $connect = $this->getConnexion();
            $query = "UPDATE clients SET solde = solde - $somme WHERE id = $id AND enable = 1";
            $stmt = $connect->prepare($query);
            $moin = $stmt->execute();
            if ($moin) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour faire un depot
        public function deposite($id, $somme){
            $connect = $this->getConnexion();
            $query = "INSERT INTO depot(client_id, somme) VALUES(:id, :somme)";
            $stmt = $connect->prepare($query);
            $depot = $stmt->execute([
                "id" => $id,
                "somme" => $somme
            ]);
            if ($depot) {
                // On ajoute l'action à l'historique
                $this->insertHistorical($id,$somme,'depot');
                $this->plusSolde($id,$somme);
                return true;
            }
            else{
                return false;
            }
        }

        // Pour obtenir le depot toal du client
        public function depotTotal($id){
            $connect = $this->getConnexion();
            $query = "SELECT somme, date_depot FROM depot WHERE client_id = $id";
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

        // Pour faire un retrait
        public function withdraw($id, $somme){
            // On vérifie si le solde est suffisant pour faire le retrait
            if($this->getSolde($id) < $somme ){
                return false;
            }
            else{
                $connect = $this->getConnexion();                
                $query = "INSERT INTO retrait(client_id, somme) VALUES(:id, :somme)";
                $stmt = $connect->prepare($query);
                $retrait = $stmt->execute([
                    "id" => $id,
                    "somme" => $somme
                ]);
                if ($retrait) {
                    // On ajoute l'action à l'historique
                    $this->insertHistorical($id,$somme,'retrait');
                    $this->moinSolde($id,$somme);
                    return true;
                }
                else{
                    return false;
                } 
            }
            
        }

        // Pour obtenir le retrait toal du client
        public function retraitTotal($id){
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

        // Pour créer l'historique des transactions (depot ou retrait)
        private function insertHistorical($id,$somme,$type){
            $connect = $this->getConnexion();
            $query = "INSERT INTO historiques(client_id,somme,type) VALUES(:id,:somme,:type)";
            $stmt = $connect->prepare($query);
            $insert = $stmt->execute([
                "id" => $id,
                "somme" =>$somme,
                "type" => $type
            ]);
            
            if ($insert) {
                return true;
            }
            else{
                return false;
            }
        }

        // Pour avoir l'historique
        public function getHistorical($id,$limit){
            $connect = $this->getConnexion();
            $query = "SELECT somme,type,date FROM clients INNER JOIN historiques ON historiques.client_id = clients.id WHERE historiques.client_id = $id  ORDER BY historiques.date DESC LIMIT  $limit";
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