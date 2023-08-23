<?php
// GET DYNAMIC ALL FIELD DATA 
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id LIKE $the_post_id ";
$select_posts_by_id = mysqli_query($conection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comments_count = $row['post_comment_count'];
    $post_status = $row['post_status'];
}
//   update post 
if (isset($_POST['update_post'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    // var_dump($post_status);

    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id LIKE $the_post_id ";
        $select_image = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_title}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= " WHERE post_id LIKE {$the_post_id} ";

    $update_post = mysqli_query($conection, $query);
    confirmQuery($update_post);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" class="form-cotrol" type="text" name="post_title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="post_category_id">
            <!-- GET ALL CATEGORY FOR SELECT ELEMENT  -->
            <?php
            $query = "SELECT * FROM category ";
            $select_category = mysqli_query($conection, $query);
            confirmQuery($select_category);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $categ_title_update = $row['category_title'];
                $categ_id_update = $row['category_id'];

                echo "<option value='{$categ_id_update}'>{$categ_title_update}</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" class="form-cotrol" type="text" name="post_author">
    </div>




    <div class="form-group">
        <select name="user_role" id="">
            <!-- GET ALL USERS FOR SELECT SINGLE USER  -->
            <?php
            $query = "SELECT * FROM users ";
            $select_user = mysqli_query($conection, $query);
            confirmQuery($select_category);
            while ($row = mysqli_fetch_assoc($select_user)) {
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];
               
                echo "<option value='{$user_id}'>{$user_role}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input value="<?php echo $post_status; ?>" class="form-cotrol" type="text" name="post_status">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input class="form-cotrol" type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" class="form-cotrol" type="text" name="post_tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-cotrol" name="post_content" id="" cols="30"
            rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post"></input>
    </div>
</form>