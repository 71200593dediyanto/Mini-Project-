<?php
session_start();
$_SESSION['idKategori'] = null;
unset($_SESSION['idKategori']);
//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

$sqlquery = "SELECT * FROM ketegori WHERE tipe_kategori = 'training'";


$result = mysqli_query($conn, $sqlquery);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="index.js">

    </script>
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
                <a href="kategoriWorkout.php">Workouts</a>
                <a class="active" href="kategoriTraining.php">Training</a>
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
        <div class="crudKategori">
            <a href="formKategoriTraining/addTraining.php">
                <button class="displayButton" id="bttn-tambah">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:24px"></i>
                    Tambah Kategori
                </button>
            </a>

            <a href="formKategoriTraining/delTraining.php">
                <button class="displayButton" id="bttn-delete">
                    <i class="fa fa-trash-o" style="font-size:24px"></i>
                    Delete Kategori
                </button>
            </a>

            <a href="formKategoriTraining/updTraining.php">
                <button class="displayButton" id="bttn-update">
                    <i class='fa fa-edit' style='font-size:24px'></i>
                    Update Kategori
                </button>
            </a>
        </div>

        <main>
            <?php
            $counter = 1;
            $opensection = 0;
            ?>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                if ($opensection == 0) {
                    echo "<section>";
                    $opensection = 1;
                }

            ?>

                <div class="menu-card">

                    <a href="detailWorkout.php?id=<?php echo $row['idKategori']; ?>">
                        <img src="<?php echo $row['imgKategori'] ?>" alt="">
                        <h1 class="menu-title"> <?php echo $row['namaKategori']; ?></h1>
                        <div class="overlay">
                            <span>Show More ...</span>
                        </div>
                    </a>
                </div>
                <?php
                if ($counter == 3) {
                    echo "</section>";
                    $counter = 1;
                    $opensection = 0;
                } else {
                    $counter += 1;
                }
                ?>
            <?php
            }
            ?>
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