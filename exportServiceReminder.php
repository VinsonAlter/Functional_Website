<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
 
	<?php
    session_start();
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Export-Service-Reminder.xls");
    date_default_timezone_set('Asia/Jakarta');
	?>
 
	<table border="1">
		<tr>
            <th>No</th>
			<th>Tgl DO</th>
			<th>Tipe</th>
			<th>No Seri</th>
			<th>No Mesin</th>
			<th>No Rangka</th>
			<th>Warna</th>
			<th>Nama Customer</th>
			<th>Telepon Customer</th>
			<th>Nama STNK</th>
			<th>No Polisi</th>
		</tr>
		<?php 
		// koneksi database
		        include "../../koneksisqlsrv.php";
				include "functions.php";
                include "../../koneksi.php";

                if(!isset($_SESSION['username'])) {
                    header("location:../index.php");
                }

				$tanggalAwal = $_POST['tanggalAwal'];
				$tanggalAkhir = $_POST['tanggalAkhir'];
				echo "Tanggal DO Dari : $tanggalAwal <br> Sampai Tanggal : $tanggalAkhir";
                
                // query menampilkan data
                if ($pdo = new PDO($dsn1, 'sa', 'Brav02010IT', $pdo_option)) {
                    $urut = 1;
                    $query = "SELECT * FROM (SELECT TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100011].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100011].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($tanggalAwal)."' AND '" .date_to_str($tanggalAkhir)."' UNION ALL
                                            SELECT TglDO, DeskripsiTipe, NoSeri, NoMesin, NoRangka, DeskripsiWarna, NamaSO, c.Telp, c.Nama, NoPolisi FROM [SALES-100706].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO LEFT JOIN [SALES-100706].[dbo].[Tb_Customer] c ON do.KontrakID = c.CustID WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' AND CONVERT(VARCHAR(10), TglDO, 23) BETWEEN '" .date_to_str($tanggalAwal)."' AND '" .date_to_str($tanggalAkhir)."' ) temp ORDER BY TglDO ASC";
                    $stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
                    $stmt->execute();		
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            
                    ?>
                    <tr>
                        <td><?php echo $urut++; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['TglDO'])); ?></td>
                        <td><?php echo $row['DeskripsiTipe']; ?></td>
                        <td>'<?php echo $row['NoSeri']; ?></td>
                        <td><?php echo $row['NoMesin']; ?></td>
                        <td><?php echo $row['NoRangka']; ?></td>
                        <td><?php echo $row['DeskripsiWarna']; ?></td>
                        <td><?php echo $row['NamaSO']; ?></td>
                        <td>'<?php echo $row['Telp']; ?></td>
                        <td><?php echo $row['Nama']; ?></td>
                        <td><?php echo $row['NoPolisi']; ?></td>
                    </tr>
                    <?php 
                            }

                            $user = $_SESSION['username'];
                            $tanggalExport = date('Y-m-d H:i:s');
                            $tanggalAwal = date_to_str($_POST['tanggalAwal']);
                            $tanggalAkhir = date_to_str($_POST['tanggalAkhir']);
                            $exportService = "INSERT INTO export_service_log set nama_login='$user', tanggal_export='$tanggalExport', start_date='$tanggalAwal', end_date='$tanggalAkhir', user_activity='Export'"; 
                            $export = mysqli_query($koneksi, $exportService);

                        } 
                        
                    }
                    ?>
                
	</table>
</body>
</html>