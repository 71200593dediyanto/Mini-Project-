<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript" src="index.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/tombol.css?v=<?php echo time(); ?>">

  <title>GoFit</title>
  <link rel="shortcut icon" href="logo/Logo2.png" type="image/x-icon">

</head>

<?php
if (!isset($_SESSION["login"])) {
?>

  <body onload="undisplay()">
  <?php

} else {
  ?>

    <body onload="transform()">
    <?php
  }

    ?>

    <header class="topnav">
      <a class="logolink" href="index.php"><img class="logoimage" src="logo/Logo1.png"></a>

      <nav class="header-center">
        <a href="index.php">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <div class="search-container" style="padding-left:500px;">
          <div class="searcing">
          <a href="search.php"><i class="fa fa-search"></i></a>
          </div>
        </div>
      </nav>

      <div class="signinout">
        <a id="signinout" href="adminlogin.php">
          <p id="content-signinout" style="font-size:24px;">
            Login
            <i class="fa fa-sign-in" aria-hidden="true" style="font-size:34px;"></i>
          </p>
        </a>
      </div>



    </header>


    <div class="welcome-area" id="welcome">
      <div class="header-text">
        <div class="deskripsi-home">
          <h1 class="content-left">Welcome to <em>GoFit</em></h1>
          <p class="welcome-paragraph content-left">Aplikasi olahraga terbaru yang memiliki informasi lengkap tentang bidang olahraga dan bela diri. <br> Disini kamu dapat belajar cara untuk mempersehat tubuh maupun jiwa.
          </p>
        </div>
        <a href="kategoriWorkout.php" class="main-button-slider content-left" id="button1">Lihat Workouts</a>
        <a href="kategoriTraining.php" class="main-button-slider content-left" id="button2">Lihat Training</a>

        <div class="homeimg">
          <img id="before1" alt="">
          <img id="before2" alt="">
        </div>
      </div>
    </div>

    <footer>
      <div class="logo">
        <img src="logo/Logo1.png" alt="">
        <p>Wellness for the People</p>
      </div>

      <div class="term">
        <a href="#"><span>Term of Use</span></a>
        <br>
        <a href="#"><span>Privacy Policy</span></a>
        <br>
        <a href="#"><span>Reference</span></a>
        <br>
      </div>

      <div class="footermedia">
        <p>Follow us</p>
        <a href="#" class="fa fa-facebook fa-2x"></a>
        <a href="#" class="fa fa-twitter fa-2x"></a>
        <a href="#" class="fa fa-youtube fa-2x"></a>
        <a href="#" class="fa fa-instagram fa-2x"></a>
      </div>

      <div class="copyright">
        <span>Copyright &copy; All rights reserved | made by </span>
        <span>Dedi Yanto, Maverick Mikolas, Michelle Shannen </span>
      </div>

    </footer>

    </body>

</html>