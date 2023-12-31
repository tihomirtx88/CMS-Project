
<?php
include("delete_modal.php");
  if (isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $postValueId ){
        // Pick value from select 
       $bulk_options = $_POST['bulk_options'];
       switch ($bulk_options) {
        case 'published':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
            $update_to_published_status = mysqli_query($conection, $query);
            confirmQuery($update_to_published_status);
            break;
         case 'draft':
             $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
             $update_to_draft_status = mysqli_query($conection, $query);
             confirmQuery($update_to_draft_status);
             break;
        case 'delete':
             $query = "DELETE FROM posts WHERE post_id = '{$postValueId}' ";
             $update_to_delete_status = mysqli_query($conection, $query);
             confirmQuery($update_to_delete_status);
              break;
        case 'clone':
             $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
             $clone_query_status = mysqli_query($conection, $query);
             confirmQuery($clone_query_status);

             while ($row = mysqli_fetch_array($clone_query_status)) {
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $post_comment_count= $row['post_comment_count'];
             }

             $query = "INSERT INTO posts(post_title, post_category_id, post_date, post_author, post_status, post_image, post_tags, post_content, post_comment_count) ";
             $query .= "VALUES('{$post_title}',{$post_category_id},'{$post_date}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}',{$post_comment_count}) ";
             $copy_query = mysqli_query($conection, $query);
             confirmQuery($copy_query);
             break;
        default:
            # code...
            break;
       }
    }
  } 
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
           <select class="form-control" name="bulk_options" id="">
              <option value="">Select options</option>
              <option value="published">Publish</option>
              <option value="draft">Draft</option>
              <option value="delete">Delete</option>
              <option value="clone">Clone</option>
           </select>
        </div>
        <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Aply">
           <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Post Category</th>
                <th>Title</th>
                <th>User</th>
                <th>Status</th>
                <th>Date</th>
                <th>Image</th>
                <th>Comments</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>View Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // GET ALL POSTS
            $query = 'SELECT * FROM posts ORDER BY post_id DESC ';
            $select_posts = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id =  $row['post_id'];
                $post_category_id =  $row['post_category_id'];
                $post_title =  $row['post_title'];
                $post_author =  $row['post_author'];
                $post_user =  $row['post_user'];
                $post_date =  $row['post_date'];
                $post_image =  $row['post_image'];
                $post_content =  $row['post_content'];
                $post_date = $row['post_date'];
                $post_tags =  $row['post_tags'];
                $post_comment_count =  $row['post_comment_count'];
                $post_status =  $row['post_status'];
                $post_views_count =  $row['post_views_count'];

                echo "<tr>";
                ?>
                   <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                <?php
                echo "<td>$post_id</td>";
                $query = "SELECT * FROM category WHERE category_id LIKE $post_category_id ";
                $select_category = mysqli_query($conection, $query);

                while ($row = mysqli_fetch_assoc($select_category)) {
                    $categ_title =  $row['category_title'];
                    $categ_id =  $row['category_id'];
                    echo "<td>$categ_title</td>";
                }

                // Vizualizate
                echo "<td>$post_title</td>";
                
                if (!empty($post_author)) {
                    echo "<td>$post_author</td>";
                }else if(!empty($post_user)){
                    echo "<td>$post_user</td>";
                }

                echo "<td>$post_status</td>";
                echo "<td>$post_date</td>";
                echo "<td><img width='100' height='auto' src='../images/$post_image' alt='images''></td>";
                echo "<td>$post_content</td>";
                echo "<td>$post_tags</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_query_comment_count = mysqli_query($conection, $query);
                $count_comments = mysqli_num_rows($send_query_comment_count);

                
                echo "<td>$count_comments</td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                // echo "<td><a onClick=\"javascript: return confirm('are you sure you want to delete this post?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</form>
<!-- DELETE POST  -->
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id LIKE {$the_post_id} ";
    $delete_query = mysqli_query($conection, $query);
    header("Location: posts.php");
}

// RESET VIEWS COUNT
if (isset($_GET['reset'])) {
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($conection, $the_post_id) . " " ;
    $reset_query = mysqli_query($conection, $query);
    header("Location: posts.php");
}
?>

<script>
  $(document).ready(function(){
     $(".delete_link").on('click', function(){
       var id = $(this).attr("rel");
       var delete_url = "posts.php?delete="+ id +" ";
       $(".modal_delete_link").attr("href", delete_url);
       $("#myModal").modal('show');
     });
  });

</script>