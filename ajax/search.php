<?php

require_once "../models/Admindb.php";

if(!empty(trim($_POST['search']))){
    $admin = new Admindb;
    $search = $admin->searchclient($_POST['search']);

    if($search){
        foreach($search as $client){
            $data [] = $client;
        };

        $data = json_encode($data);
        echo $data;
    }
}