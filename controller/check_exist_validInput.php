<?php
    function check_exist($email){
        $conn = connect_DTB("account_ex1");
        //check email exists
        $sql_check = "select * from `account` where `email`='$email'";
        $temp = $conn->prepare($sql_check);
        $temp->execute();
        $result = $temp->setFetchMode(PDO::FETCH_ASSOC);
        $resultSet = $temp->fetchAll();
        foreach ($resultSet as $row){
            return true;
        }
        return false;
    }
    function check_validInput($name,$email,$password,$website,$birth,$gender){
        $validate = new Validate();
        if ($name=="") {
            return false;
        } else {
            if (!$validate->name($name)) {
                return false;
            }
        }
        if ($email=="") {
            return false;
        } else {
            if (!$validate->email($email)) {
                return false;
            }
        }
        if ($birth=="") {
            return false;
        } else {
            if (!$validate->birthDay($birth)) {
                return false;
            }
        }
        if ($password=="") {
            return false;
        } else {
            if (strlen($password) < 5) {
                return false;
            }
        }
        if ($website=="") {

        } else {
            if(!$validate->website($website)){
                return false;
            }
        }
        $gender = strtolower($gender);
        if ($gender=="female"||$gender=="male"||$gender=="other") {
            return true;
        } else {
            return false;
        }
        return true;
    }
?>