<?php
    use Core\Views\Composer\Core;
    $shareable_data = new Core();
    $active_langs = $shareable_data->active_langs;
    $active_lang = $shareable_data->active_lang;
    $style_path = $shareable_data->style_path;
    $mood = $shareable_data->mood;

    $logo_details = getGeneralSettingsDetails();

    $chink_size_object = getChunkSize();
    $chink_size = 256000000;
    if ($chink_size_object != null) {
        $chink_size = $chink_size_object->value;
    }

    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';

    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
?>
<?php echo $__env->make('core::base.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <!-- Offcanval Overlay -->
    <div class="offcanvas-overlay"></div>
    <!-- Offcanval Overlay -->
    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php echo $__env->make('plugin/multivendor::seller.dashboard.layouts.seller_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Header -->

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Sidebar -->
            <?php echo $__env->make('plugin/multivendor::seller.dashboard.layouts.side_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <div class="container-fluid">
                    <?php echo $__env->make('core::base.layouts.dark_light_switcher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if(auth()->user()->status == config('settings.general_status.active')): ?>
                        <?php echo $__env->yieldContent('seller_main_content'); ?>
                    <?php else: ?>
                        <p class="alert alert-info">Your Account is Inactive. Please contact with Administration </p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Main Wrapper -->

        <!-- Footer -->
        <?php echo $__env->make('core::base.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Footer -->
    </div>
    <!-- End wrapper -->
    <?php echo $__env->make('core::base.layouts.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /home/medo/work/eco-jara/fashly/plugins/multivendor/views/seller/dashboard/layouts/seller_master.blade.php ENDPATH**/ ?>