<?php

require 'includes/common.php';

//receiving, cleaning and validating info
$email = $_POST['email'];
$email = mysqli_real_escape_string($con, $email);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

$phone = $_POST['phone'];
$phone = mysqli_real_escape_string($con, $phone);
$regex_phone = "/^[6-9][0-9]{9}$/";

$password = $_POST['password'];
$password = mysqli_real_escape_string($con, $password);

$name = mysqli_real_escape_string($con, $_POST['name']);
$check_database_query = "SELECT id FROM users WHERE email='$email'";
$result = mysqli_query($con, $check_database_query);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Email already registered')</script>";
    echo ("<script>location.href='signup.php'</script>");
} elseif (is_numeric($name[0])) {
    echo "<script>alert('First character of name must be an alphabet')</script>";
    echo ("<script>location.href='signup.php'</script>");
} elseif (!preg_match($regex_email, $email)) {
    echo "<script>alert('Enter correct email')</script>";
    echo ("<script>location.href='signup.php'</script>");
} elseif (strlen($password) < 6) {
    echo "<script>alert('Enter a valid password')</script>";
    echo ("<script>location.href='signup.php'</script>");
} elseif (!preg_match($regex_phone, $phone)) {
    echo "<script>alert('Enter a valid phone number')</script>";
    echo ("<script>location.href='signup.php'</script>");
} else {
    //encrypting password and storing info
    $password = md5($password);
    $insert_database_query = "INSERT INTO users(name,email,password,phone) VALUES('$name','$email','$password','$phone')";
    mysqli_query($con, $insert_database_query) or die($con);
    $id = mysqli_insert_id($con);
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    header('location:home.php');
}
?>