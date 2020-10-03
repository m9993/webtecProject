<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
session_start();

$da=new DataAccess();

date_default_timezone_set("Asia/Dhaka");
	$time= date("h:i:s a");
	$date= date("d-M-Y");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["u_login"])) {
       		$fieldsArr=["u_id","u_password","u_login"];
       		if(!validateFieldName($fieldsArr, $_POST)){
       			 $_SESSION['msg']="Field names are not matching!";
           		 $_SESSION['msg_type']="danger";
       		}
       		else {
       			if(!validateString($_POST['u_id']) || !validateString($_POST['u_password'])){
       				$_SESSION['msg']="Filed values can not be empty!";
           			$_SESSION['msg_type']="danger";		
           			$uname=$_POST['u_id'];
       			}
       			else{
              $query="select u_id from users";
              if($da->GetTotalNumberOfRows($query)<1){
                $_SESSION['no_user']="no_user";
                $_SESSION['u_name']="no_user";
                header("Location: addEditUsers.php");
              }
       				$query="select u_id, u_name, u_password, u_role from users where u_id='".$_POST['u_id']."'";
		            $totalRows=$da->GetTotalNumberOfRows($query);
		            if($totalRows<1){
		            	$_SESSION['msg']="'".$_POST['u_id']."' user does not exists!";
           				$_SESSION['msg_type']="danger";		
		            }
		            else{
		            	$rows=$da->ExecuteQuery($query);
		            	$arr=$da->ConvertRowsToArray($rows);
		            	$uname=$arr['u_id'];
		            	if(!password_verify ($_POST['u_password'] , $arr['u_password'] )){
		            		$_SESSION['msg']="Wrong Password!";
           					$_SESSION['msg_type']="danger";		
		            	}
		            	else{
		            		$_SESSION["u_id"]=$arr['u_id'];
		            		$_SESSION["u_name"]=$arr['u_name'];
		            		//cookie
		            		$cookie_name = $_SESSION["u_id"];
							$cookie_value = $_SESSION["u_name"];
		            		if(!isset($_COOKIE[$cookie_name])) {
								setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400s = 1 day
							}
							//cookie
		            		if($arr['u_role']=="admin"){
				            	header("Location: adminHome.php");
		            		}
		            		if($arr['u_role']=="manager"){
		            			header("Location: u/m.php");
		            		}
		            		if($arr['u_role']=="employee"){
		            			header("Location: u/e.php");
		            		}
		            		

		            	}
		            	

		            //$pass=password_hash("123", PASSWORD_DEFAULT);
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/indexx.css">


    <title>Login</title>
  </head>
  <body>

  	<header>
  		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php"><i id="logo"></i><b>Payroll System</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item ">
                        <a class="nav-link " href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $time; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $date; ?></a>
                    </li>
                   
                   
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                         <i class="fa fa-user"></i> XXXXX.xxx
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
                          <a class="dropdown-item" href="#">  LOGOUT</a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
		</nav>

		<?php if (isset($_SESSION["msg"])) { ?>
			<div class="alert alert-<?=$_SESSION['msg_type']?>" role="alert">
	  			<?php
	  				echo $_SESSION['msg'];
	  				unset($_SESSION['msg']);
	  				unset($_SESSION['msg_type']);
	  			?>
			</div>

  		<?php } ?>


  	</header>


    
	<div class="container col-xs-12 col-sm-12 col-md-8 col-lg-6">

        <!-- <h2>Login Page</h2>
        <p>Login or register from here to access.</p> -->
    
        <form id="login_form" class="mt-xs-5 p-md-5 shadow" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
        	<h2 style="text-align: center; margin-bottom: 20px; color: #212529;">Login</h2>
            <div class="form-group">
                <input type="text" name="u_id" class="form-control" placeholder="User Name" value="<?php if(isset($uname)){echo $uname;} ?>">
            </div>
            <div class="form-group">
                <input type="password" name="u_password" class="form-control" placeholder="Password">
            </div>
                <button type="submit" name="u_login" class="btn btn-primary col mb-md-5 mb-2">Login</button>
        </form>
    </div>
        







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>