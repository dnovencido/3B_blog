<?php
    include "functions.php";
    include "session.php";

    $errors = [];

    $categories = get_categories();

    if($_POST['submit']) {
        $errors = validate_form_blog($_POST['title'], $_POST['body'], $_POST['category']);
        if(empty($errors)) {
            $save_blog = save_blog($_POST['title'], $_POST['body'], $_SESSION['id'], $_POST['category_id']);
            if($save_blog) {
                header("Location: my-blogs.php");
            } else {
                $errors[] = "Could not create a blog post. Please try again later.";
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
                    <div id="create-blog">
                        <h1>Create a blog</h1>
                        <?php if (!empty($errors)) { ?>
                            <?php include "layouts/_error-messages.php" ?>
                        <?php } ?>
                        <form method="POST">
                            <div class="input-control">
                                <label for="title">Title: </label>
                                <input type="text" name="title" class="input-field" value="<?= $_POST['title'] ?>" />
                            </div>
                            <div class="input-control">
                                <label for="body">Body: </label>
                                <textarea name="body" class="input-field" cols="30" rows="20"><?= $_POST['body'] ?></textarea>
                            </div>
                            <div class="input-control">
                                <label for="category">Category:</label>
                                <select name="category_id" id="category" class="input-field">
                                    <option value="">--- Select Category ---</option>
                                    <?php if(!empty($categories)) { ?>
                                        <?php foreach ($categories as $row) { ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $_POST['category_id']) ? 'selected' : '' ?>><?= $row['category_name'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-control">
                                <input type="submit" name="submit" class="btn btn-md btn-rounded" value="Create" />
                            </div>
                        </form>
                    </div>
                </div>
            </section>
<?php include "layouts/_footer.php"; ?>