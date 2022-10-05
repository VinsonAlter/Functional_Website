<?php

  session_start();

  require_once ('../../../config.php');

  require_once (BASE_PATH.DS.'koneksi.php');

  require_once ('../../library/ssp.cls.php');

  require_once ('../functions.php');

  $counter = 0;


  function BuildCounter() {

    global $counter;

    $counter += 1;

    return $counter;

  }

  $table = <<<EOT
  (
    SELECT `id`, `nama_login`, `tanggal_export`, `start_date`, `end_date`, `user_activity` FROM `export_service_log`
  ) temp
  EOT;

  $primaryKey = 'id';

  $func_apply = 'BuildCounter';



  $columns = array(

    array(

      'db' => 'id',

      'dt' => 0,

      'formatter' => function () use ($func_apply){

        return $func_apply();

      }

    ),

    array('db' => 'nama_login', 'dt' => 1),

    array(

        'db' => 'tanggal_export',
  
        'dt' => 2,
  
        'formatter' => function ($d, $row) {
  
          return date('d-m-Y H:i:s', strtotime($d));
  
        }
  
    ),

    array(

        'db' => 'start_date',
  
        'dt' => 3,
  
        'formatter' => function ($d, $row) {
  
          return date('d-m-Y', strtotime($d));
  
        }
  
    ),

    array(

        'db' => 'end_date',
  
        'dt' => 4,
  
        'formatter' => function ($d, $row) {
  
          return date('d-m-Y', strtotime($d));
  
        }
  
    ),

    array(

      'db' => 'user_activity',

      'dt' => 5

    )

  );

	$sql_details = array(

		'user' => $user,

		'pass' => $pass,

		'db' => $db_name,

		'host' => $host

	);

  echo json_encode(SSP::simple($_GET,$sql_details,$table,$primaryKey,$columns));

?>