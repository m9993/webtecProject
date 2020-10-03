<?php
session_start();
// empty value and expiration one hour before
session_unset();
session_destroy();
header('Location: ../index.php');

?>