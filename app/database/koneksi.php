<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

// $dbname = "sistem_kasir";
// $conn = mysqli_connect("localhost", "root", "", $dbname);
$conn = mysqli_connect("localhost", "root", "", "cp_sistem_kasir") or die("Database gagal berfungsi ...".mysqli_connect_errno()); 
// $conn untuk barangmasuk, barangkeluar, gudang, supplier, satuan, kategori
try {
    // $config = new PDO("mysql:host=localhost;dbname=$dbname;", "root", """);
    $config = new PDO("mysql:host=localhost;dbname=cp_sistem_kasir;", "root", "");
    // $config untuk kasir, settings, pengguna, pelanggan, laporan, auth, pegawai, barang
}catch(Exception $e){
    die("Database gagal berfungsi".$e->getMessage());
}
?>