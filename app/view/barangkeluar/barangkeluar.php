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
        <title>Data Master Barang Keluar</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Barang Keluar</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="card-title">Barang Keluar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Transaksi</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Satuan</th>
                                    <th>Tujuan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $barangkeluar->Read("SELECT * FROM barang_keluar order by id asc");
                                    while ($isi = mysqli_fetch_array($row)) {
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $isi['id_transaksi'] ?></td>
                                    <td><?php echo $isi['tanggal'] ?></td>
                                    <td><?php echo $isi['kode_barang'] ?></td>
                                    <td><?php echo $isi['nama_barang'] ?></td>
                                    <td><?php echo $isi['jumlah'] ?></td>
                                    <td><?php echo $isi['satuan'] ?></td>
                                    <td><?php echo $isi['tujuan'] ?></td>
                                    <td>
                                        <a href="?page=barangmasuk&aksi=hapus-barangkeluar&id_transaksi=<?=$isi['id_transaksi']?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah data ini akan anda hapus ?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=barangkeluar&aksi=tambahbarangkeluar" aria-current="page"
                                    aria-controls="page" class="btn btn-primary btn-sm hover">
                                    <i class="bi bi-plus"></i><span>Tambah</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>