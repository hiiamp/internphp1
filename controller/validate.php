<?php
if (empty($_POST["name"])) {
    $check = 0;
    $nameErr = "Name is required";
} else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!$validate->name($name)) {
        $check = 0;
        $nameErr = "Only letters and white space allowed";
    }
}
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $check = 0;
} else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!$validate->email($email)) {
        $check = 0;
        $emailErr = "Invalid email format";
    }
}
if (empty($_POST["dayofbirth"])) {
    $check = 0;
    $birthErr = "Day of Birth is required";
} else {
    $birth = test_input($_POST["dayofbirth"]);
    if (!$validate->birthDay($birth)) {
        $check = 0;
        $birthErr = "You was born?";
    }
}
if (empty($_POST["password"])) {
    $check = 0;
    $passErr = "Password is required";
} else {
    $password = test_input($_POST["password"]);
    if (strlen($password) < 5) {
        $check = 0;
        $passErr = "Password need more than 5 character";
    }
}
if (empty($_POST["website"])) {
    $website = "";
} else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if(!$validate->website($website)){
        $websiteErr = "Invalid URL";
        $check = 0;
    }
}
if (empty($_POST["comment"])) {
    $comment = "";
} else {
    $comment = test_input($_POST["comment"]);
}

if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    $check = 0;
} else {
    $gender = test_input($_POST["gender"]);
}
?>