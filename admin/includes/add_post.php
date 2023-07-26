
<?php
   if (isset($_POST['create_post'])) {
   
    $post_title =  $_POST['post_title'];
    $post_author =  $_POST['post_author'];
    $post_category_id =  $_POST['post_category_id'];
    $post_status =  $_POST['post_status'];

    $post_image =  $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags =  $_POST['post_tags'];
    $post_content =  $_POST['post_content'];

    $post_date =  date('d-m-y');
    $post_comment_count = 4;
    move_uploaded_file($post_image_temp, "../images/$post_image" );

    
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";

    $query .= 
    "VALUES({$post_category_id},'{$post_title}','{$post_author}',now() ,'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}' )";
    // $query .= 
    // "VALUES(1,'2','3',now(),'4','5','6','7',{$post_comments_count},'{$post_status}' )";

    $crate_post_query = mysqli_query($conection, $query);
    confirmQuery($crate_post_query);
   }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input class="form-cotrol" type="text" name="post_title">
    </div>

    <div class="form-group">
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

    <div class="form-group">
        <label for="author">Post Author</label>
        <input class="form-cotrol" type="text" name="post_author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input class="form-cotrol" type="text" name="post_status">
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
        <label for="content">Post Content</label>
        <textarea class="form-cotrol" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"></input>
    </div>
</form>