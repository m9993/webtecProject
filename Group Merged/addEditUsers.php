<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
session_start();
if(!isset($_SESSION['no_user'])){
	if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])){
	  header("Location: index.php");
	}
}
if (isset($_SESSION['no_user'])) {
		$pageName="Add Users";
}

$da=new DataAccess();

date_default_timezone_set("Asia/Dhaka");
    $time= date("h:i:s a");
    $date= date("d-M-Y");

// $pageName="";




if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET["editId"])) {
		$pageName="Edit Users";
		$_SESSION['editId']=$_GET['editId'];
		$query="select * from users where u_id='".$_GET["editId"]."'";
		$rows=$da->ExecuteQuery($query);
		$arr=$da->ConvertRowsToArray($rows);
	}
}



if ($_SERVER['REQUEST_METHOD']=="POST") {
	if (isset($_POST["addUsers"])) {
		$pageName="Add Users";
	}
}




if ($_SERVER['REQUEST_METHOD']=="POST") {
	if (isset($_POST["done"])) {
		$fieldsArr=["u_id","u_password","u_role","u_name","u_phone","u_email","u_dob","u_address"];
		if (!validateFieldName($fieldsArr, $_POST)) {
			$_SESSION['msg']="Field names are not matching!";
			$_SESSION['msg_type']="danger";
		}
		else{
			if (!ValidateString($_POST['u_id']) || !ValidateString($_POST['u_password']) || !ValidateString($_POST['u_role']) || !ValidateString($_POST['u_name']) || !ValidateString($_POST['u_phone']) || !ValidateString($_POST['u_email']) || !ValidateString($_POST['u_dob']) || !ValidateString($_POST['u_address'])) {

				$_SESSION['msg']="Fields can not be empty!";
				$_SESSION['msg_type']="danger";		
			}
			else{
				$_POST['u_id']=ValidateString($_POST['u_id']);
				//$_POST['u_password']=ValidateString($_POST['u_password']);
				$_POST['u_password']=password_hash(ValidateString($_POST['u_password']), PASSWORD_DEFAULT);


				$_POST['u_role']=ValidateString($_POST['u_role']);
				$_POST['u_name']=ValidateString($_POST['u_name']);
				$_POST['u_phone']=ValidateString($_POST['u_phone']);
				$_POST['u_email']=ValidateString($_POST['u_email']);
				$_POST['u_dob']=ValidateString($_POST['u_dob']);
				$_POST['u_address']=ValidateString($_POST['u_address']);

				if (!validateEmail($_POST['u_email'])) {
					$_SESSION['msg']="Please enter a valid email!";
					$_SESSION['msg_type']="danger";
				}
				else{
					if(isset($_SESSION['editId'])){
						$query="update users set u_id='".$_POST['u_id']."',u_password='".$_POST['u_password']."',u_role='".$_POST['u_role']."',u_name='".$_POST['u_name']."',u_phone='".$_POST['u_phone']."',u_email='".$_POST['u_email']."',u_dob='".$_POST['u_dob']."',u_address='".$_POST['u_address']."' where u_id='".$_SESSION['editId']."'";
						if($da->ExecuteQuery($query)){
							$_SESSION['msg']="'".$_SESSION['editId']."' updated successfully!";
							$_SESSION['msg_type']="success";
							unset($_SESSION['editId']);
							$_SESSION['idFieldVisible']="off";
						}
						else{
							$_SESSION['msg']="'".$_SESSION['editId']."' update failed!";
							$_SESSION['msg_type']="danger";	
							unset($_SESSION['editId']);
						}
					}
					else{
						$query="INSERT INTO users (u_id, u_password, u_role, u_name, u_phone, u_email, u_dob, u_address) VALUES ('".$_POST['u_id']."','".$_POST['u_password']."','".$_POST['u_role']."','".$_POST['u_name']."','".$_POST['u_phone']."','".$_POST['u_email']."','".$_POST['u_dob']."','".$_POST['u_address']."')";
						if($da->ExecuteQuery($query)){
							$_SESSION['msg']="'".$_POST['u_id']."' inserted successfully!";
							$_SESSION['msg_type']="success";
							if(isset($_SESSION['no_user'])){
								header("Location: logout.php");
							}
						}
						else{
							$_SESSION['msg']="'".$_POST['u_id']."' insertion failed!";
							$_SESSION['msg_type']="danger";	
						}
					}
				}
			}

		}
	}
}



?>







