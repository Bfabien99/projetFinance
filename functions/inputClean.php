<?php

    function inputClean($post){
        $post = trim($post);
        $post = stripslashes($post);
        $post = strip_tags($post);
        $post = ucwords($post);
        return $post;
    }

?>