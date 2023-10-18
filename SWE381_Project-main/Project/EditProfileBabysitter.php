<?php
session_start();
if(isset($_POST['submit'])){
    $Fname = $_POST['FirstName'];
    $Lname = $_POST['LastName'];
    $email = $_POST['Email'];
    $Password = $_POST['Passwrd'];
    $nationalld=$_POST['NationalId'];
    $age=$_POST['Age'];
    $phone=$_POST['Phone'];
    $city = $_POST['City'];
    $Gender=$_POST['Gender']; 
    $bio=$_POST['Bio'];
    require_once 'db.php';
    require_once 'db.php';
    $sql = "UPDATE babysitter SET First_Name = '$Fname', Last_Name = '$Lname', Email = '$email',  Password = '$Password', NationalId= '$nationalld', Age='$age',Phone='$phone', city = '$city'Gender='$Gender',Bio=' $bio' WHERE Email = '$Email'";
    $result = mysqli_query($connection, $sql);
    if(!$result)
    header("Location:sitterManageProfile.php?error=none");
    else 
    header("Location:sitterManageProfile.php?error=wrong");

}
else{
    header("Location:sitterManageProfile.php");

}
?>