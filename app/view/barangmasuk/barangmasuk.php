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
        <title>Data Master Barang Masuk</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Barang Masuk</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
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
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $barangmasuk->Read("SELECT * FROM barang_masuk order by id asc");
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
                                    <td>
                                        <a href="?page=barangmasuk&aksi=hapus-barangmasuk&id_transaksi=<?=$isi['id_transaksi']?>"
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
                                <a href="?page=barangmasuk&aksi=tambahbarangmasuk" aria-current="page"
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