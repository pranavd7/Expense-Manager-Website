<?php
require 'includes/common.php';
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$user_id = $_SESSION['id'];
//using GET method to get plan id to help check database
$plan_id = $_GET['id'];
$_SESSION['plan_id'] = $plan_id;

//getting current plan data 
$check_plans_query = "SELECT * FROM plans WHERE id =$plan_id";
$result_plan = mysqli_query($con, $check_plans_query) or die($con);
$plan = mysqli_fetch_array($result_plan);

//getting members data from current plan
$check_members_query = "SELECT id,name FROM members WHERE plan_id =$plan_id";
$result_members = mysqli_query($con, $check_members_query) or die($con);

//getting expenses data from current plan
$check_expenses_query = "SELECT * FROM expenses WHERE plan_id =$plan_id";
$result_expenses = mysqli_query($con, $check_expenses_query) or die($con);

//getting sum of all expenses made in current plan
$sum_query = "SELECT SUM(amount) as total FROM expenses WHERE plan_id=$plan_id";
$result_sum = mysqli_query($con, $sum_query) or die($con);
$sum = mysqli_fetch_array($result_sum);
$remaining = $plan['budget'] - $sum['total'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Plan</title>
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

                <!--first row to display plan details and 'expense distribution' button -->
                <div class="row ">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php echo $plan['title']; ?>
                                <span class="glyphicon glyphicon-user" style="float: right"> <?php echo $plan['members']; ?></span>
                            </div>
                            <div class="panel-body">
                                <b>Budget</b> <div class="right"><?php echo '₹ ' . $plan['budget']; ?></div> <br><br>
                                <b>Remaining Amount</b> 
                                <div class="right">
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
                                    ?>
                                </div> <br><br>
                                <b>Date</b> <div class="right"><?php echo date('jS M ', strtotime($plan['start_date'])); ?>- <?php echo date('jS M Y', strtotime($plan['end_date'])); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-2">
                        <div id="v-center"><a href="expense_distribution.php" class="btn btn-lg btn-default button">Expense Distribution</a></div>
                    </div>
                </div>

                <!--second row to display expenses details and 'add expense' form -->
                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        //displaying all expenses made
                        while ($expense = mysqli_fetch_array($result_expenses)) {
                            //getting member data who has made current expense
                            $person_id = $expense['person_id'];
                            $check_database_query = "SELECT name FROM members WHERE id =$person_id";
                            $result = mysqli_query($con, $check_database_query);
                            $spender = mysqli_fetch_array($result);
                            ?>
                            <div class="col-xs-12 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <?php echo $expense['title']; ?>
                                    </div>
                                    <div class="panel-body">
                                        <b>Amount</b> <div class="right"><?php echo '₹ ' . $expense['amount']; ?></div> <br><br>
                                        <b>Paid by</b> <div class="right"><?php echo $spender['name']; ?></div> <br><br>

                                        <!--using date('jS M Y', ) to convert the date to the format 1st/2nd/3rd/.. Feb 2021 -->
                                        <b>Date</b> <div class="right"><?php echo date('jS M Y', strtotime($expense['date'])); ?></div> <br><br>
                                        <?php if ($expense['bill_file']) { ?>
                                            <div class="h-center"><a class="text-center" href="img/<?php echo $expense['bill_file']; ?>" >Show bill</a></div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="h-center"><a style="text-decoration: none"> You don't have bill</a></div><?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-xs-5 col-xs-offset-1 col-md-4 col-md-offset-2">
                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h4>Add New Expense</h4>
                            </div>

                            <div class="panel-body">
                                <!--'add expense' form -->
                                <form method="POST" action="create_expense_script.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Expense Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" class="form-control" id="date" name="date" min="<?php echo $plan['start_date'] ?>" max="<?php echo $plan['end_date'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="expense">Amount Spent:</label>
                                        <input type="number" class="form-control" id="expense" name="expense" placeholder="Amount Spent" min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="spender">
                                            <option value="none" selected disabled hidden>Choose</option> 
                                            <?php
                                            //adding all members of the plan to the possible options
                                            while ($spender = mysqli_fetch_array($result_members)) {
                                                $p_id = $spender['id'];
                                                ?>
                                                <option value="<?php echo $p_id ?>"> <?php echo $spender['name'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type = "file" class="form-control" name="bill">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btn-block button">Add</button>
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