<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$budget = $_POST['budget'];
$members = $_POST['members'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Plan Details</title>
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

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!--more detailed form to add a new plan -->
                            <form method="POST" action="create_plan_script.php">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title (Ex. Trip to Goa)" required>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-6">
                                        <label for="from">From</label>
                                        <input type="date" class="form-control" id="from" name="fromdate" required>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="to">To</label>
                                        <input type="date" class="form-control" id="to" name="todate" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-8">
                                        <label for="budget">Initial Budget:</label>
                                        <input type="number" class="form-control" id="budget" name="budget" value="<?php echo $budget ?>" readonly>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="members">No. of people:</label>                             
                                        <input type="number" class="form-control" id="members" name="members" value="<?php echo $members ?>" readonly>
                                    </div>
                                </div>
                                <?php
                                for ($i = 1; $i <= $members; $i++) {
                                    ?>
                                    <div class="form-group">
                                        <label for="person<?php echo $i ?>">Person <?php echo $i ?></label>
                                        <input type="text" class="form-control" id="person<?php echo $i ?>" name="person<?php echo $i ?>" placeholder="Person <?php echo $i ?> Name" required>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-block button">Submit</button>
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