<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/addEditUsers.css">


    <title><?php if(isset($pageName)){echo $pageName;} ?></title>
  </head>
  <body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" id="nav">
        <div class="container">
            <a class="navbar-brand text-white" href="adminHome.php"><i id="logo"></i><b>Payroll System</b></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                         <i class="fa fa-user"></i> <?php echo $_SESSION['u_name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
                          <a class="dropdown-item" href="changePassword.php"><i class="fas fa-exchange-alt"></i>Change Password</a>
                          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </li>



                    <li class="nav-item ">
                        <a class="nav-link " href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $time; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date; ?></a>
                    </li>
                   
                </ul>


            </div>
        </div>
        </nav>
    </header>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="adminHome.php">Home</a></li>
         <li class="breadcrumb-item"><a href="users.php">Users</a></li>
         <li class="breadcrumb-item active" aria-current="page"><?php if(isset($pageName)){echo $pageName;} ?></li>
         </ol>
    </nav>


    <?php if (isset($_SESSION["msg"])) { ?>
      <div class="my-0 alert alert-<?=$_SESSION['msg_type']?>" role="alert">
          <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            unset($_SESSION['msg_type']);
          ?>
      </div>

      <?php } ?>




<div class="container col-md-8 mt-sm-5">
	<form action="addEditUsers.php" method="POST">

  		<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">ID</label>
	    	<div class="col-sm-10">
	    		<input type="text" name="u_id" class="form-control" placeholder="ID" value="<?php 
	    		if(isset($_SESSION['editId'])){
	    			echo $_SESSION['editId']; 
	    		}
	    		else{
	    			echo "u-".$da->AutoGeneratedId("users","u_id");
	    		}
	    		?>" >
	    	</div>
	  	</div>

	 	<div class="form-group row">
	    	<label class="col-sm-2 col-form-label">Password</label>
	    	<div class="col-sm-10">
	      		<input type="password" name="u_password" class="form-control" placeholder="password">
	    	</div>
	  	</div>

	  	<fieldset class="form-group">
	    <div class="row">
	    <legend class="col-form-label col-sm-2 pt-0">Role</legend>
	    <div class="col-sm-10">

	    <div class="form-check">
	        <input class="form-check-input" type="radio" name="u_role" id="gridRadios1" value="admin" <?php 
		        if(isset($arr['u_role'])) {
		        	if($arr['u_role']=="admin") {echo "checked"; }
		        } ?> >
	        <label class="form-check-label">Admin</label>
	    </div>

	    <div class="form-check">
	        <input class="form-check-input" type="radio" name="u_role" id="gridRadios2" value="manager" <?php 
		        if(isset($arr['u_role'])) {
		        	if($arr['u_role']=="manager") {echo "checked"; }
		        } ?> >
	        <label class="form-check-label">Manager</label>
	    </div>

	    <div class="form-check">
	        <input class="form-check-input" type="radio" name="u_role" id="gridRadios2" value="employee" <?php 
		        if(isset($arr['u_role'])) {
		        	if($arr['u_role']=="employee") {echo "checked"; }
		        } 
		        else{ echo "checked";}
		        ?> >
	        <label class="form-check-label">Employee</label>
	    </div>
	        
	    </div>
	    </div>
	  	</fieldset>


	  	<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">Name</label>
	    	<div class="col-sm-10">
	    		<input type="text" name="u_name" class="form-control" placeholder="name"  value="<?php if(isset($arr['u_name'])) {echo $arr['u_name'];} ?>">
	    	</div>
	  	</div>


	  	<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">Phone</label>
	    	<div class="col-sm-10">
	    		<input type="phone" name="u_phone" class="form-control" placeholder="phone"  value="<?php if(isset($arr['u_phone'])) {echo $arr['u_phone'];} ?>" minlength="12">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">Email</label>
	    	<div class="col-sm-10">
	    		<input type="email" name="u_email" class="form-control" placeholder="email"  value="<?php if(isset($arr['u_email'])) {echo $arr['u_email'];} ?>">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">DOB</label>
	    	<div class="col-sm-10">
	    		<input type="date" name="u_dob" class="form-control" placeholder="date"  value="<?php if(isset($arr['u_dob'])) {echo $arr['u_dob'];} ?>">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	   		<label class="col-sm-2 col-form-label">Address</label>
	    	<div class="col-sm-10">
	    		<input type="text" name="u_address" class="form-control" placeholder="address"  value="<?php if(isset($arr['u_address'])) {echo $arr['u_address'];} ?>"></input>
	    	</div>
	  	</div>


	  	<div class="form-group row float-right">
	  		<div class="col-sm-10">
	      		<button type="submit" name="done" class="btn btn-primary"  <?php 
	      			if(isset($_SESSION['idFieldVisible'])){echo "disabled"; unset($_SESSION['idFieldVisible']);} ?>
	      		>Done</button>
	    	</div>
		</div>
	</form>
</div>














       <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>