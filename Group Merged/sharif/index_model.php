<?php
require_once('db.php');
class IndexModel extends DB 
{
	public function check_login($e, $p)
	{
		$q ="SELECT * FROM users WHERE u_email='".$e."' and u_password='".$p."'";
		$r = mysqli_query($this->con,$q);
		if($r==false)
		{
			return 0;
		}
		else
		{
			return $r;
		}
	}
	public function getpayemntsinfo($id)
	{
		$q = "Select * from payment where u_id='".$id."'";
		$r = mysqli_query($this->con,$q);
		return $r;
	}
	public function getsearchpayemntsinfo($id)
	{
		$q = "Select * from payment where p_id='".$id."'";
		$r = mysqli_query($this->con,$q);
		return $r;
	}
	public function getusersinfo($id)
	{
		$q = "Select * from users where u_id='".$id."'";
		$r = mysqli_query($this->con,$q);
		return $r;
	}	
	public function getallpayemntsinfo()
	{
		$q = "Select * from payment";
		$r = mysqli_query($this->con,$q);
		return $r;
	}	
	public function getallusersinfo()
	{
		$q = "Select * from users";
		$r = mysqli_query($this->con,$q);
		return $r;
	}
	public function getworkingtimeinfo($id)
	{
		$q = "Select * from workingtime where u_id='".$id."'";
		$r = mysqli_query($this->con,$q);
		return $r;
	}
	public function getsalaryinfo($id)
	{
		$q = "Select * from salary where u_id='".$id."'";
		$r = mysqli_query($this->con,$q);
		return $r;
	}	
	public function insert_payment($p_id,$u_id,$p_incomeTax,$p_hra,$p_ma,$p_others)
	{
		$q = "INSERT INTO `payment` (`p_id`, `u_id`, `p_incomeTax`, `p_hra`, `p_ma`, `p_others`) VALUES ('".$p_id."', '".$u_id."', '".$p_incomeTax."', '".$p_hra."', '".$p_ma."', '".$p_others."')";
		if(mysqli_query($this->con,$q))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function update_payment($p_id,$u_id,$p_incomeTax,$p_hra,$p_ma,$p_others)
	{
		$q="UPDATE `payment` SET `u_id` = '".$u_id."', `p_incomeTax` = ".$p_incomeTax.", `p_hra` = ".$p_hra.", `p_ma` = ".$p_ma.", `p_others` = ".$p_others." WHERE `payment`.`p_id` ='".$p_id."'";
		if(mysqli_query($this->con,$q))
		{		
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function delete_payment($p_id)
	{
		$q="DELETE from payment where `p_id`='".$p_id."'";
		if(mysqli_query($this->con,$q))
				{		
						return 1;
				}
				else
					{
						return 0;
					}
	}
}