<?php
session_start();
//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
$idKategori = $_SESSION["idKategori"];
$query = "SELECT * FROM video WHERE idKategori='$idKategori'";
$runQuery = mysqli_query($conn, $query);
if (mysqli_num_rows($runQuery) < 1) {
    header("Location:../detailWorkout.php?id=$idKategori");
}
// !Delete Logic
if (isset($_POST['submit'])) {
    if (isset($_POST['delVideo'])) {
        $recordArr = $_POST['delVideo'];
        foreach ($recordArr as $idVideo) {
            $query2 = "DELETE FROM detailPelatih Where idVideo='$idVideo'";
            mysqli_query($conn, $query2) or die(mysqli_error($conn, $query2));
            $query1 = "DELETE FROM video Where idVideo='$idVideo'";
            mysqli_query($conn, $query1) or die(mysqli_error($conn, $query1));
        }
        echo "
            <script>
                alert('Data Yang Di Pilih Berhasil Di Hapus');
                window.location.href = window.location.href;
            </script>
        ";
    }
    else {
        echo "
        <script>
            window.location.href = window.location.href;
            alert('Tidak Ada Data Yang Terhapus')
        </script>
    ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/delVideo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <a href="../detailWorkout.php?id=<?php echo $idKategori; ?>"> <button id="back"> <i class="fa fa-arrow-left"
                style="font-size:28px"></i> Back </button></a>
    <form method="post" action="delformDW.php">
        <button type="submit" name="submit" id="submit"
            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">Confirm Delete <i class="fa fa-trash-o"
                style="font-size:28px"></i></button>
        <?php
$counter = 1;
$opensection = 0;
?>
        <?php
while ($row = mysqli_fetch_assoc($runQuery)) {
    $judulVideo = $row["namaVideo"];
    $totalviews = $row["jumlahViews"];
    $durasi = $row["durasiVideo"];
    $fotoVideo = $row["videoImg"];
    $idAdmin = $row["idAdmin"];
    if ($opensection == 0) {
        echo "<div class='video-nav'>";
        $opensection = 1;
    }
?>
        <div class="video-card">
            <img src="../<?php echo $fotoVideo; ?>" alt="coba image video">
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
            <span id="delete">Check The Box To Delete : </span>
            <input style="cursor:pointer;" id="check" type="checkbox" name="delVideo[]"
                value="<?php echo $row["idVideo"]; ?>">
        </div>
        <?php
    if ($counter == 3) {
        echo "</div>";
        $counter = 1;
        $opensection = 0;
    }
    else {
        $counter += 1;
    }
?>
        <?php
}
?>
        </div>
    </form>
</body>

</html>