<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
$da=new DataAccess();
session_start();

if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])){
  header("Location: index.php");
}

date_default_timezone_set("Asia/Dhaka");
    $time= date("h:i:s a");
    $date= date("d-M-Y");

if(isset($_POST['changePassword'])){
    $fieldsArr=["old_password","new_password","confirm_new_password","changePassword"];
    if(!validateFieldName($fieldsArr, $_POST)){
        $_SESSION["msg"]="Field names are not matching!";
        $_SESSION["msg_type"]="danger";
    }
    else{

        if(!validateString($_POST['old_password']) || !validateString($_POST['new_password']) || !validateString($_POST['confirm_new_password'])){
            $_SESSION["msg"]="Field values can not be empty!";
            $_SESSION["msg_type"]="danger";
        }
        else{
            if($_POST['new_password']!=$_POST['confirm_new_password']){
                $_SESSION["msg"]="New Password & Confirm New Password are not matching!";
                $_SESSION["msg_type"]="danger";
            }
            else{
                $query="select u_password from users where u_id='".$_SESSION['u_id']."'";
                $rows=$da->ExecuteQuery($query);
                $arr=$da->ConvertRowsToArray($rows);

                if(!password_verify($_POST['old_password'], $arr['u_password'])){
                    $_SESSION["msg"]="First enter old password correctly!";
                    $_SESSION["msg_type"]="danger";       
                }
                else{
                    $h_pass=password_hash($_POST['confirm_new_password'], PASSWORD_DEFAULT);
                    $query="update users set u_password='".$h_pass."' where u_id='".$_SESSION['u_id']."'";
                    if($da->ExecuteQuery($query)){
                        $_SESSION["msg"]="Password changed successfully!";
                        $_SESSION["msg_type"]="success";
                    }
                    else{
                        $_SESSION["msg"]="Something went wrong when changing password!";
                        $_SESSION["msg_type"]="danger";   
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
    <link rel="stylesheet" type="text/css" href="css/changePassword.css">


    <title>Change Password</title>
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
         <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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



    
    <div class="container col-xs-12 col-sm-12 col-md-8 col-lg-6">

       
    
        <form id="changePassword_form" class="p-md-5 mt-5 shadow" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
            <h2 style="text-align: center; margin-bottom: 20px; color: #212529;">Change Password</h2>
            
            <div class="form-group">
                <input type="password" name="old_password" class="form-control" placeholder="Old Password">
            </div>
            
            <div class="form-group">
                <input type="password" name="new_password" class="form-control" placeholder="New Password">
            </div>
            
            <div class="form-group">
                <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password">
            </div>
            
            <button type="submit" name="changePassword" class="btn btn-primary col mb-md-4">Change</button>
        </form>
    </div>
        







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>