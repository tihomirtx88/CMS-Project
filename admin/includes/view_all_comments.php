<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Aprove</th>
            <th>UnAprove</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // GET ALL POSTS
        $query = 'SELECT * FROM comments ';
        $select_comments = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id =  $row['comment_id'];
            $comment_post_id =  $row['comment_post_id'];
            $comment_author =  $row['comment_author'];
            $comment_email =  $row['comment_email'];
            $comment_status =  $row['comment_status'];
            $comment_date =  $row['comment_date'];
            $comment_content =  $row['comment_content'];
        
            echo "<tr>";
            echo "<td>$comment_id</td>";
 
            // $query = "SELECT * FROM category WHERE category_id LIKE $post_category_id ";
            // $select_category = mysqli_query($conection, $query);
            // while ($row = mysqli_fetch_assoc($select_category)) {
            //     $categ_title =  $row['category_title'];
            //     $categ_id =  $row['category_id'];
            // echo "<td>$categ_title</td>";
            // }

            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            // REALTION BETWEEN POST AND COMMENT 
            $query = "SELECT * FROM posts WHERE post_id LIKE $comment_post_id ";
            $select_post_id_query = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }
            echo "<td>$comment_date</td>";

            
            echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Approve</a></td>";
            echo "<td><a href='posts.php?delete={$comment_id}'>UnApprove</a></td>";

            echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Edit</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<!-- DELETE POST  -->
<?php
  if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id LIKE {$the_comment_id} ";
    $delete_query = mysqli_query($conection, $query);
    header("Location: comments.php");
  }
?>