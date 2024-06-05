<?php 
namespace model;

class BarangMasuk {
    protected $dbb;
    public function __construct($dbb)
    {
        $this -> dbb = $dbb;
    }

    public function Table($query){
        $row = $this->dbb->query($query);
        return $row;
    }
    
    public function create($id_transaksi,$tanggal,$kode_barang,$nama_barang,$jumlah,$satuan,$pengirim){
        $id_transaksi = htmlentities($_POST['id_transaksi']) ? htmlspecialchars($_POST['id_transaksi']) : $_POST['id_transaksi'];
        $tanggal = htmlentities($_POST['tanggal_masuk']) ? htmlspecialchars($_POST['tanggal_masuk']) : $_POST['tanggal_masuk'];
        $barang = htmlentities($_POST['barang']) ? htmlspecialchars($_POST['barang']) : $_POST['barang'];
        $pecah_barang = explode(".", $barang);
        $kode_barang = $pecah_barang[0];
        $nama_barang = $pecah_barang[1];
        $pengirim = htmlspecialchars($_POST['pengirim']) ? htmlentities($_POST['pengirim']) : $_POST['pengirim'];
        $pecah_nama = explode(".", $pengirim);
        $nama_supplier = $pecah_nama[0];
        $jumlah = htmlspecialchars($_POST['jumlahmasuk']) ? htmlentities($_POST['jumlahmasuk']) : $_POST['jumlahmasuk'];
        $satuan = htmlspecialchars($_POST['satuan']) ? htmlentities($_POST['satuan']) : $_POST['satuan'];

        $table = "barang_masuk";
        $sql = "insert into $table (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, satuan, pengirim)
         values ('$id_transaksi','$tanggal','$pecah_barang[0]','$pecah_barang[1]','$jumlah','$satuan','$pengirim')";
        $row = $this->dbb->query($sql);
        if($row){
            echo "<script>
            alert('Simpan Data Berhasil');
            document.location.href = '../ui/header.php?page=barangmasuk';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Data Gagal tersimpan');
            document.location.href = '../ui/header.php?page=barangmasuk&aksi=tambahbarangmasuk';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id_transaksi){
        $id_transaksi = htmlentities($_GET['id_transaksi']) ? htmlspecialchars($_GET['id_transaksi']) : $_GET['id_transaksi'];
        $table = "barang_masuk";
        $sql = "DELETE FROM $table WHERE id_transaksi = '$id_transaksi'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('Hapus Data Berhasil');
            document.location.href = '../ui/header.php?page=barangmasuk';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Hapus Data Gagal');
            document.location.href = '../ui/header.php?page=barangmasuk';
            </script>";
            die;
            exit;            
        }
    }
}

?>