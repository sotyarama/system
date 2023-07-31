<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($tabTitle)) : ?>
        <title><?= $tabTitle ?></title>
    <?php else : ?>
        <title>System</title>
    <?php endif; ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <?php if (isset($dataTables) && $dataTables == 'yes') : ?>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dataTables/dataTables.css">
    <?php endif; ?>
</head>

<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('templates/navbar'); ?>

        <?= $this->include('templates/mainsidebar'); ?>

        <div class="content-wrapper">
            <?= $this->include('templates/header'); ?>

            <section class="content">
                <?= $this->renderSection('page-content'); ?>
            </section>
        </div>
        <?= $this->include('templates/footer'); ?>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>

    <!-- SweetAlerts2 -->
    <script src="<?= base_url(); ?>assets/sweetalerts2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/sweetalerts2/myscript.js"></script>


    <!-- DataTables  & Plugins -->
    <?php if (isset($dataTables) && $dataTables == 'yes') : ?>
        <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script>
            $(function() {
                $("#tableAll").DataTable({
                    "lengthChange": true,
                    "autoWidth": true,
                    "info": true,
                    "paging": true,
                    "ordering": true,
                    "searching": true,
                });
            });
        </script>
    <?php endif; ?>

    <!-- Page add new brand or edit brand -->
    <?php if (isset($use_img_preview) && ($use_img_preview == 'yes')) : ?>
        <script>
            function previewImg() {
                const img = document.querySelector('#img_preview');
                const imgLabel = document.querySelector('.custom-file-label');
                const imgPreview = document.querySelector('.img-preview');

                imgLabel.textContent = img.files[0].name;

                const fileImg = new FileReader();
                fileImg.readAsDataURL(img.files[0]);

                fileImg.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        </script>
    <?php endif; ?>

    <!-- Page add new vehicle or edit vehicle -->
    <?php if (isset($tabTitle) && ($tabTitle == 'Add Vehicle' || $tabTitle == 'Edit Vehicle')) : ?>
        <script>
            function brandIdChanged(brandId) {
                $.ajax({
                    url: "<?php echo base_url(); ?>/vehicles/getDataByBrandId/" + brandId,
                    method: "POST",
                    data: {
                        brandId: brandId
                    },
                    success: function(result) {
                        let data = JSON.parse(result);
                        console.log(data);

                        let series = data.series;
                        let engine = data.engines;

                        let outputSeries = '<option selected disabled>Choose Series</option>';
                        let outputEngine = '<option selected disabled>Choose Engine</option>';
                        for (let row in series) {
                            outputSeries += '<option value="' + series[row].id_series + '">' + series[row].market_name + ' | ' + series[row].official_name + '</option>';
                        }
                        for (let row in engine) {
                            outputEngine += '<option value="' + engine[row].id_engine + '">' + engine[row].engine_name + '</option>';
                        }
                        document.querySelector('#series_id').innerHTML = outputSeries;
                        document.querySelector('#engine_id').innerHTML = outputEngine;
                    }
                });
            }
        </script>
    <?php endif; ?>
</body>

</html>