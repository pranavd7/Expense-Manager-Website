<?php

require 'includes/common.php';

//receiving, cleaning and encrypting credentials if neccessary
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = md5(mysqli_real_escape_string($con, $_POST['password']));

$check_database_query = "SELECT id,email FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $check_database_query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Enter correct email/ password');</script>";
    echo "<script>location.href='login.php'</script>";
} else {
    $user = mysqli_fetch_array($result);
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    echo "<script>location.href='home.php'</script>";
}
?>