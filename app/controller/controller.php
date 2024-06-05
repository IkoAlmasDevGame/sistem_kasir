<?php 
namespace controller;
use model\pengguna; // model users
use model\Barang; // model Barang Masuk


class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new pengguna($konfig);
    }

    public function SignIn(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $passInput = md5(htmlentities($_POST['passInput']), false) ? md5(htmlspecialchars($_POST['passInput']), false) : md5($_POST['passInput'], false);
        password_verify($passInput, PASSWORD_DEFAULT);
        $result = $this->konfig->Login($userInput,$passInput);
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
}
?>