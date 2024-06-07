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
        <title>Data Pegawai</title>
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
                        Data Gaji Pegawai
                    </h4>
                    <a href="?page=gajipegawai" class="btn btn-primary hover">
                        <i class="bi bi-person"></i>
                        <span>Data Master Pegawai</span>
                    </a>
                </div>
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
                                    <th>Proses</th>
                                    <th>Total</th>
                                    <?php if($_SESSION['role'] == "admin"){ ?>
                                    <th>Opsional</th>
                                    <?php }else{ ?>
                                    <th class="opacity-0"></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if(isset($_POST['cari'])){
                                $cari = htmlspecialchars($_POST['cari']);
                                $sql = "SELECT * FROM gaji_pegawai WHERE nama_pegawai = ?";
                                $row = $config->prepare($sql);
                                $row->execute(array($cari)); 
                                $hasil = $row->fetchAll();
                                foreach ($hasil as $isi) {
                                    $total += $isi['gaji'] + $isi['bonus'];
                                    function proses($proses){
                                        if($proses == 0){
                                            echo "Belum di konfirmasi";
                                        }else if($proses == 1){
                                            echo "Sudah di konfirmasi";
                                        }else{
                                            echo "Tidak ada konfirmasi";
                                        }
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $isi['nama_pegawai'] ?></td>
                                    <td>Rp. <?php echo number_format($isi['gaji']) ?> ,-</td>
                                    <td>Rp. <?php echo number_format($isi['bonus']) ?> ,-</td>
                                    <td><?php echo proses($isi['proses']); ?></td>
                                    <td>Rp. <?php echo number_format($total) ?> ,-</td>
                                    <td>
                                        <?php 
                                            if($_SESSION['role'] == "admin"){
                                        ?>
                                        <a href="" role="button" data-bs-target="#confirm<?=$isi['id']?>"
                                            data-bs-toggle="modal" aria-current="page" class="btn btn-success hover">
                                            <i class="bi bi-check"></i>
                                            <span>Confirm Gajian</span>
                                        </a>
                                        <div class="modal fade" id="confirm<?=$isi['id']?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi Gaji Pegawai</h4>
                                                        <button type='button' class='btn btn-close'
                                                            data-bs-dismiss='modal'></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="?aksi=ubah-proses" method="post">
                                                            <input type="hidden" name="nama_pegawai"
                                                                value="<?=$isi['nama_pegawai']?>">
                                                            <input type="hidden" name="proses" value="1">
                                                            <p class="card-group">
                                                                Nama Pegawai : <?php echo $isi['nama_pegawai'] ?>
                                                            </p>
                                                            <br>
                                                            <p class="card-group">
                                                                Total Gaji : Rp. <?php echo number_format($total) ?> ,-
                                                            </p>
                                                            <div class="card-footer">
                                                                <div class="text-center">
                                                                    <button type="submit"
                                                                        class="btn btn-secondary hover">
                                                                        Update Proses
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            } 
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php if($_SESSION['role'] == "admin"){ ?>
                                <th colspan="4" class="bg-secondary text-light">Total Gaji</th>
                                <th>Rp. <?php echo number_format($total) ?> ,-</th>
                                <?php }else{ ?>
                                <th colspan="4" class="bg-secondary text-light">Total Gaji</th>
                                <th>Rp. <?php echo number_format($total) ?> ,-</th>
                                <?php } ?>
                                <th colspan="1"></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>