<?php 
require_once("../../database/koneksi.php");
$tamp = htmlspecialchars($_POST["tamp"]);
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];

$sql = "SELECT * FROM gudang where kode_barang = '$kode_bar'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
?>
<label for="">Kode Barang</label>
<div class="form-group">
    <div class="form-line">
        <input readonly="readonly" id="kode_barang" name="" type="text" class="form-control"
            value="<?php echo $row["kode_barang"];?>">
        </input>
    </div>
</div>

<label for="">Nama Barang</label>
<div class="form-group">
    <div class="form-line">
        <input readonly="readonly" id="nama_barang" name="" type="text" class="form-control"
            value="<?php echo $row["nama_barang"];?>">
        </input>
    </div>
</div>

<label for="">Kategori Barang</label>
<div class="form-group">
    <div class="form-line">
        <input readonly="readonly" id="kategori" name="kategori" type="text" class="form-control"
            value="<?php echo $row["jenis_barang"];?>">
        </input>
    </div>
</div>

<label for="">Jumlah</label>
<div class="form-group">
    <div class="form-line">
        <input readonly="readonly" id="jumlah" name="jumlah" type="text" class="form-control"
            value="<?php echo $row["jumlah"];?>">
        </input>
    </div>
</div>
<?php
    }
}else{
    echo "0 results";
    $conn->close();
}
?>