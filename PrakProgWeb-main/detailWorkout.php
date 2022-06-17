<?php
session_start();
//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $_SESSION["idKategori"] = $id;
    $sqlKategori = "SELECT * FROM ketegori WHERE idKategori = '$id'";
    $sqlVideo = "SELECT * FROM video WHERE idKategori = '$id'";
    // ! Run Query
    $resultKategori = mysqli_query($conn, $sqlKategori);
    $resultVideo = mysqli_query($conn, $sqlVideo);
} else {
    header("Location:kategoriWorkout.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/tombol.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GoFit</title>
    <link rel="shortcut icon" href="logo/Logo2.png" type="image/x-icon">
</head>
<script type="text/javascript" src="index.js">
</script>
<?php
if (!isset($_SESSION["login"])) {
?>

    <body class="detail-body" onload="undisplay()">
    <?php
} else {
    ?>

        <body class="detail-body" onload="transform()">
        <?php
    }
        ?>
        <header class="topnav">
            <a class="logolink" href="index.php"><img class="logoimage" src="logo/Logo1.png"></a>
            <nav class="header-center">
                <a href="index.php">Home</a>
                <a href="kategoriWorkout.php">Workouts</a>
                <a href="kategoriTraining.php">Training</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
                <div class="search-container">
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
        <br>
        <?php
        $namaKategori = "";
        $deskripsiKategori = "";
        $fotoKategori = "";
        while ($row = mysqli_fetch_assoc($resultKategori)) {
            $namaKategori = $row["namaKategori"];
            $deskripsiKategori = $row["deskripsiKategori"];
            $fotoKategori = $row["imgKategori"];
        }
        ?>
        <main class="detail">
            <img id="image-Kategori" src="<?php echo  $fotoKategori; ?>" alt="coba">
            <?php ?>
            <div class="penjelasan">
                <H2>
                    <?php
                    echo $namaKategori;
                    ?>
                </H2>
                <p class="box">
                    <?php
                    echo $deskripsiKategori;
                    ?>
                </p>
            </div>
        </main>
        <p class="solid"></p>
        <div class="Video">
            <h1>Kumpulan Video Cardio</h1>
            <div id="editVideo">
                <a href="formDetailWorkout/addformDW.php?id=<?php echo $id; ?>">
                    <button class="displayButton" id="tambahVideo">
                        <i class="fa fa-plus" aria-hidden="true" style="font-size:24px"></i>
                        Tambah Video
                    </button>
                </a>
                <a href="formDetailWorkout/delformDW.php">
                    <button class="displayButton" id="deleteVideo">
                        <i class="fa fa-trash-o" style="font-size:24px"></i>
                        Hapus Video
                    </button>
                </a>
            </div>
            <p class="solid"></p>
            <?php
            $judulVideo = "";
            $totalviews = "";
            $durasi = "";
            $fotoVideo = "";
            ?>
            <?php
            $counter = 1;
            $opensection = 0;
            ?>
            <?php
            while ($row = mysqli_fetch_assoc($resultVideo)) {
                $judulVideo = $row["namaVideo"];
                $totalviews = $row["jumlahViews"];
                $durasi = $row["durasiVideo"];
                $fotoVideo = $row["videoImg"];
                $idAdmin = $row["idAdmin"];
                $idVideo = $row["idVideo"];
                $resultNamaAdmin = mysqli_query($conn, "SELECT nama FROM `admin` WHERE idAdmin = '$idAdmin'");
                $namaAdmin = mysqli_fetch_array($resultNamaAdmin);
                if ($opensection == 0) {
                    echo "<div class='video-nav'>";
                    $opensection = 1;
                }
            ?>
                <div class="video-card">
                    <a href="detailVideo.php?id=<?php echo $idVideo; ?>">
                        <img src="<?php echo  $fotoVideo; ?>" alt="coba image video">
                        <p class="admin" style="color:rgb(3, 144, 245);font-size: 18px;"> <?php echo $namaAdmin["nama"]; ?>
                        </p>
                        <h3>
                            <?php
                            echo $judulVideo;
                            ?>
                        </h3>
                        <h3 class="durasi">
                            Durasi : <?php echo $durasi; ?>
                        </h3>
                        <span class="views">
                            <i class="fa fa-eye fa-lg">
                            </i>
                            <?php
                            echo $totalviews;
                            ?>
                        </span>
                        <div class="overlay" id="video-overlay">
                            <span>Watch Video ...</span>
                        </div>
                    </a>
                </div>
                <?php
                if ($counter == 3) {
                    echo "</div>";
                    $counter = 1;
                    $opensection = 0;
                } else {
                    $counter += 1;
                }
                ?>
            <?php
            }
            ?>
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