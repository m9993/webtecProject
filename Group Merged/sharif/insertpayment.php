<?php
require_once('index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->insert_payment($_POST['p_id'],$_POST['u_id'],$_POST['p_incomeTax'],$_POST['p_hra'],$_POST['p_ma'],$_POST['p_others']);
	if($rs==1)
	{
		header('Location: manager_payment.php');
	}
	else
	{
		header('Location: new_payment.php');
	}	
?>