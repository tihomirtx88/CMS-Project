<?php
// GET VALUES FROM DATABASE 
if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
}
$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_user_query = mysqli_query($conection, $query);
while ($row = mysqli_fetch_assoc($select_user_query)) {
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}

// UPDATE USER
if (isset($_POST['update_user'])) {
    $user_username = escape($_POST['user_username']);
    $user_password = escape($_POST['user_password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_email = escape($_POST['user_email']);
    $user_role = escape($_POST['user_role']);

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id LIKE $the_user_id ";
        $select_image = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    // $query = "SELECT user_randSalt FROM users";
    // $select_randSalt_query = mysqli_query($conection, $query);


    // if (!$select_randSalt_query) {
    //     die("Query Falied" . mysqli_error($conection));
    // }

    // $row = mysqli_fetch_array($select_randSalt_query);
    // $salt = $row['user_randSalt'];
    // $HashedPassword = crypt($user_password, $salt);

    if (!empty($user_password)) {
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user = mysqli_query($conection, $query_password);
        confirmQuery($get_user);

        $row = mysqli_fetch_array($get_user);
        $db_user_password = $row['user_password'];

        if (!$db_user_password != $user_password) {
            $HashedPassword = password_hash($user_password, PASSWORD_BCRYPT, array('cost => 12'));
        }
        $query = "UPDATE users SET ";
        $query .= "user_username = '{$user_username}', ";
        $query .= "user_password = '{$HashedPassword}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= " WHERE user_id LIKE {$the_user_id} ";

        $update_user = mysqli_query($conection, $query);
        confirmQuery($update_user);
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="author">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" class="form-cotrol" type="text" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="status">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" class="form-cotrol" type="text" name="user_lastname">
    </div>

    <select name="user_role" id="">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php
        if ($user_role == 'admin') {
            echo "<option value='subscriber'>subscriber</option>";
        } else {
            echo "<option value='admin'>admin</option>";
        }
        ?>

    </select>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
        <input class="form-cotrol" type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="tags">Username</label>
        <input value="<?php echo $user_username; ?>" class="form-cotrol" type="text" name="user_username">
    </div>

    <div class="form-group">
        <label for="content">User Email</label>
        <input value="<?php echo $user_email; ?>" class="form-cotrol" type="email" name="user_email">
    </div>

    <div class="form-group">
        <label for="content">Password</label>
        <input autocomplete="off" value="" class="form-cotrol" type="password" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Edit User"></input>
    </div>
</form>