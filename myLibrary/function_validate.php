<?php
    class Validate{

        public function email($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            return true;
        }
        public function birthDay($birth){
            $d = strtotime($birth);
            $today = date("Y-m-d");
            if (strtotime($d) > strtotime($today)) {
                return false;
            }
            return true;
        }
        public function website($website){
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                return false;
            }
            return true;
        }
        public function name($name){
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                return false;
            }
            return true;
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>