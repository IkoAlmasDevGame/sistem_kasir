<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pengguna</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Pengguna</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Data Pengguna</h4>
                </div>
                <div class="card-body mt-2">
                    <form action="" method="post">
                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-1">
                            <label for="">search :</label>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-inline">
                                    <input type="text" name="cari" class="form-control" id="cari" required
                                        onchange="this.form.submit()" placeholder="pencarian data pengguna ..."
                                        aria-controls="example1_filter">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>User Name</th>
                                    <th>E - mailing</th>
                                    <th>Password</th>
                                    <th>Repassword</th>
                                    <th>Jabatan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    if(isset($_POST["cari"])){
                                        $cari = htmlspecialchars($_POST["cari"]);
                                        $sql = "SELECT * FROM users WHERE nama = ? or email = '$cari' or role = '$cari' order by id asc";
                                        $row = $config->prepare($sql);
                                        $row->execute(array($cari));
                                        $hasil = $row->fetchAll();
                                    }else{
                                        $sql = "SELECT * FROM users order by id asc";
                                        $row = $config->prepare($sql);
                                        $row->execute();
                                        $hasil = $row->fetchAll();
                                    }
                                    foreach ($hasil as $isi) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['nama'] ?></td>
                                    <td><?php echo $isi['username'] ?></td>
                                    <td><?php echo $isi['email'] ?></td>
                                    <td>Ter - Enkripsi</td>
                                    <td>Ter - Enkripsi</td>
                                    <td><?php echo $isi['role'] ?></td>
                                    <td>
                                        <a href="?page=pengguna&aksi=ubahpengguna&id=<?=$isi['id']?>" role="button"
                                            class="btn btn-sm hover btn-warning">
                                            <i class="fa fa-edit fa-1x"></i>
                                        </a>
                                        <a href="?page=pengguna&aksi=hapus-pengguna&id=<?=$isi['id']?>" role="button"
                                            class="btn btn-sm hover btn-danger"
                                            onclick="return confirm('Apakah data pegawai ini ingin dihapus ?')">
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
                                <a href="?page=pengguna&aksi=tambahpengguna" role="button" class="btn btn-danger hover">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Data Pegawai</span>
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