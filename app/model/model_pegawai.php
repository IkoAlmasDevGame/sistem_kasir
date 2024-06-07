<?php 
namespace model;

class Pegawai {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function updateTable($query,$nama){
        $row = $this->db->prepare($query);
        $row->execute(array($nama));
        return $row;
    }

    public function create($nama, $gaji, $bonus, $proses, $tanggal_input){
        $nama = htmlentities($_POST['nama_pegawai']) ? htmlspecialchars($_POST['nama_pegawai']) : $_POST['nama_pegawai'];
        $gaji = htmlentities($_POST['gaji']) ? htmlspecialchars($_POST['gaji']) : $_POST['gaji'];
        $bonus = htmlentities($_POST['bonus']) ? htmlspecialchars($_POST['bonus']) : $_POST['bonus'];
        $proses = htmlentities($_POST['proses']) ? htmlspecialchars($_POST['proses']) : $_POST['proses'];
        $tanggal_input = htmlentities($_POST['tanggal_input']) ? htmlspecialchars($_POST['tanggal_input']) : $_POST['tanggal_input'];

        $table = "gaji_pegawai";
        $sql = "INSERT INTO $table (nama_pegawai,gaji,bonus,proses,tanggal_input) VALUES (?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($nama, $gaji, $bonus, $proses, $tanggal_input));

        if($row){
            echo "<script>
            alert('berhasil menambahkan Gaji Pegawai');
            document.location.href = '../ui/header.php?page=gajipegawai';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan Gaji Pegawai');
            document.location.href = '../ui/header.php?page=gajipegawai';
            </script>";
            die;
            exit;
        }
    }
    
    public function update($proses, $nama){
        $proses = htmlentities($_POST['proses']) ? htmlspecialchars($_POST['proses']) : $_POST['proses'];
        $nama = htmlentities($_POST['nama_pegawai']) ? htmlspecialchars($_POST['nama_pegawai']) : $_POST['nama_pegawai'];

        $table = "gaji_pegawai";
        $sql = "UPDATE $table SET proses = '$proses' WHERE nama_pegawai = '$nama'";
        $row = $this->db->prepare($sql);
        $row->execute();

        if($row){
            echo "<script>
            alert('berhasil ubah proses Gaji Pegawai');
            document.location.href = '../ui/header.php?page=gajipegawai';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal ubah proses Gaji Pegawai');
            document.location.href = '../ui/header.php?page=gajipegawai';
            </script>";
            die;
            exit;
        }
    }
}

?>