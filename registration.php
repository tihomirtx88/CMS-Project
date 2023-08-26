<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {

        $username = mysqli_real_escape_string($conection, $username);
        $email = mysqli_real_escape_string($conection, $email);
        $password = mysqli_real_escape_string($conection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost => 12'));

        // $query = "SELECT user_randSalt FROM users ";
        // $select_randSalt_query = mysqli_query($conection, $query);

        // if (!$select_randSalt_query) {
        //     die("Query Falied" . mysqli_error($conection));
        // }

        // $row = mysqli_fetch_array($select_randSalt_query);
        // $salt = $row['user_randSalt'];
        // $password = crypt($password, $salt);
     

        $query = "INSERT INTO users (user_username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}','{$email}','{$password}','subscriber' )";
        $register_user_query = mysqli_query($conection, $query);
        if (!$register_user_query) {
            die("Query Falied" . mysqli_error($conection));
        }
        $message = "Your Registracion has been submitted";
    }else{
        $message = "Fields can't be empty";
    }
}else{
    $message = '';
}
?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text-center"><?php echo $message; ?></h5>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="register" id="btn-register" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <?php include "includes/footer.php"; ?>