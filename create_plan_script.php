<?php

require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}

//receiving and cleaning the data
$title = mysqli_real_escape_string($con, $_POST['title']);
$from = $_POST['fromdate'];
$to = $_POST['todate'];
$budget = $_POST['budget'];
$num_members = $_POST['members'];

$user_id = $_SESSION['id'];
$insert_query1 = "INSERT INTO plans(user_id,title,budget,members,start_date,end_date) VALUES('$user_id','$title','$budget','$num_members','$from','$to')";
mysqli_query($con, $insert_query1);
$id = mysqli_insert_id($con);

for ($i = 1; $i <= $num_members; $i++) {
    $mem = mysqli_real_escape_string($con, $_POST["person$i"]);
    $insert_query2 = "INSERT INTO members(plan_id,name) VALUES('$id','$mem')";
    mysqli_query($con, $insert_query2);
}

echo ("<script>location.href='home.php'</script>");
?>