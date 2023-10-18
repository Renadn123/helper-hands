<!DOCTYPE html>
<html>
<head>
  <title>Parent</title>
  <!--Meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--Font-->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!--External CSS-->
  <link rel="stylesheet" href="parent-home.css">
  <link rel="shortcut icon" type="image/x-icon" href=Images\LOGO.png>

</head>
<body>
      <div class="logo-container">
        <img src="Images\LOGO.png" alt="Website Logo" class="LogoPicture">
  </div>

  <header class="header">
    <nav class="navbar navbar-expand-lg">

        <div class="collapse navbar-collapse mt-3" id="navbarNav">
          <ul class="navbar-nav h6 p-0">
            <li class="nav-item">
            </li>
            <li class="nav-item">
              <a class="nav-link nav-li" href="#aboutus" id ="itemmenu1">About us&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-li" href="#locationContainer" id ="itemmenu2">contact us & location&nbsp;</a>
            </li>
            <a class="text-decoration-none text-light" href="Home.php" id="SignInAnchor"><button id="signInBtn" class=""> Logout</button></a>

          </ul>
        </div>
          <button class="navbar-toggler float-left mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation" id="sidemenu-btn">
            <span class="navbar-toggler-icon">&#9776;</span>
          </button>
      </div>
  </nav>
</header>
  <span id="header"></span>
    <img src="../Images/PinkPath2.png" id="bcPinkPath">
    <div id="container" class="d-flex flex-lg-row flex-column p-sm-5 p-lg-5">
      <div id="textDiv" class="d-flex">
          <p><strong>Hello in HELPERHANDS</strong></p>
          <p>Please,choose one </p>
          <a class="text-decoration-none" href="Myrequests.php"><button id="join-us-Btn"> My Requests</button></a>
          <a class="text-decoration-none" href="ParentProfile.php"><button id="join-us-Btn"> My Profile</button></a>

      </div>
      <img src="Images/Untitled design (4).png" class="align-self-sm-center">
    </div>

    <div class="container pt-5 mt-5" id="aboutus">
      <h1 class="text-center titles mt-4" id="forparent">For Parent</h1>
      <div class="d-flex pt-5 mt-3 justify-content-around">
        <div class="align-self-center" id="AboutUsText">
          <p><strong> Your children are our children 👪 </strong></p>
          <p>
            Due to the interest of the platform management in providing the highest qualification for babysitters and in order to provide the highest standards of safety for your children, we receive requests gradually and sequentially to ensure that the quality of the service provided,
          </p>
        </div>
        <img src="Images/Untitled design (7).png" id="about-us-img">
      </div>
    </div>

    </div>

    <div id="locationContainer">
      <h4>A Price To Suit Everyone</h4>
      <p class="text-center mt-3 mb-4" id="placeText"> We are based in Saudi Arabia and offer a wide range of prices. With our <br> website, you will definitely find the perfect babysitter for your child along <br> with your suited price. </p>
      <i class="bi bi-geo-alt-fill mt-3" id="locationIcon"></i>
      <p id="location">Saudi Arabia</p>
    </div>

    <footer>
      <div class="">
        <a class="contact text-decoration-none" href="tel:966544409874"><i class="bi bi-telephone-fill"></i></a>
        <span>&nbsp;</span>
        <a class="contact text-decoration-none" href="mailto:helperhands@gmail.com"><i class="bi bi-envelope-fill"></i></a>
      </div>
      <h6 class="m-auto">HELPERHANDS</h6>
      <hr>
      <p>&copy; by helperhands. all rights reserved. <a href="mailto:helperhands@gmail.com">Contact us.</a> </p>
    </footer>

</body>
</html>
