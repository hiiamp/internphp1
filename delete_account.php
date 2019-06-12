<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = "";
$name = @$_REQUEST["name"];
echo $name;
$name = test_input($name);
if ($name == "") {
    die("Error!");
}
include 'connectDTB_PDO.php';
$conn = connect_DTB("account_ex1");
$sql = "DELETE FROM `account` WHERE name = '$name' ";
echo $sql;
$conn->exec($sql);
echo '<script language="javascript">';
echo 'alert("Delete [' . $name . '] Success!")';
echo '</script>';
header('Location:index.php');
?>