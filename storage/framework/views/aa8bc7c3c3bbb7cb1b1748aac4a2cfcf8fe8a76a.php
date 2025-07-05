<?php
    use Plugin\Ecommerce\Repositories\SettingsRepository;
    use Core\Repositories\SettingsRepository as CoreSettingRepository;
    use Illuminate\Support\Facades\Cache;

    $siteProperties = Cache::rememberForever('site-properties', function () {
        return CoreSettingRepository::SiteProperties();
    });

    $site_name = str_replace('"', '', $siteProperties['site_title']);
    $site_name = str_replace("'", '', $site_name);

    $site_moto = $siteProperties['site_motto'] != null ? '|' . $siteProperties['site_motto'] : '';
    $site_title = $site_name . '' . $site_moto;

    $default_language = defaultLanguage();
    $default_curency = SettingsRepository::defaultCurrency();

    $active_theme = getActiveTheme();

    $body_typography = themeOptionToCss('body_typography', $active_theme->id);
    $paragraph_typography = themeOptionToCss('paragraph_typography', $active_theme->id);
    $heading_typography = themeOptionToCss('heading_typography', $active_theme->id);
    $menu_typography = themeOptionToCss('menu_typography', $active_theme->id);
    $button_typography = themeOptionToCss('button_typography', $active_theme->id);
    $logo_details = getGeneralSettingsDetails();
    $custom_js_properties = getThemeOption('custom_js', $active_theme->id);
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <link rel="manifest" href="/manifest.json">
    <?php if(isset($logo_details['favicon'])): ?>
        <link rel="shortcut icon" href="<?php echo e(project_asset($logo_details['favicon'])); ?>">
    <?php else: ?>
        <link rel="shortcut icon" href="<?php echo e(asset('web-assets/backend/img/favicon.png')); ?>">
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php echo $__env->yieldContent('seo'); ?>
    <meta property="og:image:width" content="1200" />
    <meta name="brand_name" content="<?php echo e($site_name); ?>" />
    <link rel="canonical" href="<?php echo e(env('APP_URL')); ?>" />
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>" />
    <meta name="twitter:domain" content="<?php echo e(env('APP_URL')); ?>" />
    <meta property="og:site_name" content="<?php echo e($site_name); ?>" />
    <meta name="twitter:site" content="<?php echo e($site_name); ?>" />
    <meta name="apple-mobile-web-app-title" content="<?php echo e($site_title); ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/themes/fashion-themeblog/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('/themes/fashion-themecss/custom_app.css')); ?>">


    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/back_to_top.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/header.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/header_logo.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/blog.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/sidebar_options.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/page_404.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/subscribe.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/footer.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/social_icon.css')); ?>">
    <!-- Including all google fonts link -->
    <?php if ($__env->exists('theme/fashion-theme::frontend.blog.includes.custom.google-font-link', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ])) echo $__env->make('theme/fashion-theme::frontend.blog.includes.custom.google-font-link', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Including all dynamic css -->
    <?php if ($__env->exists('theme/fashion-theme::frontend.blog.includes.custom.tl-dynamic-css', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ])) echo $__env->make('theme/fashion-theme::frontend.blog.includes.custom.tl-dynamic-css', [
        'body_typography' => $body_typography,
        'paragraph_typography' => $paragraph_typography,
        'heading_typography' => $heading_typography,
        'menu_typography' => $menu_typography,
        'button_typography' => $button_typography,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Theme Option Css -->

    
    <?php echo $__env->yieldContent('builder-css-link'); ?>
    <!--Custom script-->
    <?php if($custom_js_properties != null): ?>
        <?php echo $custom_js_properties['header_custom_js_code']; ?>

    <?php endif; ?>
    <!--End custom script-->
</head>

<body class="antialiased">
    <div id="app">
    </div>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/themes/fashion-themecss/custom_css.css')); ?>">
    <script>
        //set site title
        let site_title = localStorage.getItem('site_title');
        localStorage.setItem('site_title', '<?php echo $site_title; ?>');

        //set default language
        let locale = localStorage.getItem('locale');
        if (locale == null) {
            localStorage.setItem('locale', '<?php echo $default_language; ?>');
        }
        //set selected currency
        let currency = localStorage.getItem('currency');

        if (currency == null) {
            localStorage.setItem('currency', '<?php echo $default_curency; ?>');
        }
        //set default currency
        localStorage.setItem('default_currency', '<?php echo $default_curency; ?>');
    </script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(registration => {

                    })
                    .catch(error => {

                    });
            });
        }
    </script>
    <!--Custom script-->
    <?php if($custom_js_properties != null): ?>
        <?php echo $custom_js_properties['footer_custom_js_code']; ?>

    <?php endif; ?>
    <!--End custom script-->

    <?php if(isActivePlugin('ecommerce')): ?>
        <script src="<?php echo e(asset('/themes/fashion-theme/public/js/main.js?v=1023')); ?>"></script>
    <?php endif; ?>

</body>

</html>
<?php /**PATH /home/medo/work/eco-jara/fashly/themes/fashion-theme/resources/views/frontend/layouts/master.blade.php ENDPATH**/ ?>