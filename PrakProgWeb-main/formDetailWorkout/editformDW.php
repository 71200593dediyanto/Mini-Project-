<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
if (isset($_GET['id'])) {

    //ambil id video
    $ID = $_GET['id'];
    
    $queryVideo = mysqli_query($conn, "SELECT * FROM video WHERE idVideo = '$ID'");
    $resultVideo = mysqli_fetch_assoc($queryVideo);

    $newidAdmin = $_SESSION["idAdmin"];
    $queryPelatih = mysqli_query($conn, "SELECT * FROM `pelatih`");
    $idKategori = $resultVideo['idKategori'];
    $queryKategori = mysqli_query($conn, "SELECT * FROM `ketegori`");
    $queryAdmin = mysqli_query($conn, "SELECT * FROM `admin` where idAdmin = '$newidAdmin'");
    $resultAdmin = mysqli_fetch_assoc($queryAdmin);
    $namaVideo = $resultVideo['namaVideo'];
    $durasiVideo = $resultVideo['durasiVideo'];
    $kesulitan = $resultVideo['kesulitan'];
    $link = $resultVideo['linkVideo'];
    $deskripsi = $resultVideo['deskripsiVideo'];
    $jumlah = $resultVideo['jumlahViews'];
    $img = $resultVideo['videoImg'];
    $peralatan = $resultVideo['peralatan'];
    $namaAdmin = $resultAdmin["nama"];
    $durasiii = explode(':', $durasiVideo);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Edit Video</title>
    <link rel="stylesheet" href="../css/addVideoForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="DW-addForm">
        <div id="input-form">
            <h1>Edit Workout Video Form</h1>
            <form action="" method="POST" name="formTambahData" enctype="multipart/form-data">
                
                <div class="DetailWorkout-image">
                    <div class="form-element">
                        <input type="file" id="foto" name="foto">
                        <label for="foto" id="file-preview">
                            <img src="../<?php echo $img; ?>" alt="">
                        </label>
                    </div>
                </div>

                <div class="DetailWorkout-label">
                    <label for="admin"> Publisher : </label>
                    <br>
                    <input type="text" value="<?php echo $namaAdmin; ?>" id="admin" readonly="readonly" name="admin">
                </div>


                <div class="DetailWorkout-label">
                        <?php
                            $querySpesifikKategori = mysqli_query($conn, "SELECT * FROM `ketegori` WHERE idKategori = '$idKategori'");
                            $kategoriambil = mysqli_fetch_assoc($querySpesifikKategori);
                            $SelectedName = $kategoriambil['namaKategori'];
                            echo "<select name='kategori' id='kategoriVideo'>";
                            while($kategoriOption = mysqli_fetch_assoc($queryKategori)){
                                if($SelectedName == $kategoriOption['namaKategori']) {
                                    $selectID = $kategoriOption['idKategori'];
                                    $selectValue = $kategoriOption['namaKategori'];
                                    echo "<option selected='selected' value='$selectID'>$selectValue</option>";
                                }
                                else {
                                    $selectID = $kategoriOption['idKategori'];
                                    $selectValue = $kategoriOption['namaKategori'];
                                    echo "<option value='$selectID'>$selectValue</option>";
                                }
                            }
                            echo "</select>";
                        ?>

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
                        placeholder="Masukkan Peralatan Yang Di Butuhkan" value="<?php echo $peralatan; ?>">
                </div>

                <div class="DetailWorkout-label">
                    <label for="judulVideo"> Judul Video : </label>
                    <br>
                    <input type="text" id="judulVideo" name="judulVideo" required placeholder="Masukkan Judul Video"
                        value="<?php echo $namaVideo; ?>">
                </div>

                <div class="DetailWorkout-label">
                    <label> Durasi Video  </label>
                    <br>
                    <span>
                        <br>
                        <h5>Hour :</h5>
                        <input type="number" id="jam" name="jam" required value= "<?php echo $durasiii[0];?>">
                        <h5>Minute :</h5>
                        <input type="number" id="menit" name="menit" required min="0" max="60" value= "<?php echo $durasiii[1];?>" required>
                        <h5>Second :</h5>
                        <input type="number" id="detik" name="detik" required min="0" max="60" value= "<?php echo $durasiii[2];?>" >
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
                    <textarea name="linkVideo" id="linkVideo" cols="30" rows="10"
                        value="<?php echo $link; ?>"><?php echo $link; ?></textarea>
                </div>
                <div class="DetailWorkout-label">
                    <label for="deskripsiVideo">Deskripsi video : </label>
                    <br>
                    <textarea name="deskripsiVideo" id="deskripsiVideo" cols="30" rows="10"
                        value="<?php echo $deskripsi ?>"><?php echo $deskripsi ?></textarea>
                </div>
                <div class="DetailWorkout-label">
                    <label for="jumlahViews">Jumlah Views : </label>
                    <br>
                    <input type="number" name="jumlahViews" id= "jumlahViews"
                        value="<?php echo str_replace(".", "", $jumlah); ?>">
                </div>


                <div class="DetailWorkout-label">
                    <button type="submit" name="submit"> Update </button>
                </div>
            </form>
        </div>
    </div>


<?php
if ($_POST) {
    if ($_FILES['foto']['tmp_name'] != null && $_FILES['foto']['size'] > 0) {
        $namaKategori = $_POST["kategori"];
        $deskripsiKategori = $_POST["deskripsiVideo"];
        //Data Gambar Video
        $filegambar = $_FILES["foto"]["tmp_name"];
        $namaGambar = $_FILES["foto"]["name"];
        $link = $_POST["linkVideo"];
        $instruktur = $_POST["pelatih"];
        $peralatan = $_POST["peralatan"];
        $judul = $_POST["judulVideo"];
        $jam = strval($_POST["jam"]);
        $menit = strval($_POST["menit"]);
        $detik = strval($_POST["detik"]);
        $kesulitan = $_POST["kesulitanVideo"];
        $jumlahview = $_POST["jumlahViews"];

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


        //ekstrak extensi file gambar
        $str_to_arry = explode('.', $namaGambar);
        $extension = end($str_to_arry);
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "jfif") {
            // !pisahkan spasi di nama file
            $deletespace = explode(' ', $str_to_arry[0]);
            $newfilename = implode($deletespace);
            $newname = $newfilename . "-" . $date . "." . $extension;
            $uploadfile1 = "video images/" . $newname;
            $uploadfile2 = "../video images/" . $newname;
            $filebefore = "SELECT videoImg FROM video WHERE idVideo = '$id'";
            $run = mysqli_query($conn, $filebefore);
            $selectfile = mysqli_fetch_assoc($run);
            unlink("../".$selectfile["videoImg"]);
            // ! Update file ke database
            $queryInsert = "UPDATE video 
        SET idAdmin = '$newidAdmin',idKategori = '$namaKategori', namaVideo = '$judul',durasiVideo = '$durasi',kesulitan = '$kesulitan',linkVideo='$link', deskripsiVideo = '$deskripsiKategori',jumlahViews = '$jumlahview',videoImg = '$uploadfile1', peralatan = '$peralatan'
        WHERE
        idVideo = '$ID'";

            $updatePelatih = "UPDATE detailpelatih SET idPelatih = '$instruktur'
            WHERE idVideo = '$ID'";

            if (move_uploaded_file($filegambar, $uploadfile2)) {
                if (mysqli_query($conn, $queryInsert) && mysqli_query($conn, $updatePelatih)) {
                    
                    echo "
                    <script>
                        alert('Data Video Dengan Foto Berhasil Diubah ');
                        document.location.href = '../detailVideo.php?id=$ID';
                    </script>
                ";
                }
            } else {
                echo "
            <script>
                alert('Data Video Dengan Foto Gagal Diubah');
            </script>
        ";
            }
        }else{
            echo "
            <script>
                alert('Extensi File Tidak Di Izinkan');
            </script>
        ";
        }
    } else {
        $namaKategori = $_POST["kategori"];
        $deskripsiKategori = $_POST["deskripsiVideo"];
        //Data Gambar Video
        $filegambar = $_FILES["foto"]["tmp_name"];
        $namaGambar = $_FILES["foto"]["name"];
        $link = $_POST["linkVideo"];
        $instruktur = $_POST["pelatih"];
        $peralatan = $_POST["peralatan"];
        $judul = $_POST["judulVideo"];
        $jam = strval($_POST["jam"]);
        $menit = strval($_POST["menit"]);
        $detik = strval($_POST["detik"]);
        $kesulitan = $_POST["kesulitanVideo"];
        $jumlahview = $_POST["jumlahViews"];

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
        // ! update file ke database
        $queryInsert = "UPDATE video 
        SET idAdmin = '$newidAdmin',idKategori = '$namaKategori', namaVideo = '$judul',durasiVideo = '$durasi',kesulitan = '$kesulitan',linkVideo='$link', deskripsiVideo = '$deskripsiKategori',jumlahViews = '$jumlahview', peralatan = '$peralatan'
        WHERE
        idVideo = '$ID'";

        $updatePelatih = "UPDATE detailpelatih SET idPelatih = '$instruktur'
        WHERE idVideo = '$ID'";
        if (mysqli_query($conn, $queryInsert) && mysqli_query($conn, $updatePelatih)) {
            echo "
                    <script>
                        alert('Data Video Tanpa Foto Berhasil Diubah');
                        document.location.href = '../detailVideo.php?id=$ID';
                    </script>
                ";
        } else {
            echo "
            <script>
                alert('Data Video Tanpa Foto Gagal Diubah');
            </script>
        ";
        }
    }
}
?>

</body>


<script>
function previewBeforeUpload(id) {
document.querySelector("#" + id).addEventListener("change", function(e) {
    if (e.target.files.length == 0) {
        return;
    }
    let file = e.target.files[0];
    let url = URL.createObjectURL(file);
    document.querySelector("#file-preview img").src = url;
});
}
previewBeforeUpload("foto");
</script>

</html>