<?php
ob_start();
include 'config.php';

if (isset($_POST['done'])) {
    $id_new = $_POST["id_new"];
    $hour_new = $_POST["hour"];

    $id = $_GET['ID'];

    $q = "UPDATE workingtime SET u_id='$id_new', t_hour='$hour_new' WHERE u_id='$id'";

    $query = mysqli_query($con, $q);

    header('location:displayt.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

    <div class="col-lg-6 m-auto">

        <form method="post" name="datavalid" onsubmit="return validateForm()">

            <br><br>
            <div class="card">

                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Update Working Time </h1>
                </div><br>

                <label> ID: </label>
                <input type="text" name="id_new" class="form-control" required> <br>

                <label> Hour: </label>
                <input type="text" name="hour" class="form-control" required> <br>

                <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

            </div>
        </form>
    </div>
    <script>
    function validateForm() {
        var hour = document.forms["datavalid"]["hour"].value;
        if (!isFinite(hour)) {
            alert("Hour must be number");
            return false;
        }
    }
    </script>
</body>

</html>