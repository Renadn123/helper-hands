<?php

function emptyInputSignup($FirstName, $LastName, $Email, $Passwrd, $PsWrepeat, $City, $StreetName, $BuildingNum, $Area){
    if(empty($FirstName) || empty($LastName) || empty($Email) || empty($Passwrd) || empty($PsWrepeat)|| empty($City) || empty($StreetName) || empty($BuildingNum) || empty($Area)){
        $result= true;
    }
    else{
        $result= false;
    }
    return $result;
}

function invalidEmail($Email){
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $result= true;
    }
    else{
        $result= false;
    }
    return $result;
}

function pwdMatch($Passwrd, $PsWrepeat){
    if($Passwrd !== $PsWrepeat){
        $result= true;
    }
    else{
        $result= false;
    }
    return $result;
}

// function BuildingNumLength($BuildingNum){
//     $BuildingStr = strval($BuildingNum);
//     $BuildingLength = strlen($BuildingStr);
//     if($BuildingLength == 5 ){
//         $result= true;
//     }
//     else{
//         $result= false;
//     }
//     return $result;
// }

function emailExists($conn, $Email){
   $sql = "SELECT * FROM parent WHERE Email= ?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../ParentSignUp.php?error=stmtfailed");
        exit();
   }

   mysqli_stmt_bind_param($stmt, "s", $Email);
   mysqli_stmt_execute($stmt);

   $resultData = mysqli_stmt_get_result($stmt);

   if($row = mysqli_fetch_assoc($resultData)){
    return $row;
   }
   else{
    $result = false;
    return $result;
   }
}

function createParent($conn, $FirstName, $LastName, $Email, $Passwrd, $City, $StreetName, $BuildingNum, $Area){
    $sql = "INSERT INTO parent (FirstName, LastName, Email, Passwrd, City, StreetName, BuildingNum, Area) VALUES(?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../ParentSignUp.php?error=stmtfailed");
         exit();
    }
 
    mysqli_stmt_bind_param($stmt, "ssssssss", $FirstName, $LastName, $Email, $Passwrd, $City, $StreetName, $BuildingNum, $Area);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../parentHome.php"); ////////////link to parents page
         exit();
 }

 function emptyInputLogin($Email, $Passwrd){
    if(empty($Email) || empty($Passwrd)){
        $result= true;
    }
    else{
        $result= false;
    }
    return $result;
}

function loginUser2($conn, $Email, $Passwrd){
    $emailExists = emailExists($conn, $Email);

    if($emailExists == false){
        header("location: ../Plogin.php?error=wronglogin");
        exit();
    }

    $pwd = $emailExists["Passwrd"];

    if($Passwrd !== $pwd){
        header("location: ../Plogin.php?error=wrongPassword");
        exit();
    }
    else {
        session_start();
        $_SESSION["Email"] = $emailExists["Email"];
        //$_SESSION[""] = 
        header("location: ../parentHome.php");
        exit();
    }
}