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
        <title>Laporan Barang Masuk</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Laporan Barang Masuk</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Laporan Barang Masuk</h4>
                    <div class="text-end">
                        <a href="?page=laporan-barangmasuk" class="btn btn-sm btn-info">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="form-group">
                            <form action="" method="post">
                                <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 mt-2">
                                    <label for="">search :</label>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-inline">
                                            <input type="text" name="cari" id="cari" class="form-control"
                                                placeholder="masukkan data barang masuk ..."
                                                aria-controls="example1_filter" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary hover">
                                        <i class="fa fa-search fa-1x"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="mb-2"></div>
                            <form action="header.php?page=export-barangmasuk" method="post">
                                <div class="d-flex justify-content-start align-items-center flex-wrap gap-2">
                                    <label for="">Tanggal : </label>
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="dari" id="dari" class="form-control" required>
                                        </div>
                                    </div>
                                    s/d
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-inline">
                                            <input type="date" name="ke" id="ke" class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary hover">
                                        <i class="fa fa-print fa-1x"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="ms-5">
                                <a href="header.php?page=export-barangmasuk" class="text-decoration-none text-primary">
                                    Tampilkan semua data
                                </a>
                            </div>
                        </div>
                        <div class="mb-3"></div>
                        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                            <thead>
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
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if(isset($_POST['cari'])){
                                    $cari = htmlspecialchars($_POST['cari']);
                                    $row = $conn->query("SELECT * FROM barang_masuk WHERE id_transaksi = '$cari' or kode_barang = '$cari' or
                                     nama_barang = '$cari' or pengirim = '$cari' order by id asc");
                                }else{
                                    $row = $barangmasuk->Read("SELECT * FROM barang_masuk order by id asc");
                                }
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>