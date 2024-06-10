<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin"){
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Sistem Website</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Ubah Sistem</h4>
                        <a href="?page=sistem" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php 
                            if(isset($_GET['id'])){
                                $id = htmlspecialchars($_GET['id']);
                                $row = $conn->query("SELECT * FROM sistem WHERE id = '$id'");
                                while ($isi = $row->fetch_array()) {
                        ?>
                        <form action="?aksi=ubah-sistem" method="post">
                            <input type="hidden" name="id" value="<?=$isi['id']?>">
                            <div class="form-group mb-2 mt-1">
                                <label for="">Nama Website</label>
                                <div class="col-sm-12">
                                    <div class="form-inline">
                                        <input type="text" name="nama_website" id="nama_website"
                                            value="<?=$isi['nama_website']?>" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 mt-1">
                                <label for="">Nama Pemilik</label>
                                <div class="col-sm-12">
                                    <div class="form-inline">
                                        <input type="text" name="nama" id="nama" value="<?=$isi['nama']?>" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2 mt-1">
                                <label for="">Nama Pembuatan</label>
                                <div class="col-sm-12">
                                    <div class="form-inline">
                                        <input type="text" name="nama_pembuatan" id="nama_pembuatan"
                                            value="<?=$isi['nama_pembuatan']?>" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary hover">
                                        Update
                                    </button>
                                    <a href="?page=sistem" type="button" role="button"
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
        <?php 
            require_once("../ui/footer.php");
        ?>