<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "db.php";
if(isset($_POST['submut'])){
            $Email = $_POST['email'];
            $Psw = $_POST['pass'];
            $query_babysitter = "SELECT * FROM `parent` WHERE Email = '$Email' AND Passwrd = '$Psw'";

            $result_b = mysqli_query($conn,$query_babysitter);
        
            if(mysqli_num_rows($result_b) > 0){
                session_start();
                $_SESSION['bemail'] = $Email;
                header("Location:parentHome.php");
            }
            else {
                
                header("Location:Home.php?error= Wrong email/Password");
            }}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page</title>
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href=Images\LOGO.png>
</head>

    <body>
        <div class="header">
            <img src="Images\LOGO.png" alt="Website Logo" class="LogoPicture">
          </div>

          <div class="menu-conatiner">
            <ul class="menu">
              <p class="menuItem" id="question">Not a Member? Sign up as a</p>
              <li class="menuItem"><a class="status" href="ParentSignUp.php">Parent</a></li>
              <li class="menuItem"><a class="status" href="BabysitterSignUp.php">Babysitter</a></li>
              <li class="menuItem" id="home"><a href="Home.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2626/2626923.png" alt="home icon"> </a></li>
            </ul>
          </div>

        <h1>Welcome Back! Please Login</h1>
        <div id="content">
        <div class="LoginPicContainer">
            <img src="Images\PurpleLoginPic.png" alt="Generic Avatar Image" class="LoginPicture">
        </div>

            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p> You didn't fill in all fields! </p>";
                    }
                    else if ($_GET["error"] == "wronglogin"){
                        echo "<p> Incorrect Login Information! </p>";
                    }

                    else if ($_GET["error"] == "wrongPassword"){
                        echo "<p> Incorrect Password! </p>";
                    }

                }
            ?>

        <section class="Lform">
        <div class="UTextContainer">

            <form class="login" action="includes/Plogin.inc.php" method="post">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="email" name="Email" class="login__input" placeholder="Enter Your Email">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" name="Passwrd" class="login__input" placeholder="Enter Your Password">
                </div>

                <button type="submit" class="button login__submit" name="login-submit">Log In</button>
            </form>
        </div>

        </section>
        </div> 

<footer>
    <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
  </footer>

    </body>
</html>