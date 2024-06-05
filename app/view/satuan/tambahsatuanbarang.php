<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Satuan</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Tambah Satuan Barang</h4>
                        <a href="?page=satuanbarang" aria-current="page" class="btn btn-close fa-1x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <form action="?aksi=create-satuan" method="post">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Satuan Barang</label>
                                            <input type="text" name="satuan" id="satuan" class="form-control"
                                                placeholder="masukkan data satauan barang ..." required>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Simpan
                                        </button>
                                        <a href="?page=satuanbarang" type="button" role="button"
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