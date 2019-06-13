<?php
ob_start();
include 'myLibrary/connectDTB_PDO.php';
include "myLibrary/function_validate.php";
$email = "";
$email = @$_REQUEST["email"];
echo $email;
$email = test_input($email);
if ($email == "") {
    die("Error!");
}
$conn = connect_DTB("account_ex1");
$sql = "DELETE FROM `account` WHERE email = '$email' ";
$conn->exec($sql);
echo '<script language="javascript">';
echo 'alert("Delete [' . $name . '] Success!")';
echo '</script>';
header('Location:index.php');
?>