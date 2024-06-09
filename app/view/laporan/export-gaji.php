<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");

                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=Laporan_Pegawai_Gaji (".date('d-m-Y').").xls");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Gaji Pegawai</title>
    </head>

    <?php 
        if(isset($_POST['submit'])){
            $dari = $_POST['dari'];
            $ke = $_POST['ke'];
    ?>
    <center>
        <h4>Laporan Gaji Pegawai <?php echo $dari; ?> s/d <?php echo $ke; ?></h4>
    </center>
    <table class="display" border="1">
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Gaji Utama</th>
            <th>Gaji Bonus</th>
            <th>Proses</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php 
            $total = 0;
            $no = 1;
            $sql = "SELECT * FROM gaji_pegawai WHERE tanggal_input BETWEEN '$dari' and '$ke'";
            $row = $config->prepare($sql);
            $row->execute();
            foreach($row as $isi){
                $total += $isi['gaji'] + $isi['bonus'];
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo ucfirst($isi['nama_pegawai']) ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']) ?> ,-</td>
            <td>Rp. <?php echo number_format($isi['bonus']) ?> ,-</td>
            <td>
                <?php if($isi['proses'] == 0){ 
                        echo "belum konfirmasi"; 
                    } else { 
                        echo "sudah konfirmasi";
                    } 
                ?>
            </td>
            <td><?php echo $isi['tanggal_input'] ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']+$isi['bonus']) ?> ,-</td>
        </tr>
        <?php
        $no++;
            }
        ?>
        <th colspan="6"></th>
        <th>Rp. <?php echo number_format($total) ?> ,-</th>
    </table>
    <?php
    }else if(isset($_GET['data'])){
        $total = 0;
        $no = 1;
        $cari = htmlspecialchars($_GET['data']);
    ?>
    <center>
        <h4>Laporan Pegawai <?php if($cari == 0){echo "belum konfirmasi";}else{echo "sudah konfirmasi";} ?></h4>
    </center>
    <table class="display" border="1">
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Gaji Utama</th>
            <th>Gaji Bonus</th>
            <th>Proses</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php 
            $sql = "SELECT * FROM gaji_pegawai WHERE proses = ?";
            $row = $config->prepare($sql);
            $row->execute(array($cari));
            
            foreach ($row as $isi) {
                $total += $isi['gaji'] + $isi['bonus'];
            ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo ucfirst($isi['nama_pegawai']) ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']) ?> ,-</td>
            <td>Rp. <?php echo number_format($isi['bonus']) ?> ,-</td>
            <td>
                <?php if($isi['proses'] == 0){ 
                        echo "belum konfirmasi"; 
                    } else { 
                        echo "sudah konfirmasi";
                    } 
                ?>
            </td>
            <td><?php echo $isi['tanggal_input'] ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']+$isi['bonus']) ?> ,-</td>
        </tr>
        <?php
        $no++;
        }
        ?>
        <th colspan="6"></th>
        <th>Rp. <?php echo number_format($total) ?> ,-</th>
    </table>
    <?php
        }else{
    ?>
    <center>
        <h4>Laporan Gaji Pegwai</h4>
    </center>
    <table class="display" border="1">
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Gaji Utama</th>
            <th>Gaji Bonus</th>
            <th>Proses</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php 
            $total = 0;
            $no = 1;
            $sql = "SELECT * FROM gaji_pegawai";
            $row = $config->prepare($sql);
            $row->execute();
            
            foreach ($row as $isi) {
                $total += $isi['gaji'] + $isi['bonus'];
            ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo ucfirst($isi['nama_pegawai']) ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']) ?> ,-</td>
            <td>Rp. <?php echo number_format($isi['bonus']) ?> ,-</td>
            <td>
                <?php if($isi['proses'] == 0){ 
                        echo "belum konfirmasi"; 
                    } else { 
                        echo "sudah konfirmasi";
                    } 
                ?>
            </td>
            <td><?php echo $isi['tanggal_input'] ?></td>
            <td>Rp. <?php echo number_format($isi['gaji']+$isi['bonus']) ?> ,-</td>
        </tr>
        <?php
        $no++;
        }
        ?>
        <th colspan="6"></th>
        <th>Rp. <?php echo number_format($total) ?> ,-</th>
    </table>
    <?php
        }
    ?>
    <?php require_once("../ui/footer.php") ?>