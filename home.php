<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
        <?php include 'includes/header.php'; ?>

        <div class="container content">
            <?php
            //checking database for any existing plans
            $check_database_query = "SELECT * FROM plans WHERE user_id ='$user_id'";
            $result = mysqli_query($con, $check_database_query) or die(mysqli_error($result));

            if (mysqli_num_rows($result) == 0) {
                ?>
                <h3>You do not have any active plans</h3>
                <div class="row" >
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel" id="plan">
                            <a href="create_plan.php"><span class="glyphicon glyphicon-plus-sign"></span> Create new plan</a>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="container">
                    <h3>Your Plans</h3>
                    <?php
                    //displaying all existing plans
                    while ($plan = mysqli_fetch_array($result)) {
                        $id = $plan['id'];
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <?php echo $plan['title']; ?>
                                    <span class="glyphicon glyphicon-user"> <?php echo $plan['members']; ?></span>
                                </div>
                                <div class="panel-body">
                                    <b>Budget</b> <div class="right"><?php echo '₹ ' . $plan['budget']; ?></div> <br><br>
                                    <!--using date('jS M Y', ) to convert the date to the format 1st/2nd/3rd/.. Feb 2021 -->
                                    <b>Date</b> <div class="right"><?php echo date('jS M ', strtotime($plan['start_date'])); ?>- <?php echo date('jS M Y', strtotime($plan['end_date'])); ?></div> <br><br>
                                    <!--sending plan id using url -->
                                    <a href="view_plan.php?id=<?php echo $id ?>" class="btn btn-default btn-block button">View Plan</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class = "newplan">
                    <a href = "create_plan.php"><span class = "glyphicon glyphicon-plus-sign"></span></a>
                </div>
            <?php } ?>

        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>