
<?php 

 if(isset($_POST["profesi"]))
 {
    $conn = mysqli_connect("localhost","root","","remun_keerom");
    $query = "INSERT INTO trdpakdetail (jadwalkbm) VALUES ('".$_POST['profesi']."')";
    $result = mysqli_query($conn, $query);
    echo 'Data Berhasil Ditambah';
 }

    ?>
