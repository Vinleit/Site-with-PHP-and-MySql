<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = '';
        $_SESSION['username'] = '';
        $_SESSION['type'] = '';
    }



    function crypto($password){
        $cryptography = '';
        for($position = 0; $position < strlen($password); $position++){
            $letter = ord($password[$position]) + 9; // 9 = número aleatório
            $cryptography .= chr($letter);
        }
        return $cryptography;
    }

    function GenerateHash($password){
        $crypto_passwd = crypto($password);
        $hash = password_hash($crypto_passwd, PASSWORD_DEFAULT);
        return $hash;
    }


    function VerifyHash($password, $hash){
        $crypto_passwd = crypto($password);
        $verify = password_verify($crypto_passwd, $hash);
        return $verify;
    }

    function Logout(){
       unset($_SESSION['user']);
       unset($_SESSION['username']);
       unset($_SESSION['type']);
    }

    function is_logged(){
        if(empty($_SESSION['user'])){
            return false;
        } else {
            return true;
        }
    }

    function is_admin(){
        if($_SESSION['type'] == 'admin'){
            return true;
        } else {
            return false;
        }
    }

    function is_editor(){
        if($_SESSION['type'] == 'editor'){
            return true;
        } else {
            return false;
        }
    }
?>