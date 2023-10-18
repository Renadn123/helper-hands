<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$serverName="localhost";
$DBuserName="root";
$DBpassword="";
$DBName="projectdatabase2";
$conn=mysqli_connect($serverName,$DBuserName,$DBpassword,$DBName);
if(!$conn)
die("connection failed:".mysqli_connect_error());
$query = "DELETE FROM `parent` WHERE Email = 'hash@sd.com'";
$query = "DELETE FROM `babysitter` WHERE Email = 'hash@sd.com'";

 $result = mysqli_query($conn,$query);
 echo $result;

?>