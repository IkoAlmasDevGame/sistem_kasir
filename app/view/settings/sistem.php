<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin"){
                require_once("../ui/header.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Sistem Website</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <?php 
            require_once("../ui/footer.php");
        ?>