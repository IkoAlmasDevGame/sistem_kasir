<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "pegawai")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pelanggan</title>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Tambah Data Pelanggan</h4>
                        <a href="?page=pelanggan" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                            if(isset($_GET['id'])){ 
                            $id = htmlspecialchars($_GET['id']);
                            $hasil = $pelanggan->readupdate("SELECT * FROM pelanggan WHERE id = ?", $id);
                            foreach($hasil as $isi){
                        ?>
                        <form action="?aksi=ubah-pelanggan" class="form-group" method="post">
                            <input type="hidden" name="id" value="<?=$isi['id']?>">
                            <table class="table table-striped-columns">
                                <tr>
                                    <td>
                                        <label for="">Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                                            placeholder="masukkan nama pelanggan ..."
                                            value="<?=$isi['nama_pelanggan']?>" class="form-control" maxlength="128"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Nomor Telepon</label>
                                        <input type="text" name="nomor_telepon" id="nomor_telepon"
                                            placeholder="masukkan nomor telepon pelanggan"
                                            value="<?=$isi['nomor_telepon']?>" maxlength="13" class="form-control"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Alamat Rumah</label>
                                        <textarea name="alamat" placeholder="masukkan alamat rumah pelanggan ..."
                                            id="alamat" class="form-control" maxlength="255"
                                            required><?php echo $isi['alamat'] ?></textarea>
                                    </td>
                                </tr>
                            </table>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-secondary hover">
                                        Update
                                    </button>
                                    <a href="?page=pelanggan" type="button" role="button"
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
        <?php require_once("../ui/footer.php") ?>