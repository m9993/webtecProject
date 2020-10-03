<?php
ob_start();
include 'config.php';

$id = $_GET['ID'];

$q = "DELETE FROM users WHERE u_id ='$id' ";

$delete_query = mysqli_query($con, $q);

header('location:display.php');