<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");
$query = "SELECT * FROM ketegori where tipe_kategori = 'workout'";
$runQuery = mysqli_query($conn,$query);

if(mysqli_num_rows($runQuery) < 1){
    header("Location:../kategoriWorkout.php");
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

    <a href="../kategoriWorkout.php"> <button id="back"> <i class="fa fa-arrow-left" style="font-size:28px"></i> Back </button></a>
    <main>
        <?php
        $counter = 1;
        $opensection = 0;
        ?>

        <?php
        while($row = mysqli_fetch_assoc($runQuery))
        {
            if($opensection == 0){
                echo "<section>";
                $opensection = 1;
            }
        
        ?>
        
        <div class = "menu-card">
            <a href="formUpdate.php?id=<?php echo $row['idKategori'];?>">
            <button id="update">
            <i class='fa fa-edit' style='font-size:24px'></i> 
            Click To Update !!
            </button>
            </a>
            <img src="../<?php echo $row['imgKategori']?>" alt="">
            <h1 class = "menu-title"> <?php echo $row['namaKategori'];?></h1>
        </div>

            <?php
        if($counter == 3){
                echo "</section>";
                $counter = 1;
                $opensection = 0;
            }else {
                $counter += 1;
            }
            ?>
        <?php
        }
        ?>
    </main>
</body>
</html>