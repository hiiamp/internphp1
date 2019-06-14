<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "check_exist_validInput.php";
        include "myLibrary/connectDTB_PDO.php";
        $filename=$_FILES["file"]["tmp_name"];
        $filetype = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
        if(!($filetype=="csv" || $filetype=="CSV")){
            echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              </script>";
        } else
        if($_FILES["file"]["size"]>0){
            $file = fopen($filename,"r");
            echo '<table width = "100%" class="table table-striped table-condensed table-bordered table-rounded" >
            <h2 > List Account Created: </h2> 
            <TR>
                <TH>Name</TH>
                <TH>E-mail</TH>
                <TH>Website</TH>
                <TH>Day of Birth</TH>
                <TH>Other Infor</TH>
                <TH>Gender</TH>
                <TH>Status</TH>
            </TR>';
            while(($data = fgetcsv($file,20000,","))!==false){
                $infor = "Success!";
                $add = true;
                if(!isset($data[6])) continue;
                if(check_exist($data[1])) {
                    $infor = "Email exists!";
                    $add = false;
                } else if(!check_validInput($data[0],$data[1],$data[2],$data[3],$data[4],strtolower($data[6]) ) ){
                    $infor = "Invalid infor!";
                    $add = false;
                }
                $name = $data[0];
                $email = $data[1];
                $password = $data[2];
                $website = $data[3];
                $birth = $data[4];
                $comment = $data[5];
                $gender = strtolower($data[6]);
                if($add){
                    $conn = connect_DTB("account_ex1");
                    $sql = "INSERT INTO `account` (`name`, `email`, `website`, `other`, `gender`, `dayofbirth`, `password`)
                    VALUES ('$name', '$email', '$website', '$comment', '$gender', '$birth', '$password');";
                    $conn->exec($sql);
                    $conn = null;
                }
                echo '<TR>
                           <TD>' . $name . '</TD>
                           <TD>' . $email . '</TD>
                           <TD>' . $website . '</TD>
                           <TD>' . $birth . '</TD>
                           <TD>' . $comment . '</TD>
                           <TD>' . $gender . '</TD>
                           <TD>' . $infor   . '</TD>
                     </TR>';

            }
            echo '</table>';
            fclose($file);
        } else {
            echo "<script type=\"text/javascript\">
              alert(\"Data not found!\");
              </script>";
        }
    } else {

    }
?>