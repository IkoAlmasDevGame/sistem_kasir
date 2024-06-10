<?php 
require_once("../../database/koneksi.php");
$row = $config->prepare("SELECT * FROM sistem WHERE flags = '1'");
$row->execute();
$hasil = $row->fetch();
$_SESSION['nama_website'] = $hasil['nama_website'];

// Controller 1
require_once("../../controller/controller.php");
require_once("../../model/model_pengguna.php");
require_once("../../model/model_barang.php");
require_once("../../model/model_pegawai.php");
require_once("../../model/model_kasir.php");
require_once("../../model/model_pelanggan.php");
$users = new controller\Authentication($config);
$barang = new controller\DataBarang($config);
$pegawai = new controller\GajiPegwai($config);
$modelkasir = new model\Penjualan($config);
$pelanggan = new controller\Customer($config);

// Controller 2
require_once("../../controller/controller2.php");
require_once("../../model/model_barangkeluar.php");
require_once("../../model/model_barangmasuk.php");
require_once("../../model/model_supplier.php");
require_once("../../model/model_gudang.php");
require_once("../../model/model_satuan.php");
require_once("../../model/model_kategori.php");
$barangmasuk = new controller2\Masuk($conn);
$barangkeluar = new controller2\Keluar($conn);
$satuan = new controller2\SatuanBarang($conn);
$gudang = new controller2\Building($conn);
$supplier = new controller2\Distributor($conn);
$jenisbarang = new controller2\KategoriBarang($conn);

