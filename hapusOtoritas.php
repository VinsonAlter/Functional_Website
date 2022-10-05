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
	
		$id = (int)$_POST['id'];
		
		$sql = "DELETE FROM template WHERE id = $id";
		$delete = mysqli_query($koneksi, $sql);
		
		if($delete){
			$res['success'] = '1';
			$res['message'] = 'Template deleted successfully';
		}
	} else{
	    $res['success'] = '0';
        $res['message'] = 'You have no permission to delete this template.';
	}
	
	echo json_encode($res);
?>