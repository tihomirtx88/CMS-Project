<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Category</th>
            <th>Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>Date</th>
            <th>Image</th>
            <th>Comments</th>
            <th>Tags</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // GET ALL POSTS
        $query = 'SELECT * FROM posts ';
        $select_posts = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id =  $row['post_id'];
            $post_category_id =  $row['post_category_id'];
            $post_title =  $row['post_title'];
            $post_author =  $row['post_author'];
            $post_date =  $row['post_date'];
            $post_image =  $row['post_image'];
            $post_content =  $row['post_content'];
            $post_tags =  $row['post_tags'];
            $post_comment_count =  $row['post_comment_count'];
            $post_status =  $row['post_status'];
            var_dump($post_comment_count);
    
            echo "<tr>";
            echo "<td>$post_id</td>";
 
            $query = "SELECT * FROM category WHERE category_id LIKE $post_category_id ";
            $select_category = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $categ_title =  $row['category_title'];
                $categ_id =  $row['category_id'];
            echo "<td>$categ_title</td>";
            }


            echo "<td>$post_title</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_status</td>";
            echo "<td>$post_date</td>";
            echo "<td><img width='100' height='auto' src='../images/$post_image' alt='images''></td>";
            echo "<td>$post_content</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<!-- DELETE POST  -->
<?php
  if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id LIKE {$the_post_id} ";
    $delete_query = mysqli_query($conection, $query);
    header("Location: view_all_post.php");
  }
?>