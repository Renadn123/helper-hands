<?php
 session_start();
 if(!isset($_SESSION['Email'])){
  header("Location:Plogin.php");

}
 require_once 'db.php';
 $Email= $_SESSION['Email'];
 $query="SELECT * FROM `parent` WHERE Email= '$Email'";
 $result=mysqli_query($conn,$query);
 $data=mysqli_fetch_row($result);

?>

 <!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Parent profile page</title>
  <link rel="stylesheet" href="ProfileStyles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Coiny&family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>

<body>

  <div class="logo-container">
        <img src="Images/LOGO.png" alt="Website Logo" class="LogoPicture">
  </div>


  <div class="menu-conatiner">
    <ul class="menu">
      <li class="menuItem"><a class="status" href="Myrequests.html">My Requests</a></li>
      <li class="menuItem" id="logout"><a href="#divTwo"><img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/4263/4263207.png" alt="logout icon"> </a></li>
      <li class="menuItem" id="home"><a href="parentHome.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2626/2626923.png" alt="home icon"> </a></li>
    </ul>
  </div>



  <div id="profile">
    <div class="profile-image">
      <img class="left-image"
        src="https://img.freepik.com/free-vector/child-care-online-platform-abstract-concept-illustration_335657-4572.jpg?w=740&t=st=1664615827~exp=1664616427~hmac=a1c1120d6fadd16dad6fd49ebad66578664a479ec878e0bdc6d98d73a6cb0b5f" alt="profile image">
    </div>
    <div class="rightinfo">

      <div class="tile-button">
        <h1 class="profile-title">My Profile</h1>
        <a href="#divOne">
          <img class="edit-icon" alt="edit" src="https://cdn-icons-png.flaticon.com/512/5972/5972963.png">
        </a>
      </div>

      <form class="modalform" action="#" method="post">
        <div class="name-photo">
          <img class="profile-photo" src="https://cdn-icons-png.flaticon.com/512/5004/5004140.png" alt="profile photo">
          <div class="fullname">
          <div class="signUp">
          <form  action="EidtProfileParent.php" method="post">

          <?php
    echo"<br>";
    if(isset($_GET['error'])){
        if($_GET['error']=="none"){
            echo"<b><div style='color:red;'>".$_GET['error']."</div></b>"; 
        }
    }
