<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "pegawai")
            {
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pelanggan</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="panel-heading">Pelanggan <?php echo $_SESSION['nama_website'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Pelanggan Toko</h4>
                            <div class="text-end">
                                <a href="?page=pelanggan" class="btn btn-sm btn-info">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1"></div>
                    <div class="table-responsive">
                        <div class="card-body">
                            <div class="form-group">
                                <form action="" method="post">
                                    <div class="d-flex justify-content-end align-items-center flex-wrap gap-2">
                                        <label for=""><i class="fa fa-search"></i></label>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-inline">
                                                <input type="search" name="cari" aria-controls="example1_filter"
                                                    id="cari" placeholder="cari data pelanggan toko ..."
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary hover">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <table class=" table table-bordered table-sm w-100" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nomor Telepon</th>
                                        <th>Alamat Pelanggan</th>
                                        <th>Opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        if(isset($_POST['cari'])){
                                            $cari = htmlspecialchars($_POST['cari']);
                                            $row = $config->prepare("SELECT * FROM pelanggan WHERE nama_pelanggan = ?");
                                            $row->execute(array($cari));
                                            $hasil = $row->fetchAll();
                                        }else{
                                            $row = $config->prepare("SELECT * FROM pelanggan order by id asc");
                                            $row->execute();
                                            $hasil = $row->fetchAll();
                                        }
                                        foreach($hasil as $isi){
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo ucfirst($isi['nama_pelanggan']) ?></td>
                                        <td><?php echo $isi['nomor_telepon'] ?></td>
                                        <td><?php echo $isi['alamat'] ?></td>
                                        <td>
                                            <a href="?page=pelanggan&aksi=ubahpelanggan&id=<?=$isi['id']?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit fa-1x"></i>
                                            </a>
                                            <a href="?page=pelanggan&aksi=hapus-pelanggan&id=<?=$isi['id']?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda ingin menhapus data pelanggan di toko ini ?')">
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
                                    <a href="?page=pelanggan&aksi=tambahpelanggan" class="btn btn-sm btn-danger hover">
                                        <i class="bi bi-plus"></i>
                                        <span>Tambah Pelanggan</span>
                                    </a>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>