<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
$query = "SELECT * FROM ketegori where tipe_kategori = 'workout'";
$runQuery = mysqli_query($conn, $query);
if (mysqli_num_rows($runQuery) < 1) {
    header("Location:../kategoriWorkout.php");
}
// !Delete Logic
if (isset($_POST['submit'])) {
    if (isset($_POST['delKategori'])) {
        $recordArr = $_POST['delKategori'];
        foreach ($recordArr as $idKategori) {
            $filebefore = "SELECT imgKategori FROM ketegori WHERE idKategori = '$idKategori'";
            $run = mysqli_query($conn, $filebefore);
            $selectfile = mysqli_fetch_assoc($run);
            unlink("../" . $selectfile["imgKategori"]);
            $query1 = "DELETE FROM ketegori Where idKategori='$idKategori'";
            mysqli_query($conn, $query1) or die(mysqli_error($conn, $query1));
        }
        echo "
            <script>
                alert('Data Yang Di Pilih Berhasil Di Hapus');
                window.location.href = window.location.href;
            </script>
        ";
    } else {
        echo "
        <script>
            window.location.href = window.location.href;
            alert('Tidak Ada Data Yang Terhapus');
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
    <title>Delete Form Kategori</title>
    <link rel="stylesheet" href="../css/delKategori.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <a href="../kategoriWorkout.php"> <button id="back"> <i class="fa fa-arrow-left" style="font-size:28px"></i> Back
        </button></a>
    <form method="post" action="delKategori.php">
        <button type="submit" name="submit" id="submit"
            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">Confirm Delete <i class="fa fa-trash-o"
                style="font-size:28px"></i></button>
        <main>
            <?php
            $counter = 1;
            $opensection = 0;
            ?>
            <?php
            while ($row = mysqli_fetch_assoc($runQuery)) {
                if ($opensection == 0) {
                    echo "<section>";
                    $opensection = 1;
                }
            ?>
            <div class="menu-card">
                <span id="delete">Check The Box To Delete : </span>
                <input id="check" type="checkbox" name="delKategori[]" value="<?php echo $row["idKategori"]; ?>">
                <img src="../<?php echo $row['imgKategori'] ?>" alt="">
                <h1 class="menu-title"> <?php echo $row['namaKategori']; ?></h1>
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
    </form>
</body>

</html>