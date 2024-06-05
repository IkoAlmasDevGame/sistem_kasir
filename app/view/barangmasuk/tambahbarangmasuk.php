<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas")
            {
                require_once("../ui/header.php");
                $koneksi = mysqli_connect("localhost", "root", "", "cp_sistem_kasir");
                // $koneksi = mysqli_connect("localhost", "root", "", "sistem_kasir");
                $no = $koneksi->query("SELECT id_transaksi FROM barang_masuk order by id_transaksi desc");
                $idtrans = mysqli_fetch_array($no);
                $kode = $idtrans["id_transaksi"];

                $urut = substr($kode, 8, 3);
                $tambah = (int) $urut + 1;
                $bulan = date("m");
                $tahun = date("y");
                            
                if(strlen($tambah) == 1){
                	$format = "TRM-".$bulan.$tahun."00".$tambah;
                } else if(strlen($tambah) == 2){
                	$format = "TRM-".$bulan.$tahun."0".$tambah;
                } else{
                	$format = "TRM-".$bulan.$tahun.$tambah;
                }

                $tanggal_masuk = date("Y-m-d");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Barang Masuk</title>
        <script lang="javascript">
        function sum() {
            var stok = document.getElementById('stok').value;
            var jumlahmasuk = document.getElementById('jumlahmasuk').value;
            var result = parseInt(stok) + parseInt(jumlahmasuk);
            if (!isNaN(result)) {
                document.getElementById('jumlah').value = result;
            }
        }
        </script>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h6>
                        <a href="?page=barangmasuk" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <form action="?aksi=tambah-barangmasuk" method="post" enctype="multipart/form-data">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Id Transaksi</label>
                                            <div class="form-line">
                                                <input type="text" name="id_transaksi" class="form-control"
                                                    id="id_transaksi" value="<?php echo $format; ?>" readonly
                                                    required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Tanggal Masuk</label>
                                            <div class="form-line">
                                                <input type="date" name="tanggal_masuk" class="form-control"
                                                    id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Barang</label>
                                            <select name="barang" id="cmb_barang" class="form-control" required>
                                                <option value="">-- Pilih Barang --</option>
                                                <?php 
                                                    $row = $gudang->Read("SELECT * FROM gudang order by id asc");
                                                    while ($g = mysqli_fetch_array($row)) {
                                                        echo "<option value='$g[kode_barang].$g[nama_barang]'>$g[kode_barang] | $g[nama_barang]</option>";
                                                ?>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="tampung"></div>
                                            <label for="">Jumlah</label>
                                            <div class="form-line">
                                                <input type="text" name="jumlahmasuk" id="jumlahmasuk" onkeyup="sum()"
                                                    class="form-control" required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="jumlah">Total Stok</label>
                                            <div class="form-line">
                                                <input readonly="readonly" name="jumlah" id="jumlah" type="number"
                                                    class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="tampung1"></div>
                                            <label for="">Supplier</label>
                                            <select name="pengirim" id="" class="form-control" required>
                                                <option value="">-- Pilih Supplier --</option>
                                                <?php 
                                                    $row = $supplier->Read("SELECT * FROM supplier order by id asc");
                                                    while ($s = mysqli_fetch_array($row)) {
                                                        echo "<option value='$s[nama_supplier]'>$s[nama_supplier]</option>";
                                                ?>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>