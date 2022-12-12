<?php

    include "functions.php";
    include "session.php";
    include "check_login.php";
    
    $errors = [];
    $categories = get_categories();

    if (array_key_exists("id", $_GET)) {
        $blog = view_blog($_GET['id']);
        $blog_id = $blog['blog_id'];

        if($_POST['submit']) {
            $errors = validate_form_blog($_POST['title'], $_POST['body'], $_POST['category_id']);
            if(empty($errors)) {
                if(update_blog($blog_id, $_POST['title'], $_POST['body'], $_POST['category_id'])) {
                    header("Location: view-blog.php?id=". $blog_id);
                } else {
                    $errors[] = "Could not update a blog post. Please try again later.";
                }
            } 
        }
    }
?>

<?php include "layouts/_header.php"; ?>
            <header>
                <?php include "layouts/_navigation.php" ; ?>
            </header>
            <section>
                <div class="container">
                    <?php if (!empty($errors)) { ?>
                        <?php include "_error-message.php" ?>
                    <?php } ?>
                    <form method="POST">
                        <div class="input-control">
                            <label for="title">Title: </label>
                            <input type="text" name="title" class="input-field" value="<?= isset($_POST['title']) ? $_POST['title'] : $blog['title'] ?>">
                        </div>
                        <div class="input-control">
                            <label for="body">Body: </label>
                            <textarea name="body" class="input-field" cols="30" rows="20"><?= isset($_POST['body']) ? $_POST['body'] : $blog['body'] ?></textarea>
                        </div>
                        <div class="input-control">
                            <label for="category">Category:</label>
                            <select name="category_id" id="category" class="input-field">
                                <option value="">--- Select Category ---</option>
                                <?php if(!empty($categories)) { ?>
                                    <?php $category_id = (isset($_POST['category_id']) ? $_POST['category_id'] : $blog['category_id']); ?>
                                    <?php foreach ($categories as $row) { ?>
                                        <option value="<?= $row['id'] ?>" <?= ($row['id'] == $category_id) ? 'selected' : '' ?>><?= $row['category_name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-control">
                            <input type="submit" name="submit" class="btn btn-md btn-rounded" value="Update" />
                        </div>
                    </form>
                </div>
            </section>
<?php include "layouts/_footer.php"; ?>