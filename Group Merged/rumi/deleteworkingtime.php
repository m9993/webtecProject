<?php
require_once 'index_model.php';
$indObj = new IndexModel();
$rs = $indObj->delete_workingtime($_GET['t_id']);
if ($rs == 1) {
    header('Location: admin_workingtime.php');
} else {
    echo "Can not delete";
}