if(!isset($_GET['page'])){
    require_once("../dashboard/index.php");
}else{
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'barangmasuk':
            require_once("../barangmasuk/barangmasuk.php");
            break;
            
        case 'barangkeluar':
            require_once("../barangkeluar/barangkeluar.php");
            break;

        case 'barang':
            require_once("../barang/barang.php");
            break;
            
        case 'gudang':
            require_once("../gudang/gudang.php");
            break;
            
        case 'gajipegawai':
            require_once("../pegawai/gajipegawai.php");
            break;

        case 'pegawai':
            require_once("../pegawai/pegawai.php");
            break;
            
        case 'supplier':
            require_once("../supplier/supplier.php");
            break;
            
        case 'satuanbarang':
            require_once("../satuan/satuanbarang.php");
            break;
            
        case 'kategori':
            require_once("../kategori/kategori.php");
            break;

        case 'pengguna':
            require_once("../pengguna/pengguna.php");
            break;

        case 'editpengguna':
            require_once("../pengguna/ubahpengguna2.php");
            break;

        case 'laporan-barang':
            require_once("../laporan/laporan-barang.php");
            break;
        case 'export-barang':
            require_once("../laporan/export-barang.php");
            break;

        case 'laporan-penjualan':
            require_once("../laporan/laporan-penjualan.php");
            break;
        case 'export-laporan-penjualan':
            require_once("../laporan/export-penjualan.php");
            break;

        case 'laporan-barangmasuk':
            require_once("../laporan/laporan-barangmasuk.php");
            break;
        case 'export-barangmasuk':
            require_once("../laporan/export-barangmasuk.php");
            break;

        case 'laporan-barangkeluar':
            require_once("../laporan/laporan-barangkeluar.php");
            break;
        case 'export-barangkeluar':
            require_once("../laporan/export-barangkeluar.php");
            break;

        case 'laporan-gudang':
            require_once("../laporan/laporan-gudang.php");
            break;
        case 'export-gudang':
            require_once("../laporan/export-gudang.php");
            break;

        case 'laporan-gajipegawai':
            require_once("../laporan/laporan-pegawai.php");
            break;
        case 'export-gaji':
            require_once("../laporan/export-gaji.php");
            break;

        case 'laporan-supplier':
            require_once("../laporan/laporan-supplier.php");
            break;
        case 'export-supplier':
            require_once("../laporan/export-supplier.php");
            break;

        case 'kasir-penjualan':
            require_once("../kasir/index.php");
            break;
        case 'print-kasir':
            require_once("../kasir/print.php");
            break;
            
        case 'pelanggan':
            require_once("../pelanggan/pelanggan.php");
            break;
            
        case 'sistem':
            require_once("../settings/sistem.php");
            break;
        
        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../auth/index.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
    require_once("../../controller/controller.php");
    require_once("../../controller/controller2.php");
}else{
    switch ($_GET['aksi']) {
        // Sistem
        case 'ubahsistem':
            require_once("../settings/ubahsistem.php");
            break;
            
            case 'ubah-sistem':
                $id = htmlspecialchars($_POST['id']);
                $website = htmlspecialchars($_POST['nama_website']);
                $pemilik = htmlspecialchars($_POST['nama']);
                $pembuatan = htmlspecialchars($_POST['nama_pembuatan']);
                                
                $table = "sistem";
                $sql = "UPDATE $table SET nama_website = '$website', nama = '$pemilik', nama_pembuatan = '$pembuatan' WHERE id = '$id'";
                $row = $conn->query($sql);
                                
                if($row){
                    echo "<script>document.location.href = '../ui/header.php?page=sistem'</script>";
                    die;
                    exit;
                }else{
                    echo "<script>document.location.href = '../ui/header.php?page=sistem'</script>";
                    die;
                    exit;                            
                }
            break;

        // Barang 
        case 'tambahbarang':
            require_once("../barang/tambahbarang.php");
            break;
        case 'ubahbarang':
            require_once("../barang/ubahbarang.php");
            break;
            // Aksi Barang
            case 'tambah-barang':
                $barang->buat();
                break;
            case 'ubah-barang':
                $barang->ubah();
                break;
        // Barang

        // Barang Masuk
            case 'tambahbarangmasuk':
                require_once("../barangmasuk/tambahbarangmasuk.php");
            break;
            // Aksi Barang Masuk
            case 'tambah-barangmasuk':
                $barangmasuk->buat();
                break;
            case 'hapus-barangmasuk':
                $barangmasuk->hapus();
                break;
        // Barang Masuk

        // Barang Keluar
            case 'tambahbarangkeluar':
                require_once("../barangkeluar/tambahbarangkeluar.php");
            break;
            // Aksi Barang Keluar
            case 'tambah-barangkeluar':
                $barangkeluar->buat();
                break;
            case 'hapus-barangkeluar':
                $barangkeluar->hapus();
                break;
        // Barang Keluar
        
        // Gudang
            case 'tambahgudang':
                require_once("../gudang/tambahgudang.php");
            break;
            // Aksi Barang Keluar
            case 'tambah-gudang':
                $gudang->buat();
                break;
            case 'ubah-gudang':
                $gudang->buat();
                break;
            case 'hapus-gudang':
                $gudang->hapus();
                break;
        // Barang Gudang

        // Satuan Barang
            case 'tambahsatuanbarang':
                require_once("../satuan/tambahsatuanbarang.php");
            break;
            case 'ubahsatuanbarang':
                require_once("../satuan/ubahsatuanbarang.php");
            break;
            // Aksi Barang Keluar
            case 'create-satuan':
                $satuan->buat();
                break;
            case 'ubah-satuan':
                $satuan->buat();
                break;
            case 'hapus-satuan':
                $satuan->hapus();
                break;
        // Satuan Barang
        
        // Kategori Barang
            case 'tambahkategori':
                require_once("../kategori/tambahkategori.php");
            break;
            // Aksi Barang Keluar
            case 'create-kategori':
                $jenisbarang->buat();
                break;
        // Kategori Barang

        // Satuan Barang
            case 'tambahsupplier':
                require_once("../supplier/tambahsupplier.php");
            break;
            case 'ubahsupplier':
                require_once("../supplier/ubahsupplier.php");
            break;
            // Aksi Barang Keluar
            case 'create-supplier':
                $supplier->buat();
                break;
            case 'ubah-supplier':
                $supplier->buat();
                break;
            case 'hapus-supplier':
                $supplier->hapus();
                break;
        // Satuan Barang

        // Gaji Pegawai
        case 'create-gajian':
            $pegawai->buat();
            break;
        case 'ubah-proses':
            $pegawai->ubahproses();
            break;
        // Gaji Pegawai

        // Pegawai 
        case 'tambahpengguna':
            require_once("../pengguna/tambahpengguna.php");
            break;
        case 'ubahpengguna':
            require_once("../pengguna/ubahpengguna.php");
            break;
            // Aksi Tambah Pengguna
            case 'tambah-pengguna':
                $users->buat();
                break;
            case 'ubah-pengguna':
                $users->ubah();
                break;
            case 'hapus-pengguna':
                $users->hapus();
                break;
        // Pegawai 

        // Pelanggan
        case 'tambahpelanggan':
            require_once("../pelanggan/tambahpelanggan.php");
            break;
        case 'ubahpelanggan':
            require_once("../pelanggan/ubahpelanggan.php");
            break;
            // Aksi Pelanggan
            case 'tambah-pelanggan':
                $pelanggan->buat();
                break;
            case 'ubah-pelanggan':
                $pelanggan->ubah();
                break;
            case 'hapus-pelanggan':
                $pelanggan->hapus();
                break;
        // Pelanggan

        // Kasir Penjualan
        case 'tambah-list':
            $modelkasir->keranjang();
            break;
        case 'edit-kasir':
            $modelkasir->EditKeranjang();
            break;
        case 'hapus-item-keranjang':
            $modelkasir->HapusItemKeranjang();
            break;
        case 'reset-keranjang':
            $modelkasir->HapusResetKeranjang();
            break;
        case 'reset-belanja':
            $modelkasir->HapusBelanjaan();
            break;
        // Kasir Penjualan

        default:
            require_once("../../controller/controller.php");
            require_once("../../controller/controller2.php");
            break;
    }
}
?>