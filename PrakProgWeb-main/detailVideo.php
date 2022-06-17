<?php
session_start();
//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $_SESSION["idVideo"] = $id;
    $sqlIdPelatih = "SELECT idPelatih FROM detailpelatih WHERE idVideo = '$id'";
    $sqlVideo = "SELECT * FROM video WHERE idVideo = '$id'";
    // ! Run Query
    $resultidPelatih = mysqli_query($conn, $sqlIdPelatih);
    $resultVideo = mysqli_query($conn, $sqlVideo);
    $arrayVideo = mysqli_fetch_assoc($resultVideo);
    $arrayIdPelatih = mysqli_fetch_assoc($resultidPelatih);
    $idKategori = $arrayVideo['idKategori'];
    $idPelatih = $arrayIdPelatih["idPelatih"];
    $selectPelatih = "SELECT * FROM pelatih where idPelatih = '$idPelatih'";
    $selectKategori = "SELECT * FROM ketegori where idKategori = '$idKategori'";
    $resultKategori = mysqli_query($conn, $selectKategori);
    $arrayKategori = mysqli_fetch_assoc($resultKategori);
    $resultPelatih = mysqli_query($conn, $selectPelatih);
    $arrayPelatih = mysqli_fetch_assoc($resultPelatih);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>GoFit</title>
    <link rel="shortcut icon" href="logo/Logo2.png" type="image/x-icon" />
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
            <a class="logolink" href="index.php"><img class="logoimage" src="logo/Logo1.png" /></a>
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
        <main class="content-cardio">
            <div class="video-container">
                <div class="video-embed">
                    <iframe src="<?php echo $arrayVideo['linkVideo']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
                <dl class="deskripsi-video">

                    <a class="back-button" href="detailWorkout.php?id=<?php echo $arrayVideo['idKategori']; ?>">
                        <b><i class="fa fa-angle-left fa-lg"></i> Go Back </b>
                    </a>

                    <a class="edit-button displayButton" href="formDetailWorkout/editformDW.php?id=<?php echo $arrayVideo['idVideo']; ?>">
                        <b><i class='fa fa-edit' style='font-size:24px'></i> Edit </b>
                    </a>

                    <h1><?php echo $arrayVideo['namaVideo']; ?></h1>
                    <dt> Durasi: <b class="isi-content"><?php echo $arrayVideo['durasiVideo']; ?></b></dt>
                    <dt> Tingkat Kesulitan: <b class="isi-content"> <?php echo $arrayVideo['kesulitan']; ?></b> </dt>
                    <dt> Peralatan: <b class="isi-content"><?php echo $arrayVideo['peralatan']; ?></b> </dt>
                    <dt> Ketegori Workout: <b class="isi-content"> <?php echo $arrayKategori['namaKategori']; ?> </b> </dt>
                    <p>Coach by: <b class="isi-content">
                            <?PHP echo $arrayPelatih['namaPelatih'] ?>
                        </b> <img src="<?php echo $arrayPelatih['imgPelatih']; ?>" alt="" id="imgPelatih"> </p>
                </dl>
            </div>
            <p class="solid"></p>
            <div class="video-detail">
                <h1 class="judul-video"><?php echo $arrayVideo['namaVideo']; ?></h1>
                <div class="container-penjelasan">
                    <p class="penjelasan-video">
                        <?php echo $arrayVideo['deskripsiVideo']; ?>
                    </p>
                </div>
            </div>
        </main>
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