<?php
session_start();
//$_SESSION['u_id']="a-0001";

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "payrolldb";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (mysqli_connect_errno()) {
    echo "Error: " . mysqli_connect_err();
}

?>

<html>

<head>
    <link rel="stylesheet" href="login.css">
    </link>

    <title>edit</title>
    <h2 class="h" align="center">Employee Information Update</h2>
</head>

<body id="y">

</body>
<div id="x">
    <form action="edit.php" name="datavalid" onsubmit="return validateForm()" method="POST" align="center">
        <br>
        <br>
        <label>Change-Name</label>
        <input name="u_name" type="text" id="form" placeholder="Change your name" required></input>
        <br>
        <label>Change-Password</label>
        <input name="u_password" type="password" id="form" placeholder="Change password" required></input>
        <br>
        <label>Change-Email</label>
        <input name="u_email" type="address" id="form" placeholder="Change email" required></input>
        <br>
        <label>Change-Address</label>
        <input name="u_address" type="age" id="form" placeholder="Change address" required></input>
        <br>
        <label>Change-PhoneNumber</label>
        <input name="u_phone" type="phone_number" id="form" placeholder="Change phone number" required></input>
        <br>
        <label>Change Date Of Birth</label>
        <input name="u_dob" type="text" placeholder="Change date of birth" id="form" required></input>
        <br>
        <br>
        <input name="update" type="submit" id="form" value="Submit"></input>
    </form>
</div>
<script>
function validateForm() {
    var eml = document.forms["datavalid"]["u_email"].value;
    var pass = document.forms["datavalid"]["u_password"].value;
    var phn = document.forms["datavalid"]["u_phone"].value;
    if (!(str.match(/[a-z]/g) && str.match(
            /[A-Z]/g) && str.match(
            /[0-9]/g) && str.match(
            /[^a-zA-Z\d]/g) && str.length >= 8)) {
        alert(
            "Password must be At least 1 uppercase character. At least 1 lowercase character.At least 1 digit.At least 1 special character.Minimum 8 characters."
        );
    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(eml))) {
        alert("Enter correct email address");
    } else if (!/^[0-9]{11}$/.test(phn)) {
        alert("Enter correct Phone Number");
    }
}
</script>

</html>

<?php

if (isset($_POST['update'])) {
    $password_hash = password_hash($_POST['u_password'], PASSWORD_DEFAULT);
    $query = "UPDATE users set u_name='" . $_POST['u_name'] . "', u_password='" . $password_hash . "', u_email='" . $_POST['u_email'] . "', u_address='" . $_POST['u_address'] . "', u_phone='" . $_POST['u_phone'] . "', u_dob='" . $_POST['u_dob'] . "' WHERE u_id='" . $_SESSION['u_id'] . "'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {

        echo '<script type="text/javascript"> alert("Data Updated")</script>';
    } else {
        echo '<script type="text/javascript"> alert("Data not Updated")</script>';
    }
//echo $_SESSION['u_id'];
}

?>