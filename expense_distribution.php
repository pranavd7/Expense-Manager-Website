<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$user_id = $_SESSION['id'];
$plan_id = $_SESSION['plan_id'];

//getting current plan data 
$check_plans_query = "SELECT * FROM plans WHERE id =$plan_id";
$result_plans = mysqli_query($con, $check_plans_query) or die($con);
$plan = mysqli_fetch_array($result_plans);

//getting members data from current plan (twice as 2 while loops are required to display data at different places)
$check_members_query = "SELECT * FROM members WHERE plan_id =$plan_id";
$result_members1 = mysqli_query($con, $check_members_query) or die($con);
$result_members2 = mysqli_query($con, $check_members_query) or die($con);

//getting sum of all expenses made in current plan
$sum_query = "SELECT SUM(amount) as total FROM expenses WHERE plan_id=$plan_id";
$result_sum = mysqli_query($con, $sum_query) or die($con);
$sum = mysqli_fetch_array($result_sum);
//calculating remaining amount from budget
$remaining = $plan['budget'] - $sum['total'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Expense Distribution</title>
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
            <div class="row ">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <?php echo $plan['title']; ?>
                            <span class="glyphicon glyphicon-user" style="float: right"> <?php echo $plan['members']; ?></span>
                        </div>

                        <div class="panel-body">
                            <b>Initial Budget</b> <div class="right"><?php echo '₹ ' . $plan['budget']; ?></div> <br><br>

                            <?php
                            //displaying total expense made by each individual member
                            while ($spender = mysqli_fetch_array($result_members1)) {
                                $person_id = $spender['id'];
                                $indiv_sum_query = "SELECT SUM(amount) as total FROM expenses WHERE plan_id=$plan_id and person_id=$person_id";
                                $result_sum_indiv = mysqli_query($con, $indiv_sum_query) or die($con);
                                $sum_expense = mysqli_fetch_array($result_sum_indiv);
                                ?>
                                <b><?php echo $spender['name']; ?></b>
                                <div class="right">
                                    <?php
                                    if ($sum_expense['total'] > 0)
                                        echo '₹ ' . $sum_expense['total'];
                                    else
                                        echo '₹ 0'
                                        ?>
                                </div><br><br>
                            <?php } ?>

                            <b>Total Amount Spent</b> <div class="right"><?php
                                if ($sum['total'])
                                    echo '₹ ' . $sum['total'];
                                else
                                    echo '₹ 0';
                                ?></div> <br><br>

                            <b>Remaining Amount</b> <div class="right">
                                <?php if ($remaining > 0) { ?> 
                                    <span class="text-green">
                                        <?php echo '₹ ' . $remaining; ?>
                                    </span><br><br>
                                <?php } elseif ($remaining < 0) { ?>
                                    <span class="text-red">
                                        <?php echo '₹ ' . abs($remaining); ?>
                                    </span><br><br> 
                                    <?php
                                } else
                                    echo '₹ 0';
                                ?></div> <br><br>

                            <b>Individual Shares</b> <div class="right"><?php echo '₹ ' . $sum['total'] / $plan['members']; ?></div> <br><br>

                            <?php
                            //displaying amount to be made/received by each member
                            while ($spender = mysqli_fetch_array($result_members2)) {
                                $person_id = $spender['id'];
                                $indiv_sum_query = "SELECT SUM(amount) as total FROM expenses WHERE plan_id=$plan_id and person_id=$person_id";
                                $result_sum_indiv = mysqli_query($con, $indiv_sum_query) or die($con);
                                $sum_expense = mysqli_fetch_array($result_sum_indiv);
                                ?>
                                <b><?php
                                    echo $spender['name'];
                                    $money = $sum['total'] / $plan['members'] - $sum_expense['total'];
                                    ?></b> 
                                <div class="right">
                                    <?php if ($money > 0) { ?>
                                        <span class="text-red">
                                            <?php echo 'Owes ₹ ' . $money; ?>
                                        </span>
                                    <?php } elseif ($money < 0) { ?>
                                        <span class="text-green">
                                            <?php echo 'Gets back ₹ ' . abs($money); ?>
                                        </span>
                                    <?php } else echo 'All settled up' ?>
                                </div><br><br>
                            <?php } ?>

                            <div class="text-center">
                                <a href="view_plan.php?id=<?php echo $plan_id ?>" class="btn btn-default button"><span class="glyphicon glyphicon-arrow-left"> Go Back</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>