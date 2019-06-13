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
                location.href = "create_by_csv.php";
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
<div class="container">
</br>
</br>
    <form class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Choose your CSV file:</legend>
            <a href="create_account.php" class="badge badge-secondary" style="font-size: 20px;">Or input your infor by keyboard?</a>
            <br>
            <br>
            <div class="form-group">
                <label class="col-md-4 control-label" for="filebutton">Select File</label>
                <div class="col-md-4">
                    <input type="file" name="file" id="file" class="input-large">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                <div class="col-md-4">
                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
        include "myLibrary/function_validate.php";
        include "controller/create_acc_CSV.php";
    ?>
</div>

</body>
</html>
