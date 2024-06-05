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
                        <h6 class="m-0 font-weight-bold text-primary">Edit Gudang</h6>
                        <a href="?page=gudang" class="btn btn-close fa-2x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <?php 
                                if(isset($_GET['id'])){
                                    $id = htmlspecialchars($_GET['id']);
                                    $row = $config->query("SELECT * FROM gudang WHERE id = '$id'");
                                    while ($isi = mysqli_fetch_array($row)) {
                            ?>
                            <form action="?aksi=ubah-gudang" method="post">
                                <input type="hidden" name="id" value="<?=$isi['id']?>">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Kode Barang</label>
                                            <div class="form-line">
                                                <input type="text" name="kode_barang" class="form-control"
                                                    id="kode_barang" value="<?php echo $isi['kode_barang']; ?>"
                                                    readonly />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Nama Barang</label>
                                            <div class="form-line">
                                                <input type="text" name="nama_barang" value="<?=$isi['nama_barang']?>"
                                                    class="form-control" required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Jenis Barang</label>
                                            <select name="jenis_barang" value="<?=$isi['jenis_barang']?>"
                                                id="jenis_barang" class="form-control" required>
                                                <option value="">Pilih Jenis Barang</option>
                                                <?php 
                                                $row = $jenis->Read("SELECT * FROM jenis_barang order by id asc");
                                                while ($data = mysqli_fetch_array($row)) {
                                            ?>
                                                <option <?php if($isi["jenis_barang"] = $data['jenis_barang']){?>
                                                    selected value="<?=$isi['jenis_barang']?>" <?php } ?>
                                                    value="<?=$data['jenis_barang']?>">
                                                    <?php echo $data['jenis_barang'] ?></option>
                                                <?php
                                                }
                                            ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Satuan Barang</label>
                                            <select name="satuan" value="<?=$isi['satuan']?>" id="satuan"
                                                class="form-control" required>
                                                <option value="">Pilih Satuan Barang</option>
                                                <?php 
                                                $row = $satuan->Read("SELECT * FROM satuan order by id asc");
                                                while ($sdata = mysqli_fetch_array($row)) {
                                            ?>
                                                <option <?php if($isi["satuan"] = $sdata['satuan']){?> selected
                                                    value="<?php echo $isi['satuan']?>" <?php } ?>
                                                    value="<?php echo $sdata['satuan']?>">
                                                    <?php echo $sdata['satuan'] ?></option>
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