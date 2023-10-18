<?php

if(isset($_POST["submit"]) || isset($_FILES['photo'])){

    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $Email = $_POST["Email"];
    $Passwrd = $_POST["Passwrd"];
    $PsWrepeat = $_POST["PsWrepeat"];
    $City = $_POST["City"];
    $StreetName = $_POST["StreetName"];
    $BuildingNum = $_POST["BuildingNum"];
    $Area = $_POST["Area"];

    require_once 'dbh.inc.php';
    require_once 'functions2.inc.php';

        echo "<pre>";
        print_r($_FILES['photo']);
        echo "</pre>";

        $img_name = $_FILES['photo']['name'];
        $img_size = $_FILES['photo']['size'];
        $tmp_name = $_FILES['photo']['tmp_name'];
        $error = $_FILES['photo']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Sorry, your file is too large.";
                header("Location: ../ParentSignUp.php?error=$em");
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    $sql = "INSERT INTO parent (photo) VALUES('$new_img_name')";
                    mysqli_query($conn, $sql);
                }else {
                    $em = "You can't upload files of this type";
                    header("Location: ../ParentSignUp.php?error=$em");
                }
            }
        }else {
            $em = "unknown error occurred!";
            header("Location: ../ParentSignUp.php?error=$em");
        }    


    if(emptyInputSignup($FirstName, $LastName, $Email, $Passwrd, $PsWrepeat, $City, $StreetName, $BuildingNum, $Area) !== false){
        header("location: ../ParentSignUp.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($Email) !== false){
        header("location: ../ParentSignUp.php?error=invalidemail");
        exit();
    }

    if(pwdMatch($Passwrd, $PsWrepeat) !== false){
        header("location: ../ParentSignUp.php?error=passwordsdontmatch");
        exit();
    }

    // if(BuildingNumLength($BuildingNum) == false){
    //     header("location: ../ParentSignUp.php?error=buildingnumbertoolong");
    //     exit();
    // }

    if(emailExists($conn, $Email) !== false){
        header("location: ../ParentSignUp.php?error=emailtaken");
        exit();
    }

    createParent($conn, $FirstName, $LastName, $Email, $Passwrd, $City, $StreetName, $BuildingNum, $Area);
}

else {
    header("location: ../ParentSignUp.php");
    exit();
}