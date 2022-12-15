<?php
    include "function.php";
    $result = [];

    if(array_key_exists("blog_id", $_GET)) {
        $result['deleted'] = false;
        $is_deleted = delete_blog($_SESSION['id'], $_GET['blog_id']);

        if($is_deleted) {
            $result['deleted'] = true;
        } 
    }

    echo json_encode($result);
?>