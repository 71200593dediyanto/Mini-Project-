<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/search.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>GoFit</title>
  <link rel="shortcut icon" href="logo/Logo2.png" type="image/x-icon">

  <?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "", "gofit");
  $query = "SELECT
  *
FROM
  pelatih
INNER JOIN detailpelatih ON pelatih.idPelatih = detailpelatih.idPelatih
INNER JOIN video ON video.idVideo = detailpelatih.idVideo
INNER JOIN ketegori ON ketegori.idKategori = video.idKategori";
  $result = mysqli_query($conn, $query);
  ?>
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
    
<body>
  <header class="topnav">
    <a class="logolink" href="home.html"><img class="logoimage" src="logo/Logo1.png"></a>

    <nav class="header-center">
      <a href="home.html">Home</a>
      <a href="kategoriWorkout.php">Workouts</a>
      <a href="kategoriTraining.php">Training</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </nav>

    <div class="search-container">
      <form action="search.php" method="get">
        <input type="search" name="cari" placeholder="Search Workouts...">
        <button type="submit" value="Submit" name="submit"><i class="fa fa-search"></i></button>
            <br>
            <input type="radio" name="kategori" value="tipe_kategori" onclick="validasi()"> Tipe Kategori
            <input type="radio" name="kategori" value="nama_kategori" onclick="validasi()"> Nama Kategori
            <input type="radio" name="kategori" value="kesulitan" onclick="validasi()"> Tingkat Kesulitan
            <input type="radio" name="kategori" value="nama" onclick="validasi()"> Nama Video
            </form>
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


    </div>
  </header>
  <main>

    <?php
    if (isset($_GET['submit'])) {
      if (isset($_GET['kategori'])) {
        $var = $_GET['kategori'];
        if (isset($var)) {
          if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];

            if ($var == "tipe_kategori") {

              $sql = "SELECT * FROM ketegori INNER JOIN video ON ketegori.idKategori = video.idKategori WHERE tipe_kategori LIKE '$cari%'";
              $result = mysqli_query($conn, $sql);
              Search($result);
            } elseif ($var == "nama_kategori") {


              $sql = "SELECT * FROM ketegori INNER JOIN video ON ketegori.idKategori = video.idKategori WHERE namaKategori LIKE'$cari%'";
              $result = mysqli_query($conn, $sql);

              Search($result);
            } elseif ($var == "kesulitan") {

              $sql = "SELECT * FROM video WHERE kesulitan LIKE'$cari%'";
              $result = mysqli_query($conn, $sql);
              Search($result);
            } elseif ($var == "nama") {



              $sql = "SELECT * FROM video WHERE namaVideo LIKE'$cari%'";

              $result = mysqli_query($conn, $sql);
              Search($result);
            }
          }
        }
      } else {
        if (isset($_GET['cari'])) {
          $cari = $_GET['cari'];

          $sql = "SELECT
    video.idVideo,video.durasiVideo,video.namaVideo,video.kesulitan,video.linkVideo,video.deskripsiVideo,ketegori.namaKategori,pelatih.namaPelatih,video.videoImg
FROM
    pelatih
INNER JOIN detailpelatih ON pelatih.idPelatih = detailpelatih.idPelatih
INNER JOIN video ON video.idVideo = detailpelatih.idVideo
INNER JOIN ketegori ON ketegori.idKategori = video.idKategori 
WHERE video.namaVideo LIKE'$cari%' or ketegori.namaKategori LIKE'$cari%' or ketegori.tipe_kategori LIKE'$cari%' or video.kesulitan LIKE'$cari%'";

          $result = mysqli_query($conn, $sql);
          Search($result);
        }
      }
    }


    function Search($result)
    {

      $count = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        if ($count == 0) {
          echo "<section>";
        }
        $idVideo = $row["idVideo"];
        ?>
        
        <div class = "menu-card">
        <a href="detailVideo.php?id=<?php echo $idVideo; ?>">
        <img src="<?php echo $row['videoImg']?>", alt="BridgePose">
        
        <h1 class = "menu-title"><?php echo $row['namaVideo']?></h1>
        <div class="overlay">
        <span>Show More ...</span>
        </div>
        </a>
        </div>
        <?php

        if ($count == 2) {
          echo "</section>";
          $count = 0;
        } else {
          $count += 1;
        }
      }
    }







    ?>


  </main>

  <footer>
    <div class="logo">
      <img src="logo/Logo1.png" alt="">
      <p>Wellness for the People</p>
    </div>

    <div class="term">
      <p>Term of Use</p>
      <p>Privacy Policy</p>
      <p>Reference</p>
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
      <span>Dedi Yanto, Maverick Mikolas, Michelle Shannen</span>
    </div>

  </footer>

</body>

</html>