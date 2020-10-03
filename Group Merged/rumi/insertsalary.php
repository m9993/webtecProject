<?php
require_once 'index_model.php';
$indObj = new IndexModel();
$rs = $indObj->insert_salary($_POST['s_id'], $_POST['u_id'], $_POST['s_amount']);
if ($rs == 1) {
    header('Location: salary.php');
} else {
    header("Location: new_salary.php");
}