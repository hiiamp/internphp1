<?php
if ($check == 1 && $name != "") {
    include 'myLibrary/connectDTB_PDO.php';
    $conn = connect_DTB("account_ex1");
    $sql_check = "select * from `account` where `email`='$email'";
    $temp = $conn->prepare($sql_check);
    $temp->execute();
    $result = $temp->setFetchMode(PDO::FETCH_ASSOC);
    $resultSet = $temp->fetchAll();
    $c1 = 0;
    foreach ($resultSet as $row){
    $c1=1;
    }
    if($c1==1){
    echo '<script language="javascript">';
        echo 'alert("Email already exists!")';
        echo '</script>';
    } else {
    $sql = "INSERT INTO `account` (`name`, `email`, `website`, `other`, `gender`, `dayofbirth`, `password`)
    VALUES ('$name', '$email', '$website', '$comment', '$gender', '$birth', '$password');";
    $conn->exec($sql);
    $conn = null;
    echo '<script language="javascript">';
        echo 'var r = confirm("Add account success!");';
        echo 'if(r) window.location="index.php";';
        echo '</script>';
    die("Error - email doesn't exists!");
    die("Add account success!");
    }
    $conn = null;
}
?>