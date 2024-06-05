<?php 
namespace model;

class Satuan {
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

    public function create($satuan){
        $satuan = htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        
        $table = "satuan";
        $sql = "INSERT $table SET satuan = '$satuan'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menambahkan Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }
    }

    public function update($satuan, $id){
        $satuan = htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];
        
        $table = "satuan";
        $sql = "UPDATE $table SET satuan = '$satuan' WHERE id = '$id'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil ubah Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal ubah Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        
        $table = "satuan";
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $row = $this->dbb->query($sql);

        if($row){
            echo "<script>
            alert('berhasil hapus Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal hapus Satuan barang');
            document.location.href = '../ui/header.php?page=satuanbarang';
            </script>";
            die;
            exit;
        }
    }
}

?>