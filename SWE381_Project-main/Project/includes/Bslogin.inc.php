<?php

if(isset($_POST["login-submit"])){

    $Email = $_POST["Email"];
    $Passwrd = $_POST["Passwrd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($Email, $Passwrd) !== false){
        header("location: ../Bslogin.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $Email, $Passwrd);

}
else{
    header("location: ../Bslogin.php");
        exit();
}