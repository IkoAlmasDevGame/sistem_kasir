<?php 
namespace model;

class Penjualan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function table(){
        $row = $this->db->prepare("SELECT penjualan.* , barang.kode_barang, barang.nama_barang, barang.harga_jual from penjualan 
        left join barang on barang.kode_barang = penjualan.kode_barang ORDER BY id ASC");
        $row->execute();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function jual(){
        $date = array(date("m-Y"));
        $sql = "SELECT v_nota.* , barang.kode_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from v_nota 
        left join barang on barang.kode_barang = v_nota.kode_barang where v_nota.periode = ? ORDER BY id ASC";
        $row = $this->db->prepare($sql);
        $row->execute($date);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function periode_jual($periode){
        $sql = "SELECT v_nota.* , barang.kode_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from v_nota 
        left join barang on barang.kode_barang = v_nota.kode_barang where v_nota.periode = ? ORDER BY id ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($periode));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function hari_jual($hari){
        $ex = explode('-', $hari);
        $monthNum  = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl.' '.$monthName.' '.$ex[0];
        $param = "%{$cek}%";
        $sql = "SELECT v_nota.* , barang.kode_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from v_nota 
        left join barang on barang.kode_barang=v_nota.kode_barang WHERE v_nota.tanggal_input LIKE ? ORDER BY id ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($param));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function jumlah(){
        $sql = "SELECT SUM(total) as bayar FROM penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    } 

    public function jumlah_nota(){
        $sql = "SELECT SUM(total) as bayar FROM nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function total(){
        $sql = "SELECT SUM(total) as total FROM v_penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function total_nota(){
        $sql = "SELECT SUM(total) as total FROM v_nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row->fetch();
        return $hasil;
    }

    public function keranjang(){
        $kode_barang = htmlspecialchars($_GET['kode_barang']);
        $sqbarang = "SELECT barang.*, gudang.kode_barang FROM barang left join gudang on gudang.kode_barang = barang.kode_barang WHERE kode_barang = '$kode_barang'";
        $rowbarang = $this->db->prepare($sqbarang);
        $rowbarang->execute();
        $row = $rowbarang->fetch();

        if($row['jumlah'] > 0){
            $jumlah = 1;
            $harga = $row['harga_jual'];
            $total = $row['harga_jual'] * $jumlah;
            $tgl = date("j F Y, G:i");

            $table = "penjualan";
            $this->db->prepare("INSERT INTO $table (kode_barang,harga_jual,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)")->execute(
                array($kode_barang,$harga,$jumlah,$total,$tgl));
            $this->db->prepare("INSERT INTO v_penjualan (kode_barang,harga_jual,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)")->execute(
                array($kode_barang,$harga,$jumlah,$total,$tgl));
            echo "<script>document.location.href = '../ui/header.php?page=kasir-penjualan&nota=yes'</script>";
        }else{
            echo '<script>
            alert("Stok Barang Anda Telah Habis !");
            document.location.href = "../ui/header.php?page=kasir-penjualan#keranjang";
            </script>';
        }
    }

    public function EditKeranjang(){
        $table = "barang";
        $id = htmlentities($_POST['id']);
        $kode_barang = htmlentities($_POST['kode_barang']);
        $jumlah = htmlentities($_POST['jumlah']);
        /* Pengeditan data barang */
        $sqbarang = "SELECT * FROM $table WHERE kode_barang = ?";
        $rwbarang = $this->db->prepare($sqbarang);
        $rwbarang->execute(array($kode_barang));
        $hasil = $rwbarang->fetch();

        if($hasil['jumlah'] > $jumlah){
            $jual = $hasil['harga_jual'];
            $total = $jual * $jumlah;
            $data[] = $id;
            $data[] = $jumlah;
            $data[] = $total;
            
            $sqUpdate = "UPDATE penjualan SET jumlah=?, total=? WHERE id=?";
            $rwUpdate = $this->db->prepare($sqUpdate);
            $rwUpdate->execute($data);
            $this->db->prepare("UPDATE v_penjualan SET jumlah=?, total=? WHERE id=?")->execute($data);
            echo "<script>document.location.href = '../ui/header.php?page=kasir-penjualan&nota=yes'</script>";
        }else{
            echo '<script>
            alert("Stok Barang Anda Telah Habis !");
            document.location.href = "../ui/header.php?page=kasir-penjualan#keranjang";
            </script>';
        }
    }

    public function HapusResetKeranjang(){
        $sqKeranjang = "DELETE FROM penjualan";
        $rwKeranjang = $this->db->prepare($sqKeranjang);
        $rwKeranjang->execute();
        echo "<script>document.location.href = '../ui/header.php?page=kasir-penjualan'</script>";
    }
    
    public function HapusBelanjaan(){
        $sqBelanja = "DELETE FROM nota";
        $rwBelanja = $this->db->prepare($sqBelanja);
        $rwBelanja->execute();
        echo "<script>document.location.href = '../ui/header.php?page=kasir-penjualan'</script>";
    }

    public function HapusItemKeranjang(){
        $brg = $_GET['brg'];
        $id = $_GET['id'];
        $sqBarang = "SELECT * from barang where kode_barang = ?";
        $rwBarang = $this->db->prepapre($sqBarang);
        $rwBarang->execute(array($brg));

        $sqPenjualan = "DELETE FROM penjualan WHERE id = ?";
        $rwPenjualan = $this->db->prepare($sqPenjualan);
        $rwPenjualan->execute(array($id));
        echo "<script>document.location.href = '../ui/header.php?page=kasir-penjualan'</script>";
    }
}

?>