<?php
    session_start();
    require_once('../../../config.php');
    require_once(BASE_PATH.DS.'koneksisqlsrv.php');
    require_once('../functions.php');

    if(isset($_POST['batch'])) {

    // testing data insertion
        
        $user = $_SESSION['nama_login'];
        $tanggal = date_to_str($_POST['tanggalAkhir']);
        $catatan = $_POST['catatan'];
        $panggilan = $_POST['panggilan'];
        $status = $_POST['status_panggilan'];
        
        $batch = $_POST['batch'];
        $arr = explode(' ; ', $batch);
        foreach($arr as $val) {
            $arr = explode(' , ', $val);
            $cabang = $arr[0];
            $rangka = $arr[1];
            // var_dump($rangka);
            

            if($cabang == '100011') {
                /* dummy database */
                $pdo = new PDO($dsn1_dummy, 'sa', 'Brav02010IT');
                // $pdo = new PDO($dsn1, 'sa', 'Brav02010IT');
                $insert = "INSERT INTO [SALES-100011-dummy].[dbo].[Tb_ServiceFollow]
                    ([NoRangka]
                    ,[TglFollow]
                    ,[CatatanFollow]
                    ,[StatusFollow]
                    ,[FollowVia]
                    ,[FollowOleh]) 
                VALUES
                    ('$rangka',
                    '$tanggal',
                    '$catatan',
                    '$status',
                    '$panggilan',
                    '$user')";
                $stmt = $pdo->prepare($insert, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
                $stmt->execute();		
                if ($stmt->rowCount() > 0) {
                    $res['success'] = 1;
                    $res['message'] = 'Data saved successfully';
                } else {
                    $res['success'] = 0;
                    $res['message'] = 'Failed to save data, please try again later';
                }
                $pdo = null;
            } else if ($cabang == '100706') {
                /* dummy database */
                $pdo = new PDO($dsn2_dummy, 'sa', 'Brav02010IT');
                // $pdo = new PDO($dsn2, 'sa', 'Brav02010IT');
                $insert = "INSERT INTO [SALES-100706-dummy].[dbo].[Tb_ServiceFollow]
                    ([NoRangka]
                    ,[TglFollow]
                    ,[CatatanFollow]
                    ,[StatusFollow]
                    ,[FollowVia]
                    ,[FollowOleh])
                VALUES
                    ('$rangka',
                    '$tanggal',
                    '$catatan',
                    '$status',
                    '$panggilan',
                    '$user')";
                $stmt = $pdo->prepare($insert, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
                $stmt->execute();		
                if ($stmt->rowCount() > 0) {
                    $res['success'] = 1;
                    $res['message'] = 'Data saved successfully';
                } else {
                    $res['success'] = 0;
                    $res['message'] = 'Failed to save data, please try again later';
                }
                $pdo = null;
            } 
    }
        
        echo json_encode($res);
    }
?>

