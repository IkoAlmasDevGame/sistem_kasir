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
$users = new controller\Authentication($config);
$barang = new controller\DataBarang($config);

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
            
        case 'supplier':
            require_once("../supplier/supplier.php");
            break;
            
        case 'satuanbarang':
            require_once("../satuan/satuanbarang.php");
            break;
            
        case 'kategori':
            require_once("../kategori/kategori.php");
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

        default:
            require_once("../../controller/controller.php");
            require_once("../../controller/controller2.php");
            break;
    }
}
?>