<?php
    include "functions.php";
    include "session.php";

    $errors = [];

    if($_POST['submit']) {

        if(!$_POST['email']){
            $errors[] = "Email is required";
        }

        if(!$_POST['password']){
            $errors[] = "Password is required";
        }

        if(empty($errors)) {
            $user = login_account($_POST['email'], $_POST['password']);
            if(!empty($user)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                header("Location: account.php");
            } else {
                $errors[] = "The email address or password that you've entered does not match any account.";
            }
        }
    }
?>
<?php include "layouts/_header.php"; ?>
            <header>
                <?php include("layouts/_navigation.php"); ?>
            </header>
            <section>
                <div class="container">
                    <div id="login">
                        <div id="login-form">
                            <h1>Login your account.</h1>
                            <?php if(!empty($errors)) { ?>
                                <?php include "layouts/_error-messages.php" ?>
                            <?php } ?>
                            <form method="post">
                                <div class="input-control">
                                    <label for="name">Email: </label>
                                    <input type="email" name="email" class="input-field" value="<?= $_POST['email'] ?>" />
                                </div>
                                <div class="input-control">
                                    <label for="name">Password: </label>
                                    <input type="password" name="password" class="input-field" value="<?= $_POST['password'] ?>" />
                                </div>
                                <div class="input-control">
                                    <input type="submit" name="submit" class="btn btn-md btn-rounded" value="Login" />
                                </div>
                            </form>
                        </div>                
                    </div>
                </div>
            </section>
<?php include "layouts/_footer.php"; ?>