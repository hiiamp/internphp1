<?php
include "myLibrary/function_validate.php";
$validate = new Validate();
// define variables and set to empty values
$passErr = $birthErr = $nameErr = $emailErr = $genderErr = $websiteErr = "";
$password = $birth = $name = $email = $gender = $comment = $website = "";
$check = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "validate.php";
}
?>