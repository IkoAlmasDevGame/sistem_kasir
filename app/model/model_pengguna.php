<?php 
namespace model;

class pengguna {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Login($userInput, $passInput){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $passInput = md5(htmlentities($_POST['passInput']), false) ? md5(htmlspecialchars($_POST['passInput']), false) : md5($_POST['passInput'], false);
        password_verify($passInput, PASSWORD_DEFAULT);

        if($userInput == "" || $passInput == ""){
            echo "<script>document.location.href = '../auth/index.php'</script>";
            die;
            exit;
        }

        $table = "users";
        $sql = "SELECT * FROM $table WHERE email = ? and password = ? || username = '$userInput' and repassword = '$passInput'";
        $row = $this->db->prepare($sql);
        $data = array($userInput, $passInput);
        $row->execute($data);
        $cek = $row->rowCount();

        if($cek > 0){
           $response = $data;
           $responsed[$table] = $response;
           if($rdb = $row->fetch()){
            if($rdb['role'] == "superadmin"){
                $_SESSION["id"] = $rdb["id"];
                $_SESSION["username"] = $rdb["username"];
                $_SESSION["email"] = $rdb["email"];
                $_SESSION["nama"] = $rdb["nama"];
                $_SESSION['role'] = "superadmin";
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
            }else if($rdb['role'] == "admin"){
                $_SESSION["id"] = $rdb["id"];
                $_SESSION["username"] = $rdb["username"];
                $_SESSION["email"] = $rdb["email"];
                $_SESSION["nama"] = $rdb["nama"];
                $_SESSION['role'] = "admin";
                echo "<script>document.location.href = '../ui/header.php?page=beranda</script>";
            }else if($rdb['role'] == "pegawai"){
                $_SESSION["id"] = $rdb["id"];
                $_SESSION["username"] = $rdb["username"];
                $_SESSION["email"] = $rdb["email"];
                $_SESSION["nama"] = $rdb["nama"];
                $_SESSION['role'] = "pegawai";
                echo "<script>document.location.href = '../ui/header.php?page=beranda</script>";
            }
            $_SESSION["status"] = true;
            $_SERVER["HTTPS"] == $_SERVER["HTTP"] = true;
            $_COOKIE["cookies"] = $userInput;
            setcookie($responsed[$table], $rdb, time() + (86400 * 30), "/");
            array($responsed[$table], $rdb);
            exit;
           } 
        }else{
            $_SESSION["status"] = false;
            $_SERVER["HTTPS"] == $_SERVER["HTTP"] = false;
            echo "<script>
            alert('Harap coba lagi ...'); 
            document.location.href = '../auth/index.php';
            </script>";
            die;
            exit; 
        }
    }
}

?>