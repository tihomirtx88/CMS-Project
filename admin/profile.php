<?php
include "includes/admin_header.php";
include "../includes/db.php";
?>
<?php
if (isset($_GET['update_profile'])) {
    $the_user_id = $_GET['update_profile'];
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
    $select_user_profile = mysqli_query($conection, $query);
    while ($row = mysqli_fetch_array($select_user_profile)) {
        $user_id =  $row['user_id'];
        $user_username =  $row['user_username'];
        $user_password =  $row['user_password'];
        $user_firstname =  $row['user_firstname'];
        $user_lastname =  $row['user_lastname'];
        $user_email =  $row['user_email'];
        $user_image =  $row['user_image'];
        $user_role =  $row['user_role'];
    }
}
?>
<?php
  if (isset($_POST['update_profile'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
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
        $query .= " WHERE user_username = {$username} ";

        $update_user = mysqli_query($conection, $query);
        confirmQuery($update_user);
    }
}
?>
<div id="wrapper">

    <?php
    include "includes/admin_navigation.php";
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>Author</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="author">Firstname</label>
                            <input value="<?php echo $user_firstname; ?>" class="form-cotrol" type="text"
                                name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="status">Lastname</label>
                            <input value="<?php echo $user_lastname; ?>" class="form-cotrol" type="text"
                                name="user_lastname">
                        </div>

                        <div class="form-group">
                            <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
                            <input class="form-cotrol" type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <label for="tags">Username</label>
                            <input value="<?php echo $user_username; ?>" class="form-cotrol" type="text"
                                name="user_username">
                        </div>

                        <div class="form-group">
                            <label for="content">User Email</label>
                            <input value="<?php echo $user_email; ?>" class="form-cotrol" type="email"
                                name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="content">Password</label>
                            <input autocomplete="off" value="" class="form-cotrol" type="password"
                                name="user_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile"></input>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php
    include "includes/admin_footer.php";
    ?>