<?php
ob_start();
$hostname = 'localhost';
$username = 'root';
$userpass = '';
$dbname = 'payrolldb';

$con = mysqli_connect($hostname, $username, $userpass, $dbname);