<?php
    $settings_details = getGeneralSettingsDetails();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Page Title -->

    <title>
        <?php echo $__env->yieldContent('title'); ?>
    </title>

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

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/css/light/style.css')); ?>">
    <!-- ======= END MAIN STYLES ======= -->

    <!-- ======= TOASTER CSS======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/css/toaster.min.css')); ?>">
    <!-- ======= TOASTER CSS======= -->
    <?php echo $__env->yieldContent('custom_css'); ?>
</head>

<body>

    <?php echo $__env->yieldContent('main_content'); ?>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
    <script src="<?php echo e(asset('web-assets/backend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/backend/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/backend/js/script.js')); ?>"></script>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

    <!-- ======= TOASTER ======= -->
    <script src="<?php echo e(asset('web-assets/backend/js/toaster.min.js')); ?>"></script>
    <?php echo Toastr::message(); ?>

    <!-- ======= TOASTER ======= -->
    <?php echo $__env->yieldContent('custom_scripts'); ?>
</body>

</html>
<?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/auth/auth_layout.blade.php ENDPATH**/ ?>