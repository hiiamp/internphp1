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
                        <li class="active" id="create"><a>Create Account</a></li>
                        <li id="search"><a>Search Account</a></li>
                        <li id="list"><a>List Account</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</header>
<?php
    include "controller/validate_for_create_acc.php";
    include "controller/create_acc.php";
?>
<div class="container">
<h2>Please input your account infor:</h2>
<a href="create_by_csv.php" class="badge badge-secondary" style="font-size: 20px;">Or import your CSV file?</a>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group row">
        <label for="name" class="col-sm-1 col-form-label">Name</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-1 col-form-label">E-mail</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-1 col-form-label">Password</label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="error">* <?php echo $passErr; ?></span>
    </div>
    <div class="form-group row">
        <label for="website" class="col-sm-1 col-form-label">website</label>
        <input type="text" name="website" value="<?php echo $website; ?>">
        <span class="error"><?php echo $websiteErr; ?></span>
    </div>
    <div class="form-group row">
        <label for="birthday" class="col-sm-1 col-form-label">Birthday</label>
        <input type="date" name="dayofbirth" value="<?php echo $birth; ?>">
        <span class="error">* <?php echo $birthErr; ?></span>
    </div>
    <div class="form-group row">
        <label for="comment" class="col-sm-1 col-form-label">Other infor</label>
        <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    </div>
    <div class="form-group row">
        <label for="gender" class="col-sm-1 col-form-label">Gender</label>
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>
               value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
        <span class="error">* <?php echo $genderErr; ?></span>
    </div>
    <div class="form-group row">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>
</div>

</body>
</html>
