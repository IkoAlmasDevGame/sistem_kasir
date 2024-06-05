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
        <title>Data Master Supplier</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="card-title">Edit Supplier</h4>
                    <a href="?page=supplier" class="btn btn-close fa-2x"></a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <?php 
                                if(isset($_GET["id"])){
                                    $id = htmlspecialchars($_GET["id"]);
                                    $row = $config->query("SELECT * FROM supplier WHERE id = '$id'");
                                    while ($isi = mysqli_fetch_array($row)) {
                            ?>
                            <form action="?aksi=ubah-supplier" method="post">
                                <input type="hidden" name="id" value="<?=$isi['id']?>">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Kode Supplier</label>
                                            <input type="text" name="kode_supplier" required readonly
                                                class="form-control" value="<?=$isi['kode_supplier'];?>" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Nama Supplier</label>
                                            <input type="text" name="nama_supplier" value="<?=$isi['nama_supplier'];?>"
                                                required class="form-control" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Alamat Supplier</label>
                                            <textarea name="alamat" required class="form-control"
                                                id=""><?=$isi['alamat'];?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Telepon Supplier</label>
                                            <input type="text" name="telepon" value="<?=$isi['telepon'];?>" required
                                                class="form-control" id="">
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Simpan
                                        </button>
                                        <a href="?page=supplier" type="button" role="button"
                                            class="btn btn-default">Cancel</a>
                                        <button type="reset" class="btn btn-danger hover">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php 
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/sidebar.php");
        ?>