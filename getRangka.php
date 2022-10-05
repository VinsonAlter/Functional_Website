<?php 
    require_once ('../../config.php');
	require_once (BASE_PATH.DS.'koneksisqlsrv.php');
	require_once ('functions.php');
	// require_once('init.php');

    if(isset($_POST['rangka'])){
        $pdo = new PDO($dsn1, 'sa', 'Brav02010IT');
        // $pdo = new PDO($dsn1_dummy, 'sa', 'Brav02010IT');
        $rangka = $_POST['rangka'];
        $query = "SELECT * FROM (SELECT '100011' AS cabang, NoRangka FROM [SALES-100011].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100011].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' UNION ALL
        SELECT '100706' AS cabang, NoRangka FROM [SALES-100706].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100706].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '') temp WHERE NoRangka = '$rangka'";
        // $query = "SELECT * FROM (SELECT '100011' AS cabang, NoRangka FROM [SALES-100011-dummy].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100011-dummy].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' UNION ALL
        // SELECT '100706' AS cabang, NoRangka FROM [SALES-100706-dummy].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100706-dummy].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '') temp WHERE NoRangka = '$rangka'";
        $stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		$stmt->execute();		
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data = array(
                    'cabang' => $row['cabang'],
                    'rangka' => $row['NoRangka']
                );
            }
            $res['success'] = 1;
            $res['data'] = $data;
            $pdo = null;
        } else {
        $res['success'] = 0;
        $res['message'] = "You have no access to this page.";
    }
    
    echo json_encode($res);
    
    }

    
?>