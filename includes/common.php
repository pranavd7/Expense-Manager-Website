<?php

$con = mysqli_connect("localhost", "root", "", "control_budget") or die(mysqli_error($con));
if (!isset($_SESSION)) {
    session_start();
}
?>