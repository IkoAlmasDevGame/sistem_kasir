<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin"){
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=Laporan_Supplier (".date('d-m-Y').").xls");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Supplier</title>
    </head>

    <center>
        <h4>Laporan Supplier Tahun ini <?php echo date('Y') ?></h4>
    </center>
    <table class="w-100 display" border="1">
        <tr>
            <th>No</th>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat Supplier</th>
            <th>Telepon Supplier</th>
        </tr>
        <?php 
            $no = 1;
            $row = $supplier->Read("SELECT * FROM supplier order by id asc");
            while($isi = $row->fetch_array()){
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $isi['kode_supplier'] ?></td>
            <td><?php echo $isi['nama_supplier'] ?></td>
            <td><?php echo $isi['alamat'] ?></td>
            <td><?php echo $isi['telepon'] ?></td>
        </tr>
        <?php
        $no++;
            }
        ?>
    </table>
    <?php require_once("../ui/footer.php"); ?>