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
        <title>Laporan Gudang</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Laporan Gudang</h4>
                    <div class="text-end">
                        <a href="?page=laporan-gudang" class="btn btn-sm btn-outline-dark">
                            <i class="fa fa-refresh fa-1x"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mt-1">
                        <form action="" method="post">
                            <div class="d-flex justify-content-end align-items-center flex-wrap gap-1">
                                <label for=""><i class="fa fa-search"></i></label>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-inline">
                                        <input type="search" name="cari" id="cari" class="form-control"
                                            aria-controls="example1_filter" placeholder="cari data gudang ...">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary hover">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered w-100 table-sm" id="example1">
                            <thead>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    if(isset($_POST['cari'])){
                                        $cari = htmlspecialchars($_POST['cari']);
                                        $row = $conn->query("SELECT * FROM gudang WHERE kode_barang = '$cari' or nama_barang = '$cari' or jenis_barang = '$cari'");
                                    }else{
                                        $row = $gudang->Read("SELECT * FROM gudang order by id asc");
                                    }
                                    while ($isi = mysqli_fetch_array($row)) {
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
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=export-gudang" class="btn btn-outline-info is-hoverable btn-sm">
                                    <i class="fa fa-file-export"></i>
                                    <span>Export To Excel</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>