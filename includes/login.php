<?php include "db.php"; ?>

<?php
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($conection, $username);
    $password = mysqli_real_escape_string($conection, $password);

    $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
    $select_user_query = mysqli_query($conection, $query);
    if (!$select_user_query) {
        die("QUERY FALIED" . mysqli_error($conection));
    }
    
    while ($row = mysqli_fetch_array($select_user_query)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
    }
    if ($username !== $user_id && $password !== $user_password) {
        header("Location: ../index.php");
    }
    else{
        header("Location: ../admin");
    }
  }
?>