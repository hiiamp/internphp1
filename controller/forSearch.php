<?php
include "myLibrary/function_validate.php";
include 'myLibrary/connectDTB_PDO.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = test_input($_POST["key"]);
    $conn = connect_DTB("account_ex1");
    $stmt = $conn->prepare("SELECT * FROM account where name like '%$key%'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo '<table width = "100%" class="table table-bordered table-hover" >
    <h2 > List Account Created: </h2> 
    <TR>
        <TH>Name</TH>
        <TH>E-mail</TH>
        <TH>Website</TH>
        <TH>Day of Birth</TH>
        <TH>Other Infor</TH>
        <TH>Gender</TH>
        <TH>Manage</TH>
    </TR>';
    $resultSet = $stmt->fetchAll();
    foreach ($resultSet as $row) {
        echo '<TR>
                    <TD>' . $row['name'] . '</TD>
                    <TD>' . $row['email'] . '</TD>
                    <TD>' . $row['website'] . '</TD>
                    <TD>' . $row['dayofbirth'] . '</TD>
                    <TD>' . $row['other'] . '</TD>
                    <TD>' . $row['gender'] . '</TD>
                    <TD>
                    <button> <a href="edit_account.php?email=' . $row['email'] . '"> Edit </a></button>
                    <button> <a href="delete_account.php?name=' . $row['name'] . '"> Delete </a> </button>
                    </TD>
                </TR>';
    }
    echo '</table>';
}
?>