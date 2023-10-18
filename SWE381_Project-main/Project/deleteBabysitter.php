<?php
session_start();
require_once 'db.php';
require_once'function.php';
$email = $_SESSION['Email'];
$sql = "DELETE FROM babysitter WHERE Email = '$email';";
$result=mysqli_query($connection,$sql);
if(!$result)
header("Location:BabysitterSingnUp.php?error=none");
else 
header("Location:sitterManageProfile.php?error=wrong");
mysqli_close($connection);

?>