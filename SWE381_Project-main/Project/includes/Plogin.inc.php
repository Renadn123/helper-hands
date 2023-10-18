<?php

if(isset($_POST["login-submit"])){

    $Email = $_POST["Email"];
    $Passwrd = $_POST["Passwrd"];

    require_once 'dbh.inc.php';
    require_once 'functions2.inc.php';

    if(emptyInputLogin($Email, $Passwrd) !== false){
        header("location: ../Plogin.php?error=emptyinput");
        exit();
    }

    loginUser2($conn, $Email, $Passwrd);

}
else{
    header("location: ../Plogin.php");
        exit();
}