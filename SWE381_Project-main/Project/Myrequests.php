<?php
  session_start();
  if(!isset($_SESSION['Email'])){
    header:("Location:../Plogin.php");
    exit();
  }


    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','projectdatabase2');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD))
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");

$parentEmail = $_SESSION['Email'];
$parentID;

if(isset($_POST['edit']))
{
  $childname = $_POST["childname"];
  $childage = $_POST["childage"];

  $nameArray = explode(",", $childname);
  $ageArray = explode(",", $childage);
  $childArray = array_combine($ageArray, $nameArray);

  $service = $_POST["service"];
  $date = date('Y-m-d', strtotime($_POST['date']));
  $stime = $_POST["stime"];
  $etime = $_POST["etime"];

  $sql = "SELECT * FROM parent WHERE Email = '$parentEmail' ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
    while ($row = mysqli_fetch_assoc($result)){
      $parentID = $row['ParentId'];
    }


    $sql = "INSERT INTO request (checkParent,TypeOfService, SitterDate, SessionDurationStart , SessionDurationEnd , ParentId)
                      VALUES ('0','$service','$date','$stime','$etime','$parentID')";
    $result = mysqli_query($conn, $sql);
    //$lastReqID = "SELECT * FROM rquest LAST_INSERT_ID()";
    $lastReqID = mysqli_insert_id($conn);

  foreach ($childArray as $key => $value) {
    $sql = "INSERT INTO child(childName, childAge, ReqId)
                    VALUES ('$value','$key','$lastReqID')";
    $result = mysqli_query($conn, $sql);
  }

    if($result)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: Myrequests.php");
    }
    else
    {
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: Myrequests.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>myrequests</title>
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
      <li class="menuItem"><a class="status" href="#new-requests">New request</a></li>
      <li class="menuItem"><a class="status" href="#pending-requests">Pending requests</a></li>
      <li class="menuItem"><a class="status" href="#current-Requests">Current requests</a></li>
      <li class="menuItem"><a class="status" href="#previous-requests">Previous requests</a></li>
      <li class="menuItem" id="logout"><a href="#divTwo"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/4263/4263207.png" alt="logout icon"> </a></li>
      <li class="menuItem" id="profile"><a href="ParentProfile.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2102/2102633.png" alt="profile icon"> </a></li>
      <li class="menuItem" id="home"><a href="parentHome.php"> <img class="menu-icon" src="https://cdn-icons-png.flaticon.com/512/2626/2626923.png" alt="home icon"> </a></li>
    </ul>
  </div>



  <div id="new-requests">
        <h1>New Request</h1>

        <?php
                   if(isset($_SESSION['status']))
                   {
                       ?>
                           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                       <?php
                       unset($_SESSION['status']);
                   }
               ?>


    <form class="modalform" action="#" method="post">
      <div class="leftinfo">
        <label>Child Name: <br>
          <span class="note">(note:if you have more then one,<br> please seperate each name with a comma)</span><br>
          <input class="modal" placeholder="Your name.." type="text" name="childname" ><br> </label>
        <label>Child Age:<br>
          <span class="note">(note:if you have more then one,<br> please seperate each age with a comma)</span> <br>
          <input class="modal" placeholder="Your age.." type="text" name="childage" ><br> </label>
        <label>Type of service: <br>
          <select name="service" id="cars">
    <option value="Hw">Helping in homework</option>
    <option value="park">Taking her/him to the park</option>
    <option value="special">a child with special need</option>
    <option value="food">cooking food for them</option>
  </select>
        </label>
      </div>

      <div class="rightinfo">
        <label>
          sitter date: <br> <input class="modal" id="date" type="date" name="date" ><br> </label>
        <label>Session Duration:<br></label>
          <label>start: <input class="modal" type="time" name="stime" > <br></label>
          <label><span class="enddate">end:</span> <input class="modal" type="time" name="etime" ><br> </label>
        <br>

        <input class="modal" type="submit" name="edit" value="submit">
      </div>
    </form>
  </div>



  <div id="pending-requests">
    <h1>Pending requests & Offers</h1>
    <div class="slider">
      <input type="radio" name="testimonial" id="t-1">
      <input type="radio" name="testimonial" id="t-2" checked>
      <input type="radio" name="testimonial" id="t-3">
      <input type="radio" name="testimonial" id="t-4">
      <input type="radio" name="testimonial" id="t-5">

      <div class="testimonials">
      <?php
        $sql = "SELECT * FROM request WHERE checkParent='0'";
        $result = mysqli_query($conn, $sql);
        $i = 0;
        if (mysqli_num_rows($result) > 0)
          while ($row = mysqli_fetch_assoc($result) ) {
            $requestID = $row['IdReq'];
            if($row['checkParent'] == 1)
            continue;
            $i++;
        echo "<div class=\"item\" id=\"goat".$i."\" for=\"t-".$i."\">";
        echo "<h2>request #". $requestID . "<a href=\"#divOne\">edit or cancel</a> </h2>";
        echo "<form class=\"itemForm\" action=\"Myrequests.php\" method=\"post\">";
          //<?php
            $sqlO = "SELECT * FROM offer1 WHERE ReqId = '$requestID'  && checkof = '0'";
            $resultO = mysqli_query($conn, $sqlO);
            if (mysqli_num_rows($resultO) > 0){
            echo "<ul>";
            while ($rowO = mysqli_fetch_assoc($resultO)){
                if($rowO['checkof'] == 1)
                continue;
                $babysitterName = $rowO['BabysitterName'];
                $price = $rowO['Price'];
                $offerID = $rowO['OfferId'];

            echo "<li class=\"bsname\">" . $babysitterName . $price . "SR <a href=\"BabysitterProfile.php\">view details</a> <br>";
            echo "<button class=\"btn1\" type=\"submit\" name=\"accept\">accept</button>";
             echo "<button class=\"btn2\" type=\"submit\" name=\"reject\">reject</button>";
             echo "</li>";
            }
             echo "</ul>";
          }
          echo "</form>";
          echo "</div>";
        }
            if(isset($_POST['accept'])){
              //$sql = "DELETE FROM request WHERE $row[IdReq]";
              $sql = "UPDATE request SET checkParent='1' WHERE $requestID";
              $result = mysqli_query($conn, $sql);
              $sql = "UPDATE offer1 SET checkof = '2' WHERE $requestID AND  OfferId = !$offerID";
              $result = mysqli_query($conn, $sql);

              echo '<script> alert("offer has been accepted successfully")</script>';
            }

            if(isset($_POST['reject'])){
              $condition = '<script> confirm("Do you want to reject ?")</script>';
              echo $condition;
              if ($condition){
                $sql = "UPDATE offer1 SET checkof='1' WHERE OfferId = $offerID";
                $result = mysqli_query($conn, $sql);
              }
            }

            //echo "</div>";

      ?>
      </div>

      <div class="dots">
        for ($j=1; $j <= $i ; $j++) {
          echo "<label for=\"t-".$j."\"></label>";
        }
      </div>

    </div>
  </div>


 <div id="current-Requests">
    <h1>Current Requests</h1>
    <div class="slider">
      <input type="radio" name="testimonial" id="d-1">
      <input type="radio" name="testimonial" id="d-2" checked>
      <input type="radio" name="testimonial" id="d-3">
      <input type="radio" name="testimonial" id="d-4">
      <input type="radio" name="testimonial" id="d-5">

      <div class="testimonials" id="cur-requests">
        <?php
          $sql = "SELECT * FROM request WHERE checkParent='1'";
          $result = mysqli_query($conn, $sql);
          $i = 0;
          if (mysqli_num_rows($result) > 0)
            while ($row = mysqli_fetch_assoc($result)){
              //if ($row[SitterDate] < )
              $requestID = $row['IdReq'];
              $reqDate = $row['SitterDate'];
              $diffDate = "SELECT DATEDIFF( '$reqDate' , CURRENT_DATE())";
                if ($diffDate >= 0){
              $sqlchild = "SELECT * FROM child WHERE ReqId = '$requestID' ";
              $resultchild = mysqli_query($conn, $sqlchild);
              $str = "";
              while ($rowchild = mysqli_fetch_assoc($resultchild)) {
                $str = $str . ($rowchild['childName'] . " | ");
              }
              $BSname;
              $sqloffer = "SELECT * FROM offer1 WHERE ReqId = '$requestID' ";
              $resultoffer = mysqli_query($conn, $sqloffer);
              if (mysqli_num_rows($resultoffer) > 0){
              while($rowBS = mysqli_fetch_assoc($resultoffer))
              $BSname = $rowBS['BabysitterName'];}
              $i++;


          echo "<div class=\"item\" id=\"offwhite".$i."\" for=\"d-".$i."\">";
          echo "<h2>request ".$requestID."</h2>";
          echo "<p>Child/children name:". $str ."</p>";
          echo "<p>Babysitter name:". $BSname."</p>";
          echo "<p>Time: ".$reqDate."</p>";
          echo "<a href=\"BabysitterProfile.html\">view babysitter details</a>";
        echo "</div>";
      }
    }
        ?>
      </div>
      <div class="dots">
        <label for="d-1"></label>
        <label for="d-2"></label>
        <label for="d-3"></label>
        <label for="d-4"></label>
        <label for="d-5"></label>
      </div>
    </div>
  </div>




  <div id="previous-requests">
    <h1>Previous Requests</h1>
    <div class="slider">
      <input type="radio" name="testimonial" id="x-1" checked>
      <input type="radio" name="testimonial" id="x-2">
      <input type="radio" name="testimonial" id="x-3">
      <input type="radio" name="testimonial" id="x-4">
      <input type="radio" name="testimonial" id="x-5">

      <div class="testimonials" id="prev-requests">

        <?php
        $sql = "SELECT * FROM request WHERE checkParent='1'";
        $result = mysqli_query($conn, $sql);
        $i = 0;
        if (mysqli_num_rows($result) > 0)
          while ($row = mysqli_fetch_assoc($result)){

            $requestID = $row['IdReq'];
            $reqDate = $row['SitterDate'];
            $reqTime = $row['SessionDurationEnd'];
            $diffDate = "SELECT DATEDIFF( '$reqDate' , CURRENT_DATE())";
            $diffTimeStr = "SELECT TIMEDIFF( '$reqTime' , CURRENT_TIME())";
            $diffTime = intval( $diffTimeStr);

            if ($diffDate < 0){
            $sqlchild = "SELECT * FROM child WHERE ReqId = $requestID ";
            $resultchild = mysqli_query($conn, $sqlchild);
            $str = "";
            while ($rowchild = mysqli_fetch_assoc($resultchild)) {
              $str = $str + ($rowchild['childName'] + " | ");
            }

            $sqloffer = "SELECT * FROM offer1 WHERE ReqId = $requestID ";
            $resultoffer = mysqli_query($conn, $sqloffer);
            $rowBS = mysqli_fetch_assoc($resultoffer);
            $BSname = $rowBS['BSname'];
            $i++;

            echo "<div class=\"item\" id=\"goat".$i."\" for=\"x-".$i."\">";
            echo "<h2>request no.".$requestID." </h2>";
            echo "<form action=\"Myrequests.php\" method=\"post\">";
            echo "<p>Child/children name:".$str."</p>";
            echo "<p>Session date:".$reqDate. "</p>";
            echo "<p>babysitter name:".$BSname."</p>";
            echo "<p>rate: ⭐⭐⭐</p>";
            echo "<label>Review:<br>";
            echo "<textarea class=\"review\" name=\"review\" rows=\"3\" cols=\"35\"></textarea></label><br>";
            echo "<button class=\"btn\" type=\"submit\" name=\"button\">submit</button>";
            echo "</form>";
        echo "</div>";
      }
    }
         ?>

      </div>
      <div class="dots">
        <label for="x-1"></label>
        <label for="x-2"></label>
        <label for="x-3"></label>
        <label for="x-4"></label>
        <label for="x-5"></label>
      </div>

    </div>
  </div>

  <div class="footer">
    <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
  </div>



<!-- additional containers-->

  <?php

              echo "<div class=\"overlay\" id=\"divOne\">";
                echo "<div class=\"wrapper\">";
                  echo"<h2>Edit your Request</h2><a class=\"close\" href=\"#pending-requests\">&times;</a>";
                  echo "<div class=\"content\">";
                    echo "<div class=\"container\"";
                      $reqID;
                      $typeOS;
                      $Sitterdate;
                      $sitterStart;
                      $sitterEnd;
                      $strName = "";
                      $strAge = "";
                      $sqledit = "SELECT * FROM request WHERE checkParent='0'";
                      $resultedit = mysqli_query($conn, $sqledit);
                      if (mysqli_num_rows($resultedit) > 0){
                      while ($rowE = mysqli_fetch_assoc($resultedit)){
                        $reqID = $rowE['IdReq'];
                        $typeOS = $rowE['TypeOfService'];
                        $Sitterdate=$rowE['SitterDate'];
                        $sitterStart=$rowE['SessionDurationStart'];
                        $sitterEnd=$rowE['SessionDurationEnd'];

                        $sqledit1 = "SELECT * FROM child WHERE ReqId = '$reqID'";
                        $resultedit1 = mysqli_query($conn, $sqledit1);

                        if (mysqli_num_rows($resultedit1) > 0){
                        while ($rowE = mysqli_fetch_assoc($resultedit1)){
                          $strName = $strName . $rowE['childName'].',';
                          $strAge = $strAge . $rowE['childAge'].',';
                        }
                        }
                      }
                      }


                      echo "<form class=\"modalform\" action=\"#pending-requests\" method=\"get\">";
                        echo "<div class=\"leftinfo\">";
                          echo "<label>Child/children Names: <br>";
                            echo "<input class=\"modal\" placeholder=\"Your name..\" type=\"text\" name=\"childname\" value=\"".$strName."\" autocomplete=\"off\"><br> </label>";
                          echo "<label>Child/children Age: <br>";
                            echo "<input class=\"modal\" placeholder=\"Your age..\" type=\"text\" name=\"childage\" value=\"".$strAge."\"><br> </label>";
                          echo "<label>Type of service: <br>";
                          echo "<input class=\"modal\" placeholder=\"service..\" type=\"text\" name=\"service\" value=\"".$typeOS."\"><br> </label>";
                          echo "</label>";
                          echo "label>Notes:<br>";
                          echo "<textarea class=\"modalarea\" name=\"yourMessage\" rows=\"4\" cols=\"30\"></textarea></label>";
                        echo "</div>";

                        echo "<div class=\"rightinfo\">";
                          echo "<label>";
                            echo "sitter date: <input class=\"modal\" type=\"date\" name=\"date\" value=\"".$Sitterdate."\"><br> </label>";
                          echo "<label>Session Duration:<br> </label>";
                            echo "<label> start: <input class=\"modal\" type=\"time\" name=\"time\" value=\"".$sitterStart."\"> <br> </label>";
                            echo "<label> <span class=\"enddate\">end: </span> <input class=\"modal\" type=\"time\" name=\"time\" value=\"".$sitterEnd."\"><br> </label>";
                          echo "<br>";

                          echo "<button class=\"modal\" type=\"submit\" name=\"update1\" >edit</button>";
                          echo "<button class=\"danger\" id=\"deletereq\" type=\"submit\" name=\"edit\" >delete request</button>";
                      echo "</div>";
                    echo "</form>";

                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo " </div>";

            if(isset($_GET['update1']))
            {
              $childname = $_POST["childname"];
              $childage = $_POST["childage"];

              $nameArray = explode(",", $childname);
              $ageArray = explode(",", $childage);
              $childArray = array_combine($ageArray, $nameArray);

              $service = $_POST["service"];
              $date = date('Y-m-d', strtotime($_POST['date']));
              $stime = $_POST["stime"];
              $etime = $_POST["etime"];

              $sql = "SELECT * FROM parent WHERE Email = '$parentEmail' ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0)
                while ($row = mysqli_fetch_assoc($result)){
                  $parentID = $row['ParentId'];
                }

            $sql = "UPDATE request SET checkParent='0',TypeOfService='$service', SitterDate = '$date', SessionDurationStart = '$stime' , SessionDurationEnd = '$etime', ParentId = '$parentID'";
                $result = mysqli_query($conn, $sql);
                //$lastReqID = "SELECT * FROM rquest LAST_INSERT_ID()";
                $lastReqID = mysqli_update_id($conn);

              foreach ($childArray as $key => $value) {
                $sql ="UPDATE request SET childName = '$value', childAge = '$key', ReqId = '$reqID' ";
                $result = mysqli_query($conn, $sql);
              }

                if($result)
                {
                    $_SESSION['status'] = "Date values Inserted";
                    header("Location: Myrequests.php");
                }
                else
                {
                    $_SESSION['status'] = "Date values Inserting Failed";
                    header("Location: Myrequests.php");
                }
            }

   ?>
  <div class="overlay" id="divTwo">
    <div class="wrapper" id="wrapperlogout">
      <h2>Log out</h2><a class="close" href="#Myrequests.php">&times;</a>
      <div class="content">
        <div class="container">
          <p>are you sure you want to log-out? <br> </p>
          <a href="Home.php"> <button type="submit" name="button" class="danger" id="yes-logout">Yes</button> </a>
          <a href="Myrequests.php"> <button type="submit" name="button" id="no-logout">No</button> </a>
        </div>
      </div>
    </div>
  </div>


</body>

</html>
