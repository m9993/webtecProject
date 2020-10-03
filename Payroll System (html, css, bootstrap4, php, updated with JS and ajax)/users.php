<?php
require_once "includes/DataAccess.php";
require_once "includes/validation.php";
session_start();

if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])){
  header("Location: index.php");
}

$da=new DataAccess();

date_default_timezone_set("Asia/Dhaka");
    $time= date("h:i:s a");
    $date= date("d-M-Y");

$query="select * from users";
$rows=$da->ExecuteQuery($query);
$rowCount=0;

if($_SERVER['REQUEST_METHOD']=="GET"){
  if (isset($_GET['deleteId'])) {
    if(!validateString($_GET['deleteId'])){
      $_SESSION['msg']="Delete Id can not be empty!";
      $_SESSION['msg_type']="danger";
    }
    else{
      $query1="delete from payment where u_id='".$_GET['deleteId']."'";
      $query2="delete from salary where u_id='".$_GET['deleteId']."'";
      $query3="delete from workingtime where u_id='".$_GET['deleteId']."'";
      $query4="delete from users where u_id='".$_GET['deleteId']."'";
      if($da->ExecuteQuery($query1) && $da->ExecuteQuery($query2) && $da->ExecuteQuery($query3) && $da->ExecuteQuery($query4)){
        $_SESSION['msg']="'".$_GET['deleteId']."' user deleted successfully!";
        $_SESSION['msg_type']="success";
      }
      else{
        $_SESSION['msg']="Something went wrong when deleted '".$_GET['deleteId']."' !";
        $_SESSION['msg_type']="danger"; 
      }
    }

  }
}


if($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['u_search'])) {
    $fieldsArr=["u_name"];
    if (!validateFieldName($fieldsArr, $_POST)) {
      $_SESSION['msg']="Field names are not matching!";
      $_SESSION['msg_type']="danger";
    }
    else{
      if(!validateString($_POST['u_name'])){
        $_SESSION['msg']="Search box can not be empty!";
        $_SESSION['msg_type']="danger"; 
      }
      else{
        $query="select * from users where u_name like '%".$_POST['u_name']."%'";
        $rows=$da->ExecuteQuery($query);
        $n=$da->GetTotalNumberOfRows($query);
      
        if($n>1){ $_SESSION['msg']=$n." results found!";}
        else{$_SESSION['msg']=$n." result found!";}

        $_SESSION['msg_type']="success"; 
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
    <link rel="stylesheet" type="text/css" href="css/users.css">


    <title>Users</title>
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
         <li class="breadcrumb-item active" aria-current="page">Users</li>
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




<div class="container-fluid">
	
<form class="form-inline float-right mt-4 mb-0" action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
  <div class="form-group mb-2">
    <input type="text" name="u_name" class="form-control" id="inputPassword2" placeholder="Search by name">
  </div>
  <button type="submit" name="u_search" class="btn btn-info mb-2 ml-2"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>


<form method="POST" action="addEditUsers.php" class="d-inline-block">
	<button type="submit" name="addUsers" value="#autogenerated-id" onclick="window.location.href='addEditUsers.php'"  class="btn btn-success m-0 mt-4"><i class="fa fa-plus" aria-hidden="true"></i></button>
</form>

<button type="button"  onclick="window.location.href='users.php'"  class="btn btn-primary m-0 mt-4"><i class="fa fa-refresh" aria-hidden="true"></i></button>


    <table class="table table-hover">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">u_id</th>
      <th scope="col">u_role</th>
      <th scope="col">u_name</th>
      <th scope="col">u_phone</th>
      <th scope="col">u_email</th>
      <th scope="col">u_dob</th>
      <th scope="col">u_address</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>

  <tbody>
<?php while($arr = $da->ConvertRowsToArray($rows)){ $rowCount++; ?>
    <tr>
      <th scope="row"><?php if(isset($arr)){echo $rowCount;} ?></th>
      <td><?php if(isset($arr)){echo $arr['u_id'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_role'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_name'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_phone'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_email'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_dob'];} ?></td>
      <td><?php if(isset($arr)){echo $arr['u_address'];} ?></td>
      <td><a href="addEditUsers.php?editId=<?php echo $arr['u_id']?>"><i class="fa fa-pencil text-warning" aria-hidden="true"></i></a></td>
      <td><a href="users.php?deleteId=<?php echo $arr['u_id']?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
    </tr>
<?php } ?>
  </tbody>

</table>


</div>
    
    
        
    
        







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>