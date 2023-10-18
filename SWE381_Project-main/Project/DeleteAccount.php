<?php
session_start();
   require_once 'db.php';
   require_once 'function.php';
$Email = $_SESSION['Email'];
$sql = "DELETE FROM `parent` WHERE Email = '$Email';";
$result=mysqli_query($connection,$sql);
if(!$result)
header("Location:ParentSingnUp.php?error=none");
else 
header("Location:ParentProfile.php?error=wrong");
mysqli_close($conn);

?>
