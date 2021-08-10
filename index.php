<?php
require "includes/common.php";
if (isset($_SESSION['email'])) {
    header('location:home.php');
}
?>

<!DOCTYPE html>
<!--
Author: Pranav Deshmukh
Contact: pranavd721@gmail.com
-->

<html>
    <head>
        <title>CT₹L Budget</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
        <?php include 'includes/header.php'; ?>
        
        <!--background and content -->
        <div id="banner-image">
            <div class="container">
                <div id="banner-content">
                    <h1>We help you control your Budget.</h1>
                    <a href="signup.php" class="btn btn-primary btn-lg">Start Today</a>
                </div>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
