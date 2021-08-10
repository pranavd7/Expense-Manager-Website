<?php

require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
//receiving, cleaning and encrypting password
$password = mysqli_real_escape_string($con, $_POST['newpassword1']);
$password2 = mysqli_real_escape_string($con, $_POST['newpassword2']);
$oldpassword = md5(mysqli_real_escape_string($con, $_POST['oldpassword']));

//checking database for old password
$user_id = $_SESSION['id'];
$check_database_query = "SELECT email,password FROM users WHERE id='$user_id'";
$result = mysqli_query($con, $check_database_query);
$user = mysqli_fetch_array($result);

if ($user['password'] == $oldpassword) {
    if (strlen($password) < 6) {
        echo "<script>alert('Enter a valid password')</script>";
        echo ("<script>location.href='setting.php'</script>");
    } elseif (strlen($password) != strlen($password2)) {
        echo "<script>alert('The passwords do not match')</script>";
        echo ("<script>location.href='setting.php'</script>");
    }
    $password = md5($password);
    $update_query = "UPDATE users SET password='$password' WHERE id='$user_id'";
    mysqli_query($con, $update_query);
    echo "<script>alert('Password updated')</script>";
    echo ("<script>location.href='index.php'</script>");
} else {
    echo "<script>alert('Incorrect password')</script>";
    echo ("<script>location.href='setting.php'</script>");
}