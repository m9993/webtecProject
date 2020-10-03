<?php
require_once 'index_model.php';
$indObj = new IndexModel();
$rs = $indObj->update_salary($_POST['s_id'], $_POST['u_id'], $_POST['s_amount']);
if ($rs == 1) {
    header('Location: salary.php');
} else {
    header("Location: editsalary.php?s_id=" . $_POST["s_id"] . "&u_id=" . $_POST["u_id"] . "&s_amount=" . $_POST["s_amount"]);
}