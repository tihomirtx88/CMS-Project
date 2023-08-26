<?php
include "includes/header.php";
?>
<?php
include "includes/db.php";
?>

<!-- Navigation -->
<?php
include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            $per_page = 4;
            // CHECK HOW MANY POSTS I HAVE
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                // var_dump($page);
            }else{
                $page = "";
            }
            if ($page == "" || $page = 1) {
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }
            $post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($conection, $post_query_count);
            $count = mysqli_num_rows($find_count);

            $count = ceil($count / $per_page);
            $convertCount = (int)$count;

            // Display All Posts
            $query = "SELECT * FROM posts LIMIT $per_page OFFSET $page_1";
            $select_all_posts_query = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];

                if ($post_status == 'published') {
                    ?>
                    <!-- Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>">
                            <?php echo $post_user ?>
                        </a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span>
                        <?php echo $post_date ?>
                    </p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id ?>"> <img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                    <hr>
                    <p>
                        <?php echo $post_content ?>
                    </p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <?php
                }
            } ?>      

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php
        include "includes/sidebar.php";
        ?>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">
    <?php
      for($i = 1; $i <= $convertCount; $i++){
        if ($i == $page) {

            var_dump($page);
            var_dump($i);
            var_dump($convertCount);
            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        }else{
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
      }
    ?>
    </ul>

    <?php
    include "includes/footer.php";
    ?>