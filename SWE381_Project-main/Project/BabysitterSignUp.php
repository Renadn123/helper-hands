<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Babysitter SignUp Page</title>
    <link rel="stylesheet" href="BsSignUpStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Coiny' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="shortcut icon" type="image/x-icon" href=Images\LOGO.png>
</head>
<body>

    <div class="header">
        <img src="Images\LOGO.png" alt="Website Logo" class="LogoPicture">
      </div>

      <div class="menu-conatiner">
        <ul class="menu">
          <p class="menuItem" id="question">Already Have An Account? </p>
          <li class="menuItem"><a class="status" href="Bslogin.php">Log In</a></li>
          <li class="menuItem" id="home"><a href="Home.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2626/2626923.png" alt="home icon"> </a></li>
        </ul>
      </div>

    <h1> Babysitter Registration Form</h1>
    <section class="SForm">
        <div class="SU-BsContainer">

        <?php
            if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p> You didn't fill in all fields! </p>";
                    }
                    else if ($_GET["error"] == "invalidemail"){
                        echo "<p> Write a proper email! </p>";
                    }

                    else if ($_GET["error"] == "passwordsdontmatch"){
                        echo "<p> Your passwords don't match! </p>";
                    }

                    else if ($_GET["error"] == "stmtfailed"){
                        echo "<p> Something went wrong, try again! </p>";
                    }

                    else if ($_GET["error"] == "emailtaken"){
                        echo "<p> Email already taken! </p>";
                    }

                    // else if ($_GET["error"] == "phonenumbertoolong"){
                    //     echo "<p> Invalid Phone Number! </p>";
                    // }

                    else if ($_GET["error"] == "IDtoolong"){
                        echo "<p> Invalid Phone Number! </p>";
                    }

                    else if ($_GET["error"] == "none"){
                        echo "<p> You signed up! </p>";
                    }
}
?>
        <form class="modalform" action="includes/BsSignup.inc.php" method="post" enctype="multipart/form-data">
        <label> First Name: </label>
        <input type="text" name="FirstName" placeholder= "Please Enter Your First Name"/>

        <label> Last Name: </label>
        <input type="text" name="LastName" placeholder="Please Enter Your Last Name"/>

        <label for="email"> Email: </label>
        <input type="email" placeholder="Please Enter Your Enter Email" name="Email">

        <label for="psw"> Password: </label>
        <input type="password" placeholder="Please Enter Passwrd" name="Passwrd">

        <label for="psw"> Repeat Password: </label>
        <input type="password" placeholder="Please Repeat Password" name="PsWrepeat">

        <label> National ID: </label>
        <input type="number" name="NationalID" placeholder="Please Enter Your National ID"/>

        <label> Age: </label>
        <input type="number" name="Age" placeholder="Please Enter Your Age">

        <label> Phone Number: </label>
        <input type="tel" name="Phone" value="+966">

        <label> City: </label>
        <input type="text" name="City" placeholder="Please Enter Your city"/>

        <div>
            <label> Gender: </label>
            <input type="radio" value="Male" name="Gender"> Male
            <input type="radio" value="Female" name="Gender"> Female
            </div>

        <label> Bio : </label>
        <textarea rows="5" cols="50" name="Bio" placeholder=" Such as: years of experience, education, languages spoken, skills … etc"> </textarea>

        <label> Upload a Photo (Optional): </label>
        <input type="file" name="photo" onchange="readURL(this)" accept="Image/*" />

        <div class="box terms">
            <input type="checkbox" name="Terms" required> &nbsp; I accept the terms and conditions.
        </div>

        <button type="submit" class="SignUp__submit" name="submit">Sign Up</button>

        </form>
        </div>

    </section>

    <footer>
        <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
      </footer>

</body>
</html>