echo "<br>";
?>
             <label class="firstname">First Name: <br> </label>
              <input class="modal" placeholder="Your first name.." type="text" name="FirstName" value="<?php echo $data[1] ;?>"required>
            <label class="lastname">Last Name: <br></label>
              <input class="modal" placeholder="Your last name.." type="text" name="LastName" value="<?php echo $data[2] ;?>" required>
          </div>
        </div>

        <div class="other-info">
          <label>Password: <br>
            <input class="modal" placeholder="Your password.." type="password" name="Passwrd" value="<?php echo $data[4] ;?>" required><br> </label>
          <label>Email: <br>
            <input class="modal" placeholder="Your Email.." type="email" name="Email" value="<?php echo $data[3] ;?>" required><br> </label>
          <label>City: <br>
            <select name="City" class="city" required>
            <option value="Riyadh">Riyadh</option>
                  <option value="Jeddah">Jeddah</option>
                  <option value="Dhahran"> Dhahran</option>
                  <option value="Makkah">Makkah</option>
                  <option value="Taif">Taif</option>
                  <option value="Khobar">Khobar</option>
                  <option value="Tabuk">Tabuk</option>
                  <option value="Yanbu">Yanbu</option>>
            </select>
          </label>
          <label> <br>Address:<br>
            <textarea class="modalarea" name="your Address..." rows="1" cols="30" disabled>Olaya, fourth street, building no.2 , apartment 20</textarea> <br></label>
        </div>
      </form>
      <a href="#divThree">delete my account</a>
      <div class="footer">
        <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
      </div>
    </div>
  </div>

  <?php
  if(isset($_POST['editdata'])){

    $newemail = $_POST['email'];
    $newfirstname = $_POST['firstname'];
    $nelastname = $_POST['lastname'];
    $newpassword = $_POST['password'];
    $newcity = $_POST['city'];

    $queryy = "UPDATE  parent SET Email = '$newemail', FirstName = '$newfirstname', LastName = '$nelastname', Passwrd = '$newpassword' , City = '$newcity' WHERE Email= '$Email'";
    $resultt = mysqli_query($conn,$queryy);
    header("refresh:ParentProfile.php?succ=edit;");

  }
  ?>
  <div class="overlay" id="divOne">
    <div class="wrapper">
      <h2>Edit your Profile</h2><a class="close" href="#">&times;</a>
      <div class="content">
        <div class="container">
          <form class="modalform" method="post">
            <div class="leftinfo1">
            <label class="firstname1">First Name: <br>
                <input class="modal" placeholder="Your first name.." type="text" name="firstname" value="<?php echo $data[1] ;?>"> <br> </label>
              <label class="lastname">Last Name: <br>
                <input class="modal" placeholder="Your last name.." type="text" name="lastname" value="<?php echo $data[2] ;?>"><br> </label>
              <label>Password: <br>
                <input class="modal" placeholder="Your password.." type="password" name="password" value="<?php echo $data[4] ;?>"><br> </label>
              <label>Change Profile Photo <br> </label>
              <input class="modal" type="file" onchange="" accept="Image/*" />
            </div>

            <div class="rightinfo1">
              <label>Email: <br>
                <input class="modal" placeholder="Your Email.." type="email" name="email" value="<?php echo $data[3] ;?>"><br> </label>
              <label>City: <br>
                <select name="city" class="city">
                  <option value="Riyadh">Riyadh</option>
                  <option value="Jeddah">Jeddah</option>
                  <option value="Dhahran"> Dhahran</option>
                  <option value="Makkah">Makkah</option>
                  <option value="Taif">Taif</option>
                  <option value="Khobar">Khobar</option>
                  <option value="Tabuk">Tabuk</option>
                  <option value="Yanbu">Yanbu</option>
                </select>
              </label>
              <label> <br>Address:<br>
                <textarea class="modalarea" name="your Address..." rows="2" cols="30">Olaya, fourth street, building no.2 , apartment 20</textarea> <br></label>
              <input class="modal" id="confirmm"  type="submit" name="editdata" value="Confirm">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="overlay" id="divTwo">
    <div class="wrapper" id="wrapperlogout">
      <h2>Log out</h2><a class="close" href="#logo-container">&times;</a>
      <div class="content">
        <div class="container">
          <p>are you sure you want to log-out? <br> </p>
          <a href="Home.php"> <button type="submit" name="button" class="danger" id="yes-logout">Yes</button> </a>
          <a href="#ParentProfile.php"> <button type="submit" name="button" id="no-logout">No</button> </a>
        </div>
      </div>
    </div>
  </div>
  <?php
          if(isset($_POST['del'])){
            $query = "DELETE FROM parent WHERE Email = '$Email'";
            $result = mysqli_query($conn,$query);
            session_destroy();
            header("Refresh:1");
                       
          }
          
          ?>

  <div class="overlay" id="divThree">
    <div class="wrapper" id="wrapperDelete">
      <h2>Delete Account</h2><a class="close" href="#logo-container">&times;</a>
      <div class="content">
        <div class="container">
          <p>are you sure you want to delete your account? <br> </p>
          <a href="Home.php"> <form method="post"><button name="del" type="submit"  class="danger" id="yes-logout">Delete</button></form> </a>
          <a href="ParentProfile.php"> <button type="submit" name="button" id="no-logout">Cancel</button> </a>
        </div>
      </div>
    </div>
  </div>

<script>

</script>
</body>

</html>