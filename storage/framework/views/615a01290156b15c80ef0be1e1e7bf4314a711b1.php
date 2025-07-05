<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Page Title -->
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($logo_details['system_name']); ?></title>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <?php if(isset($logo_details['favicon'])): ?>
        <link rel="shortcut icon" href="<?php echo e(project_asset($logo_details['favicon'])); ?>">
    <?php else: ?>
        <link rel="shortcut icon" href="<?php echo e(asset('web-assets/backend/img/favicon.png')); ?>">
    <?php endif; ?>

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/fonts/icofont/icofont.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('web-assets/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.css')); ?>">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= TOASTER CSS======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/css/toaster.min.css')); ?>">
    <!-- ======= TOASTER CSS======= -->

    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/plugins/sweetalert2/sweetalert2.min.css')); ?>">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->

    <!-- Dropzone-->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/plugins/dropzone/dropzone.min.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(asset('web-assets/backend/plugins/daterangepicker/daterangepicker.css')); ?>">

    <?php echo $__env->yieldContent('custom_css'); ?>
    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/css')); ?>/<?php echo e($style_path); ?>/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/css/custom.css')); ?>">
    <!-- ======= END MAIN STYLES ======= -->
    <style>
        .currency-font {
            font-family: "Roboto", sans-serif;
        }

        .single-notification-item {
            text-transform: none !important;
        }

        .search-side-bar {
            list-style: none;
        }
    </style>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/layouts/head.blade.php ENDPATH**/ ?>