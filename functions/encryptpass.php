<?php

    function encryptpass($pass){
        $pass = sha1($pass);
        $pass = md5($pass);
        return $pass;
    }

?>