<?php
  session_start();
    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','projectdatabase2');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD))
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");

    $BSEmail =$_SESSION['Email'];




?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>My offers</title>
  <link rel="stylesheet" href="MyrequestsStyles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Coiny&family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href=Images\LOGO.png>
</head>

<body>
  <div class="logo-container">
    <img src="Images\LOGO.png" alt="Website Logo" class="LogoPicture">
  </div>

  <div class="menu-conatiner">
    <ul class="menu">
      <li class="menuItem"><a class="status" href="#new-requests">Requests list</a></li>
      <li class="menuItem"><a class="status" href="#pending-requests">My offers status</a></li>
      <li class="menuItem"><a class="status" href="#current-Requests">Current offers</a></li>
      <li class="menuItem"><a class="status" href="#previous-requests">Previous offers</a></li>
      <li class="menuItem" id="logout"><a href="#divTwo"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/4263/4263207.png" alt="logout icon"> </a></li>
      <li class="menuItem" id="profile"><a href="sitterManageProfile.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2102/2102633.png" alt="profile icon"> </a></li>
      <li class="menuItem" id="home"><a href="BabySitter.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2626/2626923.png" alt="home icon"> </a></li>

    </ul>
  </div>


    <div id="new-requests">
      <h1>Babysitting Requests</h1>
      <div class="slider">
        <input type="radio" name="testimonial" id="x-1" checked>
        <input type="radio" name="testimonial" id="x-2">
        <input type="radio" name="testimonial" id="x-3">
        <input type="radio" name="testimonial" id="x-4">
        <input type="radio" name="testimonial" id="x-5">


        <div class="testimonials" id="babysitter-requests">

          <?php
          $requestID1;
            $sql = "SELECT * FROM request WHERE checkParent='0'";
            $result = mysqli_query($conn, $sql);
            $i = 0;
            if (mysqli_num_rows($result) > 0)
              while ($row = mysqli_fetch_assoc($result)) {
                $requestID1 = $row['IdReq'];
                $reqDate = $row['SitterDate'];
                $startTime = $row['SessionDurationStart'];
                $endTime = $row['SessionDurationEnd'];
                $sqlchild = "SELECT * FROM child WHERE ReqId = $requestID1 ";
                $resultchild = mysqli_query($conn, $sqlchild);
                $str = " | "; $strAge = " | ";
                while ($rowchild = mysqli_fetch_assoc($resultchild)) {
                  $str = $str . ($rowchild['childName'] . " | ");
                  $strAge = $strAge . ($rowchild['childAge'] . " | ");
                }
                $i++;

          echo "<div class=\"item\" id=\"offwhite".$i."\" for=\"x-".$i."\">";
              echo "<h2>request no.#". $requestID1 ." </h2>";
              echo "<p>Child/children name:".$str."</p>";
              echo "<p>Child/children age:".$strAge."</p>";
              echo "<p>Session date: ".$reqDate."</p>";
              echo "<p>Session time: ".$startTime." to ".$endTime."</p>";
              echo "<form action=\"#\" method=\"post\">";
              echo "<label>Price(range: 30 to 190 SR):<br>";
              echo "<textarea name=\"price\" rows=\"1\" cols=\"5\"></textarea>";
              //echo "<br><input placeholder=\"offer Price..\" type=\"text\" name=\"price\" ><br></label>";
              echo "<button class=\"btn\" type=\"submit\" name=\"button\">send offer</button>";
              echo "</form>";
          echo "</div>";
        }

        $babysitterId;
        $BSFirstName;

        $sql = "SELECT * FROM babysitter WHERE Email ='$BSEmail' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
          while ($row = mysqli_fetch_assoc($result)){
            $babysitterId = $row['UserId'];
            $BSFirstName = $row['FirstName'];
          }

          if(isset($_POST['button']))
          {
            $price = $_POST["price"];


              $sql = "INSERT INTO offer1 (BabysitterName,Price, BSId, ReqId)
                                VALUES ('$BSFirstName','$price','$babysitterId','$requestID1')";
              $result = mysqli_query($conn, $sql);
              //$lastReqID = "SELECT * FROM rquest LAST_INSERT_ID()";
              $lastReqID = mysqli_insert_id($conn);

              if($result)
              {
                  $_SESSION['status'] = "Date values Inserted";
                  header("Location: myoffers.php");
              }
              else
              {
                  $_SESSION['status'] = "Date values Inserting Failed";
                  header("Location: myoffers.php");
              }
          }
          ?>
        </div>

        <div class="dots">
          for ($j=1; $j <= $i ; $j++) {
            echo "<label for=\"x-".$j."\"></label>";
          }
        </div>

      </div>
    </div>

  <div id="pending-requests">
    <h1>My offers Status</h1>
    <div class="slider">
      <input type="radio" name="testimonial" id="d-1">
      <input type="radio" name="testimonial" id="d-2" checked>
      <input type="radio" name="testimonial" id="d-3">
      <input type="radio" name="testimonial" id="d-4">
      <input type="radio" name="testimonial" id="d-5">

      <div class="testimonials" id="offer-status">
        <?php
          $sql = "SELECT * FROM request";
          $result = mysqli_query($conn, $sql);
          $i = 0;
          if (mysqli_num_rows($result) > 0)
            while ($row = mysqli_fetch_assoc($result)) {
              $requestID = $row['IdReq'];
              $reqDate = $row['SitterDate'];
              $checkParent = $row['checkParent'];
              $startTime = $row['SessionDurationStart'];
              $endTime = $row['SessionDurationEnd'];
              $sqlchild = "SELECT * FROM child WHERE ReqId = $requestID";
              $resultchild = mysqli_query($conn, $sqlchild);
              $str = " | "; $strAge = " | ";
              while ($rowchild = mysqli_fetch_assoc($resultchild)) {
                $str = $str . ($rowchild['childName'] . " | ");
                $strAge = $strAge . ($rowchild['childAge'] . " | ");
              }
              $sqlBS = "SELECT * FROM offer1 WHERE ReqId = '$requestID' AND BSId = '$babysitterId'";
              $resultBS = mysqli_query($conn, $sqlBS);
              while ($rowBS = mysqli_fetch_assoc($resultBS)) {
                $priceO = $rowBS['Price'];
                $isRejected = $rowBS['checkof'];
                if ($checkParent == '0' && $isRejected == '0')
                  $OfferStatus = "pending";
                else if ($checkParent == '1' && $isRejected == '2')
                  $OfferStatus = "accepted";
                else if ($isRejected == '1')
                  $OfferStatus = "rejected";
              $i++;
              echo "<div class=\"item\" id=\"goat".$i."\" for=\"d-".$i."\">";
              echo "<h2>request no.#".$requestID."</h2>";
              echo "<p>Child/children name: <br>".$str."</p>";
              echo "<p>Child/children age: ".$strAge."</p>";
              echo "<p>Price: ".$priceO."SR</p>";
              echo "<h3>Offer status: ".$OfferStatus."</h3>";
              echo "</div>";
            }
      }
      ?>
      </div>
      <div class="dots">
        <div class="dots">
          for ($j=1; $j <= $i ; $j++) {
            echo "<label for=\"d-".$j."\"></label>";
          }
      </div>
    </div>
  </div>

  <div id="current-Requests">
    <h1>Current Requests</h1>
    <div class="slider">
      <input type="radio" name="testimonial" id="t-1" checked>
      <input type="radio" name="testimonial" id="t-2" >
      <input type="radio" name="testimonial" id="t-3" >
      <input type="radio" name="testimonial" id="t-4" >
      <input type="radio" name="testimonial" id="t-5" >

      <div class="testimonials" id="current-requests">
        <?php
        $sql = "SELECT * FROM request WHERE checkParent ='1'";
        $result = mysqli_query($conn, $sql);
        $i = 0;
        if (mysqli_num_rows($result) > 0)
          while ($row = mysqli_fetch_assoc($result)) {
            $requestID = $row['IdReq'];
            $reqDate = $row['SitterDate'];
            $startTime = $row['SessionDurationStart'];
            $endTime = $row['SessionDurationEnd'];
            $sqlchild = "SELECT * FROM child WHERE ReqId = $requestID";
            $resultchild = mysqli_query($conn, $sqlchild);
            $str = " | "; $strAge = " | ";
            while ($rowchild = mysqli_fetch_assoc($resultchild)) {
              $str = $str . ($rowchild['childName'] . " | ");
              $strAge = $strAge . ($rowchild['childAge'] . " | ");
            }
            $sqlBS = "SELECT * FROM offer1 WHERE ReqId = '$requestID' AND BSId = '$babysitterId'";
            $resultBS = mysqli_query($conn, $sqlBS);
            while ($rowBS = mysqli_fetch_assoc($resultBS)) {
              $priceO = $rowBS['Price'];
              $diffDate = "SELECT DATEDIFF( '$reqDate' , CURRENT_DATE())";
                if ($diffDate >= 0){

          echo "<div class=\"item\" id=\"offwhite".$i."\" for=\"t-".$i."\">";
            echo "<h2>request no.#".$requestID."</h2>";
            echo "<p>Child/children name: ".$str."</p>";
            echo "<p>Session time: ".$startTime." to ".$endTime."</p>";
            echo "<p>Price: ".$priceO."SR</p>";
          echo "</div>";
        }
        }
      }
