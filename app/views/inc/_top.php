<!-- TOP -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="shortcut icon" href="<?php echo URL_ROOT; ?>/assets/images/favicon.png" />
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/vendors/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/vendors/datatable/datatables.min.css">
     
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/vendors/css/vendor.bundle.base.css">
  
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/assets/css/custom.css">

    <!-- plugins:js -->
    <script src="<?php echo URL_ROOT; ?>/vendors/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <!-- End custom js for this page-->

    <script src="<?php echo URL_ROOT; ?>/vendors/moment/moment.min.js"></script>
    <script src="<?php echo URL_ROOT; ?>/vendors/datatable/datatables.min.js"></script>
    <script src="<?php echo URL_ROOT; ?>/vendors/ckeditor4/ckeditor.js"></script>

</head>

<body>
    <div class="body-wrapper">
        <script src="<?php echo URL_ROOT; ?>/assets/js/preloader.js"></script>
        <!-- SIDEBAR -->
        <?php require APP_ROOT . '/views/inc/__sidebar.php' ?>
        <!-- SIDEBAR -->

        <div class="main-wrapper mdc-drawer-app-content">
            <!-- NAVBAR -->
            <?php require APP_ROOT . '/views/inc/__navbar.php' ?>
            <!-- NAVBAR -->

            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <main class="content-wrapper">
                    <div class="mdc-layout-grid">
<!-- TOP -->
