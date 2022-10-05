<?php 
    session_start();
    require_once ('../../config.php');
	require_once (BASE_PATH.DS.'koneksi.php');
	require_once ('functions.php');
	// require_once('init.php');

    $login = $_SESSION['nama_login'];

    $res = [];

    $otoritas = array();

    $checkOtoritas = "SELECT otoritas FROM template a LEFT JOIN useraccounts b ON a.namaTemplate = b.Template WHERE nama_login = '$login'";

    $hasilCheck = mysqli_query($koneksi, $checkOtoritas);

    while ($row = mysqli_fetch_assoc($hasilCheck)){

        $otoritas = explode(',', $row['otoritas']);

    }

    if (in_array(9, $otoritas)){

        if(isset($_POST['id'])) {

            $id = $_POST['id'];
            $template = $_POST['template'];
            $otoritas = $_POST['otoritas'];

            $update = "UPDATE template SET otoritas = '$otoritas' WHERE id = $id";
            $result = mysqli_query($koneksi, $update);

            if($result) {
                $res['success'] = 1;
                $res['message'] = 'Otoritas updated successfully';
            } 

            // echo json_encode($_POST);

        }
    } else {
        $res['success'] = 0;
        $res['message'] = 'You have no permission to update this template';

    }

    echo json_encode($res);

    

    // $id = (int)$_POST['id'];

    //     $tampil = "SELECT * FROM template WHERE id= $id";
    //     $hasil = mysqli_query($koneksi, $tampil);
    //     while ($row = mysqli_fetch_assoc($hasil)){
    //         $data = array(
    //             'template' => $row['namaTemplate'],
    //             'otoritas' => $row['otoritas']
    //         );
    //     }

    //     if($tampil) {
    //         $res['success'] = 1;
    //         $res['data'] = $data;
    //     } else {
    //         $res['success'] = 0;
    //         $res['message'] = "Maaf, data yang dicari tidak ada";
    //     }
            
   

    
?>