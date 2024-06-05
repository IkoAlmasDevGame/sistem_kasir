<?php 
require_once("../../database/koneksi.php");
$tamp = htmlspecialchars($_POST["tamp"]);
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];

$sql = "SELECT * FROM gudang where kode_barang = '$kode_bar'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {?>
<label for="">Satuan</label>
<div class="form-group">
    <div class="form-line">
        <input readonly="readonly" id="satuan" name="satuan" type="text" class="form-control"
            value="<?php echo $row["satuan"];?>">
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