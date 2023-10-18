<?php

function emptyInputSignup($FirstName, $LastName, $Email, $Passwrd, $PsWrepeat, $NationalID, $Age, $Phone, $City, $Gender, $Bio){
    if(empty($FirstName) || empty($LastName) || empty($Email) || empty($Passwrd) || empty($PsWrepeat)|| empty($NationalID) || empty($Age) || empty($Phone) || empty($City) || empty($Gender) || empty($Bio)){
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

// function PhoneNumLength($Phone){
//     $phoneStr = strval($Phone);
//     $phoneLength = strlen($phoneStr);
//     if($phoneLength == 10 ){
//         $result= true;
//     }
//     else{
//         $result= false;
//     }
//     return $result;
// }

function NationalIDLength($NationalID){
    $IDStr = strval($NationalID);
    $IDLength = strlen($IDStr);
    if($IDLength == 10 ){
        $result= true;
    }
    else{
        $result= false;
    }
    return $result;
}


function emailExists($conn, $Email){
   $sql = "SELECT * FROM babysitter WHERE Email= ?;";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../BabysitterSignup.php?error=stmtfailed");
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

function createbabysitter($conn, $FirstName, $LastName, $Email, $Passwrd, $NationalID, $Age, $Phone, $City, $Gender, $Bio){
    $sql = "INSERT INTO babysitter (FirstName, LastName, Email, Passwrd, NationalId, Age, Phone, City, Gender, Bio) VALUES(?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../BabysitterSignup.php?error=stmtfailed");
         exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss", $FirstName, $LastName, $Email, $Passwrd, $NationalID, $Age, $Phone, $City, $Gender, $Bio);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../Home.php"); ////////////link to babysitter page
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

function loginUser($conn, $Email, $Passwrd){
    $emailExists = emailExists($conn, $Email);

    if($emailExists == false){
        header("location: ../Bslogin.php?error=wronglogin");
        exit();
    }

    $pwd = $emailExists["Passwrd"];

    if($Passwrd !== $pwd){
        header("location: ../Bslogin.php?error=wrongPassword");
        exit();
    }
    else {
        session_start();
        $_SESSION["Email"] = $emailExists["Email"];
        header("location: ../BabySitter.html");
        exit();
    }
}
