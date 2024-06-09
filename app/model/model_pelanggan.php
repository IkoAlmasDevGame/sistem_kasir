<?php 
namespace model;

class Pelanggan {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function updateTable($query,$id){
        $row = $this->db->prepare($query);
        $row->execute(array($id));
        return $row;
    }

    public function create($nama,$telepon,$alamat){
        $nama = htmlentities($_POST['nama_pelanggan']) ? htmlspecialchars($_POST['nama_pelanggan']) : $_POST['nama_pelanggan'];
        $telepon = htmlentities($_POST['nomor_telepon']) ? htmlspecialchars($_POST['nomor_telepon']) : $_POST['nomor_telepon'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];

        $table = "pelanggan";
        $sql = "INSERT INTO $table (nama_pelanggan,nomor_telepon,alamat) VALUES (?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($nama,$telepon,$alamat));

        if($row){
            echo "<script>
            alert('berhasil tambah pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit;
        }else{
           echo "<script>
            alert('gagal tambah pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit; 
        }
    }

    public function update($nama,$telepon,$alamat,$id){
        $nama = htmlentities($_POST['nama_pelanggan']) ? htmlspecialchars($_POST['nama_pelanggan']) : $_POST['nama_pelanggan'];
        $telepon = htmlentities($_POST['nomor_telepon']) ? htmlspecialchars($_POST['nomor_telepon']) : $_POST['nomor_telepon'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $table = "pelanggan";
        $sql = "UPDATE $table SET nama_pelanggan=?, nomor_telepon=?, alamat=? WHERE id=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($nama,$telepon,$alamat,$id));

        if($row){
            echo "<script>
            alert('berhasil ubah pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit;
        }else{
           echo "<script>
            alert('gagal ubah pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit; 
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];

        $table = "pelanggan";
        $sql = "DELETE FROM $table WHERE id=?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));

        if($row){
            echo "<script>
            alert('berhasil hapus pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit;
        }else{
           echo "<script>
            alert('gagal hapus pelanggan');
            document.location.href = '../ui/header.php?page=pelanggan';
            </script>";
            die;
            exit; 
        }
    }
}

?>