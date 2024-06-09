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
        <title>Data Master Supplier</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-defualt">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Supplier</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Data Supplier</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Supplier</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat Supplier</th>
                                    <th>Telepon Supplier</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $supplier->Read("SELECT * FROM supplier order by id asc");
                                    while ($isi = mysqli_fetch_array($row)) {
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $isi['kode_supplier'] ?></td>
                                    <td><?php echo $isi['nama_supplier'] ?></td>
                                    <td><?php echo $isi['alamat'] ?></td>
                                    <td><?php echo $isi['telepon'] ?></td>
                                    <td>
                                        <a href="?page=supplier&aksi=ubahsupplier&id=<?=$isi['id']?>" role="button"
                                            aria-current="page" class="btn btn-warning btn-sm hover">
                                            <i class="fa fa-edit fa-1x"></i>
                                        </a>
                                        <a href="?page=supplier&aksi=hapus-supplier&id=<?=$isi['id']?>"
                                            onclick="return confirm('Apakah anda ingin menghapus data supplier ini ?')"
                                            role="button" aria-current="page" class="btn btn-danger btn-sm hover">
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
                                <a href="?page=supplier&aksi=tambahsupplier" role="button" aria-current="page"
                                    class="btn btn-danger hover">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Data Supplier</span>
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