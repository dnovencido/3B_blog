<?php
    include "functions.php";
    include "session.php";

    if (array_key_exists("id", $_GET)) {
        $blog = view_blog($_GET['id']);
    }

?>

<?php include "layouts/_header.php"; ?>
            <header>
                <?php include "layouts/_navigation.php" ; ?>
            </header>
            <section>
                <div class="container">
                    <div id="blog-view">
                        <div class="blog-view-item">
                            <?php if(!empty($blog)) { ?>
                                <h1 class="title"><?= $blog['title'] ?></h1>
                                <span class="category"><?= $blog['category_name'] ?></span>
                                <p class="information">Word from : <?= $blog['name'] ?> (<?= $blog['email'] ?>)</p>
                                <div class="actions">
                                    <?php if(is_owner($_SESSION['id'], $blog['user_id'])) { ?>
                                    <p>
                                        <a href="edit-blog.php?id=<?= $blog['blog_id'] ?>">[ Edit ]</a>
                                        <a id="btn-delete" href="#" data-id="<?= $blog['blog_id'] ?>">[ Delete ]</a>
                                    </p>
                                    <?php } ?>
                                </div>
                                <div id="view-blog">
                                   <?= nl2br($blog['body']) ?>
                                </div>
                            <?php } else { ?> 
                                <div class="alert alert-danger">
                                    <p>Something went wrong in displaying blog post. </p>
                                </div>  
                            <?php } ?>
                        </div>
                        <div class="blog-view-item">
                            <h3>Trending Blogs</h3>
                        </div>
                    </div>
                </div>
            </section>
<?php include "layouts/_footer.php"; ?>