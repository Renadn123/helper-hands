<?php
session_start();
if(isset($_POST['edit'])){
    $Fname = $_POST['FirstName'];
    $Lname = $_POST['LastName'];
    $email = $_POST['Email'];
    $Password = $_POST['Passwrd'];
    $city = $_POST['City'];
    require_once 'db.php';
    require_once 'db.php';
    $sql = "UPDATE `parent` SET  FirstName = '$Fname', LastName = '$Lname.',Email = '$email', Passwrd = '$Password', City = '$city' WHERE Email = '$email'";
    $result = mysqli_query($connection, $sql);
    if(!$result)
    header("Location:ParentProfile.php?error=none");
    else 
    header("Location:ParentProfile.php?error=wrong");

}
else{
    header("Location:ParentProfile.php");

}

?>