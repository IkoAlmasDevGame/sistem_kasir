<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
                $no = $conn->query("SELECT kode_supplier FROM supplier order by kode_supplier desc");
                $idtran = $no->fetch_array();
                $kode = isset($idtran["kode_supplier"]);

                $urut = substr($kode, 8, 3);
                $tambah = (int) $urut + 1;
                $bulan = date("m");
                $tahun = date("y");
                            
                if(strlen($tambah) == 1){
                	$format = "SUPP-".$bulan.$tahun."00".$tambah;
                } else if(strlen($tambah) == 2){
                	$format = "SUPP-".$bulan.$tahun."0".$tambah;
                } else{
                	$format = "SUPP-".$bulan.$tahun.$tambah;
                }
                
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
                    <h4 class="card-title">Tambah Supplier</h4>
                    <a href="?page=supplier" class="btn btn-close fa-2x"></a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <form action="?aksi=create-supplier" method="post">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Kode Supplier</label>
                                            <input type="text" name="kode_supplier" required readonly
                                                class="form-control" value="<?=$format;?>" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Nama Supplier</label>
                                            <input type="text" name="nama_supplier" required class="form-control" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Alamat Supplier</label>
                                            <textarea name="alamat" required class="form-control" id=""></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Telepon Supplier</label>
                                            <input type="text" name="telepon" required class="form-control" id="">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/sidebar.php");
        ?>