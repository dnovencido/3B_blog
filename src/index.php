<?php 
    include "session.php";

    if(isset($_SESSION['id'])) {
        header('Location: feed.php');
    }
?>
<?php include "layouts/_header.php"; ?>
            <header>
                <?php include "layouts/_navigation.php"; ?>
                <div id="banner" class="container">
                    <div id="banner-description">
                        <h1>Share what you think.</h1>
                        <p>You can share your ideas, opinions with your internet friends and others.</p>
                        <a href="signup.php" class="btn btn-lg btn-rounded">Sign up</a> 
                    </div>
                    <div id="banner-image">
                        <img src="img/banner-image.png" alt="" width="100%">
                    </div>
                </div> 
            </header>
<?php include "layouts/_footer.php"; ?>