<!DOCTYPE html>
<html ng-app="myModule">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laabus Channel partner</title>
		<link rel="icon" type="image/png" href="http://laabus.com/images/logo_laabus3.png" />
        <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/animate.css" rel="stylesheet">
		

        <link href="<?= base_url() ?>admin_assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
        
        <!--Summer Note for edit textarea fields-->
        <link href="<?= base_url() ?>admin_assets/css/plugins/summernote/summernote.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?= base_url() ?>admin_assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- FooTable -->
        <link href="<?= base_url() ?>admin_assets/css/plugins/footable/footable.core.css" rel="stylesheet">

        <!-- Sweet Alert -->
        <link href="<?= base_url() ?>admin_assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

        <!--Multi select-->
        <link href="<?= base_url() ?>admin_assets/css/plugins/chosen/chosen.css" rel="stylesheet">

        <!--Date Picker-->
        <link href="<?= base_url() ?>admin_assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">


        <link href="<?= base_url() ?>admin_assets/css/style.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
        <script src="<?= base_url() ?>admin_assets/js/jquery-2.1.1.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php
            $this->load->view('admin_template/Side_Menu_bar.php')?>