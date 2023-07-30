<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Image</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // GET ALL USERS 
        $query = 'SELECT * FROM users ';
        $select_users = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id =  $row['user_id'];
            $user_username =  $row['user_username'];
            $user_password =  $row['user_password'];
            $user_firstname =  $row['user_firstname'];
            $user_lastname =  $row['user_lastname'];
            $user_email =  $row['user_email'];
            $user_image =  $row['user_image'];
            $user_role =  $row['user_role'];
        
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td><img width='100' height='auto' src='../images/$user_image' alt='images''></td>";
            echo "<td>$user_username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            
            // REALTION BETWEEN POST AND COMMENT 
            // $query = "SELECT * FROM posts WHERE post_id LIKE $comment_post_id ";
            // $select_post_id_query = mysqli_query($conection, $query);
            // while ($row = mysqli_fetch_assoc($select_post_id_query)) {
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];
            //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }    
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";

            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<?php
// DELETE USER
  if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_query = mysqli_query($conection, $query);
    header("Location: users.php");
  }
//   CHANGE TO SUBSCRIBER
  if (isset($_GET['change_to_subscriber'])) {
    $the_user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $subscriber_change_query = mysqli_query($conection, $query);
    header("Location: users.php");
  }
  //    CHANGE TO ADMIN 
  if (isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $admin_change_query = mysqli_query($conection, $query);
    header("Location: users.php");
  }
?>