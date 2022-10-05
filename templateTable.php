<?php
    session_start();
    include '../../koneksi.php';

    $login = $_SESSION['nama_login'];
    $res = [];
    $otoritas = array();
    $checkOtoritas = "SELECT otoritas FROM template a LEFT JOIN useraccounts b ON a.namaTemplate = b.Template WHERE nama_login = '$login'";
    $hasilCheck = mysqli_query($koneksi, $checkOtoritas);
    while ($row = mysqli_fetch_assoc($hasilCheck)){
        $otoritas = explode(',', $row['otoritas']);
    }

    if (in_array(9, $otoritas)){
        $tampil = "select * from template";
        $hasil = mysqli_query($koneksi,$tampil);
        $no = 1;
        while($row = mysqli_fetch_assoc($hasil)){
            $id = $row['id'];
            $namaTemplate = $row['namaTemplate'];
            $otoritas = $row['otoritas'];                  
        ?>
                            
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['namaTemplate']; ?></td>
                <td><?php echo $row['otoritas']; ?></td>
                <td>
                    <a class="btn btn-success" onclick = "getDetail(<?=$id?>)" data-toggle="modal" data-target="#modalEditOtoritas" ><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" onclick = "initHapus(<?=$id?>)"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php
        }
    } else {
        echo("You are not allowed to view this data!");
    }
?>