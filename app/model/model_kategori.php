<?php 
namespace model;

class Kategori {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table($query){
        $row = $this->db->query($query);
        return $row;
    }
    
    public function create($jenis){
        $jenis = htmlentities($_POST['kategori']) ? htmlspecialchars($_POST['kategori']) : $_POST['kategori'];
        $table = "kategori";
        $sql = "INSERT $table SET kategori = '$jenis'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menambahkan jenis barang');
            document.location.href = '../ui/header.php?page=kategori';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan jenis barang');
            document.location.href = '../ui/header.php?page=kategori';
            </script>";
            die;
            exit;
        }
    }
}

?>