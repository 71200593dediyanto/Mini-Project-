<?php
session_start();

//connect to database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");


if (isset($_POST['submit'])) {
    if (isset($_FILES["foto"]["name"])) {
        $namaKategori = htmlspecialchars($_POST["nama"]);
        $deskripsiKategori = htmlspecialchars($_POST["deskripsi"]);
        $tipeKesulitan = htmlspecialchars($_POST["tipeKesulitan"]);

        //Data Gambar Video
        $date = time();
        $filegambar = $_FILES["foto"]["tmp_name"];
        $namaGambar = $_FILES["foto"]["name"];

        //ekstrak extensi file gambar
        $str_to_arry = explode('.', $namaGambar);
        $extension = end($str_to_arry);

        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "jfif") {
            // !pisahkan spasi di nama file
            $deletespace = explode(' ', $str_to_arry[0]);
            $newfilename = implode($deletespace);
            $newname = $newfilename . "-" . $date . "." . $extension;
            $uploadfile1 = "kategori/" . $newname;
            $uploadfile2 = "../kategori/" . $newname;

            // ! insert file ke database
            $queryInsert = "INSERT INTO ketegori 
            (idKategori,namaKategori,deskripsiKategori,imgKategori)
            VALUES
            ('','$namaKategori','$deskripsiKategori','$uploadfile1')";

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $uploadfile2)) {
                if (mysqli_query($conn, $queryInsert)) {
                    echo "
                        <script>
                            alert('Data Kategori Berhasil Ditambahkan');
                            document.location.href = '../kategoriWorkout.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Data Kategori Gagal Ditambahkan');
                            window.location.href = window.location.href;
                        </script>
                    ";
                }
            }
        } else {
            echo "
            <script>
                alert('Extensi File Foto Yang Anda Gunakan Tidak Sesuai');
                window.location.href = window.location.href;
            </script>
        ";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addKategori.css">
    <title>Form Insert Kategori</title>
</head>

<body>
    <div class="kategori-addForm">

        <div id="input-form">
            <h1>Add category Form</h1>
            <form action="addKategori.php" method="POST" name="formTambahData" enctype="multipart/form-data">

                <div class="Kategori-image">
                    <div class="form-element">
                        <input type="file" id="foto" name="foto" required>
                        <label for="foto" id="file-preview">
                            <img src="../logo/imageVideo.jpg" alt="">
                            <div>
                                <p> Masukkan Gambar Kategori Di Sini </p>
                            </div>
                        </label>
                    </div>
                </div>


                <div class="DetailKategori-label">
                    <label for="nama"> Nama Kategori : </label>
                    <br>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Kategori" required>
                </div>

                <div class="DetailKategori-label">
                    <label for="deskripsi"> Deskripsi Kategori : </label>
                    <br>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea>
                </div>

                <div class="DetailKategori-label">
                    <label for="tipeKesulitan"> Kesulitan Video : </label>
                    <br>
                    <select name="tipeKesulitan" id="tipeKesulitan" required>
                        <option value="workout"> workout </option>
                        <option value="training"> training </option>
                    </select>
                </div>

                <div class="DetailKategori-label">
                    <button type="submit" name="submit"> Insert </button>
                </div>

            </form>
        </div>
    </div>
</body>

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
    previewBeforeUpload("foto");
</script>

</html>