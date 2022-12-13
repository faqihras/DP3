
<?php 

 if(isset($_POST["content"] ))
 {
    // ($dpakdc1)                = $_POST['total'];
    // $dpakdc2                   = $_POST['total2'];
    // $dpakdc3                    = $_POST['total3'];
    // $dpakdc4               = $_POST['total4'];
    // $dpakdc5               = $_POST['total5'];
    // $bakat                  = $_POST['bakat'];
    // $sakit                  = $_POST['sakit'];
    // $saudara                = $_POST['saudara'];
    // $nama_ayah              = $_POST['nama_ayah'];
    // $agama1                 = $_POST['agama1'];
    // $pekerjaan_ayah         = $_POST['pekerjaan_ayah'];



    $conn = mysqli_connect("localhost","root","","remun_keerom");

    $query = "INSERT INTO trdpakdetail(dpakdCscan) VALUES ('".$_POST['content']."')";

    // $query="INSERT INTO trdpakdetail (dpakdC1,dpakdC2,dpakC3,dpakC4,dpakdC5) 

    // VALUES ('$dpakdci1','$dpakdc2','$dpakdc3','$dpakdc4','$dpakdc5',)";

    // $query2 = DB::table('trStokDetail')
    //                 ->select('*')
    //                 ->where('stokNoTrans','=',$param['no_nota'])
    //                 ->where('stokBrgKode','=',$idbarang)
    //                 ->get()
    //                 ;

    //         $batch_sistem = !empty($query2[0]->stokBrgBatchSistem)?$query2[0]->stokBrgBatchSistem:'';

    $result = mysqli_query($conn, $query);
    echo 'Data Berhasil Ditambah';
 }

    ?>
