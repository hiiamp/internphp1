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
                        <li class="active" id="search"><a>Search Account</a></li>
                        <li id="list"><a>List Account</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</header>
<center>
    <form name="formLogin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2> Input keyword to search by name: </h2>
        <div class="form-group" style="width:20%;">
            Key:

            <input class="form-control" style="border-radius:5px;width:auto;height:40px;" type="text" name="key"/>

        </div>
        <button class="form-control" style="width:10%;" name="Search"> OK</button>

        <button class="form-control" style="width:10%;" type="reset" name="Reset"> RESET</button>

    </form>
</center>
<?php
    include "controller/forSearch.php";
?>

</body>
</html>
