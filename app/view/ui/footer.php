<!-- Vendor JS Files -->
<script src="../../../dist/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../../dist/vendor/chart.js/chart.umd.js"></script>
<script src="../../../dist/vendor/echarts/echarts.min.js"></script>
<script src="../../../dist/vendor/quill/quill.js"></script>
<script src="../../../dist/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../dist/vendor/tinymce/tinymce.min.js"></script>
<script src="../../../dist/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../../dist/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
new DataTable('#example1', {
        search: {
            return: true,
        },
    },
    $(document).ready(function() {
        $('#example1_filter').hide(true)
    }),
);

new DataTable('#example2', {
    search: {
        return: false,
    },
});

$(document).ready(function() {
    var response = '';
    $("#cari").change(function() {
        $.ajax({
            type: "POST",
            url: "../kasir/barang.php?cari=yes",
            data: 'keyword=' + $(this).val(),
            async: false,
            beforeSend: function(response) {
                $("#hasil_cari").hide();
                $("#tunggu").html(
                    '<p style="color:green"><blink>tunggu sebentar</blink></p>');
            },
            success: function(html, response) {
                $("#tunggu").html('');
                $("#hasil_cari").show();
                $("#hasil_cari").html(html);
            }
        });
        return response;
    });
});
</script>

<!-- <script>
jQuery(document).ready(function($) {
    $(function() {
        $('#Myform2').submit(function() {
            $.ajax({
                type: 'POST',
                url: 'laporan/export_laporan_barangkeluar.php',
                data: $(this).serialize(),
                success: function(data) {
                    $(".tampung2").html(data);
                    $('.table').DataTable();
                }
            });

            return false;
            e.preventDefault();
        });
    });
});
</script> -->

<script>
jQuery(document).ready(function($) {
    $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '../barang/get_barang.php', // File yang akan memproses data
            data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
            success: function(data) { // Jika berhasil
                $('.tampung2').html(data); // Berikan hasil ke id kota
            }
        });
    });
});
</script>

<script>
jQuery(document).ready(function($) {
    $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '../barang/get_satuan.php', // File yang akan memproses data
            data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
            success: function(data) { // Jika berhasil
                $('.tampung1').html(data); // Berikan hasil ke id kota
            }
        });
    });
});
</script>

<script>
jQuery(document).ready(function($) {
    $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '../barangkeluar/get_barang.php', // File yang akan memproses data
            data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
            success: function(data) { // Jika berhasil
                $('.tampung').html(data); // Berikan hasil ke id kota
            }
        });
    });
});
</script>

<script>
jQuery(document).ready(function($) {
    $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '../barangmasuk/get_barang.php', // File yang akan memproses data
            data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
            success: function(data) { // Jika berhasil
                $('.tampung').html(data); // Berikan hasil ke id kota
            }
        });
    });
});
</script>

<!-- <script>
jQuery(document).ready(function($) {
    $(function() {
        $('#Myform1').submit(function() {
            $.ajax({
                type: 'POST',
                url: 'laporan/export_laporan_barangmasuk.php',
                data: $(this).serialize(),
                success: function(data) {
                    $(".tampung1").html(data);
                    $('.table').DataTable();
                }
            });

            return false;
            e.preventDefault();
        });
    });
});
</script> -->

<script>
jQuery(document).ready(function($) {
    $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '../barangmasuk/get_satuan.php', // File yang akan memproses data
            data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
            success: function(data) { // Jika berhasil
                $('.tampung1').html(data); // Berikan hasil ke id kota
            }
        });
    });
});
</script>
</body>

</html>