<?php 
if(isset($_SESSION["status"])){
    if(isset($_COOKIE["cookies"])){
        if(isset($_SERVER["HTTP"]) && ("on" == $_SERVER["HTTPS"])){
            if(isset($_SESSION["id"])){
                if(isset($_SESSION["email"])){
                    if(isset($_SESSION["username"])){
                        if(isset($_SESSION["nama"])){
                            if(isset($_SESSION["role"])){
                            
                            }
                        }
                    }
                }
            }
        }
    }
}else{
   echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../auth/index.php'
    }, 3000);
    </script>
    ";
    die;
    exit(0);
}
?>