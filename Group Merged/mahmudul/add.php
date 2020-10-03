<?php
ob_start();
include 'config.php';

if (isset($_POST['done'])) {

    $ID = $_POST['ID'];
    $password = $_POST['password'];
    $q = "INSERT INTO users(u_id, u_password) VALUES('$ID','$password')";

    $query = mysqli_query($con, $q);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="login.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container-add">
        <div class="col-lg-6 m-auto">

            <form action="add.php" method="post">

                <br><br>
                <div class="card">

                    <div class="card-header bg-dark">
                        <h1 class="text-white text-center"> ADD USERS </h1>
                    </div> <br>

                    <label> ID: </label>
                    <input type="text" name="ID" class="form-control" required> <br>

                    <label> Password: </label>
                    <input type="text" name="password" class="form-control" required> <br>

                    <button class="btn btn-success" type="submit" name="done"> Submit </button><br>
                    <button class="btn btn-success"><a href="display.php"
                            style="text-decoration:none;color:white;">Display</a></button><br>

                </div>
            </form>
        </div>
    </div>
</body>

</html>