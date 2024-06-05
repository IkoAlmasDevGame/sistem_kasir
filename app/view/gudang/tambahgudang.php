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
                $no = $koneksi->query("SELECT kode_barang FROM gudang order by kode_barang desc");
                $kdbarang = mysqli_fetch_array($no);
                $kode = $kdbarang["kode_barang"];

                $urut = substr($kode, 8, 3);
                $tambah = (int) $urut + 1;
                $bulan = date("m");
                $tahun = date("y");
                            
                if(strlen($tambah) == 1){
                	$format = "BAR-".$bulan.$tahun."00".$tambah;
                } else if(strlen($tambah) == 2){
                	$format = "BAR-".$bulan.$tahun."0".$tambah;
                } else{
                	$format = "BAR-".$bulan.$tahun.$tambah;
                }
                
                $jumlah = 0;
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
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Gudang</h6>
                        <a href="?page=gudang" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <form action="?aksi=tambah-gudang" method="post">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Kode Barang</label>
                                            <div class="form-line">
                                                <input type="text" name="kode_barang" class="form-control"
                                                    id="kode_barang" value="<?php echo $format; ?>" readonly />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Nama Barang</label>
                                            <div class="form-line">
                                                <input type="text" name="nama_barang" class="form-control" required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Jenis Barang</label>
                                            <select name="jenis_barang" id="jenis_barang" class="form-control" required>
                                                <option value="">Pilih Jenis Barang</option>
                                                <?php 
                                                $row = $jenisbarang->Read("SELECT * FROM kategori order by id asc");
                                                while ($data = mysqli_fetch_array($row)) {
                                                    echo "<option value='$data[id].$data[kategori]'>$data[kategori]</option>";
                                                ?>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Jumlah</label>
                                            <div class="form-line">
                                                <input type="text" name="jumlah" class="form-control" id="jumlah"
                                                    value="<?php echo $jumlah; ?>" readonly />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Satuan Barang</label>
                                            <select name="satuan" id="satuan" class="form-control" required>
                                                <option value="">Pilih Satuan Barang</option>
                                                <?php 
                                                $row = $satuan->Read("SELECT * FROM satuan order by id asc");
                                                while ($data = mysqli_fetch_array($row)) {
                                                    echo "<option value='$data[id].$data[satuan]'>$data[satuan]</option>";
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
                                        <a href="?page=gudang" type="button" role="button"
                                            class="btn btn-default">Cancel</a>
                                        <button type="reset" class="btn btn-danger hover">
                                            Reset
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