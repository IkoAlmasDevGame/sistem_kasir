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
        <title>Edit Data Master Barang</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Edit Data Barang</h4>
                        <a href="?page=barang" class="btn btn-close"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php 
                            $kode_barang = htmlspecialchars($_GET['kode_barang']);
                            $hasil = $barang->readupdate("SELECT * FROM barang WHERE kode_barang = ?", $kode_barang);
                            foreach ($hasil as $isi) {
                        ?>
                        <form action="?aksi=ubah-barang" method="post">
                            <input type="hidden" name="kode_barang" value="<?=$isi['kode_barang']?>">
                            <table class="table table-striped-columns">
                                <tr>
                                    <td>
                                        <label for="">Harga Beli</label>
                                        <input type="text" class="form-control" required name="beli" id="rupiah"
                                            value="<?=$isi['harga_beli']?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Harga Jual</label>
                                        <input type="text" class="form-control" required name="jual" id="rupiah"
                                            value="<?=$isi['harga_jual']?>">
                                    </td>
                                </tr>
                            </table>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary hover">Update</button>
                                    <a href="?page=barang" role="button" class="btn btn-default">Cancel</a>
                                    <button type="reset" class="btn btn-danger hover">Reset</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>