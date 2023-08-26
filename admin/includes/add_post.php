
<?php
   if (isset($_POST['create_post'])) {
   
    $post_title =  escape($_POST['post_title']);
    $post_user =  escape($_POST['post_user']);
    $post_category_id =  escape($_POST['post_category_id']);
    $post_status =  escape($_POST['post_status']);

    $post_image =  $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags =  escape($_POST['post_tags']);
    $post_content =  escape($_POST['post_content']);

    $post_date =  date('d-m-y');
    $post_comment_count = 0;
    move_uploaded_file($post_image_temp, "../images/$post_image" );

    
    $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";

    $query .= 
    "VALUES({$post_category_id},'{$post_title}','{$post_user}',now() ,'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}' )";

    $crate_post_query = mysqli_query($conection, $query);
    confirmQuery($crate_post_query);
    echo "<p class='bg-success'>Post Created: " . " " . "<a href='posts.php'>View Posts</a></p>";
   }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input class="form-cotrol" type="text" name="post_title">
    </div>

    <div class="form-group">
    <label for="category">Category</label>
       <select name="post_category_id" id="post_category_id">
        <!-- GET ALL CATEGORY FOR SELECT ELEMENT  -->
          <?php 
             $query = "SELECT * FROM category ";
             $select_category = mysqli_query($conection, $query);
             confirmQuery($select_category);
             while ($row = mysqli_fetch_assoc($select_category)) {
                 $categ_title_update =  $row['category_title'];
                 $categ_id_update =  $row['category_id'];

                 echo "<option value='{$categ_id_update}'>{$categ_title_update}</option>";
             }
          ?>
       </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input class="form-cotrol" type="text" name="post_author">
    </div> -->

    <div class="form-group">
    <label for="users">Users</label>
       <select name="post_user" id="post_user_id">
        <!-- GET ALL CATEGORY FOR SELECT ELEMENT  -->
          <?php 
             $users_query = "SELECT * FROM users ";
             $select_users = mysqli_query($conection, $users_query);
             confirmQuery($select_users);
             while ($row = mysqli_fetch_assoc($select_users)) {
                 $username =  $row['user_username'];
                 $user_id =  $row['user_id'];

                 echo "<option value='{$username}'>{$username}</option>";
             }
          ?>
       </select>
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input class="form-cotrol" type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input class="form-cotrol" type="text" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-cotrol" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"></input>
    </div>
</form>