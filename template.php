<?php require_once('init.php');?>
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
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                  include '../../koneksi.php';
                  $sql = "select count(*) AS jumlah from useraccounts";
                  $query = mysqli_query($koneksi,$sql);
                  $result = mysqli_fetch_array($query);
                  echo "{$result['jumlah']}";
                ?>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Suara Pelanggan</span>
              <div class="count green">
                <?php
                  include '../../koneksi.php';
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
                  include '../../koneksi.php';
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
                  include '../../koneksi.php';
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
                  include '../../koneksi.php';
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
                  include '../../koneksi.php';
                  $sql = "select count(*) AS jumlah from hubungisaya";
                  $query = mysqli_query($koneksi,$sql);
                  $result = mysqli_fetch_array($query);
                  echo "{$result['jumlah']}";
                ?>
              </div>
            </div>
          </div>
          <!-- /top tiles -->

<!-- Insert User Accounts-->
<?php
  include '../../koneksi.php';
  if(isset($_POST['insertUserAccounts']))
  {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $template = $_POST['template'];
    $status = "Aktif";
    //echo "Nama = $nama <br> Password = $password <br> Template = $template";

    $insert="insert into useraccounts set nama='$nama', password='$password', template='$template', status='$status'";
    $eksekusi = mysqli_query($koneksi, $insert);

    if($eksekusi){
      echo"data berhasil diubah.<br>";
    }else{
      echo"data gagal diubah.<br>";
    }
  }
