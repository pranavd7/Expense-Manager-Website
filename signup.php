<?php
require 'includes/common.php';
if (isset($_SESSION['email'])) {
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SignUp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <?php include 'includes/header.php'; ?>

        <div class="container">
            <div class="row content">
                <div class="col-xs-6 col-xs-offset-3 col-lg-4 col-lg-offset-4">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h2> Sign Up</h2>
                        </div>

                        <div class="panel-body">
                            <form method="POST" action="signup_script.php">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Valid Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password (Min. 6 characters)" pattern=".{6,}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Valid Phone Number (10 digit)" pattern=".{10,}" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="panel-footer">
                            Already registered?
                            <a href="login.php">Click here to Login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>
