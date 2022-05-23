<?php

    class Clientsdb{

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

        public function insertClient($nom,$prenoms,$contact,$email,$password){
            $connect = $this->getConnexion();
            $query = "INSERT INTO clients(nom,prenoms,contact,email,password) VALUES(:nom,:prenoms,:contact,:email,:password)";
            $stmt = $connect->prepare($query);
            $insert = $stmt->execute([
                "nom" => $nom,
                "prenoms" => $prenoms,
                "contact" => $contact,
                "email" => $email,
                "password" => $password
            ]);
            
            if ($insert) {
                return true;
            }
            else{
                return false;
            }
        }

        public function doubleUser($email){
            $connect = $this->getConnexion();
            $query = "SELECT * FROM clients WHERE email= :email";
            $stmt = $connect->prepare($query);
            $stmt->execute([
                "email" => $email
            ]);
            
            $client = $stmt->fetch();
            if ($client) {
                return true;
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