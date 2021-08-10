<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!--company logo -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--styled the logo with custom colors -->
            <a href="index.php" class="navbar-brand"><b><span class="text-green">CT</span><span class="text-red">₹</span><span class="text-green">L Budget</span></b></a>
        </div>

        <!--links on the right side of the header -->
        <div class="collapse navbar-collapse" id="myNavBar">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['email'])) { ?>
                    <li><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About us</a></li>
                    <li><a href="setting.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <?php } else { ?>
                    <li><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About us</a></li>
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user" style="float: none"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>