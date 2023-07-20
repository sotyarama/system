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

    <?php endif; ?>
</body>

</html>