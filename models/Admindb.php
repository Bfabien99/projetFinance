<?php

    class Admindb{

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
                "identifiant" => $identifiant,
                "password" => $password
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