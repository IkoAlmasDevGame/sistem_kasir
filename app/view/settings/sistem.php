<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin"){
                require_once("../ui/header.php");
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
                    <h4 class="card-title">Sistem Website</h4>
                    <div class="text-end">
                        <a href="?page=sistem" class="btn btn-sm hover">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body mt-1">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered w-100" id="example2">
                            <thead>
                                <tr>
                                    <th>Nama Website</th>
                                    <th>Nama Pemilik Website</th>
                                    <th>Nama Pembuatan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $row = $conn->query("SELECT * FROM sistem");
                                    while ($isi = $row->fetch_array()) {
                                ?>
                                <tr>
                                    <td><?php echo $isi['nama_website'] ?></td>
                                    <td><?php echo $isi['nama'] ?></td>
                                    <td><?php echo $isi['nama_pembuatan'] ?></td>
                                    <td>
                                        <a href="?page=sistem&aksi=ubahsistem&id=<?=$isi['id']?>"
                                            class="btn btn-sm btn-warning hover">
                                            <i class="fa fa-edit fa-1x"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>