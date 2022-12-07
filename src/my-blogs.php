<?php
    include "functions.php";
    include "session.php";

    $my_blogs = get_my_blogs($_SESSION['id']);

?>
<?php include "layouts/_header.php" ?>
            <header>
                <?php include "layouts/_navigation.php" ; ?>
            </header>
            <section>
                <div id="my-blogs" class="container">
                    <div id="my-blogs-header">
                        <div class="my-blogs-header-item">
                            <h1>My blogs</h1>
                        </div> 
                        <div class="my-blogs-header-item">
                            <a href="create-blog.php" class="btn btn-md btn-rounded">Add a blog</a>
                        </div>
                    </div>
                    <div id="my-blogs-list">
                        <?php if(!empty($my_blogs)) { ?>
                            <?php foreach($my_blogs as $row) { ?>
                                <div class="my-blogs-item">
                                    <div class="blog-title">
                                        <a href="<?= 'view-blog.php?id=' . $row['blog_id'] ?>">
                                            <h3><?= display_blog_preview($row['title'], 50) . '...' ?></h3>
                                        </a>
                                        <p><?= date("F m, Y @ g:H a", strtotime($row['date_created'])); ?></p>
                                        <span class="category"><?= $row['category_name'] ?></span>
                                    </div>
                                    <div class="blog-body">
                                        <p>
                                            <?= display_blog_preview($row['body'], 255) . '...' ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </section>
<?php include "layouts/_footer.php" ?>