<?php

function user_online()
{
    if (isset($_GET['onlineusers'])) {
        global $conection;
        if (!$conection) {
            session_start();
            include("../includes/db.php");
            // keep user id who is in admin aria 
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
            //   GET USERS WITH THIS SESSION
            $query = "SELECT * FROM users_online WHERE user_session = '$session'";
            $send_query = mysqli_query($conection, $query);
            $count = mysqli_num_rows($send_query);
            if ($count == null) {
                mysqli_query($conection, "INSERT INTO users_online(user_session, user_time) VALUES('$session','$time')");
            } else {
                mysqli_query($conection, "UPDATE users_online SET user_time = '$time' WHERE user_session = '$session'");
            }
            $users_online_query = mysqli_query($conection, "SELECT * FROM users_online WHERE user_time > '$time_out'");
            // return $count_user = mysqli_num_rows($users_online_query);
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } //get request isset
}

user_online();

function confirmQuery($result)
{
    global $conection;
    if (!$result) {
        die("QUERY FALIED" . mysqli_error($conection));
    }
}

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
        $categ_title = $row['category_title'];
        $categ_id = $row['category_id'];
        echo "<tr>";
        echo " <td>{$categ_id}</td>";
        echo " <td>{$categ_title}</td>";
        echo " <td><a href='categories.php?delete={$categ_id}'>Delete</a></td>";
        echo " <td><a href='categories.php?edit={$categ_id}'>Edit</a></td>";
        echo "</tr>";
    }
}



?>