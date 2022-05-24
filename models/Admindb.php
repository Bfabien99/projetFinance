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

        public function allClient(){
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
        
    }