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
            header("Content-Disposition: attachment; filename=Laporan_Barang (".date('d-m-Y').").xls");
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
        $stok = 0;
        $hb = 0;
        $hj = 0;
        
        if(isset($_POST['submit'])){
    ?>
    <table class="display" border="1">
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Tanggal</th>
            <th style="text-align:center;">Kode Barang</th>
            <th style="text-align:start;">Nama Barang</th>
            <th style="text-align:center;">Kategori</th>
            <th style="text-align:center;">Jumlah</th>
            <th style="text-align:center;">Harga Beli</th>
            <th style="text-align:center;">Harga Jual</th>
            <th style="text-align:center;">Satuan Barang</th>
        </tr>
        <?php
        
        $no = 1;
        $dari = $_POST['dari'];
        $ke = $_POST['ke'];

        $sql = "SELECT * FROM barang WHERE tanggal_input BETWEEN '$dari' and '$ke'";
        $row = $config->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();

        foreach ($hasil as $isi) {
        $stok += $isi['jumlah'];
        $hb += $isi['harga_beli'];
        $hj += $isi['harga_jual'];
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $no; ?></td>
            <td style="text-align:center;"><?php echo $isi['tanggal_input'] ?></td>
            <td style="text-align:center;"><?php echo $isi['kode_barang'] ?></td>
            <td style="text-align:start;"><?php echo $isi['nama_barang'] ?></td>
            <td style="text-align:center;"><?php echo $isi['kategori'] ?></td>
            <td style="text-align:center;"><?php echo $isi['jumlah'] ?></td>
            <td style="text-align:center;"><?php echo "Rp. ".number_format($isi['harga_beli']) ?></td>
            <td style="text-align:center;"><?php echo "Rp. ".number_format($isi['harga_jual']) ?></td>
            <td style="text-align:center;"><?php echo $isi['satuan'] ?></td>
        </tr>
        <?php
            $no++;
            }
        ?>
        <tfoot>
            <th colspan="5" style="background: gray; color:white;">Total Keseluruhan</th>
            <th><?php echo $stok; ?></th>
            <th>Rp. <?php echo number_format($hb) ?> ,-</th>
            <th>Rp. <?php echo number_format($hj) ?> ,-</th>
            <th colspan="1" style="background: gray;"></th>
        </tfoot>
    </table>
    <?php
        }else{
    ?>
    <table class="display" border="1">
        <thead>
            <tr>
                <th style="text-align:center;">No</th>
                <th style="text-align:center;">Tanggal</th>
                <th style="text-align:center;">Kode Barang</th>
                <th style="text-align:start;">Nama Barang</th>
                <th style="text-align:center;">Kategori</th>
                <th style="text-align:center;">Jumlah</th>
                <th style="text-align:center;">Harga Beli</th>
                <th style="text-align:center;">Harga Jual</th>
                <th style="text-align:center;">Satuan Barang</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $no = 1;
            $stok = 0;
            $hb = 0;
            $hj = 0;

            $sql = "SELECT * FROM barang";
            $row = $config->prepare($sql);
            $row->execute();
            $hasil = $row->fetchAll();
            foreach ($hasil as $isi) {
                $stok += $isi['jumlah'];
                $hb += $isi['harga_beli'];
                $hj += $isi['harga_jual'];
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $no; ?></td>
                <td style="text-align:center;"><?php echo $isi['tanggal_input'] ?></td>
                <td style="text-align:center;"><?php echo $isi['kode_barang'] ?></td>
                <td style="text-align:start;"><?php echo $isi['nama_barang'] ?></td>
                <td style="text-align:center;"><?php echo $isi['kategori'] ?></td>
                <td style="text-align:center;"><?php echo $isi['jumlah'] ?></td>
                <td style="text-align:center;"><?php echo "Rp. ".number_format($isi['harga_beli']) ?></td>
                <td style="text-align:center;"><?php echo "Rp. ".number_format($isi['harga_jual']) ?></td>
                <td style="text-align:center;"><?php echo $isi['satuan'] ?></td>
            </tr>
            <?php
            $no++;
                }
            ?>
        </tbody>
        <tfoot>
            <th colspan="5" style="background: gray; color:white;">Total Keseluruhan</th>
            <th><?php echo $stok; ?></th>
            <th>Rp. <?php echo number_format($hb) ?> ,-</th>
            <th>Rp. <?php echo number_format($hj) ?> ,-</th>
            <th colspan="1" style="background: gray;"></th>
        </tfoot>
    </table>
    <?php
        }
    ?>
    <?php require_once("../ui/footer.php"); ?>