<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
session_start();

if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])){
  header("Location: index.php");
}

date_default_timezone_set("Asia/Dhaka");
	$time= date("h:i:s a");
	$date= date("d-M-Y");
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
    <link rel="stylesheet" type="text/css" href="css/adminHome.css">


    <title>Admin</title>
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
         <li class="breadcrumb-item active" aria-current="page">Home</li>
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


    
	<div class="container text-center mt-5" id="catagory">

        <button type="button" name="users" onclick="window.location.href='users.php'" class="btn btn-warning font-weight-bold shadow m-3 m-sm-4" style="width: 10rem; height: 10rem;"><i class="fa fa-users" aria-hidden="true"></i><br>Users</button>
   
        <button type="button" name="salary" onclick="window.location.href='salary.php'" class="btn btn-success font-weight-bold shadow m-3 m-sm-4" style="width: 10rem; height: 10rem;"><i class="fa fa-money" aria-hidden="true"></i><br>Salary</button>
   
        <button type="button" name="workingTime" onclick="window.location.href='workingTime.php'" class="btn btn-danger font-weight-bold shadow m-3 m-sm-4" style="width: 10rem; height: 10rem;"><i class="fas fa-user-clock"></i><br>Working Time</button>

        <button type="button" name="payment" onclick="window.location.href='payment.php'" class="btn btn-info font-weight-bold shadow m-3 m-sm-4" style="width: 10rem; height: 10rem;"><i class="fab fa-amazon-pay"></i><br>Payment</button>
        
    </div>
        







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>