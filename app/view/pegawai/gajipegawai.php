<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION['role'] == "admin")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pegawai</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">
                        <i class="fa fa-money-bill-alt fa-1x"></i>
                        Gaji Pegawai
                    </h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">
                        Master Gaji Pegawai
                    </h4>
                    <a href="?page=pegawai" class="btn btn-primary hover">
                        <i class="bi bi-person"></i>
                        <span>Data Pegawai</span>
                    </a>
                </div>
                <?php if($_SESSION["role"] == "superadmin"){ ?>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="d-flex justify-content-end align-items-end flex-wrap">
                            <div class="col-sm-12 col-md-3 mt-2">
                                <select name="cari" id="" class="form-control" onchange="this.form.submit()" required>
                                    <option value="">-- Pilih Daftar Gaji Pegawai --</option>
                                    <?php 
                                        $row = $config->prepare("SELECT * FROM users WHERE role = 'admin' || role = 'pegawai' order by id asc");
                                        $row->execute();
                                        $hasil = $row->fetchAll();
                                        foreach ($hasil as $i) {
                                    ?>
                                    <option value="<?=$i['nama']?>"><?php echo $i['nama'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <th>Gaji Utama</th>
                                    <th>Gaji Bonus</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['cari'])){
                                    $cari = htmlspecialchars($_POST['cari']);
                                    $sql = "SELECT * FROM users WHERE nama = ?";
                                    $row = $config->prepare($sql);
                                    $row->execute(array($cari)); 
                                    $hasil = $row->fetchAll();
                                    foreach ($hasil as $isi) {
                                ?>
                                <tr>
                                    <td><?php echo $isi['nama'] ?></td>
                                    <form action="?aksi=create-gajian" method="post">
                                        <input type="hidden" name="nama_pegawai" value="<?=$isi['nama']?>">
                                        <input type="hidden" name="proses" value="0">
                                        <input type="hidden" name="tanggal_input" value="<?=date('d-m-Y')?>">
                                        <td>
                                            <div class="form-inline col-sm-12 col-md-9">
                                                <input type="number" name="gaji" id="" class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-inline col-sm-12 col-md-9">
                                                <input type="number" name="bonus" id="" class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary hover btn-sm">
                                                <i class="fa fa-save fa-1x"></i>
                                            </button>
                                    </form>
                                    <button type="reset" aria-current="page" class="btn btn-danger hover btn-sm">
                                        <i class="fa fa-eraser fa-1x"></i>
                                    </button>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>