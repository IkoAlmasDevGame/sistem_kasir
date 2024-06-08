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
            header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (".date('d-m-Y').").xls");
            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
        }else{
            header("location:../ui/header.php?page=beranda");
        }
        ?>
        <title>Export Excel Laporan Barang</title>
    </head>

    <?php
        if(isset($_POST['submit'])){
            $dari = $_POST['dari'];
            $ke = $_POST['ke'];
    ?>
    <center>
        <h4>Laporan Barang Masuk <?php echo $dari; ?> s/d <?php echo $ke; ?></h4>
    </center>
    <table border="1" class="display">
        <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>Tanggal Masuk</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Pengirim</th>
            <th>Jumlah Masuk</th>
            <th>Satuan Barang</th>
        </tr>
        <?php 
            $no = 1;
            $sql = "SELECT * FROM barang_masuk WHERE tanggal BETWEEN '$dari' and '$ke'";
            $row = $conn->query($sql);
            while ($isi = mysqli_fetch_array($row)) {
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $isi['id_transaksi'] ?></td>
            <td><?php echo $isi['tanggal'] ?></td>
            <td><?php echo $isi['kode_barang'] ?></td>
            <td><?php echo $isi['nama_barang'] ?></td>
            <td><?php echo $isi['pengirim'] ?></td>
            <td><?php echo $isi['jumlah'] ?></td>
            <td><?php echo $isi['satuan'] ?></td>
        </tr>
        <?php
        $no++;
            }
        ?>
    </table>
    <?php
        }else{
    ?>
    <center>
        <h4>Laporan Barang Masuk</h4>
    </center>
    <table border="1" class="display">
        <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>Tanggal Masuk</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Pengirim</th>
            <th>Jumlah Masuk</th>
            <th>Satuan Barang</th>
        </tr>
        <?php 
            $no = 1;
            $sql = "SELECT * FROM barang_masuk";
            $row = $conn->query($sql);
            while ($isi = mysqli_fetch_array($row)) {
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $isi['id_transaksi'] ?></td>
            <td><?php echo $isi['tanggal'] ?></td>
            <td><?php echo $isi['kode_barang'] ?></td>
            <td><?php echo $isi['nama_barang'] ?></td>
            <td><?php echo $isi['pengirim'] ?></td>
            <td><?php echo $isi['jumlah'] ?></td>
            <td><?php echo $isi['satuan'] ?></td>
        </tr>
        <?php
        $no++;
            }
        ?>
    </table>
    <?php
        }
    ?>
    <?php require_once("../ui/footer.php"); ?>