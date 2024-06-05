<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            require_once("../../database/koneksi.php");
            $row = $config->prepare("SELECT * FROM sistem WHERE flags = '1'");
            $row->execute();
            $hasil = $row->fetch();
        ?>
        <title>Sistem Kasir <?php echo $hasil['nama_website']; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style type="text/css">
        * {
            box-sizing: border-box;
            font-family: "Times New Roman";
            font-style: normal;
        }

        .card-title {
            font-size: 16px;
            font-weight: normal;
            text-align: center;
        }

        .card-title2 {
            font-size: 32px;
            font-weight: normal;
            text-align: center;
        }

        body {
            background-color: gray;
            background-blend-mode: darken;
        }

        .card {
            width: 360px;
        }

        .card-body {
            height: 320px;
        }

        @media (max-height: 500px) {
            .card-body {
                max-height: 500px;
            }
        }

        @media (max-width: 720px) {
            .card {
                max-width: 720px;
            }
        }
        </style>
    </head>

    <body onload="startTime()">
        <div class="layout">
            <div class="d-grid justify-content-center align-items-center flex-wrap p-3 m-3">
                <div class="container-fluid bg-body-secondary p-5 m-5 mx-auto rounded-1">
                    <div class="card">
                        <div class="d-flex justify-content-center align-items-center flex-wrap gap-1">
                            <div class="card-body">
                                <h4 class="card-title2">Login</h4>
                                <div class="border border-top mb-2"></div>
                                <h4 class="card-title display-4">
                                    - <?php echo $hasil['nama_website'] ?> -
                                </h4>
                                <?php 
                                    require_once("../../model/model_pengguna.php");
                                    require_once("../../controller/controller.php");
                                    $users = new controller\Authentication($config);

                                    if(!isset($_GET['aksi'])){
                                        require_once("../../controller/controller.php");
                                    }else{
                                        switch ($_GET['aksi']) {
                                            case 'SignIn':
                                                $users->SignIn();
                                                break;
                                            
                                            default:
                                                require_once("../../controller/controller.php");
                                                break;
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <form action="?aksi=SignIn" method="post">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <label for="">username / email</label>
                                                        <input type="text" name="userInput" id=""
                                                            class="form-control form-control-plaintext opacity-50 rounded-1"
                                                            placeholder="masukkan email atau username anda" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">password</label>
                                                        <input type="password" name="passInput" id=""
                                                            class="form-control form-control-plaintext opacity-50 rounded-1"
                                                            placeholder="masukkan password anda" required>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="card-footer">
                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary hover col-sm-12 col-md-6">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <footer class="footer">
                                    <p id="year" class="text-center"></p>
                                </footer>
                                <div class="text-center">By <?php echo $hasil['nama_pembuatan'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        </script>
        <script type="text/javascript">
        function startTime() {
            var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            var today = new Date();
            var h = today.getHours();
            var tahun = today.getFullYear();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('year').innerHTML =
                "&copy Sistem Informasi Inventori " + tahun + "<br>" + day[today.getDay()] + ", " + h + " : " + m +
                " : " + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        </script>
    </body>

</html>