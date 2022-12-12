<?php
    include "functions.php"; 
    include "session.php";

    $errors = [];

    if($_POST['submit']) {

        if(!$_POST['name']){
            $errors[] = "Name is required";
        }

        if(!$_POST['email']){
            $errors[] = "Email is required";
        }

        if(!$_POST['password']){
            $errors[] = "Password is required";
        }

        if(empty($errors)) {
            if(!check_existing_email($_POST['email'])) {
                $user = save_registration($_POST['name'], $_POST['email'], $_POST['password']);
                if(!empty($user)) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
    
                    header("Location: feed.php");
                } else {
                    $errors[] = "There was an error logging in your account.";
                }
            } else {
                $errors[] = "The email address is already existing.";
            }
        }
        
    }
?>
<?php include "layouts/_header.php"; ?>
            <header>
                <?php include "layouts/_navigation.php"; ?>
            </header>
            <section>
                <div class="container">
                    <div id="register">
                        <div id="register-form">
                            <h1>Register an account.</h1>
                            <?php if(!empty($errors)) { ?>
                                <?php include "layouts/_error-messages.php" ?>
                            <?php } ?> 
                            <form method="post">
                                <div class="input-control">
                                    <label for="name">Name: </label>
                                    <input type="text" name="name" class="input-field" value="<?= $_POST['name'] ?>" />
                                </div>
                                <div class="input-control">
                                    <label for="name">Email: </label>
                                    <input type="email" name="email" class="input-field" value="<?= $_POST['email'] ?>" />
                                </div>
                                <div class="input-control">
                                    <label for="name">Password: </label>
                                    <input type="password" name="password" class="input-field" value="<?= $_POST['password'] ?>" />
                                </div>
                                <div class="input-control">
                                    <input type="submit" name="submit" class="btn btn-md btn-rounded" value="Register" />
                                </div>
                            </form>
                        </div>                
                    </div>
                </div>                
            </section>
<?php include "layouts/_footer.php"; ?>