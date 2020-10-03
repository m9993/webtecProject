<?php
require_once('index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->check_login($_POST['email'],$_POST['password']);
	while($d= mysqli_fetch_assoc($rs))
	{
		$_SESSION["u_id"] = $d['u_id'];
		$_SESSION["u_role"] = $d['u_role'];
		if($_SESSION["u_role"]== "employee")
		{
			header('Location: employee.php');
		}
		else if($_SESSION["u_role"]== "manager")
		{
			header('Location: manager.php');
		}	
	}	
?>