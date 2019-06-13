<?php
    include "myLibrary/function_validate.php";
    include 'myLibrary/connectDTB_PDO.php';
    $validate = new Validate();
    // define variables and set to empty values
    $passErr = $birthErr = $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $password = $birth = $name = $email = $gender = $comment = $website = "";
    $check = 1;
    $email = @$_REQUEST["email"];
    $email = test_input($email);
    if ($email == "") {
        die("Error!");
    }
    $conn = null;
    include "check_exist_validInput.php";
    if(!check_exist($email)){
        echo '<script language="javascript">';
        echo 'var r = confirm("Error - Email doesn\'t exists!");';
        echo 'if(r) window.location="index.php";';
        echo '</script>';
        die("Error - email doesn't exists!");
    }
    $conn = connect_DTB("account_ex1");
    $stmt = $conn->prepare("SELECT * FROM account where email='$email'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultSet = $stmt->fetchAll();
    foreach ($resultSet as $row) {
        $name = $row['name'];
        $password = $row['password'];
        $comment = $row['other'];
        $gender = $row['gender'];
        $website = $row['website'];
        $birth = $row['dayofbirth'];
    }
    $conn = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "validate.php";
    }
    $temp = "";
    $temp = @$_GET["email"];
    $temp = test_input($temp);
    if ($check == 1 && $name != "" && $temp == "") {
        $conn = connect_DTB("account_ex1");
        $sql = "UPDATE `account` SET `name`='$name',`website`='$website',
        `other`='$comment',`gender`='$gender',`dayofbirth`='$birth',`password`='$password' WHERE email='$email'";
        $conn->exec($sql);
        die("Edit account success!");
}

?>