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
        <title>Data Master Barang</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Barang</h4>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title">Data Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Satuan Barang</th>
                                        <th>Opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $hasil = $barang->read();
                                        foreach ($hasil as $isi) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $isi['kode_barang'] ?></td>
                                        <td><?php echo $isi['nama_barang'] ?></td>
                                        <td><?php echo $isi['kategori'] ?></td>
                                        <td><?php echo $isi['jumlah'] ?></td>
                                        <td><?php echo "Rp. ".number_format($isi['harga_beli']) ?></td>
                                        <td><?php echo "Rp. ".number_format($isi['harga_jual']) ?></td>
                                        <td><?php echo $isi['satuan'] ?></td>
                                        <td>
                                            <a href="?page=barang&aksi=ubahbarang&kode_barang=<?=$isi['kode_barang']?>"
                                                aria-current="page" role="button" class="btn btn-warning hover btn-sm">
                                                <i class="fa fa-edit fa-1x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <table>
                            <tbody>
                                <a href="?page=barang&aksi=tambahbarang" role="button" class="btn btn-danger hover">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Barang</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>