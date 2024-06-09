<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Gaji Pegawai</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Data Laporan Pegawai
                    </h4>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title text-secondary">Data Laporan Pegawai
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <form action="header.php?page=laporan-gajipegawai&cari=ok" method="post">
                                    <div class="d-flex justify-content-center align-items-center
                                         flex-wrap gap-2 ms-5 mt-2">
                                        <label for="">Pilih Proses Data : </label>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-inline">
                                                <select name="data" id="data" aria-controls="example1_filter"
                                                    class="form-control">
                                                    <option value="">Pilih Data Proses</option>
                                                    <option value="0">belum konfirmasi</option>
                                                    <option value="1">sudah konfirmasi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary hover">
                                            <i class="fa fa-search fa-1x"></i>
                                        </button>
                                        <?php if(!empty($_GET['cari'])){ ?>
                                        <a href="header.php?page=export-gaji&cari=ok&data=<?php echo $_POST['data'];?>"
                                            class="btn btn-sm btn-warning hover" target="_blank">
                                            <i class="fa fa-file-export fa-1x"></i>
                                        </a>
                                        <?php }else{ ?>
                                        <a href="header.php?page=export-gaji"
                                            class="btn btn-info text-secondary btn-sm hover">
                                            <i class="fa fa-file-export fa-1x"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </form>
                                <form action="header.php?page=export-gaji" method="post">
                                    <div class="d-flex justify-content-center align-items-center
                                         flex-wrap mt-2 gap-1 ms-5">
                                        <label for="">Tanggal : </label>
                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-inline">
                                                <input type="date" name="dari" id="datepicker"
                                                    class="form-control date-formate">
                                            </div>
                                        </div>
                                        s/d
                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-inline">
                                                <input type="date" name="ke" id="datepicker"
                                                    class="form-control date-formate">
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-warning hover">
                                            <i class="fa fa-file-export fa-1x"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="text-end mt-1">
                                <a href="header.php?page=laporan-gajipegawai"
                                    class="btn btn-info text-secondary btn-sm hover">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mb-2"></div>
                        <div class="table-responsive">
                            <table class="table table-sm w-100 table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Gaji Utama</th>
                                        <th>Gaji Bonus</th>
                                        <th>Proses</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total = 0;
                                        $no = 1;
                                        if(isset($_POST['data'])){
                                            $cari = htmlspecialchars($_POST['data']);
                                            $sql = "SELECT * FROM gaji_pegawai WHERE proses = ?";
                                            $row = $config->prepare($sql);
                                            $row->execute(array($cari)); 
                                            $hasil = $row->fetchAll();
                                        }else{
                                            $sql = "SELECT * FROM gaji_pegawai order by id asc";
                                            $row = $config->prepare($sql);
                                            $row->execute(); 
                                            $hasil = $row->fetchAll();
                                        }
                                        foreach ($hasil as $isi) {
                                            $total += $isi['gaji'] + $isi['bonus'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo ucfirst($isi['nama_pegawai']) ?></td>
                                        <td>Rp. <?php echo number_format($isi['gaji']) ?> ,-</td>
                                        <td>Rp. <?php echo number_format($isi['bonus']) ?> ,-</td>
                                        <td>
                                            <?php if($isi['proses'] == 0){ 
                                            echo "belum konfirmasi"; 
                                            } else { 
                                                echo "sudah konfirmasi";
                                            } 
                                            ?>
                                        </td>
                                        <td>Rp. <?php echo number_format($isi['gaji']+$isi['bonus']) ?> ,-</td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th colspan="5" style="background: gray; color:white;">Total Gaji Pegawai</th>
                                    <th>Rp. <?php echo number_format($total) ?> ,-</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>