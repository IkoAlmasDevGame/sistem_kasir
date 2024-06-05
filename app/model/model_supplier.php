<?php 
namespace model;

class Supplier {
    protected $dbb;
    public function __construct($dbb)
    {
        $this -> dbb = $dbb;
    }

    public function Table($query){
        $row = $this->dbb->query($query);
        return $row;
    }
    
    public function TableUpdate($query,$id){
        $row = $this->dbb->query($query,$id);
        $row->fetch_array();
        return $row;
    }

    public function create($kode_supplier, $nama_supplier, $alamat, $telepon){
        $kode_supplier = htmlentities($_POST['kode_supplier']) ? htmlspecialchars($_POST['kode_supplier']) : $_POST['kode_supplier'];
        $nama_supplier = htmlentities($_POST['nama_supplier']) ? htmlspecialchars($_POST['nama_supplier']) : $_POST['nama_supplier'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
        $telepon = htmlentities($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : $_POST['telepon'];

        $table = "supplier";
        $sql = "INSERT INTO $table (kode_supplier,nama_supplier,alamat,telepon) VALUES ('$kode_supplier', '$nama_supplier', '$alamat', '$telepon')";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menambahkan Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }
    }

    public function update($kode_supplier, $nama_supplier, $alamat, $telepon, $id){
        $kode_supplier = htmlentities($_POST['kode_supplier']) ? htmlspecialchars($_POST['kode_supplier']) : $_POST['kode_supplier'];
        $nama_supplier = htmlentities($_POST['nama_supplier']) ? htmlspecialchars($_POST['nama_supplier']) : $_POST['nama_supplier'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
        $telepon = htmlentities($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : $_POST['telepon'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $table = "supplier";
        $sql = "UPDATE $table SET kode_supplier = '$kode_supplier', nama_supplier = '$nama_supplier', alamat = '$alamat',
         telepon = '$telepon' WHERE id = '$id'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil ubah Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal ubah Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        $table = "supplier";
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil hapus Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal hapus Supplier');
            document.location.href = '../ui/header.php?page=supplier';
            </script>";
            die;
            exit;
        }
    }
}

?>