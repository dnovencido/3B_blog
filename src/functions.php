<?php
    require "db.php";

    function check_existing_email($email) {
        global $connection;
        $flag = false;

        $query = "SELECT `id` FROM `users` WHERE `email` = '".escape_string($email)."'";
        $result = mysqli_query($connection, $query); 

        if(mysqli_num_rows($result) > 0) {
            $flag = true;
        }
        
        return $flag;
    }

    function escape_string($field) {
        global $connection;

        return mysqli_real_escape_string($connection, $field);
    }

    function save_registration($name, $email, $password) {
        global $connection;
        $user = [];

        $query = "INSERT INTO `users` (`name`, `email`) VALUES ('".escape_string($name)."', '".escape_string($email)."')";
        
        if(mysqli_query($connection, $query)) {
            $id = mysqli_insert_id($connection);
            $encrypted_password = md5(md5($id . $password)); //2mypassword

            $query = "UPDATE `users` SET `password` = '".escape_string($encrypted_password)."' WHERE `users`.`id` = '".$id."'";
            
            if(mysqli_query($connection, $query)) {
                $query = "SELECT * FROM `users` WHERE `users`.`id` = '".$id."' AND `users`.`password` = '".escape_string($encrypted_password)."'";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($result);

                $user = [
                    "id" => $row['id'],
                    "name" => $row['name']
                ];
            }
        }

        return $user;
    }

    function login_account($email, $password) {
        global $connection;
        $user = [];

        $query = "SELECT * FROM `users` WHERE `users`.`email`= '".escape_string($email)."' LIMIT 1"; 
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);

        if(!empty($row)) {
            $hashed_password = md5(md5($row['id'] . $password));
           
            if($hashed_password == $row['password']) {
                $user = [
                    "id" => $row['id'],
                    "name" => $row['name']
                ];
            }
        }

        return $user;
    }

    function get_my_blogs($user_id) {
        global $connection;
        $blogs = [];

        $query = "SELECT `b`.`id` as `blog_id`, `b`.`title`, `b`.`body`, `c`.`category_name`, `b`.`date_created` FROM `blogs` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` WHERE `user_id` = '".mysqli_real_escape_string($connection, $user_id)."' ORDER BY `b`.`id` DESC";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
           $blogs = $result;
        } 

        return $blogs;
    }

    function display_blog_preview($field,$length) {
        return substr($field, 0, $length);
    }

    function get_categories() {
        global $connection;
        $categories = [];
        $query = "SELECT * FROM `categories`";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $categories = $result;
        } 

        return $categories;
    }

    function validate_form_blog($title, $body, $category_id) {
        $validation_errors = [];

        if(!$_POST['title']) {
             $validation_errors[] = "Title is required.";
        }

        if(!$_POST['body']) {
             $validation_errors[] = "The body of the blog is required.";
        }

        if(strlen($_POST['title']) < 20) {
             $validation_errors[] = "The title of the blog must have atleast 20 characters.";
        }

        if(str_word_count($_POST['body']) < 20) {
             $validation_errors[] = "The body of the blog must have atleast 20 words.";
        }

        if(!$_POST['category_id']) {
            $validation_errors[] = "Category is required.";
        }

        return $validation_errors;
    }

    function save_blog($title, $body, $user_id, $category_id) {
        global $connection;
        $flag = false;

        $date_created = date("Y-m-d H:i:s");
        $query = "INSERT INTO `blogs` (`user_id`, `category_id`, `title`, `body`, `date_created`) VALUES ('".mysqli_real_escape_string($connection, $user_id)."', '".mysqli_real_escape_string($connection, $category_id)."', '".mysqli_real_escape_string($connection, $title)."', '".mysqli_real_escape_string($connection, $body)."', '".$date_created."')";
        
        if (mysqli_query($connection, $query)) {
            $flag = true;
        }

        return $flag;    
    }

    function view_blog($id) {
        global $connection;
        $blog = [];

        $query = "SELECT `b`.`id` as blog_id, `b`.`title`, `b`.`body`,  `b`.`category_id`, `c`.`category_name`, `u`.`name`, `u`.`email` FROM `blogs` as `b` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`user_id` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` WHERE `b`.`id` = '".mysqli_real_escape_string($connection, $id)."'";

        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) > 0) {
           $blog = $rows;
        } 

        return $blog;
    }
?>