?>
         
          <!-- page content -->
          <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Penentuan Otoritas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Ketentuan No.</th>
                            <th>Nama Template</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Suara Pelanggan</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Booking Service</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Test Drive</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>News</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Newsletter</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Testimoni</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Konsultasi Pembelian</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>User Acccounts</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>Template</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>Bunga</td>
                          </tr>
                          <tr>
                            <td>11</td>
                            <td>Harga Mobil</td>
                          </tr> 
                          <tr>
                            <td>12</td>
                            <td>Konsultasi Pembelian -> Kategori: Semua</td>
                          </tr>
                          <tr>
                            <td>13</td>
                            <td>Konsultasi Pembelian -> Kategori: Sales</td>
                          </tr>
                          <tr>
                            <td>14</td>
                            <td>Konsultasi Pembelian -> Kategori: Sparepart</td>
                          </tr>
                          <tr>
                            <td>15</td>
                            <td>Konsultasi Pembelian -> Kategori: Service</td>
                          </tr>
                          <tr>
                            <td>16</td>
                            <td>Promo</td>
                          </tr>
                          <tr>
                            <td>17</td>
                            <td>Karir</td>
                          </tr>
                          <tr>
                            <td>18</td>
                            <td>KTP</td>
                          </tr>
                          <tr>
                            <td>19</td>
                            <td>Service Reminder</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>  
                  </div>
                </div>
              </div>
           
              <?php
                include '../../koneksi.php';
                if(isset($_POST['daftarTemplate'])){
                  $namaTemplate=$_POST['namaTemplate'];
                  $otoritas=$_POST['otoritas'];
                  // echo "Nama Template = $namaTemplate <br> Otoritas = $otoritas";

                  if(!empty($_POST['namaTemplate']) && !empty($_POST['otoritas'])){
                    $insert="insert into template set namaTemplate='$namaTemplate', otoritas='$otoritas'";
                    $eksekusi = mysqli_query($koneksi, $insert);

                  }
                  
                  if($eksekusi){
                    echo "<script>
                          alert('data berhasil ditambahkan')
                        </script>";
                  }else{
                    echo "<script>
                          alert('data gagal ditambahkan')
                        </script>";
                  }
                }

                // if(isset($_POST['tambahOtoritas'])){
                //   $namaTemplate = $_POST['namaTemplate'];
                //   $otoritas = $_POST['otoritas'];

                //   $update = "update template set otoritas = concat(otoritas, ',$otoritas') where namaTemplate = '$namaTemplate'";  
                //   $execute = mysqli_query($koneksi, $update);

                //   if(mysqli_affected_rows($koneksi) > 0){
                //     echo"<script>
                //             alert('data otoritas berhasil ditambahkan')
                //          </script>";
                //   }else{
                //     echo"<script>
                //             alert('data otoritas gagal ditambahkan, pastikan nama Template yang diinput benar')
                //          </script>";
                //   }
                // }

                // if(isset($_POST['hapusOtoritas'])){
                //   $namaTemplate = $_POST['namaTemplate'];
                //   $otoritas = $_POST['otoritas'];

                // //   $delete = "update template set otoritas = replace(otoritas, ',$otoritas', '') where namaTemplate = '$namaTemplate'";
                //   $delete = "update template set otoritas = 
                //              case $otoritas
                //                 when ',$otoritas' then
                //                 replace(otoritas, ',$otoritas', '')
                //                 when '$otoritas,' then
                //                 replace(otoritas, '$otoritas,', '')
                //                 when ',$otoritas,' then
                //                 replace(otoritas, ',$otoritas', '')
                //              end
                //              where namaTemplate = '$namaTemplate";
                //   $hapus = mysqli_query($koneksi, $delete);

                //   if(mysqli_affected_rows($koneksi) > 0){
                //     echo"<script>
                //             alert('data otoritas berhasil dihapus')
                //          </script>";
                //   }else{
                //     echo"<script>
                //             alert('data otoritas gagal dihapus, pastikan nama Template yang diinput benar')
                //          </script>";
                //   }
                // }

                
              ?>

              <div class="col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Template</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal" action="" method="post">
                      <div class="form-group">
                        <label class="col-xs-4 control-label">Nama Template</label>
                        <div class="col-xs-8">
                          <input type="text" class="form-control" name="namaTemplate">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-4 control-label">Otoritas</label>
                        <div class="col-xs-8">
                          <input type="text" class="form-control" name="otoritas">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-offset-4 col-xs-8">
                        <!-- <div class="col-xs-offset-1 col-xs-11"> -->
                          <button type="submit" name="daftarTemplate" class="btn btn-success">Daftar Template</button>
                          <!-- <button type="submit" name="tambahOtoritas" class="btn btn-primary">Tambah Otoritas</button>
                          <button type="submit" name="hapusOtoritas" class="btn btn-danger">Hapus Otoritas</button> -->
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Template</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id = "table-template" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th style = "width: 20px">No</th>
                            <th>Nama Template</th>
                            <th>Otoritas</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody id = "templateTable">

                        
                          

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class = "modal fade" id = "modalEditOtoritas" tabindex = "-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Edit Otoritas</h4>
                      </div>
                      <div class="modal-body">
                          <form class="form-horizontal" id="frm-update" method="post" action="javascript:initUpdate()" role="form">
                              <div class = "form-group">
                                <div class="col-xs-8">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-xs-4 control-label">Nama Template</label>
                                  <div class="col-xs-8">
                                      <input type="text" class="form-control" readonly = "readonly" name="template" id="template">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-xs-4 control-label">Otoritas</label>
                                  <div class="col-xs-8">
                                      <input type="text" class="form-control" name="otoritas" id="otoritas">
                                  </div>
                              </div>         
                      </div>
                      <div class="modal-footer">
                          <button type="submit" name = "btn_ubah_otoritas" class="btn btn-primary">Simpan</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php
          include 'footer.php';
        ?>
        <!-- /footer content -->
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

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

    <script>

      $(document).ready(() => {

        // load table content 

        $('#templateTable').load('templateTable.php');

        // $('.getDetail').click(function() {


      });

      function getDetail(id) {

            // var id = $(this).data('id');

            // console.log(id);


            $.ajax({

              type: "post",

              url: "getTemplate.php",

              data: {id: id},

              success: result => {

                const res = $.parseJSON(result);

                $('#id').val(res.data.id);

                $('#template').val(res.data.template);

                $('#otoritas').val(res.data.otoritas);

              },

              error: err => {

                // console.error(err.statusText);

                alert('Data Failed to Load, Please Try Again Later');

              }

            })

        };


      function initUpdate() {

        $.ajax({

            type: "post",

            url: "updateOtoritas.php",

            data: $('#frm-update').serialize(),

            success: result => {

              const res = $.parseJSON(result);

              if(res.success == 1) {

                $('#templateTable').load('templateTable.php');

                $('#modalEditOtoritas').modal('hide');

              }

              alert(res.message);

            },

            error: err => {

              // console.error(err.statusText)'

              // alert(err.statusText);

              alert('Otoritas Failed to Update, Please Try Again Later');

            }

          })

        }

        function initHapus(id) {

          // console.log(id);

          const conf = confirm(`Yakin Untuk Menghapus Data Ini?`);

          if(conf) {

            $.ajax({

              type: "post",

              url: "hapusOtoritas.php",

              data: {id: id},

              success: result => {

                const res = $.parseJSON(result);

                alert(res.message);

                $('#templateTable').load('templateTable.php');

                $('#modalEditOtoritas').modal('hide');

              },

              error: err => {

                  console.error(err.statusText);

                  // alert(err.statusText);

                  alert("Failed to Delete the Template, please try again later");

              }

            })

          }
        
        }

    </script>

    
  </body>
</html>

