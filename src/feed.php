<?php 
   include "session.php";
   include "functions.php";
   include "check_login.php";

   $blogs = get_all_blogs();
   $categories = get_categories();

   if(array_key_exists("category_id", $_GET)) {
      $blogs = get_blogs_by_category($_GET['category_id']);
   }
?>
<?php include "layouts/_header.php"; ?>
         <header>
            <?php include "layouts/_navigation.php" ; ?>
         </header>
         <section class="container">
            <h1>Hello <?= $_SESSION['name'] ?>! here is your blog feed.</h1>
            <div id="blog-feed" class="container">
               <div id="blog-categories">
                  <ul>
                     <li>
                        <a href="feed.php"> All </a>
                     </li>
                     <?php foreach($categories as $row) { ?>
                        <li>
                           <a href="feed.php?category_id=<?= $row['id'] ?>"><?= $row['category_name'] ?></a>
                        </li>
                     <?php } ?>
                  </ul>
               </div>
               <div id="blog-feed-list">
                  <?php if(!empty($blogs)) { ?>
                     <?php foreach($blogs as $row) { ?>
                     <div class="blog-feed-item">
                        <div class="blog-feed-header">
                           <a href="view-blog.php?id=<?= $row['blog_id'] ?>">
                              <h3><?= display_blog_preview($row['title'], 50) . '...' ?></h3>
                           </a>
                           <p class="blog-feed-date"><?= date("F m, Y @ g:H a", strtotime($row['date_created'])); ?></p>
                           <p class="blog-feed-author">by : <?= $row['name'] ?> (<?= $row['email'] ?>)</p>
                        </div>
                        <div class="blog-feed-body">
                           <p>
                              <?= display_blog_preview($row['body'], 255) . '...' ?>
                           </p>
                        </div>
                     </div>
                     <?php } ?>
                  <?php } else { ?>
                     <p> No blogs to display under this category...</p>
                  <?php } ?>
               </div>
            </div>
         </section>
<?php include "layouts/_footer.php"; ?>