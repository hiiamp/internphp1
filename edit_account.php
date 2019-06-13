<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="jquery/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#list").click(function () {
                location.href = "index.php";
            });
            $("#search").click(function () {
                location.href = "search_account.php";
            });
            $("#create").click(function () {
                location.href = "create_account.php";
            });
        });
    </script>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-11">
                <nav id="top-nav">
                    <ul>
                        <li id="create"><a>Create Account</a></li>
                        <li id="search"><a>Search Account</a></li>
                        <li id="list"><a>List Account</a></li>
                        <li class="active" id="edit"><a>Edit Account</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</header>
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
$conn = connect_DTB("account_ex1");
//check email exists
$sql_check = "select * from `account` where `email`='$email'";
$temp = $conn->prepare($sql_check);
$temp->execute();
$result = $temp->setFetchMode(PDO::FETCH_ASSOC);
$resultSet = $temp->fetchAll();
$c1 = 0;
foreach ($resultSet as $row){
    $c1=1;
}
if($c1==0){
    echo '<script language="javascript">';
    echo 'var r = confirm("Error - Email doesn\'t exists!");';
    echo 'if(r) window.location="index.php";';
    echo '</script>';
    die("Error - email doesn't exists!");
}

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
        $emailErr = "Day of Birth is required";
    } else {
        $birth = test_input($_POST["dayofbirth"]);
        if (!$validate->birthDay($birth)) {
            $check = 0;
            $birthErr = "You was born?";
        }
    }
    if (empty($_POST["password"])) {
        $check = 0;
        $emailErr = "Password is required";
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

<h2>Edit to update your info:</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>" readonly>
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>
    Password: <input type="password" name="password" value="<?php echo $password; ?>">
    <span class="error">* <?php echo $passErr; ?></span>
    <br><br>
    Website: <input type="text" name="website" value="<?php echo $website; ?>">
    <span class="error"><?php echo $websiteErr; ?></span>
    <br><br>
    Birth Day: <input type="date" name="dayofbirth" value="<?php echo $birth; ?>">
    <span class="error">* <?php echo $birthErr; ?></span>
    <br><br>
    Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    <br><br>
    Gender:
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>
           value="female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
    <span class="error">* <?php echo $genderErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>


</body>
</html>
