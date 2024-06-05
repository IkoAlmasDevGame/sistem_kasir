<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas")
            {
                require_once("../ui/header.php");
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
        <div class='container-fluid'>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title">Tambah Barang</h4>
                            <a href="?page=barang" class="btn btn-close fa-2x"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group">
                                <form action="?aksi=tambah-barang" method="post">
                                    <table class="table">
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
                                                <label for="">Tanggal Masuk</label>
                                                <div class="form-line">
                                                    <input type="date" name="tanggal_masuk" class="form-control"
                                                        id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>"
                                                        required />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tampung2"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">Harga Beli</label>
                                                <input type="number" name="beli" id="beli" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">Harga Jual</label>
                                                <input type="number" name="jual" id="jual" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tampung1"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
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
                                            <a href="?page=barang" type="button" role="button"
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>