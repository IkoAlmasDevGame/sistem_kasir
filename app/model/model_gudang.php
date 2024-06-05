<?php 
namespace model;

class Gudang {
    protected $dbb;
    public function __construct($dbb)
    {
        $this -> dbb = $dbb;
    }

    public function Table($query){
        $row = $this->dbb->query($query);
        return $row;
    }
    
    public function TableUpdate($query){
        $row = $this->dbb->query($query);
        return $row;
    }

    public function create($kode_barang,$nama_barang,$jenis_barang,$jumlah,$satuan){
        $kode_barang = htmlentities($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : $_POST['kode_barang'];
        $nama_barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jenis_barang = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
		$pecah_jenis = explode(".", $jenis_barang);
		$id = $pecah_jenis[0];
        $jenis_barang  = $pecah_jenis[1];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan = htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $pecah_satuan = explode(".", $satuan);     
        $id = $pecah_satuan[0];
        $satuan = $pecah_satuan[1];

        $table = "gudang";
        $sql = "INSERT $table SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', jenis_barang = '$jenis_barang',
         jumlah = '$jumlah', satuan = '$satuan'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menambahkan data gudang');
            document.location.href = '../ui/header.php?page=gudang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan data gudang');
            document.location.href = '../ui/header.php?page=gudang';
            </script>";
            die;
            exit;
        }
    }

    public function update($kode_barang,$nama_barang,$jenis_barang,$jumlah,$satuan,$id_gudang){
        $kode_barang = htmlentities($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : $_POST['kode_barang'];
        $nama_barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jenis_barang = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
		$pecah_jenis = explode(".", $jenis_barang);
		$id = $pecah_jenis[0];
        $jenis_barang = $pecah_jenis[1];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan = $_POST['satuan'];
        $pecah_satuan = explode(".", $satuan);     
        $id = $pecah_satuan[0];
        $satuan = $pecah_satuan[1];
        $id_gudang = htmlentities($_POST["id"]) ? htmlspecialchars($_POST["id"]) : $_POST["id"];

        $table = "gudang";
        $sql = "UPDATE $table SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', jenis_barang = '$jenis_barang',
         jumlah = '$jumlah', satuan = '$satuan' WHERE id = '$id_gudang'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil ubah data gudang');
            document.location.href = '../ui/header.php?page=gudang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal ubah data gudang');
            document.location.href = '../ui/header.php?page=gudang';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id_gudang){
        $id_gudang = htmlentities($_GET["id"]) ? htmlspecialchars($_GET["id"]) : $_GET["id"];
        $table = "gudang";
        $sql = "DELETE FROM $table WHERE id = '$id_gudang'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil Hapus data gudang');
            document.location.href = '../ui/header.php?page=gudang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal Hapus data gudang');
            document.location.href = '../ui/header.php?page=gudang&aksi=tambahgudang';
            </script>";
            die;
            exit;
        }
    }
}

?>