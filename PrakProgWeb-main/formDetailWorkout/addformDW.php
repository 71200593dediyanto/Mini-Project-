<?php

session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
$idadmin = $_SESSION["idAdmin"];
$idKategori = $_SESSION['idKategori'];
$queryAdmin = mysqli_query($conn, "SELECT * FROM `admin` where idAdmin = '$idadmin'");
$queryKategori = mysqli_query($conn, "SELECT * FROM `ketegori` where idKategori = '$idKategori'");
$queryPelatih = mysqli_query($conn, "SELECT * FROM `pelatih`");
$resultAdmin = mysqli_fetch_assoc($queryAdmin);
$resultKategori = mysqli_fetch_assoc($queryKategori);
$namaAdmin = $resultAdmin["nama"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Tambah Video</title>
    <link rel="stylesheet" href="../css/addVideoForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="DW-addForm">

        <div id="input-form">
            <h1>Add Workout Video Form</h1>
            <form action="addformDW.php" method="POST" name="formTambahData" enctype="multipart/form-data">

                <div class="DetailWorkout-image">
                    <div class="form-element">
                        <input type="file" id="imgVideo" name="imgVideo" required>
                        <label for="imgVideo" id="file-preview">
                            <img src="../logo/imageVideo.jpg" alt="">
                            <div>
                                <p> Masukkan Gambar Video Di Sini </p>
                            </div>
                        </label>
                    </div>
                </div>


                <div class="DetailWorkout-label">
                    <label for="admin"> Publisher : </label>
                    <br>
                    <input type="text" value="<?php echo $namaAdmin; ?>" id="admin" readonly="readonly" name="admin">
                </div>

                <div class="DetailWorkout-label">
                    <label for="kategoriVideo"> Kategori Video : </label>
                    <br>
                    <input type="text" value="<?php echo $resultKategori["namaKategori"]; ?>" id="kategoriVideo" readonly="readonly" name="kategori">
                </div>

                <div class="DetailWorkout-label">
                    <label for="pelatih"> Instruktur : </label>
                    <br>
                    <select name="pelatih" id="pelatih" required>
                        <?php
                        while ($pelatih = mysqli_fetch_assoc($queryPelatih)) {
                        ?>
                            <option value="<?php echo $pelatih['idPelatih']; ?>">
                                <?php
                                echo $pelatih["namaPelatih"];
                                ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                
                <div class="DetailWorkout-label">
                    <label for="peralatan"> Peralatan : </label>
                    <br>
                    <input type="text" id="peralatan" name="peralatan" required
                        placeholder="Masukkan Peralatan Yang Di Butuhkan" >
                </div>

                <div class="DetailWorkout-label">
                    <label for="judulVideo"> Judul Video : </label>
                    <br>
                    <input type="text" id="judulVideo" name="judulVideo" required>
                </div>

                <div class="DetailWorkout-label">
                    <label> Durasi Video  </label>
                    <br>
                    <span>
                        <br>
                        <h5>Hour :</h5>
                        <input type="number" id="jam" name="jam" required>
                        <h5>Minute :</h5>
                        <input type="number" id="menit" name="menit" required min="0" max="60">
                        <h5>Second :</h5>
                        <input type="number" id="detik" name="detik" required min="0" max="60">
                    </span>
                </div>

                <div class="DetailWorkout-label">
                    <label for="kesulitanVideo"> Kesulitan Video : </label>
                    <br>
                    <select name="kesulitanVideo" id="kesulitasnVideo" required>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <div class="DetailWorkout-label">
                    <label for="linkVideo">Link Video : </label>
                    <br>
                    <textarea name="linkVideo" id="linkVideo" cols="30" rows="10" required></textarea>
                </div>

                <div class="DetailWorkout-label">
                    <label for="deskripsiVideo">Deskripsi video : </label>
                    <br>
                    <textarea name="deskripsiVideo" id="deskripsiVideo" cols="30" rows="10" required></textarea>
                </div>

                <div class="DetailWorkout-label">
                    <label for="jumlahViews">Jumlah Views : </label>
                    <br>
                    <input type="number" name="jumlahViews" id="jumlahViews">
                </div>

                <div class="DetailWorkout-label">
                    <button type="submit" name="submit"> Insert </button>
                </div>

            </form>
        </div>
    </div>
</body>



<?php

if (isset($_POST['submit'])) {

    if (isset($_FILES["imgVideo"]["name"])) {

        // Data-data video
        $judul = htmlspecialchars($_POST["judulVideo"]);
        $jam = strval($_POST["jam"]);
        $menit = strval($_POST["menit"]);
        $detik = strval($_POST["detik"]);
        $peralatan = htmlspecialchars($_POST["peralatan"]);

        if(intval($jam) < 10 && strlen($jam) < 2){
            $tmp = $jam;
            $jam = "0".$tmp;
        }

        if(intval($menit) < 10 && strlen($menit) < 2){
            $tmp = $menit;
            $menit = "0".$tmp;
        }

        if(intval($detik) < 10 && strlen($detik) < 2){
            $tmp = $detik;
            $detik = "0".$tmp;
        }

        $durasi = $jam.":".$menit.":".$detik;
 
        $kesulitan = htmlspecialchars($_POST["kesulitanVideo"]);
        $link = htmlspecialchars($_POST["linkVideo"]);
        $deskripsi = htmlspecialchars($_POST["deskripsiVideo"]);
        $view = number_format($_POST["jumlahViews"], 0, ',', '.');
        $idPelatih = $_POST["pelatih"];

        //Data Gambar Video
        $date = time();
        $filegambar = $_FILES["imgVideo"]["tmp_name"];
        $namaGambar = $_FILES["imgVideo"]["name"];

        //ekstrak extensi file gambar
        $str_to_arry = explode('.', $namaGambar);
        $extension = end($str_to_arry);

        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "jfif") {
            // !pisahkan spasi di nama file
            $deletespace = explode(' ', $str_to_arry[0]);
            $newfilename = implode($deletespace);
            $newname = $newfilename . "-" . $date . "." . $extension;
            $uploadfile1 = "../video images/" . $newname;
            $uploadfile2 = "video images/" . $newname;

            // !upload file ke directory utama di folder



            // ! insert file ke database
            $queryInsert = "INSERT INTO video 
            (idVideo,idAdmin,idKategori,namaVideo,durasiVideo,kesulitan,linkVideo,deskripsiVideo,jumlahViews,videoImg,peralatan)
            VALUES
            ('','$idadmin','$idKategori','$judul','$durasi','$kesulitan','$link','$deskripsi','$view','$uploadfile2','$peralatan')";


            if (move_uploaded_file($_FILES["imgVideo"]["tmp_name"], $uploadfile1)) {
                if (mysqli_query($conn, $queryInsert)) {
                    $last_id = mysqli_insert_id($conn);

                    $InsertDetail = "INSERT INTO detailpelatih (idPelatih,idVideo) values ('$idPelatih','$last_id')";
                    mysqli_query($conn, $InsertDetail);
                    echo "
                        <script>
                            document.location.href = '../detailWorkout.php?id=$idKategori';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Data Video Gagal Ditambahkan');
                            window.location.href = window.location.href;
                        </script>
                    ";
                }
            }
        }
    }
}

?>

<script>
    function previewBeforeUpload(id) {
        document.querySelector("#" + id).addEventListener("change", function(e) {
            if (e.target.files.length == 0) {
                return;
            }
            let file = e.target.files[0];
            let url = URL.createObjectURL(file);
            document.querySelector("#" + "file-preview div").innerText = null;
            document.querySelector("#" + "file-preview img").src = url;
            document.getElementById("deleteImg").style.display = "inline-block";
        });
    }
    previewBeforeUpload("imgVideo");
</script>

</html>