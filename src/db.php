<?php

    //Db credentials
    $host_name = "mysql_db";
    $db_name = "db_blog";
    $username = "root";
    $password = "root";

    //Connect to a database (hostname, username, password, database name)
    $connection = mysqli_connect($host_name, $username, $password, $db_name);

    if(!$connection) {
        die("Connection failed : " . mysqli_connect_error());
    }

?>