<?php 
namespace controller;
use model\pengguna; // model users
use model\Barang; // model Barang Masuk
use model\Pegawai; // model Gaji Pegawai


class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new pengguna($konfig);
    }

    public function readupdate($query,$id){
        $row = $this->konfig->updateTable($query,$id);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function buat(){
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $_POST['nama'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = htmlentities($_POST['password']) ? htmlspecialchars($_POST['password']) : $_POST['password'];
        $repassword = htmlentities($_POST['repassword']) ? htmlspecialchars($_POST['repassword']) : $_POST['repassword'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];

        $result = $this->konfig->create($nama,$username,$email,md5($password, false), md5($repassword, false),$role);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $_POST['nama'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = htmlentities($_POST['password']) ? htmlspecialchars($_POST['password']) : $_POST['password'];
        $repassword = htmlentities($_POST['repassword']) ? htmlspecialchars($_POST['repassword']) : $_POST['repassword'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $result = $this->konfig->update($nama,$username,$email,md5($password, false), md5($repassword, false),$role,$id);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        $result = $this->konfig->delete($id);
        if($result === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }

    public function Login(){
        session_start();
        $userInput = htmlentities($_POST["userInput"]) ? htmlspecialchars($_POST["userInput"]) : $_POST["userInput"];
        $password = md5($_POST["password"], false);

        $result = $this->konfig->SignIn($userInput,$password);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
}

class DataBarang {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Barang($konfig);
    }

    public function read(){
        $row = $this->konfig->Table();
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function readupdate($query,$kode_barang){
        $row = $this->konfig->updateTable($query,$kode_barang);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function buat(){
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

        $result = $this->konfig->create($tanggal,$kode_barang,$nama_barang,$kategori,$jumlah,$hargabeli,$hargajual,$satuan,$pengirim);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kode_barang = htmlentities($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : $_POST['kode_barang'];
        $hargabeli = htmlentities($_POST['beli']) ? htmlspecialchars($_POST['beli']) : $_POST['beli'];
        $hargajual = htmlentities($_POST['jual']) ? htmlspecialchars($_POST['jual']) : $_POST['jual'];
        
        $result = $this->konfig->update($hargabeli,$hargajual,$kode_barang);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
}

class GajiPegwai {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pegawai($konfig);
    }

    public function readupdate($query,$nama){
        $row = $this->konfig->updateTable($query,$nama);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function buat(){
        $nama = htmlentities($_POST['nama_pegawai']) ? htmlspecialchars($_POST['nama_pegawai']) : $_POST['nama_pegawai'];
        $gaji = htmlentities($_POST['gaji']) ? htmlspecialchars($_POST['gaji']) : $_POST['gaji'];
        $bonus = htmlentities($_POST['bonus']) ? htmlspecialchars($_POST['bonus']) : $_POST['bonus'];
        $proses = htmlentities($_POST['proses']) ? htmlspecialchars($_POST['proses']) : $_POST['proses'];
        $tanggal_input = htmlentities($_POST['tanggal_input']) ? htmlspecialchars($_POST['tanggal_input']) : $_POST['tanggal_input'];
        
        $result = $this->konfig->create($nama, $gaji, $bonus, $proses, $tanggal_input);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubahproses(){
        $proses = htmlentities($_POST['proses']) ? htmlspecialchars($_POST['proses']) : $_POST['proses'];
        $nama = htmlentities($_POST['nama_pegawai']) ? htmlspecialchars($_POST['nama_pegawai']) : $_POST['nama_pegawai'];

        $result = $this->konfig->update($proses, $nama);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
}
?>