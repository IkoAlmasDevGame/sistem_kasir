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
        <title>Data Master Jenis Barang</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Jenis Barang</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="card-title">Jenis Barang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $jenisbarang->Read("SELECT * FROM kategori order by id asc");
                                    while ($isi = mysqli_fetch_array($row)) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['kategori'] ?></td>
                                </tr>
                                <?php
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=kategori&aksi=tambahkategori" aria-current="page" aria-controls="page"
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