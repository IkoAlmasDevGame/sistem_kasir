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
                header("Content-Disposition: attachment; filename=Laporan_Gudang (".date('d-m-Y').").xls");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Gudang</title>
    </head>

    <center>
        <h4>Laporan Gudang Tahun ini <?php echo date('Y'); ?></h4>
    </center>
    <table class="display w-100" border="1">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Jumlah Barang</th>
            <th>Satuan</th>
        </tr>
        <?php 
            $no = 1;
            $row = $gudang->Read("SELECT * FROM gudang order by id asc");
            while ($isi = $row->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $isi['kode_barang'] ?></td>
            <td><?php echo $isi['nama_barang'] ?></td>
            <td><?php echo $isi['jenis_barang'] ?></td>
            <td><?php echo $isi['jumlah'] ?></td>
            <td><?php echo $isi['satuan'] ?></td>
        </tr>
        <?php
        $no++;
            }
        ?>
    </table>
    <?php require_once("../ui/footer.php"); ?>