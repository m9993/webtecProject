<?php
require_once 'index_model.php';
$indObj = new IndexModel();
$rs = $indObj->delete_payment($_GET['p_id']);
if ($rs == 1) {
    header('Location: admin_payment.php');
} else {
    echo "Can not delete";
}