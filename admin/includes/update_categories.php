<form action="" method="post">
    <div class="form-group">
        <label for="category-title">Edit Category</label>
        <?php
        if (isset($_GET['edit'])) {
            $category_id_update = $_GET['edit'];
            $query = "SELECT * FROM category WHERE category_id LIKE $category_id_update ";
            $select_category_update = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($select_category_update)) {
                $categ_title_update =  $row['category_title'];
                $categ_id_update =  $row['category_id'];
        ?>
                <input value="<?php if (isset($categ_title_update)) {
                                    echo $categ_title_update;
                                } ?>" class="form-control" type="text" name="category-title">
        <?php   }
        }
        ?>
        <!-- UPDATE CATEGORY -->
        <?php
        if (isset($_POST['update_category'])) {
            $category_title_update = $_POST['category-title'];
            // $category_id_for_update = $_POST['category_id'];
            $query = "UPDATE category SET category_title = '{$category_title_update}' WHERE category_id = {$categ_id_update} ";
            $update_query = mysqli_query($conection, $query);
            header("Location: categories.php");
            if (!$update_query) {
                die('query falied' . mysqli_error($conection));
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>