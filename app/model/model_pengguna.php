<?php 
namespace model;

class pengguna {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function create($nama,$username,$email,$password,$repassword,$role){
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $_POST['nama'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlentities($_POST['password']), false) ? md5(htmlspecialchars($_POST['password']), false) : md5($_POST['password'], false);
        $repassword = md5(htmlentities($_POST['repassword']), false) ? md5(htmlspecialchars($_POST['repassword']), false) : md5($_POST['repassword'], false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];

        $table = "users";
        $sql = "INSERT $table SET nama = '$nama', username = '$username', email = '$email', password = '$password', repassword = '$repassword', role = '$role'";
        $row = $this->db->prepare($sql);
        $row->execute();

        if($row){
            echo "<script>
            alert('berhasil menambahkan pegawai');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan Pegawai');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }
    }

    public function update($nama,$username,$email,$password,$repassword,$role,$id){
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $_POST['nama'];
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5(htmlentities($_POST['password']), false) ? md5(htmlspecialchars($_POST['password']), false) : md5($_POST['password'], false);
        $repassword = md5(htmlentities($_POST['repassword']), false) ? md5(htmlspecialchars($_POST['repassword']), false) : md5($_POST['repassword'], false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $table = "users";
        $sql = "UPDATE $table SET nama='$nama', username='$username', password='$password', email='$email', repassword='$repassword', role='$role' WHERE id='$id'";
        $row = $this->db->prepare($sql);
        $row->execute();

        if($row){
            echo "<script>
            alert('berhasil ubah pegawai');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal ubah Pegawai');
            document.location.href = '../ui/header.php?page=pengguna&aksi=ubahpengguna&id=$id';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        $table = "users";
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $row = $this->db->prepare($sql);
        $row->execute();

        if($row){
            echo "<script>
            alert('berhasil hapus pegawai');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal hapus Pegawai');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }
    }

    public function updateTable($query,$id){
        $row = $this->db->prepare($query);
        $row->execute(array($id));
        return $row;
    }

    public function SignIn($userInput, $password){
        $userInput = htmlentities($_POST["userInput"]) ? htmlspecialchars($_POST["userInput"]) : $_POST["userInput"];
        $password = md5($_POST["password"], false);
        password_verify($password, PASSWORD_DEFAULT);

        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php';</script>";
            die;
            exit;
        }

        $table = "users";
        $sql = "SELECT * FROM $table WHERE email = '$userInput' and password = '$password' || username = '$userInput' and repassword = '$password'";
        $row = $this->db->prepare($sql);
        $row->execute();
        $cek = $row->rowCount();

        if($cek > 0){
            $response = array($userInput, $password);
            $respon[$table] = $response;
            if($tbp = $row->fetch()){
                if($tbp["role"] == "superadmin"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["email"] = $tbp["email"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "superadmin";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }else if($tbp["role"] == "admin"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["email"] = $tbp["email"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "admin";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }else if($tbp["role"] == "pegawai"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["email"] = $tbp["email"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "pegawai";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }
                $_SESSION["status"] = true;
                $_COOKIE['cookies'] = $userInput;
                $_SERVER['HTTPS'] == $_SERVER['HTTP'] = true;
                setcookie($$respon[$table], $tbp, time() + (86400 * 30), "/");
                array($respon[$table], $tbp);
                exit;
            }
        }else{
            $_SESSION["status"] = false;
            $_SERVER['HTTPS'] == $_SERVER['HTTP'] = false;
            echo "<script>alert('Harap coba lagi ...'); document.location.href = '../auth/index.php'</script>";
            die;
            exit;   
        }
    }
}

?>