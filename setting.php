<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
        <?php include 'includes/header.php'; ?>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h2>Change Password</h2>
                            </div>

                            <div class="panel-body">
                                <form method="POST" action="setting_script.php">
                                    <div class="form-group">
                                        <label for="oldpassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password1">New Password:</label>
                                        <input type="password" class="form-control" id="password1" name="newpassword1" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Confirm New Password:</label>
                                        <input type="password" class="form-control" id="password2" name="newpassword2" placeholder="Re-type New Password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>
