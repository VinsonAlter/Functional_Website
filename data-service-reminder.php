<?php

  session_start();

  require_once ('../../../config.php');

  require_once ('../functions.php');

  require_once (BASE_PATH.DS.'koneksisqlsrv.php');

  $data = $result = array();
  
  try {

	$start_date = date('01-m-Y'); // Tanggal 01 bulan berjalan
	$end_date = date('d-m-Y'); // Tanggal hari ini

	if (isset($_SESSION['FilterChecklistDateFrom'])) $start_date = $_SESSION['FilterChecklistDateFrom'];
  	if (isset($_SESSION['FilterChecklistDateTo'])) $end_date = $_SESSION['FilterChecklistDateTo'];
	
	if ($pdo = new PDO($dsn1, 'sa', 'Brav02010IT', $pdo_option)) {
	/* dummy database */
	// if ($pdo = new PDO($dsn1_dummy, 'sa', 'Brav02010IT', $pdo_option)) {
		$urut = $total_record = 0;
		$search_query = '';
		
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
		if ($search) {
			$search_query = "	
								WHERE
							 	DeskripsiTipe LIKE '%$search%' OR
							 	NoSeri LIKE '%$search%' OR
								NoMesin LIKE '%$search%' OR 
								NoRangka LIKE '%$search%' OR
								DeskripsiWarna LIKE '%$search%' OR
								NamaSO LIKE '%$search%' OR
								Telp LIKE '%$search%' OR
								Nama LIKE '%$search%' OR
								NoPolisi LIKE '%$search%' 

							";
		}
		
		$group_by = '';
		$order_by = ' ORDER BY ';
		$orders = '';

		if (isset($_REQUEST['order']) && count($_REQUEST['order'])) {
			for ( $i=0, $ien=count($_REQUEST['order']) ; $i<$ien ; $i++ ) {
				$columnIdx = intval($_REQUEST['order'][$i]['column']);
				$requestColumn = $_REQUEST['columns'][$columnIdx];

				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $_REQUEST['order'][$i]['dir'];
					if ($orders !== '') $orders .= ", ";
					switch ($columnIdx) {
						case 3:
							$orders .= " DeskripsiTipe " . $dir;
							break;
						case 4: 
							$orders .= " NoSeri " . $dir;
							break;
						case 5: 
							$orders .= " NoMesin " . $dir;
							break;
						case 6: 
							$orders .= " NoRangka " . $dir;
							break;
						case 7: 
							$orders .= " DeskripsiWarna " . $dir;
							break;	
						case 8: 
							$orders .= " NamaSO " . $dir;
							break;
						case 9: 
							$orders .= " Telp " . $dir;
							break;
						case 10: 
							$orders .= " Nama " . $dir;
							break;	
						case 11: 
							$orders .= " NoPolisi " . $dir;
							break;
						default:
							$orders .= " TglDO " . $dir;
					}
				}
			}
		}
		
		// Get total record
		$table = "(SELECT '100011' AS cabang, TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100011].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100011].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($start_date)."' AND '" .date_to_str($end_date)."') UNION ALL
				  (SELECT '100706' AS cabang, TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100706].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100706].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($start_date)."' AND '" .date_to_str($end_date)."') ";
		/* dummy database */
		// $table = "(SELECT '100011' AS cabang, TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100011-dummy].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($start_date)."' AND '" .date_to_str($end_date)."') UNION ALL
		//  		  (SELECT '100706' AS cabang, TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100706-dummy].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($start_date)."' AND '" .date_to_str($end_date)."') ";
		$query = "SELECT * FROM (".$table.") temp";	
		$stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		$stmt->execute();
		// $res = $stmt->fetchAll();
        // $total_record += count($res);
		$total_record += $stmt->rowCount();
		
		// // Font Awesome Icon
		// $component = '<a class="btn btn-sm btn-success"<i class="fa fa-edit"></i></a>';
		// return $component;
		// $apply_action = 'component';

		// Get only filtered record
		$query = "SELECT * FROM (" . $table .  ") temp " . $search_query . $order_by . $orders ;
		$stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		$stmt->execute();		
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$urut++;
				$cabang = $row['cabang'];
				$rangka = $row['NoRangka'];
				$checkbox = '<input type="checkbox" value="' .$cabang.  " , "  .$rangka. '" id="checkboxes" class="checkboxes">';
				$component = '<span data-toggle="modal" data-target=".bs-modal-sm"> <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit" onclick="getRangka(\''.$cabang.'\', \''.$rangka.'\')" id="getRangka"><i class="fa fa-edit"></i></a></span>';
				$component .= '<span data-toggle="modal" data-target=".bs-modal-table"> <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="View" onclick="initView(\''.$cabang.'\', \''.$rangka.'\')"><i class="fa fa-table"></i></a></span>';
				$data[] = array(
					$checkbox,
					$urut,
					$row['TglDO'],
					$row['DeskripsiTipe'],
					$row['NoSeri'],
					$row['NoMesin'],
					$row['NoRangka'],
					$row['DeskripsiWarna'],
					$row['NamaSO'],
					$row['Telp'],
					$row['Nama'],        
                    $row['NoPolisi'],
					$component
				);
			}
		}
		$pdo = null;

		// repeat for 2nd DSN	
		// if ($pdo = new PDO($dsn2, 'sa', 'Brav02010IT', $pdo_option)) {
		// 	// Get total record
		// 	$query = $table . $where . $group_by . $order_by;		
		// 	$stmt = $pdo->prepare($query);
		// 	$stmt->execute();
        //     $result = $stmt->fetchAll();
		// 	// $total_record += $stmt->rowCount(); 
        //     $total_record += count($result);
			
		// 	// Get only filtered record
		// 	$query = "SELECT * FROM (" . $table . $where . $group_by . ") temp " . $search_query . $order_by;
		// 	$stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		// 	$stmt->execute();			
		// 	if ($stmt->rowCount() > 0) {
		// 		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// 			++$urut;
		// 			$data[] = array(
		// 				$urut,
		// 				$row['TglDO'],
		// 				$row['DeskripsiTipe'],
		// 				$row['NoSeri'],
		// 				$row['NoMesin'],
		// 				$row['NoRangka'],
		// 				$row['DeskripsiWarna'],
		// 				$row['NamaSO'],
		// 				$row['Telp'],
		// 				$row['Nama'],        
		// 				$row['NoPolisi'] 
		// 			);
		// 		}
		// 	}
		// 	$pdo = null;
		// }
		
		
		// Sorting data
		// if (!empty($data)) {
		// 	$sort1 = $sort2 = $sort3 = $sort4 = $sort5 = $sort6 = $sort7 = $sort8 = $sort9 = $sort10 = array();
			
		// 	// Multi dimensional sorting
		// 	foreach ($data as $key => $value) {
		// 		$sort1[$key] = $value[1];
		// 		$sort2[$key] = $value[2];
		// 		$sort3[$key] = $value[3];
		// 		$sort4[$key] = $value[4];
		// 		$sort5[$key] = $value[5];
		// 		$sort6[$key] = $value[6];
		// 		$sort7[$key] = $value[7];
		// 		$sort8[$key] = $value[8];
		// 		$sort9[$key] = $value[9];
		// 		$sort10[$key] = $value[10];
		// 	}
			
		// 	if (isset($_REQUEST['order']) && count($_REQUEST['order'])) {
		// 		for ( $i=0, $ien=count($_REQUEST['order']) ; $i<$ien ; $i++ ) {
		// 			$columnIdx = intval($_REQUEST['order'][$i]['column']);
		// 			$requestColumn = $_REQUEST['columns'][$columnIdx];

		// 			if ( $requestColumn['orderable'] == 'true' ) {
		// 				$dir = $_REQUEST['order'][$i]['dir'] === 'asc' ? SORT_ASC : SORT_DESC;
		// 				switch ($columnIdx) {
		// 					case 2: 
		// 						array_multisort($sort2, $dir, $data);
		// 						break;
		// 					case 3: 
		// 						array_multisort($sort3, $dir, $data);
		// 						break;
		// 					case 4: 
		// 						array_multisort($sort4, $dir, $data);
		// 						break;
		// 					case 5: 
		// 						array_multisort($sort5, $dir, $data);
		// 						break;
		// 					case 6: 
		// 						array_multisort($sort6, $dir, $data);
		// 						break;	
		// 					case 7: 
		// 						array_multisort($sort7, $dir, $data);
		// 						break;
		// 					case 8: 
		// 						array_multisort($sort8, $dir, $data);
		// 						break;
		// 					case 9: 
		// 						array_multisort($sort9, $dir, $data);
		// 						break;	
		// 					case 10: 
		// 						array_multisort($sort10, $dir, $data);
		// 						break;
		// 					default:
		// 						array_multisort($sort1, $dir, $data);
		// 				}
		// 			}
		// 		}
		// 	}

			
			if ( isset($_REQUEST['start']) && $_REQUEST['length'] != -1 ) {
				$data = array_slice($data, intval($_REQUEST['start']), intval($_REQUEST['length']));
			}

			// Format data for displayed if needed
			
			for ($i=0;$i<count($data);$i++)
			{	
				$data[$i][2] = date('d-m-Y', strtotime($data[$i][2])); // Date formatting
				// var_dump($data[$i][1]);
			}

		// }

		// return result
		$result = array(
			"draw" => isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 0,
			"recordsTotal" => $total_record,
			"recordsFiltered" => $urut,
			"data" => $data,
			/* for debug purpose 
			"table" => $table,
			*/
		);

		

	}
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

?>

