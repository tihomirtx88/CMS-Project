

<?php

function insert_categories()
{
    global $conection;
    if (isset($_POST['submit'])) {


        $category_title = $_POST['category-title'];
        if ($category_title == "" || empty($category_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO category(category_title) ";
            $query .= "VALUE('{$category_title}') ";
            $crate_category_query = mysqli_query($conection, $query);

            if (!$crate_category_query) {
                die('query falied' . mysqli_error_list($conection));
            }
            header("Location: categories.php");
        }
    }
}

function delete_categories()
{
    global $conection;
    // DELETE CATEGORY QUERY
    if (isset($_GET['delete'])) {
        $category_id_for_delete = $_GET['delete'];
        $query = "DELETE FROM category WHERE category_id LIKE {$category_id_for_delete} ";
        $delete_query = mysqli_query($conection, $query);
        header("Location: categories.php");
        // refresh the page
    }
}
function find_all_categories()
{
    global $conection;
    $query = 'SELECT * FROM category ';
    $select_category = mysqli_query($conection, $query);
    while ($row = mysqli_fetch_assoc($select_category)) {
        $categ_title =  $row['category_title'];
        $categ_id =  $row['category_id'];
        echo "<tr>";
        echo " <td>{$categ_id}</td>";
        echo " <td>{$categ_title}</td>";
        echo " <td><a href='categories.php?delete={$categ_id}'>Delete</a></td>";
        echo " <td><a href='categories.php?edit={$categ_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

?>