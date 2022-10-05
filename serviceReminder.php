<?php 

	date_default_timezone_set('Asia/Jakarta');

	require_once ('../../config.php');

	require_once (BASE_PATH.DS.'koneksi.php');

	require_once (BASE_PATH.DS.'koneksisqlsrv.php');

	require_once('init.php');

	require_once ('functions.php');

	$tanggalAwal = date('01-m-Y');

	$tanggalAkhir = date('d-m-Y');

	


	if(isset($_POST['filter']))

	{

		$_SESSION['FilterChecklistDateFrom'] = $_POST['tanggalAwal'];

		$_SESSION['FilterChecklistDateTo'] = $_POST['tanggalAkhir'];

		$user = $_SESSION['username'];

        $tanggalExport = date('Y-m-d H:i:s');

        $tanggalAwal = date_to_str($_POST['tanggalAwal']);

        $tanggalAkhir = date_to_str($_POST['tanggalAkhir']);

        $exportService = "INSERT INTO export_service_log set nama_login='$user', tanggal_export='$tanggalExport', start_date='$tanggalAwal', end_date='$tanggalAkhir', user_activity='Filter'"; 
        
		$export = mysqli_query($koneksi, $exportService);

	}

	if(isset($_SESSION['FilterChecklistDateFrom'])) $tanggalAwal = $_SESSION['FilterChecklistDateFrom'];

	if(isset($_SESSION['FilterChecklistDateTo'])) $tanggalAkhir = $_SESSION['FilterChecklistDateTo'];

?>

<!DOCTYPE html>

