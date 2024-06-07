<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pengguna</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Edit Pengguna</h4>
                        <a href="?page=pengguna" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <?php 
                                if(isset($_GET['id'])){
                                    $id = htmlspecialchars($_GET['id']);
                                    $row = $config->prepare("SELECT * FROM users WHERE id = ?");
                                    $row->execute(array($id));
                                    $hasil = $row->fetchAll();
                                foreach ($hasil as $isi) {
                            ?>
                            <form action="?aksi=ubah-pengguna" method="post">
                                <input type="hidden" name="id" value="<?=$isi['id']?>">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">Nama</label>
                                                <input type="text" name="nama" value="<?=$isi['nama']?>" id=""
                                                    class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">User Name</label>
                                                <input type="text" name="username" value="<?=$isi['username']?>" id=""
                                                    class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">E - Mailing</label>
                                                <input type="email" name="email" value="<?=$isi['email']?>" id=""
                                                    class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">Password</label>
                                                <input type="password" name="password" id="" class="form-control"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">Repassword</label>
                                                <input type="password" name="repassword" id="" class="form-control"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <label for="">Jabatan</label>
                                                <br>
                                                <input type="radio" name="role" id="" class="radio radio-inline"
                                                    <?php if($isi['role'] == "superadmin"){?> checked <?php } ?>
                                                    value="superadmin"> Superadmin
                                                <input type="radio" name="role" id="" class="radio radio-inline ms-3"
                                                    <?php if($isi['role'] == "admin"){?> checked <?php } ?>
                                                    value="admin"> Admin
                                                <input type="radio" name="role" id=""
                                                    <?php if($isi['role'] == "pegawai"){?> checked <?php } ?>
                                                    class="radio radio-inline ms-3" value="pegawai"> Pegawai
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Simpan
                                        </button>
                                        <a href="?page=pengguna" type="button" role="button"
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
            require_once("../ui/footer.php");
        ?>