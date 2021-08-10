<?php

require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}

//function to get image extension
function GetImageExtension($imagetype) {
    if (empty($imagetype))
        return false;
    switch ($imagetype) {
        case 'image/bmp' : return '.bmp';
        case 'image/gif' : return '.gif';
        case 'image/jpeg' : return '.jpg';
        case 'image/png' : return '.png';
        default : return false;
    }
}

//receiving and cleaning the data
$title = mysqli_escape_string($con, $_POST['title']);
$date = $_POST['date'];
$plan = $_POST['expense'];
$person_id = $_POST['spender'];
$plan_id = $_SESSION['plan_id'];

if (!empty($_FILES["bill"]["name"])) {
    $file_name = $_FILES["bill"]["name"];
    $temp_name = $_FILES["bill"]["tmp_name"];
    $imgtype = $_FILES["bill"]["type"];
    $ext = GetImageExtension($imgtype);
    $imagename = date("d-m-Y") . "-" . time() . $ext;
    $target_path = "img/" . $imagename;
    if (move_uploaded_file($temp_name, $target_path)) {
        echo "<script>alert('moved image')</script>";
        $insert_query = "INSERT INTO expenses(title,date,amount,plan_id,person_id,bill_file) VALUES('$title','$date','$plan','$plan_id','$person_id','$imagename')";
    }
} else {
    echo "<script>alert('no image')</script>";
    $insert_query = "INSERT INTO expenses(title,date,amount,plan_id,person_id) VALUES('$title','$date','$plan','$plan_id','$person_id')";
}

mysqli_query($con, $insert_query) or die(mysqli_error($con));
header("location:view_plan.php?id=$plan_id");
?>