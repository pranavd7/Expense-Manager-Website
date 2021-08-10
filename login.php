<?php
require 'includes/common.php';
if (isset($_SESSION['email'])) {
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
                            <h2>Login</h2>
                        </div>

                        <div class="panel-body">
                            <form method= "POST" action="login_script.php">
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button typre="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                            </form>
                        </div>

                        <div class="panel-footer">
                            Don't have an account?
                            <a href="signup.php">Click here to Sign Up</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>
