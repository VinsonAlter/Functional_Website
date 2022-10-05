<?php

  require_once ('../../../config.php');

  require_once ('../functions.php');

  require_once (BASE_PATH.DS.'koneksisqlsrv.php');

  $data = $result = array();

  if(isset($_GET['cabang']) && $_GET['rangka']) {

  $cabang = $_GET['cabang'];

  $rangka = $_GET['rangka'];
  
	if($cabang == '100011') {

    try {
        /* dummy database */
	    $pdo = new PDO($dsn1_dummy, 'sa', 'Brav02010IT', $pdo_option);
        // $pdo = new PDO($dsn1, 'sa', 'Brav02010IT', $pdo_option);
		$urut = $total_record = 0;
		// Get total record
		$query = "SELECT id, NoRangka, TglFollow, CatatanFollow, StatusFollow, FollowVia, FollowOleh FROM [SALES-100011-dummy].[dbo].[Tb_ServiceFollow] WHERE NoRangka = '$rangka'
                  ORDER BY TglFollow DESC, id DESC";	
		$stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		$stmt->execute();
		$total_record += $stmt->rowCount();		
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				++$urut;
				$data[] = array(
					$urut,
					$row['NoRangka'],
					$row['TglFollow'],
					$row['CatatanFollow'],
					$row['StatusFollow'],
					$row['FollowVia'],
					$row['FollowOleh'],
				);
			}
		}
		$pdo = null;

        if ( isset($_REQUEST['start']) && $_REQUEST['length'] != -1 ) {
            $data = array_slice($data, intval($_REQUEST['start']), intval($_REQUEST['length']));
        } 

        for ($i=0;$i<count($data);$i++)
		{	
			$data[$i][2] = date('d-m-Y', strtotime($data[$i][2])); // Date formatting
		}

        // return result
        $result = array(
            "draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
            "recordsTotal" => $total_record,
            "recordsFiltered" => $urut,
            "data" => $data,
        );

        } catch (Exception $e) {
            $result = array(
                "draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data,
                "error" => $e->getMessage(),
                
            );
        }
    
        echo json_encode($result);
    }

    else if($cabang == '100706') {

    try {
        /* Dummy Database */
        $pdo = new PDO($dsn2_dummy, 'sa', 'Brav02010IT', $pdo_option);
        // $pdo = new PDO($dsn2, 'sa', 'Brav02010IT', $pdo_option);
        $urut = $total_record = 0;
        // Get total record
        $query = "SELECT NoRangka, TglFollow, CatatanFollow, StatusFollow, FollowVia, FollowOleh FROM [SALES-100011-dummy].[dbo].[Tb_ServiceFollow] WHERE NoRangka = '$rangka'
                  ORDER BY TglFollow DESC, id DESC";	
        $stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
        $stmt->execute();
        $total_record += $stmt->rowCount();		
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ++$urut;
                $data[] = array(
                    $urut,
                    $row['NoRangka'],
                    $row['TglFollow'],
                    $row['CatatanFollow'],
                    $row['StatusFollow'],
                    $row['FollowVia'],
                    $row['FollowOleh'],
                );
            }
        }
        $pdo = null;

        if ( isset($_REQUEST['start']) && $_REQUEST['length'] != -1 ) {
            $data = array_slice($data, intval($_REQUEST['start']), intval($_REQUEST['length']));
        } 

        for ($i=0;$i<count($data);$i++)
		{	
			$data[$i][2] = date('d-m-Y', strtotime($data[$i][2])); // Date formatting
		}
    
        // return result
        $result = array(
            "draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
            "recordsTotal" => $total_record,
            "recordsFiltered" => $urut,
            "data" => $data,
            "table" => $query
        );

        } catch (Exception $e) {
            $result = array(
                "draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data,
                "error" => $e->getMessage(),
                
            );
        }
    
        echo json_encode($result);
    }
        
  }

?>

