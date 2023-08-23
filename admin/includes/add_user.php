<?php
if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    // $user_randSalt = 'sadsadasd';

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost => 12'));
    $query = "INSERT INTO users(user_username,user_password,user_firstname,user_lastname,user_email,user_image,user_role,user_randSalt) ";

    $query .= "VALUES('{$user_username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}','{$user_randSalt}' )";

    $crate_user_query = mysqli_query($conection, $query);
    confirmQuery($crate_user_query);
    echo "<p class='bg-success'>User Created: " . " " . "<a href='users.php'>View Users</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="author">Firstname</label>
        <input class="form-cotrol" type="text" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="status">Lastname</label>
        <input class="form-cotrol" type="text" name="user_lastname">
    </div>

   <select name="user_role" id="">
      <option value="subscriber">Select Options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">subscriber</option>
   </select>


    <div class="form-group">
        <label for="image">User Image</label>
        <input class="form-cotrol" type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="tags">Username</label>
        <input class="form-cotrol" type="text" name="user_username">
    </div>

    <div class="form-group">
        <label for="content">User Email</label>
        <input class="form-cotrol" type="email" name="user_email">
    </div>

    <div class="form-group">
        <label for="content">Password</label>
        <input class="form-cotrol" type="password" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User"></input>
    </div>
</form>