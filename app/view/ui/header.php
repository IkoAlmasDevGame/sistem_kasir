<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            session_start();
            require_once("../../config/auth.php");
            require_once("../../config/config.php");
            require_once("../router/webroute.php");
        ?>
        <title><?php echo $_SESSION['nama_website'] ?></title>
        <!--  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <!--  -->
        <link href="../../../dist/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../../dist/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../../../dist/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="../../../dist/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="../../../dist/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../../../dist/vendor/simple-datatables/style.css" rel="stylesheet">
        <link href="../../../dist/css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
        <style type="text/css">
        *,
        .modal-title,
        .card-title2 {
            box-sizing: border-box;
            font-size: 16px;
            font-family: 'Times New Roman', monospace;
            font-weight: normal;
            font-style: normal;
        }

        .card-title,
        .panel-heading {
            font-size: 21px;
            font-family: sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .card-width {
            width: 340px;
        }

        .card-height {
            height: 50px;
        }

        @media (max-height: 500px) {
            .card-height {
                max-height: 500px;
            }
        }

        @media (max-width: 720px) {
            .card-width {
                max-width: 720px;
            }
        }

        .fa-refresh {
            animation: rotating 2s linear infinite;
        }

        @keyframes rotating {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
        </style>
    </head>

    <body>