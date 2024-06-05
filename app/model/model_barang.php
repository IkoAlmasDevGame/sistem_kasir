<?php 
namespace model;

class Barang {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table(){
        $row = $this->db->prepare("SELECT * FROM barang order by id asc");
        return $row;
    }

    public function create($tanggal,$kode_barang,$nama_barang,$kategori,$jumlah,$hargabeli,$hargajual,$satuan,$pengirim){
        $tanggal = htmlentities($_POST['tanggal_masuk']) ? htmlspecialchars($_POST['tanggal_masuk']) : $_POST['tanggal_masuk'];
        $barang = htmlentities($_POST['barang']) ? htmlspecialchars($_POST['barang']) : $_POST['barang'];
        $pecah_barang = explode(".", $barang);
        $kode_barang = $pecah_barang[0];
        $nama_barang = $pecah_barang[1];
        $kategori = htmlentities($_POST['kategori']) ? htmlspecialchars($_POST['kategori']) : $_POST['kategori'];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $hargabeli = htmlentities($_POST['beli']) ? htmlspecialchars($_POST['beli']) : $_POST['beli'];
        $hargajual = htmlentities($_POST['jual']) ? htmlspecialchars($_POST['jual']) : $_POST['jual'];
        $satuan = htmlspecialchars($_POST['satuan']) ? htmlentities($_POST['satuan']) : $_POST['satuan'];
        $pengirim = htmlspecialchars($_POST['pengirim']) ? htmlentities($_POST['pengirim']) : $_POST['pengirim'];
        $pecah_nama = explode(".", $pengirim);
        $nama_supplier = $pecah_nama[0];

        $table = "barang";
        $sql = "INSERT INTO $table (tanggal_input,kode_barang,nama_barang,kategori,jumlah,harga_beli,harga_jual,satuan,pengirim)
         VALUES ('$tanggal','$kode_barang','$nama_barang','$kategori','$jumlah','$hargabeli','$hargajual','$satuan','$pengirim')";
        $row = $this->db->prepare($sql);
        $row->execute();

        if($row){
            echo "<script>
            alert('Simpan Data Berhasil');
            document.location.href = '../ui/header.php?page=barang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Data Gagal tersimpan');
            document.location.href = '../ui/header.php?page=barangmasuk&aksi=tambahbarang';
            </script>";
            die;
            exit;
        }
    }
}

?>