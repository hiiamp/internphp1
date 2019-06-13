<?php
include "myLibrary/function_validate.php";
$email = "";
$email = @$_REQUEST["email"];
$email = test_input($email);
if ($email == "") {
    die("Error!");
}
echo '<script language="javascript">';
echo 'var r = confirm("Delete this account?");';
echo 'if(r) window.location="delete_account.php?email='.$email.'";';
echo 'else window.location="index.php";';
echo '</script>';
die("Error - email doesn't exists!");
?>