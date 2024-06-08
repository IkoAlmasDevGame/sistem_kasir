<?php
error_reporting(0);
require_once("../../database/koneksi.php");

if (!empty($_GET['cari'])) {
    if(isset($_POST['keyword'])){
        $cari = strip_tags(trim($_POST['keyword']));
    if($cari == ''){
        // $sql = "SELECT * from barang where kategori like '%$cari%' or nama_barang like '%$cari%' or kode_barang like '%$cari%'";
        // $hasil = $conn->query($sql);
    }else{    
        $sql = "SELECT * from barang  where kategori like '%$cari%' or nama_barang like '%$cari%' or kode_barang like '%$cari%'";
        $row = $config -> prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();        
    }
?>
<div class="display">
    <table class="table table-striped table-bordered" id="example1">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($hasil as $isi) {
            ?>
            <tr>
                <td><?php echo $isi["kode_barang"] ?></td>
                <td><?php echo $isi["nama_barang"] ?></td>
                <td><?php echo "Rp. ".number_format($isi['harga_jual']).",-" ?></td>
                <td><?php echo $isi["kategori"] ?></td>
                <td>
                    <a href="" class="btn btn-success btn-outline-light">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    }
}
?>