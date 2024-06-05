<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Gudang</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Gudang</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="card-title">Gudang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Satuan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $gudang->Read("SELECT * FROM gudang order by id asc");
                                    while ($isi = mysqli_fetch_array($row)) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['kode_barang'] ?></td>
                                    <td><?php echo $isi['nama_barang'] ?></td>
                                    <td><?php echo $isi['jenis_barang'] ?></td>
                                    <td><?php echo $isi['jumlah'] ?></td>
                                    <td><?php echo $isi['satuan'] ?></td>
                                    <td>
                                        <a href="?page=gudang&aksi=ubahgudang&id=<?=$isi['id']?>" aria-current="page"
                                            class="btn btn-warning btn-sm hover">
                                            <i class="fa fa-edit fa-1x"></i>
                                        </a>
                                        <a href="?page=gudang&aksi=hapus-gudang&id=<?=$isi['id']?>"
                                            onclick="return confirm('Apakah data ini ingin anda hapus ?')"
                                            aria-current="page" class="btn btn-danger btn-sm hover">
                                            <i class="fa fa-trash fa-1x"></i>
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
                                <a href="?page=gudang&aksi=tambahgudang" aria-current="page" aria-controls="page"
                                    class="btn btn-primary btn-sm hover">
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