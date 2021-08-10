<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create a new plan</title>
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
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h2> Create a new plan</h2>
                        </div>

                        <div class="panel-body">
                            <!--form to add a new plan -->
                            <form method="POST" action="plan_details.php">
                                <div class="form-group">
                                    <label for="budget">Initial Budget:</label>
                                    <input type="number" class="form-control" id="budget" name="budget" placeholder="Initial Budget (Ex. 4000)" min="1" required>
                                </div>
                                <div class="form-group">
                                    <label for="members">How many people you want to add in your group?:</label>
                                    <input type="number" class="form-control" id="members" name="members" placeholder="No. of people" min="1" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-block button">Next</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>