?>
      </div>
      <div class="dots">
        for ($j=1; $j <= $i ; $j++) {
                  echo "<label for=\"t-".$j."\"></label>";
                }
      </div>
    </div>
  </div>

  <div id="previous-requests">
  <h1>Previous Jobs</h1>
  <div class="slider">
    <input type="radio" name="testimonial" id="r-1" checked>
    <input type="radio" name="testimonial" id="r-2">
    <input type="radio" name="testimonial" id="r-3">
    <input type="radio" name="testimonial" id="r-4">
    <input type="radio" name="testimonial" id="r-5">

    <div class="testimonials" id="prev-jobs">
      <?php
      $sql = "SELECT * FROM request WHERE checkParent ='1'";
      $result = mysqli_query($conn, $sql);
      $i = 0;
      if (mysqli_num_rows($result) > 0)
        while ($row = mysqli_fetch_assoc($result)) {
          $requestID = $row['IdReq'];
          $reqDate = $row['SitterDate'];
          $startTime = $row['SessionDurationStart'];
          $endTime = $row['SessionDurationEnd'];
          $sqlchild = "SELECT * FROM child WHERE ReqId = '$requestID'";
          $resultchild = mysqli_query($conn, $sqlchild);
          $str = " | "; $strAge = " | ";
          while ($rowchild = mysqli_fetch_assoc($resultchild)) {
            $str = $str . ($rowchild['childName'] . " | ");
            $strAge = $strAge . ($rowchild['childAge'] . " | ");
          }
          $sqlBS = "SELECT * FROM offer1 WHERE ReqId = '$requestID' AND BSId = '$babysitterId'";
          $resultBS = mysqli_query($conn, $sqlBS);
          while ($rowBS = mysqli_fetch_assoc($resultBS)) {
            $priceO = $rowBS['Price'];
            $diffDate = "SELECT DATEDIFF( '$reqDate' , CURRENT_DATE())";
              if ($diffDate < 0){

          echo "<div class=\"item\" id=\"goat".$i."\" for=\"r-".$i."\">";
          echo "<h2>request no.#".$requestID."</h2>";
          echo "<p>Child/children name: ".$str."</p>";
          echo "<p>Session date: ".$reqDate."</p>";
          echo "<p>Session time: ".$startTime." to ".$endTime."</p>";
          echo "<p>Price: ".$priceO."SR</p>";
          echo "<p>rate: ⭐⭐⭐</p>";
          echo "<p>Review: Very nice but she isn't know that much in math</p><br>";
      echo "</div>";
    }
  }
}
      ?>


    </div>
    <div class="dots">
      for ($j=1; $j <= $i ; $j++) {
        echo "<label for=\"r-".$j."\"></label>";
      }
    </div>

  </div>
</div>

<div class="footer">
  <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
</div>


<!-- additional containers-->

  <div class="overlay" id="divTwo">
    <div class="wrapper" id="wrapperlogout">
      <h2>Log out</h2><a class="close" href="#logo-container">&times;</a>
      <div class="content">
        <div class="container">
          <p>are you sure you want to log-out? <br> </p>
          <a href="Home.php"> <button type="submit" name="button" class="danger" id="yes-logout">Yes</button> </a>
          <a href="myoffers.php"> <button type="submit" name="button" id="no-logout">No</button> </a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