<html lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<!-- Meta, title, CSS, favicons, etc. -->

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="images/logo/sardana.png" type="image/ico" />



		<title>PT. Sardana IndahBerlian Motor</title>



		<!-- Bootstrap -->

		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Font Awesome -->

		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

		<!-- NProgress -->

		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

		<!-- iCheck -->

		<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

	

		<!-- bootstrap-progressbar -->

		<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

		<!-- JQVMap -->

		<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

		<!-- bootstrap-daterangepicker -->

		<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

		<!-- bootstrap-datepicker -->

		<link href="../vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
		
		<!-- Datatables -->

		<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

		<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">

		<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

		<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

		<link href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css" rel="stylesheet">

		<link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css">

		<!-- DataTable checkbox -->

		<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
		
		<!-- Custom Theme Style -->

		<link href="../build/css/custom.min.css" rel="stylesheet">

		<link href="../build/css/custom.css" rel="stylesheet">

		<style type="text/css">

			input[type=number] {

				-moz-appearance: textfield;

				text-align: left;

			}

			input[type=number]::-webkit-inner-spin-button, 

			input[type=number]::-webkit-outer-spin-button { 

				-webkit-appearance: none; 

				margin: 0; 

			}

			span {

			    caret-color:#169F85;

			}

			.required:before {

				content: "* ";

				color: red;

			}

			.input-textarea {

				resize: none;

			}

			
			div.dataTables_wrapper div.dataTables_processing {
				height: 100%;
				width: 100%;
				position: fixed;
				top: 0;
				left: 0;
				margin-top:1px;
				margin-left:1px;
				z-index: 99999;
				background-color: gray;
				filter: alpha(opacity=50);
				-moz-opacity: 0.50;
				opacity: 0.50;
			}

			div.dataTables_wrapper div.dataTables_processing .sk-fading-circle{
				position: absolute;
				top: 50%;
				left: 50%;
			}

			.highlight {

				background-color: yellowgreen !important;

			}

		</style>

	</head>



	<body class="nav-md">

		<div class="container body">

			<div class="main_container">

				<?php

					include 'header.php';

				?>



				<!-- page content -->

				<div class="right_col" role="main">

					<!-- top tiles -->

					<div class="row tile_count">

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Total Users</span>

							<div class="count">

								<?php
	
									$sql = "select count(*) AS jumlah from useraccounts";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Suara Pelanggan</span>

							<div class="count">

								<?php

									$sql = "select count(*) AS jumlah from suarapelanggan";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Booking Service</span>

							<div class="count">

								<?php

									$sql = "select count(*) AS jumlah from bookingservice";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Test Drive</span>

							<div class="count">

								<?php

									$sql = "select count(*) AS jumlah from testdrive";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Testimoni</span>

							<div class="count">

								<?php

									$sql = "select count(*) AS jumlah from testimoni";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

							<span class="count_top"><i class="fa fa-user"></i> Konsultasi Pembelian</span>

							<div class="count">

								<?php

									$sql = "select count(*) AS jumlah from hubungisaya";

									$query = mysqli_query($koneksi,$sql);

									$result = mysqli_fetch_array($query);

									echo "{$result['jumlah']}";

								?>

							</div>

						</div>

					</div>

					
					

					<!-- page content -->

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">

							<div class="x_panel">

								<div class="x_title">

									<h2>List Service Reminder</h2>

									<div class="clearfix"></div>

								</div>

								<form class="form-horizontal" method="post" action="" role="form">

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">
												
												<label class="col-sm-2 col-xs-12 control-label">Tanggal</label>

												<div class="col-md-4 col-xs-5"><input class="form-control datepicker" type="text" name="tanggalAwal" id = "tanggalAwal" value="<?php echo $tanggalAwal; ?>" required></div>

												<div class="col-md-1 col-xs-2 control-label">s/d.</div>

												<div class="col-md-4 col-xs-5"><input class="form-control datepicker" type="text" name="tanggalAkhir" id = "tanggalAkhir" value="<?php echo $tanggalAkhir; ?>"  required></div>

											</div>

										</div>

										<div class="col-md-6" style="margin-bottom:20px">

											<div class="form-group">

												<div class="col-md-8 col-md-offset-2">

												<button class="btn btn-success" type="submit" name = "filter" id = "filter">Filter</button>

                                                <button class="btn btn-warning" type="button" data-toggle="modal" data-target=".bs-example-modal-sm">Export to Excel</button>

												<button class="btn btn-primary" type="button" data-toggle="modal" data-target=".bs-modal-submit" id="Edit" name="Edit">Edit</button>

												<!-- <?php

													// $pdo = new PDO($dsn1, 'sa', 'Brav02010IT');

													// $query = "SELECT * FROM (SELECT '100011' AS cabang, NoRangka FROM [SALES-100011].[dbo].[Tb_SO] so LEFT JOIN [SALES-100011].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100011].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100011].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100011].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '' UNION ALL

													// 		 	SELECT '100706' AS cabang, NoRangka FROM [SALES-100706].[dbo].[Tb_SO] so LEFT JOIN [SALES-100706].[dbo].[Tb_StockTebus] st ON so.NoSO = st.NoSO LEFT JOIN [SALES-100706].[dbo].[Tb_Merek] m ON st.KodeTipe = m.KodeTipe AND st.KodeWarna = m.KodeWarna LEFT JOIN [SALES-100706].[dbo].[Tb_Customer] c ON so.RegistrasiID = c.CustID LEFT JOIN [SALES-100706].[dbo].[Tb_DO] do ON st.NoDO = do.NoDO WHERE m.Kategori IN ('PC', 'LCV') AND st.NoDO <> '') temp";

													// $stmt = $pdo->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);

													// $stmt->execute();

													// if ($stmt->rowCount() > 0) {

													// 	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

													// 		$cabang = $row['cabang'];

													// 		$rangka = $row['NoRangka'];

													// 	?>

														<tr>

															<td><a class="btn btn-primary" type="button" data-toggle="modal" data-target=".bs-modal-submit" onclick="getRangka(<?=$rangka?>)">Edit</a></td>

														</tr>

													<?php // }

													// $pdo = null;	

													// }

													?> -->
											
											</div>

										</div>

									</div>

								</form>

								<table id="service-remind" class="table table-striped table-bordered" style="margin-top: 40px">

									<thead>

										<tr>

											<th style="width:30px"><input type = "checkbox" id = "select-all" onclick=""></th>

											<th style="width:20px">No</th>

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

											<th width="70px">Aksi</th>

										</tr>

									</thead>

								</table>

							</div>

						</div>

					</div>

				</div>

				<!-- footer content -->

				<?php

					include 'footer.php';

				?>

				<!-- export modal content -->

				<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

					<div class="modal-dialog" role="document">

						<div class="modal-content">

							<div class="modal-header">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

								<h4 class="modal-title">Pilih Tanggal</h4>

							</div>

							<form method="post" action="exportServiceReminder.php" class="form-inline">

								<div class="modal-body">

									<div class="form-group">

										<!--<input type="date" name="tanggalAwal" class="form-control">-->

										<input class="form-control datepicker-2" type="text" name="tanggalAwal" id="tanggalAwal" value="<?php echo $tanggalAwal; ?>" required>

										<label>-</label>

										<!--<input type="date" name="tanggalAkhir" class="form-control">-->

										<input class="form-control datepicker-2" type="text" name="tanggalAkhir" id="tanggalAkhir" value="<?php echo $tanggalAkhir; ?>" required>

									</div>

								</div>

								<div class="modal-footer">

									<div class="form-group">

										<button type="submit" class="btn btn-success">Export</button>

									</div>

								</div>

							</form>

						</div>

					</div>

				</div>

				

				<!-- Status Follow Up Edit Modal -->

				<div class="modal fade bs-modal-sm" id="modalInsertFollow" tabindex="-1" role="dialog" aria-labelledby="modalInsertFollowTitle" aria-hidden="true">

					<div class="modal-dialog modal-dialog-centered" role="document">

						<div class="modal-content">

							<div class="modal-header">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									
									<span aria-hidden="true" id="modalInsertFollowTitle">&times;</span>

								</button>

								<h4 class="modal-title">Edit Status Follow Up</h4>

							</div>

							<div class="modal-body">
							
							<form class="form-horizontal" id="frm-insert" method="post" action="javascript:initInsert()" role="form">

							  <div class = "form-group">

							  	  <div class = "col-xs-8">

									<input type="hidden" class="form-control" name="cabang" id="cabang">

								  </div>

							  </div>
							
							  <div class="form-group">

                                  <label class="col-xs-4 control-label">No Rangka Mobil</label>

                                  <div class="col-xs-8">

                                    <input type="text" class="form-control" readonly = "readonly" name="rangka" id="rangka">

                                  </div>

                              </div>

                              <div class="form-group">

                                  <label for="tanggalAkhir" class="col-xs-4 control-label required">Tanggal Follow Up</label>

                                  <div class="col-xs-8">

                                    <input type="text" class="form-control datepicker-3" name="tanggalAkhir" id="tanggalAkhir" value="<?php echo $tanggalAkhir; ?>" required>

                                  </div>

                              </div>   
							  
							  <div class="form-group">

								  <label for="input-textarea" class="col-xs-4 control-label required">Status Follow Up</label>

								  <div class="col-xs-8">

								  	<textarea class="form-control input-textarea" id="input-textarea" rows="5" name="catatan" required></textarea>

								  </div>

							  </div>

							  <div class="form-group">

							  	  <label class="col-xs-4 control-label required">Follow Up Via</label>

								  <div class="col-xs-8">

									<select id="call-method" class="form-control" name = "panggilan" required>

										<option value=""></option>

										<option value="Phone">Phone</option>

										<option value="Whatsapp">Whatsapp</option>

										<option value="Email">Email</option>

										<option value="SMS">SMS</option>

									</select>

								  </div>

							  </div>

							  <div class="form-group">

								<label class="col-xs-4 control-label required">Status Follow Up</label>

								<div class="col-xs-8" style="padding-top:7px">

									<div>

										<input type="radio" id="berhasil" name="status_panggilan" value = "Berhasil Dihubungi" checked="checked" required>

										<label for="berhasil">Berhasil Dihubungi</label>

									</div>

									<div>

										<input type="radio" id="tidak-berhasil" name="status_panggilan" value="Tidak Berhasil Dihubungi" >

										<label for="tidak-berhasil">Tidak Berhasil Dihubungi</label>

									</div>
								
								</div>

							  </div>
				
							</div>

							<div class="modal-footer">

								<button type="submit" name = "btn_insert" class="btn btn-primary">Simpan</button>

								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							
							</div>

							</form>

						</div>

					</div>

				</div>

				<!-- View Datatable modal -->

				<div class = "modal fade bs-modal-table" id="modalViewTable" tabindex="-1" role="dialog" aria-labelledby="modalViewTableTitle" aria-hidden="true">

					<div class="modal-dialog modal-dialog-centered" role="document">

						<div class="modal-content">

							<div class="modal-header">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									
									<span aria-hidden="true" id="modalViewTableTitle">&times;</span>

								</button>

								<h4 class="modal-title">View Status Follow Up</h4>

							</div>

							<div class="modal-body">

								<table id="remind-view" class="table table-striped table-bordered" style="margin-top: 40px">

									<thead>

										<tr>

											<th style="width:20px">No</th>

											<th>No Rangka</th>

											<th>Tanggal Follow</th>

											<th>Catatan Follow</th>

											<th>Status Follow</th>

											<th>Follow Via</th>

											<th>Follow Oleh</th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td></td>

											<td></td>

											<td></td>

											<td></td>

											<td></td>

											<td></td>

											<td></td>

										</tr>


									</tbody>

								</table>

							</div>

							<div class="modal-footer">

								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

							</div>

						</div>

					</div>

				</div>

				<!-- Submit Batch Modals -->

				<div class="modal fade bs-modal-submit" id="modalSubmitFollow" tabindex="-1" role="dialog" aria-labelledby="modalSubmitFollowTitle" aria-hidden="true">

					<div class="modal-dialog modal-dialog-centered" role="document">

						<div class="modal-content">

							<div class="modal-header">

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									
									<span aria-hidden="true" id="modalSubmitFollowTitle">&times;</span>

								</button>

								<h4 class="modal-title">Edit Status Follow Up</h4>

							</div>

							<div class="modal-body">
							
							<form class="form-horizontal" id="frm-submit" method="post" action="javascript:initInsertBatch()" role="form">

                              <div class = "form-group">

								<input type = "hidden" class="form-control" name="batch" id="batch" >

							  </div>
							
							  <div class="form-group">

                                  <label for="tanggalAkhir" class="col-xs-4 control-label required">Tanggal Follow Up</label>

                                  <div class="col-xs-8">

                                    <input type="text" class="form-control datepicker-3" name="tanggalAkhir" id="tanggalAkhir" value="<?php echo $tanggalAkhir; ?>" required>

                                  </div>

                              </div>   
							  
							  <div class="form-group">

								  <label for="input-textarea" class="col-xs-4 control-label required">Status Follow Up</label>

								  <div class="col-xs-8">

								  	<textarea class="form-control input-textarea" id="input-textarea" rows="5" name="catatan" required></textarea>

								  </div>

							  </div>

							  <div class="form-group">

							  	  <label class="col-xs-4 control-label required">Follow Up Via</label>

								  <div class="col-xs-8">

									<select id="call-method" class="form-control" name = "panggilan" required>

										<option value=""></option>

										<option value="Phone">Phone</option>

										<option value="Whatsapp">Whatsapp</option>

										<option value="Email">Email</option>

										<option value="SMS">SMS</option>

									</select>

								  </div>

							  </div>

							  <div class="form-group">

								<label class="col-xs-4 control-label required">Status Follow Up</label>

								<div class="col-xs-8" style="padding-top:7px">

									<div>

										<input type="radio" id="berhasil-1" name="status_panggilan" value = "Berhasil Dihubungi" checked="checked" required>

										<label for="berhasil-1">Berhasil Dihubungi</label>

									</div>

									<div>

										<input type="radio" id="tidak-berhasil-1" name="status_panggilan" value="Tidak Berhasil Dihubungi" >

										<label for="tidak-berhasil-1">Tidak Berhasil Dihubungi</label>

									</div>
								
								</div>

							  </div>
				
							</div>

							<div class="modal-footer">

								<button type="submit" name = "btn_submit" class="btn btn-primary">Simpan</button>

								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							
							</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- jQuery -->

		<script src="../vendors/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap -->

		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

		<!-- FastClick -->

		<script src="../vendors/fastclick/lib/fastclick.js"></script>

		<!-- NProgress -->

		<script src="../vendors/nprogress/nprogress.js"></script>

		<!-- Chart.js -->

		<script src="../vendors/Chart.js/dist/Chart.min.js"></script>

		<!-- gauge.js -->

		<script src="../vendors/gauge.js/dist/gauge.min.js"></script>

		<!-- bootstrap-progressbar -->

		<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

		<!-- iCheck -->

		<script src="../vendors/iCheck/icheck.min.js"></script>

		<!-- Skycons -->

		<script src="../vendors/skycons/skycons.js"></script>

		<!-- Flot -->

		<script src="../vendors/Flot/jquery.flot.js"></script>

		<script src="../vendors/Flot/jquery.flot.pie.js"></script>

		<script src="../vendors/Flot/jquery.flot.time.js"></script>

		<script src="../vendors/Flot/jquery.flot.stack.js"></script>

		<script src="../vendors/Flot/jquery.flot.resize.js"></script>

		<!-- Flot plugins -->

		<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>

		<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>

		<script src="../vendors/flot.curvedlines/curvedLines.js"></script>

		<!-- DateJS -->

		<script src="../vendors/DateJS/build/date.js"></script>

		<!-- JQVMap -->

		<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>

		<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>

		<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

		<!-- bootstrap-daterangepicker -->

		<script src="../vendors/moment/min/moment.min.js"></script>

		<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!-- bootstrap-datepicker -->

		<script src="../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		
		<!-- Datatables -->

		<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>

		<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

		<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

		<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>

		<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>

		<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>

		<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

		<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>

		<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>

		<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

		<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

		<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

		<script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>

		<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
		
		<!-- Datatable Checkbox -->

		<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
		
		<!-- Input Numeric -->

		<script src="./js/input-numeric.js"></script>

		<!-- Custom Theme Scripts -->

		<script src="../build/js/custom.min.js"></script>

	</body>

	    <script>


	        $(document).ready(()=>{

				$('#Edit').click(function() {

					var checkValues = $('#checkboxes:checked').map(function()

					{

						return $(this).val();

					}).get();

					var CheckValues = checkValues.join(" ; ");

					// console.log(CheckValues);

					$('#batch').val(CheckValues);

					// $.ajax({

					// 	url: 'getBatch.php',

					// 	type: 'post',

					// 	data: {batch: checkValues},

					// 	success: result => {

					// 		const res = $.parseJSON(result);

					// 		// console.log(res);

					// 		console.log(res['data']);

					// 		var value = $('#batch').val();

					// 		if (value != '') value += ' ; ';

					// 		// bagian ini masih undefined

					// 		value += res.data.cabang + ' , ' + res.data.rangka;
						
					// 		$('#batch').val(value);

					// 	},

					// 	error: err => {

					// 	// console.error(err.statusText);

					// 	alert('Data Failed to Load, Please Try Again Later');

					// }

					// });

        		});

		


				
				$(".datepicker").datepicker({

					format: 'dd-mm-yyyy',

					daysOfWeekDisabled: "0",

					autoclose: true,

					todayHighlight: true
				})

				$(".datepicker-2").datepicker({

					format: "dd-mm-yyyy",

					daysOfWeekDisabled: "0",

					autoclose: true,

					todayHighlight: true

				});

				$(".datepicker-3").datepicker({

					format: "dd-mm-yyyy",

					daysOfWeekDisabled: "0",

					autoclose: true,

					todayHighlight: true

				});

				$(".datepicker-4").datepicker({

					format: "dd-mm-yyyy",

					daysOfWeekDisabled: "0",

					autoclose: true,

					todayHighlight: true

				});

				var servicetable = $('#service-remind').DataTable({

					"processing" : true,

					"language": {

						// "processing": '<i class="fa fa-refresh fa-spin fa-3x fa-fw" style="color:rgb(75, 183, 245);"></i>'

						"processing": '<div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'

					},

					"serverSide" : true,

					"deferRender" : true,

					"stateSave" : true,

					"stateDuration" : -1,

					"pageLength" : 10,

					"ajax": {

						url: 'json/data-service-reminder.php',

					},

					"fixedColumns" : {

						left: 7

					},
					
					"columnDefs": [

						{ orderable: false, targets: [0, 1]},
					
					],


					"order": [[2, "asc"]],	

					"drawCallback": function( settings ) {

						$("input[type=checkbox]").prop('checked', false);

						$("input[type=checkbox]").closest('tr').removeClass('highlight');

						// work around fixedColumns highlight

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').removeClass('highlight');

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').nextUntil('tr .dtfc-fixed-left:nth-child(8)').removeClass('highlight');

					}

				});

			
				/* column pagination order */
				servicetable.on( 'draw.dt', () => {

				/* initiate tooltip */

				$('[data-toggle="tooltip"]').tooltip();

				/* initiate checkbox highlight */

				$('tr').find("input[type='checkbox']").on('click', function() {

					if ($(this).prop('checked') === true) {

						$(this).closest('tr').addClass('highlight');

						// work around fixedColumns highlight

						$(this).closest('tr .dtfc-fixed-left').addClass('highlight');

						$(this).closest('tr .dtfc-fixed-left').nextUntil('tr .dtfc-fixed-left:nth-child(8)').addClass('highlight');

					
					} else {

						$(this).closest('tr').removeClass('highlight');

						// work around fixedColumns highlight

						$(this).closest('tr .dtfc-fixed-left').removeClass('highlight');

						$(this).closest('tr .dtfc-fixed-left').nextUntil('tr .dtfc-fixed-left:nth-child(8)').removeClass('highlight');	  
				

					}

				});

				/* initiate select all checkboxes highlight */ 

				$('tr').find('#select-all').on('click', function() {

					$("input[type=checkbox]").prop('checked', $(this).prop('checked'));

					if ($(this).prop('checked') === true) {

						$("input[type=checkbox]").closest('tr').addClass('highlight');

						// work around fixedColumns highlight

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').addClass('highlight');

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').nextUntil('tr .dtfc-fixed-left:nth-child(8)').addClass('highlight');


					} else {

						$("input[type=checkbox]").closest('tr').removeClass('highlight');

						// work around fixedColumns highlight

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').removeClass('highlight');

						$("input[type=checkbox]").closest('tr .dtfc-fixed-left').nextUntil('tr .dtfc-fixed-left:nth-child(8)').removeClass('highlight');

					}

				});

				


				const PageInfo = $('#service-remind').DataTable().page.info()

				servicetable.column(1, { page: 'current' }).nodes().each((cell, i) => {

						cell.innerHTML = i + 1 + PageInfo.start

					})

				})

				
				
				
				

	        })

			function getRangka(cabang, rangka) {

				$.ajax({

					type: "post",

					url: "getRangka.php",

					data: {cabang: cabang, rangka: rangka},

					success: result => {

						const res = $.parseJSON(result);

						$('#cabang').val(res.data.cabang);

						$('#rangka').val(res.data.rangka);

						// var value = $('#batch').val();

						// if (value != '') value += ' ; ';

						// value += res.data.cabang + ' , ' + res.data.rangka;
						
						// $('#batch').val(value);
	

					},

					error: err => {

						// console.error(err.statusText);

						alert('Data Failed to Load, Please Try Again Later');

					}

				})

			};

			function initInsert() {

				$.ajax({

					type: "post",

					url: "json/insertFollowUp.php",

					data: $('#frm-insert').serialize(),

					success: result => {

						const res = $.parseJSON(result);

						if(res.success == 1) {

							$('#modalInsertFollow').modal('hide');

						} alert(res.message);

					},

					error: err => {

						console.error(err.statusText);

					}

				})

			}

			function initView(cabang, rangka) {

			// console.log(cabang);

			// console.log(rangka);

			

				var viewtable = $('#remind-view').DataTable({

					"processing" : true,

					"searching": false,

					"language": {

						// "processing": '<i class="fa fa-refresh fa-spin fa-3x fa-fw" style="color:rgb(75, 183, 245);"></i>'

						"processing": '<div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'

					},

					"serverSide" : true,

					"deferRender" : true,

					"stateSave" : true,

					"stateDuration" : -1,

					"pageLength" : 10,

					"ajax": {

						url: 'json/data-view-followUp.php',

						data: {cabang: cabang, rangka: rangka}

					},

					"columnDefs": [

						{targets: [0, 1, 2, 3, 4, 5, 6], orderable: false},

					],

					initComplete: function( settings, json ) {
						$("th").removeClass('sorting_asc'); //remove sorting_desc class
					}

				});

				

				/* column pagination order */
				viewtable.on( 'draw.dt', () => {
				const PageInfo = $('#remind-view').DataTable().page.info()
				viewtable.column(0, { page: 'current' }).nodes().each((cell, i) => {
						cell.innerHTML = i + 1 + PageInfo.start
					})
				})		

	        }

			// destroy the current table when modal is hidden
			$('#modalViewTable').on('hidden.bs.modal', () => {

				$('#remind-view').dataTable().fnDestroy();

			});

			function initInsertBatch() {

				$.ajax({

					type : "post",

					url : "json/insertBatchFollowUp.php",

					data : $('#frm-submit').serialize(),

					success: result => {

						const res = $.parseJSON(result);

						if(res.success == 1) {

							$('#modalSubmitFollow').modal('hide');

						} alert(res.message);

					},

					error: err => {

						console.error(err.statusText);

					}


				})

			}


	    </script>

</html>

