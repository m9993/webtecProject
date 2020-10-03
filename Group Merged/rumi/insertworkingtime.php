<?php
require_once 'index_model.php';
$indObj = new IndexModel();
$rs = $indObj->insert_workingtime($_POST['t_id'], $_POST['u_id'], $_POST['t_hour']);
if ($rs == 1) {
    header('Location: admin_workingtime.php');
} else {
    header("Location: new_workingtime.php");
}