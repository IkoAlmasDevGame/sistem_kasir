<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Barang</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">
                        Laporan Data Barang
                    </h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Laporan Barang</h4>
                    <div class="text-end">
                        <a href="?page=laporan-barangmasuk" class="btn btn-sm btn-info">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="form-group mt-1">
                            <form action="" method="post">
                                <div class="d-flex justify-content-end align-items-center flex-wrap gap-2">
                                    <label for="">search : </label>
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="dari" id="datepicker" class="form-control">
                                        </div>
                                    </div>
                                    s/d
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="ke" id="datepicker" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary hover">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="mb-1"></div>
                            <form action="header.php?page=export-barang" method="post">
                                <div class="d-flex justify-content-end align-items-center flex-wrap gap-2">
                                    <label for="">Tanggal : </label>
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="dari" id="datepicker" class="form-control">
                                        </div>
                                    </div>
                                    s/d
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="ke" id="datepicker" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm text-light hover">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex justify-content-end align-items-start flex-wrap">
                            <a href="header.php?page=export-barang"
                                class="btn btn-sm text-primary text-decoration-none">
                                Tampilkan semua</a>
                        </div>
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Satuan Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $hb = 0;
                                    $hj = 0;
                                    $stok = 0;
                                    
                                    if(isset($_POST['dari']) && isset($_POST['ke'])){
                                        $dari = htmlspecialchars($_POST['dari']);
                                        $ke = htmlspecialchars($_POST['ke']);
                                        $row = $config->prepare("SELECT * FROM barang WHERE tanggal_input BETWEEN '$dari' and '$ke'");
                                        $row->execute();
                                        $hasil = $row->fetchAll();
                                    }else{
                                        $hasil = $barang->read();
                                    }
                                    foreach ($hasil as $isi) {
                                        $stok += $isi['jumlah'];
                                        $hb += $isi['harga_beli'];
                                        $hj += $isi['harga_jual'];
                                ?>
                                <tr>
                                    <td><?php echo $isi['tanggal_input'] ?></td>
                                    <td><?php echo $isi['kode_barang'] ?></td>
                                    <td><?php echo $isi['nama_barang'] ?></td>
                                    <td><?php echo $isi['kategori'] ?></td>
                                    <td><?php echo $isi['jumlah'] ?></td>
                                    <td><?php echo "Rp. ".number_format($isi['harga_beli']) ?></td>
                                    <td><?php echo "Rp. ".number_format($isi['harga_jual']) ?></td>
                                    <td><?php echo $isi['satuan'] ?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <th colspan="4" style="background: gray; color:white;">Total Keseluruhan</th>
                                <th><?php echo $stok; ?></th>
                                <th>Rp. <?php echo number_format($hb) ?> ,-</th>
                                <th>Rp. <?php echo number_format($hj) ?> ,-</th>
                                <th colspan="1" style="background: gray;"></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>